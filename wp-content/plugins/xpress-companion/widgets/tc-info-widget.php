<?php

add_action( 'widgets_init', 'Duxin_info_Widget' );
function Duxin_info_Widget() {
    register_widget( 'Duxin_info_Widget' );
}

class Duxin_info_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct( 'Duxin_info_Widget', esc_html__( 'Duxin About Info', 'xpress-companion' ), [
            'description' => esc_html__( 'Duxin About Info Widget', 'xpress-companion' ),
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

        <div class="footer-info-widget">
            <?php if ( !empty( $description ) ): ?>
            <div class="about-text mb-40">
                <p><?php print $description;?></p>
            </div>
            <?php endif;?>

            <div class="f-about-social">
                <h4 class="fa-title">Social Contact</h4>
                <?php if ( !empty( $facebook ) ): ?>
                <a href="<?php print esc_url( $facebook );?>"><i class="fab fa-facebook-f"></i></a>
                <?php endif;?>

                <?php if ( !empty( $twitter ) ): ?>
                <a href="<?php print esc_url( $twitter );?>"><i class="fab fa-twitter"></i></a>
                <?php endif;?>

                <?php if ( !empty( $instagram ) ): ?>
                <a href="<?php print esc_url( $instagram );?>"><i class="fab fa-instagram"></i></a>
                <?php endif;?>


                <?php if ( !empty( $linkedin ) ): ?>
                <a href="<?php print esc_url( $linkedin );?>"><i class="fab fa-linkedin-in"></i></a>
                <?php endif;?>

                <?php if ( !empty( $youtube ) ): ?>
                <a href="<?php print esc_url( $youtube );?>"><i class="fab fa-youtube"></i></a>
                <?php endif;?>
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
        $description = isset( $instance['description'] ) ? $instance['description'] : '';

        $s_title = isset( $instance['s_title'] ) ? $instance['s_title'] : '';
        $twitter = isset( $instance['twitter'] ) ? $instance['twitter'] : '';
        $facebook = isset( $instance['facebook'] ) ? $instance['facebook'] : '';
        $instagram = isset( $instance['instagram'] ) ? $instance['instagram'] : '';
        $youtube = isset( $instance['youtube'] ) ? $instance['youtube'] : '';
        $linkedin = isset( $instance['linkedin'] ) ? $instance['linkedin'] : '';

        ?>
			<p>
				<label for="title"><?php esc_html_e( 'Title:', 'xpress-companion' );?></label>
			</p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 'title' ) );?>"  name="<?php print esc_attr( $this->get_field_name( 'title' ) );?>" value="<?php print esc_attr( $title );?>">
			<p>
				<label for="title"><?php esc_html_e( 'Short Description:', 'xpress-companion' );?></label>
			</p>
            
            <textarea class="widefat" rows="7" cols="15" id="<?php print esc_attr( $this->get_field_id( 'description' ) );?>" value="<?php print esc_attr( $description );?>" name="<?php print esc_attr( $this->get_field_name( 'description' ) );?>"><?php print esc_attr( $description );?></textarea>

            <p>
				<label for="title"><?php esc_html_e( 'Social Heading', 'xpress-companion' );?></label>
			</p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 's_title' ) );?>"  name="<?php print esc_attr( $this->get_field_name( 's_title' ) );?>" value="<?php print esc_attr( $s_title );?>">

			<p>
				<label for="title"><?php esc_html_e( 'Facebook:', 'xpress-companion' );?></label>
			</p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 'facebook' ) );?>"  name="<?php print esc_attr( $this->get_field_name( 'facebook' ) );?>" value="<?php print esc_attr( $facebook );?>">

			<p>
				<label for="title"><?php esc_html_e( 'Twitter:', 'xpress-companion' );?></label>
			</p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 'twitter' ) );?>"  name="<?php print esc_attr( $this->get_field_name( 'twitter' ) );?>" value="<?php print esc_attr( $twitter );?>">

			<p>
				<label for="title"><?php esc_html_e( 'Instagram:', 'xpress-companion' );?></label>
			</p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 'instagram' ) );?>"  name="<?php print esc_attr( $this->get_field_name( 'instagram' ) );?>" value="<?php print esc_attr( $instagram );?>">
			<p>
				<label for="title"><?php esc_html_e( 'Youtube:', 'xpress-companion' );?></label>
			</p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 'youtube' ) );?>"  name="<?php print esc_attr( $this->get_field_name( 'youtube' ) );?>" value="<?php print esc_attr( $youtube );?>">

			<p>
				<label for="title"><?php esc_html_e( 'linkedin:', 'xpress-companion' );?></label>
			</p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 'linkedin' ) );?>"  name="<?php print esc_attr( $this->get_field_name( 'linkedin' ) );?>" value="<?php print esc_attr( $linkedin );?>">

			<?php
}

    public function update( $new_instance, $old_instance ) {
        $instance = [];
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['description'] = ( !empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';

        $instance['s_title'] = ( !empty( $new_instance['s_title'] ) ) ? strip_tags( $new_instance['s_title'] ) : '';
        $instance['facebook'] = ( !empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
        $instance['twitter'] = ( !empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';
        $instance['instagram'] = ( !empty( $new_instance['instagram'] ) ) ? strip_tags( $new_instance['instagram'] ) : '';
        $instance['youtube'] = ( !empty( $new_instance['youtube'] ) ) ? strip_tags( $new_instance['youtube'] ) : '';
        $instance['linkedin'] = ( !empty( $new_instance['linkedin'] ) ) ? strip_tags( $new_instance['linkedin'] ) : '';

        return $instance;
    }
}