<?php
/**
* xpress-companion
* @since 1.0.0
*/

add_action( 'widgets_init', 'frudbaz_about_info' );
function frudbaz_about_info() {
    register_widget( 'frudbaz_about_info' );
}

class frudbaz_about_info extends WP_Widget {

    public function __construct() {
        parent::__construct( 'frudbaz_about_info', esc_html__( 'Cafena Footer Info', 'xpress-companion' ), [
            'description' => esc_html__( 'Footer Info Widget (CAFENA)', 'xpress-companion' ),
        ] );
    }

    public function widget( $args, $instance ) {
        extract( $args );
        extract( $instance );

        print $before_widget;
        ?>
            <div class="footer__info">
                <?php
                    if ( !empty( $title ) ) {
                        print $before_title . apply_filters( 'widget_title', $title ) . $after_title;
                    }
                ?>
                <div class="item d-flex align-items-center justify-content-center">

                    <?php if ( !empty( $image_box_image ) ): ?>
                    <img src="<?php print esc_url($image_box_image); ?>" alt="<?php print esc_attr( $title ); ?>">
                    <?php endif;?>

                    <?php if(!empty( $text_label )) : ?>
                    <span><?php echo esc_html($text_label); ?> :</span>
                    <?php endif; ?>

                    <?php if(!empty( $text_phone_address )) : ?>
                    <p><?php echo esc_html($text_phone_address); ?></p>
                    <?php endif; ?>


                </div>
            </div>
            <?php print $after_widget;?>
			<?php
}

    /**
     * widget function.
     *
     * @see WP_Widget
     * @access public
     * @param array $instance
     * @return void
     */
    public function form( $instance ) {

        $title = isset( $instance['title'] ) ? $instance['title'] : '';
        $author_img = isset( $instance['image_box_image'] ) ? $instance['image_box_image'] : '';

        $text_label = isset( $instance['text_label'] ) ? $instance['text_label'] : '';
        $text_phone_address = isset( $instance['text_phone_address'] ) ? $instance['text_phone_address'] : '';

        ?>
			<div class="widget_field" style="margin: 10px 0px">
				<p><label for="title"><?php esc_html_e( 'Title:', 'xpress-companion' );?></label></p>
            </div>
            <div class="widget_field" style="margin: 10px 0px">
			    <input class="widefat" type="text" id="<?php print esc_attr( $this->get_field_id( 'title' ) );?>"  name="<?php print esc_attr( $this->get_field_name( 'title' ) );?>" value="<?php print esc_attr( $title );?>">
            </div>

            <div class="widget_field" style="margin: 10px 0px">
                <button style="margin-bottom: 10px" type="submit" class="button button-secondary" id="author_info_imagee">Upload Icon</button>
				<input type="hidden" name="<?php print esc_attr($this->get_field_name('image_box_image')); ?>" class="image_er_link" value="<?php print $author_img; ?>">

				<div class="author-image-show">
					<img src="<?php print $author_img; ?>" alt="upload image" width="140" height="auto">
				</div>
            </div>

            <p><label for="title"><?php esc_html_e( 'Label', 'xpress-companion' );?></label></p>
            <input type="text" id="<?php print esc_attr( $this->get_field_id( 'text_label' ) );?>"  name="<?php print esc_attr( $this->get_field_name( 'text_label' ) );?>" value="<?php print esc_attr( $text_label );?>">

            <p><label for="title"><?php esc_html_e( 'Text', 'xpress-companion' );?></label></p>
            <input type="text" id="<?php print esc_attr( $this->get_field_id( 'text_phone_address' ) );?>"  name="<?php print esc_attr( $this->get_field_name( 'text_phone_address' ) );?>" value="<?php print esc_attr( $text_phone_address );?>">

			<?php
}

    public function update( $new_instance, $old_instance ) {
        $instance = [];
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['image_box_image'] = ( !empty( $new_instance['image_box_image'] ) ) ? strip_tags( $new_instance['image_box_image'] ) : '';
        $instance['text_label'] = ( !empty( $new_instance['text_label'] ) ) ? strip_tags( $new_instance['text_label'] ) : '';
        $instance['text_phone_address'] = ( !empty( $new_instance['text_phone_address'] ) ) ? strip_tags( $new_instance['text_phone_address'] ) : '';


        return $instance;
    }
}