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

class Services_Tab extends Element_El_Widget {

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
        return 'services-tab';
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
        return __( 'Services Tab', 'elementhelper' );
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
        return [ 'services', 'tab' ];
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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        // section title
        $this->start_controls_section(
            '_section_title',
            [
                'label' => __( 'Title & Description', 'elementhelper' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __( 'Sub Title', 'elementhelper' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __( 'ElhInfo Box Sub Title', 'elementhelper' ),
                'placeholder' => __( 'Type Info Box Sub Title', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'elementhelper' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __( 'ElhInfo Box Title', 'elementhelper' ),
                'placeholder' => __( 'Type Info Box Title', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'elementhelper' ),
                'description' => elh_element_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Elhinfo box description goes here', 'elementhelper' ),
                'placeholder' => __( 'Type info box description', 'elementhelper' ),
                'rows' => 5,
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
                'frontend_available' => true,
                'style_transfer' => true,
                'options' => [
                    'style_1' => __( 'Style 1', 'elementhelper' ),
                ],
                'default' => 'style_1',
            ]
        );

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
                'condition' => [
                    'field_condition' => 'style_1'
                ],
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
                    'type' => 'image',
                    'field_condition' => 'style_1'
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
                    'type' => 'image',
                    'field_condition' => 'style_1'
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
                        'type' => 'icon',
                        'field_condition' => 'style_1'
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
                        'type' => 'icon',
                        'field_condition' => 'style_1'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tab_menu_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Tab Menu Title', 'elementhelper' ),
                'default' => __( 'Tab Menu Title', 'elementhelper' ),
                'placeholder' => __( 'Type title here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );


        $repeater->add_control(
            'tab_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Tab Title', 'elementhelper' ),
                'default' => __( 'Tab Title', 'elementhelper' ),
                'placeholder' => __( 'Type title here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'tab_content',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'Tab Content', 'elementhelper' ),
                'default' => __( 'Content Here', 'elementhelper' ),
                'placeholder' => __( 'Type subtitle here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );


        $repeater->add_control(
            'tab_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Tab Image', 'elementhelper' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        // Button
        $repeater->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'elementhelper' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Learn More',
                'placeholder' => __( 'Type button text here', 'elementhelper' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => 'style_1'
                ]
            ]
        );

        $repeater->add_control(
            'button_url',
            [
                'label' => __( 'Button URL', 'elementhelper' ),
                'type' => Controls_Manager::TEXT,
                'default' => '#',
                'placeholder' => __( 'button url', 'elementhelper' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => 'style_1'
                ]
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

        $this->start_controls_section(
            '_section_button',
            [
                'label' => __( 'Button', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1'],
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
            'sub_title_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __('Sub Title', 'elementhelper'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'sub_title_spacing',
            [
                'label' => __('Bottom Spacing', 'elementhelper'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .pr6-title-area .pr6-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'sub_title_color',
            [
                'label' => __('Sub Text Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-title-area .pr6-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sub_bg_title_color',
            [
                'label' => __('Sub Bg Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-title-area .pr6-subtitle' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '{{WRAPPER}} .pr6-title-area .pr6-subtitle',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'title_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __('Title', 'elementhelper'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Text Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-headline h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '{{WRAPPER}} .pr6-headline h3',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'description_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __('Description', 'elementhelper'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => __('Bottom Spacing', 'elementhelper'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .pr6-title-area .pr6-pera-txt p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __('Text Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-title-area .pr6-pera-txt p' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '{{WRAPPER}} .pr6-title-area .pr6-pera-txt p',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_tab_icon',
            [
                'label' => __('Tab Style', 'elementhelper'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'tab_icon_size',
            [
                'label' => __('Icon Size', 'elementhelper'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pr6-service-left .pr6-service-tabs li a i' => 'font-size: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'tab_icon_color',
            [
                'label' => __('Icon Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-service-left .pr6-service-tabs li a i' => 'color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'tab_icon_active_color',
            [
                'label' => __('Icon Active & Hover Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-service-left .pr6-service-tabs li a.active i' => 'color: {{VALUE}}!important;',
                    '{{WRAPPER}} .pr6-service-left .pr6-service-tabs li a:hover' => 'color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab2_icon_size',
            [
                'label' => __('Tab Content Icon Size', 'elementhelper'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pr6-service-right .pr6-single-item .pr6-icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'tab2_icon_color',
            [
                'label' => __('Tab Content Icon Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-service-right .pr6-single-item .pr6-icon-wrapper i' => 'color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'tab2_icon_bg_color',
            [
                'label' => __('Tab Content Icon Bg Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-service-right .pr6-single-item .pr6-icon-wrapper i' => 'background-color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'tab_content_title_color',
            [
                'label' => __('Tab Content Title Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-headline h4' => 'color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'tab_content_desc_color',
            [
                'label' => __('Tab Content Description Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-pera-txt p' => 'color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'tab_content_btn_color',
            [
                'label' => __('Tab Content Button Text Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-service-right .pr6-single-item .pr6-service-content .pr6-primary-btn a' => 'color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'tab_content_btn_hover_color',
            [
                'label' => __('Hover Text Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-service-right .pr6-single-item .pr6-service-content .pr6-primary-btn a:hover' => 'color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'tab_content_btn_bg_color',
            [
                'label' => __('Tab Content Button Bg Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-service-right .pr6-single-item .pr6-service-content .pr6-primary-btn a' => 'background-color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'tab_content_btn_bg_hover_color',
            [
                'label' => __('Hover Bg Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-service-right .pr6-single-item .pr6-service-content .pr6-primary-btn a:hover' => 'background-color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_btn',
            [
                'label' => __('Button', 'elementhelper'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'btn_icon_size',
            [
                'label' => __('Icon Size', 'elementhelper'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pr6-secondary-btn a i' => 'font-size: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'selector' => '{{WRAPPER}} .pr6-secondary-btn a, {{WRAPPER}} .pr-cor-btn a',
                'scheme' => Typography::TYPOGRAPHY_4,
            ]
        );

        $this->add_control(
            'btn_border_radius',
            [
                'label' => __('Border Radius', 'elementhelper'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pr6-secondary-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __('Button Bg Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-secondary-btn a' => 'background-color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'button_bg_hover_color',
            [
                'label' => __('Button Bg Hover Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-secondary-btn a:hover' => 'background-color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __('Button Text Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-secondary-btn a' => 'color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'button_text_hover_color',
            [
                'label' => __('Button Text Hover Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-secondary-btn a:hover' => 'color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'button_icon_bg_color',
            [
                'label' => __('Button Icon Bg Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-secondary-btn i' => 'background-color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'button_icon_color',
            [
                'label' => __('Button Icon Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-secondary-btn i' => 'color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'button_icon_bg_hover_color',
            [
                'label' => __('Button Hover Icon Bg Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-secondary-btn a:hover i' => 'background-color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'button_icon_hover_color',
            [
                'label' => __('Button Hover Icon Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-secondary-btn a:hover i' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'title_2', 'class', 'section-title' );
        $title = elh_element_kses_basic( $settings['title' ] );

        if ( empty( $settings['slides'] ) ) {
            return;
        }

        if ( $settings['design_style'] === 'style_1' ) :
        // section_bg_image
        if (!empty($settings['section_bg_image']['id'])) {
            $section_bg_image = wp_get_attachment_image_url( $settings['section_bg_image']['id'], 'full' );
            if ( ! $section_bg_image ) {
                $section_bg_image = $settings['section_bg_image']['url'];
            }
        }
    ?>

    <section class="pr6-service-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="pr6-service-left">
                        <div class="pr6-title-area wow fadeInUp">
                            <?php if(!empty($settings['sub_title'])) : ?>
                            <span class="pr6-subtitle"><?php echo elh_element_kses_intermediate($settings['sub_title']); ?></span>
                            <?php endif; ?>

                            <?php if(!empty($settings['title'])) : ?>
                            <div class="pr6-headline">
                                <h3><?php echo elh_element_kses_intermediate($settings['title']); ?></h3>
                            </div>
                            <?php endif; ?>

                            <?php if(!empty($settings['description'])) : ?>
                            <div class="pr6-pera-txt">
                                <p><?php echo elh_element_kses_intermediate($settings['description']); ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="pr6-service-tabs wow fadeInUp" data-wow-delay="0.2s">
                            <ul class="nav nav-pills">
                            <?php foreach ( $settings['slides'] as $id => $slide ) :

                                // img
                                $tab_image = wp_get_attachment_image_url( !empty($slide['tab_image']['id']), !empty($slide['tab_image_size']) );
                                if ( ! $tab_image ) {
                                    $tab_image = $slide['tab_image']['url'];
                                }
                                // active class
                                $active_tab = ($id == 0) ? 'active' : '';
                                ?>
                                <li>
                                    <a href="#<?php echo esc_attr($id); ?>" data-toggle="pill" class="<?php echo esc_attr($active_tab); ?>">
                                    <?php if ( $slide['type'] === 'image' && ( $slide['image']['url'] || $slide['image']['id'] ) ) :
                                        $this->get_render_attribute_string( 'image' );
                                        $slide['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
                                        ?>
                                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $slide, 'thumbnail', 'image' ); ?>
                                        <?php elseif ( ! empty( $slide['icon'] ) || ! empty( $slide['selected_icon']['value'] ) ) : ?>

                                        <?php elh_element_render_icon( $slide, 'icon', 'selected_icon' ); ?>

                                        <?php endif; ?>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <?php if(!empty($settings['button_text'])) : ?>
                        <div class="pr6-secondary-btn wow fadeInUp" data-wow-delay="0.3s">
                            <a href="<?php echo esc_html($settings['button_link']['url']); ?>"><?php echo esc_html($settings['button_text']); ?> <i class="fas fa-arrow-right"></i></a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="pr6-service-right wow fadeInUp">
                        <div class="tab-content">
                        <?php foreach ( $settings['slides'] as $id => $slide ) :
                            // img
                            $tab_image = wp_get_attachment_image_url( !empty($slide['tab_image']['id']), !empty($slide['tab_image_size']) );
                            if ( ! $tab_image ) {
                                $tab_image = $slide['tab_image']['url'];
                            }
                            // active class
                            $active_tab = ($id == 0) ? 'active show' : '';
                        ?>
                            <div class="tab-pane fade <?php echo esc_attr($active_tab); ?>" id="<?php echo esc_attr($id); ?>">
                                <div class="pr6-service-slider">
                                    <div class="pr6-single-item">
                                        <?php if ( !empty( $tab_image ) ) : ?>
                                        <div class="pr6-img-wrapper">
                                            <img src="<?php print esc_url($tab_image); ?>" alt="img">
                                        </div>
                                        <?php endif; ?>
                                        <div class="pr6-icon-wrapper">
                                            <?php if ( $slide['type'] === 'image' && ( $slide['image']['url'] || $slide['image']['id'] ) ) :
                                            $this->get_render_attribute_string( 'image' );
                                            $slide['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
                                            ?>
                                            <?php echo Group_Control_Image_Size::get_attachment_image_html( $slide, 'thumbnail', 'image' ); ?>
                                            <?php elseif ( ! empty( $slide['icon'] ) || ! empty( $slide['selected_icon']['value'] ) ) : ?>

                                            <?php elh_element_render_icon( $slide, 'icon', 'selected_icon' ); ?>

                                            <?php endif; ?>
                                        </div>
                                        <div class="pr6-service-content">
                                            <div class="pr6-headline">
                                                <?php if ( !empty( !empty($slide['tab_title']) ) ) : ?>
                                                <h4><?php echo elh_element_kses_basic( $slide['tab_title'] ); ?></h4>
                                                <?php endif; ?>
                                            </div>

                                            <?php if ( !empty( !empty($slide['tab_content']) ) ) : ?>
                                            <div class="pr6-pera-txt">
                                                <p><?php echo elh_element_kses_basic( $slide['tab_content'] ); ?></p>
                                            </div>
                                            <?php endif; ?>

                                            <?php if ( !empty( !empty($slide['button_url']) ) ) : ?>
                                            <div class="pr6-primary-btn">
                                                <a href="<?php echo esc_url( $slide['button_url'] ); ?>"><?php echo esc_html( $slide['button_text'] ); ?> <i class="fas fa-arrow-right"></i></a>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php elseif ( $settings['design_style'] === 'style_2' ) :
        // section_bg_image
        if (!empty($settings['section_bg_image']['id'])) {
            $section_bg_image = wp_get_attachment_image_url( $settings['section_bg_image']['id'], 'full' );
            if ( ! $section_bg_image ) {
                $section_bg_image = $settings['section_bg_image']['url'];
            }
        }
    ?>

<section id="nio-eig-service" class="nio-eig-service">
		<div class="container">
			<div class="nio-eig-section-title ta-home-6 headline text-center pera-content">

            <?php if(!empty($settings['sub_title'])) : ?>
            <span><?php echo elh_element_kses_intermediate($settings['sub_title']); ?></span>
            <?php endif; ?>

            <?php if(!empty($settings['title'])) : ?>
            <h2><?php echo elh_element_kses_intermediate($settings['title']); ?></h2>
            <?php endif; ?>

			</div>
			<div class="nio-eig-service-tab">
				<div class="row">
					<div class="col-lg-3">
						<div class="nio-eig-service-tab-btn ul-li-block">
							<ul id="tabs" class="nav text-capitalize nav-tabs">
                            <?php foreach ( $settings['slides'] as $id => $slide ) :

                                // img
                                $tab_image = wp_get_attachment_image_url( !empty($slide['tab_image']['id']), !empty($slide['tab_image_size']) );
                                if ( ! $tab_image ) {
                                    $tab_image = $slide['tab_image']['url'];
                                }
                                // active class
                                $active_tab = ($id == 0) ? 'active' : '';
                                ?>
								<li class="nav-item">
                                    <a href="#<?php echo esc_attr($id); ?>" data-target="#<?php echo esc_attr($id); ?>" data-toggle="tab" class="nav-link text-capitalize <?php echo esc_attr($active_tab); ?>"><?php echo esc_html($slide['tab_menu_title']); ?></a>
                                </li>
                                <?php endforeach; ?>
							</ul>
						</div>
					</div>
					<div class="col-lg-9">
						<div class="nio-eig-service-tab-content">
							<div id="tabsContent" class="tab-content">
                            <?php foreach ( $settings['slides'] as $id => $slide ) :
                                    // img
                                    $tab_image = wp_get_attachment_image_url( !empty($slide['tab_image']['id']), !empty($slide['tab_image_size']) );
                                    if ( ! $tab_image ) {
                                        $tab_image = $slide['tab_image']['url'];
                                    }
                                    // active class
                                    $active_tab = ($id == 0) ? 'active show' : '';
                                ?>
								<div id="<?php echo esc_attr($id); ?>" class="tab-pane fade <?php echo esc_attr($active_tab); ?>">
									<div class="nio-eig-service-tab-img-text clearfix">

                                        <?php if(!empty( $tab_image )) : ?>
										<div class="nio-eig-service-tab-img float-left">
											<img src="<?php print esc_url($tab_image); ?>" alt="img">
										</div>
                                        <?php endif; ?>

										<div class="nio-eig-service-tab-text">
											<div class="nio-eig-service-icon ">
                                            <?php if ( $slide['type'] === 'image' && ( $slide['image']['url'] || $slide['image']['id'] ) ) :
                                                $this->get_render_attribute_string( 'image' );
                                                $slide['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
                                                ?>
                                                <?php echo Group_Control_Image_Size::get_attachment_image_html( $slide, 'thumbnail', 'image' ); ?>
                                                <?php elseif ( ! empty( $slide['icon'] ) || ! empty( $slide['selected_icon']['value'] ) ) : ?>

                                                <?php elh_element_render_icon( $slide, 'icon', 'selected_icon' ); ?>

                                                <?php endif; ?>
											</div>
											<div class="nio-eig-service-text ta-home-6 headline pera-content">

                                                <?php if(!empty( $slide['tab_title'] )) : ?>
												<h3><?php echo elh_element_kses_basic( $slide['tab_title'] ); ?></h3>
                                                <?php endif; ?>

                                                <?php if(!empty( $slide['tab_content'] )) : ?>
												<p><?php echo elh_element_kses_basic( $slide['tab_content'] ); ?></p>
                                                <?php endif; ?>

                                                <?php if ( !empty( !empty($slide['button_url']) ) ) : ?>
                                                <a href="<?php echo esc_url( $slide['button_url'] ); ?>"><?php echo esc_html( $slide['button_text'] ); ?></a>
                                                <?php endif; ?>
											</div>
										</div>
									</div>
								</div>
                                <?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
    <?php elseif ( $settings['design_style'] === 'style_3' ) :
        $slider_active = !empty($settings['slider_active']) ? 'service-active' : '';
    ?>


        <?php endif; ?>


        <?php

    }
}