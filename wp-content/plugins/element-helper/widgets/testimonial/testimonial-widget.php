<?php
namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Control_Media;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Testimonial extends Element_El_Widget {

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
        return 'testimonial';
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
        return __( 'Testimonial', 'elementhelper' );
    }

	public function get_custom_help_url() {
		return 'http://elementor.sabber.com/widgets/testimonial/';
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
        return 'elh-widget-icon eicon-blockquote';
    }

    public function get_keywords() {
        return [ 'testimonial', 'review', 'feedback' ];
    }

	protected function register_content_controls() {
        $this->start_controls_section(
            '_section_testimonial',
            [
                'label' => __( 'Testimonial', 'elementhelper' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'testimonial',
            [
                'label' => __( 'Testimonial', 'elementhelper' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Testimonial contents', 'elementhelper' ),
                'placeholder' => __( 'Type testimonial', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'align',
            [
                'label' => __( 'Alignment', 'elementhelper' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'elementhelper' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'elementhelper' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'elementhelper' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'toggle' => false,
                'default' => 'left',
                'prefix_class' => 'elh-testimonial--'
            ]
        );

        $this->add_control(
            '_design',
            [
                'label' => __( 'Design', 'elementhelper' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    'basic' => __( 'Default', 'elementhelper' ),
                    'bubble' => __( 'Bubble', 'elementhelper' ),
                ],
                'default' => 'basic',
                'prefix_class' => 'elh-testimonial--',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_reviewer',
            [
                'label' => __( 'Reviewer', 'elementhelper' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

		$this->add_control(
            'image',
            [
                'label' => __( 'Image', 'elementhelper' ),
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
				'default' => 'full',
				'exclude' => ['custom'],
                'separator' => 'none',
            ]
		);

        $this->add_control(
            'name',
            [
                'label' => __( 'Name', 'elementhelper' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __( 'elh', 'elementhelper' ),
                'placeholder' => __( 'Type Reviewer Name', 'elementhelper' ),
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
                'default' => __( 'CMO, ElementHelper', 'elementhelper' ),
                'placeholder' => __( 'Type reviewer title', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

		$this->end_controls_section();
    }

    protected function register_style_controls() {
        $this->start_controls_section(
            '_section_style_testimonial',
            [
                'label' => __( 'Testimonial', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'testimonial_padding',
            [
                'label' => __( 'Padding', 'elementhelper' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elh-testimonial__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_spacing',
            [
                'label' => __( 'Bottom Spacing', 'elementhelper' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .elh-testimonial__content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'testimonial_color',
            [
                'label' => __( 'Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elh-testimonial__content' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'testimonial_bg_color',
            [
                'label' => __( 'Background Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elh-testimonial__content' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .elh-testimonial__content:after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'testimonial_typography',
                'label' => __( 'Typography', 'elementhelper' ),
                'selector' => '{{WRAPPER}} .elh-testimonial__content',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_responsive_control(
            'testimonial_border_radius',
            [
                'label' => __( 'Border Radius', 'elementhelper' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elh-testimonial__content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'testimonial_box_shadow',
                'selector' => '{{WRAPPER}} .elh-testimonial__content',
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
            '_section_style_image',
            [
                'label' => __( 'Image', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
		);

		$this->add_responsive_control(
            'image_width',
            [
                'label' => __( 'Width', 'elementhelper' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 65,
                        'max' => 200,
                    ],
				],
                'selectors' => [
                    '{{WRAPPER}} .elh-testimonial__reviewer-thumb' => '-webkit-flex: 0 0 {{SIZE}}{{UNIT}}; -ms-flex: 0 0 {{SIZE}}{{UNIT}}; flex: 0 0 {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.elh-testimonial--left .elh-testimonial__reviewer-meta' => '-webkit-flex: 0 0 calc(100% - {{SIZE}}{{UNIT}}); -ms-flex: 0 0 calc(100% - {{SIZE}}{{UNIT}}); flex: 0 0 calc(100% - {{SIZE}}{{UNIT}}); max-width: calc(100% - {{SIZE}}{{UNIT}});',
                    '{{WRAPPER}}.elh-testimonial--right .elh-testimonial__reviewer-meta' => '-webkit-flex: 0 0 calc(100% - {{SIZE}}{{UNIT}}); -ms-flex: 0 0 calc(100% - {{SIZE}}{{UNIT}}); flex: 0 0 calc(100% - {{SIZE}}{{UNIT}}); max-width: calc(100% - {{SIZE}}{{UNIT}});',
                    '{{WRAPPER}}.elh-testimonial--left .elh-testimonial__content:after' => 'left: calc(({{SIZE}}{{UNIT}} / 2) - 18px);',
                    '{{WRAPPER}}.elh-testimonial--right .elh-testimonial__content:after' => 'right: calc(({{SIZE}}{{UNIT}} / 2) - 18px);',
                ],
            ]
        );

		$this->add_responsive_control(
            'image_height',
            [
                'label' => __( 'Height', 'elementhelper' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 200,
                    ],
				],
                'selectors' => [
                    '{{WRAPPER}} .elh-testimonial__reviewer-thumb' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_spacing',
            [
                'label' => __( 'Spacing', 'elementhelper' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}}.elh-testimonial--left .elh-testimonial__reviewer-meta' => 'padding-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.elh-testimonial--right .elh-testimonial__reviewer-meta' => 'padding-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.elh-testimonial--center .elh-testimonial__reviewer-meta' => 'padding-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .elh-testimonial__reviewer-thumb img',
            ]
		);

		$this->add_responsive_control(
            'image_border_radius',
            [
                'label' => __( 'Border Radius', 'elementhelper' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elh-testimonial__reviewer-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_box_shadow',
                'selector' => '.elh-testimonial__reviewer-thumb img',
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
            '_section_style_reviewer',
            [
                'label' => __( 'Reviewer', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
		);

        $this->add_control(
            '_heading_name',
            [
                'label' => __( 'Name', 'elementhelper' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

		$this->add_control(
            'name_color',
            [
                'label' => __( 'Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elh-testimonial__reviewer-name' => 'color: {{VALUE}};',
                ],
            ]
        );

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'label' => __( 'Typography', 'elementhelper' ),
				'selector' => '{{WRAPPER}} .elh-testimonial__reviewer-name',
				'scheme' => Typography::TYPOGRAPHY_2,
            ]
		);

		$this->add_responsive_control(
            'name_spacing',
            [
                'label' => __( 'Bottom Spacing', 'elementhelper' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .elh-testimonial__reviewer-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_heading_title',
            [
                'label' => __( 'Title', 'elementhelper' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elh-testimonial__reviewer-title' => 'color: {{VALUE}}',
                ],
            ]
		);

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __( 'Typography', 'elementhelper' ),
				'selector' => '{{WRAPPER}} .elh-testimonial__reviewer-title',
				'scheme' => Typography::TYPOGRAPHY_3,
            ]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'testimonial', 'intermediate' );
		$this->add_render_attribute( 'testimonial', 'class', 'elh-testimonial__content' );

		$this->add_inline_editing_attributes( 'name', 'basic' );
		$this->add_render_attribute( 'name', 'class', 'elh-testimonial__reviewer-name' );

		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_render_attribute( 'title', 'class', 'elh-testimonial__reviewer-title' );
		?>

		<div <?php $this->print_render_attribute_string( 'testimonial' ); ?>>
			<?php echo elh_element_kses_intermediate( $settings['testimonial'] ); ?>
		</div>
		<div class="elh-testimonial__reviewer">
            <?php if ( ! empty( $settings['image']['url'] ) ) : ?>
                <div class="elh-testimonial__reviewer-thumb">
                    <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
                </div>
            <?php endif; ?>

			<div class="elh-testimonial__reviewer-meta">
				<div <?php $this->print_render_attribute_string( 'name' ); ?>><?php echo elh_element_kses_basic( $settings['name'] ); ?></div>
				<div <?php $this->print_render_attribute_string( 'title' ); ?>><?php echo elh_element_kses_basic( $settings['title'] ); ?></div>
			</div>
		</div>
	    <?php
	}
}
