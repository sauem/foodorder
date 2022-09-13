<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @package    WooCommerce/Templates
 * @version     4.3.1
 */

if (!defined('ABSPATH')) {
    exit;
}

if ($related_products) : ?>

<div class="row clearfix">
    <div class="related releted_product related-products-section mt-35">
        <div class="sec_title sec_title-2">
            <h2><?php esc_html_e('Related Products', 'frudbaz'); ?></h2>
        </div>

        <?php woocommerce_product_loop_start(); ?>
        <?php
            $related_class = '';
            if (count($related_products) >= 2){
                $related_class = 'product-active';
            }
        ?>
        <div class="row <?php print esc_attr($related_class); ?>">
            <?php foreach ($related_products as $related_product) : ?>
                <div class="col-lg-4 col-md-6 col-sm-6 mb-30">
                    <?php
                        $post_object = get_post($related_product->get_id());

                        setup_postdata($GLOBALS['post'] =& $post_object);

                        wc_get_template_part('content', 'product'); ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php woocommerce_product_loop_end(); ?>
    </div>
</div>

<?php endif;

wp_reset_postdata();
