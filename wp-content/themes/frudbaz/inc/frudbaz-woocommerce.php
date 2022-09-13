<?php
/**
 * [frudbaz_remove_hook description]
 * @return [type] [description]
 */
function frudbaz_remove_hook() {
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
    remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
    remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
    remove_action('woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20);
    remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
    add_action('frudbaz_before_shop_loop_item_thumb', 'woocommerce_template_loop_product_link_open', 10);

    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
    remove_action( 'woocommerce_before_shop_loop', 'frudbaz_woo_notice', 10 );

    remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
    add_action('woocommerce_sidebar', 'frudbaz_woocommerce_get_sidebar', 10);

    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);

    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 5);
    add_action('woocommerce_single_product_summary', 'frudbaz_woo_rating', 20);
    add_action('woocommerce_mid_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 5);
    add_action('woocommerce_mid_shop_loop_item_title', 'frudbaz_product_cart_button', 10);
    add_action('frudbaz_woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20);

    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
    add_action('woocommerce_after_shop_loop_item_title', 'frudbaz_woocommerce_template_loop_price', 10);

    add_filter('woocommerce_sale_flash', 'woocommerce_custom_sale_text', 10, 3);

    remove_action('yith_wcqv_product_image', 'woocommerce_show_product_sale_flash', 10);
    remove_action('yith_wcqv_product_image', 'woocommerce_show_product_images', 20);
    remove_action('yith_wcqv_product_summary', 'woocommerce_template_single_rating', 10);
    remove_action('yith_wcqv_product_summary', 'woocommerce_template_single_excerpt', 20);

    add_action('yith_wcqv_product_image', 'frudbaz_quick_view_images', 21);
    add_action('yith_wcqv_product_summary', 'frudbaz_woo_rating', 15);
    add_action('yith_wcqv_product_summary', 'woocommerce_template_single_excerpt', 5);

}

frudbaz_remove_hook();

add_filter('woocommerce_show_page_title', function () {
    return false;
});

/**
 * [frudbaz_product_title description]
 * @return [type] [description]
 */
function frudbaz_product_title() {
    print '<h3 class="title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
}

/**
 * [frudbaz_product_cart_button description]
 * @return [type] [description]
 */
function frudbaz_product_cart_button(){
    global $product;
    $class = 'product_type_' . $product->get_type() . ' add_to_cart_button action ' . ($product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : '');
    $attributes = array(
        'data-product_id' => $product->get_id(),
        'data-product_sku' => $product->get_sku(),
        'aria-label' => $product->add_to_cart_description(),
        'rel' => 'nofollow',
    );
    print '<div class="shop-action-wrap actions">';

    print '<a data-product_id="'.$product->get_id().'" data-product_sku="'.$product->get_sku().'" aria-label="'.$product->add_to_cart_description().'" rel="nofollow" class="' . $class . '" href="' . $product->add_to_cart_url() . '" title="'.__('Add to cart!', 'frudbaz').'"><i class="fal fa-shopping-basket"></i></a>';
    print frudbaz_vc_yith_wishlist();
    print frudbaz_quick_view_button($product->get_id());

    print '</div>';
}

/**
 * [frudbaz_product_cart_button description]
 * @return [type] [description]
 */
function woocommerce_custom_sale_text($text, $post, $_product) {
    return '<div class="product-badge hot frudbaz-onsale badge">'.__('Sell', 'frudbaz').'</div>';
}

function frudbaz_woo_category() {
    global $product;
    $current_cats = get_the_terms( get_the_ID(), 'product_cat' );
    //only start if we have some tags
    if ( $current_cats && ! is_wp_error( $current_cats ) ) {

    //create a list to hold our tags
    echo '<ul class="item_category_list ul_li pl-0">';

    //for each tag we create a list item
    foreach ($current_cats as $cat) {

        $cat_title = $cat->name; // tag name
        $cat_link = get_term_link( $cat );// tag archive link

        echo '<li><a href="'.$cat_link.'">'.$cat_title.' </a></li>';
    }

    echo '</ul>';
    }
}


/**
 * [frudbaz_woo_rating description]
 * @return [type] [description]
 */
function frudbaz_woo_rating(){
    global $product;
    $rating = $product->get_average_rating();
    $rating_count = $product->get_review_count();
    $html = '';
    $html .= '<div class="review_wrap ul_li">
    <ul class="review ul_li">';
    for ($i = 0; $i <= 4; $i++) {
        if ($i < floor($rating)) {
            $html .= '<li><i class="fas fa-star"></i></li>';
        } else {
            $html .= '<li><i class="fal fa-star"></i></li>';
        }
    }
    $html .= '<div class="text"><span> ( ' . $rating_count . ' Reviews )</span></div>';
    $html .= '</ul></div>';
    print frudbaz_woo_rating_html($html);
}

function frudbaz_woo_rating_html($html){
    return $html;
}

function frudbaz_woo_rating_for_shop(){
    global $product;
    $rating = $product->get_average_rating();
    $rating_count = $product->get_review_count();
    $html = '';
    $html .= '<div class="rating">';
    for ($i = 0; $i <= 4; $i++) {
        if ($i < floor($rating)) {
            $html .= '<i class="fas fa-star"></i> ';
        } else {
            $html .= '<i class="fal fa-star"></i>';
        }
    }
    $html .= '<span class="green">  ' . $rating_count . ' review</span>';
    $html .= '</div>';
    print frudbaz_woo_rating_for_shop_html($html);
}

function frudbaz_woo_rating_for_shop_html($html){
    return $html;
}

/**
 * [frudbaz_woo_rating description]
 * @return [type] [description]
 */
function frudbaz_woo_shop_rating()
{
    global $product;
    $rating = $product->get_average_rating();
    $review = esc_html('' . $rating . ' review');
    ob_start(); ?>
    <div class="rating">
        <?php
        for ($i = 0; $i <= 4; $i++) {
            if ($i < floor($rating)) { ?>
                <i class="fas fa-star"></i>
                <?php
            } else { ?>
                <i class="far fa-star"></i>
                <?php
            }
        }
        ?>
    </div>
    <?php
    return ob_get_clean();
}

function frudbaz_get_price()
{
    ob_start(); ?>
    <span class="woocommerce-Price-amount amount"><?php print frudbaz_get_price_html(); ?></span>
    <?php
    return ob_get_clean();
}

function frudbaz_get_price_html()
{
    global $product;
    return $product->get_price_html();
}

/**
 * [frudbaz_comment_rating description]
 * @param  [type] $rating [description]
 * @return [type]         [description]
 */
function frudbaz_comment_rating($rating)
{
    $review = '' . $rating . ' Rating';
    $html = '';
    $html .= '<div class="rating">';
    for ($i = 0; $i <= 4; $i++) {
        if ($i < floor($rating)) {
            $html .= '<i class="fas fa-star"></i>';
        } else {
            $html .= '<i class="fal fa-star"></i>';
        }
    }
    $html .= '</div>';
    return $html;
}


add_filter('add_to_cart_fragments', 'frudbaz_woocommerce_header_add_to_cart_fragment');

/**
 * [frudbaz_woocommerce_header_add_to_cart_fragment description]
 * @param  [type] $fragments [description]
 * @return [type]            [description]
 */
function frudbaz_woocommerce_header_add_to_cart_fragment($fragments)
{
    global $woocommerce;
    ob_start();
    ?>
    <a class="cart-toggle-btn" href="<?php print wc_get_cart_url(); ?>"><i class="fas fa-shopping-cart"></i>
    <span id="frudbaz-cart" class="mini-cart-items"><?php print WC()->cart->get_cart_contents_count(); ?></span></a>
    <?php
    $fragments['a.cp-minicart'] = ob_get_clean();
    return $fragments;
}

function frudbaz_vc_yith_wishlist($style = 1) {

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

    if (FRUDBAZ_WISHLIST_ACTIVED) {

        $markup .= '<div class="yith-wcwl-add-to-wishlist action ' . $mar . ' add-to-wishlist-' . $id . '">';
        $markup .= '<div class="yith-wcwl-add-button wishlist show" style="display:block">';
        $markup .= '<a href="' . $link . '/shop/?add_to_wishlist=' . $id . '" rel="nofollow" data-product-id="' . $id . '" data-product-type="' . $type . '" class="add_to_wishlist ' . $cssclass . '" title="'.__('Add to Wishlist!', 'frudbaz').'">';
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

add_filter('woocommerce_product_additional_information_heading', 'frudbaz_tab_heading');
add_filter('woocommerce_product_description_heading', 'frudbaz_tab_heading');

/**
 * [frudbaz_tab_heading description]
 * @param  [type] $heading [description]
 * @return [type]          [description]
 */
function frudbaz_tab_heading($heading)
{
    return '';
}

/**
 * [frudbaz_woo_pagination description]
 * @param  [type] $pagination [description]
 * @return [type]             [description]
 */
function frudbaz_woo_pagination($pagination)
{
    $pagi = '';
    if ($pagination != '') {
        $pagi .= '<div class="pagination_wrap text-center pt-30 list-none">
        <ul class="pg-pagination">';
        foreach ($pagination as $key => $pg) {
            $pagi .= '<li class="page-item">' . $pg . '</li>';
        }
        $pagi .= '</ul></div>';
    }
    return $pagi;
}


function frudbaz_woocommerce_get_sidebar()
{
    dynamic_sidebar('product-sidebar');
}

function frudbaz_woocommerce_template_loop_price() {
    print '<div class="product-info content">';
    frudbaz_product_title();
    print '<div class="s_bottom ul_li">';
    print '<span class="price">';
    print ''.esc_html__('PRICE-', 'frudbaz').'';
    print '</span>';
    print frudbaz_get_price();
    print '</div>';
    print '</div>';
}

function frudbaz_woocommerce_template_single_price(){

    print frudbaz_get_price_html();

}

function woocommerce_template_single_stock()
{
    global $product;
    if ($product->get_stock_quantity() > 0) {
        print '<div class="cart-title">';
        print '<h6>Availability: <span>In Stock</span></h6>';
        print '</div>';
    } else {
        if ($product->backorders_allowed()) {
            print '<div class="cart-title">';
            print '<h6>Availability: <span>On Backorder</span></h6>';
            print '</div>';
        } else {
            print '<div class="cart-title">';
            print '<h6>Availability: <span>Out of stock</span></h6>';
            print '</div>';
        }
    }
}

if (!function_exists('frudbaz_header_cart_count')) {
    function frudbaz_header_cart_count($fragments)
    {
        ob_start();
        ?>
        <span class="cart_counter" id="frudbaz-cart-count">
			<?php print esc_html(WC()->cart->cart_contents_count); ?>
		</span>
        <?php
        $fragments['#frudbaz-cart-count'] = ob_get_clean();
        return $fragments;
    }
}
add_filter('woocommerce_add_to_cart_fragments', 'frudbaz_header_cart_count');

if (!function_exists('frudbaz_header_cart_price')) {
    function frudbaz_header_cart_price($fragments)
    {
        ob_start();
        ?>
        <span class="cart__amount" id="frudbaz-total-price">
			<?php print WC()->cart->get_cart_total(); ?>
		</span>
        <?php
        $fragments['#frudbaz-total-price'] = ob_get_clean();
        return $fragments;
    }
}
add_filter('woocommerce_add_to_cart_fragments', 'frudbaz_header_cart_price');

/**
 * @param $product_id
 * @return mixed|string|void
 */
function frudbaz_quick_view_button($product_id)
{
    if (FRUDBAZ_QUICK_VIEW_ACTIVED) {
        $product = wc_get_product($product_id);
        $button = '';
        if ($product_id) {

            $button = '<a href="#" class="button action yith-wcqv-button" data-product_id="' . esc_attr($product_id) . '" data-toggle="tooltip" data-placement="top" title="Quick View!"><i class="fal fa-eye"></i></a>';
            $button = apply_filters('yith_add_quick_view_button_html', $button, '', $product);
        }
        return $button;
    }
}

if (!function_exists('frudbaz_quick_view_images')) {
    function frudbaz_quick_view_images()
    { ?>
        <div class="frudbaz-quick-view-images img-holder">
            <?php wc_get_template('single-product/product-image.php');
            ?>
        </div>
        <?php
    }
}

if (!function_exists('frudbaz_woo_notice')) {
    function frudbaz_woo_notice()
    {

    }
}

add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {

    ob_start();
    ?>
    <div class="header-mini-cart">
        <?php woocommerce_mini_cart(); ?>
    </div>
    <?php $fragments['.header-mini-cart'] = ob_get_clean();
    return $fragments;

});

if (FRUDBAZ_WISHLIST_ACTIVED && !function_exists('yith_wishlist_ajax_update_count')) {
    function yith_wishlist_ajax_update_count()
    {
        wp_send_json(array(
            'count' => yith_wcwl_count_all_products()
        ));
    }

    add_action('wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wishlist_ajax_update_count');
    add_action('wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wishlist_ajax_update_count');
}

if (FRUDBAZ_WISHLIST_ACTIVED && !function_exists('yith_wishlist_ajax_script')) {
    function yith_wishlist_ajax_script()
    {
        wp_add_inline_script(
            'jquery-yith-wcwl',
            "
                jQuery( function( $ ) {
                  $( document ).on( 'added_to_wishlist removed_from_wishlist', function() {
                    $.get( yith_wcwl_l10n.ajax_url, {
                      action: 'yith_wcwl_update_wishlist_count'
                    }, function( data ) {
                      $('.wish-count').html( data.count );
                    } );
                  } );
                } );
            "
        );
    }

    add_action('wp_enqueue_scripts', 'yith_wishlist_ajax_script', 20);
}

// Releted Product limit

function frudbaz_related_products_limit() {
    global $product;

      $args['posts_per_page'] = 3;
      return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'frudbaz_related_products_args', 20 );
function frudbaz_related_products_args( $args ) {
    $args['posts_per_page'] = 3; // 4 related products
    $args['columns'] = 2; // arranged in 2 columns
    return $args;
}