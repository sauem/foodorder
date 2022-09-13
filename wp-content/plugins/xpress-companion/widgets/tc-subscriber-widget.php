<?php
/**
* xpress-companion
* @since 1.0.0
*/
add_action( 'widgets_init', 'tc_subscriber_widget' );
function tc_subscriber_widget() {
    register_widget( 'tc_subscriber_widget' );
}

class Tc_Subscriber_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct( 'tc_subscriber_widget', esc_html__( 'Cafena Footer Subscriber', 'xpress-companion' ), [
            'description' => esc_html__( 'Subscriber Widget (CAFENA)', 'xpress-companion' ),
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
        <div class="subscribe">
            <?php print do_shortcode( $mailchimp_shortcode );?>
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
        $mailchimp_shortcode = isset( $instance['mailchimp_shortcode'] ) ? $instance['mailchimp_shortcode'] : '';
        ?>
			<p>
				<label for="title"><?php esc_html_e( 'Title:', 'xpress-companion' );?></label>
			</p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 'title' ) );?>"  class="widefat" name="<?php print esc_attr( $this->get_field_name( 'title' ) );?>" value="<?php print esc_attr( $title );?>">

			<p>
				<label for="title"><?php esc_html_e( 'From Shortcode:', 'xpress-companion' );?></label>
			</p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 'mailchimp_shortcode' ) );?>" class="widefat" name="<?php print esc_attr( $this->get_field_name( 'mailchimp_shortcode' ) );?>" value="<?php print esc_attr( $mailchimp_shortcode );?>">

			<?php
}

    public function update( $new_instance, $old_instance ) {
        $instance = [];
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['mailchimp_shortcode'] = ( !empty( $new_instance['mailchimp_shortcode'] ) ) ? strip_tags( $new_instance['mailchimp_shortcode'] ) : '';


        return $instance;
    }
}