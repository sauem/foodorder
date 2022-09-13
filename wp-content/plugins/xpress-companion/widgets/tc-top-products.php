<?php
/**
* xpress-companion
* @since 1.0.0
*/

Class Top_Products extends WP_Widget {

    public function __construct() {
        parent::__construct( 'tc-top-products', 'Frudbaz Top Products', [
            'description' => 'Top Products Widget by Frudbaz',
        ] );
    }

    public function widget( $args, $instance ) {
        extract( $args );
        extract( $instance );

        echo $before_widget;
        if ( $instance['title'] ):
            echo $before_title;?>
		     			<?php echo apply_filters( 'widget_title', $instance['title'] ); ?>
		     		<?php echo $after_title; ?>
		     	<?php endif;?>

	     	<div class="widget_post widget_product">
			<?php
				$q = new WP_Query( [
				'post_type'      => 'product',
				'posts_per_page' => ( $instance['count'] ) ? $instance['count'] : '3',
				'order'          => ( $instance['posts_order'] ) ? $instance['posts_order'] : 'DESC',
				'orderby'        => 'date',
			] );

			if ( $q->have_posts() ):

                 function xpress_get_price() {
                    ob_start();?>
                    <span class="woocommerce-Price-amount amount"><?php print xpress_get_price_html();?></span>
                    <?php
                    return ob_get_clean();
                }

                function xpress_get_price_html() {
                    global $product;
                    return $product->get_price_html();
                }

                function product_rating() {

                    global $product;
                    $rating = $product->get_average_rating();
                    $rating_count = $product->get_review_count();
                    $review = 'Rating ' . $rating . ' out of 5';
                    $html = '';
                    $html .= '<ul class="rating_star ul_li" title="' . $review . '">';
                    for ( $i = 0; $i <= 4; $i++ ) {
                        if ($i < floor($rating)) {
                            $html .= '<li><i class="fas fa-star"></i></li>';
                        } else {
                            $html .= '<li><i class="fal fa-star"></i></li>';
                        }
                    }
                    $html .= '</ul>';
                    return $html;
                }

				while ( $q->have_posts() ): $q->the_post();
			?>
				<div class="top-product-wrapper">
					<?php if ( has_post_thumbnail() ): ?>
					<div class="thumb">
						<a href="<?php the_permalink();?>"><?php the_post_thumbnail( 'thumbnail' );?></a>
					</div>
					<?php endif; ?>
					<div class="content">
                        <?php echo product_rating(); ?>
						<h5><a href="<?php the_permalink();?>"><?php print wp_trim_words( get_the_title(), 8, '' );?> </a></h5>
                        <div class="wp_price ul_li">
                            <?php echo xpress_get_price(); ?>
                        </div>
					</div>
				</div>
				<?php endwhile;
			endif;?>
			</div>


		<?php echo $after_widget; ?>

		<?php
}

    public function form( $instance ) {
        $title = !empty( $instance['title'] ) ? $instance['title'] : '';
        $count = !empty( $instance['count'] ) ? $instance['count'] : esc_html__( '3', 'xpress-companion' );
        $posts_order = !empty( $instance['posts_order'] ) ? $instance['posts_order'] : esc_html__( 'DESC', 'xpress-companion' );
        $choose_style = !empty( $instance['choose_style'] ) ? $instance['choose_style'] : esc_html__( 'style_1', 'xpress-companion' );
        ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title</label>
			<input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" id="<?php echo $this->get_field_id( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>">How many posts you want to show ?</label>
			<input type="number" name="<?php echo $this->get_field_name( 'count' ); ?>" id="<?php echo $this->get_field_id( 'count' ); ?>" value="<?php echo esc_attr( $count ); ?>" class="widefat">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'posts_order' ); ?>">Posts Order</label>
			<select name="<?php echo $this->get_field_name( 'posts_order' ); ?>" id="<?php echo $this->get_field_id( 'posts_order' ); ?>" class="widefat">
				<option value="" disabled="disabled">Select Post Order</option>
				<option value="ASC" <?php if ( $posts_order === 'ASC' ) {echo 'selected="selected"';}?>>ASC</option>
				<option value="DESC" <?php if ( $posts_order === 'DESC' ) {echo 'selected="selected"';}?>>DESC</option>
			</select>
		</p>

	<?php }

}

add_action( 'widgets_init', function () {
    register_widget( 'Top_Products' );
} );