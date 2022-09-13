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
use \ElementHelper\Element_El_Select2;
use \Elementor\Utils;


defined( 'ABSPATH' ) || die();

class Woo_Deal_Product extends Element_El_Widget {


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
        return 'woo_deal_product';
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
        return __( 'Woo Deal Product', 'elementhelper' );
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
        return 'elh-widget-icon eicon-product-images';
    }

    public function get_keywords() {
        return [ 'woo', 'product' ];
    }

    public function get_post_types() {
        $post_types = elh_element_get_post_types([], ['elementor_library', 'attachment']);
        return $post_types;
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
            'title',
            [
                'label' => __( 'Title', 'elementhelper' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
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
            ]
        );

        $this->add_control(
            'count_down',
            [
                'label' => __( 'Count Down', 'elementhelper' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => '2022/2/14',
                'placeholder' => __( '2022/2/14', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();


        //desc
        $this->start_controls_section(
            '_section_video',
            [
                'label' => __( 'Video Section', 'elementhelper' ),
                'tab' => Controls_Manager::TAB_CONTENT,
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
        'video_url',
            [
                'label' => __( 'Video Url', 'elementhelper' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'http://elementor.sabber.com/',
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
            'button_text',
            [
                'label' => __( 'Button Text', 'elementhelper' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Add to cart',
                'placeholder' => __( 'Type button text here', 'elementhelper' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
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
            'title_color',
            [
                'label' => __( 'Title Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deal-of-the-day-section .deal-area h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .deal-of-the-day-section .deal-area h2
                    ',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Description Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deal-of-the-day-section .deal-area p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .deal-of-the-day-section .deal-area p
                    ',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __( 'Price color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deal-of-the-day-section .deal-area .woocommerce-Price-amount' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'old_price_color',
            [
                'label' => __( 'Old Price color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deal-of-the-day-section .deal-area del' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .deal-of-the-day-section .deal-area del .woocommerce-Price-amount' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .deal-of-the-day-section .deal-area .woocommerce-Price-amount
                    ',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );


        $this->add_control(
            'counter_text_color',
            [
                'label' => __( 'Counter Inner Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deal-of-the-day-section #clock .box > div' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'counter_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .deal-of-the-day-section #clock .box > div
                    ',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_control(
            'counter_text_bg_color',
            [
                'label' => __( 'Counter Inner Bg Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deal-of-the-day-section #clock .box > div' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'counter_text_bottom_color',
            [
                'label' => __( 'Counter Bottom Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deal-of-the-day-section #clock .box span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'counter_text_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .deal-of-the-day-section #clock .box span
                    ',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_video',
            [
                'label' => __( 'Video Button Style', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'video_btn_bg_color',
            [
                'label' => __( 'Button Bg', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deal-of-the-day-section .deal-pic .video-area' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'video_btn_color',
            [
                'label' => __( 'Button Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deal-of-the-day-section .deal-pic .video-area svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => __( 'Add Cart Button Style', 'elementhelper' ),
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
                    '{{WRAPPER}} .theme-btn-s3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .theme-btn-s3
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
                    '{{WRAPPER}} .theme-btn-s3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .theme-btn-s3' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .theme-btn-s3:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .theme-btn-s3:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        if (!empty($settings['bg_image']['id'])) {
            $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['thumbnail_size']);
        }

        ?>

        <?php if ( $settings['design_style'] === 'style_7' ):

        ?>

        <?php else: ?>

        <script>
        (function($) {
            $(document).ready(function(){
                if ($("#clock").length) {
                    $('#clock').countdown('<?php echo esc_html($settings['count_down']); ?>', function(event) {
                        var days = $("#clock").data("days"),
                            hours = $("#clock").data("hours"),
                            mins = $("#clock").data("mins"),
                            sec = $("#clock").data("sec");

                        var $this = $(this).html(event.strftime(''
                        + '<div class="box"><div>%D</div> <span>' + days + '</span> </div>'
                        + '<div class="box"><div>%H</div> <span>' + hours + '</span> </div>'
                        + '<div class="box"><div>%M</div> <span>' + mins + '</span> </div>'
                        + '<div class="box"><div>%S</div> <span>' + sec + '</span> </div>'));
                    });
                }
            });

        })(window.jQuery);
        </script>

        <section class="deal-of-the-day-section section-padding">
            <div class="content-area clearfix">
                <div class="left-col">
                    <div class="deal-area">

                        <?php if($settings['title']) : ?>
                        <h2><?php echo elh_element_kses_intermediate( $settings['title'] ); ?></h2>
                        <?php endif; ?>

                        <?php if($settings['description']) : ?>
                        <p><?php echo elh_element_kses_intermediate( $settings['description'] ); ?></p>
                        <?php endif; ?>

                        <?php $product = wc_get_product( $settings['post_id'] ); ?>
                        <div class="woocommerce-Price-amount amount">
                            <?php if(!empty($settings['post_id'])) : ?>
                            <ins>
                                <span class="woocommerce-Price-amount amount">
                                    <bdi><span class="woocommerce-Price-currencySymbol">$</span><?php echo $product->get_price(); ?></bdi>
                                </span>
                            </ins>
                            <del>
                                <span class="woocommerce-Price-amount amount">
                                    <bdi><span class="woocommerce-Price-currencySymbol">$</span><?php echo $product->get_regular_price(); ?></bdi>
                                </span>
                            </del>
                            <?php endif; ?>
                        </div>

                        <div class="count-down-clock">
                            <div id="clock" data-days="Days" data-hours="Hours" data-mins="Mins" data-sec="Secs"></div>
                        </div>

                        <?php if($settings['button_text']) : ?>
                        <a href="?add-to-cart=<?php echo $settings['post_id']; ?>" class="theme-btn-s3">
                            <span><?php echo esc_html($settings['button_text']); ?></span> <i class="ti-arrow-right"></i>
                        </a>
                        <?php endif; ?>

                    </div>

                </div>

                <div class="right-col">
                    <div class="deal-pic">

                        <?php if(!empty($bg_image)) : ?>
                        <img src="<?php echo esc_url($bg_image); ?>" alt="img">
                        <?php endif; ?>

                        <?php if(!empty( $settings['video_url']['url'] )) : ?>
                        <div class="video-area">
                            <a href="<?php echo esc_url($settings['video_url']['url']); ?>" class="video-btn video-btn-s1" data-type="iframe" tabindex="0">
                                <svg width="58" height="74" viewBox="0 0 58 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 1L57 37L1 73V1Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>

            </div> <!-- end container -->
        </section>

        <?php endif; ?>
        <?php
    }
}
