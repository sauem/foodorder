<?php

/**
 * frudbaz functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package frudbaz
 */

if (!function_exists('frudbaz_setup')):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function frudbaz_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on frudbaz, use a find and replace
         * to change 'frudbaz' to the name of your theme in all the template files.
         */
        load_theme_textdomain('frudbaz', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus([
            'main-menu' => esc_html__('Main Menu', 'frudbaz'),
        ]);

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ]);

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('frudbaz_custom_background_args', [
            'default-color' => 'ffffff',
            'default-image' => '',
        ]));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        //Enable custom header
        add_theme_support('custom-header');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', [
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ]);

        /**
         * Enable suporrt for Post Formats
         *
         * see: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support('post-formats', [
            'image',
            'audio',
            'video',
            'gallery',
            'quote'
        ]);

        // Add theme support for selective refresh for widgets.
        //add_theme_support( 'customize-selective-refresh-widgets' );

        add_theme_support('woocommerce');

        // Add support for Block Styles.
        add_theme_support('wp-block-styles');

        // Add support for full and wide align images.
        add_theme_support('align-wide');

        // Add support for editor styles.
        add_theme_support('editor-styles');

        // Add support for responsive embedded content.
        add_theme_support('responsive-embeds');

        // remove block widget support
        remove_theme_support('widgets-block-editor');

        add_image_size('frudbaz-case-details', 1170, 600, ['center', 'center']);
        add_image_size('frudbaz-post-thumb', 500, 350, ['center', 'center']);
        add_image_size('frudbaz-case-thumb', 700, 544, ['center', 'center']);
    }
endif;
add_action('after_setup_theme', 'frudbaz_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function frudbaz_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('frudbaz_content_width', 640);
}

add_action('after_setup_theme', 'frudbaz_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function frudbaz_widgets_init()
{

    /**
     * blog sidebar
     */
    register_sidebar([
        'name' => esc_html__('Blog Sidebar', 'frudbaz'),
        'id' => 'blog-sidebar',
        'before_widget' => '<div id="%1$s" class="widget mb-35 %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget_title">',
        'after_title' => '</h3>',
    ]);

    if (FRUDBAZ_WOOCOMMERCE_ACTIVED) {
        register_sidebar(array(
            'name' => esc_html__('Product Sidebar', 'frudbaz'),
            'id' => 'product-sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget_title">',
            'after_title' => '</h3>',

        ));
    }

    $footer_widgets = get_theme_mod('footer_widget_number', 4);

    // footer default
    for ($num = 1; $num <= $footer_widgets; $num++) {
        register_sidebar([
            'name' => sprintf(esc_html__('Footer %1$s', 'frudbaz'), $num),
            'id' => 'footer-' . $num,
            'description' => sprintf(esc_html__('Footer %1$s', 'frudbaz'), $num),
            'before_widget' => '<div id="%1$s" class="footer_widget mt-40 %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="fw_title">',
            'after_title' => '</h3>',
        ]);
    }
}

add_action('widgets_init', 'frudbaz_widgets_init');

/**
 * Enqueue scripts and styles.
 * @since 1.0.0
 */

define('FRUDBAZ_THEME_DIR', get_template_directory());
define('FRUDBAZ_THEME_URI', get_template_directory_uri());
define('FRUDBAZ_THEME_CSS_DIR', FRUDBAZ_THEME_URI . '/assets/css/');
define('FRUDBAZ_THEME_JS_DIR', FRUDBAZ_THEME_URI . '/assets/js/');
define('FRUDBAZ_THEME_INC', FRUDBAZ_THEME_DIR . '/inc/');

/**
 * frudbaz_scripts description
 * @return [type] [description]
 */
