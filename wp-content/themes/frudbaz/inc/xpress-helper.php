<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package frudbaz
 */

/**
 *
 * frudbaz header
 */

function frudbaz_check_header() {
    $frudbaz_header_style = function_exists( 'get_field' ) ? get_field( 'header_style' ) : NULL;
    $frudbaz_default_header_style = get_theme_mod( 'choose_default_header', 'header-style-1' );

    if ( $frudbaz_header_style == 'header-style-1' ) {
        frudbaz_header_style_1();
    } elseif ( $frudbaz_header_style == 'header-style-2' ) {
        frudbaz_header_style_2();
    } elseif ( $frudbaz_header_style == 'header-style-3' ) {
        frudbaz_header_style_3();
    } else {

        /** default header style **/
        if ( $frudbaz_default_header_style == 'header-style-2' ) {
            frudbaz_header_style_2();
        } elseif ( $frudbaz_default_header_style == 'header-style-3' ) {
            frudbaz_header_style_3();
        } else {
            frudbaz_header_style_1();
        }
    }

}
add_action( 'frudbaz_header_style', 'frudbaz_check_header', 10 );

/**
 * header style 1 + default
 */
function frudbaz_header_style_1() {

    $frudbaz_login_button_link = get_theme_mod( 'frudbaz_login_button_link', __( '#', 'frudbaz' ) );

    $frudbaz_header_right = get_theme_mod( 'frudbaz_header_right', false );
    $frudbaz_search = get_theme_mod( 'frudbaz_search', false );
    $frudbaz_cart = get_theme_mod( 'frudbaz_cart', false );
    $frudbaz_wishlist = get_theme_mod( 'frudbaz_wishlist', false );
    $frudbaz_menu_col = $frudbaz_header_right ? 'col-xl-7 col-lg-7 d-none d-lg-block' : 'col-xl-10 col-lg-10 col-6';
    $frudbaz_menu_right = $frudbaz_header_right ? '' : 'text-right justify-content-end';

    ?>

    <header class="header_area header_2">
        <div class="header_wrap header_space" data-uk-sticky="top: 250; animation: uk-animation-slide-top;">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-2 col-6">
                        <div class="logo">
                            <?php frudbaz_header_logo();?>
                        </div>
                    </div>
                    <div class="<?php print esc_attr($frudbaz_menu_col); ?>">
                        <div class="main_menu_wrap navbar navbar-expand-lg">
                            <nav class="main_menu collapse navbar-collapse <?php print esc_attr( $frudbaz_menu_right ); ?>">
                                <?php frudbaz_header_menu(); ?>
                            </nav>
                            <?php if($frudbaz_header_right == false ) : ?>
                            <div class="header_carts ul_li d-block d-lg-none">
                                <div class="hamburger_menu">
                                    <a href="javascript:void(0);">
                                        <div class="icon bar">
                                            <span><i class="fal fa-bars"></i></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if($frudbaz_header_right == true) : ?>
                    <div class="col-xl-3 col-lg-3 col-6">
                        <div class="header_right ul_li_right">
                            <div class="header_carts ul_li">
                                <?php if($frudbaz_search == true) : ?>
                                <div class="header_search_wrap">
                                    <div class="icon search_main">
                                        <i class="fal fa-search"></i>
                                        <span><i class="fal fa-times"></i></span>
                                    </div>
                                    <div class="search_form_main">
                                        <?php frudbaz_header_search_form(); ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="hamburger_menu">
                                    <a href="javascript:void(0);">
                                        <?php if( FRUDBAZ_WOOCOMMERCE_ACTIVED ) : ?>
                                        <?php if($frudbaz_cart == true ) : ?>
                                            <div class="icon cart_btn d-none d-lg-block">
                                                <i class="fal fa-shopping-basket"></i>
                                                <small class="cart_counter" id="frudbaz-cart-count"><?php echo esc_html(WC()->cart->cart_contents_count); ?></small>
                                            </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <div class="icon bar d-lg-none">
                                            <span><i class="fal fa-bars"></i></span>
                                        </div>
                                    </a>
                                </div>
                                <?php
                                    if( FRUDBAZ_WOOCOMMERCE_ACTIVED AND FRUDBAZ_WISHLIST_ACTIVED ) :
                                    $frudbaz_wishlist_url = get_permalink(get_option('yith_wcwl_wishlist_page_id'));
                                ?>
                                    <?php if($frudbaz_wishlist == true ) : ?>
                                    <a class="icon cart_wishlist" href="<?php print esc_url($frudbaz_wishlist_url); ?>">
                                        <i class="fal fa-heart"></i>
                                        <small class="wish-count"><?php echo yith_wcwl_count_all_products(); ?></small>
                                    </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
    <?php frudbaz_side_info(); ?>
<?php
}

/**
 * header style 2
 */
