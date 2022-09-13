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

class History extends Element_El_Widget
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
    public function get_name(){
        return 'history';
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
        return __('History', 'elementhelper');
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
        return 'elh-widget-icon eicon-single-post';
    }

    public function get_keywords()
    {
        return ['info', 'about', 'content'];
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

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'elementhelper'),

                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Elhinfo box description goes here', 'elementhelper'),
                'placeholder' => __('Type info box description', 'elementhelper'),
                'rows' => 5,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();

        // member list
        $this->start_controls_section(
            '_section_slides',
            [
                'label' => __( 'History List', 'elementhelper' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs(
            '_tab_style_member_box_slider'
        );

        $repeater->start_controls_tab(
            '_tab_member_info',
            [
                'label' => __( 'Left', 'elementhelper' ),
            ]
        );

        $repeater->add_control(
            'show_right',
            [
                'label' => __( 'Show Right?', 'elementhelper' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'elementhelper' ),
                'label_off' => __( 'No', 'elementhelper' ),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'elementhelper' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'count',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Count', 'elementhelper' ),
                'default' => __( '01', 'elementhelper' ),
                'placeholder' => __( 'Type here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'sub_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Sub Title', 'elementhelper' ),
                'default' => __( 'ElhMember Sub Title', 'elementhelper' ),
                'placeholder' => __( 'Type sub title here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Title', 'elementhelper' ),
                'default' => __( 'ElhMember Title', 'elementhelper' ),
                'placeholder' => __( 'Type title here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'description',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'label' => __( 'Description', 'elementhelper' ),
                'default' => __( 'ElhMember description', 'elementhelper' ),
                'placeholder' => __( 'Type description here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            '_tab_member_links',
            [
                'label' => __( 'Right', 'elementhelper' ),
            ]
        );

        $repeater->add_control(
            'image2',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'elementhelper' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'count2',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Count', 'elementhelper' ),
                'default' => __( '01', 'elementhelper' ),
                'placeholder' => __( 'Type here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'sub_title2',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Sub Title', 'elementhelper' ),
                'default' => __( 'ElhMember Sub Title', 'elementhelper' ),
                'placeholder' => __( 'Type sub title here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'title2',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Title', 'elementhelper' ),
                'default' => __( 'ElhMember Title', 'elementhelper' ),
                'placeholder' => __( 'Type title here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'description2',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Description', 'elementhelper' ),
                'default' => __( 'ElhMember description', 'elementhelper' ),
                'placeholder' => __( 'Type description here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        // REPEATER
        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
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
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .sec_title > h2
                    ',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Title Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sec_title > p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .sec_title > p
                    ',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_history',
            [
                'label' => __( 'History Box', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Count Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .history_wrap .history_item .number_box' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_color',
            [
                'label' => __( 'Count Bg Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .history_wrap .history_item .number_box' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'h_sub_color',
            [
                'label' => __( 'Sub title Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .history_wrap .history_item .h_text span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'h_sub_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .history_wrap .history_item .h_text span',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_control(
            '_htitle_color',
            [
                'label' => __( 'Title Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .history_wrap .history_item .h_text h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'h_title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .history_wrap .history_item .h_text h3
                    ',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'h_description_color',
            [
                'label' => __( 'Description Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .history_wrap .history_item .h_text p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'h_description_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .history_wrap .history_item .h_text p
                    ',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $title = elh_element_kses_basic($settings['title']);



        if ($settings['design_style'] === 'style_4'): ?>

        <?php elseif ($settings['design_style'] === 'style_3'): ?>


        <?php elseif ($settings['design_style'] === 'style_2'):?>



        <?php else: ?>

        <section class="history_area pt-120 pb-120">
            <div class="container">
                <div class="history_wrap">
                    <div class="sec_title">

                        <?php if(!empty( $settings['sub_title'] )) : ?>
                        <span><?php echo elh_element_kses_intermediate($settings['sub_title']); ?></span>
                        <?php endif; ?>

                        <?php if(!empty( $title )) : ?>
                        <h2><?php echo elh_element_kses_intermediate($title); ?></h2>
                        <?php endif; ?>

                        <?php if(!empty( $settings['description'] )) : ?>
                        <p><?php echo elh_element_kses_intermediate($settings['description']); ?></p>
                        <?php endif; ?>

                    </div>
                    <div class="row">
                    <?php foreach ($settings['slides'] as $slide):

                        if (!empty($slide['image']['id'])) {
                            $image = wp_get_attachment_image_url( $slide['image']['id'], 'large' );
                            if ( ! $image ) {
                                $image = !empty($slide['image']['url']) ? $slide['image']['url'] : '' ;
                            }
                        }

                        if (!empty($slide['image2']['id'])) {
                            $image2 = wp_get_attachment_image_url( $slide['image2']['id'], $settings['thumbnail_size'] );
                            if ( ! $image2 ) {
                                $image2 = !empty($slide['image2']['url']) ? $slide['image2']['url'] : '' ;
                            }
                        }

                        if($slide['show_right'] == true ) {
                            $wrapper_class = 'history_right';
                        } else {
                            $wrapper_class = 'history_left';
                        }

                    ?>
                        <div class="col-lg-6 col-md-6">
                            <div class="<?php echo $wrapper_class; ?>">
                                <div class="history_item">
                                    <?php if(!empty( $image )) : ?>
                                    <div class="h_thumb">
                                        <img src="<?php echo esc_url($image); ?>" alt="img">
                                    </div>
                                    <?php endif; ?>
                                    <div class="h_text">
                                        <?php if(!empty( $slide['sub_title'] )) : ?>
                                        <span><?php echo elh_element_kses_intermediate($slide['sub_title']); ?></span>
                                        <?php endif; ?>

                                        <?php if(!empty( $slide['title'] )) : ?>
                                        <h3><?php echo elh_element_kses_intermediate($slide['title']); ?></h3>
                                        <?php endif; ?>

                                        <?php if(!empty( $slide['description'] )) : ?>
                                        <p><?php echo elh_element_kses_intermediate($slide['description']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php if(!empty( $slide['count'] )) : ?>
                                    <div class="number_box">
                                        <span><?php echo esc_html($slide['count']); ?></span>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="history_item">
                                    <?php if(!empty( $image2 )) : ?>
                                    <div class="h_thumb">
                                        <img src="<?php echo esc_url($image2); ?>" alt="img">
                                    </div>
                                    <?php endif; ?>
                                    <div class="h_text">
                                        <?php if(!empty( $slide['sub_title2'] )) : ?>
                                        <span><?php echo elh_element_kses_intermediate($slide['sub_title2']); ?></span>
                                        <?php endif; ?>

                                        <?php if(!empty( $slide['title2'] )) : ?>
                                        <h3><?php echo elh_element_kses_intermediate($slide['title2']); ?></h3>
                                        <?php endif; ?>

                                        <?php if(!empty( $slide['description2'] )) : ?>
                                        <p><?php echo elh_element_kses_intermediate($slide['description2']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php if(!empty( $slide['count2'] )) : ?>
                                    <div class="number_box">
                                        <span><?php echo esc_html($slide['count2']); ?></span>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <?php endif; ?>
        <?php
    }
}
