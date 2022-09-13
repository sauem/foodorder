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

class Testimonial_Slider extends Element_El_Widget
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
        return 'testimonial_slider';
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
        return __('Testimonial Slider', 'elementhelper');
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
        return 'elh-widget-icon eicon-blockquote';
    }

    public function get_keywords()
    {
        return ['slider', 'testimonial', 'gallery', 'carousel'];
    }

    public function get_script_depends() {
		return ['elh_testimonial_slider'];
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


        // section title
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
                'condition' => [
                    'design_style' => ['style_1']
                ],
            ]
        );

        $this->add_control(
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
                    'design_style' => ['style_3']
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

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_icon',
            [
                'label' => __( 'Counter List', 'elementhelper' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1']
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => __( 'Counter', 'elementhelper' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( '14k', 'elementhelper' ),
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
                'default' => __( 'HAPPY CUSTOMER', 'elementhelper' ),
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
                        'title' => __( 'Title Here', 'elementhelper' ),
                        'description' => __( 'Description Here', 'elementhelper' ),
                    ],
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_slides',
            [
                'label' => __('Slides', 'elementhelper'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __('Profile Image', 'elementhelper'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'message',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __('Message', 'elementhelper'),
                'default' => __('Message here', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'client_name',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __('Client Name', 'elementhelper'),
                'default' => __('Client Name', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'designation',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __('Designation Name', 'elementhelper'),
                'default' => __('Designation', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'star',
            [
                'label_block' => true,
                'show_label' => false,
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'star_1' => __('1 Star', 'elementhelper'),
                    'star_2' => __('2 Star', 'elementhelper'),
                    'star_3' => __('3 Star', 'elementhelper'),
                    'star_4' => __('4 Star', 'elementhelper'),
                    'star_5' => __('5 Star', 'elementhelper'),
                ],
                'default' => 'star_5',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'rating_count',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __('Rating Text', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(client_name || "Carousel Item"); #>',
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

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_counter',
            [
                'label' => __( 'Counter', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => ['style_1']
                ],
            ]
        );

        $this->add_control(
            'count_color',
            [
                'label' => __( 'Counter Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm_content .tm_counter h3' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tm_content .tm_counter h3 > span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'counter_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .tm_content .tm_counter h3
                    ',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'count_title_color',
            [
                'label' => __( 'Designation Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm_content .tm_counter span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'count_title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .tm_content .tm_counter span
                    ',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_testimonial',
            [
                'label' => __( 'Testimonial Box', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'message_color',
            [
                'label' => __( 'Message Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm_single p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tm_item p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'mssage_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .tm_single p,
                    {{WRAPPER}} .tm_item p
                    ',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'tm_title_color',
            [
                'label' => __( 'Title Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm_single .a_info h4' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tm_item .author_info h4' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tm_title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .tm_single .a_info h4,
                    {{WRAPPER}} .tm_item .author_info h4
                    ',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'tm_designation_color',
            [
                'label' => __( 'Title Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm_single .a_info span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tm_item .author_info span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tm_designation_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .tm_single .a_info span,
                    {{WRAPPER}} .tm_item .author_info span
                    ',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'tm_rating_color',
            [
                'label' => __( 'Rating Icon Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rating_star li' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'design_style' => ['style_1']
                ],
            ]
        );

        $this->add_control(
            'tm_rating_text_color',
            [
                'label' => __( 'Rating Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rating_wrap span' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'design_style' => ['style_1']
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tm_rating_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .rating_wrap span
                    ',
                'scheme' => Typography::TYPOGRAPHY_2,
                'condition' => [
                    'design_style' => ['style_1']
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (!empty($settings['bg_image']['id'])) {
            $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['thumbnail_size']);
        }

        if (empty($settings['slides'])) {
            return;
        }
        if ($settings['design_style'] == 'style_3'):
    ?>

    <section class="testimonial_area testimonial_2" data-background="<?php echo get_template_directory_uri(  ); ?>/assets/img/bg/reservation_bg.jpg">
        <div class="container-fluid p-0">
            <div class="row g-0 flex-row-reverse">
                <div class="col-lg-6">
                    <div class="reservation_img pos-rel">
                        <?php if(!empty( $bg_image )) : ?>
                        <img src="<?php echo esc_url($bg_image); ?>" alt="img">
                        <?php endif; ?>

                        <?php if(!empty( $settings['video_link']['url'] )) : ?>
                        <a class="popup-video video_icon" href="<?php echo esc_url($settings['video_link']['url']) ?>"><i class="fal fa-play"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="testimonial_content_wrap text-center">
                        <div class="sec_title sec_title-white">

                            <?php if(!empty( $settings['sub_title'] )) : ?>
                            <span><?php echo elh_element_kses_intermediate($settings['sub_title']); ?></span>
                            <?php endif; ?>

                            <?php if(!empty( $settings['title'] )) : ?>
                            <h2><?php echo elh_element_kses_intermediate($settings['title']); ?></h2>
                            <?php endif; ?>

                        </div>
                        <div class="testimonial_active-3 owl-carousel">
                            <?php foreach ($settings['slides'] as $slide) :
                                if (!empty($slide['image']['id'])) {
                                    $image = wp_get_attachment_image_url($slide['image']['id'], 'large');
                                }
                            ?>
                            <div class="tm_item">
                                <div class="tm_icon">
                                    <i class="fa fa-quote-right"></i>
                                </div>

                                <?php if (!empty($slide['message'])): ?>
                                <p><?php echo esc_html($slide['message']); ?></p>
                                <?php endif; ?>

                                <div class="author_info">

                                    <?php if(!empty( $image )) : ?>
                                    <div class="author">
                                        <img src="<?php echo esc_url($image); ?>" alt="img">
                                    </div>
                                    <?php endif; ?>

                                    <?php if(!empty( $slide['client_name'] )) : ?>
                                    <h4><?php echo esc_html($slide['client_name']); ?></h4>
                                    <?php endif; ?>

                                    <?php if(!empty( $slide['designation'] )) : ?>
                                    <span><?php echo esc_html($slide['designation']); ?></span>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php  elseif ($settings['design_style'] == 'style_2'): ?>
    <section class="testiminial_area pt-120 pb-120">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <?php if(!empty( $bg_image )) : ?>
                    <div class="testimonial_img">
                        <img src="<?php echo esc_url($bg_image); ?>" alt="img">
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-6">
                    <div class="testimonial_right">
                        <div class="sec_title">

                            <?php if(!empty( $settings['sub_title'] )) : ?>
                            <span><?php echo elh_element_kses_intermediate($settings['sub_title']); ?></span>
                            <?php endif; ?>

                            <?php if(!empty( $settings['title'] )) : ?>
                            <h2><?php echo elh_element_kses_intermediate($settings['title']); ?></h2>
                            <?php endif; ?>

                        </div>
                        <div class="testimonial_active-2 owl-carousel">
                            <?php foreach ($settings['slides'] as $slide) :
                                if (!empty($slide['image']['id'])) {
                                    $image = wp_get_attachment_image_url($slide['image']['id'], 'large');
                                }
                            ?>
                            <div class="tm_item">

                                <?php if (!empty($slide['message'])): ?>
                                <p><?php echo esc_html($slide['message']); ?></p>
                                <?php endif; ?>

                                <?php if(!empty( $image )) : ?>
                                <div class="tm_author_wrap">
                                    <img class="tm_author" src="<?php echo esc_url($image); ?>" alt="img">
                                    <i class="fa fa-quote-right"></i>
                                </div>
                                <?php endif; ?>

                                <div class="author_info">

                                    <?php if(!empty( $slide['client_name'] )) : ?>
                                    <h4><?php echo esc_html($slide['client_name']); ?></h4>
                                    <?php endif; ?>

                                    <?php if(!empty( $slide['designation'] )) : ?>
                                    <span><?php echo esc_html($slide['designation']); ?></span>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php else: ?>

    <section class="testimonial_area testimonial_bg pt-120 pb-120" data-background="<?php echo !empty($bg_image) ? $bg_image : ''; ?>">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7">
                    <div class="tm_content">
                        <div class="sec_title sec_title-white">

                            <?php if(!empty( $settings['sub_title'] )) : ?>
                            <span><?php echo elh_element_kses_intermediate($settings['sub_title']); ?></span>
                            <?php endif; ?>

                            <?php if(!empty( $settings['title'] )) : ?>
                            <h2><?php echo elh_element_kses_intermediate($settings['title']); ?></h2>
                            <?php endif; ?>

                            <?php if(!empty( $settings['description'] )) : ?>
                            <p><?php echo elh_element_kses_intermediate($settings['description']); ?></p>
                            <?php endif; ?>
                        </div>

                        <ul class="tm_counter ul_li">
                            <?php foreach ($settings['counters'] as $counter) : ?>
                            <li>
                                <?php if(!empty( $counter['title'] )) : ?>
                                <h3><?php echo esc_html($counter['title']); ?><span>+</span></h3>
                                <?php endif; ?>

                                <?php if(!empty( $counter['description'] )) : ?>
                                <span><?php echo esc_html($counter['description']); ?></span>
                                <?php endif; ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5">
                    <div class="testimonial_active owl-carousel">
                        <?php foreach ($settings['slides'] as $slide) :
                            if (!empty($slide['image']['id'])) {
                                $image = wp_get_attachment_image_url($slide['image']['id'], 'large');
                            }
                        ?>
                        <div class="tm_single white_bg">
                            <div class="tm_top ul_li justify-content-between">

                                <?php if(!empty( $image )) : ?>
                                <div class="tm_author">
                                    <img src="<?php echo esc_url($image); ?>" alt="img">
                                </div>
                                <?php endif; ?>

                                <div class="tm_quote">
                                    <i class="fa fa-quote-right"></i>
                                </div>
                            </div>

                            <?php if (!empty($slide['message'])): ?>
                            <p><?php echo esc_html($slide['message']); ?></p>
                            <?php endif; ?>

                            <div class="tm_bottom ul_li justify-content-between">
                                <div class="a_info">

                                    <?php if(!empty( $slide['client_name'] )) : ?>
                                    <h4><?php echo esc_html($slide['client_name']); ?></h4>
                                    <?php endif; ?>

                                    <?php if(!empty( $slide['designation'] )) : ?>
                                    <span><?php echo esc_html($slide['designation']); ?></span>
                                    <?php endif; ?>

                                </div>
                                <div class="rating_wrap">
                                    <ul class="rating_star ul_li">
                                        <?php if($slide['star'] == 'star_1') : ?>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fal fa-star"></i></li>
                                            <li><i class="fal fa-star"></i></li>
                                            <li><i class="fal fa-star"></i></li>
                                            <li><i class="fal fa-star"></i></li>
                                        <?php elseif($slide['star'] == 'star_2') : ?>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fal fa-star"></i></li>
                                            <li><i class="fal fa-star"></i></li>
                                            <li><i class="fal fa-star"></i></li>
                                        <?php elseif($slide['star'] == 'star_3') : ?>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fal fa-star"></i></li>
                                            <li><i class="fal fa-star"></i></li>
                                        <?php elseif($slide['star'] == 'star_4') : ?>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fal fa-star"></i></li>
                                        <?php elseif($slide['star'] == 'star_5') : ?>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                        <?php endif; ?>
                                    </ul>
                                    <?php if(!empty( $slide['rating_count'] )) : ?>
                                    <span><?php echo esc_html($slide['rating_count']); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
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
