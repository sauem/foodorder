<?php
namespace ElementHelper;

defined( 'ABSPATH' ) || die();

class Element_El_Icons {

      public static function init() {
        add_filter( 'elementor/icons_manager/additional_tabs', [ __CLASS__, 'add_elh_el_themify_tab' ] );
        add_filter( 'elementor/icons_manager/additional_tabs', [ __CLASS__, 'add_elh_el_icons_tab' ] );
        add_filter( 'elementor/icons_manager/additional_tabs', [ __CLASS__, 'add_elh_el_regular_icons_tab' ] );
        add_filter( 'elementor/icons_manager/additional_tabs', [ __CLASS__, 'add_elh_el_flat_icons_tab' ] );
      }

      public static function add_elh_el_icons_tab( $tabs ) {
        $tabs['element-helper-icons'] = [
            'name' => 'element-helper-icons',
            'label' => __( 'Fontawesome Pro Light', 'element-helper' ),
            'url' => ELH_ASSETS . 'fonts/css/fontawesome.pro.min.css',
            'enqueue' => [ ELH_ASSETS . 'fonts/css/fontawesome.pro.min.css' ],
            'prefix' => 'fa-',
            'displayPrefix' => 'fal',
            'labelIcon' => 'fal fa-icons-alt',
            'ver' => ELH_VERSION,
            'fetchJson' => ELH_ASSETS . 'fonts/elh-element-icons.js?v=' . ELH_VERSION,
            'native' => false,
        ];
        return $tabs;
      }

      public static function add_elh_el_themify_tab( $tabs ) {
        $tabs['element-helper-themify'] = [
            'name' => 'element-helper-themify',
            'label' => __( 'Themify', 'element-helper' ),
            'url' => ELH_ASSETS . 'fonts/css/themify.css',
            'enqueue' => [ ELH_ASSETS . 'fonts/css/themify.css' ],
            'prefix' => '',
            'displayPrefix' => '',
            'labelIcon' => 'fal fa-icons-alt',
            'ver' => ELH_VERSION,
            'fetchJson' => ELH_ASSETS . 'fonts/elh-element-themefy.js?v=' . ELH_VERSION,
            'native' => false,
        ];
        return $tabs;
      }

      public static function add_elh_el_regular_icons_tab( $tabs ) {

        $tabs['elh-el-regular-icons'] = [
            'name' => 'elh-el-regular-icons',
            'label' => __( 'Fontawesome Pro Regular', 'element-helper' ),
            'url' => ELH_ASSETS . 'fonts/css/fontawesome.pro.min.css',
            'enqueue' => [ ELH_ASSETS . 'fonts/css/fontawesome.pro.min.css' ],
            'prefix' => 'fa-',
            'displayPrefix' => 'far',
            'labelIcon' => 'fal fa-icons-alt',
            'ver' => ELH_VERSION,
            'fetchJson' => ELH_ASSETS . 'fonts/elh-element-regular-icons.js?v=' . ELH_VERSION,
            'native' => false,
        ];

        return $tabs;
      }

      public static function add_elh_el_flat_icons_tab( $tabs ) {
        $tabs['element-helper-flaticons'] = [
            'name' => 'element-helper-flat-icons',
            'label' => __( 'FlatIcons', 'element-helper' ),
            'url' => ELH_ASSETS . 'fonts/css/flaticon.css',
            'enqueue' => [ ELH_ASSETS . 'fonts/css/flaticon.css' ],
            'prefix' => '',
            'displayPrefix' => '',
            'labelIcon' => 'fal fa-dolly-flatbed-alt',
            'ver' => ELH_VERSION,
            'fetchJson' => ELH_ASSETS . 'fonts/elh-element-flaticons.js?v=' . ELH_VERSION,
            'native' => false,
        ];
        return $tabs;
      }

}