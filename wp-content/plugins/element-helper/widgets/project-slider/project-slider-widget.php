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

defined('ABSPATH') || die();

class  Project_Slider extends Element_El_Widget
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
        return 'project_slider';
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
        return __('Case Studies', 'elementhelper');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.sabber.com/widgets/slider/';
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
        return 'elh-widget-icon eicon-gallery-grid';
    }

    public function get_keywords()
    {
        return ['slider', 'image', 'gallery', 'project'];
    }

    public function get_script_depends() {
		return ['elh_case_slider'];
	}

    protected function register_content_controls()
    {

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
                'condition' => [
                    'design_style' => ['style_1','style_2']
                ],
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
                'condition' => [
                    'design_style' => ['style_2']
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_section_slides',
            [
                'label' => __('Case List', 'elementhelper'),
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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
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
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'cat_name',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Project Category', 'elementhelper'),
                'default' => __('Ux Design', 'elementhelper'),
                'placeholder' => __('Type here', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_1']
                ],
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Title', 'elementhelper'),
                'default' => __('Item List', 'elementhelper'),
                'placeholder' => __('Type title here', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_1']
                ]
            ]
        );

        $repeater->add_control(
            'slide_url',
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
                    'field_condition' => ['style_1']
                ],
            ]
        );

        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print("Carousel Item"); #>',
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
            '_section_style_content',
            [
                'label' => __('Title & Sub Title', 'elementhelper'),
                'tab' => Controls_Manager::TAB_STYLE,
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
            '_section_style_box',
            [
                'label' => __('Box Style', 'elementhelper'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sub_title_heading_box',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __('Category', 'elementhelper'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'sub_title_spacing_box',
            [
                'label' => __('Bottom Spacing', 'elementhelper'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .pr6-case-slider .pr6-case-single .pr6-case-content span' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'sub_title_color_box',
            [
                'label' => __('Category Text Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-case-slider .pr6-case-single .pr6-case-content span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_title_typography_box',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '{{WRAPPER}} .pr6-case-slider .pr6-case-single .pr6-case-content span',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'title_heading_box',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __('Title', 'elementhelper'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'title_color_box',
            [
                'label' => __('Text Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-case-slider .pr6-case-single .pr6-case-content .pr6-headline h4' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography_box',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '{{WRAPPER}} .pr6-case-slider .pr6-case-single .pr6-case-content .pr6-headline h4',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'title_heading_icon_box',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __('Plus Icon', 'elementhelper'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'title_color_box_plus',
            [
                'label' => __('Icon Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-case-slider .pr6-case-single .pr6-case-content .pr6-case-readmore-btn a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color_box_plus_hover',
            [
                'label' => __('Hover Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-case-slider .pr6-case-single .pr6-case-content .pr6-case-readmore-btn a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color_box_plus_bg',
            [
                'label' => __('Icon Bg Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-case-slider .pr6-case-single .pr6-case-content .pr6-case-readmore-btn a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color_box_plus_bg_hover',
            [
                'label' => __('Hover Bg Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-case-slider .pr6-case-single .pr6-case-content .pr6-case-readmore-btn a:hover' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .pr6-primary-btn a i' => 'font-size: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'selector' => '{{WRAPPER}} .pr6-primary-btn a, {{WRAPPER}} .pr-cor-btn a',
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
                    '{{WRAPPER}} .pr6-primary-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .pr-cor-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __('Button Bg Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-primary-btn a' => 'background-color: {{VALUE}}!important;',
                    '{{WRAPPER}} .pr-cor-btn a' => 'background-color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'button_bg_hover_color',
            [
                'label' => __('Button Bg Hover Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-primary-btn a:hover' => 'background-color: {{VALUE}}!important;',
                    '{{WRAPPER}} .pr-cor-btn a:hover' => 'background-color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __('Button Text Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-primary-btn a' => 'color: {{VALUE}}!important;',
                    '{{WRAPPER}} .pr-cor-btn a' => 'color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'button_text_hover_color',
            [
                'label' => __('Button Text Hover Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-primary-btn a:hover' => 'color: {{VALUE}}!important;',
                    '{{WRAPPER}} .pr-cor-btn a' => 'color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'button_icon_bg_color',
            [
                'label' => __('Button Icon Bg Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-primary-btn i' => 'background-color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'button_icon_color',
            [
                'label' => __('Button Icon Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-primary-btn i' => 'color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'button_icon_bg_hover_color',
            [
                'label' => __('Button Hover Icon Bg Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-primary-btn a:hover i' => 'background-color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'button_icon_hover_color',
            [
                'label' => __('Button Hover Icon Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-primary-btn a:hover i' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $title = elh_element_kses_basic($settings['title']);
        if (empty($settings['slides'])) {
            return;
        }
        ?>

    <?php if ($settings['design_style'] === 'style_3'): ?>

    <section id="nio-eig-portfolio" class="nio-eig-portfolio-section">
		<div class="nio-eig-portfolio-content">
			<div id="nio-eig-portfolio-slide" class="nio-eig-portfolio-slider">
                <?php foreach ($settings['slides'] as $slide) :
                    if (!empty($slide['image']['id'])) {
                        $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                    }
                ?>
				<div class="nio-eig-portfolio-img-text">
					<div class="nio-eig-portfolio-img-text position-relative">

                        <?php if(!empty( $image )) : ?>
						<img src="<?php echo esc_url($image); ?>" alt="img">
                        <?php endif; ?>

						<div class="nio-eig-portfolio-text text-center ta-home-6 headline">

                            <?php if(!empty( $slide['title'] )) : ?>
                            <h3><a href="<?php echo esc_url($slide['slide_url']['url']); ?>"><?php echo elh_element_kses_basic($slide['title']); ?></a></h3>
                            <?php endif; ?>

							<?php if(!empty( $slide['cat_name'] )) : ?>
                            <span><?php echo elh_element_kses_basic($slide['cat_name']); ?></span>
                            <?php endif; ?>

						</div>
					</div>
				</div>
                <?php endforeach; ?>
			</div>
		</div>
	</section>

    <?php elseif ($settings['design_style'] === 'style_2'): ?>

    <section id="pr-cor-portfolio" class="pr-cor-portfolio-section">
		<div class="container">
			<div class="pr-cor-portfolio-upper-content d-flex justify-content-between align-items-center">
				<div class="pr-cor-section-title ta-home-6 headline pera-content">

                    <?php if (!empty($settings['sub_title'])): ?>
					<span class="pr-cor-title-tag"><?php echo elh_element_kses_intermediate($settings['sub_title']); ?></span>
                    <?php endif; ?>

                    <?php if (!empty($settings['title'])): ?>
					<h2><?php echo elh_element_kses_intermediate($settings['title']); ?></h2>
                    <?php endif; ?>

                    <?php if(!empty( $settings['description'] )) : ?>
					<p><?php echo elh_element_kses_intermediate($settings['description']); ?></p>
                    <?php endif; ?>

				</div>

                <?php if(!empty($settings['button_text'])) : ?>
                <div class="pr-cor-btn">
                    <a class="d-flex justify-content-center align-items-center" href="<?php echo esc_html($settings['button_link']['url']); ?>"><?php echo esc_html($settings['button_text']); ?></a>
                </div>
                <?php endif; ?>

			</div>
		</div>

		<div class="pr-cor-portfolio-content">
			<div class="pr-cor-portfolio-slider">
                <?php foreach ($settings['slides'] as $slide) :
                    if (!empty($slide['image']['id'])) {
                        $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                    }
                ?>
				<div class="pr-cor-portfolio-innerbox position-relative">
					<div class="pr-cor-portfolio-inner-img">

                        <?php if(!empty( $image )) : ?>
						<img src="<?php echo esc_url($image); ?>" alt="img">
                        <?php endif; ?>

					</div>
					<div class="pr-cor-portfolio-inner-text ta-home-6 headline position-absolute">

                        <?php if(!empty( $slide['title'] )) : ?>
						<h3><a href="<?php echo esc_url($slide['slide_url']['url']); ?>"><?php echo elh_element_kses_basic($slide['title']); ?></a></h3>
                        <?php endif; ?>

                        <?php if(!empty( $slide['cat_name'] )) : ?>
						<span><?php echo elh_element_kses_basic($slide['cat_name']); ?></span>
                        <?php endif; ?>

                        <?php if(!empty( $slide['slide_url']['url'] )): ?>
						<div class="pr-cor-portfolio-link-icon  position-absolute">
							<a href="<?php echo esc_url($slide['slide_url']['url']); ?>"><i class="flaticon-fast-forward"></i></a>
						</div>
                        <?php endif; ?>

					</div>
				</div>
                <?php endforeach; ?>
			</div>
		</div>
	</section>

    <?php else: ?>
    <section class="pr6-case-studies">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="pr6-title-area text-center wow fadeInUp">
                        <?php if (!empty($settings['sub_title'])): ?>
                        <span class="pr6-subtitle"><?php echo elh_element_kses_intermediate($settings['sub_title']); ?></span>
                        <?php endif; ?>

                        <?php if (!empty($settings['title'])): ?>
                        <div class="pr6-headline">
                            <h3><?php echo elh_element_kses_intermediate($settings['title']); ?></h3>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="pr6-case-slider">
                <div class="choose_slider">
                    <div class="choose_slider_items">
                        <ul class="pr6-case-vh-slider">
                            <?php foreach ($settings['slides'] as $slide) :
                                if (!empty($slide['image']['id'])) {
                                    $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                                }
                            ?>
                            <li class="current_item">
                                <div class="pr6-case-single">
                                    <?php if (!empty($image)) : ?>
                                    <div class="pr6-img-wrapper">
                                        <img src="<?php print esc_url($image); ?>" alt="img">
                                    </div>
                                    <?php endif; ?>
                                    <div class="pr6-case-content">
                                        <?php if (!empty($slide['cat_name'])) : ?>
                                        <span><?php echo elh_element_kses_basic($slide['cat_name']); ?></span>
                                        <?php endif; ?>

                                        <?php if (!empty($slide['title'])) : ?>
                                        <div class="pr6-headline">
                                            <h4><?php echo elh_element_kses_basic($slide['title']); ?></h4>
                                        </div>
                                        <?php endif; ?>
                                        <?php if (!empty($slide['slide_url'])) : ?>
                                        <div class="pr6-case-readmore-btn">
                                            <a href="<?php echo esc_url($slide['slide_url']['url']); ?>"><i class="fas fa-plus"></i></a>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="pr6-slider-btn">
                    <div><a class="prev-btn btn-arrow" href="#"><i class="fas fa-angle-left"></i></a></div>
                    <div><a class="next-btn btn-arrow" href="#"><i class="fas fa-angle-right"></i></a></div>
                </div>
            </div>

            <?php if(!empty($settings['button_text'])) : ?>
            <div class="pr6-primary-btn text-center wow fadeInUp">
                <a href="<?php echo esc_html($settings['button_link']['url']); ?>"><?php echo esc_html($settings['button_text']); ?> <i class="fas fa-arrow-right"></i></a>
            </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

        <?php
    }
}
