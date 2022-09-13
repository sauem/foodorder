<?php

namespace ElementHelper\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Core\Schemes;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use \ElementHelper\Element_El_Select2;

defined('ABSPATH') || die();


class Woo_Product_Slider extends Element_El_Widget
{

    /**
     * Get widget name.
     *
     * Retrieve Bdevs Element widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'woo_product_slider';
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
        return __('Woo Product Slider', 'elementhelper');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.sabber.net//widgets/post-tab/';
    }

    public function get_script_depends() {
		return ['tmx-elh_product_slide'];
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
        return 'eicon-slider-3d elh-widget-icon';
    }

    public function get_keywords()
    {
        return ['posts', 'post', 'post-tab', 'tab', 'news'];
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
            'page' => ''
        ];
        $post_types = elh_element_get_post_types([], $diff_key);

        return $post_types;
    }

    /**
     * Get a list of Taxonomy
     *
     * @return array
     */
    public static function get_taxonomies($post_type = '')
    {
        $list = [];
        if ($post_type) {
            $tax = elh_element_get_taxonomies([
                'public' => true,
                "object_type" => [$post_type]
            ], 'object', true);
            $list[$post_type] = count($tax) !== 0 ? $tax : '';
        } else {
            $list = elh_element_get_taxonomies(['public' => true], 'object', true);
        }

        return $list;
    }

    protected function register_content_controls() {

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
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Heading Title',
                'placeholder' => __('Heading Text', 'elementhelper'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_post_tab_query',
            [
                'label' => __('Product Options', 'elementhelper'),
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

        foreach (self::get_post_types() as $key => $value) {
            $taxonomy = self::get_taxonomies($key);
            if (!$taxonomy[$key]) {
                continue;
            }
            $this->add_control(
                'tax_type_' . $key,
                [
                    'label' => __('Taxonomies', 'elementhelper'),
                    'type' => Controls_Manager::SELECT,
                    'options' => $taxonomy[$key],
                    'default' => key($taxonomy[$key]),
                    'condition' => [
                        'post_type' => $key
                    ],
                ]
            );

            foreach ($taxonomy[$key] as $tax_key => $tax_value) {

                $this->add_control(
                    'tax_ids_' . $tax_key,
                    [
                        'label' => __('Select ', 'elementhelper') . $tax_value,
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
                'label' => __('Item Limit', 'elementhelper'),
                'type' => Controls_Manager::NUMBER,
                'default' => -1,
                'dynamic' => ['active' => true],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_button',
            [
                'label' => __('Button Option', 'elementhelper'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'btn_text',
			[
				'label' => esc_html__( 'Button Text', 'azedw-core' ),
				'default' => esc_html__( 'VIEW ALL ITEMS', 'azedw-core' ),
				'placeholder' => esc_html__( 'Type button Text here', 'azedw-core' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$this->add_control(
			'btn_link',
			[
				'label' => esc_html__( 'Button Link', 'azedw-core' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://your-link.com',
				'default' => [
					'url' => '',
				],
				'label_block' => true,
			]
		);

        $this->end_controls_section();
    }

    protected function register_style_controls()
    {

        //Title Style
        $this->start_controls_section(
            '_section_post_list_title_style',
            [
                'label' => __('Heading Style', 'elementhelper'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title-s2 h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'elementhelper'),
                'scheme' => Schemes\Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .section-title-s2 h2',
            ]
        );

        $this->end_controls_section();

        //Button Style
        $this->start_controls_section(
            '_section_button_style',
            [
                'label' => __('Button Style', 'elementhelper'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'btn_color',
            [
                'label' => __('Button Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trendy-product-section .more-products' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_hover_color',
            [
                'label' => __('Button Hover Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trendy-product-section .more-products:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'label' => __('Typography', 'elementhelper'),
                'scheme' => Schemes\Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .trendy-product-section .more-products',
            ]
        );

        $this->end_controls_section();

        //Button Style
        $this->start_controls_section(
            '_section_product_style',
            [
                'label' => __('Product Style', 'elementhelper'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'product_title_color',
            [
                'label' => __('Title Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product-info h4 a' => 'color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'product_price_color',
            [
                'label' => __('Price Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .azedw-price-wrapper span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        if (!$settings['post_type']) {
            return;
        }

        $taxonomy = $settings['tax_type_' . $settings['post_type']];
        $terms_ids = $settings['tax_ids_' . $taxonomy];
        $terms_args = [
            'taxonomy' => $taxonomy,
            'hide_empty' => true,
            'include' => $terms_ids,
            'orderby' => 'term_id',
        ];
        $filter_list = get_terms($terms_args);

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
        $posts = get_posts($post_args);

        ?>
        <section class="trendy-product-section section-padding">
            <div class="container-1410">
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="section-title-s2">
                            <?php if(!empty($settings['title'])) : ?>
                                <h2><?php echo $settings['title']; ?></h2>
                            <?php endif; ?>
                        </div>

                        <?php if(!empty($settings['btn_text'])) : ?>
                        <a href="<?php echo esc_url($settings['btn_link']['url']); ?>" class="more-products">
                            <?php echo esc_html($settings['btn_text']); ?>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="products-wrapper">
                            <div class="products product-row-slider owl-carousel">
                            <?php foreach ($posts as $post): ?>
                                <div class="product">
                                    <div class="product-holder">
                                        <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                                            <?php echo get_the_post_thumbnail($post->ID, 'large', ['class' => 'img-fluid']); ?>
                                        </a>

                                        <div class="shop-action-wrap">
                                            <ul class="shop-action el-action-wrapper">
                                                <li><?php echo \ElementHelper\Element_El_Woocommerce::add_to_cart_button($post->ID); ?></li>
                                                <?php echo \ElementHelper\Element_El_Woocommerce::quick_view_button($post->ID); ?>
                                                <li><?php echo \ElementHelper\Element_El_Woocommerce::yith_wishlist($post->ID); ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <h4>
                                            <?php
                                                $title = $post->post_title;
                                                printf('<a href="%2$s">%1$s</a>',
                                                    esc_html($title),
                                                    esc_url(get_the_permalink($post->ID))
                                                );
                                            ?>
                                        </h4>
                                        <div class="azedw-price-wrapper">
                                            <?php print \ElementHelper\Element_El_Woocommerce::muskan_get_price($post->ID, true); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end container-1410 -->
        </section>
    <?php
    }
}
