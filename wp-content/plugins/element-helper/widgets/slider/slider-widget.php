<?php
namespace ElementHelper\Widget;

use \Elementor\Group_Control_Background;
use \Elementor\Repeater;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \ElementHelper\Element_El_Select2;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Slider extends Element_El_Widget {

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
        return 'slider';
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
        return __( 'Slider', 'elementhelper' );
    }

    public function get_custom_help_url() {
        return 'http://elementor.sabber.com/widgets/slider/';
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
        return 'elh-widget-icon eicon-slider-full-screen';
    }

    public function get_keywords() {
        return [ 'slider', 'image', 'gallery', 'carousel' ];
    }


    public function get_script_depends() {
		return ['elh_main_slider'];
	}

    public function get_post_types() {
        $post_types = elh_element_get_post_types([], ['elementor_library', 'attachment']);
        return $post_types;
    }

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
                    'style_1' => __('Style 1: Home 1', 'elementhelper'),
                    'style_2' => __('Style 2: Home 2', 'elementhelper'),
                    'style_3' => __('Style 3: Home 4', 'elementhelper'),
                    'style_4' => __('Style 4: Home 5', 'elementhelper'),
                    'style_5' => __('Style 5: Home 6', 'elementhelper'),
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
                'label' => __('Title & Info', 'elementhelper'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => __('Sub Title', 'elementhelper'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('ElhInfo Box Sub Title', 'elementhelper'),
                'placeholder' => __('Type Info Box Sub Title', 'elementhelper'),
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
                'type' => Controls_Manager::TEXT,
                'default' => __('ElhInfo Box Title', 'elementhelper'),
                'placeholder' => __('Type Info Box Title', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1', 'style_2']
                ],
            ]
        );

        $this->add_control(
            'description',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'label' => __( 'Description', 'elementhelper' ),
                'default' => __( 'Description content here', 'elementhelper' ),
                'placeholder' => __( 'Write description', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_2']
                ]
            ]
        );

        $this->add_control(
            'collection_name',
            [
                'label' => __('Collection Name', 'elementhelper'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Winter collections', 'elementhelper'),
                'placeholder' => __('Type here', 'elementhelper'),
                'rows' => 5,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1']
                ],
            ]
        );

        $this->add_control(
            'author_desc',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'label' => __( 'Customer Comment', 'elementhelper' ),
                'default' => __( 'Write Comment', 'elementhelper' ),
                'placeholder' => __( 'Customer comment goes here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1']
                ],
            ]
        );

        $this->add_control(
            'author_name',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Name', 'elementhelper' ),
                'default' => __( 'Michel', 'elementhelper' ),
                'placeholder' => __( 'Type author name', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1']
                ],
            ]
        );

        $this->add_control(
            'author_opinion',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Author Opinion', 'elementhelper' ),
                'default' => __( 'Excellent', 'elementhelper' ),
                'placeholder' => __( 'Type here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1']
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_product',
            [
                'label' => __('Product Info', 'elementhelper'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1', 'style_2']
                ],
            ]
        );

        $this->add_control(
            'post_id',
            [
                'label' => __('Select Product', 'elementhelper'),
                'label_block' => true,
                'type' => Element_El_Select2::TYPE,
                'multiple' => false,
                'placeholder' => 'Search Product',
                'data_options' => [
                    'post_type' => 'product',
                    'action' => 'elh_element_post_list_query'
                ],
            ]
        );

        $this->add_control(
            'product_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Product Title', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_2']
                ],
                'default' => __('Gray chair in white concrete room', 'elementhelper'),
            ]
        );

        $this->add_control(
            'rating_count',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Product Rating Number', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __('12', 'elementhelper'),
                'condition' => [
                    'design_style' => ['style_2']
                ],
            ]
        );

        $this->add_control(
            'start_form',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Price Start Text', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __('Start from', 'elementhelper'),
                'condition' => [
                    'design_style' => ['style_2']
                ],
            ]
        );

        $this->add_control(
            'start_product_price',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Price Start Form Price', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __('$87.21', 'elementhelper'),
                'condition' => [
                    'design_style' => ['style_2']
                ],
            ]
        );

        $this->add_control(
            'discount_percentage',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Discount Percentage', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __('25%', 'elementhelper'),
                'condition' => [
                    'design_style' => ['style_2']
                ],
            ]
        );

        $this->add_control(
            'discount_text',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Discount Text', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __('OFF', 'elementhelper'),
                'condition' => [
                    'design_style' => ['style_2']
                ],
            ]
        );

        $this->add_control(
            'view_details_text',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'View Details Text', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __('View details', 'elementhelper'),
                'condition' => [
                    'design_style' => ['style_2']
                ],
            ]
        );


        $this->add_control(
            'product_link',
            [
                'label'       => __( 'Product Link', 'elementhelper' ),
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
            '_section_slides',
            [
                'label' => __( 'Slides', 'elementhelper' ),
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
                    'style_1' => __( 'Style 1: Home 1', 'elementhelper' ),
                    'style_2' => __( 'Style 2: Home 4', 'elementhelper' ),
                    'style_3' => __( 'Style 3: Home 5', 'elementhelper' ),
                    'style_4' => __( 'Style 4: Home 6', 'elementhelper' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
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
                ],
            ]
        );

        $repeater->add_control(
            'video_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Video Image', 'elementhelper' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_2'],
                ],
            ]
        );

        $repeater->add_control(
            'video_link',
            [
                'label'       => __( 'Video Link', 'elementhelper' ),
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
                'condition' => [
                    'field_condition' => ['style_2'],
                ],
            ]
        );

        $repeater->add_control(
            'subtitle',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'Sub Title', 'elementhelper' ),
                'default' => __( 'Subtitle', 'elementhelper' ),
                'placeholder' => __( 'Type subtitle here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_2', 'style_3', 'style_4'],
                ],
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'label' => __( 'Title', 'elementhelper' ),
                'default' => __( 'Title Here', 'elementhelper' ),
                'placeholder' => __( 'Type title here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_2', 'style_3', 'style_4'],
                ],
            ]
        );

        $repeater->add_control(
            'price_start',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'label' => __( 'Price start', 'elementhelper' ),
                'default' => __( 'Start Form $10.99', 'elementhelper' ),
                'placeholder' => __( 'Type title here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_4'],
                ],
            ]
        );

        // button one
        $repeater->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'elementhelper' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Button Text',
                'placeholder' => __( 'Type button text here', 'elementhelper' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_2', 'style_3', 'style_4'],
                ],
            ]
        );

        $repeater->add_control(
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
                'condition' => [
                    'field_condition' => ['style_2', 'style_3', 'style_4'],
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

        $this->start_controls_section(
            '_section_features',
            [
                'label' => __( 'Features', 'elementhelper' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_4']
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'f_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'elementhelper' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'f_subtitle',
            [
                'label' => __( 'Sub Title', 'elementhelper' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Sub title here',
                'placeholder' => __( 'Type text here', 'elementhelper' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'f_title',
            [
                'label' => __( 'Title', 'elementhelper' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Title Here',
                'placeholder' => __( 'Type text here', 'elementhelper' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        // button one
        $repeater->add_control(
            'f_button_text',
            [
                'label' => __( 'Button Text', 'elementhelper' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Shop Now',
                'placeholder' => __( 'Type button text here', 'elementhelper' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'f_button_link',
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
            'features',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(f_title || "Carousel Item"); #>',
                'default' => [
                    [
                        'f_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'f_thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
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
                    'design_style' => ['style_1', 'style_2'],
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

    }

    protected function register_style_controls() {

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
                    '{{WRAPPER}} .hero-style-1 .product-details .slide-sub' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .hero-style-4 .slide-text p' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .parts-hero-section .parts-hero-slider .details > span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .hero-style-5 .slide-text p' => 'color: {{VALUE}}',
                ],
                'condition'=> [
                    'design_style' => ['style_1', 'style_3', 'style_4', 'style_5']
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .hero-style-1 .product-details .slide-sub,
                    {{WRAPPER}} .hero-style-4 .slide-text p,
                    {{WRAPPER}} .parts-hero-section .parts-hero-slider .details > span,
                    {{WRAPPER}} .hero-style-5 .slide-text p',
                'scheme' => Typography::TYPOGRAPHY_2,
                'condition'=> [
                    'design_style' => ['style_1', 'style_3', 'style_4', 'style_5']
                ]
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-style-1 .product-details h2' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .hero-style-2 h2' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .hero-style-4 h2' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .hero-style-4 h2 span' => 'text-stroke: 2px {{VALUE}}; -webkit-text-stroke: 2px {{VALUE}}',
                    '{{WRAPPER}} .parts-hero-section .parts-hero-slider h2' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .hero-style-5 h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .hero-style-1 .product-details h2,
                    {{WRAPPER}} .hero-style-2 h2,
                    {{WRAPPER}} .hero-style-4 h2,
                    {{WRAPPER}} .hero-style-5 h2,
                    {{WRAPPER}} .parts-hero-section .parts-hero-slider h2',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Description Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-style-2 p' => 'color: {{VALUE}}',
                ],
                'condition'=> [
                    'design_style' => ['style_2']
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .hero-style-2 p',
                'scheme' => Typography::TYPOGRAPHY_2,
                'condition'=> [
                    'design_style' => ['style_2']
                ]
            ]
        );

        $this->add_control(
            'collection_color',
            [
                'label' => __( 'Collection Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-style-1 .right-col h3' => 'color: {{VALUE}}',
                ],
                'condition'=> [
                    'design_style' => ['style_1']
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'collection_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .hero-style-1 .right-col h3',
                'scheme' => Typography::TYPOGRAPHY_2,
                'condition'=> [
                    'design_style' => ['style_1']
                ]
            ]
        );

        $this->add_control(
            'price_start_color',
            [
                'label' => __( 'Price Start Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-style-5 .slide-title p' => 'color: {{VALUE}}',
                ],
                'condition'=> [
                    'design_style' => ['style_5']
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_start_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .hero-style-5 .slide-title p',
                'scheme' => Typography::TYPOGRAPHY_2,
                'condition'=> [
                    'design_style' => ['style_5']
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_authorinfo',
            [
                'label' => __( 'Author Info', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'=> [
                    'design_style' => ['style_1']
                ]
            ]
        );

        $this->add_control(
            'author_desc_color',
            [
                'label' => __( 'Description Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-style-1 .right-col .quote p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'author_desc_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .hero-style-1 .right-col .quote p',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'author_name_color',
            [
                'label' => __( 'Name Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-style-1 .right-col .quote p span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'author_name_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .hero-style-1 .right-col .quote p span',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'author_opinion_color',
            [
                'label' => __( 'Opinion Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-style-1 .right-col .quote .rating > div' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'author_opinion_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .hero-style-1 .right-col .quote .rating > div',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'author_rating_color',
            [
                'label' => __( 'Star Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-style-1 .right-col .quote i:before' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_discount',
            [
                'label' => __( 'Discount Style', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'=> [
                    'design_style' => ['style_2']
                ]
            ]
        );

        $this->add_control(
            'discount_text_color',
            [
                'label' => __( 'Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-style-2 .seal-off h4' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'discount_big_typography',
                'label' => __('Big Text Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .hero-style-2 .seal-off h4',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'discount_small_typography',
                'label' => __('Small Text Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .hero-style-2 .seal-off h4 span',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'discount_bg_color',
            [
                'label' => __( 'Box Bg Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-style-2 .seal-off' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .hero-style-2 .seal-off:after' => 'background: {{VALUE}}; opacity: .5',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => __( 'Main Button Style', 'elementhelper' ),
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
                    '{{WRAPPER}} .theme-btn-s2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .theme-btn-s4' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .theme-btn-s6' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .theme-btn-s7' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .theme-btn-s8' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( '_tabs_buttons-' );

        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => __( 'Normal', 'elementhelper' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .theme-btn-s2,
                    {{WRAPPER}} .theme-btn-s4,
                    {{WRAPPER}} .theme-btn-s6,
                    {{WRAPPER}} .theme-btn-s7,
                    {{WRAPPER}} .theme-btn-s8
                    ',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __( 'Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .theme-btn-s2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .theme-btn-s4' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .theme-btn-s6' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .theme-btn-s7' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .theme-btn-s8' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .theme-btn-s2' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .theme-btn-s4' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .theme-btn-s6' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .theme-btn-s7' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .theme-btn-s8' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label' => __( 'Border Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .theme-btn-s2:before' => 'background-color: {{VALUE}};',
                ],
                'condition'=> [
                    'design_style' => ['style_1']
                ]
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
                    '{{WRAPPER}} .theme-btn-s2:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .theme-btn-s4:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .theme-btn-s6:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .theme-btn-s7:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .theme-btn-s8:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .theme-btn-s2:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .theme-btn-s4:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .theme-btn-s6:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .theme-btn-s7:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .theme-btn-s8:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __( 'Border Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .theme-btn-s2:hover:before' => 'background-color: {{VALUE}};',
                ],
                'condition'=> [
                    'design_style' => ['style_1']
                ]
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_button2',
            [
                'label' => __( 'Add to Cart Style', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'=> [
                    'design_style' => ['style_1', 'style_2']
                ]
            ]
        );

        $this->add_control(
            'cart_box_color',
            [
                'label' => __( 'Cart box Bg', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-style-1 .product-details .product-option' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .hero-style-2 .product-option' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __( 'Price Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-style-1 .product-details .price' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hero-style-2 .product-option .price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'price_input_color',
            [
                'label' => __( 'Input Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-style-1 .product-details .bootstrap-touchspin input' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hero-style-2 .product-option .bootstrap-touchspin input' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'price_input_sign',
            [
                'label' => __( 'Indicator Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-style-1 .product-details .bootstrap-touchspin button' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hero-style-2 .product-option .bootstrap-touchspin button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button2_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __('Button', 'elementhelper'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'button2_border_radius',
            [
                'label' => __( 'Border Radius', 'elementhelper' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .theme-btn-s2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( '_tabs_buttons2-' );

        $this->start_controls_tab(
            '_tab_button2_normal',
            [
                'label' => __( 'Normal', 'elementhelper' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button2_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .add-cart',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'button2_color',
            [
                'label' => __( 'Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .add-cart span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button2_bg_color',
            [
                'label' => __( 'Background Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .add-cart' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button2_hover',
            [
                'label' => __( 'Hover', 'elementhelper' ),
            ]
        );

        $this->add_control(
            'button2_hover_color',
            [
                'label' => __( 'Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .add-cart:hover span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .add-cart:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button2_hover_bg_color',
            [
                'label' => __( 'Background Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .add-cart:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_button3',
            [
                'label' => __( 'View Details Style', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'=> [
                    'design_style' => ['style_2']
                ]
            ]
        );

        $this->add_control(
            'product_title_color',
            [
                'label' => __( 'Title Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-style-2 .product-details h4' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'product_star_color',
            [
                'label' => __( 'Star Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-style-2 .product-details .rating .fi:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'product_review_color',
            [
                'label' => __( 'Review text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-style-2 .product-details .rating > span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'product_price_label_color',
            [
                'label' => __( 'Start From Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-style-2 .product-details p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'product_price_color',
            [
                'label' => __( 'Price Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-style-2 .product-details p span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button3_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __('Button', 'elementhelper'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'button3_border_radius',
            [
                'label' => __( 'Border Radius', 'elementhelper' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sm-btn-s2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( '_tabs_buttons3-' );

        $this->start_controls_tab(
            '_tab_button3_normal',
            [
                'label' => __( 'Normal', 'elementhelper' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button3_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .add-cart',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'button3_color',
            [
                'label' => __( 'Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sm-btn-s2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button3_bg_color',
            [
                'label' => __( 'Background Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sm-btn-s2' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button3_hover',
            [
                'label' => __( 'Hover', 'elementhelper' ),
            ]
        );

        $this->add_control(
            'button3_hover_color',
            [
                'label' => __( 'Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sm-btn-s2:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button3_hover_bg_color',
            [
                'label' => __( 'Background Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sm-btn-s2:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_video_btn',
            [
                'label' => __( 'Video Button Style', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'=> [
                    'design_style' => ['style_3']
                ]
            ]
        );

        $this->add_responsive_control(
            'video_btn_border_radius',
            [
                'label' => __( 'Border Radius', 'elementhelper' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hero-style-4 .video-area a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( '_tabs_video_btn-' );

        $this->start_controls_tab(
            '_tab_video_btn_normal',
            [
                'label' => __( 'Normal', 'elementhelper' ),
            ]
        );

        $this->add_control(
            'video_btn_color',
            [
                'label' => __( 'Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .hero-style-4 .video-area a path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'video_btn_bg_color',
            [
                'label' => __( 'Background Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-style-4 .video-area a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'video_btn_hover',
            [
                'label' => __( 'Hover', 'elementhelper' ),
            ]
        );

        $this->add_control(
            'video_btn_hover_color',
            [
                'label' => __( 'Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-style-4 .video-area a:hover path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'video_btn_hover_bg_color',
            [
                'label' => __( 'Background Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-style-4 .video-area a:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_feature',
            [
                'label' => __( 'Feature Style', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'=> [
                    'design_style' => ['style_4']
                ]
            ]
        );

        $this->add_control(
            'feature_subtitle_color',
            [
                'label' => __( 'Sub Title Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .parts-hero-section .right-grid .details > span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'feature_title_color',
            [
                'label' => __( 'Title Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .parts-hero-section .right-grid h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'feature_discount_color',
            [
                'label' => __( 'Discount Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .parts-hero-section .right-grid h2 span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs( '_tabs_feature-' );

        $this->start_controls_tab(
            '_tab_feature_normal',
            [
                'label' => __( 'Normal', 'elementhelper' ),
            ]
        );

        $this->add_control(
            'feature_btn_color',
            [
                'label' => __( 'Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .parts-hero-section .right-grid .btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'feature_btn_hover',
            [
                'label' => __( 'Hover', 'elementhelper' ),
            ]
        );

        $this->add_control(
            'feature_btn_hover_color',
            [
                'label' => __( 'Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .parts-hero-section .right-grid .btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['slides'] ) ) {
            return;
        }

        $this->add_render_attribute( 'button_no_icon', 'class', 'custom_btn bg_default_orange btn-no-icon wow fadeInUp2' );

        ?>

        <?php if ( $settings['design_style'] === 'style_5' ): ?>

        <section class="hero-slider hero-style-5">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php foreach ( $settings['slides'] as $key => $slide ) :

                        $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                        if ( $image ) {
                            $bg_url = ' style="';
                            $bg_url .= ( $image ) ? 'background-image: url( '. esc_url( $image ) .' );' : '';
                            $bg_url .= '"';
                        } else {
                            $bg_url = '';
                        }
                    ?>
                    <div class="swiper-slide">
                        <div class="slide-inner slide-bg-image" <?php echo $bg_url; ?>>
                            <div class="container">
                                <div class="slide">

                                    <?php if(!empty( $slide['subtitle'] )) : ?>
                                    <div data-swiper-parallax="200" class="slide-text">
                                        <p><?php echo elh_element_kses_basic($slide['subtitle']); ?></p>
                                    </div>
                                    <?php endif; ?>

                                    <div data-swiper-parallax="300" class="slide-title">

                                        <?php if(!empty( $slide['title'] )) : ?>
                                        <h2><?php echo elh_element_kses_basic($slide['title']); ?></h2>
                                        <?php endif; ?>

                                        <?php if(!empty( $slide['price_start'] )) : ?>
                                        <p><?php echo elh_element_kses_basic($slide['price_start']); ?></p>
                                        <?php endif; ?>

                                    </div>
                                    <div class="clearfix"></div>

                                    <?php if(!empty( $slide['button_link']['url'] )) : ?>
                                    <div data-swiper-parallax="500" class="slide-btns">
                                        <a href="<?php echo esc_html($slide['button_link']['url']); ?>" class="theme-btn-s8">
                                        <?php echo esc_html($slide['button_text']); ?>
                                        <span></span></a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div> <!-- end slide-inner -->
                    </div> <!-- end swiper-slide -->
                    <?php endforeach; ?>
                </div>
                <!-- end swiper-wrapper -->

                <!-- swipper controls -->
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>

        <?php elseif ( $settings['design_style'] === 'style_4' ): ?>
        <section class="parts-hero-section">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-6">
                        <div class="parts-hero-slider owl-theme owl-carousel">
                            <?php foreach ( $settings['slides'] as $key => $slide ) :
                                if (!empty($slide['image']['id'])) {
                                    $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                                }
                            ?>
                            <div class="grid">
                                <?php if(!empty( $image )) : ?>
                                <div class="img-holder">
                                    <img src="<?php echo esc_url($image); ?>" alt>
                                </div>
                                <?php endif; ?>
                                <div class="details">

                                    <?php if(!empty( $slide['subtitle'] )) : ?>
                                    <span><?php echo elh_element_kses_basic($slide['subtitle']); ?></span>
                                    <?php endif; ?>

                                    <?php if(!empty( $slide['title'] )) : ?>
                                    <h2><?php echo elh_element_kses_basic($slide['title']); ?></h2>
                                    <?php endif; ?>

                                    <?php if(!empty( $slide['button_link']['url'] )) : ?>
                                    <a href="<?php echo esc_html($slide['button_link']['url']); ?>" class="theme-btn-s7">
                                        <?php echo esc_html($slide['button_text']); ?>
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="col col-lg-6">
                        <div class="right-grid">
                            <?php foreach ( $settings['features'] as $key => $feature ) :
                                if (!empty($feature['f_image']['id'])) {
                                    $f_image = wp_get_attachment_image_url($feature['f_image']['id'], $settings['thumbnail_size']);
                                }
                            ?>
                            <div class="grid">

                                <?php if(!empty( $f_image )) : ?>
                                <div class="img-holder">
                                    <img src="<?php echo esc_url($f_image); ?>" alt>
                                </div>
                                <?php endif; ?>

                                <div class="details">

                                    <?php if(!empty( $feature['f_subtitle'] )) : ?>
                                    <span><?php echo elh_element_kses_basic($feature['f_subtitle']); ?></span>
                                    <?php endif; ?>

                                    <?php if(!empty( $feature['f_title'] )) : ?>
                                    <h2><?php echo elh_element_kses_basic($feature['f_title']); ?></h2>
                                    <?php endif; ?>

                                    <?php if(!empty( $feature['f_button_link']['url'] )) : ?>
                                    <a href="<?php echo esc_html($feature['f_button_link']['url']); ?>" class="btn">
                                        <?php echo esc_html($feature['f_button_text']); ?>
                                    </a>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>

        <?php elseif ( $settings['design_style'] === 'style_3' ): ?>
        <section class="hero-slider hero-style-4">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php foreach ( $settings['slides'] as $key => $slide ) :
                        if (!empty($slide['video_image']['id'])) {
                            $video_image = wp_get_attachment_image_url($slide['video_image']['id'], $settings['thumbnail_size']);
                        }

                        $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                        if ( $image ) {
                            $bg_url = ' style="';
                            $bg_url .= ( $image ) ? 'background-image: url( '. esc_url( $image ) .' );' : '';
                            $bg_url .= '"';
                        } else {
                            $bg_url = '';
                        }
                    ?>
                    <div class="swiper-slide">
                        <div class="slide-inner slide-bg-image" <?php echo $bg_url; ?>>
                            <div class="container">
                                <div class="slide-text">

                                    <?php if(!empty( $slide['subtitle'] )) : ?>
                                    <div data-swiper-parallax="200" class="slide-text">
                                        <p><?php echo elh_element_kses_basic($slide['subtitle']); ?></p>
                                    </div>
                                    <?php endif; ?>

                                    <?php if(!empty( $slide['title'] )) : ?>
                                    <div data-swiper-parallax="300" class="slide-title">
                                        <h2><?php echo elh_element_kses_basic($slide['title']); ?></h2>
                                    </div>
                                    <?php endif; ?>

                                    <div class="clearfix"></div>

                                    <?php if(!empty( $slide['button_link']['url'] )) : ?>
                                    <div data-swiper-parallax="500" class="slide-btns">
                                        <a href="<?php echo esc_html($slide['button_link']['url']); ?>" class="theme-btn-s6">
                                        <?php echo esc_html($slide['button_text']); ?><span></span></a>
                                    </div>
                                    <?php endif; ?>

                                </div>

                                <div class="video-area">
                                    <?php if(!empty( $video_image )) : ?>
                                    <div class="img-holder">
                                        <img src="<?php echo esc_url($video_image); ?>" alt="img">
                                    </div>
                                    <?php endif; ?>
                                    <?php if(!empty( $slide['video_link']['url'] )) : ?>
                                    <a href="<?php echo esc_url($slide['video_link']['url']); ?>" class="video-btn video-btn-s1" data-type="iframe" tabindex="0">
                                        <svg width="22" height="25" viewBox="0 0 22 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.430443 0.894917C-0.14065 1.44921 -0.14065 2.30585 0.413646 2.84336C0.648802 3.06171 4.49528 5.36289 8.98005 7.93281C13.4816 10.5195 17.1433 12.6863 17.1433 12.7367C17.1433 12.7871 13.9855 14.6684 10.139 16.8855L3.11794 20.9336L3.03396 16.6336C2.98357 14.2484 2.88279 12.1824 2.7988 12.0144C2.63083 11.6617 1.84138 11.225 1.35427 11.225C1.15271 11.225 0.76638 11.4434 0.497631 11.7121L0.0105215 12.1992V18.1957V24.1754L0.430443 24.5785C1.16951 25.3344 1.67341 25.1832 5.08317 23.218C6.76286 22.2437 10.9957 19.8082 14.4558 17.8094C17.916 15.8273 20.9562 13.9965 21.225 13.7781C21.8129 13.2238 21.8464 12.2832 21.2921 11.7625C21.0906 11.5609 16.6562 8.94062 11.4492 5.93398C1.25349 0.0382767 1.27029 0.0550728 0.430443 0.894917Z" fill="white"/>
                                        </svg>
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div> <!-- end slide-inner -->
                    </div> <!-- end swiper-slide -->
                    <?php endforeach; ?>
                </div>
                <!-- end swiper-wrapper -->

                <!-- swipper controls -->
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>

        <?php
            elseif ( $settings['design_style'] === 'style_2' ):
            $product = wc_get_product( $settings['post_id'] );
        ?>

        <section class="hero hero-style-2">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-5 col-xs-12">
                        <div class="hero-text">

                            <?php if(!empty( $settings['title'] )) : ?>
                                <h2><?php echo elh_element_kses_basic( $settings['title'] ); ?></h2>
                            <?php endif; ?>

                            <?php if(!empty( $settings['description'] )) : ?>
                                <p><?php echo elh_element_kses_basic( $settings['description'] ); ?></p>
                            <?php endif; ?>

                            <?php if(!empty( $settings['button_text'] )) : ?>
                            <a href="?add-to-cart=<?php echo $settings['post_id']; ?>" name="add-to-cart" class="theme-btn-s4">
                                <?php echo esc_html($settings['button_text']); ?></a>
                            <?php endif; ?>

                        </div>
                    </div>
                    <div class="col col-lg-7 hero-details-col">
                        <div class="hero-details">
                            <div class="seal-off">
                                <h4><?php echo esc_html($settings['discount_percentage']); ?>
                                    <span><?php echo esc_html($settings['discount_text']); ?></span>
                                </h4>
                            </div>
                            <div class="product-details">
                                <h4><?php echo esc_html($settings['product_title']); ?></h4>

                                <?php if(!empty( $settings['rating_count'] )) : ?>
                                <div class="rating">
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star-half-empty"></i>
                                    <span>(<?php echo esc_html($settings['rating_count']) ?>
                                    <?php echo esc_html__('review', 'elementhelper'); ?>)</span>
                                </div>
                                <?php endif; ?>

                                <p><?php echo esc_html($settings['start_form']); ?>: <span><?php echo esc_html($settings['start_product_price']); ?></span></p>
                                <a href="<?php echo esc_url($settings['product_link']['url']) ?>" class="sm-btn-s2">
                                    <?php echo esc_html($settings['view_details_text']) ?>
                                </a>
                            </div>

                            <div class="product-slider shop-single-slider">
                                <div class="slider-for">
                                    <?php foreach ( $settings['slides'] as $key => $slide ) :
                                        if (!empty($slide['image']['id'])) {
                                            $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                                        }
                                    ?>
                                    <div><img src="<?php echo esc_url($image); ?>" alt></div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="slider-nav">
                                    <?php foreach ( $settings['slides'] as $key => $slide ) :
                                        if (!empty($slide['image']['id'])) {
                                            $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                                        }
                                    ?>
                                    <div></div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="product-option clearfix">
                                <form class="form">
                                    <div class="product-row clearfix">
                                        <div class="price">
                                            <?php if(!empty($settings['post_id'])) : ?>
                                                <span class="current">$<?php echo $product->get_price(); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <input class="product-count" id="<?php echo $settings['post_id']; ?>" name="quantity" type="text" value="1" name="product-count" inputmode="numeric">
                                        </div>
                                        <div>
                                            <button type="submit" value="<?php echo $settings['post_id']; ?>" name="add-to-cart" class="add-cart">
                                            <span><?php echo esc_html__('Add to cart', 'elementhelper'); ?></span> <i class="ti-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>

        <?php else: ?>
        <section class="hero hero-style-1">
            <div class="hero-wrap clearfix">
                <div class="left-col">
                    <div class="product-details">

                        <?php if(!empty( $settings['subtitle'] )) : ?>
                            <div class="slide-sub"><?php echo elh_element_kses_basic( $settings['subtitle'] ); ?></div>
                        <?php endif; ?>

                        <?php if ( !empty($settings['title']) ) : ?>
                            <h2><?php echo elh_element_kses_basic( $settings['title'] ); ?></h2>
                        <?php endif; ?>

                        <?php

                            $product = wc_get_product( $settings['post_id'] );

                        ?>
                        <div class="product-option clearfix">
                            <form class="form">
                                <div class="product-row clearfix">
                                    <div class="price">
                                        <?php if(!empty($settings['post_id'])) : ?>
                                            <span class="current">$<?php echo $product->get_price(); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <input class="product-count" id="<?php echo $settings['post_id']; ?>" name="quantity" type="text" value="1" name="product-count" inputmode="numeric">
                                    </div>
                                    <div>
                                        <button type="submit" value="<?php echo $settings['post_id']; ?>" name="add-to-cart" class="add-cart">
                                        <span><?php echo esc_html__('Add to cart', 'elementhelper'); ?></span> <i class="ti-arrow-right"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <?php if(!empty( $settings['button_link']['url'] )) : ?>
                            <a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="theme-btn-s2"><?php echo esc_html($settings['button_text']); ?> <i class="ti-arrow-right"></i></a>
                        <?php endif; ?>

                    </div>
                </div>

                <div class="right-col">

                    <?php if ( !empty($settings['collection_name']) ) : ?>
                    <h3><?php echo elh_element_kses_basic( $settings['collection_name'] ); ?></h3>
                    <?php endif; ?>

                    <div class="product-slider shop-single-slider">
                        <div class="slider-for">
                            <?php foreach ( $settings['slides'] as $key => $slide ) :
                                if (!empty($slide['image']['id'])) {
                                    $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                                }
                            ?>
                            <div><img src="<?php echo esc_url($image); ?>" alt></div>
                            <?php endforeach; ?>
                        </div>
                        <div class="slider-nav">
                            <?php foreach ( $settings['slides'] as $key => $slide ) :
                                if (!empty($slide['image']['id'])) {
                                    $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                                }
                            ?>
                            <div><img src="<?php echo esc_url($image); ?>" alt></div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="quote">
                        <p>

                        <?php if(!empty( $settings['author_desc'] )) : ?>
                            <?php echo esc_html($settings['author_desc']); ?>
                        <?php endif; ?>

                        <?php if(!empty( $settings['author_name'] )) : ?>
                        <span>- <?php echo esc_html($settings['author_name']); ?></span></p>
                        <?php endif; ?>

                        <?php if(!empty( $settings['author_opinion'] )) : ?>
                        <div class="rating clearfix">
                            <div class="star">
                                <i class="fi flaticon-star"></i>
                                <i class="fi flaticon-star"></i>
                                <i class="fi flaticon-star"></i>
                                <i class="fi flaticon-star"></i>
                                <i class="fi flaticon-star-half-empty"></i>
                            </div>
                            <div>(<?php echo esc_html($settings['author_opinion']); ?>)</div>
                        </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </section>

        <?php endif; ?>

    <?php
    }
}