function frudbaz_scripts()
{

    wp_enqueue_style('frudbaz-fonts', frudbaz_fonts_url(), [], null);
    wp_enqueue_style('bootstrap', FRUDBAZ_THEME_CSS_DIR . 'bootstrap.min.css', []);
    wp_enqueue_style('fontawesome', FRUDBAZ_THEME_CSS_DIR . 'fontawesome.css', []);
    wp_enqueue_style('themify', FRUDBAZ_THEME_CSS_DIR . 'themify-icons.css', []);
    wp_enqueue_style('animate', FRUDBAZ_THEME_CSS_DIR . 'animate.min.css', []);
    wp_enqueue_style('owl-carousel', FRUDBAZ_THEME_CSS_DIR . 'owl.carousel.min.css', []);
    wp_enqueue_style('magnific-popup', FRUDBAZ_THEME_CSS_DIR . 'magnific-popup.css', []);
    wp_enqueue_style('metisMenu', FRUDBAZ_THEME_CSS_DIR . 'metisMenu.css', []);
    wp_enqueue_style('jquery-ui', FRUDBAZ_THEME_CSS_DIR . 'jquery-ui.css', []);
    wp_enqueue_style('nice-select', FRUDBAZ_THEME_CSS_DIR . 'nice-select.css', []);
    wp_enqueue_style('datepicker', FRUDBAZ_THEME_CSS_DIR . 'datepicker.css', []);
    wp_enqueue_style('timepicker', FRUDBAZ_THEME_CSS_DIR . 'jquery.timepicker.css', []);
    wp_enqueue_style('uikit', FRUDBAZ_THEME_CSS_DIR . 'uikit.css', []);
    wp_enqueue_style('frudbaz-common', FRUDBAZ_THEME_CSS_DIR . 'common.css', []);
    wp_enqueue_style('frudbaz-core', FRUDBAZ_THEME_CSS_DIR . 'frudbaz-core.css', []);
    wp_enqueue_style('frudbaz-companion', FRUDBAZ_THEME_CSS_DIR . 'frudbaz-companion.css', []);
    wp_enqueue_style('frudbaz-custom', FRUDBAZ_THEME_CSS_DIR . 'frudbaz-custom.css', []);
    wp_enqueue_style('frudbaz-responsive', FRUDBAZ_THEME_CSS_DIR . 'responsive.css', []);
    wp_enqueue_style('frudbaz-woocommerce', FRUDBAZ_THEME_CSS_DIR . 'frudbaz-woocommerce.css', []);
    wp_enqueue_style('frudbaz-style', get_stylesheet_uri());

    $my_current_lang = apply_filters('wpml_current_language', NULL);

    // rtl css files
    $rtl_enable = get_theme_mod('rtl_switch', false);
    if ($my_current_lang != 'en' && $rtl_enable) {
        wp_enqueue_style('frudbaz-rtl', FRUDBAZ_THEME_CSS_DIR . 'frudbaz-rtl.css', []);
    }

    // all js files
    wp_enqueue_script('bootstrap', FRUDBAZ_THEME_JS_DIR . 'bootstrap.bundle.min.js', ['jquery'], false, true);
    wp_enqueue_script('owl-carousel', FRUDBAZ_THEME_JS_DIR . 'owl.carousel.min.js', ['jquery'], false, true);
    wp_enqueue_script('metisMenu', FRUDBAZ_THEME_JS_DIR . 'metisMenu.min.js', ['jquery'], '', true);
    wp_enqueue_script('wow-min', FRUDBAZ_THEME_JS_DIR . 'wow.min.js', ['jquery'], '', true);
    wp_enqueue_script('nice-select', FRUDBAZ_THEME_JS_DIR . 'jquery.nice-select.min.js', ['jquery'], '', true);
    wp_enqueue_script('jquery-ui', FRUDBAZ_THEME_JS_DIR . 'jquery-ui.js', ['jquery'], '', true);
    wp_enqueue_script('datepicker', FRUDBAZ_THEME_JS_DIR . 'datepicker.js', ['jquery'], '', true);
    wp_enqueue_script('timepicker', FRUDBAZ_THEME_JS_DIR . 'jquery.timepicker.min.js', ['jquery'], '', true);
    wp_enqueue_script('isotope', FRUDBAZ_THEME_JS_DIR . 'isotope.pkgd.min.js', ['jquery'], '', true);
    wp_enqueue_script('imagesloaded', ['jquery'], false, true);
    wp_enqueue_script('magnific', FRUDBAZ_THEME_JS_DIR . 'jquery.magnific-popup.min.js', ['jquery'], false, true);
    wp_enqueue_script('touchspin', FRUDBAZ_THEME_JS_DIR . 'jquery.bootstrap-touchspin.js', ['jquery'], false, true);
    wp_enqueue_script('frudbaz-yith', FRUDBAZ_THEME_JS_DIR . 'frudbaz-yith.js', ['jquery'], false, true);
    wp_enqueue_script('uikit', FRUDBAZ_THEME_JS_DIR . 'uikit.js', ['jquery'], false, true);

    // rtl js files
    if ($my_current_lang != 'en' && $rtl_enable) {
        wp_enqueue_script('frudbaz-rtl-main', FRUDBAZ_THEME_JS_DIR . 'rtl-main.js', ['jquery'], false, true);
    } else {
        wp_enqueue_script('frudbaz-main', FRUDBAZ_THEME_JS_DIR . 'main.js', ['jquery'], false, true);
    }

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

}

