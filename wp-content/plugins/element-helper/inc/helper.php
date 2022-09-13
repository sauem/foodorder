<?php
namespace ElementHelper;

class Helper {

    /**
    * Get widgets list
    */
    public static function get_widgets() {

        return [
            'hero' => [
                'title' => __( 'Hero', 'elementhelper' ),
                'icon' => 'fa fa-time',
                'ispro' =>true
            ],

            'popular-menu' => [
                'title' => __( 'Popular Menu', 'elementhelper' ),
                'icon' => 'fa fa-time',
                'ispro' =>true
            ],

            'cta' => [
                'title' => __( 'CTA', 'elementhelper' ),
                'icon' => 'fa fa-time',
                'ispro' =>true
            ],

            'member-slider' => [
                'title' => __( 'Member', 'elementhelper' ),
                'icon' => 'fa fa-time',
                'ispro' =>true
            ],

            'testimonial-slider' => [
                'title' => __( 'Testimonial Slider', 'elementhelper' ),
                'icon' => 'fa fa-testimonial',
                'css' => ['testimonial'],
                'js' => [],
                'vendor' => [
                    'css' => [],
                    'js' => [],
                ],
            ],

            'post-list' => [
                'title' => __( 'Post List', 'elementhelper' ),
                'icon' => 'fa fa-post-list',
            ],

            'brand' => [
                'title' => __( 'Brand', 'elementhelper' ),
                'icon' => 'fa fa-card',
                'ispro' =>true
            ],

             'about' => [
                'title' => __( 'About', 'elementhelper' ),
                'icon' => 'fa fa-card',
                'ispro' =>true
            ],

            'reservation' => [
                'title' => __( 'Reservation', 'elementhelper' ),
                'icon' => 'fa fa-form',
            ],

             'contact-info' => [
                'title' => __( 'Contact Info', 'elementhelper' ),
                'icon' => 'fa fa-form',
            ],

             'history' => [
                'title' => __( 'History', 'elementhelper' ),
                'icon' => 'fa fa-card',
                'ispro' =>true
            ],

            'faq' => [
                'title' => __( 'Faq', 'elementhelper' ),
                'icon' => 'fa fa-time',
                'ispro' =>true
            ],

            // 'video-info' => [
            //     'title' => __( 'Video Info', 'elementhelper' ),
            //     'icon' => 'fa fa-time',
            //     'ispro' =>true
            // ],

            // 'featured-list' => [
            //     'title' => __( 'Featured List', 'elementhelper' ),
            //     'icon' => 'fa fa-team-member',
            // ],

            // 'testimonial-slider' => [
            //     'title' => __( 'Testimonial Slider', 'elementhelper' ),
            //     'icon' => 'fa fa-testimonial',
            //     'css' => ['testimonial'],
            //     'js' => [],
            //     'vendor' => [
            //         'css' => [],
            //         'js' => [],
            //     ],
            // ],

            // 'subscribe' => [
            //     'title' => __( 'Newslater', 'elementhelper' ),
            //     'icon' => 'fa fa-team-member',
            // ],

            // 'post-list' => [
            //     'title' => __( 'Post Grid', 'elementhelper' ),
            //     'icon' => 'fa fa-team-member',
            // ],

            // 'infobox' => [
            //     'title' => __( 'Info Box', 'elementhelper' ),
            //     'icon' => 'fa fa-team-member',
            // ],

            // 'cta-box' => [
            //     'title' => __( 'Cta Box', 'elementhelper' ),
            //     'icon' => 'fa fa-team-member',
            // ],

            // 'about-details' => [
            //     'title' => __( 'About Details', 'elementhelper' ),
            //     'icon' => 'fa fa-team-member',
            // ],

            // 'contact-info' => [
            //     'title' => __( 'Contact Info', 'elementhelper' ),
            //     'icon' => 'fa fa-form',
            // ],

            // 'skill' => [
            //     'title' => __( 'Skill', 'elementhelper' ),
            //     'icon' => 'fa fa-time',
            //     'ispro' =>true
            // ],

            // 'faq' => [
            //     'title' => __( 'FAQ', 'elementhelper' ),
            //     'icon' => 'fa fa-card',
            //     'ispro' =>true
            // ],



            // 'brand' => [
            //     'title' => __( 'Brand', 'elementhelper' ),
            //     'icon' => 'fa fa-card',
            //     'ispro' =>true
            // ],

            // 'services-tab' => [
            //     'title' => __( 'Services Tab', 'elementhelper' ),
            //     'icon' => 'fa fa-card',
            //     'ispro' =>true
            // ],

            // 'cf7-tab' => [
            //     'title' => __( 'Contact Form 7 Tab', 'elementhelper' ),
            //     'icon' => 'fa fa-form',
            //     'ispro' =>true
            // ],


            // 'heading' => [
            //     'title' => __( 'Heading Title', 'elementhelper' ),
            //     'icon' => 'fa fa-icon-box',
            // ],

            // 'icon-box' => [
            //     'title' => __( 'Icon Box', 'elementhelper' ),
            //     'icon' => 'fa fa-blog-content',
            // ],

            // 'infobox' => [
            //     'title' => __( 'Info Box', 'elementhelper' ),
            //     'icon' => 'fa fa-blog-content',
            // ],

            // 'member' => [
            //     'title' => __( 'Team Member', 'elementhelper' ),
            //     'icon' => 'fa fa-team-member',
            // ],

            // 'member-details' => [
            //     'title' => __( 'Member Details', 'elementhelper' ),
            //     'icon' => 'fa fa-team-member',
            // ],

            // 'author-box' => [
            //     'title' => __( 'Author Box', 'elementhelper' ),
            //     'icon' => 'fa fa-team-member',
            // ],

            // 'fact' => [
            //     'title' => __( 'Fact', 'elementhelper' ),
            //     'icon' => 'fa fa-team-member',
            // ],

            // 'pricing-table' => [
            //     'title' => __( 'Pricing Table', 'elementhelper' ),
            //     'icon' => 'fa fa-file-cabinet',
            // ],

            // 'job-list' => [
            //     'title' => __( 'Job List', 'elementhelper' ),
            //     'icon' => 'fa fa-flip-card',
            // ],

            // 'post-list' => [
            //     'title' => __( 'Post List', 'elementhelper' ),
            //     'icon' => 'fa fa-post-list',
            // ],

            // 'project-slider' => [
            //     'title' => __( 'Project Slider', 'elementhelper' ),
            //     'icon' => 'fa fa-post-tab',
            // ],

        ];
    }

    /**
    *  Get WooCommerce widgets list
    **/
    public static function get_woo_widgets() {

        return [
            // 'woo-product' => [
            //     'title' => __( 'Woo Product', 'elementhelper' ),
            //     'icon' => 'fa fa-card'
            // ],
            'woo-product-tab' => [
                'title' => __( 'Woo Product Tab', 'elementhelper' ),
                'icon' => 'fa fa-card'
            ],
            // 'woo-deal-product' => [
            //     'title' => __( 'Woo Deal Product', 'elementhelper' ),
            //     'icon' => 'fa fa-card'
            // ],
            // 'woo_shopcat' => [
            //     'title' => __( 'Woo Shop Category', 'elementhelper' ),
            //     'icon' => 'fa fa-card'
            // ]
        ];
    }
}
