<?php
namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use ElementHelperor\Controls\Select2;

defined( 'ABSPATH' ) || die();

class Woo_Product_Tab extends Element_El_Widget {

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
        return 'woo_product_tab';
    }

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_title () {
		return __( 'Product Tab', 'elementhelper' );
	}

	public function get_custom_help_url () {
		return 'http://elementor.sabber.net//widgets/post-tab/';
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_icon () {
		return 'elh-widget-icon eicon-post';
	}

	public function get_keywords () {
		return [ 'posts', 'post', 'post-tab', 'tab', 'news' ];
	}

	/**
	 * Get a list of All Post Types
	 *
	 * @return array
	 */
	public static function get_post_types () {
		$diff_key = [
			'elementor_library' => '',
			'attachment' => '',
			'page' => ''
		];
		$post_types = elh_element_get_post_types( [], $diff_key );
		return $post_types;
	}

	/**
	 * Get a list of Taxonomy
	 *
	 * @return array
	 */
	public static function get_taxonomies ( $post_type = '' ) {
		$list = [];
		if ( $post_type ) {
			$tax = elh_element_get_taxonomies( [ 'public' => true, "object_type" => [ $post_type ] ], 'object', true );
			$list[$post_type] = count( $tax ) !== 0 ? $tax : '';
		} else {
			$list = elh_element_get_taxonomies( [ 'public' => true ], 'object', true );
		}
		return $list;
	}

	protected function register_content_controls () {

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

        // section title
        $this->start_controls_section(
            '_section_title',
            [
                'label' => __( 'Title & Description', 'elementhelper' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'heading_switch',
            [
                'label' => __( 'Show', 'elementhelper' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'elementhelper' ),
                'label_off' => __( 'Hide', 'elementhelper' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __( 'Sub Title', 'elementhelper' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __( 'ElhInfo Box Sub Title', 'elementhelper' ),
                'placeholder' => __( 'Type Info Box Sub Title', 'elementhelper' ),
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
                'default' => __( 'ElhInfo Box Title', 'elementhelper' ),
                'placeholder' => __( 'Type Info Box Title', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'elementhelper' ),
                'description' => elh_element_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Elhinfo box description goes here', 'elementhelper' ),
                'placeholder' => __( 'Type info box description', 'elementhelper' ),
                'rows' => 5,
                'dynamic' => [
                    'active' => true,
				],
				'condition' => [
                    'design_style' => 'style_3'
                ],
            ]
        );

        $this->add_control(
            'sort_description',
            [
                'label' => __( 'Sort Description', 'elementhelper' ),
                'description' => elh_element_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Elhinfo box sort description goes here', 'elementhelper' ),
                'placeholder' => __( 'Type info box sort description', 'elementhelper' ),
                'rows' => 5,
                'condition' => [
                    'design_style' => 'style_3'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __( 'Title HTML Tag', 'elementhelper' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1'  => [
                        'title' => __( 'H1', 'elementhelper' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => __( 'H2', 'elementhelper' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => __( 'H3', 'elementhelper' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => __( 'H4', 'elementhelper' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => __( 'H5', 'elementhelper' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => __( 'H6', 'elementhelper' ),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'_section_post_tab_query',
			[
				'label' => __( 'Query', 'elementhelper' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'post_type',
			[
				'label' => __( 'Source', 'elementhelper' ),
				'type' => Controls_Manager::SELECT,
				'options' => $this->get_post_types(),
				'default' => key( $this->get_post_types() ),
			]
		);

		foreach ( self::get_post_types() as $key => $value ) {
			$taxonomy = self::get_taxonomies( $key );
			if ( ! $taxonomy[$key] )
				continue;
			$this->add_control(
				'tax_type_' . $key,
				[
					'label' => __( 'Taxonomies', 'elementhelper' ),
					'type' => Controls_Manager::SELECT,
					'options' => $taxonomy[$key],
					'default' => key( $taxonomy[$key] ),
					'condition' => [
						'post_type' => $key
					],
				]
			);

			foreach ( $taxonomy[$key] as $tax_key => $tax_value ) {

				$this->add_control(
					'tax_ids_' . $tax_key,
					[
						'label' => __( 'Select ', 'elementhelper' ) . $tax_value,
						'label_block' => true,
						'type' => 'elementhelper-select2',
						'multiple' => true,
						'placeholder' => 'Search ' . $tax_value,
						'data_options' => [
							'tax_id' => $tax_key,
							'action' => 'elh_element_post_tab_select_query'
						],
						'condition' => [
							'post_type' => $key,
							'tax_type_' . $key => $tax_key
						],
						'render_type' => 'template',
					]
				);
			}
		}

		$this->add_control(
			'item_limit',
			[
				'label' => __( 'Item Limit', 'elementhelper' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 3,
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->end_controls_section();

		//Settings
		$this->start_controls_section(
			'_section_settings',
			[
				'label' => __( 'Settings', 'elementhelper' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
                    'design_style' => ['style_3']
                ],
			]
		);


		$this->add_responsive_control(
			'column',
			[
				'label' => __( 'Column', 'elementhelper' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'1' => __( '1 Column', 'elementhelper' ),
					'2' => __( '2 Column', 'elementhelper' ),
					'3' => __( '3 Column', 'elementhelper' ),
					'4' => __( '4 Column', 'elementhelper' ),
					'5' => __( '5 Column', 'elementhelper' ),
					'6' => __( '6 Column', 'elementhelper' ),
				],
				'desktop_default' => '4',
				'tablet_default' => '3',
				'mobile_default' => '1',
				'selectors' => [
					'(desktop){{WRAPPER}} .elementhelper-post-tab .elementhelper-post-tab-item' => 'flex-basis: calc(100% / {{VALUE}});',
					'(tablet){{WRAPPER}} .elementhelper-post-tab .elementhelper-post-tab-item' => 'flex-basis: calc(100% / {{column_tablet.VALUE}});',
					'(mobile){{WRAPPER}} .elementhelper-post-tab .elementhelper-post-tab-item' => 'flex-basis: calc(100% / {{column_mobile.VALUE}});'
				],
				'render_type' => 'template',
				'style_transfer' => true,
				'condition' => [
                    'design_style' => ['style_3']
                ],
			]
		);

		$this->add_control(
			'excerpt',
			[
				'label' => __( 'Show Excerpt', 'elementhelper' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'elementhelper' ),
				'label_off' => __( 'Hide', 'elementhelper' ),
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
                    'design_style' => ['style_3']
                ],
			]
		);

		$this->add_control(
			'filter_pos',
			[
				'label' => __( 'Filter Position', 'elementhelper' ),
				'label_block' => false,
				'type' => Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elementhelper' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => __( 'Top', 'elementhelper' ),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => __( 'Right', 'elementhelper' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'style_transfer' => true,
				'condition' => [
                    'design_style' => ['style_3']
                ],
			]
		);

		$this->add_control(
			'filter_align',
			[
				'label' => __( 'Filter Align', 'elementhelper' ),
				'label_block' => false,
				'type' => Controls_Manager::CHOOSE,
				'default' => 'left',
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
				'condition' => [
					'filter_pos' => 'top',
				],
				'selectors' => [
					'{{WRAPPER}} .elementhelper-post-tab .elementhelper-post-tab-filter, .portfolio-menu' => 'text-align: {{VALUE}};',
				],
				'style_transfer' => true,
			]
		);


		$this->add_responsive_control(
			'event',
			[
				'label' => __( 'Tab action', 'elementhelper' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'click' => __( 'On Click', 'elementhelper' ),
					'hover' => __( 'On Hover', 'elementhelper' ),
				],
				'default' => 'click',
				'render_type' => 'template',
				'style_transfer' => true,
				'condition' => [
                    'design_style' => ['style_3']
                ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
            '_section_button',
            [
                'label' => __( 'Button', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
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
                    {{WRAPPER}} .sec_title > h2
                    ',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_nav',
            [
                'label' => __( 'Tab Menu', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tab_menu_color',
            [
                'label' => __( 'Tab Menu Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .masonry_active button' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .recipe_menu .nav-link' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tab_menu_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .masonry_active button,
                    {{WRAPPER}} .recipe_menu .nav-link
					',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

		$this->add_control(
            'tab_menu_hover_color',
            [
                'label' => __( 'Tab Menu Hover Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .masonry_active button.active' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .masonry_active button:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .recipe_menu .nav-link.active' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .recipe_menu .nav-link:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
            'tab_menu_hover_bg_color',
            [
                'label' => __( 'Tab Menu Hover Bg Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .masonry_active button.active' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .masonry_active button:hover' => 'background: {{VALUE}}',
					'{{WRAPPER}} .recipe_menu .nav-link.active' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .recipe_menu .nav-link:hover' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .recipe_menu .nav-link::before' => 'background: {{VALUE}}',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_history',
            [
                'label' => __( 'Product', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'product_cat',
            [
                'label' => __( 'Product Cat Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .shop_single .content .cat' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'product_cat_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .shop_single .content .cat',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_control(
            'product_rating_color',
            [
                'label' => __( 'Product Rating Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rating_star li' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'product_title_color',
            [
                'label' => __( 'Product Title Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .shop_single .content .title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .recipe_item .ri_content .ri_text h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'product_title_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .shop_single .content .title,
                    {{WRAPPER}} .recipe_item .ri_content .ri_text h3
					',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_control(
            'product_desc_color',
            [
                'label' => __( 'Product Description Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .recipe_item .ri_content .ri_text span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'product_desc_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .recipe_item .ri_content .ri_text span,
					',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_control(
            'product_price_color',
            [
                'label' => __( 'Product Price Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .shop_single .content .s_bottom span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .recipe_item .ri_content .ri_cart h5' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .recipe_item .ri_content .ri_cart h5 .old' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'product_price_typography',
                'label' => __('Typography', 'elementhelper'),
                'selector' => '
                    {{WRAPPER}} .recipe_item .ri_content .ri_cart h5 .old,
                    {{WRAPPER}} .shop_single .content .s_bottom span,
                    {{WRAPPER}} .recipe_item .ri_content .ri_cart h5
					',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

		$this->add_control(
            'product_action_color',
            [
                'label' => __( 'Product Action Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .shop_masonry_area .shop_single .actions .add_to_cart_button' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .shop_single .actions .action' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tab-icon-wrapper a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tab-icon-wrapper .yith-wcwl-add-to-wishlist' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
            'product_action_bg_color',
            [
                'label' => __( 'Product Action Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .shop_masonry_area .shop_single .actions .add_to_cart_button' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .shop_single .actions .action' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .tab-icon-wrapper a' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .tab-icon-wrapper .yith-wcwl-add-to-wishlist' => 'background: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
            'product_action_hover_color',
            [
                'label' => __( 'Product Action Hover Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .shop_masonry_area .shop_single .actions .add_to_cart_button:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .shop_single .actions .action:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tab-icon-wrapper a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tab-icon-wrapper .yith-wcwl-add-to-wishlist:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
            'product_action_hover_bg_color',
            [
                'label' => __( 'Product Action Hover Bg Color', 'elementhelper' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .shop_masonry_area .shop_single .actions .add_to_cart_button:hover' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .shop_single .actions .action:hover' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .tab-icon-wrapper a:hover' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .tab-icon-wrapper .yith-wcwl-add-to-wishlist:hover' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => __( 'Button Style', 'elementhelper' ),
                'tab'   => Controls_Manager::TAB_STYLE,
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

	protected function render () {

		$settings = $this->get_settings_for_display();

		$title = elh_element_kses_basic( $settings['title' ] );

		if ( ! $settings['post_type'] )
			return;

		$taxonomy = $settings['tax_type_' . $settings['post_type']];
		$terms_ids = $settings['tax_ids_' . $taxonomy];
		$terms_args = [
			'taxonomy' => $taxonomy,
			'hide_empty' => true,
			'include' => $terms_ids,
			'orderby' => 'term_id',
		];
		$filter_list = get_terms( $terms_args );


		$query_settings = [
			'post_type' => $settings['post_type'],
			'taxonomy' => $taxonomy,
			'item_limit' => $settings['item_limit'],
			'excerpt' => $settings['excerpt'] ? $settings['excerpt'] : 'no',
		];
		$query_settings = json_encode( $query_settings, true );

		$event = 'click';
		if ( 'hover' === $settings['event'] ) {
			$event = 'hover touchstart';
		}

		$wrapper_class = [
			'case__area',
			'project-' . $settings['filter_pos'],
			'project-grid-' . $settings['column'],
		];

		$this->add_render_attribute( 'wrapper', 'class', $wrapper_class );
		$this->add_render_attribute( 'wrapper', 'data-query-args', $query_settings );
		$this->add_render_attribute( 'wrapper', 'data-event', $event );
		$this->add_render_attribute( 'project-filter', 'class', [ 'portfolio-menu mb-10' ] );
		$this->add_render_attribute( 'project-body', 'class', [ 'row grid' ] );
		$i = 1;

		if ( !empty( $settings['design_style'] ) AND $settings['design_style'] == 'style_2' ):
		?>

		<section class="recipe_menu_area pt-120 pb-120 section_notch_top">
			<div class="container">
				<div class="sec_title sec_title-2">

					<?php if(!empty( $settings['sub_title'] )) : ?>
					<span><?php echo elh_element_kses_intermediate($settings['sub_title']); ?></span>
					<?php endif; ?>

					<?php if(!empty( $title )) : ?>
					<h2><?php echo elh_element_kses_intermediate($title); ?></h2>
					<?php endif; ?>

				</div>
				<div class="row">
					<div class="col-l2">
						<div class="recipe_menu_wrap">
							<ul class="nav nav-tabs recipe_menu" id="myTab" role="tablist">
								<?php $i = 1;
                                    $title_count = 0;
                                    foreach ($filter_list as $list):
                                    $title_count++;
                                    $title_active = '';
                                    if ( $title_count == 1 ) {
                                        $title_active = 'active';
                                    }

									$category = get_term_by('slug', ''.$list->name.'', 'product_cat');
                                ?>
								<li class="nav-item" role="presentation">
									<a href="#" class="nav-link <?php echo esc_attr( $title_active ); ?>" id="nav-tab-<?php echo esc_attr( $title_count ); ?>" data-bs-toggle="tab" data-bs-target="#tab-<?php echo esc_attr( $title_count ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $title_count ); ?>" aria-selected="true">

									<?php if( ! is_wp_error( $category ) && $category_icon = get_field('category_icon', $category ) ) : ?>
										<span class="icon">
											<img src="<?php echo esc_url($category_icon); ?>" alt="img">
										</span>
									<?php endif; ?>

										<span class="title"><?php echo esc_html($list->name); ?></span>
									</a>
								</li>
								<?php $i++; endforeach; ?>
							</ul>
							<div class="tab-content mt-70" id="myTabContent">
								<?php
                                    $i = 1;
                                    $tab_count = 0;
                                    foreach ($filter_list as $list):
                                    $tab_count++;
                                    $tab_active = 'fade';
                                    if ( $tab_count == 1 ) {
                                        $tab_active = 'show active';
                                    }
                                ?>
								<div class="tab-pane fade <?php echo esc_attr( $tab_active ); ?>" id="tab-<?php echo esc_attr($tab_count); ?>" role="tabpanel" aria-labelledby="nav-tab-<?php echo esc_attr($tab_count); ?>">
									<?php
										$post_args = [
											'post_status' => 'publish',
											'post_type' => $settings['post_type'],
											'posts_per_page' => $settings['item_limit'],
											'tax_query' => array(
												array(
													'taxonomy' => $taxonomy,
													'field' => 'term_id',
													'terms' => !empty($list->term_id) ? $list->term_id : '',
												),
											),
										];
										$posts = get_posts($post_args);
									?>
									<?php foreach ($posts as $post):

										$product_short_desc = function_exists('get_field') ? get_field('product_short_desc', $post->ID) : '';

									?>
									<div class="recipe_item">
										<div class="ri_img">
											<?php echo get_the_post_thumbnail($post->ID, 'large', ['class' => 'img-fluid']); ?>
										</div>
										<div class="ri_content">
											<div class="ri_text">
												<h3>
													<?php
														$title = $post->post_title;
														printf('<a href="%2$s">%1$s</a>',
															esc_html($title),
															esc_url(get_the_permalink($post->ID))
														);

													?>
												</h3>
												<?php if(!empty( $product_short_desc )) : ?>
												<span><?php echo esc_html($product_short_desc); ?></span>
												<?php endif; ?>
											</div>
											<div class="ri_cart">

												<?php print \ElementHelper\Element_El_Woocommerce::product_price($post->ID, true); ?>

												<div class="tab-icon-wrapper">
													<?php echo \ElementHelper\Element_El_Woocommerce::yith_wishlist($post->ID, true); ?>
													<?php echo \ElementHelper\Element_El_Woocommerce::add_to_cart_button($post->ID, true); ?>
												</div>
											</div>
										</div>
									</div>
									<?php endforeach; ?>
								</div>
								<?php $i++; endforeach; ?>
							</div>
							<?php if ( $settings['button_text'] ) : ?>
							<div class="lm_btn text-center mt-50">
								<a class="thm_btn thm_btn-2" href="<?php echo esc_url($settings['button_link']['url']); ?>">
									<?php echo esc_html($settings['button_text']); ?></a>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php
			else:


		$post_args = [
			'post_status' => 'publish',
			'post_type' => $settings['post_type'],
			'posts_per_page' => $settings['item_limit'],
			'tax_query' => array(
				array(
					'taxonomy' => $taxonomy,
					'field' => 'term_id',
					'terms' => $terms_ids ? $terms_ids : '',
				),
			),
		];

		$posts = query_posts( $post_args );
			if ( !empty($terms_ids) && count( $posts ) !== 0 ) :
		?>

        <section class="shop_masonry_area pt-120 pb-120">
            <div class="container">
                <div class="sec_title sec_title-2">

					<?php if(!empty( $settings['sub_title'] )) : ?>
					<span><?php echo elh_element_kses_intermediate($settings['sub_title']); ?></span>
					<?php endif; ?>

					<?php if(!empty( $title )) : ?>
					<h2><?php echo elh_element_kses_intermediate($title); ?></h2>
					<?php endif; ?>

                </div>
                <div class="row">
                    <div class="masonry_active text-center mb-40">
                    <?php foreach ( $filter_list as $list ): ?>
                        <?php if ( $i === 1 ): $i++; ?>
                        <button class="active" data-filter="*">all categories</button>
                        <button data-filter=".<?php echo esc_attr( $list->slug ); ?>"><?php echo esc_html( $list->name ); ?></button>

                        <?php else: ?>
                        <button data-filter=".<?php echo esc_attr( $list->slug ); ?>"><?php echo esc_html( $list->name ); ?></button>
                        <?php endif; ?>
						<?php endforeach; ?>
                    </div>
                </div>
                <div class="row grid">
                <?php
					if ( have_posts() ) : while ( have_posts() ) : the_post();
						$cases_author_name = function_exists('get_field') ? get_field('cases_author_name') : '';
						$feature_image = function_exists('get_field') ? get_field('feature_image') : '';
						$item_classes = '';
						$item_cat_names = '';
						$item_cats = get_the_terms( get_the_id(), $taxonomy );
						if( !empty($item_cats) ):
							$count = count($item_cats) - 1;
							foreach($item_cats as $key => $item_cat) {
								$item_classes .= $item_cat->slug . ' ';
								$item_cat_names .= ( $count > $key ) ? $item_cat->name  . ', ' : $item_cat->name;
							}
						endif;
					?>
                    <div class="col-lg-4 col-md-6 col-sm-6 grid-item mb-30 <?php echo $item_classes; ?>">
                        <div class="shop_single white_bg">
                            <div class="thumb text-center">
                                <?php if ( has_post_thumbnail() ): ?>
                                <a class="image" href="<?php the_permalink(); ?>">
                                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="img">
                                </a>
                                <?php endif; ?>
                                <div class="actions">
                                    <?php echo \ElementHelper\Element_El_Woocommerce::add_to_cart_button(get_the_ID()); ?>
                                    <?php echo \ElementHelper\Element_El_Woocommerce::yith_wishlist(get_the_ID()); ?>
                                    <?php echo \ElementHelper\Element_El_Woocommerce::quick_view_button(get_the_ID()); ?>
                                </div>
                            </div>
                            <div class="content">
                                <div class="s_top ul_li">
                                    <span class="cat"><?php echo $item_cat_names; ?></span>
                                    <?php print \ElementHelper\Element_El_Woocommerce::product_rating(get_the_ID()); ?>
                                </div>
                                <h3 class="title">
                                <?php
                                    $title = get_the_title();
                                    printf('<a href="%2$s">%1$s</a>',
                                        esc_html($title),
                                        esc_url(get_the_permalink(get_the_ID()))
                                    );
                                ?>
                                </h3>
                                <div class="s_bottom ul_li">
                                    <span>Price -</span>
                                    <?php print \ElementHelper\Element_El_Woocommerce::frudbaz_get_price(get_the_ID(), true); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile;
						wp_reset_query();
					endif; ?>
                </div>
                <?php if ( $settings['button_text'] ) : ?>
                <div class="row">
                    <div class="col-12">
                        <div class="ca_btn text-center pt-20">
                            <a class="thm_btn thm_btn-2" href="<?php echo esc_url($settings['button_link']['url']); ?>">
                                <?php echo esc_html($settings['button_text']); ?></a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </section>

		<?php else:
			printf( '%1$s',
				__( 'No  Posts  Found', 'elementhelper' )
			);
		endif;
		endif;


	}
}