add_action('wp_enqueue_scripts', 'frudbaz_scripts');

/*
Register Fonts
 */
function frudbaz_fonts_url()
{
    $font_url = '';
    /**
     * Translators: If there are characters in your language that are not supported
     * by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ('off' !== _x('on', 'Google font: on or off', 'frudbaz')) {
        $font_url = 'https://fonts.googleapis.com/css2?family=Lilita+One&family=Roboto:wght@300;400;500;700&family=Sofia&display=swap';
    }
    return $font_url;
}

// wp_body_open
if (!function_exists('wp_body_open')) {
    function wp_body_open()
    {
        do_action('wp_body_open');
    }
}

/**
 * Implement the Custom Header feature.
 */
require FRUDBAZ_THEME_INC . 'custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require FRUDBAZ_THEME_INC . 'xpress-functions.php';

/**
 * Custom template helper function for this theme.
 */
require FRUDBAZ_THEME_INC . 'xpress-helper.php';

/**
 * initialize kirki customizer class.
 */
include_once FRUDBAZ_THEME_INC . 'kirki-customizer.php';
include_once FRUDBAZ_THEME_INC . 'class-xpress-kirki.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require FRUDBAZ_THEME_INC . 'jetpack.php';
}

/**
 * include frudbaz functions file
 */
require_once FRUDBAZ_THEME_INC . 'class-breadcrumb.php';
require_once FRUDBAZ_THEME_INC . 'class-navwalker.php';
require_once FRUDBAZ_THEME_INC . 'class-tgm-plugin-activation.php';
require_once FRUDBAZ_THEME_INC . 'add-plugin.php';
define('ASSET', get_template_directory_uri() . '/assets');
if (!defined('FRUDBAZ_WOOCOMMERCE_ACTIVED')) {
    define('FRUDBAZ_WOOCOMMERCE_ACTIVED', in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))));
}

define('FRUDBAZ_COMPANION_ACTIVED', in_array('xpress-companion/xpress-companion.php', apply_filters('active_plugins', get_option('active_plugins'))));
define('FRUDBAZ_WISHLIST_ACTIVED', in_array('yith-woocommerce-wishlist/init.php', apply_filters('active_plugins', get_option('active_plugins'))));
define('FRUDBAZ_QUICK_VIEW_ACTIVED', in_array('yith-woocommerce-quick-view/init.php', apply_filters('active_plugins', get_option('active_plugins'))));

if (FRUDBAZ_WOOCOMMERCE_ACTIVED) {
    require_once FRUDBAZ_THEME_INC . 'frudbaz-woocommerce.php';
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function frudbaz_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}

add_action('wp_head', 'frudbaz_pingback_header');

/**
 *
 * comment section
 *
 */
add_filter('comment_form_default_fields', 'frudbaz_comment_form_default_fields_func');

function frudbaz_comment_form_default_fields_func($default)
{

    $default['author'] = '
        <div class="row">
            <div class="col-lg-6">
                <input type="text" name="author" placeholder="' . esc_attr__('Type your name...', 'frudbaz') . '">
            </div>';

    $default['email'] = '
        <div class="col-lg-6">
            <input type="text" name="email" placeholder="' . esc_attr__('Type your mail...', 'frudbaz') . '">
    	</div>
        </div>';

    $defaults['comment_field'] = '';

    $default['url'] = '
		<div class="row">
            <div class="post-input input-field">
                <input type="text" name="url" placeholder="' . esc_attr__('Type your Website', 'frudbaz') . '">
            </div>
        </div>
        ';
    return $default;
}

