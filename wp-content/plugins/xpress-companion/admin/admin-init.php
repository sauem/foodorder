<?php

// define( 'APPILO_COMPANION_DIR', plugin_dir_path( __FILE__ ) );

if (file_exists( XPRESS_COMPANION_DIR. '/admin/admin-pages/admin.php')) {
    require_once XPRESS_COMPANION_DIR. '/admin/admin-pages/admin.php';
}

if (file_exists( XPRESS_COMPANION_DIR. '/admin/admin-pages/demo-import.php')) {
    require_once XPRESS_COMPANION_DIR. '/admin/admin-pages/demo-import.php';
}
