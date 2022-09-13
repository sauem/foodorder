<?php

namespace ElementHelper\Widget;

use \Elementor\Core\Schemes\Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Control_Media;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;

defined('ABSPATH') || die();

class Reservation extends Element_El_Widget
{

    /**
     * Get widget name.
     *
     * Retrieve Element Helper widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'reservation';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return __('Reservation', 'elementhelper');
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'elh-widget-icon eicon-site-title';
    }

    public function get_keywords()
    {
        return ['info', 'blurb', 'box', 'text', 'content'];
    }

    /**
     * Register content related controls
     */
    protected function register_content_controls() {

        $this->start_controls_section(
            '_section_design_title',
            [
                'label' => __('Design Style', 'elementhelper'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'design_style',
            [
                'label' => __('Design Style', 'elementhelper'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'elementhelper'),
                    'style_2' => __('Style 2', 'elementhelper'),
                    'style_3' => __('Style 3', 'elementhelper'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_title',
            [
                'label' => __('Title & Description', 'elementhelper'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __('Sub Title', 'elementhelper'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('ElhInfo Box Sub Title', 'elementhelper'),
                'placeholder' => __('Type Info Box Sub Title', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'elementhelper'),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('ElhInfo Box Title', 'elementhelper'),
                'placeholder' => __('Type Info Box Title', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();

        // img
        $this->start_controls_section(
            '_section_about_image',
            [
                'label' => __('Image', 'elementhelper'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'label' => __('Big Image', 'elementhelper'),
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
                'default' => 'large',
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_cf7',
            [
                'label' => elh_element_is_cf7_activated() ? __('Contact Form 7', 'elementhelper') : __('Missing Notice', 'elementhelper'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        if (!elh_element_is_cf7_activated()) {
            $this->add_control(
                '_cf7_missing_notice',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => sprintf(
                        __('Hello %2$s, looks like %1$s is missing in your site. Please click on the link below and install/activate %1$s. Make sure to refresh this page after installation or activation.', 'elementhelper'),
                        '<a href="' . esc_url(admin_url('plugin-install.php?s=Contact+Form+7&tab=search&type=term'))
                        . '" target="_blank" rel="noopener">Contact Form 7</a>',
                        elh_element_get_current_user_display_name()
                    ),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-danger',
                ]
            );

            $this->add_control(
                '_cf7_install',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => '<a href="' . esc_url(admin_url('plugin-install.php?s=Contact+Form+7&tab=search&type=term')) . '" target="_blank" rel="noopener">Click to install or activate Contact Form 7</a>',
                ]
            );
            $this->end_controls_section();
            return;
        }

        $this->add_control(
            'form_id',
            [
                'label' => __('Select Your Form', 'elementhelper'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => ['' => __('', 'elementhelper')] + \elh_element_get_cf7_forms(),
            ]
        );

        $this->add_control(
            'html_class',
            [
                'label' => __('HTML Class', 'elementhelper'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'description' => __('Add CSS custom class to the form.', 'elementhelper'),
            ]
        );

        $this->end_controls_section();


    }

    /**
     * Register styles related controls
     */
    protected function register_style_controls(){
        $this->start_controls_section(
            '_section_style_titleinfo',
            [
                'label' => __( 'Title & Info', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Sub Title Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sec_title > span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .sec_title > span',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sec_title > h2' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .reserve_table_form .from_title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .sec_title > h2,
                    {{WRAPPER}} .reserve_table_form .from_title
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
                    '{{WRAPPER}} .thm_btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .thm_btn
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
                    '{{WRAPPER}} .thm_btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .thm_btn' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .thm_btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .thm_btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if (!elh_element_is_cf7_activated()) {
            return;
        }

        if (!empty($settings['bg_image']['id'])) {
            $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['thumbnail_size']);
        }

        if ( $settings['design_style'] === 'style_3' ):
        ?>

        <section class="reservation_area pt-120 pb-120">
            <div class="container">
                <div class="reserve_table_form">

                    <?php if(!empty( $settings['title'] )) : ?>
                    <h2 class="from_title"><?php echo elh_element_kses_intermediate($settings['title']); ?></h2>
                    <?php endif; ?>

                    <?php
                        if (!empty($settings['form_id'])) {
                            echo elh_element_do_shortcode('contact-form-7', [
                                'id' => $settings['form_id'],
                                'html_class' => 'elh-cf7-form ' . elh_element_sanitize_html_class_param($settings['html_class']),
                            ]);
                        }
                    ?>
                </div>
            </div>
        </section>

        <?php elseif ( $settings['design_style'] === 'style_2' ): ?>

        <section class="reservation_area" data-background="<?php echo get_template_directory_uri(  ); ?>/assets/img/bg/reservation_bg.jpg">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-lg-6">

                        <?php if(!empty( $bg_image )) : ?>
                        <div class="reservation_img">
                            <img src="<?php echo esc_url($bg_image); ?>" alt="img">
                        </div>
                        <?php endif; ?>

                    </div>
                    <div class="col-lg-6">
                        <div class="reservation_form_wrap">
                            <div class="sec_title sec_title-white text-center">

                                <?php if(!empty( $settings['sub_title'] )) : ?>
                                <span><?php echo elh_element_kses_intermediate($settings['sub_title']); ?></span>
                                <?php endif; ?>

                                <?php if(!empty( $settings['title'] )) : ?>
                                <h2><?php echo elh_element_kses_intermediate($settings['title']); ?></h2>
                                <?php endif; ?>

                            </div>
                            <div class="form_wrap">
                            <?php
                                if (!empty($settings['form_id'])) {
                                    echo elh_element_do_shortcode('contact-form-7', [
                                        'id' => $settings['form_id'],
                                        'html_class' => 'elh-cf7-form ' . elh_element_sanitize_html_class_param($settings['html_class']),
                                    ]);
                                }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php else: ?>

        <section class="reservation_area" data-background="<?php echo get_template_directory_uri(  ); ?>/assets/img/bg/reservation_bg.jpg">
            <div class="container-fluid p-0">
                <div class="row g-0 flex-row-reverse">
                    <div class="col-lg-6">

                        <?php if(!empty( $bg_image )) : ?>
                        <div class="reservation_img">
                            <img src="<?php echo esc_url($bg_image); ?>" alt="img">
                        </div>
                        <?php endif; ?>

                    </div>
                    <div class="col-lg-6">
                        <div class="reservation_form_wrap">
                            <div class="sec_title sec_title-white text-center">

                                <?php if(!empty( $settings['sub_title'] )) : ?>
                                <span><?php echo elh_element_kses_intermediate($settings['sub_title']); ?></span>
                                <?php endif; ?>

                                <?php if(!empty( $settings['title'] )) : ?>
                                <h2><?php echo elh_element_kses_intermediate($settings['title']); ?></h2>
                                <?php endif; ?>

                            </div>
                            <div class="form_wrap">
                            <?php
                                if (!empty($settings['form_id'])) {
                                    echo elh_element_do_shortcode('contact-form-7', [
                                        'id' => $settings['form_id'],
                                        'html_class' => 'elh-cf7-form ' . elh_element_sanitize_html_class_param($settings['html_class']),
                                    ]);
                                }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>
        <?php
    }
}
