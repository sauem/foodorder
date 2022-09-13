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

class Member_Slider extends Element_El_Widget {

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
        return 'member_slider';
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
        return __( 'Team Member', 'elementhelper' );
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
        return 'elh-widget-icon eicon-lock-user';
    }

    public function get_keywords() {
        return [ 'slider', 'memeber', 'gallery', 'carousel' ];
    }

    public function get_script_depends() {
		return ['elh_team_slider'];
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
                    'style_1' => __('Style 1', 'elementhelper'),
                    'style_2' => __('Style 2', 'elementhelper'),
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
                    'design_style' => ['style_1'],
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

        $this->end_controls_section();

        // member list
        $this->start_controls_section(
            '_section_slides',
            [
                'label' => __( 'Members List', 'elementhelper' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs(
            '_tab_style_member_box_slider'
        );

        $repeater->start_controls_tab(
            '_tab_member_info',
            [
                'label' => __( 'Information', 'elementhelper' ),
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
                ]
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Title', 'elementhelper' ),
                'default' => __( 'ElhMember Title', 'elementhelper' ),
                'placeholder' => __( 'Type title here', 'elementhelper' ),
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
                'show_label' => true,
                'label' => __( 'Job Title', 'elementhelper' ),
                'default' => __( 'ElhOfficer', 'elementhelper' ),
                'placeholder' => __( 'Type designation here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            '_tab_member_links',
            [
                'label' => __( 'Social Links', 'elementhelper' ),
            ]
        );

        $repeater->add_control(
            'show_social',
            [
                'label' => __( 'Show Options?', 'elementhelper' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'elementhelper' ),
                'label_off' => __( 'No', 'elementhelper' ),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'web_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Website Address', 'elementhelper' ),
                'placeholder' => __( 'Add your profile link', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'email_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Email', 'elementhelper' ),
                'placeholder' => __( 'Add your email link', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'phone_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Phone', 'elementhelper' ),
                'placeholder' => __( 'Add your phone link', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'facebook_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Facebook', 'elementhelper' ),
                'default' => __( '#', 'elementhelper' ),
                'placeholder' => __( 'Add your facebook link', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'twitter_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Twitter', 'elementhelper' ),
                'default' => __( '#', 'elementhelper' ),
                'placeholder' => __( 'Add your twitter link', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'instagram_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Instagram', 'elementhelper' ),
                'default' => __( '#', 'elementhelper' ),
                'placeholder' => __( 'Add your instagram link', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'linkedin_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'LinkedIn', 'elementhelper' ),
                'default' => __( '#', 'elementhelper' ),
                'placeholder' => __( 'Add your linkedin link', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'youtube_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Youtube', 'elementhelper' ),
                'placeholder' => __( 'Add your youtube link', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'googleplus_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Google Plus', 'elementhelper' ),
                'placeholder' => __( 'Add your Google Plus link', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'flickr_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Flickr', 'elementhelper' ),
                'placeholder' => __( 'Add your flickr link', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'vimeo_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Vimeo', 'elementhelper' ),
                'placeholder' => __( 'Add your vimeo link', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'behance_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Behance', 'elementhelper' ),
                'placeholder' => __( 'Add your hehance link', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'dribble_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Dribbble', 'elementhelper' ),
                'placeholder' => __( 'Add your dribbble link', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'pinterest_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Pinterest', 'elementhelper' ),
                'placeholder' => __( 'Add your pinterest link', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'gitub_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Github', 'elementhelper' ),
                'placeholder' => __( 'Add your github link', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        // REPEATER
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
            '_section_style_social',
            [
                'label' => __( 'Team Box', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'team_ttile_color',
            [
                'label' => __( 'Title Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team_single .team_text h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'team_ttile_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .team_single .team_text h3
                    ',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'team_designation_color',
            [
                'label' => __( 'Designation Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team_single .team_text span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'team_designation_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .team_single .team_text span
                    ',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );


        $this->add_control(
            'social_heading',
            [
                'label' => __( 'Social Links', 'elementhelper' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->start_controls_tabs( '_tabs_social-' );

        $this->start_controls_tab(
            '_tab_social_normal',
            [
                'label' => __( 'Normal', 'elementhelper' ),
            ]
        );

        $this->add_control(
            'social_icon_color',
            [
                'label' => __( 'Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .team_single .team_social a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'social_icon_bg_color',
            [
                'label' => __( 'Background Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team_single .team_social a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'social_hover',
            [
                'label' => __( 'Hover', 'elementhelper' ),
            ]
        );

        $this->add_control(
            'social_hover_color',
            [
                'label' => __( 'Icon Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team_single .team_social a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'social_hover_bg_color',
            [
                'label' => __( 'Icon Bg Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team_single .team_social a:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'team-title' );
        $this->add_render_attribute( 'name', 'class', 'name' );

        $this->add_inline_editing_attributes( 'description', 'intermediate' );
        $this->add_render_attribute( 'description', 'class', 'elh-card-text' );

        if (!empty($title)) {
            $title = elh_element_kses_basic( $settings['title' ] );
        }

        if ( empty( $settings['slides'] ) ) {
            return;
        }
        ?>

    <?php if ( $settings['design_style'] === 'style_3' ):

        // bg_image
        if (!empty($settings['bg_shape_image']['id'])) {
            $bg_shape_image = wp_get_attachment_image_url( $settings['bg_shape_image']['id'], $settings['shape_size'] );
            if ( ! $bg_shape_image ) {
                $bg_shape_image = $settings['bg_shape_image']['url'];
            }
        }

        $slider_active = !empty($settings['slider_active']) ? 'team1__carousel owl-carousel' : '';
    ?>

        <section class="pr6-leadership-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-7">
						<div class="pr6-title-area wow fadeInUp">
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
					<div class="col-lg-5 align-self-end wow fadeInRight">
                        <?php if(!empty($settings['button_text'])) : ?>
                        <div class="pr6-primary-btn">
                            <span class="pr6-ld-arrow"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/team/arrow.png" alt="img"></span>
                            <a href="<?php echo esc_html($settings['button_link']['url']); ?>"> <?php echo esc_html($settings['button_text']); ?> <i class="fas fa-arrow-right"></i></a>
                        </div>
                        <?php endif; ?>
					</div>
				</div>
				<div class="pr6-team-members">
					<div class="row">
                        <?php foreach ( $settings['slides'] as $slide ) :
                            $title = elh_element_kses_basic( $slide['title' ] );

                            if (!empty($slide['image']['id'])) {
                                $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                                if ( ! $image ) {
                                    $image = !empty($slide['image']['url']) ? $slide['image']['url'] : '' ;
                                }
                            }
                        ?>
						<div class="col-lg-3 col-sm-6">
							<div class="pr6-team-column wow fadeInUp">
								<div class="pr6-ld-member">
									<div class="pr6-img-wrapper">
										<span class="pr6-ld-img-circle"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/team/circle.png" alt="img"></span>
										<div class="client-thumb">

                                            <?php if(!empty( $image )) : ?>
											<img src="<?php echo esc_url($image) ?>" alt="img">
                                            <?php endif; ?>

										</div>
									</div>
									<div class="pr6-team-content">
                                        <?php if( !empty($slide['title'])) : ?>
										<div class="pr6-headline">
											<a href="<?php echo esc_url($slide['slide_url' ]); ?>"><h4><?php echo elh_element_kses_basic( $slide['title'] ); ?></h4></a>
										</div>
                                        <?php endif; ?>

                                        <?php if( !empty($slide['designation'])) : ?>
										<div class="pr6-designation">
											<span><?php echo elh_element_kses_basic( $slide['designation'] ); ?></span>
										</div>
                                        <?php endif; ?>
                                        <?php if( !empty($slide['show_social'] ) ) : ?>
										<div class="pr6-team-socials">
                                            <?php if( !empty($slide['web_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $slide['web_title'] ); ?>"><i class="far fa-globe"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['email_title'] ) ) : ?>
                                            <a href="mailto:<?php echo esc_url( $slide['email_title'] ); ?>"><i class="fal fa-envelope"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['phone_title'] ) ) : ?>
                                            <a href="tell:<?php echo esc_url( $slide['phone_title'] ); ?>"><i class="fas fa-phone"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['facebook_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $slide['facebook_title'] ); ?>"><i class="fab fa-facebook-f"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['twitter_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $slide['twitter_title'] ); ?>"><i class="fab fa-twitter"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['instagram_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $slide['instagram_title'] ); ?>"><i class="fab fa-instagram"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['linkedin_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $slide['linkedin_title'] ); ?>"><i class="fab fa-linkedin-in"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['youtube_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $slide['youtube_title'] ); ?>"><i class="fab fa-youtube"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['googleplus_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $slide['googleplus_title'] ); ?>"><i class="fab fa-google-plus-g"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['flickr_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $slide['flickr_title'] ); ?>"><i class="fab fa-flickr"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['vimeo_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $slide['vimeo_title'] ); ?>"><i class="fab fa-vimeo-v"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['behance_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $slide['behance_title'] ); ?>"><i class="fab fa-behance"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['dribble_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $slide['dribble_title'] ); ?>"><i class="fab fa-dribbble"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['pinterest_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $slide['pinterest_title'] ); ?>"><i class="fab fa-pinterest-p"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['gitub_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $slide['gitub_title'] ); ?>"><i class="fab fa-github"></i></a>
                                            <?php endif; ?>
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
		</section>

    <!-- style 2 -->
    <?php elseif ( $settings['design_style'] === 'style_2' ): ?>
    <section class="team_area pt-120 pb-90">
        <div class="container">
            <div class="row justify-content-md-center">
                <?php foreach ( $settings['slides'] as $slide ) :

                    if (!empty($slide['image']['id'])) {
                        $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                        if ( ! $image ) {
                            $image = !empty($slide['image']['url']) ? $slide['image']['url'] : '' ;
                        }
                    }
                ?>
                <div class="col-lg-4 col-md-6">
                    <div class="team_single text-center">
                        <?php if(!empty( $image )) : ?>
                        <div class="team_thumb">
                            <img src="<?php echo esc_url($image) ?>" alt="img">
                        </div>
                        <?php endif; ?>
                        <div class="team_text">

                            <?php if(!empty( $slide['title'] )) : ?>
                            <h3><?php echo elh_element_kses_basic( $slide['title'] ); ?></h3>
                            <?php endif; ?>

                            <?php if(!empty( $slide['designation'] )) : ?>
                            <span><?php echo elh_element_kses_basic( $slide['designation'] ); ?></span>
                            <?php endif; ?>

                        </div>

                        <?php if( !empty($slide['show_social'] ) ) : ?>
						<div class="team_social">
                            <?php if( !empty($slide['web_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['web_title'] ); ?>"><i class="far fa-globe"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['email_title'] ) ) : ?>
                            <a href="mailto:<?php echo esc_url( $slide['email_title'] ); ?>"><i class="fal fa-envelope"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['phone_title'] ) ) : ?>
                            <a href="tell:<?php echo esc_url( $slide['phone_title'] ); ?>"><i class="fas fa-phone"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['facebook_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['facebook_title'] ); ?>"><i class="fab fa-facebook-f"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['twitter_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['twitter_title'] ); ?>"><i class="fab fa-twitter"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['instagram_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['instagram_title'] ); ?>"><i class="fab fa-instagram"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['linkedin_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['linkedin_title'] ); ?>"><i class="fab fa-linkedin-in"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['youtube_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['youtube_title'] ); ?>"><i class="fab fa-youtube"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['googleplus_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['googleplus_title'] ); ?>"><i class="fab fa-google-plus-g"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['flickr_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['flickr_title'] ); ?>"><i class="fab fa-flickr"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['vimeo_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['vimeo_title'] ); ?>"><i class="fab fa-vimeo-v"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['behance_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['behance_title'] ); ?>"><i class="fab fa-behance"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['dribble_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['dribble_title'] ); ?>"><i class="fab fa-dribbble"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['pinterest_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['pinterest_title'] ); ?>"><i class="fab fa-pinterest-p"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['gitub_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['gitub_title'] ); ?>"><i class="fab fa-github"></i></a>
                            <?php endif; ?>
						</div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php else : ?>

    <section class="team_area pb-90">
        <div class="container">
            <div class="row align-items-center mb-30">
                <div class="col-md-8">
                    <div class="sec_title">
                        <?php if(!empty( $settings['sub_title'] )) : ?>
                        <span><?php echo elh_element_kses_intermediate($settings['sub_title']); ?></span>
                        <?php endif; ?>

                        <?php if(!empty( $settings['title'] )) : ?>
                        <h2><?php echo elh_element_kses_intermediate($settings['title']); ?></h2>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if(!empty( $settings['button_link']['url'] )) : ?>
                <div class="col-md-4">
                    <div class="crs_btn text-md-end">
                        <a class="thm_btn" href="<?php echo esc_url($settings['button_link']['url']); ?>"><?php echo esc_html($settings['button_text']); ?></a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div class="row justify-content-md-center">
                <?php foreach ( $settings['slides'] as $slide ) :

                    if (!empty($slide['image']['id'])) {
                        $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                        if ( ! $image ) {
                            $image = !empty($slide['image']['url']) ? $slide['image']['url'] : '' ;
                        }
                    }
                ?>
                <div class="col-lg-4 col-md-6">
                    <div class="team_single text-center">
                        <?php if(!empty( $image )) : ?>
                        <div class="team_thumb">
                            <img src="<?php echo esc_url($image) ?>" alt="img">
                        </div>
                        <?php endif; ?>
                        <div class="team_text">

                            <?php if(!empty( $slide['title'] )) : ?>
                            <h3><?php echo elh_element_kses_basic( $slide['title'] ); ?></h3>
                            <?php endif; ?>

                            <?php if(!empty( $slide['designation'] )) : ?>
                            <span><?php echo elh_element_kses_basic( $slide['designation'] ); ?></span>
                            <?php endif; ?>

                        </div>

                        <?php if( !empty($slide['show_social'] ) ) : ?>
						<div class="team_social">
                            <?php if( !empty($slide['web_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['web_title'] ); ?>"><i class="far fa-globe"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['email_title'] ) ) : ?>
                            <a href="mailto:<?php echo esc_url( $slide['email_title'] ); ?>"><i class="fal fa-envelope"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['phone_title'] ) ) : ?>
                            <a href="tell:<?php echo esc_url( $slide['phone_title'] ); ?>"><i class="fas fa-phone"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['facebook_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['facebook_title'] ); ?>"><i class="fab fa-facebook-f"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['twitter_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['twitter_title'] ); ?>"><i class="fab fa-twitter"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['instagram_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['instagram_title'] ); ?>"><i class="fab fa-instagram"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['linkedin_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['linkedin_title'] ); ?>"><i class="fab fa-linkedin-in"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['youtube_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['youtube_title'] ); ?>"><i class="fab fa-youtube"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['googleplus_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['googleplus_title'] ); ?>"><i class="fab fa-google-plus-g"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['flickr_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['flickr_title'] ); ?>"><i class="fab fa-flickr"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['vimeo_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['vimeo_title'] ); ?>"><i class="fab fa-vimeo-v"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['behance_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['behance_title'] ); ?>"><i class="fab fa-behance"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['dribble_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['dribble_title'] ); ?>"><i class="fab fa-dribbble"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['pinterest_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['pinterest_title'] ); ?>"><i class="fab fa-pinterest-p"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['gitub_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['gitub_title'] ); ?>"><i class="fab fa-github"></i></a>
                            <?php endif; ?>
						</div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

        <?php
    }
}
