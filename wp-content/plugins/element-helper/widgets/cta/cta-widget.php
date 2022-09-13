<?php
namespace ElementHelper\Widget;

use \Elementor\Repeater;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;


defined( 'ABSPATH' ) || die();

class CTA extends Element_El_Widget {


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
        return 'cta';
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
        return __( 'CTA', 'elementhelper' );
    }

    public function get_custom_help_url() {
        return 'http://elementor.sabber.com/widgets/gradient-heading/';
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
        return 'elh-widget-icon eicon-t-letter';
    }

    public function get_keywords() {
        return [ 'gradient', 'advanced', 'heading', 'title', 'colorful' ];
    }

    public function get_script_depends() {
		return ['elh_cta'];
	}

    protected function register_content_controls() {

        //Settings
        $this->start_controls_section(
            '_section_settings',
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
                    'style_1' => __( 'Style 1: Home 1', 'elementhelper' ),
                    'style_2' => __( 'Style 2: Home 3', 'elementhelper' ),
                    'style_3' => __( 'Style 3: Home 1', 'elementhelper' ),
                    'style_4' => __( 'Style 4: Download App', 'elementhelper' ),
                    'style_5' => __( 'Style 5: Order Now', 'elementhelper' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        //desc
        $this->start_controls_section(
            '_section_title',
            [
                'label' => __( 'Title & Desccription', 'elementhelper' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => __( 'Sub Title', 'elementhelper' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => 'Heading Sub Title',
                'placeholder' => __( 'Heading Sub Text', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'elementhelper' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Heading Title',
                'placeholder' => __( 'Heading Text', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'elementhelper' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Description here',
                'placeholder' => __( 'Description', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1', 'style_3']
                ],
            ]
        );

        $this->add_control(
            'new_price',
            [
                'label' => __( 'New Price', 'elementhelper' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => '46.99',
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1', 'style_2', 'style_3']
                ],
            ]
        );

        $this->add_control(
            'old_price',
            [
                'label' => __( 'Old Price', 'elementhelper' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => '59.99',
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1', 'style_2', 'style_3']
                ],
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'label' => __( 'Image', 'elementhelper' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'app_image',
            [
                'label' => __( 'App image', 'elementhelper' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_4']
                ],
            ]
        );

        $this->add_control(
            'app_link',
            [
                'label' => __( 'Link', 'elementhelper' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'http://elementor.sabber.com/',
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_4']
                ],
            ]
        );

        $this->add_control(
            'sm_image',
            [
                'label' => __( 'Image 2', 'elementhelper' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1', 'style_3']
                ],
            ]
        );

        $this->add_control(
            'app_image2',
            [
                'label' => __( 'App image 2', 'elementhelper' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_4']
                ],
            ]
        );

        $this->add_control(
            'app_link2',
            [
                'label' => __( 'Link', 'elementhelper' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'http://elementor.sabber.com/',
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_4']
                ],
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
            ]
        );

        $this->end_controls_section();


        //button
        $this->start_controls_section(
            '_section_button',
            [
                'label' => __( 'Button', 'elementhelper' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'elementhelper' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Button Text',
                'placeholder' => __( 'Type button text here', 'elementhelper' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __( 'Link', 'elementhelper' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'http://elementor.sabber.com/',
                'dynamic' => [
                    'active' => true,
                ]
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

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Decription Color', 'elementhelper' ),
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

        $this->start_controls_section(
            '_section_style_price',
            [
                'label' => __( 'Price Style', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'big_price_color',
            [
                'label' => __( 'Big Price', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .offer_content .offer_price h4' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'big_price_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .offer_content .offer_price h4',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_control(
            'small_price_color',
            [
                'label' => __( 'Big Price', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .offer_content .offer_price h4 > span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'small_price_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .offer_content .offer_price h4 > span',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        if (!empty($settings['bg_image']['id'])) {
            $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['thumbnail_size']);
        }
        if (!empty($settings['sm_image']['id'])) {
            $sm_image = wp_get_attachment_image_url($settings['sm_image']['id'], 'large');
        }
        if (!empty($settings['app_image']['id'])) {
            $app_image = wp_get_attachment_image_url($settings['app_image']['id'], 'large');
        }
        if (!empty($settings['app_image2']['id'])) {
            $app_image2 = wp_get_attachment_image_url($settings['app_image2']['id'], 'large');
        }

        ?>

        <?php if ( $settings['design_style'] === 'style_5' ): ?>
        <section class="cta_area mb-120">
            <div class="container">
                <div class="cta_bg_2">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="cta_text_wrap">
                                <div class="sec_title">

                                    <?php if($settings['subtitle']) : ?>
                                    <span><?php echo elh_element_kses_intermediate( $settings['subtitle'] ); ?></span>
                                    <?php endif; ?>

                                    <?php if($settings['title']) : ?>
                                    <h2><?php echo elh_element_kses_intermediate( $settings['title'] ); ?></h2>
                                    <?php endif; ?>

                                </div>
                                <?php if($settings['button_link']['url']) : ?>
                                <div class="cta_btn mt-30">
                                    <a class="thm_btn" href="<?php echo esc_url($settings['button_link']['url']); ?>">
                                    <?php echo esc_html($settings['button_text']); ?></a></li>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <?php if(!empty( $bg_image )) : ?>
                            <div class="cta_img">
                                <img src="<?php echo $bg_image; ?>" alt="img">
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php elseif ( $settings['design_style'] === 'style_4' ): ?>

        <section class="cta_area mobile_app pt-220 pb-120">
            <div class="container">
                <div class="cta_bg_wrap">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-5">
                            <?php if(!empty( $bg_image )) : ?>
                            <div class="cta_app">
                                <img src="<?php echo $bg_image; ?>" alt="img">
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-7 col-md-7">
                            <div class="cta_text">
                                <div class="sec_title">

                                    <?php if($settings['subtitle']) : ?>
                                    <span><?php echo elh_element_kses_intermediate( $settings['subtitle'] ); ?></span>
                                    <?php endif; ?>

                                    <?php if($settings['title']) : ?>
                                    <h2><?php echo elh_element_kses_intermediate( $settings['title'] ); ?></h2>
                                    <?php endif; ?>

                                </div>
                                <ul class="cta_app_wrap ul_li">

                                    <?php if(!empty( $settings['app_link']['url'] )) : ?>
                                    <li>
                                        <a href="<?php echo esc_url($settings['app_link']['url']); ?>">
                                            <?php if(!empty( $app_image )) : ?>
                                            <img src="<?php echo $app_image; ?>" alt="img">
                                            <?php endif; ?>
                                        </a>
                                    </li>
                                    <?php endif; ?>

                                    <?php if(!empty( $settings['app_link2']['url'] )) : ?>
                                    <li>
                                        <a href="<?php echo esc_url($settings['app_link2']['url']); ?>">
                                            <?php if(!empty( $app_image2 )) : ?>
                                            <img src="<?php echo $app_image2; ?>" alt="img">
                                            <?php endif; ?>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php elseif ( $settings['design_style'] === 'style_3' ): ?>

        <section class="offer_area offer_2 offer_img_bg pt-120 pb-120" data-background="<?php echo !empty($bg_image) ? $bg_image : ''; ?>">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="offer_content">
                            <div class="sec_title sec_title-white">

                                <?php if($settings['subtitle']) : ?>
                                <span><?php echo elh_element_kses_intermediate( $settings['subtitle'] ); ?></span>
                                <?php endif; ?>

                                <?php if($settings['title']) : ?>
                                <h2><?php echo elh_element_kses_intermediate( $settings['title'] ); ?></h2>
                                <?php endif; ?>

                                <?php if($settings['description']) : ?>
                                <p><?php echo elh_element_kses_intermediate( $settings['description'] ); ?></p>
                                <?php endif; ?>

                            </div>
                            <ul class="offer_btn ul_li">
                                <?php if($settings['button_link']['url']) : ?>
                                <li><a class="thm_btn thm_btn-2" href="<?php echo esc_url($settings['button_link']['url']); ?>">
                                    <?php echo esc_html($settings['button_text']); ?></a></li>
                                <?php endif; ?>

                                <li>
                                    <div class="offer_price">
                                        <h4>
                                            <?php if(!empty( $settings['new_price'] )) : ?>
                                            <?php echo esc_html( $settings['new_price'] ); ?>
                                            <?php endif; ?>

                                            <?php if(!empty( $settings['old_price'] )) : ?>
                                            <span><?php echo esc_html( $settings['old_price'] ); ?></span>
                                            <?php endif; ?>
                                        </h4>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php if(!empty( $sm_image )) : ?>
                <div class="d_img">
                    <img src="<?php echo $sm_image; ?>" alt="img">
                </div>
                <?php endif; ?>
            </div>
        </section>

        <?php elseif ( $settings['design_style'] === 'style_2' ): ?>

        <section class="offer_area offer_3 section_notch offer_img_bg pt-120 pb-120" data-background="<?php echo !empty($bg_image) ? $bg_image : ''; ?>">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 offset-xl-6 col-lg-8 offset-lg-4">
                        <div class="offer_content">
                            <div class="sec_title sec_title-white">

                                <?php if($settings['subtitle']) : ?>
                                <span><?php echo elh_element_kses_intermediate( $settings['subtitle'] ); ?></span>
                                <?php endif; ?>

                                <?php if($settings['title']) : ?>
                                <h2><?php echo elh_element_kses_intermediate( $settings['title'] ); ?></h2>
                                <?php endif; ?>

                            </div>
                            <ul class="offer_btn ul_li">

                                <?php if($settings['button_link']['url']) : ?>
                                <li><a class="thm_btn thm_btn-2" href="<?php echo esc_url($settings['button_link']['url']); ?>">
                                    <?php echo esc_html($settings['button_text']); ?></a></li>
                                <?php endif; ?>

                                <li>
                                    <div class="offer_price">
                                        <h4>
                                            <?php if(!empty( $settings['new_price'] )) : ?>
                                            <?php echo esc_html( $settings['new_price'] ); ?>
                                            <?php endif; ?>

                                            <?php if(!empty( $settings['old_price'] )) : ?>
                                            <span><?php echo esc_html( $settings['old_price'] ); ?></span>
                                            <?php endif; ?>
                                        </h4>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="offer_shape">
                            <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/shape/offer_shape.png" alt="img">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php else: ?>

        <section class="offer_area section_bg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="offer_content pt-110 pb-110">
                            <div class="sec_title">

                                <?php if($settings['subtitle']) : ?>
                                <span><?php echo elh_element_kses_intermediate( $settings['subtitle'] ); ?></span>
                                <?php endif; ?>

                                <?php if($settings['title']) : ?>
                                <h2><?php echo elh_element_kses_intermediate( $settings['title'] ); ?></h2>
                                <?php endif; ?>

                                <?php if($settings['description']) : ?>
                                <p><?php echo elh_element_kses_intermediate( $settings['description'] ); ?></p>
                                <?php endif; ?>

                            </div>
                            <ul class="offer_btn ul_li">
                                <?php if($settings['button_link']['url']) : ?>
                                <li><a class="thm_btn thm_btn-2" href="<?php echo esc_url($settings['button_link']['url']); ?>">
                                    <?php echo esc_html($settings['button_text']); ?></a></li>
                                <?php endif; ?>
                                <li>
                                    <div class="offer_price">
                                        <h4>
                                            <?php if(!empty( $settings['new_price'] )) : ?>
                                            <?php echo esc_html( $settings['new_price'] ); ?>
                                            <?php endif; ?>

                                            <?php if(!empty( $settings['old_price'] )) : ?>
                                            <span><?php echo esc_html( $settings['old_price'] ); ?></span>
                                            <?php endif; ?>
                                        </h4>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="offer_img">

                            <?php if(!empty( $bg_image )) : ?>
                            <img src="<?php echo $bg_image; ?>" alt="img">
                            <?php endif; ?>

                            <?php if(!empty( $sm_image )) : ?>
                            <div class="d_img">
                                <img src="<?php echo $sm_image; ?>" alt="img">
                            </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php endif; ?>
        <?php
    }
}
