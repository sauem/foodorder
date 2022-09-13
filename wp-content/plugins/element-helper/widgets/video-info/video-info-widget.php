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
use \Elementor\Icons_Manager;

defined( 'ABSPATH' ) || die();

class Video_Info extends Element_El_Widget {

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
        return 'video_info';
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
        return __( 'Video Info', 'elementhelper' );
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
        return 'elh-widget-icon eicon-video-camera';
    }

    public function get_keywords() {
        return [ 'info', 'video', 'box', 'text', 'content' ];
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
                    'style_2' => __('Style 2: About Page', 'elementhelper'),
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
                'label' => __( 'Video Section', 'elementhelper' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'label' => __( 'Video Bg Image', 'elementhelper' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'video_url',
            [
                'label'       => __( 'Link', 'elementhelper' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'https://www.youtube.com/watch?v=cRXm1p-CNyk', 'elementhelper' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'default' => [
					'url' => 'https://www.youtube.com/watch?v=cRXm1p-CNyk',
					'is_external' => true,
					'nofollow' => true,
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

    }

    /**
     * Register styles related controls
     */
    protected function register_style_controls() {

        $this->start_controls_section(
            '_section_media_style',
            [
                'label' => __( 'Icon Style', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_bg_color',
            [
                'label' => __( 'Icon Bg', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-area-section .video-btn' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style'=> ['style_2']
                ]
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Icon color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cta-section-s2 svg path' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .about-area-section .video-btn svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_border_color',
            [
                'label' => __( 'Border color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cta-section-s2 circle' => 'stroke: {{VALUE}}',
                ],
                'condition' => [
                    'design_style'=> ['style_1']
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __( 'Icon Size', 'elementhelper' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .cta-section-s2 svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .about-area-section .video-btn' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        ?>



        <?php if ( $settings['design_style'] === 'style_2'):

            if (!empty($settings['bg_image']['id'])) {
                $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['thumbnail_size']);
            }
        ?>
        <div class="about-area-section">
           <div class="container">
               <div class="row">
                   <div class="col-xl-12">
                   <div class="about-area">
                        <div class="video-area">
                            <?php if(!empty( $bg_image )) : ?>
                            <div class="img-holder">
                                <img src="<?php echo esc_url($bg_image); ?>" alt>
                            </div>
                            <?php endif; ?>

                            <?php if(!empty( $settings['video_url']['url'] )) : ?>
                            <a href="<?php echo esc_url( $settings['video_url']['url'] ); ?>" class="video-btn video-btn-s1" data-type="iframe" tabindex="0">
                                <svg width="58" height="74" viewBox="0 0 58 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 1L57 37L1 73V1Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                            <?php endif; ?>

                        </div>
                    </div>
                   </div>
               </div>
           </div>
        </div>
        <?php else:

            $bg_image = wp_get_attachment_image_url( $settings['bg_image']['id'], $settings['thumbnail_size'] );
            if ( $bg_image ) {
                $bg_url = ' style="';
                $bg_url .= ( $bg_image ) ? 'background-image: url( '. esc_url( $bg_image ) .' );' : '';
                $bg_url .= '"';
            } else {
                $bg_url = '';
            }
        ?>

        <!-- start cta-section-s2 -->
        <section class="cta-section-s2" <?php echo $bg_url; ?>>
            <div class="container">
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="cta-content">
                            <?php if(!empty( $settings['video_url']['url'] )) : ?>
                            <a href="<?php echo esc_url( $settings['video_url']['url'] ); ?>" class="video-btn video-btn-s1" data-type="iframe" tabindex="0">
                                <svg viewBox="0 0 159 159" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="79.5" cy="79.5" r="79" stroke="white"/>
                                    <path d="M96.9266 78.1343L68.8841 61.4425C68.5567 61.2477 68.1836 61.1431 67.8027 61.1393C67.4218 61.1355 67.0467 61.2326 66.7156 61.4209C66.3844 61.6092 66.109 61.8818 65.9175 62.2111C65.7259 62.5403 65.625 62.9144 65.625 63.2954V96.0113C65.6254 96.3888 65.7249 96.7596 65.9135 97.0866C66.1021 97.4136 66.3732 97.6855 66.6997 97.875C67.0262 98.0645 67.3967 98.165 67.7742 98.1665C68.1517 98.168 68.523 98.0704 68.851 97.8835L96.8933 81.8596C97.2205 81.6726 97.493 81.4031 97.6836 81.078C97.8742 80.7529 97.9763 80.3834 97.9796 80.0066C97.983 79.6297 97.8875 79.2585 97.7027 78.9301C97.5178 78.6016 97.2502 78.3274 96.9263 78.1346L96.9266 78.1343ZM68.5 94.7728V64.5597L94.3969 79.9745L68.5 94.7728Z" fill="white"/>
                                </svg>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div> <!-- end container-1410 -->
        </section>
        <!-- end cta-section-s2 -->
        <?php
            endif;
    }
}