function frudbaz_header_style_2() {

    $frudbaz_header_right = get_theme_mod( 'frudbaz_header_right', false );
    $frudbaz_search = get_theme_mod( 'frudbaz_search', false );
    $frudbaz_cart = get_theme_mod( 'frudbaz_cart', false );
    $frudbaz_wishlist = get_theme_mod( 'frudbaz_wishlist', false );
    $frudbaz_menu_col = $frudbaz_header_right ? 'col-lg-10 col-6' : 'col-lg-10 col-6';
    $frudbaz_menu_right = $frudbaz_header_right ? '' : 'text-right justify-content-end';

    ?>

    <header class="header_area header_1 transparent_header">
        <div class="header_wrap header_space" data-uk-sticky="top: 250; animation: uk-animation-slide-top;">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-6">
                        <div class="logo">
                            <?php frudbaz_header_logo();?>
                        </div>
                    </div>
                    <div class="<?php print esc_attr($frudbaz_menu_col); ?>">
                        <div class="main_menu_wrap navbar navbar-expand-lg">
                            <nav class="main_menu collapse navbar-collapse <?php print esc_attr( $frudbaz_menu_right ); ?>">
                                <?php frudbaz_header_menu(); ?>
                            </nav>
                            <?php if($frudbaz_header_right == false ) : ?>
                            <div class="header_carts ul_li d-block d-lg-none">
                                <div class="hamburger_menu">
                                    <a href="javascript:void(0);">
                                        <div class="icon bar">
                                            <span><i class="fal fa-bars"></i></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if($frudbaz_header_right == true) : ?>
                            <div class="header_right ul_li_right">
                                <?php if($frudbaz_search == true) : ?>
                                <div class="search_box">
                                    <?php frudbaz_header_search_form(); ?>
                                </div>
                                <?php endif; ?>
                                <div class="header_carts ul_li">
                                    <div class="hamburger_menu">
                                        <a href="javascript:void(0);">
                                            <?php if( FRUDBAZ_WOOCOMMERCE_ACTIVED ) : ?>
                                                <?php if($frudbaz_cart == true ) : ?>
                                                <div class="icon cart_btn d-none d-lg-block">
                                                    <i class="fal fa-shopping-basket"></i>
                                                    <small class="cart_counter" id="frudbaz-cart-count"><?php echo esc_html(WC()->cart->cart_contents_count); ?></small>
                                                </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <div class="icon bar d-lg-none">
                                                <span><i class="fal fa-bars"></i></span>
                                            </div>
                                        </a>
                                    </div>
                                    <?php
                                    if( FRUDBAZ_WOOCOMMERCE_ACTIVED AND FRUDBAZ_WISHLIST_ACTIVED ) :
                                        $frudbaz_wishlist_url = get_permalink(get_option('yith_wcwl_wishlist_page_id'));
                                    ?>
                                        <?php if($frudbaz_wishlist == true ) : ?>
                                        <a class="icon cart_wishlist" href="<?php print esc_url($frudbaz_wishlist_url); ?>">
                                            <i class="fal fa-heart"></i>
                                            <small class="wish-count"><?php echo yith_wcwl_count_all_products(); ?></small>
                                        </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?php frudbaz_side_info(); ?>
<?php
}

/**
 * header style 3
 */
function frudbaz_header_style_3() {

    $frudbaz_header_right = get_theme_mod( 'frudbaz_header_right', false );
    $frudbaz_search = get_theme_mod( 'frudbaz_search', false );
    $frudbaz_cart = get_theme_mod( 'frudbaz_cart', false );
    $frudbaz_wishlist = get_theme_mod( 'frudbaz_wishlist', false );
    $frudbaz_menu_col = $frudbaz_header_right ? 'col-lg-7 d-none d-lg-block' : 'col-lg-10 col-6';
    $frudbaz_menu_right = $frudbaz_header_right ? '' : 'text-right justify-content-end';

    ?>

    <header class="header_area header_3 transparent_header">
        <div class="header_wrap header_space" data-uk-sticky="top: 250; animation: uk-animation-slide-top;">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-6">
                        <div class="logo">
                            <?php frudbaz_header_sticky_logo();?>
                        </div>
                    </div>
                    <div class="<?php print esc_attr($frudbaz_menu_col); ?>">
                        <div class="main_menu_wrap navbar navbar-expand-lg">
                            <nav class="main_menu collapse navbar-collapse <?php print esc_attr( $frudbaz_menu_right ); ?>">
                                <?php frudbaz_header_menu(); ?>
                            </nav>
                            <?php if($frudbaz_header_right == false ) : ?>
                            <div class="header_carts ul_li d-block d-lg-none">
                                <div class="hamburger_menu">
                                    <a href="javascript:void(0);">
                                        <div class="icon bar">
                                            <span><i class="fal fa-bars"></i></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if($frudbaz_header_right == true) : ?>
                    <div class="col-lg-3 col-6">
                        <div class="header_right ul_li_right">
                            <div class="header_carts ul_li">
                                <?php if($frudbaz_search == true) : ?>
                                <div class="header_search_wrap">
                                    <div class="icon search_main">
                                        <i class="fal fa-search"></i>
                                        <span><i class="fal fa-times"></i></span>
                                    </div>
                                    <div class="search_form_main">
                                        <?php frudbaz_header_search_form(); ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="hamburger_menu">
                                    <a href="javascript:void(0);">
                                        <?php if( FRUDBAZ_WOOCOMMERCE_ACTIVED ) : ?>
                                            <?php if($frudbaz_cart == true ) : ?>
                                            <div class="icon cart_btn d-none d-lg-block">
                                                <i class="fal fa-shopping-basket"></i>
                                                <small class="cart_counter" id="frudbaz-cart-count"><?php echo esc_html(WC()->cart->cart_contents_count); ?></small>
                                            </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <div class="icon bar d-lg-none">
                                            <span><i class="fal fa-bars"></i></span>
                                        </div>
                                    </a>
                                </div>
                                <?php
                                    if( FRUDBAZ_WOOCOMMERCE_ACTIVED AND FRUDBAZ_WISHLIST_ACTIVED ) :
                                    $frudbaz_wishlist_url = get_permalink(get_option('yith_wcwl_wishlist_page_id'));
                                ?>
                                    <?php if($frudbaz_wishlist == true ) : ?>
                                    <a class="icon cart_wishlist" href="<?php print esc_url($frudbaz_wishlist_url); ?>">
                                        <i class="fal fa-heart"></i>
                                        <small class="wish-count"><?php echo yith_wcwl_count_all_products(); ?></small>
                                    </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
    <?php frudbaz_side_info(); ?>
<?php
}

