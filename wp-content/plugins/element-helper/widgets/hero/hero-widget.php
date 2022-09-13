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

class Hero extends Element_El_Widget
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
        return 'hero';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title(){
        return __('Hero', 'elementhelper');
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon(){
        return 'elh-widget-icon eicon-single-post';
    }

    public function get_keywords(){
        return ['info', 'hero', 'content'];
    }

    public function get_script_depends() {
		return ['elh_main_hero'];
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
            'subtitle',
            [
                'label' => __('Sub Title', 'elementhelper'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('Sub Title', 'elementhelper'),
                'placeholder' => __('Type Info Box Title', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1']
                ],
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
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('ElhInfo Box Description', 'elementhelper'),
                'placeholder' => __('Type Info Box Description', 'elementhelper'),
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
            '_section_feature_list',
            [
                'label' => __( 'Featured List', 'elementhelper' ),
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
                    'style_2' => __('Style 2', 'elementhelper'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'number',
            [
                'label' => __( 'Number', 'elementhelper' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( '01', 'elementhelper' ),
                'placeholder' => __( 'Type Box Number Here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_1']
                ],
            ]
        );

        $repeater->add_control(
			'position_right',
			[
				'label' => __( 'Position Right?', 'elementhelper' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'elementhelper' ),
				'label_off' => __( 'Hide', 'elementhelper' ),
				'return_value' => 'yes',
				'default' => 'no',
                'condition' => [
                    'field_condition' => ['style_2']
                ],
			]
		);

        $repeater->add_control(
            'title',
            [
                'label' => __( 'Title', 'elementhelper' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Features Title', 'elementhelper' ),
                'placeholder' => __( 'Type Icon Box Title', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => __( 'Description', 'elementhelper' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => __( 'Rorem ipsum dolor sit amet, etur advoluptatem voluptatem', 'elementhelper' ),
                'placeholder' => __( 'Type description here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
                'default' => [
                    [
                        'number' => __( '01', 'elementhelper' ),
                        'title' => __( 'Title Here', 'elementhelper' ),
                        'description' => __( 'Description Here', 'elementhelper' ),
                    ],
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_social_icons',
            [
                'label' => __( 'Social Links', 'elementhelper' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1', 'style_2']
                ],
            ]
        );

        $repeater = new Repeater();

        if ( elh_element_is_elementor_version( '<', '2.6.0' ) ) {
            $repeater->add_control(
                'icon',
                [
                    'label' => __( 'Icon', 'elementhelper' ),
                    'label_block' => true,
                    'type' => Controls_Manager::ICON,
                    'options' => elh_element_get_elh_element_icons(),
                    'default' => 'fal fa-smile',
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
                ]
            );
        }


        $repeater->add_control(
            'title',
            [
                'label' => __( 'Title', 'elementhelper' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Title', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'button_link',
            [
                'label'       => __( 'Link', 'elementhelper' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'https://www.facebook.com/', 'elementhelper' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'default' => [
					'url' => 'https://www.facebook.com/',
					'is_external' => true,
					'nofollow' => true,
				],
            ]
        );

        $this->add_control(
            'social_icons',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
                'default' => [
                    [
                        'title' => __( 'Title Here', 'elementhelper' ),
                    ],
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_button',
            [
                'label' => __( 'Button', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1']
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'       => __( 'Button Text', 'elementhelper' ),
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
                'label'       => __( 'Button Link', 'elementhelper' ),
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

        $this->add_control(
            'button_text2',
            [
                'label'       => __( 'Button 2 Text', 'elementhelper' ),
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
            'button_link2',
            [
                'label'       => __( 'Button 2 Link', 'elementhelper' ),
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
            '_section_video_button',
            [
                'label' => __( 'Video Button', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1']
                ],
            ]
        );

        $this->add_control(
            'video_button_text',
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
            'video_button_link',
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
            '_section_categories',
            [
                'label' => __( 'Category List', 'elementhelper' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_2']
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'type',
            [
                'label' => __( 'Media Type', 'elementhelper' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'icon' => [
                        'title' => __( 'Icon', 'elementhelper' ),
                        'icon' => 'fal fa-smile',
                    ],
                    'image' => [
                        'title' => __( 'Image', 'elementhelper' ),
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
                'label' => __( 'Image', 'elementhelper' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'type' => 'image'
                ],
                'dynamic' => [
                    'active' => true,
                ]
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
                ]
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
                        'type' => 'icon'
                    ]
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
                        'type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'title',
            [
                'label' => __( 'Title', 'elementhelper' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Cat Title', 'elementhelper' ),
                'placeholder' => __( 'Type Cat Title', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'cat_link',
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

        $this->add_control(
            'categories',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
                'default' => [
                    [
                        'title' => __( 'Title Here', 'elementhelper' ),
                    ],
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_setting',
            [
                'label' => __( 'Settings', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_2']
                ],
            ]
        );

        $this->add_control(
			'show_search',
			[
				'label' => __( 'Search Show?', 'elementhelper' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'elementhelper' ),
				'label_off' => __( 'Hide', 'elementhelper' ),
				'return_value' => 'yes',
				'default' => 'yes',
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
                    '{{WRAPPER}} .hero_area .hero_text h5' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => ['style_1']
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .hero_area .hero_text h5',
                'scheme' => Typography::TYPOGRAPHY_2,
                'condition' => [
                    'design_style' => ['style_1']
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero_area .hero_text h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .hero_area .hero_text h2',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Description Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero_area .hero_text p' => 'color: {{VALUE}}',
                    'condition' => [
                        'design_style' => ['style_1', 'style_2']
                    ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .hero_area .hero_text p',
                'scheme' => Typography::TYPOGRAPHY_2,
                'condition' => [
                    'design_style' => ['style_1', 'style_2']
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_social',
            [
                'label' => __( 'Social Links', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => ['style_1', 'style_2']
                ],
            ]
        );

        $this->add_control(
            'social_color',
            [
                'label' => __( 'Icon Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero_social li i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'social_title_color',
            [
                'label' => __( 'Title Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero_social li a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'social_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .hero_social li a',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_cat',
            [
                'label' => __( 'Category', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => ['style_2']
                ],
            ]
        );

        $this->add_control(
            'cat_icon_color',
            [
                'label' => __( 'Icon Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category_slide .cs_item .cs_icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'cat_title_color',
            [
                'label' => __( 'Title Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category_slide .cs_item .cs_text h5' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cat_title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .category_slide .cs_item .cs_text h5',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_feature',
            [
                'label' => __( 'Feature List', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => ['style_1', 'style_3']
                ],
            ]
        );

        $this->add_control(
            'feature_title_color',
            [
                'label' => __( 'Title Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .info_list li h4' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .hero_feat_wrap .hf_single h4' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'feature_title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .info_list li h4,
                    {{WRAPPER}} .hero_feat_wrap .hf_single h4
                    ',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_control(
            'feature_description_color',
            [
                'label' => __( 'Description Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .info_list li p' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .hero_feat_wrap .hf_single p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'feature_description_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .info_list li p,
                    {{WRAPPER}} .hero_feat_wrap .hf_single p
                    ',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );


        $this->add_control(
            'feature_count_color',
            [
                'label' => __( 'Count Bg Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .info_list li .count' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => ['style_1']
                ],
            ]
        );

        $this->add_control(
            'feature_count_title_color',
            [
                'label' => __( 'Count Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .info_list li .count' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => ['style_1']
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'count_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .info_list li .count',
                'scheme' => Typography::TYPOGRAPHY_2,
                'condition' => [
                    'design_style' => ['style_1']
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_video_btn',
            [
                'label' => __( 'Video Button', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => ['style_1']
                ],
            ]
        );

        $this->add_control(
            'video_icon_bg_color',
            [
                'label' => __( 'Icon Bg Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero_video a span' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'video_icon_color',
            [
                'label' => __( 'Icon Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero_video a span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'video_title_color',
            [
                'label' => __( 'Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero_video a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'video_title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .hero_video a',
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
                    'design_style' => ['style_1', 'style_2']
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
            '{{WRAPPER}} .hero_area .hero_text .hero_btn .thm_btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            '{{WRAPPER}} .hero_search_form button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .hero_area .hero_text .hero_btn .thm_btn,
                    {{WRAPPER}} .hero_search_form button
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
                    '{{WRAPPER}} .hero_area .hero_text .hero_btn .thm_btn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hero_search_form button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero_area .hero_text .hero_btn .thm_btn' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .hero_search_form button' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .hero_area .hero_text .hero_btn .thm_btn:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hero_search_form button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero_area .hero_text .hero_btn .thm_btn:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .hero_search_form button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_button2',
            [
                'label' => __( 'Button 2 Style', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => ['style_1']
                ],
            ]
        );


        $this->add_responsive_control(
            'arrow_border_radius2',
            [
                'label' => __( 'Border Radius', 'elementhelper' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hero_area .hero_text .hero_btn .thm_btn:last-child' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography2',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .hero_area .hero_text .hero_btn .thm_btn:last-child
                    ',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->start_controls_tabs( '_tabs_buttons-2' );

        $this->start_controls_tab(
            '_tab_button_normal2',
            [
                'label' => __( 'Normal', 'elementhelper' ),
            ]
        );

        $this->add_control(
            'button_color2',
            [
                'label' => __( 'Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .hero_area .hero_text .hero_btn .thm_btn:last-child' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color2',
            [
                'label' => __( 'Background Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero_area .hero_text .hero_btn .thm_btn:last-child' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_hover2',
            [
                'label' => __( 'Hover', 'elementhelper' ),
            ]
        );

        $this->add_control(
            'button_hover_color2',
            [
                'label' => __( 'Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero_area .hero_text .hero_btn .thm_btn:last-child:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color2',
            [
                'label' => __( 'Background Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero_area .hero_text .hero_btn .thm_btn:last-child:hover' => 'background-color: {{VALUE}};',
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
            $sm_image = wp_get_attachment_image_url($settings['sm_image']['id'], 'large');
        }

        if ($settings['design_style'] === 'style_3'):

        ?>

    <section class="hero_area hero_3 section_notch_bottom" data-background="<?php echo !empty($bg_image) ? $bg_image : ''; ?>">
        <div class="hero_wrap hero_height">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="hero_content_wrap text-center">

                            <?php if(!empty( $settings['title'] )) : ?>
                            <div class="hero_text">
                                <h2><?php echo elh_element_kses_basic($settings['title']); ?></h2>
                            </div>
                            <?php endif; ?>

                            <?php if(!empty( $sm_image )) : ?>
                            <div class="hero_img">
                                <img src="<?php echo esc_url($sm_image); ?>" alt="img">
                            </div>
                            <?php endif; ?>

                            <div class="hero_feat_wrap">
                            <?php foreach ( $settings['slides'] as $key => $slide ) : ?>
                                <div class="hf_single <?php echo $slide['position_right'] == true ? 'sf_02' : 'sf_01'; ?>">

                                    <?php if( $slide['position_right'] == true ) : ?>
                                        <div class="hf_shape">
                                            <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/shape/hf_02.png" alt="img">
                                        </div>
                                    <?php endif; ?>

                                    <?php if(!empty( $slide['title'] )) : ?>
                                    <h4><?php echo elh_element_kses_basic($slide['title']); ?></h4>
                                    <?php endif; ?>

                                    <?php if(!empty( $slide['description'] )) : ?>
                                    <p><?php echo elh_element_kses_basic($slide['description']); ?></p>
                                    <?php endif; ?>

                                    <?php if($slide['position_right'] == false) : ?>
                                        <div class="hf_shape">
                                            <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/shape/hf_01.png" alt="img">
                                        </div>
                                    <?php endif; ?>

                                </div>
                            <?php endforeach; ?>
                            </div>
                            <div class="hero_shape">
                                <img class="shape hs_01" src="<?php echo get_template_directory_uri(  ); ?>/assets/img/shape/hs_01.png" alt="img">
                                <img class="shape hs_02" src="<?php echo get_template_directory_uri(  ); ?>/assets/img/shape/hs_02.png" alt="img">
                                <img class="shape his_01" src="<?php echo get_template_directory_uri(  ); ?>/assets/img/shape/his_01.png" alt="img">
                                <img class="shape his_02" src="<?php echo get_template_directory_uri(  ); ?>/assets/img/shape/his_02.png" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php  elseif ($settings['design_style'] === 'style_2'): ?>

    <section class="hero_area hero_2" data-background="<?php echo !empty($bg_image) ? $bg_image : ''; ?>">
        <div class="hero_wrap hero_height">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between flex-row-reverse">

                    <?php if(!empty( $sm_image )) : ?>
                    <div class="col-lg-6">
                        <div class="hero_img">
                            <img src="<?php echo esc_url($sm_image); ?>" alt="img">
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="col-lg-6">
                        <div class="hero_text">

                            <?php if(!empty( $settings['title'] )) : ?>
                            <h2><?php echo elh_element_kses_basic($settings['title']); ?></h2>
                            <?php endif; ?>

                            <?php if(!empty( $settings['description'] )) : ?>
                            <p><?php echo elh_element_kses_basic($settings['description']); ?></p>
                            <?php endif; ?>

                            <?php if($settings['show_search'] == true ) : ?>
                            <form class="hero_search_form" method="get" <?php print esc_url( home_url( '/' ) );?>>
                                <input type="search" id="search" name="s" value="<?php print esc_attr( get_search_query() )?>" placeholder="<?php print esc_attr( 'Type your location', 'frudbaz' );?>">
                                <button type="submit" class="search"><i class="fal fa-search"></i>Search</button>
                            </form>
                            <?php endif; ?>

                            <ul class="hero_social ul_li text-uppercase">
                                <?php foreach ( $settings['social_icons'] as $key => $social_icon ) : ?>
                                <?php if(!empty( $social_icon['title'] )) : ?>
                                <li>
                                    <a href="<?php echo esc_url($social_icon['button_link']['url']); ?>">

                                    <?php if ( ! empty( $social_icon['icon'] ) || ! empty( $social_icon['selected_icon']['value'] ) ) : ?>
                                        <?php elh_element_render_icon( $social_icon, 'icon', 'selected_icon' ); ?>
                                    <?php endif; ?>

                                        <?php echo elh_element_kses_basic( $social_icon['title'] ); ?>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <ul class="category_slide">
            <?php foreach ( $settings['categories'] as $key => $cat ) : ?>
            <li class="cs_item">
                <a href="<?php echo esc_url($cat['cat_link']['url']); ?>">
                    <div class="cs_icon">
                        <?php if ( $cat['type'] === 'image' && ( $cat['image']['url'] || $cat['image']['id'] ) ) :
                            $this->get_render_attribute_string( 'image' );
                            $cat['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
                        ?>
                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $cat, 'thumbnail', 'image' ); ?>
                        <?php elseif ( ! empty( $cat['icon'] ) || ! empty( $cat['selected_icon']['value'] ) ) : ?>

                        <?php elh_element_render_icon( $cat, 'icon', 'selected_icon' ); ?>
                        <?php endif; ?>
                    </div>

                    <?php if(!empty( $cat['title'] )) : ?>
                    <div class="cs_text">
                        <h5><?php echo elh_element_kses_basic( $cat['title'] ); ?></h5>
                    </div>
                    <?php endif; ?>

                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <?php else: ?>

    <section class="hero_area hero_1">
        <div class="hero_wrap hero_height hero_bg">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-5">
                    <?php if(!empty( $bg_image )) : ?>
                        <div class="hero_img">
                            <img src="<?php echo esc_url($bg_image); ?>" alt="IMG">
                            <?php if(!empty( $sm_image )) : ?>
                            <div class="d_img">
                                <img src="<?php echo esc_url($sm_image); ?>" alt="IMG">
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-lg-4 col-md-6 order-first">
                        <div class="hero_text">

                            <?php if(!empty( $settings['subtitle'] )) : ?>
                            <h5><?php echo elh_element_kses_basic($settings['subtitle']); ?></h5>
                            <?php endif; ?>

                            <?php if(!empty( $settings['title'] )) : ?>
                            <h2><?php echo elh_element_kses_basic($settings['title']); ?></h2>
                            <?php endif; ?>

                            <?php if(!empty( $settings['description'] )) : ?>
                            <p><?php echo elh_element_kses_basic($settings['description']); ?></p>
                            <?php endif; ?>

                            <div class="hero_btn ul_li">

                                <?php if(!empty( $settings['button_text'] )) : ?>
                                <a class="thm_btn" href="<?php echo esc_html($settings['button_link']['url']); ?>">
                                    <?php echo esc_html($settings['button_text']); ?></a>
                                <?php endif; ?>

                                <?php if(!empty( $settings['button_text2'] )) : ?>
                                <a class="thm_btn thm_btn-2" href="<?php echo esc_html($settings['button_link2']['url']); ?>">
                                <?php echo esc_html($settings['button_text2']); ?></a>
                                <?php endif; ?>

                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <ul class="info_list ul_li_block">
                            <?php foreach ( $settings['slides'] as $key => $slide ) : ?>
                            <li>

                                <?php if(!empty( $slide['title'] )) : ?>
                                <h4><?php echo elh_element_kses_basic( $slide['title'] ); ?></h4>
                                <?php endif; ?>

                                <?php if(!empty( $slide['description'] )) : ?>
                                <p><?php echo elh_element_kses_basic( $slide['description'] ); ?></p>
                                <?php endif; ?>

                                <?php if(!empty( $slide['number'] )) : ?>
                                <div class="count">
                                    <span><?php echo elh_element_kses_basic( $slide['number'] ); ?></span>
                                </div>
                                <?php endif; ?>

                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="hero_bottom">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 col-md-4 order-last">

                            <?php if(!empty( $settings['video_button_text'] )) : ?>
                            <div class="hero_video">
                                <a class="popup-video text-uppercase" href="<?php echo esc_html($settings['video_button_link']['url']); ?>">
                                    <small><?php echo esc_html($settings['video_button_text']); ?></small>
                                    <span><i class="fal fa-play"></i></span>
                                </a>
                            </div>
                            <?php endif; ?>

                        </div>
                        <div class="col-lg-6 col-md-8">
                            <ul class="hero_social ul_li text-uppercase">
                                <?php foreach ( $settings['social_icons'] as $key => $social_icon ) : ?>
                                <?php if(!empty( $social_icon['title'] )) : ?>
                                <li>
                                    <a href="<?php echo esc_url($social_icon['button_link']['url']); ?>">

                                    <?php if ( ! empty( $social_icon['icon'] ) || ! empty( $social_icon['selected_icon']['value'] ) ) : ?>
                                        <?php elh_element_render_icon( $social_icon, 'icon', 'selected_icon' ); ?>
                                    <?php endif; ?>

                                        <?php echo elh_element_kses_basic( $social_icon['title'] ); ?>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
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
