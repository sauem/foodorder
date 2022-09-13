<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
* Plugin Name: Xpress Companion
* Plugin URI: http://sabberhossain.com
* Description: Theme Companion plugin
* Version: 1.0.0
* Author: Sabber Hossain
* Author URI: http://sabberhossain.com
* Text Domain: xpress-companion
*/

define( 'XPRESS_COMPANION_VER', '1.0.0' );
define( 'XPRESS_COMPANION_DIR', plugin_dir_path( __FILE__ ) );
define( 'XPRESS_COMPANION_URL', plugin_dir_url( __FILE__ ) );

final class Theme_Companion {

    private static $instance;

    function __construct() {

        require_once XPRESS_COMPANION_DIR . '/inc/custom-post.php';

        //require_once XPRESS_COMPANION_DIR . '/inc/acf-meta-field.php';
        /**
         * widgets
         */
        //require_once XPRESS_COMPANION_DIR . '/widgets/tc-info-widget.php';
        //require_once XPRESS_COMPANION_DIR . '/widgets/tc-latest-posts-footer.php';
        //require_once XPRESS_COMPANION_DIR . '/widgets/tc-contact-info-widget.php';
        require_once XPRESS_COMPANION_DIR . '/widgets/tc-latest-posts-sidebar.php';
        require_once XPRESS_COMPANION_DIR . '/widgets/tc-author-info.php';
        require_once XPRESS_COMPANION_DIR . '/widgets/tc-subscriber-widget.php';
        //require_once XPRESS_COMPANION_DIR . '/widgets/tc-top-products.php';

        add_filter( 'template_include', [ $this, '_custom_template_include' ] );
    }

    public static function instance() {

        if ( !isset( self::$instance ) && !( self::$instance instanceof Theme_Companion ) ) {
            self::$instance = new Theme_Companion;
        }
        return self::$instance;
    }

    public function _custom_template_include( $template ) {
        $post_types = tc_custom_post_types();
        foreach ( $post_types as $post_type => $fields ) {
            if ( is_singular( $post_type ) ) {
                return $this->_get_custom_template( 'single-' . $post_type . '.php' );
            }
        }
        return $template;

    }

    public function _get_custom_template( $template ) {
        if ( $theme_file = locate_template( [ $template ] ) ) {
            $file = $theme_file;
        } else {
            $file = XPRESS_COMPANION_DIR . 'template/' . $template;
        }
        return apply_filters( __FUNCTION__, $file, $template );
    }
}

function Theme_Companion() {

    return Theme_Companion::instance();
}

Theme_Companion();

if (file_exists( XPRESS_COMPANION_DIR . '/admin/admin-init.php')) {
    require_once XPRESS_COMPANION_DIR . '/admin/admin-init.php';
}

function xriver_enqueue_custom_admin_style() {
    wp_register_style( 'custom_wp_admin_css', XPRESS_COMPANION_URL . 'assets/css/admin.css', false, '1.0.0' );
    wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'xriver_enqueue_custom_admin_style' );

// custom admin script
function frudbaz_admin_scripts() {
    wp_enqueue_media();
    wp_enqueue_script( 'xpress-main', XPRESS_COMPANION_URL . 'assets/js/main.js', ['jquery'], false, true );
}
add_action( 'admin_enqueue_scripts', 'frudbaz_admin_scripts' );

/**
 *
 */
function tc_custom_post_types() {
    return [
        'tc-gallery'    => [ 'title' => 'Gallery', 'plural_title' => 'Gallery', 'rewrite' => 'our-gallery', 'menu_icon' => 'dashicons-format-image' ],
    ];
}

add_filter( 'Custom_Xpress_Companion_Post_types', 'tc_custom_post_types' );

/**
 *
 */
function tc_custom_taxonomies() {
    return [
        'gallery-categories'   => [
            'title'        => 'Gallery Category',
            'plural_title' => 'Gallery Categories',
            'rewrite'      => 'gallery-cat',
            'post_type'    => 'tc-gallery',
        ],
    ];
}