// frudbaz_side_info
function frudbaz_side_info() {

    $frudbaz_side_hide = get_theme_mod( 'frudbaz_side_hide', false );
    $frudbaz_extra_about_title = get_theme_mod( 'frudbaz_extra_about_title', __( 'About us', 'frudbaz' ) );
    $frudbaz_extra_about_text = get_theme_mod( 'frudbaz_extra_about_text', __( 'About Us Desc..', 'frudbaz' ) );
    $frudbaz_extra_button = get_theme_mod( 'frudbaz_extra_button', __( 'Contact us', 'frudbaz' ) );
    $frudbaz_extra_button_url = get_theme_mod( 'frudbaz_extra_button_url', __( '#', 'frudbaz' ) );
    $frudbaz_contact_title = get_theme_mod( 'frudbaz_contact_title', __( 'Contact us', 'frudbaz' ) );
    $frudbaz_extra_address = get_theme_mod( 'frudbaz_extra_address', __( 'Bowery St., New York, NY 10013, USA', 'frudbaz' ) );
    $frudbaz_extra_phone = get_theme_mod( 'frudbaz_extra_phone', __( '+1255-568-6523', 'frudbaz' ) );
    $frudbaz_extra_email = get_theme_mod( 'frudbaz_extra_email', __( 'information@gmail.com', 'frudbaz' ) );
    $frudbaz_cart = get_theme_mod( 'frudbaz_cart', false );
    ?>

    <!-- slide bar start -->
    <aside class="slide-bar">
        <div class="close-mobile-menu">
            <a href="javascript:void(0);"><i class="fal fa-times"></i></a>
        </div>
        <?php if($frudbaz_cart == true ) : ?>
        <?php print frudbaz_shopping_cart(); ?>
        <?php endif; ?>
        <nav class="side-mobile-menu">
            <div class="header-mobile-search">
                <?php frudbaz_header_search_form(); ?>
            </div>
            <?php frudbaz_header_menu(); ?>
        </nav>
    </aside>
    <!-- slide bar end -->


<?php }

/**
 * [frudbaz_header_lang description]
 * @return [type] [description]
 */
function frudbaz_header_lang_defualt() {
    $frudbaz_header_lang = get_theme_mod( 'frudbaz_header_lang', false );
    if ( $frudbaz_header_lang ): ?>
    <ul>
        <li><a href="#0" class="lang_btn"><?php print esc_html__( 'English', 'frudbaz' );?> <i class="fal fa-chevron-down"></i></a>
            <?php do_action( 'frudbaz_language' );?>
        </li>
    </ul>
    <?php endif;?>
<?php
}

/**
 * [frudbaz_language_list description]
 * @return [type] [description]
 */
function _frudbaz_language( $mar ) {
    return $mar;
}
function frudbaz_language_list() {

    $mar = '';
    $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );
    if ( !empty( $languages ) ) {
        $mar = '<ul class="lang-list lang_sub_list">';
        foreach ( $languages as $lan ) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="lang-sub-list lang_sub_list">';
        $mar .= '<li><a href="#">' . esc_html__( 'Bangla', 'frudbaz' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'Arabic', 'frudbaz' ) . '</a></li>';
        $mar .= ' </ul>';
    }
    print _frudbaz_language( $mar );
}
add_action( 'frudbaz_language', 'frudbaz_language_list' );

// favicon logo
function frudbaz_favicon_logo_func() {
        $frudbaz_favicon = get_template_directory_uri() . '/assets/img/favicon.png';
        $frudbaz_favicon_url = get_theme_mod( 'favicon_url', $frudbaz_favicon );
    ?>

    <link rel="shortcut icon" type="image/x-icon" href="<?php print esc_url( $frudbaz_favicon_url );?>">

    <?php
}
add_action( 'wp_head', 'frudbaz_favicon_logo_func' );

// header logo
function frudbaz_header_logo() {
    ?>
    <?php
        $frudbaz_logo_on = function_exists( 'get_field' ) ? get_field( 'is_enable_sec_logo' ) : NULL;
        $frudbaz_logo = get_template_directory_uri() . '/assets/img/logo/logo.png';
        $frudbaz_logo_white = get_template_directory_uri() . '/assets/img/logo/logo_white.png';

        $frudbaz_site_logo = get_theme_mod( 'logo', $frudbaz_logo );
        $frudbaz_secondary_logo = get_theme_mod( 'seconday_logo', $frudbaz_logo_white );
    ?>

        <?php
            if ( has_custom_logo() ) {
                the_custom_logo();
            } else {
                if ( !empty( $frudbaz_logo_on ) ) {
                    ?>
                        <a class="standard-logo" href="<?php print esc_url( home_url( '/' ) );?>">
                            <img src="<?php print esc_url( $frudbaz_secondary_logo );?>" alt="<?php print esc_attr( 'logo', 'frudbaz' );?>" />
                        </a>
                    <?php
                } else {
                    ?>
                        <a class="standard-logo" href="<?php print esc_url( home_url( '/' ) );?>">
                            <img src="<?php print esc_url( $frudbaz_site_logo );?>" alt="<?php print esc_attr( 'logo', 'frudbaz' );?>" />
                        </a>
                    <?php
                }
            }
        ?>
    <?php
}

