<?php
namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Repeater;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class about_Tab extends Element_El_Widget {

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
        return 'about-tab';
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
        return __( 'About TAB', 'elementhelper' );
    }

	public function get_custom_help_url() {
		return 'http://elementor.sabber.com/widgets/contact-7-form/';
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
        return 'elh-widget-icon eicon-favorite';
    }

    public function get_keywords() {
        return [ 'about', 'tab' ];
    }

	protected function register_content_controls() {

        $this->start_controls_section(
            '_section_design_title',
            [
                'label' => __( 'Design Style', 'elementhelper' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'design_style',
            [
                'label' => __( 'Design Style', 'elementhelper' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'elementhelper' ),
                    'style_2' => __( 'Style 2', 'elementhelper' ),
                    'style_3' => __( 'Style 3', 'elementhelper' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_slides',
            [
                'label' => __( 'Tabs', 'elementhelper' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

         $repeater->add_control(
            'field_condition',
            [
                'label' => __( 'Field condition', 'elementhelper' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'elementhelper' ),
                    'style_2' => __( 'Style 2', 'elementhelper' ),                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );


        if ( elh_element_is_elementor_version( '<', '2.6.0' ) ) {
            $repeater->add_control(
                'icon',
                [
                    'label' => __( 'Icon', 'elementhelper' ),
                    'label_block' => true,
                    'type' => Controls_Manager::ICON,
                    'options' => elh_element_get_elh_element_icons(),
                    'default' => 'fal fa-smile',
                    'condition' => [
                        'field_condition' => ['style_2']
                    ],
                ]
            );
        }
        else {
            $repeater->add_control(
                'selected_icon',
                [
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-smile-wink',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'field_condition' => ['style_2']
                    ],
                ]
            );
        }

        $repeater->add_control(
            'tab_title',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'label' => __( 'Tab Title', 'elementhelper' ),
                'default' => __( 'Tab Title', 'elementhelper' ),
                'placeholder' => __( 'Type title here', 'elementhelper' ),
                'condition' => [
                    'field_condition' => ['style_1']
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'tab_description',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'label' => __( 'Tab Description', 'elementhelper' ),
                'default' => __( 'Tab Description', 'elementhelper' ),
                'placeholder' => __( 'Type description here', 'elementhelper' ),
                'condition' => [
                    'field_condition' => ['style_1']
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'tab_content_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Content Image', 'elementhelper' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_1']
                ],
            ]
        );

        // REPEATER
        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(tab_title || "Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ]
            ]
        );

        $this->end_controls_section();

    }


    // register_style_controls

    protected function register_style_controls() {

		$this->start_controls_section(
            '_section_style_title',
            [
                'label' => __( 'Title & Desccription', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_heading_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'elementhelper' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'heading_margin',
            [
                'label' => __( 'Margin', 'elementhelper' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wc-content .nav-tabs .nav-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_padding',
            [
                'label' => __( 'Padding', 'elementhelper' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wc-content .nav-tabs .nav-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .wc-tab-item .wc-icon li h4, {{WRAPPER}} .about3__wrapper h2, {{WRAPPER}} .about2__right h2',
                'scheme' => Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title',
                'label' => __( 'Text Shadow', 'elementhelper' ),
                'selector' => '{{WRAPPER}} .wc-tab-item .wc-icon li h4, {{WRAPPER}} .about3__wrapper h2, {{WRAPPER}} .about2__right h2',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => __( 'Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wc-tab-item .wc-icon li h4, {{WRAPPER}} .about3__wrapper h2, {{WRAPPER}} .about2__right h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'blend_mode',
            [
                'label' => __( 'Blend Mode', 'elementhelper' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => __( 'Normal', 'elementhelper' ),
                    'multiply' => 'Multiply',
                    'screen' => 'Screen',
                    'overlay' => 'Overlay',
                    'darken' => 'Darken',
                    'lighten' => 'Lighten',
                    'color-dodge' => 'Color Dodge',
                    'saturation' => 'Saturation',
                    'color' => 'Color',
                    'difference' => 'Difference',
                    'exclusion' => 'Exclusion',
                    'hue' => 'Hue',
                    'luminosity' => 'Luminosity',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wc-tab-item .wc-icon li h4, {{WRAPPER}} .about3__wrapper h2, {{WRAPPER}} .about2__right h2' => 'mix-blend-mode: {{VALUE}};',
                ],
                'separator' => 'none',
            ]
        );

        // content

        $this->add_control(
            '_heading_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Content', 'elementhelper' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'heading_desc_margin',
            [
                'label' => __( 'Margin', 'elementhelper' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wc-tab-item p ,{{WRAPPER}} .about3__content p, {{WRAPPER}} .about2__right p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_desc_padding',
            [
                'label' => __( 'Padding', 'elementhelper' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wc-tab-item p ,{{WRAPPER}} .about3__content p, {{WRAPPER}} .about2__right p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desccription',
                'selector' => '{{WRAPPER}} .wc-tab-item p ,{{WRAPPER}} .about3__content p, {{WRAPPER}} .about2__right p',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'desccription',
                'label' => __( 'Text Shadow', 'elementhelper' ),
                'selector' => '{{WRAPPER}} .wc-tab-item p ,{{WRAPPER}} .about3__content p, {{WRAPPER}} .about2__right p',
            ]
        );

        $this->add_control(
            'heading_desc_color',
            [
                'label' => __( 'Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wc-tab-item p ,{{WRAPPER}} .about3__content p, {{WRAPPER}} .about2__right p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        if ( empty( $settings['slides'] ) ) {
            return;
        }

        if ( $settings['design_style'] === 'style_1' ) : ?>
        <section class="why-choose-area">
            <div class="container">
                <div class="row flex-row-reverse align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <nav class="wc-content mt-40">
                            <div class="nav nav-tabs flex-column" id="nav-tab" role="tablist">
                                <?php foreach ( $settings['slides'] as $id => $slide ) :
                                    $active_tab_menu = ($id == 0) ? 'active' : '';
                                ?>
                                <a class="nav-item nav-link <?php echo esc_attr($active_tab_menu); ?>" id="nav-<?php echo esc_attr($id); ?>-tab" data-toggle="tab" href="#nav-<?php echo esc_attr($id); ?>" role="tab" aria-controls="nav-<?php echo esc_attr($id); ?>" aria-selected="false">
                                    <div class="wc-tab-item">
                                        <ul class="wc-icon">
                                            <li><i class="ti-check"></i> <h4><?php echo wp_kses_post( $slide['tab_title'] ); ?></h4></li>
                                        </ul>
                                        <p><?php echo wp_kses_post( $slide['tab_description'] ); ?></p>
                                    </div>
                                </a>
                                <?php endforeach; ?>
                            </div>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="tab-left mt-40">
                            <div class="tab-content" id="nav-tabContent">
                                <?php foreach ( $settings['slides'] as $id => $slide ) :
                                    $active_tab = ($id == 0) ? 'show active' : '';
                                ?>
                                <div class="tab-pane fade <?php echo esc_attr($active_tab); ?>" id="nav-<?php echo esc_attr($id); ?>" role="tabpanel" aria-labelledby="nav-<?php echo esc_attr($id); ?>-tab">
                                    <?php if( !empty( $slide['tab_content_image']['url'] ) ): ?>
                                        <div class="wc-img">
                                        <img src="<?php echo esc_url( $slide['tab_content_image']['url'] ); ?>" alt="img">
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php elseif ( $settings['design_style'] === 'style_2' ) :
            // bg_image
            if (!empty($settings['bg_shape_image']['id'])) {
                $bg_shape_image = wp_get_attachment_image_url( $settings['bg_shape_image']['id'], $settings['thumbnail_size'] );
                if ( ! $bg_shape_image ) {
                    $bg_shape_image = $settings['bg_shape_image']['url'];
                }
            }

            // bg_image 2
            if (!empty($settings['bg_shape_image_2']['id'])) {
                $bg_shape_image_2 = wp_get_attachment_image_url( $settings['bg_shape_image_2']['id'], $settings['thumbnail2_size'] );
                if ( ! $bg_shape_image_2 ) {
                    $bg_shape_image_2 = $settings['bg_shape_image_2']['url'];
                }
            }
        ?>
            <section class="about3">
            <?php if ( !empty( $bg_shape_image ) ) : ?>
            <div class="about3__thumb2">
                <img src="<?php echo esc_url($bg_shape_image); ?>" alt="About Image">
            </div>
            <?php endif; ?>
            <?php if ( !empty( $bg_shape_image_2 ) ) : ?>
            <div class="about3__thumb3">
                <img src="<?php echo esc_url($bg_shape_image_2); ?>" alt="About Image">
            </div>
            <?php endif; ?>

            <div class="content_box_120_70">
                <div class="container">
                    <?php foreach ( $settings['slides'] as $id => $slide ) :
                        if ( !empty($slide['tab_content_image']['id']) ) {
                            $tab_content_image = wp_get_attachment_image_url( !empty($slide['tab_content_image']['id']), !empty($slide['tab_image_size']) );
                            if ( ! $tab_content_image ) {
                                $tab_content_image_url = $slide['tab_content_image']['url'];
                            }
                        }

                        // active class
                        $active_tab = ($id == 0) ? 'show active' : '';
                    ?>
                    <div class="row">
                        <div class="col-lg-6 d-flex align-items-center">
                            <div class="about3__wrapper">
                                <div class="title_style1 mb-20">
                                    <?php if ( !empty($slide['tab_sub_title']) ) : ?>
                                    <h5><?php echo elh_element_kses_basic( $slide['tab_sub_title'] ); ?></h5>
                                    <?php endif; ?>

                                    <?php if ( !empty($slide['tab_content_title']) ) : ?>
                                    <h2><?php echo elh_element_kses_basic( $slide['tab_content_title'] ); ?></h2>
                                    <?php endif; ?>
                                </div>
                                <div class="about3__content mb-50">
                                    <?php if ( !empty($slide['tab_content_info']) ) : ?>
                                        <p><?php echo elh_element_kses_basic( $slide['tab_content_info'] ); ?></p>
                                    <?php endif; ?>
                                   <?php if ( !empty( $slide['button_url'] ) ) : ?>
                                        <a href="<?php echo esc_url( $slide['button_url'] ); ?>" class="site__btn1"><?php echo elh_element_kses_basic( $slide['button_text'] ); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <?php if ( !empty( $tab_content_image_url ) ) : ?>
                            <div class="about3__thumb1 mb-50">
                                <img class="img-fluid" src="<?php echo esc_url($tab_content_image_url); ?>"
                                    alt="About Image">
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <?php elseif ( $settings['design_style'] === 'style_3' ) : ?>
        <section class="about-others">
            <div class="container">
                <?php foreach ( $settings['slides'] as $id => $slide ) :
                    $tab_image = wp_get_attachment_image_url( !empty($slide['tab_image']['id']), !empty($slide['tab_image_size']) );
                    if ( ! $tab_image ) {
                        $tab_image_url = $slide['tab_image']['url'];
                    }

                    $tab_content_image = wp_get_attachment_image_url( !empty($slide['tab_content_image']['id']), !empty($slide['tab_image_size']) );
                    if ( ! $tab_image ) {
                        $tab_content_image_url = $slide['tab_content_image']['url'];
                    }

                    // active class
                    $active_tab = ($id == 0) ? 'show active' : '';
                ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="about2__left">
                            <?php if ( !empty( $tab_content_image_url ) ) : ?>
                            <div class="about2__left-thumb">
                                <img class="img-fluid" src="<?php echo esc_url($tab_content_image_url); ?>"
                                    alt="About Image">
                            </div>
                            <?php endif; ?>
                            <div class="about2__left-content">
                                <div class="about2__left-content-icon">
                                    <?php if ( ! empty( $slide['icon'] ) || ! empty( $slide['selected_icon']['value'] ) ) : ?>
                                        <?php elh_element_render_icon( $slide, 'icon', 'selected_icon' ); ?>
                                    <?php endif; ?>
                                    <?php if ( !empty($slide['tab_img_number']) ) : ?>
                                    <span><?php echo elh_element_kses_basic( $slide['tab_img_number'] ); ?></span>
                                    <?php endif; ?>
                                </div>
                                <?php if ( !empty($slide['tab_img_title']) ) : ?>
                                <div class="about2__left-content-title">
                                    <h3><a href="<?php echo esc_url( $slide['button_url'] ); ?>"><?php echo elh_element_kses_basic( $slide['tab_img_title'] ); ?></a></h3>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about2__right">
                            <div class="title_style1 mb-20">
                                <?php if ( !empty($slide['tab_sub_title']) ) : ?>
                                <h5><?php echo elh_element_kses_basic( $slide['tab_sub_title'] ); ?></h5>
                                <?php endif; ?>

                                <?php if ( !empty($slide['tab_content_title']) ) : ?>
                                <h2><?php echo elh_element_kses_basic( $slide['tab_content_title'] ); ?></h2>
                                <?php endif; ?>
                            </div>

                            <?php if ( !empty($slide['tab_content_info']) ) : ?>
                            <p><?php echo elh_element_kses_basic( $slide['tab_content_info'] ); ?></p>
                            <?php endif; ?>

                            <?php if ( !empty( $slide['button_url'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['button_url'] ); ?>" class="site__btn1"><?php echo elh_element_kses_basic( $slide['button_text'] ); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <?php endif; ?>


        <?php

    }
}