add_action('comment_form_top', 'frudbaz_add_comments_textarea');
function frudbaz_add_comments_textarea()
{
    if (!is_user_logged_in()) {
        echo '<div class="row"><div class="col-12"><textarea id="comment" name="comment" cols="60" rows="6" placeholder="' . esc_attr__('Type your comments...', 'frudbaz') . '" aria-required="true"></textarea></div></div>';
    }
}

add_filter('comment_form_defaults', 'frudbaz_comment_form_defaults_func');

function frudbaz_comment_form_defaults_func($info)
{
    if (!is_user_logged_in()) {
        $info['comment_field'] = '';
        $info['submit_field'] = '%1$s %2$s';
    } else {
        $info['comment_field'] = '<div class="row">
        <div class="col-12"><div class="post-input input-field"><textarea id="comment" name="comment" cols="30" rows="10" placeholder="' . esc_attr__('Type your comments...', 'frudbaz') . '"></textarea>';
        $info['submit_field'] = '%1$s %2$s</div></div>
        </div>';
    }

    $info['submit_button'] = '<div class="row">
        <div class="col-12"><div class="contact_btn text-center"><button class="thm_btn thm_btn-black" type="submit"><i class="fal fa-comments"></i> ' . esc_html__('Post Comment', 'frudbaz') . ' </button></div></div>
    </div>';

    $info['title_reply_before'] = '<div class="post_comment mt-30"><h3 class="comment_title">';
    $info['title_reply_after'] = '</h3></div>';
    $info['comment_notes_before'] = '';

    return $info;
}

if (!function_exists('frudbaz_comment')) {
    function frudbaz_comment($comment, $args, $depth)
    {
        $GLOBAL['comment'] = $comment;
        extract($args, EXTR_SKIP);
        $args['reply_text'] = '<i class="fas fa-reply"></i> Reply';
        $replayClass = 'comment-depth-' . esc_attr($depth);
        ?>
        <li id="comment-<?php comment_ID(); ?>">
            <div class="comments-box ">
                <div class="comment_author">
                    <?php print get_avatar($comment, 100, null, null, ['class' => []]); ?>
                </div>
                <div class="comment_content">
                    <div class="avatar-name">
                        <h6><?php print get_comment_author_link(); ?></h6>
                        <span class="date"><i
                                    class="fal fa-calendar-alt"></i> <?php comment_time(get_option('date_format')); ?></span>
                    </div>
                    <?php comment_text(); ?>
                    <?php comment_reply_link(array_merge($args, ['depth' => $depth, 'max_depth' => $args['max_depth']])); ?>
                </div>
            </div>
        </li>
        <?php
    }
}

/**
 * shortcode supports for removing extra p, spance etc
 *
 */
add_filter('the_content', 'frudbaz_shortcode_extra_content_remove');
/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @param string $content String of HTML content.
 * @return string $content Amended string of HTML content.
 * @since 1.0.0
 *
 */
function frudbaz_shortcode_extra_content_remove($content)
{

    $array = [
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br />' => ']',
    ];
    return strtr($content, $array);

}

// frudbaz_search_filter_form
if (!function_exists('frudbaz_search_filter_form')) {
    function frudbaz_search_filter_form($form)
    {

        $form = sprintf(
            '<form class="search_widget" action="%s" method="get">
      	<input type="text" value="%s" required name="s" placeholder="%s">
      	<button type="submit"><i class="fal fa-search"></i></button>
		</form>',
            esc_url(home_url('/')),
            esc_attr(get_search_query()),
            esc_html__('Search...', 'frudbaz')
        );

        return $form;
    }

    add_filter('get_search_form', 'frudbaz_search_filter_form');
}

add_action('admin_enqueue_scripts', 'frudbaz_admin_custom_scripts');

function frudbaz_admin_custom_scripts()
{
    wp_enqueue_media();
    wp_register_script('frudbaz-admin-custom', get_template_directory_uri() . '/inc/js/admin_custom.js', ['jquery'], '', true);
    wp_enqueue_script('frudbaz-admin-custom');
}

// enable_rtl
function frudbaz_enable_rtl()
{
    if (get_theme_mod('rtl_switch', false)) {
        return ' dir="rtl" ';
    } else {
        return '';
    }
}
