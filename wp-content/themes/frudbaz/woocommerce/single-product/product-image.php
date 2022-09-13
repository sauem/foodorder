<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 4.3.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

?>
<div class="product_wrap">

	<?php do_action( 'frudbaz_woocommerce_product_thumbnails' ); ?>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

	<?php
		$html = '';
		$attachment_ids = $product->get_gallery_image_ids();
		$post_thumbnail_id = array(get_post_thumbnail_id());
		$attachment_ids = array_merge($post_thumbnail_id,$attachment_ids);
		$i=1;
		foreach ( $attachment_ids as $attachment_id ){
			$class = ($i==1)?'active show':'';
			$image_attributes = wp_get_attachment_image_src( $attachment_id,array(600,400));
			if( !empty($image_attributes[0]) ){
				$id = 'a'.$i;
				$html .=  '
					<div class="tab-pane fade '.$class.'" id="'.$id.'" role="tabpanel" aria-labelledby="'.$id.'-tab">
						<div class="pl_thumb">';
						$html .= '<img src="'.$image_attributes[0].'" alt="'.esc_attr__('img','frudbaz').'">';
					$html .= '</div>
					</div>
				';
				$i++;
			}
		}
	?>
	<div class="product_details_img ">
		<div class="tab-content" id="myTabContent">
			<?php echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); ?>
		</div>
	</div>


</div>
