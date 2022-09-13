<?php
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
global $pagenow;

function nextbit_welcome_page() {
    require_once 'nextbit-welcome.php';
}

function nextbit_documentations_page() {
    require_once 'nextbit-documentations.php';
}

function nextbit_admin_menu() {
    if ( current_user_can( 'edit_theme_options' ) ) {
        add_menu_page(
        'CAFENA',
        'CAFENA',
        'administrator',
        'nextbit-admin-menu',
        'nextbit_welcome_page',
        XPRESS_COMPANION_URL . '/assets/images/logo.png', 4 );
        add_submenu_page( 'nextbit-admin-menu', 'xpress-companion', esc_html__( 'Welcome', 'xpress-companion' ), 'administrator', 'nextbit-admin-menu', 'nextbit_welcome_page' );
        add_submenu_page( 'nextbit-admin-menu', 'Theme Options', 'Theme Options', 'manage_options', 'customize.php' );

        add_submenu_page( 'nextbit-admin-menu', esc_html__( 'Demo Import', 'xpress-companion' ), esc_html__( 'Demo Import', 'xpress-companion' ), 'administrator', 'nextbit-demo-importer', 'nextbit_demo_importer_function' );
        add_submenu_page( 'nextbit-admin-menu', 'xpress-companion', esc_html__( 'Documentations', 'xpress-companion' ), 'administrator', 'nextbit-documentations', 'nextbit_documentations_page' );
    }
}
add_action( 'admin_menu', 'nextbit_admin_menu' );

function nextbit_demo_importer_function() {
    admin_url( 'admin.php?page=nextbit-demo-importer' );
}

// if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {

//     wp_redirect(admin_url("admin.php?page=nextbit-documentations"));

// }