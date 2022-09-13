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

class  Popular_Menu extends Element_El_Widget
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
        return 'popular_menu';
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
        return __('Popular Menu', 'elementhelper');
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
		return ['elh_popular_menu'];
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
                'label' => __('Menu List', 'elementhelper'),
                'tab' => Controls_Manager::TAB_CONTENT,
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
            'menu_image',
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
            ]
        );

        $repeater->add_control(
            'description',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'label' => __('Description', 'elementhelper'),
                'default' => __('Item Description', 'elementhelper'),
                'placeholder' => __('Type Description here', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'count',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Count', 'elementhelper'),
                'default' => __('01', 'elementhelper'),
                'placeholder' => __('Type Count here', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ],
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
                        'title' => __('Title', 'elementhelper'),
                        'description' => __('Description Here', 'elementhelper'),
                        'count' => __('01', 'elementhelper'),
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
                    'design_style' => ['style_2'],
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

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_feature',
            [
                'label' => __( 'Feature List', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'feature_icon_color',
            [
                'label' => __( 'Icon Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cat_single .cat_icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'feature_title_color',
            [
                'label' => __( 'Title Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cat_single h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'feature_title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .cat_single h3
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
                    '{{WRAPPER}} .cat_single p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'feature_description_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .cat_single p
                    ',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_control(
            'feature_count_title_color',
            [
                'label' => __( 'Count Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cat_single .cat_number' => 'color: {{VALUE}}',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'count_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .cat_single .cat_number',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_control(
            'feature_bg_color_hover',
            [
                'label' => __( 'Box Bg On Hover', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cat_single:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'feature_icon_color_hover',
            [
                'label' => __( 'Icon Color Hover', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cat_single:hover .cat_icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'feature_title_color_hover',
            [
                'label' => __( 'Title Color Hover', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cat_single:hover h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'feature_desc_color_hover',
            [
                'label' => __( 'Title Color Hover', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cat_single:hover p' => 'color: {{VALUE}}',
                ],
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

    <section class="category_area pt-120 pb-120">
        <div class="container">
            <div class="sec_title sec_title-2">

                <?php if(!empty( $settings['sub_title'] )) : ?>
                <span><?php echo elh_element_kses_intermediate($settings['sub_title']); ?></span>
                <?php endif; ?>

                <?php if(!empty( $settings['title'] )) : ?>
                <h2><?php echo elh_element_kses_intermediate($settings['title']); ?></h2>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="category_active owl-carousel">
                        <?php foreach ($settings['slides'] as $slide) :
                            if (!empty($slide['menu_image']['id'])) {
                                $menu_image = wp_get_attachment_image_url($slide['menu_image']['id'], $settings['thumbnail_size']);
                            }
                        ?>
                        <div class="cat_single">
                            <div class="cat_icon">
                                <?php if ( $slide['type'] === 'image' && ( $slide['image']['url'] || $slide['image']['id'] ) ) :
                                    $this->get_render_attribute_string( 'image' );
                                    $slide['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
                                ?>
                                <?php echo Group_Control_Image_Size::get_attachment_image_html( $slide, 'thumbnail', 'image' ); ?>
                                <?php elseif ( ! empty( $slide['icon'] ) || ! empty( $slide['selected_icon']['value'] ) ) : ?>

                                <?php elh_element_render_icon( $slide, 'icon', 'selected_icon' ); ?>
                                <?php endif; ?>
                            </div>

                            <?php if(!empty( $slide['title'] )) : ?>
                            <h3><a href="<?php echo esc_url($slide['slide_url']['url']) ?>">
                                <?php echo elh_element_kses_basic($slide['title']); ?></a></h3>
                            <?php endif; ?>

                            <?php if(!empty( $slide['description'] )) : ?>
                            <p><?php echo elh_element_kses_basic($slide['description']); ?></p>
                            <?php endif; ?>

                            <?php if(!empty( $menu_image )) : ?>
                            <div class="cat_img">
                                <img src="<?php echo esc_url($menu_image); ?>" alt="img">
                            </div>
                            <?php endif; ?>

                            <div class="cat_shape">
                                <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/icon/cat_shape.png" alt="img">
                            </div>

                            <?php if(!empty( $slide['count'] )) : ?>
                            <div class="cat_number">
                                <span><?php echo elh_element_kses_basic($slide['count']); ?></span>
                            </div>
                            <?php endif; ?>

                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

        <?php
    }
}
