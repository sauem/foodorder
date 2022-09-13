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

defined( 'ABSPATH' ) || die();

class Skill extends Element_El_Widget {

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
        return 'skill';
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
        return __( 'Our Skill', 'elementhelper' );
    }

	public function get_custom_help_url() {
		return 'http://elementor.sabber.com/widgets/fact/';
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
        return 'elh-widget-icon eicon-save-o';
    }

    public function get_keywords() {
        return [ 'fact', 'image', 'counter', 'skill' ];
    }

    public function get_script_depends() {
		return ['elh_skill_slider'];
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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );
        $this->end_controls_section();

        // title
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
            'bg_image',
            [
                'label' => __('Section Bg Image', 'elementhelper'),
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
            '_section_slides',
            [
                'label' => __( 'Skill List', 'elementhelper' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Title', 'elementhelper' ),
                'placeholder' => __( 'Type title here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'number',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Circle Number', 'elementhelper' ),
                'default' => __( '70', 'elementhelper' ),
                'placeholder' => __( 'Type number here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'color',
			[
				'label' => __( 'Skill Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .progress-wrapper .progress' => 'background-color: {{VALUE}}',
				],
                'default' => '#001790'
			]
        );

        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_button',
            [
                'label' => __( 'Video Button', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1'],
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

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_video_icon',
            [
                'label' => __( 'Video Icon', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_video_icon_color',
            [
                'label' => __('Video Icon Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-skills-section .pr6-skills-top .pr6-video-btn a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_video_icon_bg_color',
            [
                'label' => __('Video Icon Bg Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-skills-section .pr6-skills-top .pr6-video-btn a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_section_style_skill',
            [
                'label' => __( 'Skill Style', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'skill_title_color',
            [
                'label' => __('Title', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-headline h4' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'skill_number_color',
            [
                'label' => __('Number Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-skills-section .pr6-skills-bottom .pr6-skills-list .pr6-skills-bar .progress-bar .progress span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'skill_number_bg_color',
            [
                'label' => __('Number Bg Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pr6-skills-section .pr6-skills-bottom .pr6-skills-list .pr6-skills-bar .progress-bar .progress span' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();
    }

	protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', '' );


        $this->add_inline_editing_attributes( 'description', 'intermediate' );
        $this->add_render_attribute( 'description', 'class', '' );

        if (!empty($settings['bg_image']['id'])) {
            $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], 'large');
        }

        if ( empty( $settings['slides'] ) ) {
            return;
        }
    ?>

    <?php if ( $settings['design_style'] === 'style_2' ): ?>


    <?php else: ?>

    <section class="pr6-skills-section" data-background="<?php echo $bg_image; ?>">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="pr6-skills-top">
                        <div class="pr6-title-area text-center wow fadeInUp">
                            <?php if ( !empty($settings['sub_title']) ) : ?>
                                <span class="pr6-subtitle"><?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?></span>
                            <?php endif; ?>

                            <?php if ( !empty($settings['title']) ) : ?>
                            <div class="pr6-headline">
                                <h3><?php echo elh_element_kses_intermediate( $settings['title'] ); ?></h3>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php if(!empty($settings['button_link'])) : ?>
                        <div class="pr6-video-btn wow fadeInUp" data-wow-delay="0.2s">
                            <span class="pr6-arrow-shape"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow.png" alt="img"></span>
                            <div class="pr6-vd-btn">
                                <a href="<?php echo esc_url($settings['button_link']['url']) ?>"><i class="fas fa-play"></i></a>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="pr6-skills-bottom" data-background="<?php echo get_template_directory_uri(); ?>/assets/img/skills/white-bg.jpg">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if(!empty ($settings['slides'])) : ?>
                            <div class="pr6-skills-list">
                                <div class="row mt-none-55">
                                    <?php foreach ( $settings['slides'] as $slide ) :?>
                                    <div class="col-lg-6 mt-55">
                                        <div class="pr6-skills-bar wow fadeInUp">
                                            <div class="pr6-headline">
                                                <h4><?php echo elh_element_kses_basic( $slide['title'] ); ?></h4>
                                            </div>
                                            <div class="progress-bar">
                                                <div class="progress-wrapper">
                                                    <div class="progress" data-percent="<?php echo esc_attr( $slide['number'] ); ?>" data-color="<?php echo esc_attr( $slide['color'] ); ?>">
                                                        <span class="kire"><?php echo esc_html( $slide['number'] ); ?>%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endif; ?>
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