// header logo
function frudbaz_header_sticky_logo() {
    ?>
    <?php
        $frudbaz_logo_on = function_exists( 'get_field' ) ? get_field( 'is_enable_sec_logo' ) : NULL;
        $frudbaz_logo = get_template_directory_uri() . '/assets/img/logo/logo.png';
        $frudbaz_logo_white = get_template_directory_uri() . '/assets/img/logo/logo_white.png';

        $frudbaz_site_logo = get_theme_mod( 'logo', $frudbaz_logo );
        $frudbaz_secondary_logo = get_theme_mod( 'seconday_logo', $frudbaz_logo_white );
    ?>

        <?php
            if ( has_custom_logo() ) {
                the_custom_logo();
            } else {
                if ( !empty( $frudbaz_logo_on ) ) {
                    ?>
                        <a class="standard-logo" href="<?php print esc_url( home_url( '/' ) );?>">
                            <img src="<?php print esc_url( $frudbaz_secondary_logo );?>" alt="<?php print esc_attr( 'logo', 'frudbaz' );?>" />
                            <img src="<?php print esc_url( $frudbaz_site_logo );?>" alt="<?php print esc_attr( 'logo', 'frudbaz' );?>" />
                        </a>
                    <?php
                } else {
                    ?>
                        <a class="standard-logo" href="<?php print esc_url( home_url( '/' ) );?>">
                            <img src="<?php print esc_url( $frudbaz_site_logo );?>" alt="<?php print esc_attr( 'logo', 'frudbaz' );?>" />
                        </a>
                    <?php
                }
            }
        ?>
    <?php
}

function frudbaz_mobile_logo() {
    // side info
    $frudbaz_mobile_logo_hide = get_theme_mod( 'frudbaz_mobile_logo_hide', false );

    $frudbaz_site_logo = get_theme_mod( 'logo', get_template_directory_uri() . '/assets/img/logo/logo.png' );

    ?>

    <?php if ( !empty( $frudbaz_mobile_logo_hide ) ): ?>
    <div class="side__logo mb-25">
        <a class="sideinfo-logo" href="<?php print esc_url( home_url( '/' ) );?>">
            <img src="<?php print esc_url( $frudbaz_site_logo );?>" alt="<?php print esc_attr( 'logo', 'frudbaz' );?>" />
        </a>
    </div>
    <?php endif;?>



<?php }

function frudbaz_footer_logo() {
    // side info
    $frudbaz_footer_logo_hide = get_theme_mod( 'frudbaz_footer_logo_hide', false );

    $frudbaz_footer_logo = get_theme_mod( 'frudbaz_footer_logo', get_template_directory_uri() . '/assets/img/logo/logo_white.png' );

    ?>

    <?php if ( !empty( $frudbaz_footer_logo_hide ) ): ?>
    <a href="<?php print esc_url( home_url( '/' ) );?>"><img src="<?php print esc_url( $frudbaz_footer_logo );?>" alt="img"></a>
    <?php endif;?>



<?php }

/**
 * [frudbaz_header_social_profiles description]
 * @return [type] [description]
 */
function frudbaz_header_social_profiles() {
    $frudbaz_topbar_fb_url = get_theme_mod( 'frudbaz_topbar_fb_url', __( '#', 'frudbaz' ) );
    $frudbaz_topbar_twitter_url = get_theme_mod( 'frudbaz_topbar_twitter_url', __( '#', 'frudbaz' ) );
    $frudbaz_topbar_google_url = get_theme_mod( 'frudbaz_topbar_google_url', __( '#', 'frudbaz' ) );
    $frudbaz_topbar_instagram_url = get_theme_mod( 'frudbaz_topbar_instagram_url', __( '#', 'frudbaz' ) );
    $frudbaz_topbar_linkedin_url = get_theme_mod( 'frudbaz_topbar_linkedin_url', __( '', 'frudbaz' ) );
    $frudbaz_topbar_youtube_url = get_theme_mod( 'frudbaz_topbar_youtube_url', __( '', 'frudbaz' ) );
    ?>
    <div class="sidebar-social mt-20">
        <?php if ( !empty( $frudbaz_topbar_fb_url ) ): ?>
        <a target="_blank" href="<?php print esc_url( $frudbaz_topbar_fb_url );?>"><i class="fab fa-facebook-f"></i></a>
        <?php endif;?>
        <?php if ( !empty( $frudbaz_topbar_twitter_url ) ): ?>
        <a target="_blank" href="<?php print esc_url( $frudbaz_topbar_twitter_url );?>"><i class="fab fa-twitter"></i></a>
        <?php endif;?>
        <?php if ( !empty( $frudbaz_topbar_google_url ) ): ?>
        <a target="_blank" href="<?php print esc_url( $frudbaz_topbar_google_url );?>"><i class="fab fa-google-plus-g"></i></a>
        <?php endif;?>
        <?php if ( !empty( $frudbaz_topbar_instagram_url ) ): ?>
        <a target="_blank" href="<?php print esc_url( $frudbaz_topbar_instagram_url );?>"><i class="fab fa-instagram"></i></a>
        <?php endif;?>
        <?php if ( !empty( $frudbaz_topbar_linkedin_url ) ): ?>
        <a target="_blank" href="<?php print esc_url( $frudbaz_topbar_linkedin_url );?>"><span><i class="fab fa-linkedin"></i></span></a>
        <?php endif;?>
        <?php if ( !empty( $frudbaz_topbar_youtube_url ) ): ?>
        <a target="_blank" href="<?php print esc_url( $frudbaz_topbar_youtube_url );?>"><span><i class="fab fa-youtube"></i></span></a>
        <?php endif;?>
    </div>

<?php
}

