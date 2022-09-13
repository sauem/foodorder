<?php

add_action( 'widgets_init', 'frudbaz_contact_info_widget' );
function frudbaz_contact_info_widget() {
    register_widget( 'frudbaz_contact_info_widget' );
}

class frudbaz_contact_info_widget extends WP_Widget {

    public function __construct() {
        parent::__construct( 'frudbaz_contact_info_widget', esc_html__( 'Frudbaz Contact Info', 'xpress-companion' ), [
            'description' => esc_html__( 'Frudbaz Contact Info Widget', 'xpress-companion' ),
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

        <ul class="c_wrap">
            <?php if ( !empty( $address ) ): ?>
                <li><span><?php print $address_label; ?></span>: <?php print $address; ?></li>
            <?php endif; ?>
            <?php if ( !empty( $mail ) ): ?>
                <li><span><?php print $mail_label; ?></span>: <?php print $mail; ?></li>
            <?php endif; ?>
            <?php if ( !empty( $phone ) ): ?>
                <li><span><?php print $phone_label; ?></span>: <?php print $phone; ?></li>
            <?php endif; ?>
            <?php if ( !empty( $fax ) ): ?>
                <li><span><?php print $fax_label; ?></span>: <?php print $fax; ?></li>
            <?php endif; ?>
        </ul>

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
        $address_label = isset( $instance['address_label'] ) ? $instance['address_label'] : '';
        $address = isset( $instance['address'] ) ? $instance['address'] : '';
        $mail_label = isset( $instance['mail_label'] ) ? $instance['mail_label'] : '';
        $mail = isset( $instance['mail'] ) ? $instance['mail'] : '';
        $phone_label = isset( $instance['phone_label'] ) ? $instance['phone_label'] : '';
        $phone = isset( $instance['phone'] ) ? $instance['phone'] : '';
        $fax_label = isset( $instance['fax_label'] ) ? $instance['fax_label'] : '';
        $fax = isset( $instance['fax'] ) ? $instance['fax'] : '';
        ?>
			<p><label for="title"><?php esc_html_e( 'Title:', 'xpress-companion' );?></label></p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 'title' ) );?>"  name="<?php print esc_attr( $this->get_field_name( 'title' ) );?>" class="widefat" value="<?php print esc_attr( $title );?>">

			<p><label for="title"><?php esc_html_e( 'Address Label', 'xpress-companion' );?></label></p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 'address_label' ) );?>"  name="<?php print esc_attr( $this->get_field_name( 'address_label' ) );?>" value="<?php print esc_attr( $address_label );?>">

			<p><label for="title"><?php esc_html_e( 'Address:', 'xpress-companion' );?></label></p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 'address' ) );?>"  name="<?php print esc_attr( $this->get_field_name( 'address' ) );?>" class="widefat" value="<?php print esc_attr( $address );?>">

			<p><label for="title"><?php esc_html_e( 'Mail Label', 'xpress-companion' );?></label></p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 'mail_label' ) );?>"  name="<?php print esc_attr( $this->get_field_name( 'mail_label' ) );?>" value="<?php print esc_attr( $mail_label );?>">

			<p><label for="title"><?php esc_html_e( 'Mail:', 'xpress-companion' );?></label></p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 'mail' ) );?>"  name="<?php print esc_attr( $this->get_field_name( 'mail' ) );?>" class="widefat" value="<?php print esc_attr( $mail );?>">

			<p><label for="title"><?php esc_html_e( 'Phone Label', 'xpress-companion' );?></label></p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 'phone_label' ) );?>"  name="<?php print esc_attr( $this->get_field_name( 'phone_label' ) );?>" value="<?php print esc_attr( $phone_label );?>">

			<p><label for="title"><?php esc_html_e( 'Phone:', 'xpress-companion' );?></label></p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 'phone' ) );?>"  name="<?php print esc_attr( $this->get_field_name( 'phone' ) );?>" class="widefat" value="<?php print esc_attr( $phone );?>">

			<p><label for="title"><?php esc_html_e( 'Fax Label', 'xpress-companion' );?></label></p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 'fax_label' ) );?>"  name="<?php print esc_attr( $this->get_field_name( 'fax_label' ) );?>" value="<?php print esc_attr( $fax_label );?>">

			<p><label for="title"><?php esc_html_e( 'Fax:', 'xpress-companion' );?></label></p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 'fax' ) );?>"  name="<?php print esc_attr( $this->get_field_name( 'fax' ) );?>" class="widefat" value="<?php print esc_attr( $fax );?>">

			<?php
}

    public function update( $new_instance, $old_instance ) {
        $instance = [];
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['address_label'] = ( !empty( $new_instance['address_label'] ) ) ? strip_tags( $new_instance['address_label'] ) : '';
        $instance['address'] = ( !empty( $new_instance['address'] ) ) ? strip_tags( $new_instance['address'] ) : '';
        $instance['mail_label'] = ( !empty( $new_instance['mail_label'] ) ) ? strip_tags( $new_instance['mail_label'] ) : '';
        $instance['mail'] = ( !empty( $new_instance['mail'] ) ) ? strip_tags( $new_instance['mail'] ) : '';
        $instance['phone_label'] = ( !empty( $new_instance['phone_label'] ) ) ? strip_tags( $new_instance['phone_label'] ) : '';
        $instance['phone'] = ( !empty( $new_instance['phone'] ) ) ? strip_tags( $new_instance['phone'] ) : '';
        $instance['fax_label'] = ( !empty( $new_instance['fax_label'] ) ) ? strip_tags( $new_instance['fax_label'] ) : '';
        $instance['fax'] = ( !empty( $new_instance['fax'] ) ) ? strip_tags( $new_instance['fax'] ) : '';

        return $instance;
    }
}