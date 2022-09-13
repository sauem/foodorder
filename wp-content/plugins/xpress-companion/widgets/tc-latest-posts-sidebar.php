<?php
/**
* xpress-companion
* @since 1.0.0
*/

Class Latest_posts_sidebar_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct( 'tc-latest-posts', 'Cafena Sidebar Posts Image', [
            'description' => 'Latest Post Widget by (CAFENA)',
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

		<div class="recent-posts">
		<?php
			$q = new WP_Query( [
            'post_type'      => 'post',
            'posts_per_page' => ( $instance['count'] ) ? $instance['count'] : '3',
            'order'          => ( $instance['posts_order'] ) ? $instance['posts_order'] : 'DESC',
            'orderby'        => 'date',
        ] );

        if ( $q->have_posts() ):
            while ( $q->have_posts() ): $q->the_post();
        ?>
			<div class="item d-flex align-items-center">
				<?php if ( has_post_thumbnail() ): ?>
				<div class="thumb">
					<?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] ); ?>">
				</div>
				<?php endif;?>
				<div class="content">
					<h5 class="rp-title border-effect"><a href="<?php the_permalink();?>"><?php print wp_trim_words( get_the_title(), 8, '' );?></a></h5>
					<a href="<?php the_permalink();?>" class="date"><i class="fal fa-calendar-alt"></i>  <?php the_time( 'F d, Y' );?></a>
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
    register_widget( 'Latest_posts_sidebar_Widget' );
} );