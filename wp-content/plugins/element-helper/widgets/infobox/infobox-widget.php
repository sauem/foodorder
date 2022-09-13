<?php

namespace ElementHelper\Widget;

use \Elementor\Core\Schemes\Typography;
use \Elementor\Utils;
use \Elementor\Control_Media;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;

defined('ABSPATH') || die();

class InfoBox extends Element_El_Widget
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
        return 'infobox';
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
        return __('Info Box', 'elementhelper');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.sabber.com/widgets/info-box/';
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
        return 'elh-widget-icon eicon-lightbox-expand';
    }

    public function get_keywords()
    {
        return ['info', 'blurb', 'box', 'text', 'content'];
    }

    /**
     * Register content related controls
     */
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
                    'style_4' => __('Style 4', 'elementhelper'),
                    'style_5' => __('Style 5', 'elementhelper'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_media',
            [
                'label' => __('Image', 'elementhelper'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
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

        $this->add_group_control(
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

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_title',
            [
                'label' => __('Title & Description', 'elementhelper'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'badge',
            [
                'label' => __('Badge', 'elementhelper'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('NEW ARRIVAL', 'elementhelper'),
                'placeholder' => __('Type Badge', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1', 'style_2']
                ],
            ]
        );

        $this->add_control(
            'price_start',
            [
                'label' => __('Price start', 'elementhelper'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('from $18.99', 'elementhelper'),
                'placeholder' => __('Type Price Start Form', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
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
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_button',
            [
                'label' => __('Button', 'elementhelper'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Text', 'elementhelper'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Button Text', 'elementhelper'),
                'placeholder' => __('Type button text here', 'elementhelper'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __('Link', 'elementhelper'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('http://elementor.sabber.com/', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Register styles related controls
     */
    protected function register_style_controls()
    {
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
                'label' => __( 'Badge Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .parts-cta-s2-section .details span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'badge_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .parts-cta-s2-section .details span
                    ',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __( 'Price Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .parts-cta-s2-section .details .price' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .medical-cta-section .details .price' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .parts-cta-s2-section .details .price,
                    {{WRAPPER}} .medical-cta-section .details .price
                    ',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .parts-cta-s2-section .details h4' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .medical-cta-section .details h4' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .parts-cta-s2-section .details h4,
                    {{WRAPPER}} .medical-cta-section .details h4
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
                    '{{WRAPPER}} .theme-btn-s7' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => ['style_1', 'style_4']
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .theme-btn-s7
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
                    '{{WRAPPER}} .theme-btn-s7' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .theme-btn-s7' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'design_style' => ['style_1', 'style_4']
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
                    '{{WRAPPER}} .theme-btn-s7:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .theme-btn-s7:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'design_style' => ['style_1', 'style_4']
                ]
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (!empty($settings['image']['id'])) {
            $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
        }

        if ($settings['design_style'] === 'style_5'): ?>

        <div class="medical-cta-section">
            <div class="grid grid-s2 grid-s3">

                <?php if (!empty($image)): ?>
                <div class="img-holder">
                    <img src="<?php print esc_url($image); ?>" alt="img">
                </div>
                <?php endif; ?>

                <div class="details">

                    <div class="info">

                        <?php if(!empty( $settings['price_start'] )) : ?>
                        <p class="price"><?php echo elh_element_kses_basic($settings['price_start']); ?></p>
                        <?php endif; ?>

                        <?php if(!empty( $settings['title'] )) : ?>
                        <h4><?php echo elh_element_kses_basic($settings['title']); ?></h4>
                        <?php endif; ?>

                        <?php if(!empty( $settings['button_link']['url'] )) : ?>
                        <a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="btn">
                            <?php echo elh_element_kses_basic($settings['button_text']); ?> <i class="ti ti-arrow-right"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <?php elseif ($settings['design_style'] === 'style_4'): ?>

        <div class="medical-cta-section">
            <div class="grid">

                <?php if (!empty($image)): ?>
                <div class="img-holder">
                    <img src="<?php print esc_url($image); ?>" alt="img">
                </div>
                <?php endif; ?>

                <div class="details">

                    <?php if(!empty( $settings['badge'] )) : ?>
                    <span><?php echo elh_element_kses_basic($settings['badge']); ?></span>
                    <?php endif; ?>

                    <div class="info">

                        <?php if(!empty( $settings['price_start'] )) : ?>
                        <p class="price"><?php echo elh_element_kses_basic($settings['price_start']); ?></p>
                        <?php endif; ?>

                        <?php if(!empty( $settings['title'] )) : ?>
                        <h4><?php echo elh_element_kses_basic($settings['title']); ?></h4>
                        <?php endif; ?>

                        <?php if(!empty( $settings['button_link']['url'] )) : ?>
                        <a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="theme-btn-s7">
                            <?php echo elh_element_kses_basic($settings['button_text']); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <?php elseif ($settings['design_style'] === 'style_3'):?>
        <div class="parts-cta-s2-section">
            <div class="third-col clearfix">
                <div class="grid grid-s2 grid-s3">

                    <?php if (!empty($image)): ?>
                    <div class="img-holder">
                        <img src="<?php print esc_url($image); ?>" alt="img">
                    </div>
                    <?php endif; ?>

                    <div class="details">
                        <div class="info">

                            <?php if(!empty( $settings['price_start'] )) : ?>
                            <p class="price"><?php echo elh_element_kses_basic($settings['price_start']); ?></p>
                            <?php endif; ?>

                            <?php if(!empty( $settings['title'] )) : ?>
                            <h4><?php echo elh_element_kses_basic($settings['title']); ?></h4>
                            <?php endif; ?>

                            <?php if(!empty( $settings['button_link']['url'] )) : ?>
                            <a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="btn">
                                <?php echo elh_element_kses_basic($settings['button_text']); ?> <i class="ti ti-arrow-right"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php elseif ($settings['design_style'] === 'style_2'): ?>

        <div class="parts-cta-s2-section">
            <div class="mid-col">
                <div class="grid grid-s2">
                    <?php if (!empty($image)): ?>
                    <div class="img-holder">
                        <img src="<?php print esc_url($image); ?>" alt="img">
                    </div>
                    <?php endif; ?>
                    <div class="details">

                        <?php if(!empty( $settings['badge'] )) : ?>
                        <span><?php echo elh_element_kses_basic($settings['badge']); ?></span>
                        <?php endif; ?>

                        <div class="info">

                            <?php if(!empty( $settings['price_start'] )) : ?>
                            <p class="price"><?php echo elh_element_kses_basic($settings['price_start']); ?></p>
                            <?php endif; ?>

                            <?php if(!empty( $settings['title'] )) : ?>
                            <h4><?php echo elh_element_kses_basic($settings['title']); ?></h4>
                            <?php endif; ?>

                            <?php if(!empty( $settings['button_link']['url'] )) : ?>
                            <a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="btn">
                                <?php echo elh_element_kses_basic($settings['button_text']); ?> <i class="ti ti-arrow-right"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php else: ?>

        <div class="parts-cta-s2-section">
            <div class="grid">
                <?php if (!empty($image)): ?>
                <div class="img-holder">
                    <img src="<?php print esc_url($image); ?>" alt="img">
                </div>
                <?php endif; ?>
                <div class="details">

                    <?php if(!empty( $settings['badge'] )) : ?>
                    <span><?php echo elh_element_kses_basic($settings['badge']); ?></span>
                    <?php endif; ?>

                    <div class="info">

                        <?php if(!empty( $settings['price_start'] )) : ?>
                        <p class="price"><?php echo elh_element_kses_basic($settings['price_start']); ?></p>
                        <?php endif; ?>

                        <?php if(!empty( $settings['title'] )) : ?>
                        <h4><?php echo elh_element_kses_basic($settings['title']); ?></h4>
                        <?php endif; ?>

                        <?php if(!empty( $settings['button_link']['url'] )) : ?>
                        <a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="theme-btn-s7">
                            <?php echo elh_element_kses_basic($settings['button_text']); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>
        <?php
    }

}
