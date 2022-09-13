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

class Brand extends Element_El_Widget {


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
        return 'brand';
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
        return __( 'Brand', 'elementhelper' );
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
        return 'elh-widget-icon eicon-photo-library';
    }

    public function get_keywords() {
        return [ 'brand', 'image', 'counter' ];
    }

    public function get_script_depends() {
		return ['elh_partner_slider'];
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


        $this->start_controls_section(
            '_section_slides',
            [
                'label' => __( 'Brand Item', 'elementhelper' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

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
                'condition' => [
                    'design_style' => ['style_3']
                ],
            ]
        );

        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__( 'Brand Item', 'elh-elementor' ),
                'default' => [
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
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
            '_section_settings',
            [
                'label' => __( 'Settings', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'animation_speed',
            [
                'label' => __( 'Animation Speed', 'elementhelper' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 100,
                'step' => 10,
                'max' => 10000,
                'default' => 300,
                'description' => __( 'Slide speed in milliseconds', 'elementhelper' ),
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __( 'Autoplay?', 'elementhelper' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'elementhelper' ),
                'label_off' => __( 'No', 'elementhelper' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => __( 'Autoplay Speed', 'elementhelper' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 100,
                'step' => 100,
                'max' => 10000,
                'default' => 3000,
                'description' => __( 'Autoplay speed in milliseconds', 'elementhelper' ),
                'condition' => [
                    'autoplay' => 'yes'
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __( 'Infinite Loop?', 'elementhelper' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'elementhelper' ),
                'label_off' => __( 'No', 'elementhelper' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'vertical',
            [
                'label' => __( 'Vertical Mode?', 'elementhelper' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'elementhelper' ),
                'label_off' => __( 'No', 'elementhelper' ),
                'return_value' => 'yes',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'navigation',
            [
                'label' => __( 'Navigation', 'elementhelper' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => __( 'None', 'elementhelper' ),
                    'arrow' => __( 'Arrow', 'elementhelper' ),
                    'dots' => __( 'Dots', 'elementhelper' ),
                    'both' => __( 'Arrow & Dots', 'elementhelper' ),
                ],
                'default' => 'arrow',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();


    }

    protected function register_style_controls() {

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( $settings['design_style'] === 'style_4' ): ?>

    <section id="nio-eig-partner" class="nio-eig-partner-section">
		<div class="container">
			<div class="nio-eig-partner-content">
				<div id="nio-eig-partner-slide-id" class="nio-eig-partner-slide">
                    <?php foreach ( $settings['slides'] as $key => $slide ) :
                        $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                        if ( ! $image ) {
                            $image = $slide['image']['url'];
                        }
                    ?>
					<div class="nio-eig-partner-img">
						<img src="<?php print esc_url($image); ?>" alt="img">
					</div>
                    <?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

        <?php  elseif ( $settings['design_style'] === 'style_3' ): ?>
        <div class="pr6-brand-slider-area">
			<div class="container">
				<div class="pr6-brand-slider">
                    <?php foreach ( $settings['slides'] as $key => $slide ) :
                        $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                        if ( ! $image ) {
                            $image = $slide['image']['url'];
                        }
                    ?>
					<div class="pr6-brand-item">
						<img src="<?php print esc_url($image); ?>" alt="img">
					</div>
                    <?php endforeach; ?>
				</div>
			</div>
		</div>

        <?php elseif ( $settings['design_style'] === 'style_2' ): ?>
        <div id="app-td-partner" class="app-taeled-partner-section">
            <div class="container">
                <div id="partner-slideid" class="partner-slider owl-carousel">
                    <?php foreach ( $settings['slides'] as $key => $slide ) :
                        $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                        if ( ! $image ) {
                            $image = $slide['image']['url'];
                        }
                    ?>
					<div class="partner-img">
						<a href="<?php echo esc_url( $slide['slide_url']['url'] ); ?>">
                            <img src="<?php print esc_url($image); ?>" alt="img">
                        </a>
					</div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php else: ?>

        <section class="brand_area white_bg">
            <div class="container-fluid">
                <div class="row g-0 justify-content-center">
                    <?php foreach ( $settings['slides'] as $key => $slide ) :
                        $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                        if ( ! $image ) {
                            $image = $slide['image']['url'];
                        }
                    ?>
                    <div class="col-lg-2 col-md-3 col-sm-6 b_border">
                        <?php if(!empty( $image )) : ?>
                        <div class="brand_img">
                            <img src="<?php print esc_url($image); ?>" alt="img">
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>


        <?php endif; ?>

        <?php
    }
}
