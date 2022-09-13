<?php

namespace ElementHelper\Widget;

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
use Elementor\Utils;
Use \Elementor\Core\Schemes\Typography;

defined('ABSPATH') || die();

class Woo_Product extends Element_El_Widget {

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
        return 'woo_product';
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
        return __('Woo Product', 'elementhelper');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.sabber.net/widgets/product/';
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
        return 'eicon-product-images elh-widget-icon';
    }

    public function get_keywords()
    {
        return ['posts', 'post', 'post-list', 'list', 'product'];
    }

    public function get_script_depends() {
		return ['elh_woo_product'];
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
				'label' => esc_html__( 'Design Style', 'elementhelper' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style_1' => esc_html__( 'Style One: Home 1', 'elementhelper' ),
					'style_2' => esc_html__( 'Style Two: Home 2', 'elementhelper' ),
					'style_3' => esc_html__( 'Style Three: Home 3', 'elementhelper' ),
					'style_4' => esc_html__( 'Style Four: Home 4', 'elementhelper' ),
					'style_5' => esc_html__( 'Style Four: Carousel Home 6', 'elementhelper' ),
				],
				'default' => 'style_1',
				'description' => esc_html__( 'Select your Design style.', 'elementhelper' ),
			]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'section_tabs',
			[
				'label' => esc_html__( 'Title & Description', 'elementhelper' ),
			]
		);
		$this->add_control(
			'subtitle',
			[
				'label' => esc_html__( 'Sub Title', 'elementhelper' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'LATEST STYLE', 'elementhelper' ),
                'condition' => [
                    'design_style' => ['style_1', 'style_2', 'style_3', 'style_4']
                ]
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'elementhelper' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Trending Items.', 'elementhelper' ),
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_post_list',
            [
                'label' => __('Products', 'elementhelper'),
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
                'label' => __('Show product by:', 'elementhelper'),
                'type' => Controls_Manager::SELECT,
                'default' => 'recent',
                'options' => [
                    'recent' => __('Recent Product', 'elementhelper'),
                    'selected' => __('Selected Product', 'elementhelper'),
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


        $this->start_controls_section(
			'section_settings',
			[
				'label' => esc_html__( 'Settings', 'elementhelper' ),
			]
		);
		$this->add_control(
			'show_flip_img',
			[
				'label' => __( 'Show Image Flip', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'elementhelper' ),
				'label_off' => __( 'Hide', 'elementhelper' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->end_controls_section();

    }

    protected function register_style_controls(){

         //Title Style
         $this->start_controls_section(
            '_section_post_list_title_style',
            [
                'label' => __('Heading Style', 'elementhelper'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __('Sub Title Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title-s2 > span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .section-title-s3 > span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'label' => __('Typography', 'elementhelper'),
                'scheme' => Schemes\Typography::TYPOGRAPHY_2,
                'selector' => '
                    {{WRAPPER}} .section-title-s2 > span,
                    {{WRAPPER}} .section-title-s3 > span
                ',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title-s2 h2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .section-title-s3 h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'elementhelper'),
                'scheme' => Schemes\Typography::TYPOGRAPHY_2,
                'selector' => '
                    {{WRAPPER}} .section-title-s2 h2,
                    {{WRAPPER}} .section-title-s3 h2
                ',
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
            'product_discount_badge_color',
            [
                'label' => __('Discount Badge Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popular-products-section .product-holder .product-badge' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .shop-area .product-holder .product-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'product_discount_badge_bg_color',
            [
                'label' => __('Discount Badge Bg Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popular-products-section .product-holder .product-badge' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .shop-area .product-holder .product-badge' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'product_discount_typography',
                'label' => __('Typography', 'elementhelper'),
                'scheme' => Schemes\Typography::TYPOGRAPHY_2,
                'selector' => '
                    {{WRAPPER}} .popular-products-section .product-holder .product-badge,
                    {{WRAPPER}} .shop-area .product-holder .product-badge
                ',
            ]
        );

        $this->add_control(
            'product_new_badge_color',
            [
                'label' => __('New Badge Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popular-products-section .product-holder .product-badge.hot' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .shop-area .product-holder .product-badge.hot' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'product_new_badge_bg_color',
            [
                'label' => __('New Badge Bg Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popular-products-section .product-holder .product-badge.hot' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .shop-area .product-holder .product-badge.hot' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'product_new_typography',
                'label' => __('Typography', 'elementhelper'),
                'scheme' => Schemes\Typography::TYPOGRAPHY_2,
                'selector' => '
                    {{WRAPPER}} .popular-products-section .product-holder .product-badge.hot,
                    {{WRAPPER}} .shop-area .product-holder .product-badge.hot
                ',
            ]
        );

        $this->add_control(
            'product_title_color',
            [
                'label' => __('Title Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popular-products-section .product-info h4 a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .shop-area .product-info h4 a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'product_title_typography',
                'label' => __('Typography', 'elementhelper'),
                'scheme' => Schemes\Typography::TYPOGRAPHY_2,
                'selector' => '
                    {{WRAPPER}} .popular-products-section .product-info h4 a,
                    {{WRAPPER}} .shop-area .product-info h4 a
                ',
            ]
        );

        $this->add_control(
            'muskan_get_price_color',
            [
                'label' => __('Price Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popular-products-section .product-info ins' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .popular-products-section .product-info del' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .shop-area .product-info ins' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .shop-area .product-info del' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-info .woocommerce-Price-amount' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-info .woocommerce-Price-amount del bdi' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'muskan_get_price_typography',
                'label' => __('Typography', 'elementhelper'),
                'scheme' => Schemes\Typography::TYPOGRAPHY_2,
                'selector' => '
                    {{WRAPPER}} .popular-products-section .product-info ins,
                    {{WRAPPER}} .shop-area .product-info ins,
                    {{WRAPPER}} .product-info .woocommerce-Price-amount
                ',
            ]
        );

        $this->add_control(
            'product_review_color',
            [
                'label' => __('Review Text Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popular-products-section .product-info .rating > span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .shop-area .product-info .rating > span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'product_review_typography',
                'label' => __('Typography', 'elementhelper'),
                'scheme' => Schemes\Typography::TYPOGRAPHY_2,
                'selector' => '
                    {{WRAPPER}} .popular-products-section .product-info .rating > span,
                    {{WRAPPER}} .shop-area .product-info .rating > span
                ',
            ]
        );

        $this->add_control(
            'product_review_icon_color',
            [
                'label' => __('Review icon Color', 'elementhelper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popular-products-section .product-info .rating .fi:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .shop-area .product-info .rating .fi:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){

        $settings = $this->get_settings_for_display();

        if (!$settings['post_type']) return;
        $args = [
            'post_status' => 'publish',
            'post_type' => $settings['post_type'],
        ];
        if ('recent' === $settings['show_post_by']) {
            $args['posts_per_page'] = $settings['posts_per_page'];
        }

        $customize_title = [];
        $ids = [];
        if ('selected' === $settings['show_post_by']) {
            $args['posts_per_page'] = -1;
            $lists = $settings['selected_list_' . $settings['post_type']];
            if (!empty($lists)) {
                foreach ($lists as $index => $value) {
                    $ids[] = $value['post_id'];
                    if ($value['title']) $customize_title[$value['post_id']] = $value['title'];
                }
            }
            $args['post__in'] = (array)$ids;
            $args['orderby'] = 'post__in';
        }

        if ('selected' === $settings['show_post_by'] && empty($ids)) {
            $posts = [];
        } else {
            $posts = get_posts($args);
        }
        $sub_title = !empty( $settings['sub_title'] ) ? $settings['sub_title'] : '';
		$title = !empty( $settings['section_title'] ) ? $settings['section_title'] : '';
		$description = !empty( $settings['section_description'] ) ? $settings['section_description'] : '';

		$button_text = !empty( $settings['btn_text'] ) ? $settings['btn_text'] : '';
		$button_link = !empty( $settings['btn_link']['url'] ) ? $settings['btn_link']['url'] : '';
        $product_button_position = get_theme_mod( 'product_button_position' );
        if (!empty($settings['design_style']) and $settings['design_style'] == 'style_5'):
        if (count($posts) !== 0) :

        ?>
        <section class="medical-new-arrival-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-6 offset-lg-3">
                        <div class="section-title-s2">
                            <?php if(!empty( $settings['title'] )) : ?>
                            <h2><?php echo elh_element_kses_basic( $settings['title'] ); ?></h2>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-xs-12">
                        <div class="shop-area <?php echo esc_attr($product_button_position); ?>">
                            <ul class="products clearfix owl-carousel four-col-slider">
                                <?php foreach ($posts as $key => $post):
                                    $product_label = function_exists('get_field') ? get_field('product_label', $post->ID) : '';
                                    $product_discount = function_exists('get_field') ? get_field('product_discount', $post->ID) : '';

                                    global $product;
                                    if( is_a($product, 'WC_Product'));
                                        $product = wc_get_product($post->ID);

                                    // Get the array of the gallery attachement IDs
                                    $attachment_ids = $product->get_gallery_image_ids();

                                    if( sizeof($attachment_ids) > 0 ){
                                        $first_attachment_id = reset($attachment_ids);
                                        $gallery_image = wp_get_attachment_image_src( $first_attachment_id, 'full' )[0];
                                    }
                                ?>
                                <li class="product">
                                    <div class="product-holder">

                                        <?php if(!empty( $product_discount )) : ?>
                                            <div class="product-badge discount">-<?php echo esc_html($product_discount); ?>%</div>
                                        <?php endif; ?>

                                        <?php if(!empty( $product_label )) : ?>
                                            <div class="product-badge hot"><?php echo esc_html($product_label); ?></div>
                                        <?php endif; ?>

                                        <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                                            <div>
                                                <?php echo get_the_post_thumbnail($post->ID, 'large', ['class' => 'img-fluid']); ?>
                                            </div>

                                            <div>
                                                <?php if(!empty($settings['show_flip_img'] == true )) : ?>
                                                    <?php if(!empty( $gallery_image )) : ?>
                                                    <img src="<?php echo $gallery_image; ?>" alt="img">
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </a>

                                        <div class="shop-action-wrap">
                                            <ul class="shop-action">
                                                <li><?php echo \ElementHelper\Element_El_Woocommerce::quick_view_button($post->ID); ?></li>
                                                <li><?php echo \ElementHelper\Element_El_Woocommerce::yith_wishlist($post->ID); ?></li>
                                                <li><?php echo \ElementHelper\Element_El_Woocommerce::add_to_cart_button($post->ID); ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <h4>
                                            <?php
                                                $title = $post->post_title;
                                                if ('selected' === $settings['show_post_by'] && array_key_exists($post->ID, $customize_title)) {
                                                    $title = $customize_title[$post->ID];
                                                }

                                                printf('<a href="%2$s">%1$s</a>',
                                                    esc_html($title),
                                                    esc_url(get_the_permalink($post->ID))
                                                );
                                            ?>
                                        </h4>
                                        <?php print \ElementHelper\Element_El_Woocommerce::product_rating($post->ID); ?>
                                        <span class="woocommerce-Price-amount amount">
                                            <ins><?php print \ElementHelper\Element_El_Woocommerce::muskan_get_price($post->ID, true); ?></ins>
                                        </span>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>
        <!-- end medical-new-arrival-section -->
        <?php
        else:
            printf('%1$s %2$s %3$s',
                __('No ', 'elementhelper'),
                esc_html($settings['post_type']),
                __('Found', 'elementhelper')
            );
        endif;
        elseif (!empty($settings['design_style']) and $settings['design_style'] == 'style_4'):
        if (count($posts) !== 0) :
        ?>

        <section class="baby-product-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-6 offset-lg-3">
                        <div class="section-title-s3">

                            <?php if(!empty( $settings['subtitle'] )) : ?>
                            <span><?php echo elh_element_kses_basic( $settings['subtitle'] ); ?></span>
                            <?php endif; ?>

                            <?php if(!empty( $settings['title'] )) : ?>
                            <h2><?php echo elh_element_kses_basic( $settings['title'] ); ?></h2>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-xs-12">
                        <div class="shop-area <?php echo esc_attr($product_button_position); ?>">
                            <ul class="products clearfix">
                                <?php foreach ($posts as $key => $post):
                                    $product_label = function_exists('get_field') ? get_field('product_label', $post->ID) : '';
                                    $product_discount = function_exists('get_field') ? get_field('product_discount', $post->ID) : '';

                                    global $product;
                                    if( is_a($product, 'WC_Product'));
                                        $product = wc_get_product($post->ID);

                                    // Get the array of the gallery attachement IDs
                                    $attachment_ids = $product->get_gallery_image_ids();

                                    if( sizeof($attachment_ids) > 0 ){
                                        $first_attachment_id = reset($attachment_ids);
                                        $gallery_image = wp_get_attachment_image_src( $first_attachment_id, 'full' )[0];
                                    }
                                ?>
                                <li class="product">
                                    <div class="product-holder">

                                        <?php if(!empty( $product_discount )) : ?>
                                            <div class="product-badge discount">-<?php echo esc_html($product_discount); ?>%</div>
                                        <?php endif; ?>

                                        <?php if(!empty( $product_label )) : ?>
                                            <div class="product-badge hot"><?php echo esc_html($product_label); ?></div>
                                        <?php endif; ?>

                                        <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                                            <div>
                                                <?php echo get_the_post_thumbnail($post->ID, 'large', ['class' => 'img-fluid']); ?>
                                            </div>

                                            <div>
                                                <?php if(!empty($settings['show_flip_img'] == true )) : ?>
                                                    <?php if(!empty( $gallery_image )) : ?>
                                                    <img src="<?php echo $gallery_image; ?>" alt="img">
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </a>
                                        <div class="shop-action-wrap">
                                            <ul class="shop-action">
                                                <li><?php echo \ElementHelper\Element_El_Woocommerce::quick_view_button($post->ID); ?></li>
                                                <li><?php echo \ElementHelper\Element_El_Woocommerce::yith_wishlist($post->ID); ?></li>
                                                <li><?php echo \ElementHelper\Element_El_Woocommerce::add_to_cart_button($post->ID); ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <h4>
                                            <?php
                                                $title = $post->post_title;
                                                if ('selected' === $settings['show_post_by'] && array_key_exists($post->ID, $customize_title)) {
                                                    $title = $customize_title[$post->ID];
                                                }

                                                printf('<a href="%2$s">%1$s</a>',
                                                    esc_html($title),
                                                    esc_url(get_the_permalink($post->ID))
                                                );
                                            ?>
                                        </h4>
                                        <?php print \ElementHelper\Element_El_Woocommerce::product_rating($post->ID); ?>
                                        <span class="woocommerce-Price-amount amount">
                                            <ins><?php print \ElementHelper\Element_El_Woocommerce::muskan_get_price($post->ID, true); ?></ins>
                                        </span>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>
        <?php
        else:
            printf('%1$s %2$s %3$s',
                __('No ', 'elementhelper'),
                esc_html($settings['post_type']),
                __('Found', 'elementhelper')
            );
        endif;
        elseif (!empty($settings['design_style']) and $settings['design_style'] == 'style_3'):
        if (count($posts) !== 0) :
        ?>
        <section class="baby-product-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-6 offset-lg-3">
                        <div class="section-title-s3">

                            <?php if(!empty( $settings['subtitle'] )) : ?>
                            <span><?php echo elh_element_kses_basic( $settings['subtitle'] ); ?></span>
                            <?php endif; ?>

                            <?php if(!empty( $settings['title'] )) : ?>
                            <h2><?php echo elh_element_kses_basic( $settings['title'] ); ?></h2>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-xs-12">
                        <div class="shop-area <?php echo esc_attr($product_button_position); ?>">
                            <ul class="products clearfix">
                                <?php foreach ($posts as $key => $post):
                                    $product_label = function_exists('get_field') ? get_field('product_label', $post->ID) : '';
                                    $product_discount = function_exists('get_field') ? get_field('product_discount', $post->ID) : '';

                                    global $product;
                                    if( is_a($product, 'WC_Product'));
                                        $product = wc_get_product($post->ID);

                                    // Get the array of the gallery attachement IDs
                                    $attachment_ids = $product->get_gallery_image_ids();

                                    if( sizeof($attachment_ids) > 0 ){
                                        $first_attachment_id = reset($attachment_ids);
                                        $gallery_image = wp_get_attachment_image_src( $first_attachment_id, 'full' )[0];
                                    }
                                ?>
                                <li class="product">
                                    <div class="product-holder">

                                        <?php if(!empty( $product_discount )) : ?>
                                            <div class="product-badge discount">-<?php echo esc_html($product_discount); ?>%</div>
                                        <?php endif; ?>

                                        <?php if(!empty( $product_label )) : ?>
                                            <div class="product-badge hot"><?php echo esc_html($product_label); ?></div>
                                        <?php endif; ?>

                                        <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                                            <div>
                                                <?php echo get_the_post_thumbnail($post->ID, 'large', ['class' => 'img-fluid']); ?>
                                            </div>

                                            <div>
                                                <?php if(!empty($settings['show_flip_img'] == true )) : ?>
                                                    <?php if(!empty( $gallery_image )) : ?>
                                                    <img src="<?php echo $gallery_image; ?>" alt="img">
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </a>
                                        <div class="shop-action-wrap">
                                            <ul class="shop-action">
                                                <li><?php echo \ElementHelper\Element_El_Woocommerce::quick_view_button($post->ID); ?></li>
                                                <li><?php echo \ElementHelper\Element_El_Woocommerce::yith_wishlist($post->ID); ?></li>
                                                <li><?php echo \ElementHelper\Element_El_Woocommerce::add_to_cart_button($post->ID); ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <h4>
                                            <?php
                                                $title = $post->post_title;
                                                if ('selected' === $settings['show_post_by'] && array_key_exists($post->ID, $customize_title)) {
                                                    $title = $customize_title[$post->ID];
                                                }

                                                printf('<a href="%2$s">%1$s</a>',
                                                    esc_html($title),
                                                    esc_url(get_the_permalink($post->ID))
                                                );
                                            ?>
                                        </h4>
                                        <?php print \ElementHelper\Element_El_Woocommerce::product_rating($post->ID); ?>
                                        <span class="woocommerce-Price-amount amount">
                                            <ins><?php print \ElementHelper\Element_El_Woocommerce::muskan_get_price($post->ID, true); ?></ins>
                                        </span>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>
        <!-- end baby-product-section -->
        <?php
        else:
            printf('%1$s %2$s %3$s',
                __('No ', 'elementhelper'),
                esc_html($settings['post_type']),
                __('Found', 'elementhelper')
            );
        endif;
        ?>

    <?php elseif (!empty($settings['design_style']) and $settings['design_style'] == 'style_2'): ?>
        <?php if (count($posts) !== 0) : ?>

        <!-- start fur-product-section -->
        <section class="fur-product-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-6 offset-lg-3">
                        <div class="section-title-s3">

                            <?php if(!empty( $settings['subtitle'] )) : ?>
                            <span><?php echo elh_element_kses_basic( $settings['subtitle'] ); ?></span>
                            <?php endif; ?>

                            <?php if(!empty( $settings['title'] )) : ?>
                            <h2><?php echo elh_element_kses_basic( $settings['title'] ); ?></h2>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-xs-12">
                        <div class="shop-area <?php echo esc_attr($product_button_position); ?>">
                            <ul class="products clearfix">
                                <?php foreach ($posts as $key => $post):
                                    $product_label = function_exists('get_field') ? get_field('product_label', $post->ID) : '';
                                    $product_discount = function_exists('get_field') ? get_field('product_discount', $post->ID) : '';

                                    global $product;
                                    if( is_a($product, 'WC_Product'));
                                        $product = wc_get_product($post->ID);

                                    // Get the array of the gallery attachement IDs
                                    $attachment_ids = $product->get_gallery_image_ids();

                                    if( sizeof($attachment_ids) > 0 ){
                                        $first_attachment_id = reset($attachment_ids);
                                        $gallery_image = wp_get_attachment_image_src( $first_attachment_id, 'full' )[0];
                                    }
                                ?>
                                <li class="product">
                                    <div class="product-holder">

                                        <?php if(!empty( $product_discount )) : ?>
                                            <div class="product-badge discount">-<?php echo esc_html($product_discount); ?>%</div>
                                        <?php endif; ?>

                                        <?php if(!empty( $product_label )) : ?>
                                            <div class="product-badge hot"><?php echo esc_html($product_label); ?></div>
                                        <?php endif; ?>

                                        <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                                            <div>
                                                <?php echo get_the_post_thumbnail($post->ID, 'large', ['class' => 'img-fluid']); ?>
                                            </div>

                                            <div>
                                                <?php if(!empty($settings['show_flip_img'] == true )) : ?>
                                                    <?php if(!empty( $gallery_image )) : ?>
                                                    <img src="<?php echo $gallery_image; ?>" alt="img">
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </a>

                                        <div class="shop-action-wrap">
                                            <ul class="shop-action">
                                                <li><?php echo \ElementHelper\Element_El_Woocommerce::quick_view_button($post->ID); ?></li>
                                                <li><?php echo \ElementHelper\Element_El_Woocommerce::yith_wishlist($post->ID); ?></li>
                                                <li><?php echo \ElementHelper\Element_El_Woocommerce::add_to_cart_button($post->ID); ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <h4>
                                            <?php
                                                $title = $post->post_title;
                                                if ('selected' === $settings['show_post_by'] && array_key_exists($post->ID, $customize_title)) {
                                                    $title = $customize_title[$post->ID];
                                                }

                                                printf('<a href="%2$s">%1$s</a>',
                                                    esc_html($title),
                                                    esc_url(get_the_permalink($post->ID))
                                                );
                                            ?>
                                        </h4>
                                        <?php print \ElementHelper\Element_El_Woocommerce::product_rating($post->ID); ?>
                                        <span class="woocommerce-Price-amount amount">
                                            <ins><?php print \ElementHelper\Element_El_Woocommerce::muskan_get_price($post->ID, true); ?></ins>
                                        </span>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>
        <!-- end fur-product-section -->

        <?php
        else:
            printf('%1$s %2$s %3$s',
                __('No ', 'elementhelper'),
                esc_html($settings['post_type']),
                __('Found', 'elementhelper')
            );
        endif;
        ?>
    <?php else: ?>
        <?php if (count($posts) !== 0) : ?>
        <section class="popular-products-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-6 offset-lg-3">
                        <div class="section-title-s2">

                            <?php if(!empty( $settings['subtitle'] )) : ?>
                            <span><?php echo elh_element_kses_basic( $settings['subtitle'] ); ?></span>
                            <?php endif; ?>

                            <?php if(!empty( $settings['title'] )) : ?>
                            <h2><?php echo elh_element_kses_basic( $settings['title'] ); ?></h2>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-xs-12">
                        <div class="shop-area <?php echo esc_attr($product_button_position); ?>">
                            <ul class="products clearfix">
                                <?php foreach ($posts as $key => $post):
                                    $product_label = function_exists('get_field') ? get_field('product_label', $post->ID) : '';
                                    $product_discount = function_exists('get_field') ? get_field('product_discount', $post->ID) : '';

                                    global $product;
                                    if( is_a($product, 'WC_Product'));
                                        $product = wc_get_product($post->ID);

                                    // Get the array of the gallery attachement IDs
                                    $attachment_ids = $product->get_gallery_image_ids();

                                    if( sizeof($attachment_ids) > 0 ){
                                        $first_attachment_id = reset($attachment_ids);
                                        $gallery_image = wp_get_attachment_image_src( $first_attachment_id, 'full' )[0];
                                    }

                                ?>
                                <li class="product">
                                    <div class="product-holder">

                                        <?php if(!empty( $product_discount )) : ?>
                                            <div class="product-badge discount">-<?php echo esc_html($product_discount); ?>%</div>
                                        <?php endif; ?>

                                        <?php if(!empty( $product_label )) : ?>
                                            <div class="product-badge hot"><?php echo esc_html($product_label); ?></div>
                                        <?php endif; ?>

                                        <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                                            <div>
                                                <?php echo get_the_post_thumbnail($post->ID, 'large', ['class' => 'img-fluid']); ?>
                                            </div>

                                            <div>
                                                <?php if(!empty($settings['show_flip_img'] == true )) : ?>
                                                    <?php if(!empty( $gallery_image )) : ?>
                                                    <img src="<?php echo $gallery_image; ?>" alt="img">
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </a>

                                        <div class="shop-action-wrap">
                                            <ul class="shop-action">
                                                <li><?php echo \ElementHelper\Element_El_Woocommerce::quick_view_button($post->ID); ?></li>
                                                <li><?php echo \ElementHelper\Element_El_Woocommerce::yith_wishlist($post->ID); ?></li>
                                                <li><?php echo \ElementHelper\Element_El_Woocommerce::add_to_cart_button($post->ID); ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <h4>
                                            <?php
                                                $title = $post->post_title;
                                                if ('selected' === $settings['show_post_by'] && array_key_exists($post->ID, $customize_title)) {
                                                    $title = $customize_title[$post->ID];
                                                }

                                                printf('<a href="%2$s">%1$s</a>',
                                                    esc_html($title),
                                                    esc_url(get_the_permalink($post->ID))
                                                );
                                            ?>
                                        </h4>
                                        <?php print \ElementHelper\Element_El_Woocommerce::product_rating($post->ID); ?>
                                        <span class="woocommerce-Price-amount amount">
                                            <ins><?php print \ElementHelper\Element_El_Woocommerce::muskan_get_price($post->ID, true); ?></ins>
                                        </span>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>
        <?php
        else:
            printf('%1$s %2$s %3$s',
                __('No ', 'elementhelper'),
                esc_html($settings['post_type']),
                __('Found', 'elementhelper')
            );
        endif;
        ?>
    <?php endif;
    }
}
