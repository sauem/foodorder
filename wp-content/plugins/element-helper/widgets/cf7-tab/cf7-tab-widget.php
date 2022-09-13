<?php
namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Repeater;

defined( 'ABSPATH' ) || die();

class Cf7_Tab extends Element_El_Widget {

    
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
        return 'cf7_tab';
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
        return __( 'Contact Form 7 TAB', 'elementhelper' );
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
        return 'elh-widget-icon eicon-shortcode';
    }

    public function get_keywords() {
        return [ 'form', 'contact', 'cf7', 'contact form', 'gravity', 'ninja' ];
    }

	protected function register_content_controls() {
		$this->start_controls_section(
			'_section_cf7',
			[
				'label' => elh_element_is_cf7_activated() ? __( 'Contact Form 7', 'elementhelper' ) : __( 'Missing Notice', 'elementhelper' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        if ( ! elh_element_is_cf7_activated() ) {
            $this->add_control(
                '_cf7_missing_notice',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => sprintf(
                        __( 'Hello %2$s, looks like %1$s is missing in your site. Please click on the link below and install/activate %1$s. Make sure to refresh this page after installation or activation.', 'elementhelper' ),
                        '<a href="'.esc_url( admin_url( 'plugin-install.php?s=Contact+Form+7&tab=search&type=term' ) )
                        .'" target="_blank" rel="noopener">Contact Form 7</a>',
                        elh_element_get_current_user_display_name()
                    ),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-danger',
                ]
            );

            $this->add_control(
                '_cf7_install',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => '<a href="'.esc_url( admin_url( 'plugin-install.php?s=Contact+Form+7&tab=search&type=term' ) ).'" target="_blank" rel="noopener">Click to install or activate Contact Form 7</a>',
                ]
            );
            $this->end_controls_section();
            return;
        }

        $repeater = new Repeater();

        $repeater->add_control(
            'form_id',
            [
                'label' => __( 'Select Your Form', 'elementhelper' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => ['' => __( '', 'elementhelper' ) ] + \elh_element_get_cf7_forms(),
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Tab Title', 'elementhelper' ),
                'placeholder' => __( 'Type tab title here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'sub_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Sub title', 'elementhelper' ),
                'placeholder' => __( 'Type sub-title here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'heading_title',
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

        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
            ]
        );

        

        $this->add_control(
            'html_class',
            [
                'label' => __( 'HTML Class', 'elementhelper' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'description' => __( 'Add CSS custom class to the form.', 'elementhelper' ),
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
            '_heading_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __('Title', 'elementhelper'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => __('Bottom Spacing', 'elementhelper'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .contact-form-wrapper .section-title h2' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Text Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-form-wrapper .section-title h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .contact-form-wrapper .section-title h2',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_control(
            '_heading_subtitle',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __('Subtitle', 'elementhelper'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => __('Bottom Spacing', 'elementhelper'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .contact-form-wrapper .section-title span' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __('Text Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-form-wrapper .section-title span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .contact-form-wrapper .section-title span',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        if ( ! elh_element_is_cf7_activated() ) {
            return;
        }

    $settings = $this->get_settings_for_display(); ?>

    <section class="contact-area contact-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="contact-main">
                        <div class="contact-tab">
                            <?php if(!empty($settings['slides'])) : ?>
                            <ul class="nav" id="myTab" role="tablist">
                                <?php foreach ( $settings['slides'] as $id => $slide ) : 
                                $active_tab = ($id == 0) ? 'active show' : ''; ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo esc_attr($active_tab); ?>" id="nav-tab-<?php echo esc_attr($id); ?>" data-toggle="tab" href="#nav-<?php echo esc_attr($id); ?>" role="tab" aria-controls="nav-<?php echo esc_attr($id); ?>" aria-selected="true"><?php echo esc_html($slide['title']); ?></a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                            <?php endif; ?>
                        </div>
                        <div class="tab-content tab-border" id="myTabContent">
                            <?php foreach ( $settings['slides'] as $id => $slide ) : 
                            $active_tab = ($id == 0) ? 'active show' : ''; ?>
                            <div class="tab-pane fade <?php echo esc_attr($active_tab); ?>" id="nav-<?php echo esc_attr($id); ?>" role="tabpanel" aria-labelledby="nav-tab-<?php echo esc_attr($id); ?>">
                                <div class="contact-form-wrapper">
                                    <div class="section-title">
                                        <?php if(!empty($slide['sub_title'])) : ?>
                                        <span><?php echo esc_html($slide['sub_title']); ?></span>
                                        <?php endif; ?>
                                        <?php if(!empty($slide['heading_title'])) : ?>
                                        <h2><?php echo esc_html($slide['heading_title']); ?></h2>
                                        <?php endif; ?>
                                    </div>
                                    <div class="contact-form">
                                        <?php if ( ! empty( $slide['form_id'] ) ) {
                                            echo elh_element_do_shortcode( 'contact-form-7', [
                                                'id' => $slide['form_id'],
                                                'html_class' => 'elh-cf7-form ' . elh_element_sanitize_html_class_param( $settings['html_class'] ),
                                            ] );
                                        } ?> 
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

        <?php

    }
}