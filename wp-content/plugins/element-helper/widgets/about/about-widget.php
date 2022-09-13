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

class About extends Element_El_Widget
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
        return 'about';
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
        return __('About', 'elementhelper');
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

        $this->add_control(
            'short_description',
            [
                'label' => __('Short Description', 'elementhelper'),

                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Elhinfo box short description goes here', 'elementhelper'),
                'placeholder' => __('Type info box short description', 'elementhelper'),
                'rows' => 5,
                'dynamic' => [
                    'active' => true,
                ],
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

        $this->add_control(
            'sm_image',
            [
                'label' => __('Small Image', 'elementhelper'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_3']
                ],
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
            '_section_features_list',
            [
                'label' => __('Features List', 'elementhelper'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1', 'style_3']
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'field_condition',
            [
                'label' => __('Field condition', 'elementhelper'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'elementhelper'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'type',
            [
                'label' => __('Media Type', 'elementhelper'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'icon' => [
                        'title' => __('Icon', 'elementhelper'),
                        'icon' => 'fal fa-smile',
                    ],
                    'image' => [
                        'title' => __('Image', 'elementhelper'),
                        'icon' => 'fa fa-image',
                    ],
                ],
                'default' => 'icon',
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => __('Image', 'elementhelper'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'type' => 'image'
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_group_control(
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
                'condition' => [
                    'type' => 'image'
                ],
            ]
        );

        if (elh_element_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'icon',
                [
                    'label' => __('Icon', 'elementhelper'),
                    'label_block' => true,
                    'type' => Controls_Manager::ICON,
                    'options' => elh_element_get_elh_element_icons(),
                    'default' => 'fal fa-smile',
                    'condition' => [
                        'type' => 'icon'
                    ],
                ]
            );
        } else {
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
                        'type' => 'icon'
                    ],
                ]
            );
        }

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Title', 'elementhelper'),
                'default'     => __( 'Title', 'elementhelper' ),
                'placeholder' => __('Type title here', 'elementhelper'),
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
                'label' => __('Content', 'elementhelper'),
                'default'     => __( 'App allows users to earn points based on their daily engagement & activities using interesting', 'elementhelper' ),
                'placeholder' => __('Type title here', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_2']
                ],
            ]
        );


        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_about_exp',
            [
                'label' => __( 'About Experience', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'about_exp_year',
            [
                'label'       => __( 'Experience Year', 'elementhelper' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( '25', 'elementhelper' ),
                'placeholder' => __( 'Type button text here', 'elementhelper' ),
                'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'about_exp_sign',
            [
                'label'       => __( 'Sign', 'elementhelper' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( '+', 'elementhelper' ),
                'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_2'],
                ],
            ]
        );

        $this->add_control(
            'about_exp_title',
            [
                'label'       => __( 'Experience Title', 'elementhelper' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'YEARS OF', 'elementhelper' ),
                'placeholder' => __( 'Type button text here', 'elementhelper' ),
                'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'about_exp_title2',
            [
                'label'       => __( 'Experience Title 2', 'elementhelper' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'EXPERIENCE', 'elementhelper' ),
                'placeholder' => __( 'Type button text here', 'elementhelper' ),
                'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_2'],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_button',
            [
                'label' => __( 'Button', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_3'],
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'       => __( 'Text', 'elementhelper' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Button Text', 'elementhelper' ),
                'placeholder' => __( 'Type button text here', 'elementhelper' ),
                'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label'       => __( 'Link', 'elementhelper' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'http://elementor.sabber.com', 'elementhelper' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'default' => [
					'url' => 'http://elementor.sabber.com',
					'is_external' => true,
					'nofollow' => true,
				],
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            '_section_counters',
            [
                'label' => __( 'Counter List', 'elementhelper' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_4'],
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'number',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Fact Number', 'elementhelper' ),
                'default' => __( '70', 'elementhelper' ),
                'placeholder' => __( 'Type number here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'number_sign',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Fact Number Sign', 'elementhelper' ),
                'default' => __( '+', 'elementhelper' ),
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
                'placeholder' => __( 'Type title here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'counters',
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
                    {{WRAPPER}} .sec_title > h2',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Description Color', 'elementhelper' ),
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
                    {{WRAPPER}} .sec_title > p',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'short_description_color',
            [
                'label' => __( 'Short Description Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sec_title p:last-child' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'short_description_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .sec_title p:last-child',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_post',
            [
                'label' => __( 'Year & Exprience', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'year_title',
            [
                'label' => __( 'Year title Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .year_content_wrap span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .experience_text h2 span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'year_title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .year_content_wrap span,
                    {{WRAPPER}} .experience_text h2 span
                    ',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_control(
            'year',
            [
                'label' => __( 'Year Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .year_content_wrap h2' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .experience_text h1' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .experience_text h1 span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'year_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .year_content_wrap h2,
                    {{WRAPPER}} .experience_text h1
                    ',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_control(
            'year_exp',
            [
                'label' => __( 'Exprience Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .experience_text h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'year_exp_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .experience_text h2
                    ',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_control(
            'year_border_exp',
            [
                'label' => __( 'Exprience Border Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .experience_text' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_feature',
            [
                'label' => __( 'Feature', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'feature_icon_color',
            [
                'label' => __( 'Icon Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about_info_wrap .ai_icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .services_content .a_info_list.ul_li li i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'feature_title_color',
            [
                'label' => __( 'Icon Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about_info_wrap h4' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .services_content .a_info_list.ul_li li' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'feature_title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .about_info_wrap h4,
                    {{WRAPPER}} .services_content .a_info_list.ul_li li
                    ',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => __( 'Button Style', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => ['style_3']
                ],
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

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $title = elh_element_kses_basic($settings['title']);

        if (!empty($settings['bg_image']['id'])) {
            $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['thumbnail_size']);
        }

        if (!empty($settings['sm_image']['id'])) {
            $sm_image = wp_get_attachment_image_url($settings['sm_image']['id'], $settings['thumbnail_size']);
        }

        if ($settings['design_style'] === 'style_4'): ?>

        <?php elseif ($settings['design_style'] === 'style_3'): ?>

        <section class="services_area services_2 pt-120 pb-120">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <?php if (!empty($bg_image)): ?>
                        <div class="services_img">
                            <img src="<?php echo esc_url($bg_image); ?>" alt="img">
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-6">
                        <div class="services_content">
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
                            <ul class="a_info_list ul_li">
                                <?php foreach ($settings['slides'] as $slide): ?>
                                <li>
                                    <?php if ($slide['type'] === 'image' && ($slide['image']['url'] || $slide['image']['id'])) :
                                        $this->get_render_attribute_string('image');
                                        $slide['hover_animation'] = 'disable-animation'; ?>
                                        <?php echo Group_Control_Image_Size::get_attachment_image_html($slide, 'thumbnail', 'image'); ?>
                                    <?php elseif (!empty($slide['icon']) || !empty($slide['selected_icon']['value'])) : ?>
                                        <?php elh_element_render_icon($slide, 'icon', 'selected_icon'); ?>
                                    <?php endif; ?>

                                    <?php if (!empty($slide['title'])) : ?>
                                    <?php echo elh_element_kses_basic($slide['title']); ?>
                                    <?php endif; ?>

                                </li>
                                <?php endforeach; ?>
                            </ul>

                            <?php if(!empty( $settings['button_text'] )) : ?>
                            <div class="service_btn mt-10">
                                <a class="thm_btn" href="<?php echo esc_url($settings['button_link']['url']); ?>">
                                <?php echo esc_html($settings['button_text']) ?></a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php elseif ($settings['design_style'] === 'style_2'):?>

        <section class="services_area services_space white_bg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">

                        <?php if (!empty($bg_image)): ?>
                        <div class="services_img">
                            <img src="<?php echo esc_url($bg_image); ?>" alt="img">
                        </div>
                        <?php endif; ?>

                    </div>
                    <div class="col-lg-6">
                        <div class="services_content">
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

                                <?php if(!empty( $settings['short_description'] )) : ?>
                                <p><?php echo elh_element_kses_intermediate($settings['short_description']); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="experience_text">
                                <h1>
                                    <?php if(!empty( $settings['about_exp_year'] )) : ?>
                                    <?php echo esc_html($settings['about_exp_year']); ?>
                                    <?php endif; ?>

                                    <?php if(!empty( $settings['about_exp_sign'] )) : ?>
                                    <span><?php echo esc_html($settings['about_exp_sign']); ?></span>
                                    <?php endif; ?>
                                </h1>

                                <h2>
                                    <?php if(!empty( $settings['about_exp_title'] )) : ?>
                                    <span><?php echo esc_html($settings['about_exp_title']); ?></span>
                                    <?php endif; ?>

                                    <?php if(!empty( $settings['about_exp_title2'] )) : ?>
                                    <br><?php echo esc_html($settings['about_exp_title2']); ?>
                                    <?php endif; ?>

                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php else: ?>

        <section class="about_area pt-120">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about_left">

                            <?php if (!empty($bg_image)): ?>
                            <img src="<?php echo esc_url($bg_image); ?>" alt="img">
                            <?php endif; ?>

                            <div class="year_content_wrap text-center">

                                <?php if(!empty($settings['about_exp_title'])) : ?>
                                <span><?php echo esc_html($settings['about_exp_title']); ?></span>
                                <?php endif; ?>

                                <?php if(!empty($settings['about_exp_year'])) : ?>
                                <h2><?php echo esc_html($settings['about_exp_year']); ?></h2>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about_right">
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

                                <?php if(!empty( $settings['short_description'] )) : ?>
                                <p><?php echo elh_element_kses_intermediate($settings['short_description']); ?></p>
                                <?php endif; ?>
                            </div>
                            <ul class="about_info_wrap ul_li">
                                <?php foreach ($settings['slides'] as $slide): ?>
                                <li class="ai_single">
                                    <div class="ai_icon">
                                        <?php if ($slide['type'] === 'image' && ($slide['image']['url'] || $slide['image']['id'])) :
                                            $this->get_render_attribute_string('image');
                                            $slide['hover_animation'] = 'disable-animation'; ?>
                                            <?php echo Group_Control_Image_Size::get_attachment_image_html($slide, 'thumbnail', 'image'); ?>
                                        <?php elseif (!empty($slide['icon']) || !empty($slide['selected_icon']['value'])) : ?>
                                            <?php elh_element_render_icon($slide, 'icon', 'selected_icon'); ?>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($slide['title'])) : ?>
                                    <h4><?php echo elh_element_kses_basic($slide['title']); ?></h4>
                                    <?php endif; ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>
        <?php
    }
}
