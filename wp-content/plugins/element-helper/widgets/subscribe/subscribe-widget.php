<?php
namespace ElementHelper\Widget;

use \Elementor\Group_Control_Background;
use \Elementor\Repeater;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Subscribe extends Element_El_Widget {

    /**
     * Get widget name.
     *
     * Retrieve Element Helper widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'subscribe';
    }


    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Newslater', 'elementhelper' );
    }

	public function get_custom_help_url() {
		return 'http://elementor.sabber.com/widgets/fact/';
	}

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'elh-widget-icon eicon-mailchimp';
    }

    public function get_keywords() {
        return [ 'subscribe', 'image', 'list' ];
    }

    protected function register_content_controls() {

        $this->start_controls_section(
            '_section_title',
            [
                'label' => __( 'Title & Description', 'elementhelper' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'elementhelper' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'ElhInfo Box Title', 'elementhelper' ),
                'placeholder' => __( 'Type Info Box Title', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'desccription',
            [
                'label' => __( 'Desccription', 'elementhelper' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Heading Desccription Text', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'label' => __( 'Bg Image', 'elementhelper' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'none',
                'exclude' => [
                    'full',
                    'custom',
                    'large',
                    'shop_catalog',
                    'shop_single',
                    'shop_thumbnail'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_mailchimp_title',
            [
                'label' => __( 'Mailchimp/CF7', 'elementhelper' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'mailchimp_shortcode',
            [
                'label' => __( 'Mailchimp Or CF7 Shortcode', 'elementhelper' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'description' => __( 'Add Shortcode.', 'elementhelper' ),
            ]
        );

        $this->end_controls_section();

    }

    protected function register_style_controls() {

        $this->start_controls_section(
            '_section_media_style',
            [
                'label' => __( 'Box Style', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sign-up-newsletter-section h4' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .sign-up-newsletter-section h4
                    ',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Description color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sign-up-newsletter-section p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .sign-up-newsletter-section p
                    ',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => __( 'Button Style', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'arrow_border_radius',
            [
                'label' => __( 'Border Radius', 'elementhelper' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .newsletter-area form button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .newsletter-area form button
                    ',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->start_controls_tabs( '_tabs_buttons-' );

        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => __( 'Normal', 'elementhelper' ),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __( 'Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .newsletter-area form button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .newsletter-area form button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_hover',
            [
                'label' => __( 'Hover', 'elementhelper' ),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __( 'Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .newsletter-area form button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .newsletter-area form button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

	protected function render() {
        $settings = $this->get_settings_for_display();

        $bg_image = wp_get_attachment_image_url( $settings['bg_image']['id'], $settings['thumbnail_size'] );
            if ( $bg_image ) {
                $bg_url = ' style="';
                $bg_url .= ( $bg_image ) ? 'background-image: url( '. esc_url( $bg_image ) .' );' : '';
                $bg_url .= '"';
            } else {
                $bg_url = '';
            }

    ?>

        <section class="sign-up-newsletter-section" <?php echo $bg_url; ?>>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="inner">

                            <?php if ( $settings['title'] ) : ?>
                            <h4> <?php echo elh_element_kses_intermediate( $settings['title'] ); ?></h4>
                            <?php endif; ?>

                            <?php if ( $settings['desccription'] ) : ?>
                            <p><?php echo elh_element_kses_intermediate( $settings['desccription'] ); ?></p>
                            <?php endif; ?>

                            <?php if ( $settings['mailchimp_shortcode'] ) : ?>
                            <div class="newsletter-area">
                                <?php print do_shortcode($settings['mailchimp_shortcode']); ?>
                            </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>
        <?php
    }
}
