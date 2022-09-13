<?php

namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

defined('ABSPATH') || die();


class Crowd_Funding_Form extends Element_El_Widget
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
        return 'crowd_funding_form';
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
        return __('Crowd Funding Form', 'elementhelper');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.sabber.com/widgets/post-list/';
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
        return 'elh-widget-icon eicon-parallax';
    }

    public function get_keywords()
    {
        return ['posts', 'post', 'post-list', 'list', 'news'];
    }

    /**
     * Get a list of All Post Types
     *
     * @return array
     */
    public function get_post_types()
    {
        $post_types = elh_element_get_post_types([], ['elementor_library', 'attachment']);
        return $post_types;
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

        $this->start_controls_section(
            '_section_media',
            [
                'label' => __('Image', 'elementhelper'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image',
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
            '_section_heading',
            [
                'label' => __('Heading', 'elementhelper'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => __('Sub Title', 'elementhelper'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('Type Info Box Title', 'elementhelper'),
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
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __('Type Info Box Description', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'video_link',
            [
                'label' => __('Video Link', 'elementhelper'),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __('video url link', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_button',
            [
                'label' => __('Button', 'elementhelper'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Text', 'elementhelper'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Button Text',
                'placeholder' => __('Type button text here', 'elementhelper'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __('Link', 'elementhelper'),
                'type' => Controls_Manager::URL,
                'placeholder' => 'http://elementor.sabber.com/',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        if (elh_element_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'button_icon',
                [
                    'label' => __('Icon', 'elementhelper'),
                    'label_block' => true,
                    'type' => Controls_Manager::ICON,
                    'options' => elh_element_get_elh_element_icons(),
                    'default' => 'fa fa-angle-right',
                ]
            );

            $condition = ['button_icon!' => ''];
        } else {
            $this->add_control(
                'button_selected_icon',
                [
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'button_icon',
                    'label_block' => true,
                ]
            );
            $condition = ['button_selected_icon[value]!' => ''];
        }

        $this->add_control(
            'button_icon_position',
            [
                'label' => __('Icon Position', 'elementhelper'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'before' => [
                        'title' => __('Before', 'elementhelper'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => __('After', 'elementhelper'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'before',
                'toggle' => false,
                'condition' => $condition,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'button_icon_spacing',
            [
                'label' => __('Icon Spacing', 'elementhelper'),
                'type' => Controls_Manager::SLIDER,
                'condition' => $condition,
                'selectors' => [
                    '{{WRAPPER}} .elh-btn--icon-before .elh-btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elh-btn--icon-after .elh-btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_extra',
            [
                'label' => __('Info Content', 'elementhelper'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_3'],
                ],
            ]
        );

        $this->add_control(
            'info_subtitle',
            [
                'label' => __('Sub Title', 'elementhelper'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('Type Info Box Title', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'info_title',
            [
                'label' => __('Title', 'elementhelper'),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __('Type Info Box Title', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'info_description',
            [
                'label' => __('Description', 'elementhelper'),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __('Type Info Box Description', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'info_button_text',
            [
                'label' => __('Text', 'elementhelper'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Button Text',
                'placeholder' => __('Type button text here', 'elementhelper'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'info_button_link',
            [
                'label' => __('Link', 'elementhelper'),
                'type' => Controls_Manager::URL,
                'placeholder' => 'http://elementor.sabber.com/',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        if (elh_element_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'info_button_icon',
                [
                    'label' => __('Icon', 'elementhelper'),
                    'label_block' => true,
                    'type' => Controls_Manager::ICON,
                    'options' => elh_element_get_elh_element_icons(),
                    'default' => 'fa fa-angle-right',
                ]
            );

            $condition = ['info_button_icon!' => ''];
        } else {
            $this->add_control(
                'info_button_selected_icon',
                [
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'button_icon',
                    'label_block' => true,
                ]
            );
            $condition = ['info_button_selected_icon[value]!' => ''];
        }

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'label' => __('Title', 'elementhelper'),
                'placeholder' => __('Type title here', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'info_lists',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_controls()
    {

        $this->start_controls_section(
            '_section_post_list_style',
            [
                'label' => __('List', 'elementhelper'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'list_item_common',
            [
                'label' => __('Common', 'elementhelper'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        if (!empty($settings['design_style']) and $settings['design_style'] == 'style_3'):
            $image = (!empty($settings['image']['id'])) ? wp_get_attachment_image_url($settings['image']['id'], 'full') : '';
            ?>
            <section class="donation-area-03 grey-bg2 pos-rel pt-100 pb-75">
                <div class="donation-area-03-bg" style="background-image: url(<?php echo $image; ?>);"></div>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-7 col-lg-6 col-md-6">
                            <div class="doante-select-area donate-select-02 mb-30 mr-50 text-center white-bg wow fadeInUp2"
                                 data-wow-delay=".3s">
                                <div class="section-title text-center mb-40 wow fadeInUp2" data-wow-delay=".1s">
                                    <?php if (!empty($settings['title'])) : ?>
                                        <h2><?php echo elh_element_kses_intermediate($settings['title']); ?></h2>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['description'])) : ?>
                                        <p><?php echo elh_element_kses_basic($settings['description']); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="donate-cart pos-rel mb-10">
                                    <form class="donate-btn pos-rel" action="#">
                                        <input type="text" value="$500">
                                    </form>
                                </div>
                                <button class="theme_btn theme_btn_bg">
                                    <?php echo esc_html($settings['button_text']); ?>
                                    <span><?php elh_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'elh-btn-icon']); ?></span>
                                </button>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-6 col-md-6">
                            <div class="about-wrapper about-wrap-02 mb-60">
                                <div class="section-title text-left mb-20 wow fadeInUp2  animated" data-wow-delay=".1s"
                                     style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp2;">
                                    <?php if (!empty($settings['info_subtitle'])) : ?>
                                        <h6><?php echo elh_element_kses_intermediate($settings['info_subtitle']); ?></h6>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['info_title'])) : ?>
                                        <h2><?php echo elh_element_kses_intermediate($settings['info_title']); ?></h2>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($settings['info_description'])) : ?>
                                    <p><?php echo elh_element_kses_intermediate($settings['info_description']); ?></p>
                                <?php endif; ?>
                                <?php if (!empty($settings['info_lists'])) : ?>
                                    <ul class="about_list mt-30 mb-20 wow fadeInUp2" data-wow-delay=".2s">
                                        <?php foreach ($settings['info_lists'] as $list) : ?>
                                            <li><?php echo elh_element_kses_basic($list['title']); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                                <?php if (!empty($settings['info_button_text'])) : ?>
                                    <a class="theme_btn theme_btn2 theme_btn_bg_02"
                                       href="<?php echo esc_url($settings['info_button_link']['url']); ?>">
                                        <?php echo esc_html($settings['info_button_text']); ?>
                                        <span><?php elh_element_render_icon($settings, 'info_button_icon', 'info_button_selected_icon', ['class' => 'elh-btn-icon']); ?></span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php elseif (!empty($settings['design_style']) and $settings['design_style'] == 'style_2'):
            $image = (!empty($settings['image']['id'])) ? wp_get_attachment_image_url($settings['image']['id'], 'full') : '';
            ?>
            <section class="donation-area donate-area-02 pt-125 pb-100"
                     style="background-image: url(<?php echo $image; ?>);">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-8 col-md-9">
                            <div class="doante-select-area mb-30 text-center white-bg wow fadeInUp"
                                 data-wow-delay=".3s">
                                <div class="section-title text-center mb-40 wow fadeInUp2" data-wow-delay=".1s">
                                    <?php if (!empty($settings['title'])) : ?>
                                        <h2><?php echo elh_element_kses_intermediate($settings['title']); ?></h2>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['description'])) : ?>
                                        <p><?php echo elh_element_kses_basic($settings['description']); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="donate-cart pos-rel mb-10">
                                    <form class="donate-btn pos-rel" action="#">
                                        <input type="text" value="$500">
                                    </form>
                                </div>
                                <button class="theme_btn theme_btn_bg">
                                    <?php echo esc_html($settings['button_text']); ?>
                                    <span><?php elh_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'elh-btn-icon']); ?></span>
                                </button>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-4 col-md-3">
                            <div class="video-area video-area-02 text-center text-md-right wow fadeInUp"
                                 data-wow-delay=".3s">
                                <a href="<?php echo esc_url($settings['video_link']); ?>" class="popup-video">
                                    <i class="fas fa-play"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php else:
            $image = (!empty($settings['image']['id'])) ? wp_get_attachment_image_url($settings['image']['id'], 'full') : '';
            $this->add_render_attribute('button', 'class', 'theme_btn theme_btn_bg');
            $this->add_link_attributes('button', $settings['button_link']);
            ?>
            <section class="donation-area pos-rel pt-125 pb-90" style="background-image: url(<?php echo $image; ?>);">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="donation-wrapper">
                                <div class="section-title white-title text-left mb-40 wow fadeInUp2"
                                     data-wow-delay=".1s">
                                    <?php if (!empty($settings['subtitle'])) : ?>
                                        <h6><?php echo elh_element_kses_basic($settings['subtitle']); ?></h6>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['title'])) : ?>
                                        <h2><?php echo elh_element_kses_intermediate($settings['title']); ?></h2>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="donation-input text-lg-right mb-30">
                                <ul class="btn-list text-md-center d-sm-inline-flex align-items-center wow fadeInUp2"
                                    data-wow-delay=".3s">
                                    <li>
                                        <div class="donate-cart mr-15 pos-rel mb-10">
                                            <form class="donate-btn pos-rel" action="#">
                                                <input type="text" value="$5">
                                            </form>
                                        </div>
                                    </li>
                                    <li>
                                        <?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
                                            $this->add_render_attribute('button', 'class', 'site-btn');
                                            printf('<a %1$s>%2$s</a>',
                                                $this->get_render_attribute_string('button'),
                                                esc_html($settings['button_text'])
                                            );
                                        elseif (empty($settings['button_text']) && (!(empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
                                            <a <?php $this->print_render_attribute_string('button'); ?>><span><?php elh_element_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></span></a>
                                        <?php elseif ($settings['button_text'] && (!(empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
                                            if ($settings['button_icon_position'] === 'before') :
                                                $this->add_render_attribute('button', 'class', 'site-btn elh-btn--icon-before');
                                                $button_text = sprintf('%1$s', esc_html($settings['button_text']));
                                                ?>
                                                <a <?php $this->print_render_attribute_string('button'); ?>><span><?php elh_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'elh-btn-icon']); ?></span><?php echo $button_text; ?>
                                                </a>
                                            <?php
                                            else :
                                                $this->add_render_attribute('button', 'class', 'elh-btn--icon-after');
                                                $button_text = sprintf('%1$s', esc_html($settings['button_text']));
                                                ?>
                                                <a <?php $this->print_render_attribute_string('button'); ?>><?php echo $button_text; ?>
                                                    <span><?php elh_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'elh-btn-icon']); ?></span></a>
                                            <?php
                                            endif;
                                        endif; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif;
    }
}
