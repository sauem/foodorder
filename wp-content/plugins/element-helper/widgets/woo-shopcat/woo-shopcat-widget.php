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

class Woo_Shopcat extends Element_El_Widget
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
        return 'woo_shopcat';
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
        return __('Woo Shop Category', 'elementhelper');
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
        return ['info', 'hero', 'content'];
    }

    public function get_script_depends() {
		return ['elh_fourColSlider_slider'];
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
                    'style_1' => __('Style 1: Home One', 'elementhelper'),
                    'style_2' => __('Style 2: Home Two', 'elementhelper'),
                    'style_3' => __('Style 3: Home Three', 'elementhelper'),
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

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_slides',
            [
                'label' => __( 'Categories', 'elementhelper' ),
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

    /**
     * Register styles related controls
     */
    protected function register_style_controls(){
        $this->start_controls_section(
            '_section_style_titleinfo',
            [
                'label' => __( 'Title & Info', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
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
                    '{{WRAPPER}} .section-title h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .section-title h2',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_cat',
            [
                'label' => __( 'Category Style', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'cat_title_color',
            [
                'label' => __( 'Category Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .categories-section .grid h4' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .furnitures-categories-section .grid h4' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'cat_title_bg_color',
            [
                'label' => __( 'Category Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .categories-section .grid h4' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .furnitures-categories-section .grid h4' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cat_title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .categories-section .grid h4,
                    {{WRAPPER}} .furnitures-categories-section .grid h4
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
                'condition' => [
                    'design_style' => ['style_1']
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
                    '{{WRAPPER}} .theme-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .theme-btn
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
                    '{{WRAPPER}} .theme-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .theme-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label' => __( 'Border Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .theme-btn' => 'border-color: {{VALUE}};',
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
                    '{{WRAPPER}} .theme-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .theme-btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __( 'Background Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .theme-btn:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

    if ($settings['design_style'] === 'style_3'): ?>

    <section class="furnitures-categories-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="cat-grids four-grid-slider owl-carousel four-col-slider">
                        <?php foreach ( $settings['slides'] as $key => $slide ) :
                            if (!empty($slide['image']['id'])) {
                                $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                            }
                        ?>
                        <div class="grid">
                            <a href="<?php echo esc_url($slide['button_link']['url']); ?>">

                                <?php if(!empty( $image )) : ?>
                                <div class="img-holder">
                                    <img src="<?php echo esc_url($image); ?>" alt>
                                </div>
                                <?php endif; ?>

                                <?php if(!empty( $slide['title'] )) : ?>
                                <h4><?php echo elh_element_kses_basic($slide['title']); ?></h4>
                                <?php endif; ?>

                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div> <!-- end container -->
    </section>

    <?php elseif ($settings['design_style'] === 'style_2'): ?>
    <section class="furnitures-categories-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="cat-grids four-grid-slider owl-carousel four-col-slider">
                        <?php foreach ( $settings['slides'] as $key => $slide ) :
                            if (!empty($slide['image']['id'])) {
                                $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                            }
                        ?>
                        <div class="grid">
                            <a href="<?php echo esc_url($slide['button_link']['url']); ?>">

                                <?php if(!empty( $image )) : ?>
                                <div class="img-holder">
                                    <img src="<?php echo esc_url($image); ?>" alt>
                                </div>
                                <?php endif; ?>

                                <?php if(!empty( $slide['title'] )) : ?>
                                <h4><?php echo elh_element_kses_basic($slide['title']); ?></h4>
                                <?php endif; ?>

                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div> <!-- end container -->
    </section>
    <?php else: ?>

     <section class="categories-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <?php if ( !empty($settings['title']) ) : ?>
                    <div class="section-title">
                        <h2><?php echo elh_element_kses_basic( $settings['title'] ); ?></h2>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col col-xs-12">
                    <div class="cat-grids clearfix">
                        <?php foreach ( $settings['slides'] as $key => $slide ) :
                            if (!empty($slide['image']['id'])) {
                                $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                            }
                        ?>
                        <div class="grid">
                            <a href="<?php echo esc_url($slide['button_link']['url']); ?>">

                                <?php if(!empty( $image )) : ?>
                                <div class="img-holder">
                                    <img src="<?php echo esc_url($image); ?>" alt>
                                </div>
                                <?php endif; ?>

                                <?php if(!empty( $slide['title'] )) : ?>
                                <h4><?php echo elh_element_kses_basic($slide['title']); ?></h4>
                                <?php endif; ?>

                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if(!empty( $settings['button_link']['url'] )) : ?>
                    <div class="text-center">
                        <a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="theme-btn"><?php echo esc_html($settings['button_text']); ?></a>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div> <!-- end container -->
    </section>

    <?php endif;

    }
}
