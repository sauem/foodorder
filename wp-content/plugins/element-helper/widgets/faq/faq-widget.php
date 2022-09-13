<?php

namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Repeater;
use \Elementor\Utils;

defined('ABSPATH') || die();

class FAQ extends Element_El_Widget
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
        return 'faq';
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
        return __('FAQ', 'elementhelper');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.sabber.com/widgets/contact-7-form/';
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
        return 'elh-widget-icon eicon-edit';
    }

    public function get_keywords()
    {
        return ['services', 'tab'];
    }

    protected function register_content_controls(){

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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_image',
            [
                'label' => __('Image', 'elementhelper'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1', 'style_2'],
                ],
            ]
        );

        $this->add_control(
            'faq_image',
            [
                'label' => __('Image', 'elementhelper'),
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
                'label' => __('Faq List', 'elementhelper'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'field_condition',
            [
                'label' => __( 'Field condition', 'elementhelper' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'elementhelper' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tab_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Tab Title', 'elementhelper'),
                'default' => __('Tab Title', 'elementhelper'),
                'placeholder' => __('Type title here', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'tab_content_image',
            [
                'label' => __('Image', 'elementhelper'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => 'style_2'
                ],
            ]
        );

        $repeater->add_control(
            'tab_content_info',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'show_label' => false,
                'default' => __('Content Here', 'elementhelper'),
                'placeholder' => __('Type subtitle here', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        // REPEATER
        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(tab_title || "Carousel Item"); #>',
            ]
        );

        $this->end_controls_section();

    }

    // register_style_controls
    protected function register_style_controls(){

        $this->start_controls_section(
            '_section_style_history',
            [
                'label' => __( 'Faq', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq_wrapper .accordion-box .block .acc-btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .faq_wrapper .accordion-box .block .acc-btn',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Description Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq_wrapper .accordion-box .block .acc-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .faq_wrapper .accordion-box .block .acc-content p',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('title', 'class', '');
        $title = elh_element_kses_basic($settings['title']);

        // img
        if (!empty($settings['faq_image']['id'])) {
            $faq_image = wp_get_attachment_image_url(!empty($settings['faq_image']['id']), !empty($settings['faq_image']));
            if (!$faq_image) {
                $faq_image = $settings['faq_image']['url'];
            }
        }

        if (empty($settings['slides'])) {
            return;
        }
        if ($settings['design_style'] === 'style_3'): ?>

    <div class="faq-3">
        <div class="faq-left-wrapper mb-40">
            <ul class="accordion-box clearfix">
                <?php foreach ($settings['slides'] as $id => $slide) :
                    // active class
                    $collapsed_tab = ($id == 0) ? 'active-block' : '';
                    $area_expanded = ($id == 0) ? 'true' : 'false';
                    $active_show_tab = ($id == 0) ? 'current' : '';
                    $tab_content_image = wp_get_attachment_image_url( !empty($slide['tab_content_image']['id']), !empty($slide['tab_image_size']) );
                    if ( ! $tab_content_image ) {
                        $tab_content_image = $slide['tab_content_image']['url'];
                    }
                ?>
                <li class="accordion block <?php echo esc_attr($collapsed_tab); ?>">
                    <div class="acc-btn">
                        <?php echo elh_element_kses_basic($slide['tab_title']); ?>
                    </div>
                    <div class="acc-content <?php echo esc_attr($active_show_tab); ?>">
                        <div class="content">
                            <?php if(!empty($slide['tab_content_image'])) : ?>
                            <div class="acc-thumb">
                                <img src="<?php echo $tab_content_image; ?>" alt="img">
                            </div>
                            <?php endif; ?>
                            <div class="acc-text">
                                <p><?php echo elh_element_kses_basic($slide['tab_content_info']); ?></p>
                            </div>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <?php elseif ($settings['design_style'] === 'style_2'): ?>
    <section class="faq-area faq-2">
        <div class="container-fluid">
            <div class="row no-gutters flex-row-reverse">
                <div class="col-lg-6">
                    <div class="faq-bg">
                        <img src="<?php echo esc_url($faq_image); ?>" alt="img">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="faq-content pt-120 pb-120">
                        <div class="section-title">
                            <?php if (!empty($settings['sub_title'])): ?>
                            <span><?php echo elh_element_kses_intermediate($settings['sub_title']); ?></span>
                            <?php endif; ?>
                            <?php printf('<%1$s %2$s>%3$s</%1$s>',
                                tag_escape($settings['title_tag']),
                                $this->get_render_attribute_string('title'),
                                $title
                            ); ?>
                        </div>
                        <div class="faq-block">
                            <ul class="accordion-box clearfix">
                                <?php foreach ($settings['slides'] as $id => $slide) :
                                    // active class
                                    $collapsed_tab = ($id == 0) ? 'active-block' : '';
                                    $area_expanded = ($id == 0) ? 'true' : 'false';
                                    $active_show_tab = ($id == 0) ? 'current' : '';
                                ?>
                                <li class="accordion block <?php echo esc_attr($collapsed_tab); ?>">
                                    <div class="acc-btn">
                                        <?php echo elh_element_kses_basic($slide['tab_title']); ?>
                                    </div>
                                    <div class="acc-content <?php echo esc_attr($active_show_tab); ?>">
                                        <div class="content">
                                            <div class="text">
                                                <?php echo elh_element_kses_basic($slide['tab_content_info']); ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php else: ?>

    <section class="faq_area pt-120 pb-120">
        <div class="container">
            <div class="faq_bg">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="faq_wrapper mb-30">
                            <ul class="accordion-box clearfix">
                            <?php foreach ($settings['slides'] as $id => $slide) :
                                    // active class
                                    $collapsed_tab = ($id == 0) ? 'active-block' : '';
                                    $area_expanded = ($id == 0) ? 'true' : 'false';
                                    $active_show_tab = ($id == 0) ? 'current' : '';
                                ?>
                                <li class="accordion block <?php echo esc_attr($collapsed_tab); ?>">
                                    <div class="acc-btn">
                                    <?php echo elh_element_kses_basic($slide['tab_title']); ?>
                                        </div>
                                    <div class="acc-content <?php echo esc_attr($active_show_tab); ?>">
                                        <p><?php echo elh_element_kses_basic($slide['tab_content_info']); ?></p>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <?php if(!empty( $faq_image )) : ?>
                    <div class="col-lg-4">
                        <div class="faq_img">
                            <img src="<?php echo esc_url($faq_image); ?>" alt="img">
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?php endif; ?>

        <?php

    }
}