function frudbaz_footer_social_profiles() {
    $socialdefaults = [
        [
            'default' => [
                [
                    'social_profile_name' => esc_html__( 'facebook-f', 'frudbaz' ),
                    'social_profile_link'  => '#',
                ],
                [
                    'social_profile_name' => esc_html__( 'twitter', 'frudbaz' ),
                    'social_profile_link'  => '#',
                ],
                [
                    'social_profile_name' => esc_html__( 'youtube', 'frudbaz' ),
                    'social_profile_link'  => '#',
                ],
                [
                    'social_profile_name' => esc_html__( 'instagram', 'frudbaz' ),
                    'social_profile_link'  => '#',
                ],
            ],
        ]
    ];

    $footer_social_links = get_theme_mod( 'footer_social_links', $socialdefaults );

    ?>

    <div class="social_links text-lg-end">
        <?php foreach($footer_social_links as $footer_social_link) : ?>
            <a href="<?php print esc_url( $footer_social_link['social_profile_link'] );?>">
                <i class="fab fa-<?php print esc_attr( $footer_social_link['social_profile_name'] );?>"></i>
            </a>
        <?php endforeach; ?>
    </div>

<?php
}

/**
 * [frudbaz_header_menu description]
 * @return [type] [description]
 */
function frudbaz_header_menu() {
    ?>
    <?php
        wp_nav_menu( [
            'theme_location' => 'main-menu',
            'menu_class'     => 'main_menu_list ul_li',
            'container'      => '',
            'fallback_cb'    => 'Navwalker_Class::fallback',
            'walker'         => new Navwalker_Class,
        ] );
    ?>
    <?php
}

/**
 * [frudbaz_header_menu description]
 * @return [type] [description]
 */
function frudbaz_mobile_menu() {
    ?>
    <?php
        $frudbaz_menu = wp_nav_menu( [
            'theme_location' => 'main-menu',
            'menu_class'     => '',
            'container'      => '',
            'menu_id'        => 'mobile-menu-active',
            'echo'           => false,
        ] );

    $frudbaz_menu = str_replace( "menu-item-has-children", "menu-item-has-children has-children", $frudbaz_menu );
        echo wp_kses_post( $frudbaz_menu );
    ?>
    <?php
}

/**
 * [frudbaz_header_menu description]
 * @return [type] [description]
 */
//  Main Menu left (Header style 2)
 function frudbaz_header_menu_left() {
    wp_nav_menu( [
        'theme_location' => 'main-menu-left',
        'menu_class'     => '',
        'container'      => '',
        'fallback_cb'    => 'Navwalker_Class::fallback',
        'walker'         => new Navwalker_Class,
    ] );
}

// Main Menu Right (Header style 2)
 function frudbaz_header_menu_right() {
    wp_nav_menu( [
        'theme_location' => 'main-menu-right',
        'menu_class'     => '',
        'container'      => '',
        'fallback_cb'    => 'Navwalker_Class::fallback',
        'walker'         => new Navwalker_Class,
    ] );
}

/**
 * [frudbaz_footer_menu description]
 * @return [type] [description]
 */

function frudbaz_footer_menu() {
    wp_nav_menu( [
        'theme_location' => 'footer-menu',
        'menu_class'     => 'footer_links',
        'container'      => '',
        'fallback_cb'    => 'Navwalker_Class::fallback',
        'walker'         => new Navwalker_Class,
    ] );
}


/**
 *
 * frudbaz footer
 */
add_action( 'frudbaz_footer_style', 'frudbaz_check_footer', 10 );

add_action( 'frudbaz_footer_newslater_hook', 'frudbaz_footer_newslater', 10 );

function frudbaz_check_footer() {
    $frudbaz_footer_style = function_exists( 'get_field' ) ? get_field( 'footer_style' ) : NULL;
    $frudbaz_default_footer_style = get_theme_mod( 'choose_default_footer', 'footer-style-1' );

    if ( $frudbaz_footer_style == 'footer-style-1' ) {
        frudbaz_footer_style_1();
    } elseif ( $frudbaz_footer_style == 'footer-style-2' ) {
        frudbaz_footer_style_2();
    } elseif ( $frudbaz_footer_style == 'footer-style-3' ) {
        frudbaz_footer_style_3();
    } else {

        /** default footer style **/
        if ( $frudbaz_default_footer_style == 'footer-style-2' ) {
            frudbaz_footer_style_2();
        } elseif ( $frudbaz_default_footer_style == 'footer-style-3' ) {
            frudbaz_footer_style_3();
        } else {
            frudbaz_footer_style_1();
        }

    }
}

/**
 * footer  style_defaut
 */