add_filter( 'custom_xpress_companion_taxonomies', 'tc_custom_taxonomies' );

/**
 * taxonomy category
 */
function tc_get_terms( $id, $tax ) {
    $terms = get_the_terms( get_the_ID(), $tax );
    $list = '';
    if ( $terms && !is_wp_error( $terms ) ):
        $i = 1;
        $cats_count = count( $terms );
        foreach ( $terms as $term ) {
            $exatra = ( $cats_count > $i ) ? ', ' : '';
            $list .= $term->name . $exatra;
            $i++;
        }
    endif;
    return trim( $list, ',' );
}

// Social share
function cafena_social_share() {
    $html = '';
    $img_url = '';
    if (has_post_thumbnail(get_the_ID()) && wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), false)) {
        $img_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), false);
    }
    ?>
        <h4><?php echo esc_html__('Social Share', 'xpress-companion'); ?></h4>
        <div class="social-share">
            <a title="<?php echo esc_attr__('Facebook', 'itfirm'); ?>" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fab fa-facebook-f"></i></a>

            <a title="<?php echo esc_attr__('Twitter', 'itfirm'); ?>" target="_blank" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>%20"><i class="fab fa-twitter"></i></a>

            <?php if(!empty($img_url)) : ?>
            <a title="<?php echo esc_attr__('Pinterest', 'itfirm'); ?>" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_url($img_url[0]); ?>&description=<?php the_title(); ?>%20"><i class="fab fa-pinterest"></i></a>
            <?php endif; ?>

            <a title="<?php echo esc_attr__('LinkedIn', 'itfirm'); ?>" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>%20"><i class="fab fa-linkedin"></i></a>

        </div>
    <?php
    print $html;
}

function cafena_vc_yith_wishlist($style = 1) {

    global $product;

    $cssclass = 'wishlist-rd';
    $mar = 'tanzim-mar-top';

    if ($style != 2) {
        $cssclass = 'pro-btn';
        $mar = '';
    }

    $id = $product->get_id();
    $type = $product->get_type();
    $link = get_site_url();

    $img = '<img src="' . esc_attr($link) . '/wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading tanzim_wi_loder" alt="' . esc_attr('loading') . '" width="16" height="16" style="visibility:hidden">';
    $markup = '';

    if (CAFENA_WISHLIST_ACTIVED) {

        $markup .= '<div class="yith-wcwl-add-to-wishlist action ' . $mar . ' add-to-wishlist-' . $id . '">';
        $markup .= '<div class="yith-wcwl-add-button wishlist show" style="display:block">';
        $markup .= '<a href="' . $link . '/shop/?add_to_wishlist=' . $id . '" rel="nofollow" data-product-id="' . $id . '" data-product-type="' . $type . '" class="add_to_wishlist ' . $cssclass . '" title="'.__('Add to Wishlist!', 'cafena').'">';
        $markup .= '<i class="yith-wcwl-icon fal fa-heart"></i></a>';
        $markup .= $img;
        $markup .= '</div>';
        $markup .= '<div class="yith-wcwl-wishlistaddedbrowse wishlist hide" style="display:none;">';
        $markup .= '<a href="' . $link . '/wishlist/view/" rel="nofollow" class=" ' . $cssclass . '"><i class="yith-wcwl-icon fa fa-heart"></i></a>';
        $markup .= $img;
        $markup .= '</div>';
        $markup .= '<div class="yith-wcwl-wishlistexistsbrowse wishlist hide" style="display:none">';
        $markup .= '<a href="' . $link . '/wishlist/view/" rel="nofollow" class=" ' . $cssclass . '"><i class="fal fa-heart"></i></a>';
        $markup .= $img;
        $markup .= '</div>';
        $markup .= '<div style="clear:both"></div>';
        $markup .= '<div class="yith-wcwl-wishlistaddresponse"></div>';
        $markup .= '</div>';
    }

    return $markup;
}