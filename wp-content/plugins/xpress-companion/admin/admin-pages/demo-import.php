<?php
define( 'TMX_DEMO_URL', plugin_dir_url( __FILE__ ) );

function appilo_import_files() {
    return [
        [
            'import_file_name'           => 'Nextbit Main',
            'import_file_url'            => TMX_DEMO_URL . 'demo/main/content.xml',
            'import_widget_file_url'     => TMX_DEMO_URL . 'demo/main/widgets.wie',
            'import_customizer_file_url' => TMX_DEMO_URL . 'demo/main/theme-options.dat',
            'import_preview_image_url'   => TMX_DEMO_URL . 'demo/main/home1.jpg',
            'import_notice'              => __( 'All are set with one click demo import', 'xpress-companion' ),
            'preview_url'                => 'https://themexriver.com/wp/nextbit/',
        ],
        [
            'import_file_name'           => 'Home 02',
            'import_file_url'            => TMX_DEMO_URL . 'demo/saas-classic/rtl/content.xml',
            'import_widget_file_url'     => TMX_DEMO_URL . 'demo/saas-classic/rtl/widgets.wie',
            'import_customizer_file_url' => TMX_DEMO_URL . 'demo/saas-classic/rtl/theme-options.dat',
            'import_preview_image_url'   => TMX_DEMO_URL . 'demo/home-2/home2.jpg',
            'import_notice'              => __( 'Importing SaaS Classic RTL Demo! This is new demo.', 'xpress-companion' ),
            'preview_url'                => 'https://themexriver.com/wp/nextbit/home-02.',
        ],
    ];
}
add_filter( 'pt-ocdi/import_files', 'appilo_import_files' );

// Before Import
function appilo_clear_before_import( $selected ) {
    // Here you can do stuff for the "Demo Import 1" before the content import starts.
    global $wpdb;
    //delete posts
    $tables = ['commentmeta', 'comments', 'postmeta', 'posts', 'termmeta', 'terms', 'term_relationships', 'term_taxonomy', 'sidebars_widgets'];
    foreach ( $tables as $table ) {
        $table = $wpdb->prefix . $table;
        $wpdb->query( "TRUNCATE TABLE $table" );
    }
}
add_action( 'pt-ocdi/before_content_import', 'appilo_clear_before_import' );

// After Import
function appilo_after_import_setup( $selected ) {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

    set_theme_mod(
        'nav_menu_locations', [
            'main-menu' => $main_menu->term_id,
        ]
    );

    if ( 'Osaas Home 1' === $selected['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home 1' );
    } elseif ( 'Osaas Home 2' === $selected['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home 2' );
    } elseif ( 'Osaas Home 3' === $selected['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home 3' );
    } elseif ( 'Osaas Home 4' === $selected['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home 4' );
    } elseif ( 'Osaas Home 5' === $selected['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home 5' );
    } else {
        $front_page_id = get_page_by_title( 'Home' );
    }
    $blog_page_id = get_page_by_title( 'Blog' );

    if ( class_exists( 'RevSlider' ) ) {

        if ( 'Prysm' === $selected['import_file_name'] ) {
            $slider_array = [
                get_template_directory() . '/rev-slider/prysm-slider.zip',
            ];
        }

        $slider = new RevSlider();

        foreach ( $slider_array as $filepath ) {
            $slider->importSliderFromPost( true, true, $filepath );
        }

    }

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );
}
add_action( 'pt-ocdi/after_import', 'appilo_after_import_setup' );

//Personalize
function appilo_plugin_page_setup( $default_settings ) {
    $default_settings['parent_slug'] = 'themes.php';
    $default_settings['page_title'] = esc_html__( 'Nextbit Demo Importer', 'xpress-companion' );
    $default_settings['menu_title'] = esc_html__( 'Nextbit Demo Importer', 'xpress-companion' );
    $default_settings['capability'] = 'import';
    $default_settings['menu_slug'] = 'nextbit-demo-importer';

    return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'appilo_plugin_page_setup' );

add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

function appilo_cc_mime_types( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'appilo_cc_mime_types' );
