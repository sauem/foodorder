<?php
namespace ElementHelper\Widget;


use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Control_Media;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || die();

class About_Details extends Element_El_Widget {

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
        return 'about_details';
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
        return __( 'About Details', 'elementhelper' );
    }

    public function get_custom_help_url() {
        return 'http://elementor.sabber.com/widgets/icon-box/';
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
        return 'elh-widget-icon eicon-preview-medium';
    }

    public function get_keywords() {
        return [ 'about', 'details', ];
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
            '_section_title',
            [
                'label' => __('Title & Description', 'elementhelper'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'elementhelper'),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Title', 'elementhelper'),
                'placeholder' => __('Type Title', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'elementhelper'),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque, dignissimos. Recusandae nisi blanditiis cum ea cupiditate iste tenetur. Explicabo, eligendi ad? Vero at explicabo perferendis ipsum corrupti ex amet nobis!', 'elementhelper'),
                'placeholder' => __('Type Description', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'title2',
            [
                'label' => __('Title', 'elementhelper'),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Title', 'elementhelper'),
                'placeholder' => __('Type Title', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'description2',
            [
                'label' => __('Description', 'elementhelper'),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque, dignissimos. Recusandae nisi blanditiis cum ea cupiditate iste tenetur. Explicabo, eligendi ad? Vero at explicabo perferendis ipsum corrupti ex amet nobis!', 'elementhelper'),
                'placeholder' => __('Type Description', 'elementhelper'),
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
                    '{{WRAPPER}} .about-area-section .about-text h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .about-area-section .about-text h3
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
                    '{{WRAPPER}} .about-area-section .about-text p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .about-area-section .about-text p
                    ',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );


        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend.
     *
     * Used to generate the final HTML displayed on the frontend.
     *
     * Note that if skin is selected, it will be rendered by the skin itself,
     * not the widget.
     *
     * @since 1.0.0
     * @access public
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        ?>

    <?php if ( $settings['design_style'] === 'style_2' ): ?>

    <?php else: ?>

        <section class="about-area-section">
            <div class="container">
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="about-text clearfix">
                            <div class="grid left-grid">

                                <?php if(!empty( $settings['title'] )) : ?>
                                <h3><?php echo elh_element_kses_basic( $settings['title'] ); ?></h3>
                                <?php endif; ?>

                                <?php if(!empty( $settings['description'] )) : ?>
                                <p><?php echo elh_element_kses_basic( $settings['description'] ); ?></p>
                                <?php endif; ?>

                            </div>
                            <div class="grid right-grid">

                                <?php if(!empty( $settings['title2'] )) : ?>
                                <h3><?php echo elh_element_kses_basic( $settings['title2'] ); ?></h3>
                                <?php endif; ?>

                                <?php if(!empty( $settings['description2'] )) : ?>
                                <p><?php echo elh_element_kses_basic( $settings['description2'] ); ?></p>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>

        <?php endif; ?>

        <?php
    }

}