function frudbaz_footer_style_1() {

    $footer_bg_img = get_theme_mod( 'frudbaz_footer_bg' );
    $frudbaz_footer_logo = get_theme_mod( 'frudbaz_footer_logo' );
    $frudbaz_copyright_center = $frudbaz_footer_logo ? 'col-lg-4 offset-lg-4 col-md-6 text-right' : 'col-lg-12 text-center';
    $frudbaz_footer_bg_url_from_page = function_exists( 'get_field' ) ? get_field( 'frudbaz_footer_bg' ) : '';
    $frudbaz_footer_bg_color_from_page = function_exists( 'get_field' ) ? get_field( 'frudbaz_footer_bg_color', '#1E1D23' ) : '';
    $footer_bg_color = get_theme_mod( 'frudbaz_footer_bg_color', '#1E1D23' );
    $footer_copyright_switch = get_theme_mod( 'footer_copyright_switch', true );
    $footer_social_switch = get_theme_mod( 'footer_social_switch', false );

    // bg image
    $bg_img = !empty( $frudbaz_footer_bg_url_from_page['url'] ) ? $frudbaz_footer_bg_url_from_page['url'] : $footer_bg_img;

    // bg color
    $bg_color = !empty( $frudbaz_footer_bg_color_from_page ) ? $frudbaz_footer_bg_color_from_page : $footer_bg_color;

    // footer_columns
    $footer_columns = 0;
    $footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

    for ( $num = 1; $num <= $footer_widgets; $num++ ) {
        if ( is_active_sidebar( 'footer-' . $num ) ) {
            $footer_columns++;
        }
    }

    switch ( $footer_columns ) {
    case '1':
        $footer_class[1] = 'col-lg-12';
        break;
    case '2':
        $footer_class[1] = 'col-lg-6 col-md-6';
        $footer_class[2] = 'col-lg-6 col-md-6';
        break;
    case '3':
        $footer_class[1] = 'col-xl-4 col-lg-6 col-md-6';
        $footer_class[2] = 'col-xl-4 col-lg-6 col-md-6';
        $footer_class[3] = 'col-xl-4 col-lg-6 col-md-6';
        break;
    case '4':
        $footer_class[1] = 'col-lg-4 col-md-6';
        $footer_class[2] = 'col-lg-3 col-md-6';
        $footer_class[3] = 'col-lg-2 col-md-6';
        $footer_class[4] = 'col-lg-3 col-md-6';
        break;
    default:
        $footer_class = 'col-xl-3 col-lg-6 col-md-6';
        break;
    }

    ?>

    <footer class="footer-area footer_bg" data-bg-color="<?php print esc_attr($bg_color); ?>" data-background="<?php print esc_url($bg_img); ?>">
        <?php if(FRUDBAZ_COMPANION_ACTIVED) : ?>
        <?php frudbaz_footer_newslater(); ?>
        <?php endif; ?>

        <?php if ( is_active_sidebar('footer-1') OR is_active_sidebar('footer-2') OR is_active_sidebar('footer-3') OR is_active_sidebar('footer-4') ): ?>
        <div class="footer_main pt-100 pb-90">
            <div class="container">
                <div class="row mt-none-40">
                <?php
                    if ( $footer_columns < 4 ) {
                        print '<div class="col-lg-4 col-md-6">';
                        dynamic_sidebar( 'footer-1');
                        print '</div>';

                        print '<div class="col-lg-3 col-md-6">';
                        dynamic_sidebar( 'footer-2');
                        print '</div>';

                        print '<div class="col-lg-2 col-md-6">';
                        dynamic_sidebar( 'footer-3');
                        print '</div>';

                        print '<div class="col-lg-3 col-md-6">';
                        dynamic_sidebar( 'footer-4');
                        print '</div>';

                    }
                    else{
                        for( $num=1; $num <= $footer_columns; $num++ ) {
                            if ( !is_active_sidebar( 'footer-'. $num ) ) continue;
                            print '<div class="' . esc_attr( $footer_class[$num] ) . '">';
                                dynamic_sidebar( 'footer-'. $num );
                            print '</div>';
                        }
                    }
                ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="footer_bottom">
            <div class="container">
                <div class="copyright_wrap">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-3">
                            <div class="logo">
                                <?php frudbaz_footer_logo(); ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-9">
                            <?php if(!empty($footer_copyright_switch)) : ?>
                            <div class="copyright text-md-center">
                                <p><?php print frudbaz_copyright_text(); ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-3 col-md-12">
                            <?php if($footer_social_switch == true ) : ?>
                            <?php frudbaz_footer_social_profiles(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<?php
}




// frudbaz_copyright_text
function frudbaz_copyright_text() {
    if ( rtl_enable() ) {
        print get_theme_mod( 'frudbaz_copyright_rtl', __( 'Copy Right &copy; Example 2022.Design By XpressRow', 'frudbaz' ) );
    } else {
        print get_theme_mod( 'frudbaz_copyright', __( 'Copy Right &copy; Example 2022.Design By XpressRow', 'frudbaz' ) );
    }
}

/**
 * [frudbaz_breadcrumb description]
 * @return [type] [description]
 */
function frudbaz_breadcrumb() {

    $wpbreadcrumb_class = '';
    $breadcrumb_show = 1;

    $id = get_the_ID();

    if ( is_front_page() && is_home() ) {
        $title = get_theme_mod( 'breadcrumb_blog_title', __( 'Blog', 'frudbaz' ) );
        $wpbreadcrumb_class = 'home_front_page';
    } elseif ( is_front_page() ) {
        $title = get_theme_mod( 'breadcrumb_blog_title', __( 'Blog', 'frudbaz' ) );
        $breadcrumb_show = 0;

    } elseif ( is_home() ) {
        if ( get_option( 'page_for_posts' ) ) {
            $id = get_option( 'page_for_posts' );
            $title = get_the_title( get_option( 'page_for_posts' ) );
        }
    } elseif ( is_single() && 'post' == get_post_type() ) {
        if ( rtl_enable() ) {
            $title = get_theme_mod( 'breadcrumb_blog_title_details_rtl', __( 'Blog', 'frudbaz' ) );
        } else {
            $title = get_the_title();
        }
    } elseif ( is_search() ) {
        $title = esc_html__( 'Search Results for : ', 'frudbaz' ) . get_search_query();
    } elseif ( is_404() ) {
        $title = esc_html__( 'Page not Found', 'frudbaz' );
    } elseif ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
        $title = get_theme_mod( 'breadcrumb_shop', __( 'Shop', 'frudbaz' ) );
    } elseif ( is_archive() ) {
        $title = get_the_archive_title();
    } else {
        $title = get_the_title();
    }

    $is_breadcrumb = function_exists( 'get_field' ) ? get_field( 'is_it_invisible_breadcrumb' ) : '';

    if ( empty( $is_breadcrumb ) && $breadcrumb_show == 1 ) {

        $bg_img_from_page = function_exists('get_field') ? get_field('breadcrumb_background_image', $id) : '';
        $hide_bg_img = function_exists('get_field') ? get_field('hide_breadcrumb_background_image', $id) : '';

        // get_theme_mod
        $bg_img = get_theme_mod( 'breadcrumb_bg_img', get_template_directory_uri() . '/assets/img/bg/page_title.jpg' );
        $breadcrumb_right_img = get_theme_mod( 'breadcrumb_right_img' );
        $breadcrumb_icon_img = get_theme_mod( 'breadcrumb_icon_img' );
        $bg_color = get_theme_mod( 'frudbaz_breadcrumb_bg_color' );
        $frudbaz_breadcrumb_top_spacing = get_theme_mod( 'frudbaz_breadcrumb_top_spacing', esc_html__( '155', 'frudbaz' ) );
        $frudbaz_breadcrumb_bottom_spacing = get_theme_mod( 'frudbaz_breadcrumb_bottom_spacing', esc_html__( '175', 'frudbaz' ) );

        if ( $hide_bg_img ) {
            $bg_img = '';
        } else {
            $bg_img = !empty( $bg_img_from_page ) ? $bg_img_from_page['url'] : $bg_img;
        }

        ?>

        <!-- page title start -->
        <section class="page_title_area pt-<?php print esc_attr($frudbaz_breadcrumb_top_spacing); ?> pb-<?php print esc_attr($frudbaz_breadcrumb_bottom_spacing); ?> <?php print esc_attr( $wpbreadcrumb_class );?>" data-bg-color="<?php print esc_attr($bg_color); ?>" data-background="<?php print esc_attr($bg_img);?>">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="page_title">
                            <h1><?php echo wp_kses_post( $title ); ?></h1>
                            <?php frudbaz_breadcrumb_callback();?>
                        </div>
                    </div>
                    <?php if(!empty($breadcrumb_right_img)) : ?>
                    <div class="col-lg-4">
                        <div class="page_title_img">
                            <img src="<?php print esc_url($breadcrumb_right_img); ?>" alt="<?php echo esc_html__('img', 'frudbaz'); ?>">
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php if(!empty($breadcrumb_icon_img)) : ?>
            <div class="breadcrumb_icon_wrap">
                <div class="container">
                    <div class="breadcrumb_icon">
                        <img src="<?php print esc_url($breadcrumb_icon_img); ?>" alt="<?php echo esc_html__('img', 'frudbaz'); ?>">
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </section>
        <?php
}
}
add_action( 'frudbaz_before_main_content', 'frudbaz_breadcrumb' );

