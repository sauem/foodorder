<?php
/**
* xpress-companion
* @since 1.0.0
*/

add_action( 'widgets_init', 'tc_services_form_widget' );
function tc_services_form_widget() {
    register_widget( 'tc_services_form_widget' );
}

class tc_services_form_widget extends WP_Widget {

    public function __construct() {
        parent::__construct( 'tc_services_form_widget', esc_html__( 'Avatix Services Form', 'xpress-companion' ), [
            'description' => esc_html__( 'Avatix Services Form Widget', 'xpress-companion' ),
        ] );
    }

    public function widget( $args, $instance ) {
        extract( $args );
        extract( $instance );
        print $before_widget;

        if ( !empty( $title ) ) {
            print $before_title . apply_filters( 'widget_title', $title ) . $after_title;
        }
        ?>

			<?php if ( !empty( $mailchimp_shortcode ) ): ?>
			<div class="services__widget-content">
                <div class="services__form">
                    <?php print do_shortcode( $mailchimp_shortcode );?>
                </div>
            </div>
            <?php endif;?>

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
        $mailchimp_shortcode = isset( $instance['mailchimp_shortcode'] ) ? $instance['mailchimp_shortcode'] : '';
        ?>
			<p>
				<label for="title"><?php esc_html_e( 'Title:', 'xpress-companion' );?></label>
			</p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 'title' ) );?>"  class="widefat" name="<?php print esc_attr( $this->get_field_name( 'title' ) );?>" value="<?php print esc_attr( $title );?>">

			<p>
				<label for="title"><?php esc_html_e( 'Mailchimp Shortcode:', 'xpress-companion' );?></label>
			</p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 'mailchimp_shortcode' ) );?>" class="widefat" name="<?php print esc_attr( $this->get_field_name( 'mailchimp_shortcode' ) );?>" value="<?php print esc_attr( $mailchimp_shortcode );?>">

			<?php
}

    public function update( $new_instance, $old_instance ) {
        $instance = [];
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['subscribe_style'] = ( !empty( $new_instance['subscribe_style'] ) ) ? strip_tags( $new_instance['subscribe_style'] ) : '';
        $instance['mailchimp_shortcode'] = ( !empty( $new_instance['mailchimp_shortcode'] ) ) ? strip_tags( $new_instance['mailchimp_shortcode'] ) : '';
        return $instance;
    }
}