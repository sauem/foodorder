<?php

namespace ElementHelper\Widget;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Repeater;
use \Elementor\Core\Schemes;
use \Elementor\Group_Control_Background;
use \ElementHelper\elh_El_Select2;
use Elementor\Utils;

defined('ABSPATH') || die();


class Event_List extends Element_El_Widget
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
        return 'event_list';
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
        return __('Events List', 'elementhelper');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.sabber.com/widgets/event-list/';
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
        return ['events', 'event', 'event-list', 'list', 'event'];
    }

    /**
     * Get a list of All Post Types
     *
     * @return array
     */
    public static function get_post_types()
    {
        $diff_key = [
            'elementor_library' => '',
            'attachment' => '',
            'page' => '',
            'elh-services' => '',
            'elh-portfolio' => '',
            'post' => ''

        ];
        $post_types = elh_element_get_post_types([], $diff_key);

        return $post_types;
    }

    protected function register_content_controls()
    {
        $this->start_controls_section(
            '_section_design',
            [
                'label' => __('Design Template', 'elementhelper'),
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
                    'style_4' => __('Style 4', 'elementhelper'),
                    'style_5' => __('Style 5', 'elementhelper'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_post_list',
            [
                'label' => __('Events List', 'elementhelper'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'post_type',
            [
                'label' => __('Source', 'elementhelper'),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_post_types(),
                'default' => key($this->get_post_types()),
            ]
        );

        $this->add_control(
            'show_post_by',
            [
                'label' => __('Show post by:', 'elementhelper'),
                'type' => Controls_Manager::SELECT,
                'default' => 'recent',
                'options' => [
                    'recent' => __('Recent Post', 'elementhelper'),
                    'selected' => __('Selected Post', 'elementhelper'),
                ],

            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Item Limit', 'elementhelper'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3,
                'dynamic' => ['active' => true],
                'condition' => [
                    'show_post_by' => ['recent']
                ]
            ]
        );

        $repeater = [];

        foreach ($this->get_post_types() as $key => $value) {

            $repeater[$key] = new Repeater();

            $repeater[$key]->add_control(
                'title',
                [
                    'label' => __('Title', 'elementhelper'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'placeholder' => __('Customize Title', 'elementhelper'),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater[$key]->add_control(
                'post_short_text',
                [
                    'label' => __('Short Content', 'elementhelper'),
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'placeholder' => __('Short Content', 'elementhelper'),
                    'rows' => 3,
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater[$key]->add_control(
                'post_id',
                [
                    'label' => __('Select ', 'elementhelper') . $value,
                    'label_block' => true,
                    'type' => elh_El_Select2::TYPE,
                    'multiple' => false,
                    'placeholder' => 'Search ' . $value,
                    'data_options' => [
                        'post_type' => $key,
                        'action' => 'elh_element_post_list_query'
                    ],
                ]
            );

            $this->add_control(
                'selected_list_' . $key,
                [
                    'label' => '',
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater[$key]->get_controls(),
                    'title_field' => '{{ title }}',
                    'condition' => [
                        'show_post_by' => 'selected',
                        'post_type' => $key
                    ],
                ]
            );
        }

        $this->end_controls_section();

        //Settings
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __('Settings', 'elementhelper'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'layout_view',
            [
                'label' => __('Layout', 'elementhelper'),
                'label_block' => false,
                'type' => Controls_Manager::CHOOSE,
                'default' => 'list',
                'options' => [
                    'list' => [
                        'title' => __('List View', 'elementhelper'),
                        'icon' => 'eicon-editor-list-ul',
                    ],
                    'grid_view' => [
                        'title' => __('Grid View', 'elementhelper'),
                        'icon' => 'eicon-ellipsis-h',
                    ],
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'read_more',
            [
                'label' => __('Read More', 'elementhelper'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'elementhelper'),
                'label_off' => __('Hide', 'elementhelper'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'read_more_text',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Read More Text', 'elementhelper'),
                'default' => __('Read More', 'elementhelper'),
                'placeholder' => __('Type text here', 'elementhelper'),
                'condition' => [
                    'read_more' => 'yes'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'read_more_icon',
            [
                'label' => __('Read More Icon', 'elementhelper'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fal fa-arrow-right',
                    'library' => 'reguler',
                ],
                'condition' => [
                    'read_more' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'feature_image',
            [
                'label' => __('Featured Image', 'elementhelper'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'elementhelper'),
                'label_off' => __('Hide', 'elementhelper'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'post_image',
                'default' => 'thumbnail',
                'exclude' => [
                    'custom'
                ],
                'condition' => [
                    'feature_image' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'list_icon',
            [
                'label' => __('List Icon', 'elementhelper'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'elementhelper'),
                'label_off' => __('Hide', 'elementhelper'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'feature_image!' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __('Icon', 'elementhelper'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'default' => [
                    'value' => 'far fa-check-circle',
                    'library' => 'reguler'
                ],
                'condition' => [
                    'list_icon' => 'yes',
                    'feature_image!' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => __('Content', 'elementhelper'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'elementhelper'),
                'label_off' => __('Hide', 'elementhelper'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'content_limit',
            [
                'label' => __('Content Limit', 'elementhelper'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '14',
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'content' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'meta',
            [
                'label' => __('Show Meta', 'elementhelper'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'elementhelper'),
                'label_off' => __('Hide', 'elementhelper'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'design_style' => ['style_1', 'style_2', 'style_3', 'style_4', 'style_5']
                ]
            ]
        );

        $this->add_control(
            'author_meta',
            [
                'label' => __('Author', 'elementhelper'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'elementhelper'),
                'label_off' => __('Hide', 'elementhelper'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'meta' => 'yes',
                    'design_style' => ['style_1', 'style_2', 'style_3', 'style_4', 'style_5']
                ]
            ]
        );

        $this->add_control(
            'author_icon',
            [
                'label' => __('Author Icon', 'elementhelper'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'far fa-user',
                    'library' => 'reguler',
                ],
                'condition' => [
                    'meta' => 'yes',
                    'author_meta' => 'yes',
                    'design_style' => ['style_1', 'style_2', 'style_3', 'style_4', 'style_5']
                ]
            ]
        );

        $this->add_control(
            'date_meta',
            [
                'label' => __('Date', 'elementhelper'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'elementhelper'),
                'label_off' => __('Hide', 'elementhelper'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'meta' => 'yes',
                    'design_style' => ['style_1', 'style_2', 'style_3', 'style_4', 'style_5']
                ]
            ]
        );

        $this->add_control(
            'date_icon',
            [
                'label' => __('Date Icon', 'elementhelper'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'far fa-calendar-check',
                    'library' => 'reguler',
                ],
                'condition' => [
                    'meta' => 'yes',
                    'date_meta' => 'yes',
                    'design_style' => ['style_1', 'style_2', 'style_3', 'style_4', 'style_5']
                ]
            ]
        );

        $this->add_control(
            'category_meta',
            [
                'label' => __('Category', 'elementhelper'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'elementhelper'),
                'label_off' => __('Hide', 'elementhelper'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'meta' => 'yes',
                    'post_type' => 'post',
                    'design_style' => ['style_1', 'style_2', 'style_3', 'style_4', 'style_5']
                ]
            ]
        );

        $this->add_control(
            'category_icon',
            [
                'label' => __('Category Icon', 'elementhelper'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'far fa-folder-open',
                    'library' => 'reguler',
                ],
                'condition' => [
                    'meta' => 'yes',
                    'category_meta' => 'yes',
                    'post_type' => 'post',
                    'design_style' => ['style_1', 'style_2', 'style_3', 'style_4', 'style_5']
                ]
            ]
        );

        $this->add_control(
            'meta_position',
            [
                'label' => __('Meta Position', 'elementhelper'),
                'type' => Controls_Manager::SELECT,
                'default' => 'bottom',
                'options' => [
                    'top' => __('Top', 'elementhelper'),
                    'bottom' => __('Bottom', 'elementhelper'),
                ],
                'condition' => [
                    'meta' => 'yes',
                    'design_style' => ['style_1', 'style_2', 'style_3', 'style_4', 'style_5']
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __('Title HTML Tag', 'elementhelper'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => __('H1', 'elementhelper'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => __('H2', 'elementhelper'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => __('H3', 'elementhelper'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => __('H4', 'elementhelper'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => __('H5', 'elementhelper'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => __('H6', 'elementhelper'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h3',
                'toggle' => false,
            ]
        );

        $this->add_control(
            'item_align',
            [
                'label' => __('Alignment', 'elementhelper'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'elementhelper'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'elementhelper'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'elementhelper'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors_dictionary' => [
                    'left' => 'justify-content: flex-start',
                    'center' => 'justify-content: center',
                    'right' => 'justify-content: flex-end',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementhelper-post-list .elementhelper-post-list-item a' => '{{VALUE}};'
                ],
                'condition' => [
                    'view' => 'list',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_extra',
            [
                'label' => __('Info Content', 'elementhelper'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_10'],
                ],
            ]
        );

        $this->add_control(
            'info_image',
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

        $this->add_control(
            'video_link',
            [
                'label' => __('Video Link', 'elementhelper'),
                'type' => Controls_Manager::URL,
                'placeholder' => 'http://elementor.sabber.com/',
                'dynamic' => [
                    'active' => true,
                ]
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

        $this->add_responsive_control(
            'list_item_margin',
            [
                'label' => __('Margin', 'elementhelper'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementhelper-post-list .elementhelper-post-list-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'list_item_padding',
            [
                'label' => __('Padding', 'elementhelper'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementhelper-post-list .elementhelper-post-list-item a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'list_item_background',
                'label' => __('Background', 'elementhelper'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .elementhelper-post-list .elementhelper-post-list-item',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'list_item_box_shadow',
                'label' => __('Box Shadow', 'elementhelper'),
                'selector' => '{{WRAPPER}} .elementhelper-post-list .elementhelper-post-list-item',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'list_item_border',
                'label' => __('Border', 'elementhelper'),
                'selector' => '{{WRAPPER}} .elementhelper-post-list .elementhelper-post-list-item',
            ]
        );

        $this->add_responsive_control(
            'list_item_border_radius',
            [
                'label' => __('Border Radius', 'elementhelper'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementhelper-post-list .elementhelper-post-list-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'advance_style',
            [
                'label' => __('Advance Style', 'elementhelper'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('On', 'elementhelper'),
                'label_off' => __('Off', 'elementhelper'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_responsive_control(
            'list_item_first',
            [
                'label' => __('First Item', 'elementhelper'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'advance_style' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'list_item_first_child_margin',
            [
                'label' => __('Margin', 'elementhelper'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementhelper-post-list .elementhelper-post-list-item:first-child' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'advance_style' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'list_item_first_child_border',
                'label' => __('Border', 'elementhelper'),
                'selector' => '{{WRAPPER}} .elementhelper-post-list .elementhelper-post-list-item:first-child',
                'condition' => [
                    'advance_style' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'list_item_last',
            [
                'label' => __('Last Item', 'elementhelper'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'advance_style' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'list_item_last_child_margin',
            [
                'label' => __('Margin', 'elementhelper'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementhelper-post-list .elementhelper-post-list-item:last-child' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'advance_style' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'list_item_last_child_border',
                'label' => __('Border', 'elementhelper'),
                'selector' => '{{WRAPPER}} .elementhelper-post-list .elementhelper-post-list-item:last-child',
                'condition' => [
                    'advance_style' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();
        //Title Style
        $this->start_controls_section(
            '_section_post_list_title_style',
            [
                'label' => __('Title', 'elementhelper'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'elementhelper'),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .elementhelper-post-list-title',
            ]
        );

        $this->start_controls_tabs('title_tabs');
        $this->start_controls_tab(
            'title_normal_tab',
            [
                'label' => __('Normal', 'elementhelper'),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementhelper-post-list-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_hover_tab',
            [
                'label' => __('Hover', 'elementhelper'),
            ]
        );

        $this->add_control(
            'title_hvr_color',
            [
                'label' => __('Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementhelper-post-list .elementhelper-post-list-item a:hover .elementhelper-post-list-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        //List Icon Style
        $this->start_controls_section(
            '_section_list_icon_feature_iamge_style',
            [
                'label' => __('Icon & Feature Image', 'elementhelper'),
                'tab' => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'feature_image',
                            'operator' => '==',
                            'value' => 'yes',
                        ],
                        [
                            'name' => 'list_icon',
                            'operator' => '==',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __('Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} span.elementhelper-post-list-icon' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'feature_image!' => 'yes',
                    'list_icon' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __('Font Size', 'elementhelper'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} span.elementhelper-post-list-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'feature_image!' => 'yes',
                    'list_icon' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_line_height',
            [
                'label' => __('Line Height', 'elementhelper'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} span.elementhelper-post-list-icon' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'feature_image!' => 'yes',
                    'list_icon' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => __('Image Width', 'elementhelper'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementhelper-post-list-item a img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'feature_image' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_boder',
                'label' => __('Border', 'elementhelper'),
                'selector' => '{{WRAPPER}} .elementhelper-post-list-item a img',
                'condition' => [
                    'feature_image' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'image_boder_radius',
            [
                'label' => __('Border Radius', 'elementhelper'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementhelper-post-list-item a img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'feature_image' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_margin_right',
            [
                'label' => __('Margin Right', 'elementhelper'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} span.elementhelper-post-list-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementhelper-post-list-item a img' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        //List Meta Style
        $this->start_controls_section(
            '_section_list_meta_style',
            [
                'label' => __('Meta', 'elementhelper'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'meta' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'label' => __('Typography', 'elementhelper'),
                'scheme' => Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .elementhelper-post-list-meta-wrap span',
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label' => __('Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementhelper-post-list-meta-wrap span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'meta_space',
            [
                'label' => __('Space Between', 'elementhelper'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementhelper-post-list-meta-wrap span' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementhelper-post-list-meta-wrap span:last-child' => 'margin-right: 0;',
                ],
            ]
        );

        $this->add_responsive_control(
            'meta_box_margin',
            [
                'label' => __('Margin', 'elementhelper'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementhelper-post-list-meta-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'meta_icon_heading',
            [
                'label' => __('Meta Icon', 'elementhelper'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'meta_icon_color',
            [
                'label' => __('Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementhelper-post-list-meta-wrap span i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'meta_icon_space',
            [
                'label' => __('Space Between', 'elementhelper'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementhelper-post-list-meta-wrap span i' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();

        if (!$settings['post_type']) return;

        $args = [
            'post_status' => 'publish',
            'post_type' => $settings['post_type'],
        ];

        if ('recent' === $settings['show_post_by']) {
            $args['posts_per_page'] = $settings['posts_per_page'];
        }

        $selected_post_type = 'selected_list_' . $settings['post_type'];

        $customize_title = [];

        $ids = [];
        if ('selected' === $settings['show_post_by']) {
            $args['posts_per_page'] = -1;
            $lists = $settings['selected_list_' . $settings['post_type']];

            if (!empty($lists)) {

                foreach ($lists as $index => $value) {
                    $post_id = !empty($value['post_id']) ? $value['post_id'] : 0;
                    $ids[] = $post_id;
                    if ($value['title']) $customize_title[$post_id] = $value['title'];
                }
            }

            $args['post__in'] = (array)$ids;
            $args['orderby'] = 'post__in';
        }

        if ('selected' === $settings['show_post_by'] && empty($ids)) {
            $posts = [];
        } else {
            $posts = new \WP_Query($args);
        }

        if (!empty($settings['design_style']) and $settings['design_style'] == 'style_5'): ?>
            <div class="events-wrapper-area">
                <?php
                if ($posts->have_posts()):
                    while ($posts->have_posts()) : $posts->the_post();
                        $event = tribe_get_event(get_the_ID());
                        $categories = get_the_category(get_the_ID());

                        $feature_img = '';
                        if ('yes' === $settings['feature_image']) {
                            $feature_img = get_the_post_thumbnail_url(get_the_ID(), 'full');
                        } ?>
                        <div class="events-wrapper">
                            <div class="events-img pos-rel">
                                <div class="fix">
                                    <a href="<?php print get_the_permalink() ?>">
                                        <img src="<?php echo esc_url($feature_img); ?>" alt="img">
                                    </a>
                                </div>
                                <div class="eventsa-tag">
                                    <a href="<?php print get_the_permalink() ?>">
                                        <?php echo \ElementHelper\elh_El_Event::tribe_get_cost($posts->ID, true); ?>
                                    </a>
                                </div>
                            </div>
                            <div class="events-text events-text-02 blue-dark-bg">
                                <?php if ($settings['meta'] == 'yes'): ?>
                                    <div class="events-meta">
                                                        <span>
                                                            <i class="far fa-calendar-alt"></i>
                                                            <a href="<?php print get_the_permalink() ?>">
                                                                <?php echo esc_html($event->dates->start_display->format_i18n('jS M Y')); ?>
                                                            </a>
                                                        </span>
                                        <span>
                                                            <i class="far fa-book"></i>
                                                            <a href="<?php print get_the_permalink() ?>">
                                                                <?php echo get_the_time('h:i a', $posts->ID); ?>
                                                            </a>
                                                        </span>
                                        <span>
                                                            <i class="far fa-map-marker-alt"></i>
                                                            <a href="<?php print get_the_permalink() ?>">
                                                                <?php echo \ElementHelper\elh_El_Event::tribe_get_venue($posts->ID); ?>
                                                            </a>
                                                        </span>
                                    </div>
                                <?php endif; ?>
                                <?php
                                $title = get_the_title();
                                if ('selected' === $settings['show_post_by'] && array_key_exists(get_the_ID(), $customize_title)) {
                                    $title = $customize_title[get_the_ID()];
                                }
                                printf('<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                    tag_escape($settings['title_tag']),
                                    $this->get_render_attribute_string('title'),
                                    esc_html($title),
                                    esc_url(get_the_permalink())
                                ); ?>

                                <?php if (!empty($settings['content'])):
                                    $content_limit = (!empty($settings['content_limit'])) ? $settings['content_limit'] : '';
                                    ?>
                                    <p><?php print wp_trim_words(get_the_content(), $content_limit, ''); ?></p>
                                <?php endif; ?>

                                <?php if ($settings['read_more'] == 'yes'): ?>
                                    <a class="c-btn btn-blue-style" href="<?php print get_the_permalink() ?>">
                                        <?php echo elh_element_kses_basic($settings['read_more_text']); ?>
                                        <?php if ($settings['read_more_icon']): Icons_Manager::render_icon($settings['read_more_icon'], ['aria-hidden' => 'true']); endif; ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_query();
                endif;
                ?>
            </div>
        <?php elseif (!empty($settings['design_style']) and $settings['design_style'] == 'style_4'): ?>
            <div class="events-wrapper-area events-wrapper-el">
                <?php
                if ($posts->have_posts()):
                    while ($posts->have_posts()) : $posts->the_post();
                        $event = tribe_get_event(get_the_ID());
                        $categories = get_the_category(get_the_ID());

                        $feature_img = '';
                        if ('yes' === $settings['feature_image']) {
                            $feature_img = get_the_post_thumbnail_url(get_the_ID(), 'full');
                        } ?>
                        <div class="events-single events-single-02">
                            <div class="events-02-img pos-rel">
                                <a href="<?php print get_the_permalink() ?>">
                                    <img src="<?php echo esc_url($feature_img); ?>" alt="img">
                                </a>
                                <div class="events-tag">
                                    <a href="<?php print get_the_permalink() ?>">
                                        <?php echo \ElementHelper\elh_El_Event::tribe_get_cost($posts->ID, true); ?>
                                    </a>
                                </div>
                                <div class="events-content">
                                    <div class="events-02-meta">
                                        <span> <i class="far fa-calendar-alt"></i>
                                            <a href="<?php print get_the_permalink() ?>">
                                                <?php echo esc_html($event->dates->start_display->format_i18n('jS M Y')); ?>
                                            </a>
                                        </span>
                                        <span> <i class="far fa-book"></i>
                                            <a href="<?php print get_the_permalink() ?>">
                                                <?php echo get_the_time('h:i a', $posts->ID); ?>
                                            </a>
                                        </span>
                                    </div>
                                    <?php
                                    $title = get_the_title();
                                    if ('selected' === $settings['show_post_by'] && array_key_exists(get_the_ID(), $customize_title)) {
                                        $title = $customize_title[get_the_ID()];
                                    }
                                    printf('<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                        tag_escape($settings['title_tag']),
                                        $this->get_render_attribute_string('title'),
                                        esc_html($title),
                                        esc_url(get_the_permalink())
                                    ); ?>

                                    <?php if ($settings['read_more'] == 'yes'): ?>
                                        <a href="<?php print get_the_permalink() ?>">
                                            <?php echo elh_element_kses_basic($settings['read_more_text']); ?>
                                            <?php if ($settings['read_more_icon']): Icons_Manager::render_icon($settings['read_more_icon'], ['aria-hidden' => 'true']); endif; ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_query();
                endif;
                ?>
            </div>
        <?php
        elseif (!empty($settings['design_style']) and $settings['design_style'] == 'style_3'):?>
            <div class="events-wrapper-area">
                <?php
                if ($posts->have_posts()):
                    while ($posts->have_posts()) : $posts->the_post();
                        $event = tribe_get_event(get_the_ID());
                        $categories = get_the_category(get_the_ID());

                        $feature_img = '';
                        if ('yes' === $settings['feature_image']) {
                            $feature_img = get_the_post_thumbnail_url(get_the_ID(), 'full');
                        } ?>
                        <div class="events-wrapper">
                            <div class="events-img pos-rel">
                                <div class="fix">
                                    <a href="<?php print get_the_permalink() ?>">
                                        <img src="<?php echo esc_url($feature_img); ?>" alt="img">
                                    </a>
                                </div>
                                <div class="eventsa-tag event-tab-price">
                                    <a href="<?php print get_the_permalink() ?>">
                                        <?php echo \ElementHelper\elh_El_Event::tribe_get_cost($posts->ID, true); ?>
                                    </a>
                                </div>
                            </div>
                            <div class="events-text grey-bg">
                                <?php if ($settings['meta'] == 'yes'): ?>
                                    <div class="events-meta">
                                        <span>
                                            <i class="far fa-calendar-alt"></i>
                                            <a href="<?php print get_the_permalink() ?>">
                                                <?php echo esc_html($event->dates->start_display->format_i18n('jS M Y')); ?>
                                            </a>
                                        </span>
                                        <span>
                                            <i class="far fa-book"></i>
                                            <a href="<?php print get_the_permalink() ?>">
                                                <?php echo get_the_time('h:i a', $posts->ID); ?>
                                            </a>
                                        </span>
                                        <span>
                                            <i class="far fa-map-marker-alt"></i>
                                            <a href="<?php print get_the_permalink() ?>">
                                                <?php echo \ElementHelper\elh_El_Event::tribe_get_venue($posts->ID); ?>
                                            </a>
                                        </span>
                                    </div>
                                <?php endif; ?>
                                <?php
                                $title = get_the_title();
                                if ('selected' === $settings['show_post_by'] && array_key_exists(get_the_ID(), $customize_title)) {
                                    $title = $customize_title[get_the_ID()];
                                }
                                printf('<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                    tag_escape($settings['title_tag']),
                                    $this->get_render_attribute_string('title'),
                                    esc_html($title),
                                    esc_url(get_the_permalink())
                                ); ?>

                                <?php if (!empty($settings['content'])):
                                    $content_limit = (!empty($settings['content_limit'])) ? $settings['content_limit'] : '';
                                    ?>
                                    <p><?php print wp_trim_words(get_the_content(), $content_limit, ''); ?></p>
                                <?php endif; ?>

                                <?php if ($settings['read_more'] == 'yes'): ?>
                                    <a class="c-btn" href="<?php print get_the_permalink() ?>">
                                        <?php echo elh_element_kses_basic($settings['read_more_text']); ?>
                                        <?php if ($settings['read_more_icon']): Icons_Manager::render_icon($settings['read_more_icon'], ['aria-hidden' => 'true']); endif; ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_query();
                endif;
                ?>
            </div>
        <?php
        elseif (!empty($settings['design_style']) and $settings['design_style'] == 'style_2'): ?>
            <div class="events-wrapper-area events-wrapper-el">
                <?php
                if ($posts->have_posts()):
                    while ($posts->have_posts()) : $posts->the_post();
                        $event = tribe_get_event(get_the_ID());
                        $categories = get_the_category(get_the_ID());

                        $feature_img = '';
                        if ('yes' === $settings['feature_image']) {
                            $feature_img = get_the_post_thumbnail_url(get_the_ID(), 'full');
                        } ?>
                        <div class="events-single">
                            <div class="events-02-img pos-rel">
                                <a href="<?php print get_the_permalink() ?>">
                                    <img src="<?php echo esc_url($feature_img); ?>" alt="img">
                                </a>
                                <div class="events-tag">
                                    <a href="<?php print get_the_permalink() ?>">
                                        <?php echo \ElementHelper\elh_El_Event::tribe_get_cost($posts->ID, true); ?>
                                    </a>
                                </div>
                                <div class="events-content">
                                    <div class="events-02-meta">
                                        <span> <i class="far fa-calendar-alt"></i>
                                            <a href="<?php print get_the_permalink() ?>">
                                                <?php echo esc_html($event->dates->start_display->format_i18n('jS M Y')); ?>
                                            </a>
                                        </span>
                                        <span> <i class="far fa-book"></i>
                                            <a href="<?php print get_the_permalink() ?>">
                                                <?php echo get_the_time('h:i a', $posts->ID); ?>
                                            </a>
                                        </span>
                                    </div>
                                    <?php
                                    $title = get_the_title();
                                    if ('selected' === $settings['show_post_by'] && array_key_exists(get_the_ID(), $customize_title)) {
                                        $title = $customize_title[get_the_ID()];
                                    }
                                    printf('<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                        tag_escape($settings['title_tag']),
                                        $this->get_render_attribute_string('title'),
                                        esc_html($title),
                                        esc_url(get_the_permalink())
                                    ); ?>

                                    <?php if ($settings['read_more'] == 'yes'): ?>
                                        <a href="<?php print get_the_permalink() ?>">
                                            <?php echo elh_element_kses_basic($settings['read_more_text']); ?>
                                            <?php if ($settings['read_more_icon']): Icons_Manager::render_icon($settings['read_more_icon'], ['aria-hidden' => 'true']); endif; ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_query();
                endif;
                ?>
            </div>
        <?php
        else:
            if (!empty($posts) and !empty($settings['layout_view'])):
                $this->add_render_attribute('title', 'class', 'events-title');
                if ($posts->have_posts()):
                    while ($posts->have_posts()) : $posts->the_post();
                    $event = tribe_get_event(get_the_ID());
                    $categories = get_the_category(get_the_ID());

                    $feature_img = '';
                    if ('yes' === $settings['feature_image']) {
                        $feature_img = get_the_post_thumbnail_url(get_the_ID(), 'full');
                    }
                    // event
                    $separator            = esc_html_x( ', ', 'Address separator', 'micoach' );
                    $venue                = $event->venues[0];
                    $append_after_address = array_filter( array_map( 'trim', [ $venue->city, $venue->state_province, $venue->state, $venue->province ] ) );
                    $address              = $venue->address . ( $venue->address && $append_after_address ? $separator : '' );
                ?>
                <div class="events mb-40 wow fadeInUp2 animated" data-wow-delay=".1s">
                <?php if ('yes' === $settings['meta']): ?>
                <?php if ('post' === $settings['post_type'] && 'yes' === $settings['category_meta']):
                    $categories = get_the_category($post->ID); ?>
                    <a href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>">
                        <?php if ($settings['category_icon']):
                            Icons_Manager::render_icon($settings['category_icon'], ['aria-hidden' => 'true']);
                        endif;
                        echo esc_html($categories[0]->name); ?>
                    </a>
                <?php endif; ?>
            <?php endif; ?>
                    <a class="events_tag" href="<?php print get_the_permalink() ?>">Education</a>
                    <div class="events__img pos-rel">
                        <img class="block-one" src="<?php echo esc_url($feature_img); ?>" alt="img">
                        <div class="events-back" style="background-image:url(<?php echo esc_url($feature_img); ?>);"></div>
                    </div>
                    <div class="events__content events__content-el pos-abl">
                    <?php if(!empty($address)) : ?>
                        <span><i class="far fa-map-marker-alt"></i> <?php print esc_html( $address ); ?></span>
                    <?php endif; ?>
                        <?php
                            $title = get_the_title();
                            if ('selected' === $settings['show_post_by'] && array_key_exists(get_the_ID(), $customize_title)) {
                                $title = $customize_title[get_the_ID()];
                            }
                            printf('<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                tag_escape($settings['title_tag']),
                                $this->get_render_attribute_string('title'),
                                esc_html($title),
                                esc_url(get_the_permalink())
                            );
                        ?>
                        <?php if ($settings['read_more'] == 'yes'): ?>
                            <a class="more_btn" href="<?php print get_the_permalink() ?>">
                                <?php if ($settings['read_more_icon']): Icons_Manager::render_icon($settings['read_more_icon'], ['aria-hidden' => 'true']); endif; ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
                    endwhile;
                    wp_reset_query();
                endif;
                ?>
                <div class="events-area d-none">
                    <div class="container">
                        <div class="row">
                            <?php
                            if ($posts->have_posts()):
                                while ($posts->have_posts()) : $posts->the_post();
                                    $event = tribe_get_event(get_the_ID());
                                    $categories = get_the_category(get_the_ID());
                                    $feature_img = '';
                                    if ('yes' === $settings['feature_image']) {
                                        $feature_img = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                    } ?>
                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="events-wrapper mb-30">
                                            <div class="events-img pos-rel">
                                                <div class="fix">
                                                    <a href="<?php print get_the_permalink() ?>">
                                                        <img src="<?php echo esc_url($feature_img); ?>" alt="img">
                                                    </a>
                                                </div>
                                                <div class="eventsa-tag event-tab-price">
                                                    <a href="<?php print get_the_permalink() ?>">
                                                        <?php echo \ElementHelper\elh_El_Event::tribe_get_cost($posts->ID, true); ?>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="events-text grey-bg">
                                                <?php if ($settings['meta'] == 'yes'): ?>
                                                    <div class="events-meta">
                                                        <span>
                                                            <i class="far fa-calendar-alt"></i>
                                                            <a href="<?php print get_the_permalink() ?>">
                                                                <?php echo esc_html($event->dates->start_display->format_i18n('jS M Y')); ?>
                                                            </a>
                                                        </span>
                                                        <span>
                                                            <i class="far fa-book"></i>
                                                            <a href="<?php print get_the_permalink() ?>">
                                                                <?php echo get_the_time('h:i a', $posts->ID); ?>
                                                            </a>
                                                        </span>
                                                        <span>
                                                            <i class="far fa-map-marker-alt"></i>
                                                            <a href="<?php print get_the_permalink() ?>">
                                                                <?php echo \ElementHelper\elh_El_Event::tribe_get_venue($posts->ID); ?>
                                                            </a>
                                                        </span>
                                                    </div>
                                                <?php endif; ?>
                                                <?php
                                                $title = get_the_title();
                                                if ('selected' === $settings['show_post_by'] && array_key_exists(get_the_ID(), $customize_title)) {
                                                    $title = $customize_title[get_the_ID()];
                                                }
                                                printf('<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                                    tag_escape($settings['title_tag']),
                                                    $this->get_render_attribute_string('title'),
                                                    esc_html($title),
                                                    esc_url(get_the_permalink())
                                                ); ?>

                                                <?php if (!empty($settings['content'])):
                                                    $content_limit = (!empty($settings['content_limit'])) ? $settings['content_limit'] : '';
                                                    ?>
                                                    <p><?php print wp_trim_words(get_the_content(), $content_limit, ''); ?></p>
                                                <?php endif; ?>

                                                <?php if ($settings['read_more'] == 'yes'): ?>
                                                    <a class="c-btn" href="<?php print get_the_permalink() ?>">
                                                        <?php echo elh_element_kses_basic($settings['read_more_text']); ?>
                                                        <?php if ($settings['read_more_icon']): Icons_Manager::render_icon($settings['read_more_icon'], ['aria-hidden' => 'true']); endif; ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                endwhile;
                                wp_reset_query();
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            else:
                printf('%1$s %2$s %3$s',
                    __('No ', 'elementhelper'),
                    esc_html($settings['post_type']),
                    __('Found', 'elementhelper')
                );
            endif;
            ?>
        <?php
        endif;
    }
}