function frudbaz_breadcrumb_callback() {
    $args = [
        'show_browse'   => false,
        'post_taxonomy' => ['product' => 'product_cat'],
    ];
    $breadcrumb = new WpBreadcrumb_Class( $args );

    return $breadcrumb->trail();
}

// frudbaz_search_form
function frudbaz_header_search_form() {
    ?>
        <form role="search" method="get" action="<?php print esc_url( home_url( '/' ) );?>">
            <input type="search" name="s" value="<?php print esc_attr( get_search_query() )?>" placeholder="<?php print esc_attr( 'Search Keywords', 'frudbaz' );?>">
            <button type="submit"><i class="ti-search"></i></button>
        </form>

    <?php
}

function frudbaz_search_form() {
    ?>
        <div class="search-wrapper p-relative transition-3 d-none">
            <div class="search-form transition-3">
                <form method="get" action="<?php print esc_url( home_url( '/' ) );?>" >
                    <input type="search" name="s" value="<?php print esc_attr( get_search_query() )?>" placeholder="<?php print esc_attr( 'Enter Your Keyword', 'frudbaz' );?>" >
                    <button type="submit" class="search-btn"><i class="far fa-search"></i></button>
                </form>
                <a href="javascript:void(0);" class="search-close"><i class="far fa-times"></i></a>
            </div>
        </div>

    <?php
}

add_action( 'frudbaz_before_main_content', 'frudbaz_search_form' );

/**
 *
 * pagination
 */
if ( !function_exists( 'frudbaz_pagination' ) ) {

    function _frudbaz_pagi_callback( $pagination ) {
        return $pagination;
    }

    //page navegation
    function frudbaz_pagination( $prev, $next, $pages, $args ) {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ( $pages == '' ) {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if ( !$pages ) {
                $pages = 1;
            }

        }

        $pagination = [
            'base'      => add_query_arg( 'paged', '%#%' ),
            'format'    => '',
            'total'     => $pages,
            'current'   => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type'      => 'array',
        ];

        //rewrite permalinks
        if ( $wp_rewrite->using_permalinks() ) {
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
        }

        if ( !empty( $wp_query->query_vars['s'] ) ) {
            $pagination['add_args'] = ['s' => get_query_var( 's' )];
        }

        $pagi = '';
        if ( paginate_links( $pagination ) != '' ) {
            $paginations = paginate_links( $pagination );
            $pagi .= '<ul>';
            foreach ( $paginations as $key => $pg ) {
                $pagi .= '<li>' . $pg . '</li>';
            }
            $pagi .= '</ul>';
        }

        print _frudbaz_pagi_callback( $pagi );
    }
}

