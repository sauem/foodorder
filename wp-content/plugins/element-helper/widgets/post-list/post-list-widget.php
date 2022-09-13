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
use \ElementHelper\Element_El_Select2;

defined('ABSPATH') || die();


class Post_List extends Element_El_Widget
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
        return 'post_list';
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
        return __('Post Grid', 'elementhelper');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.sabber.net/widgets/post-list/';
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
        return ['posts', 'post', 'post-grid', 'grid', 'news'];
    }

    public function get_script_depends() {
		return ['elh_blog_slider'];
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
            '_section_title',
            [
                'label' => __('Title & Description', 'elementhelper'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1', 'style_3']
                ],
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => __('Sub Title', 'elementhelper'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('ElhInfo Box Sub Title', 'elementhelper'),
                'placeholder' => __('Type Info Box Sub Title', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ],
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

        $this->start_controls_section(
            '_section_button',
            [
                'label' => __( 'Button', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1', 'style_3']
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

        $this->start_controls_section(
            '_section_post_list',
            [
                'label' => __('Post', 'elementhelper'),
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

        $this->add_control(
            'readmore_text',
            [
                'label'       => __( 'Button text', 'elementhelper' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Read more', 'elementhelper' ),
                'placeholder' => __( 'Type button text here', 'elementhelper' ),
                'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1']
                ],
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
                    'type' => Element_El_Select2::TYPE,
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
            'view',
            [
                'label' => __('Layout', 'elementhelper'),
                'label_block' => false,
                'type' => Controls_Manager::CHOOSE,
                'default' => 'list',
                'options' => [
                    'list' => [
                        'title' => __('List', 'elementhelper'),
                        'icon' => 'eicon-editor-list-ul',
                    ],
                    'inline' => [
                        'title' => __('Inline', 'elementhelper'),
                        'icon' => 'eicon-ellipsis-h',
                    ],
                ],
                'style_transfer' => true,
                'condition' => [
                    'design_style' => ['style_3']
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
                'default' => 'yes',
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
                ],
                'condition' => [
                    'feature_image' => 'yes'
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
                'default' => 'yes',
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
                'default' => 'yes',
                'condition' => [
                    'meta' => 'yes',
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
                    'design_style' => ['style_3', 'style_4']
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
                    'design_style' => ['style_2']
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
                    'design_style' => ['style_5']
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
                    'design_style' => ['style_5']
                ]
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
                    'design_style' => ['style_5']
                ]
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
                    'design_style' => ['style_1', 'style_3']
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
            '_section_style_post',
            [
                'label' => __( 'Post Box', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'post_date',
            [
                'label' => __( 'Date Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog_single .blog_text .date' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .blog_item .blog_text .blog_head .date' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_date_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .blog_single .blog_text .date,
                    {{WRAPPER}} .blog_item .blog_text .blog_head .date
                    ',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_control(
            'post_title',
            [
                'label' => __( 'Title Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog_single .blog_text h3' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .blog_item .blog_text h3' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .blog_content h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .blog_content h3,
                    {{WRAPPER}} .blog_single .blog_text h3,
                    {{WRAPPER}} .blog_item .blog_text h3
                    ',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_control(
            'post_readmore',
            [
                'label' => __( 'Readmore Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog_single .blog_btn a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => ['style_1']
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_readmore_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .blog_single .blog_btn a',
                'scheme' => Typography::TYPOGRAPHY_2,
                'condition' => [
                    'design_style' => ['style_1']
                ],
            ]
        );

        $this->add_control(
            'post_tag_color',
            [
                'label' => __( 'Category Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog_item .blog_text .blog_head .tag a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => ['style_2']
                ],
            ]
        );

        $this->add_control(
            'post_tag_bg',
            [
                'label' => __( 'Category Bg Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog_item .blog_text .blog_head .tag a' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => ['style_2']
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_tag_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .blog_item .blog_text .blog_head .tag a',
                'scheme' => Typography::TYPOGRAPHY_2,
                'condition' => [
                    'design_style' => ['style_2']
                ],
            ]
        );


        $this->add_control(
            'post_author_color',
            [
                'label' => __( 'Category Bg Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog_text .blog_bottom .blog_author span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .blog_content .blog_meta li' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .blog_content .blog_meta li a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => ['style_2', 'style_3']
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'author_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .blog_content .blog_meta li a,
                    {{WRAPPER}} .blog_content .blog_meta li,
                    {{WRAPPER}} .blog_text .blog_bottom .blog_author span
                    ',
                'scheme' => Typography::TYPOGRAPHY_2,
                'condition' => [
                    'design_style' => ['style_2', 'style_3']
                ],
            ]
        );


        $this->add_control(
            'post_comment_color',
            [
                'label' => __( 'Comment Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog_bottom .comment' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .blog_content .blog_meta li.cmt a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => ['style_2', 'style_3']
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'comment_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .blog_bottom .comment,
                    {{WRAPPER}} .blog_content .blog_meta li.cmt a
                    ',
                'scheme' => Typography::TYPOGRAPHY_2,
                'condition' => [
                    'design_style' => ['style_2', 'style_3']
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => __( 'Button Style', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => ['style_1', 'style_3']
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

        $customize_text = [];
        $ids = [];
        if ( 'selected' === $settings['show_post_by'] ) {
            $args['posts_per_page'] = -1;
            $lists = $settings['selected_list_' . $settings['post_type']];
            if ( !empty( $lists ) ) {
                foreach ( $lists as $index => $value ) {
                    $post_id = !empty( $value['post_id'] ) ? $value['post_id'] : 0;
                    $ids[] = $post_id;
                    if ( $value['post_short_text'] ) {
                        $customize_text[$post_id] = $value['post_short_text'];
                    }

                }
            }
            $args['post__in'] = (array) $ids;
            $args['orderby'] = 'post__in';
        }


        if ( 'selected' === $settings['show_post_by'] && empty( $ids ) ) {
            $posts = [];
        } else {
            $posts = get_posts( $args );
        }

        $this->add_render_attribute( 'title', 'class', '' );
        $this->add_render_attribute( 'post_short_text', 'class', '' );

        if ('selected' === $settings['show_post_by'] && empty($ids)) {
            $posts = [];
        } else {
            $posts = get_posts($args);
        }

        if (!empty($settings['design_style']) and $settings['design_style'] == 'style_3'): ?>

        <section class="blog_area blog_2 pt-120 pb-120 white_bg">
            <div class="container">
                <div class="sec_title sec_title-2">

                    <?php if(!empty( $settings['subtitle']  )) : ?>
                    <span><?php echo elh_element_kses_intermediate( $settings['subtitle'] ); ?></span>
                    <?php endif; ?>

                    <?php if(!empty( $settings['title']  )) : ?>
                    <h2><?php echo elh_element_kses_intermediate( $settings['title'] ); ?></h2>
                    <?php endif; ?>

                </div>
                <div class="row justify-content-md-center">
                    <?php
                        if (!empty($posts)):

                        foreach ( $posts as $inx => $post ):
                        $categories = get_the_category( $post->ID );
                        $author_bio_avatar_size = 35;
                        if ('yes' === $settings['feature_image']) {
                            $feature_img = get_the_post_thumbnail_url(get_the_ID(), $settings['thumbnail_size']);
                        }
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="blog_single mb-30">
                            <?php if ( 'yes' === $settings['feature_image'] || has_post_thumbnail() ): ?>
                            <div class="blog_thumb">
                                <a href="<?php echo esc_url(get_the_permalink( $post->ID )); ?>">
                                    <?php echo get_the_post_thumbnail( $post->ID, $settings['thumbnail_size'] ); ?>
                                </a>
                            </div>
                            <?php endif; ?>
                            <div class="blog_content">
                                <?php if ( 'post' === $settings['post_type'] && 'yes' === $settings['category_meta'] ):
                                    $categories = get_the_category( $post->ID );?>
                                <span class="tag"><a href="<?php print esc_url( get_category_link( $categories[0]->term_id ) );?>">
                                <?php echo esc_html( $categories[0]->name ); ?></a></span>
                                <?php endif; ?>

                                <?php $title = $post->post_title;
                                    if ( 'selected' === $settings['show_post_by'] && array_key_exists( $post->ID, $customize_title ) ) {
                                        $title = $customize_title[$post->ID];
                                    }
                                ?>
                                <h3 class="title">
                                    <a href="<?php echo esc_url(get_the_permalink( $post->ID )); ?>"><?php echo esc_html($title); ?></a>
                                </h3>

                                <?php if ( !empty( $settings[$selected_post_type][$inx]['post_short_text'] ) ): ?>
                                <p><?php print $settings[$selected_post_type][$inx]['post_short_text'];?></p>
                                <?php endif;?>

                                <ul class="blog_meta pt-10 ul_li">

                                    <?php if ( 'yes' === $settings['author_meta'] ): ?>
                                    <li>By <a href="<?php echo esc_url(get_the_permalink( $post->ID )); ?>"><?php echo esc_html(get_the_author_meta('display_name', $post->post_author)); ?></a></li>
                                    <?php endif; ?>

                                    <li class="cmt">
                                        <a href="<?php echo esc_url(get_the_permalink( $post->ID )); ?>">
                                        <?php print get_comments_number();?>
                                        <?php print esc_html__('Comments', 'elementhelper'); ?>
                                    </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;
                        else:
                            printf('%1$s %2$s %3$s',
                                __('No ', 'elementhelper'),
                                esc_html($settings['post_type']),
                                __('Found', 'elementhelper')
                            );
                        endif;
                    ?>
                </div>
                <?php if(!empty( $settings['button_link']['url'] )) : ?>
                <div class="row">
                    <div class="col-12">
                        <div class="ca_btn text-center pt-20">
                            <a class="thm_btn thm_btn-2" href="<?php echo esc_url($settings['button_link']['url']); ?>"><?php echo esc_html($settings['button_text']); ?></a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </section>

        <?php elseif (!empty($settings['design_style']) and $settings['design_style'] == 'style_2'): ?>

        <section class="blog_area">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <?php
                        if (!empty($posts)):

                        foreach ( $posts as $inx => $post ):
                        $categories = get_the_category( $post->ID );
                        $author_bio_avatar_size = 35;
                        if ('yes' === $settings['feature_image']) {
                            $feature_img = get_the_post_thumbnail_url(get_the_ID(), $settings['thumbnail_size']);
                        }
                    ?>
                    <div class="col-lg-6 col-md-6">
                        <div class="blog_item blog_style_2">

                            <?php if ( 'yes' === $settings['feature_image'] || has_post_thumbnail() ): ?>
                            <div class="blog_thumb">
                                <a href="<?php echo esc_url(get_the_permalink( $post->ID )); ?>">
                                    <?php echo get_the_post_thumbnail( $post->ID, $settings['thumbnail_size'] ); ?>
                                </a>
                            </div>
                            <?php endif; ?>

                            <div class="blog_text order-first">
                                <div class="blog_head ul_li">
                                <?php if ( 'post' === $settings['post_type'] && 'yes' === $settings['category_meta'] ):
                                    $categories = get_the_category( $post->ID );?>
                                    <span class="tag">
                                        <a href="<?php print esc_url( get_category_link( $categories[0]->term_id ) );?>">
                                            <?php echo esc_html( $categories[0]->name ); ?></a>
                                    </span>
                                    <?php endif;?>

                                    <?php if ( 'yes' === $settings['date_meta'] ): ?>
                                    <span class="date"><?php print get_the_date( "M d, Y" ); ?></span>
                                    <?php endif; ?>

                                </div>

                                <?php $title = $post->post_title;
                                    if ( 'selected' === $settings['show_post_by'] && array_key_exists( $post->ID, $customize_title ) ) {
                                        $title = $customize_title[$post->ID];
                                    }
                                ?>
                                <h3 class="title">
                                    <a href="<?php echo esc_url(get_the_permalink( $post->ID )); ?>"><?php echo esc_html($title); ?></a>
                                </h3>

                                <?php if ( !empty( $settings[$selected_post_type][$inx]['post_short_text'] ) ): ?>
                                <p><?php print $settings[$selected_post_type][$inx]['post_short_text'];?></p>
                                <?php endif;?>

                                <div class="blog_bottom ul_li">

                                    <?php if ( 'yes' === $settings['author_meta'] ): ?>
                                    <div class="blog_author">
                                        <?php if ( $settings['author_icon'] ):
                                            print get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', '', ['class' => 'media-object img-circle'] );
                                        endif;
                                        ?>
                                        <span><?php echo esc_html(get_the_author_meta('display_name', $post->post_author)); ?></span>
                                    </div>
                                    <?php endif; ?>

                                    <span class="comment"><i class="fal fa-comment"></i>
                                    <?php print get_comments_number();?>
                                    <?php print esc_html__('Comments', 'elementhelper'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;
                        else:
                            printf('%1$s %2$s %3$s',
                                __('No ', 'elementhelper'),
                                esc_html($settings['post_type']),
                                __('Found', 'elementhelper')
                            );
                        endif;
                    ?>
                </div>
            </div>
        </section>

        <?php else: ?>

        <section class="blog-area pt-120 pb-120">
            <div class="container">
                <div class="sec_title sec_title-2">

                    <?php if(!empty( $settings['subtitle']  )) : ?>
                    <span><?php echo elh_element_kses_intermediate( $settings['subtitle'] ); ?></span>
                    <?php endif; ?>

                    <?php if(!empty( $settings['title']  )) : ?>
                    <h2><?php echo elh_element_kses_intermediate( $settings['title'] ); ?></h2>
                    <?php endif; ?>

                </div>
                <div class="row justify-content-md-center">
                    <?php
                        if (!empty($posts)):

                        foreach ( $posts as $inx => $post ):
                        $categories = get_the_category( $post->ID );
                        $author_bio_avatar_size = 35;
                        if ('yes' === $settings['feature_image']) {
                            $feature_img = get_the_post_thumbnail_url(get_the_ID(), $settings['thumbnail_size']);
                        }
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="blog_single blog_single_1 mb-30">
                            <div class="blog_text mb-40">
                                <?php if ( 'yes' === $settings['date_meta'] ): ?>
                                <span class="date"><?php print get_the_date( "M d, Y" ); ?></span>
                                <?php endif; ?>

                                <?php $title = $post->post_title;
                                    if ( 'selected' === $settings['show_post_by'] && array_key_exists( $post->ID, $customize_title ) ) {
                                        $title = $customize_title[$post->ID];
                                    }
                                ?>
                                <h3 class="title">
                                    <a href="<?php echo esc_url(get_the_permalink( $post->ID )); ?>"><?php echo esc_html($title); ?></a>
                                </h3>
                            </div>

                            <?php if ( 'yes' === $settings['feature_image'] || has_post_thumbnail() ): ?>
                            <div class="blog_thumb">
                                <a href="<?php echo esc_url(get_the_permalink( $post->ID )); ?>">
                                    <?php echo get_the_post_thumbnail( $post->ID, $settings['thumbnail_size'] ); ?>
                                </a>
                            </div>
                            <?php endif; ?>

                            <?php if(!empty( $settings['readmore_text'] )) : ?>
                            <div class="blog_btn mt-20">
                                <a href="<?php echo esc_url(get_the_permalink( $post->ID )); ?>">
                                    <i class="far fa-long-arrow-right"></i> <?php echo esc_html($settings['readmore_text']); ?></a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach;
                        else:
                            printf('%1$s %2$s %3$s',
                                __('No ', 'elementhelper'),
                                esc_html($settings['post_type']),
                                __('Found', 'elementhelper')
                            );
                        endif;
                    ?>
                </div>
                <?php if(!empty( $settings['button_link']['url'] )) : ?>
                <div class="row">
                    <div class="col-12">
                        <div class="ca_btn text-center pt-20">
                            <a class="thm_btn thm_btn-2" href="<?php echo esc_url($settings['button_link']['url']); ?>"><?php echo esc_html($settings['button_text']); ?></a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </section>

        <?php endif;
    }
}