// rtl_enable
function rtl_enable() {
    $my_current_lang = apply_filters( 'wpml_current_language', NULL );
    $rtl_enable = get_theme_mod( 'rtl_switch', false );
    if ( $my_current_lang != 'en' && $rtl_enable ) {
        return true;
    } else {
        return false;
    }
}

// header top bg color
function frudbaz_breadcrumb_bg_color() {
    $color_code = get_theme_mod( 'frudbaz_breadcrumb_bg_color', '#222' );
    wp_enqueue_style( 'frudbaz-custom', FRUDBAZ_THEME_CSS_DIR . 'frudbaz-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= ".breadcrumb-bg.gray-bg{ background: " . $color_code . "}";

        wp_add_inline_style( 'frudbaz-breadcrumb-bg', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'frudbaz_breadcrumb_bg_color' );

// breadcrumb-spacing top
function frudbaz_breadcrumb_spacing() {
    $padding_px = get_theme_mod( 'frudbaz_breadcrumb_spacing', '160px' );
    wp_enqueue_style( 'frudbaz-custom', FRUDBAZ_THEME_CSS_DIR . 'frudbaz-custom.css', [] );
    if ( $padding_px != '' ) {
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-top: " . $padding_px . "}";

        wp_add_inline_style( 'frudbaz-breadcrumb-top-spacing', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'frudbaz_breadcrumb_spacing' );

// breadcrumb-spacing bottom
function frudbaz_breadcrumb_bottom_spacing() {
    $padding_px = get_theme_mod( 'frudbaz_breadcrumb_bottom_spacing', '160px' );
    wp_enqueue_style( 'frudbaz-custom', FRUDBAZ_THEME_CSS_DIR . 'frudbaz-custom.css', [] );
    if ( $padding_px != '' ) {
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-bottom: " . $padding_px . "}";

        wp_add_inline_style( 'frudbaz-breadcrumb-bottom-spacing', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'frudbaz_breadcrumb_bottom_spacing' );

// scrollup
function frudbaz_scrollup_switch() {
    $scrollup_switch = get_theme_mod( 'frudbaz_scrollup_switch', false );
    wp_enqueue_style( 'frudbaz-custom', FRUDBAZ_THEME_CSS_DIR . 'frudbaz-custom.css', [] );
    if ( $scrollup_switch ) {
        $custom_css = '';
        $custom_css .= "#scrollUp{ display: none !important;}";

        wp_add_inline_style( 'frudbaz-scrollup-switch', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'frudbaz_scrollup_switch' );

// theme color
function frudbaz_custom_color() {
    $color_code = get_theme_mod( 'frudbaz_color_option', '#ff8e28' );
    $sec_color_code = get_theme_mod( 'frudbaz_sec_color_option', '#00a850' );
    wp_enqueue_style( 'frudbaz-custom-color', FRUDBAZ_THEME_CSS_DIR . 'frudbaz-custom.css', [] );
    if ( $color_code != '' && $sec_color_code != '' ) {
        $custom_css = '';
        $custom_css .= "
            :root {
                --primary-color: " . $color_code . ";
                --secondary-color: " . $sec_color_code . ";
            }
        ";
        wp_add_inline_style( 'frudbaz-custom-color', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'frudbaz_custom_color' );

function frudbaz_get_allowed_html_tags( $level = 'basic' ) {
    $allowed_html = [
        'b'      => [],
        'i'      => [],
        'u'      => [],
        'em'     => [],
        'br'     => [],
        'abbr'   => [
            'title' => [],
        ],
        'span'   => [
            'class' => [],
        ],
        'strong' => [],
        'a'      => [
            'href'  => [],
            'title' => [],
            'class' => [],
            'id'    => [],
        ]
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
        'href' => [],
        'title' => [],
        'class' => [],
        'id' => [],
        ];
        $allowed_html['div'] = [
        'class' => [],
        'id' => [],
        ];
        $allowed_html['img'] = [
        'src' => [],
        'class' => [],
        'alt' => [],
        ];
        $allowed_html = [
            'bdi' => [],
            'br' => [],
        ];
    }

    return $allowed_html;
}

// frudbaz_kses_basic
function frudbaz_kses_basic( $string = '' ) {
    return wp_kses( $string, frudbaz_get_allowed_html_tags( 'basic' ) );
}

// frudbaz_kses_intermediate
function frudbaz_kses_intermediate( $string = '' ) {
    return wp_kses( $string, frudbaz_get_allowed_html_tags( 'intermediate' ) );
}

function frudbaz_shopping_cart() {
    ob_start();
    ?>
    <div class="cart_sidebar mini-cart-content">
        <h2 class="heading_title text-uppercase">
        <?php echo esc_html__('Cart Items', 'frudbaz'); ?> -
        <span class="cart_counter" id="frudbaz-cart-count"><?php echo esc_html(WC()->cart->cart_contents_count); ?></span></h2>

        <div class="header-mini-cart"></div>
    </div>
    <?php return ob_get_clean();
}