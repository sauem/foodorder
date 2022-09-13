<?php
/**
 * frudbaz customizer
 *
 * @package frudbaz
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Added Panels & Sections
 */
function frudbaz_customizer_panels_sections( $wp_customize ) {

    //Add panel
    $wp_customize->add_panel( 'frudbaz_customizer', [
        'priority' => 10,
        'title'    => esc_html__( 'Frudbaz Customizer', 'frudbaz' ),
    ] );

    /**
     * Customizer Section
     */
    $wp_customize->add_section( 'header_top_setting', [
        'title'       => esc_html__( 'Header Top Options', 'frudbaz' ),
        'description' => '',
        'priority'    => 10,
        'capability'  => 'edit_theme_options',
        'panel'       => 'frudbaz_customizer',
    ] );

    $wp_customize->add_section( 'header_social', [
        'title'       => esc_html__( 'Header Social', 'frudbaz' ),
        'description' => '',
        'priority'    => 11,
        'capability'  => 'edit_theme_options',
        'panel'       => 'frudbaz_customizer',
    ] );

    $wp_customize->add_section( 'section_header_logo', [
        'title'       => esc_html__( 'Header Style & Logos', 'frudbaz' ),
        'description' => '',
        'priority'    => 12,
        'capability'  => 'edit_theme_options',
        'panel'       => 'frudbaz_customizer',
    ] );

    $wp_customize->add_section( 'blog_setting', [
        'title'       => esc_html__( 'Blog Setting', 'frudbaz' ),
        'description' => '',
        'priority'    => 13,
        'capability'  => 'edit_theme_options',
        'panel'       => 'frudbaz_customizer',
    ] );

    $wp_customize->add_section( 'header_side_setting', [
        'title'       => esc_html__( 'Side Info', 'frudbaz' ),
        'description' => '',
        'priority'    => 14,
        'capability'  => 'edit_theme_options',
        'panel'       => 'frudbaz_customizer',
    ] );

    $wp_customize->add_section( 'breadcrumb_setting', [
        'title'       => esc_html__( 'Breadcrumb Setting', 'frudbaz' ),
        'description' => '',
        'priority'    => 15,
        'capability'  => 'edit_theme_options',
        'panel'       => 'frudbaz_customizer',
    ] );

    $wp_customize->add_section( 'blog_setting', [
        'title'       => esc_html__( 'Blog Setting', 'frudbaz' ),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'frudbaz_customizer',
    ] );

    $wp_customize->add_section( 'footer_social', [
        'title'       => esc_html__( 'Footer Social', 'frudbaz' ),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'frudbaz_customizer',
    ] );

    $wp_customize->add_section( 'footer_setting', [
        'title'       => esc_html__( 'Footer Settings', 'frudbaz' ),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'frudbaz_customizer',
    ] );

    $wp_customize->add_section( 'color_setting', [
        'title'       => esc_html__( 'Color Setting', 'frudbaz' ),
        'description' => '',
        'priority'    => 17,
        'capability'  => 'edit_theme_options',
        'panel'       => 'frudbaz_customizer',
    ] );

    $wp_customize->add_section( '404_page', [
        'title'       => esc_html__( '404 Page', 'frudbaz' ),
        'description' => '',
        'priority'    => 18,
        'capability'  => 'edit_theme_options',
        'panel'       => 'frudbaz_customizer',
    ] );

    $wp_customize->add_section( 'rtl_setting', [
        'title'       => esc_html__( 'RTL Setting', 'frudbaz' ),
        'description' => '',
        'priority'    => 18,
        'capability'  => 'edit_theme_options',
        'panel'       => 'frudbaz_customizer',
    ] );

}

add_action( 'customize_register', 'frudbaz_customizer_panels_sections' );

function _header_top_fields( $fields ) {

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'frudbaz_topbar_switch',
        'label'    => esc_html__( 'Topbar Swicher', 'frudbaz' ),
        'section'  => 'header_top_setting',
        'default'  => 'off',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'frudbaz' ),
            'off' => esc_html__( 'Disable', 'frudbaz' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'frudbaz_header_lang',
        'label'    => esc_html__( 'Show Language', 'frudbaz' ),
        'section'  => 'header_top_setting',
        'default'  => 'off',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'frudbaz' ),
            'off' => esc_html__( 'Disable', 'frudbaz' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'frudbaz_preloader',
        'label'    => esc_html__( 'Preloader On/Off', 'frudbaz' ),
        'section'  => 'header_top_setting',
        'default'  => 'off',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'frudbaz' ),
            'off' => esc_html__( 'Disable', 'frudbaz' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'frudbaz_backtotop',
        'label'    => esc_html__( 'Back To Top On/Off', 'frudbaz' ),
        'section'  => 'header_top_setting',
        'default'  => 'off',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'frudbaz' ),
            'off' => esc_html__( 'Disable', 'frudbaz' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'frudbaz_header_right',
        'label'    => esc_html__( 'Header Right On/Off', 'frudbaz' ),
        'section'  => 'header_top_setting',
        'default'  => 'off',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'frudbaz' ),
            'off' => esc_html__( 'Disable', 'frudbaz' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'frudbaz_search',
        'label'    => esc_html__( 'Search On/Off', 'frudbaz' ),
        'section'  => 'header_top_setting',
        'default'  => 'off',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'frudbaz' ),
            'off' => esc_html__( 'Disable', 'frudbaz' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'frudbaz_cart',
        'label'    => esc_html__( 'Cart On/Off', 'frudbaz' ),
        'section'  => 'header_top_setting',
        'default'  => 'off',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'frudbaz' ),
            'off' => esc_html__( 'Disable', 'frudbaz' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'frudbaz_wishlist',
        'label'    => esc_html__( 'Wish List On/Off', 'frudbaz' ),
        'section'  => 'header_top_setting',
        'default'  => 'off',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'frudbaz' ),
            'off' => esc_html__( 'Disable', 'frudbaz' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'frudbaz_side_hide',
        'label'    => esc_html__( 'Side Info On/Off', 'frudbaz' ),
        'section'  => 'header_top_setting',
        'default'  => 'off',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'frudbaz' ),
            'off' => esc_html__( 'Disable', 'frudbaz' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'footer_top',
        'label'    => esc_html__( 'Footer Top', 'frudbaz' ),
        'section'  => 'header_top_setting',
        'default'  => 'off',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'frudbaz' ),
            'off' => esc_html__( 'Disable', 'frudbaz' ),
        ],
    ];

    $fields[] = [
        'type'            => 'text',
        'settings'        => 'frudbaz_phone',
        'label'           => esc_html__( 'Phone Number', 'frudbaz' ),
        'section'         => 'header_top_setting',
        'default'         => esc_html__( '+876 864 764 764', 'frudbaz' ),
        'priority'        => 10,
        'active_callback' => [
            [
                'setting'  => 'frudbaz_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'            => 'text',
        'settings'        => 'frudbaz_phone_label',
        'label'           => esc_html__( 'Label', 'frudbaz' ),
        'section'         => 'header_top_setting',
        'default'         => esc_html__( 'Phone Number', 'frudbaz' ),
        'priority'        => 10,
        'active_callback' => [
            [
                'setting'  => 'frudbaz_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'            => 'text',
        'settings'        => 'exp_year',
        'label'           => esc_html__( 'Year', 'frudbaz' ),
        'section'         => 'header_top_setting',
        'default'         => esc_html__( '20', 'frudbaz' ),
        'priority'        => 10,
        'active_callback' => [
            [
                'setting'  => 'frudbaz_expyr_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'            => 'text',
        'settings'        => 'exp_desc',
        'label'           => esc_html__( 'Year Content', 'frudbaz' ),
        'section'         => 'header_top_setting',
        'default'         => esc_html__( 'Years Experience', 'frudbaz' ),
        'priority'        => 10,
        'active_callback' => [
            [
                'setting'  => 'frudbaz_expyr_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'            => 'text',
        'settings'        => 'frudbaz_mail_id',
        'label'           => esc_html__( 'Mail ID', 'frudbaz' ),
        'section'         => 'header_top_setting',
        'default'         => esc_html__( 'info@webmail.com', 'frudbaz' ),
        'priority'        => 10,
        'active_callback' => [
            [
                'setting'  => 'frudbaz_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'link',
        'settings' => 'frudbaz_login_button_link',
        'label'    => esc_html__( 'Login Url', 'frudbaz' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( '#', 'frudbaz' ),
        'priority' => 10,
    ];

    // button
    $fields[] = [
        'type'     => 'text',
        'settings' => 'frudbaz_button_text',
        'label'    => esc_html__( 'Button Text', 'frudbaz' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( 'Download Now', 'frudbaz' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'frudbaz_header_right',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'link',
        'settings' => 'frudbaz_button_link',
        'label'    => esc_html__( 'Button URL', 'frudbaz' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( '#', 'frudbaz' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'frudbaz_header_right',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    return $fields;

}
add_filter( 'kirki/fields', '_header_top_fields' );

/*
Header Social
*/
function _header_social_fields( $fields ) {
    // header section social
    $fields[] = [
        'type'     => 'text',
        'settings' => 'frudbaz_topbar_fb_url',
        'label'    => esc_html__( 'Facebook Url', 'frudbaz' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'frudbaz' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'frudbaz_topbar_twitter_url',
        'label'    => esc_html__( 'Twitter Url', 'frudbaz' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'frudbaz' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'frudbaz_topbar_google_url',
        'label'    => esc_html__( 'Google Url', 'frudbaz' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'frudbaz' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'frudbaz_topbar_linkedin_url',
        'label'    => esc_html__( 'Linkedin Url', 'frudbaz' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'frudbaz' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'frudbaz_topbar_instagram_url',
        'label'    => esc_html__( 'Instagram Url', 'frudbaz' ),
        'section'  => 'header_social',
        'default'  => esc_html__( ' ', 'frudbaz' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'frudbaz_topbar_youtube_url',
        'label'    => esc_html__( 'Youtube Url', 'frudbaz' ),
        'section'  => 'header_social',
        'default'  => esc_html__( ' ', 'frudbaz' ),
        'priority' => 10,
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_social_fields' );


function _footer_social_fields( $fields ) {

    // header section social

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'footer_social_switch',
        'label'    => esc_html__( 'Footer Socail On/Off', 'frudbaz' ),
        'section'  => 'footer_social',
        'default'  => 'off',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'frudbaz' ),
            'off' => esc_html__( 'Disable', 'frudbaz' ),
        ],
    ];

    $fields[] = [
        'type'     => 'repeater',
        'settings' => 'footer_social_links',
        'label'    => esc_html__( 'Socail Links', 'frudbaz' ),
        'section'  => 'footer_social',
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'footer_social_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
        'row_label' => [
            'type'  => 'field',
            'value' => esc_html__( 'Social Profile links', 'frudbaz' ),
            'field' => 'social_profile_name',
        ],
        'button_label' => esc_html__('Add new', 'frudbaz' ),
        'default'      => [
            [
                'social_profile_name' => esc_html__( 'facebook-f', 'frudbaz' ),
                'social_profile_link'  => '#',
            ],
            [
                'social_profile_name' => esc_html__( 'twitter', 'frudbaz' ),
                'social_profile_link'  => '#',
            ],
            [
                'social_profile_name' => esc_html__( 'youtube', 'frudbaz' ),
                'social_profile_link'  => '#',
            ],
            [
                'social_profile_name' => esc_html__( 'instagram', 'frudbaz' ),
                'social_profile_link'  => '#',
            ],
        ],
        'fields' => [
            'social_profile_name' => [
                'type'        => 'select',
                'label'       => esc_html__( 'Select Social Icon', 'frudbaz' ),
                'description' => esc_html__( 'You can select avilable social icon from here', 'frudbaz' ),
                'default'     => 'facebook-f',
                'choices'     => [
                    'facebook-f'     => esc_html__( 'Facebook', 'frudbaz' ),
                    'instagram'      => esc_html__( 'Instagram', 'frudbaz' ),
                    'twitter'        => esc_html__( 'Twitter', 'frudbaz' ),
                    'linkedin'       => esc_html__( 'LinkedIn', 'frudbaz' ),
                    'pinterest'      => esc_html__( 'Pinterest', 'frudbaz' ),
                    'youtube'        => esc_html__( 'YouTube', 'frudbaz' ),
                    'apple'          => esc_html__( 'Apple', 'frudbaz' ),
                    'behance'        => esc_html__( 'Behance', 'frudbaz' ),
                    'bitbucket'      => esc_html__( 'BitBucket', 'frudbaz' ),
                    'codepen'        => esc_html__( 'CodePen', 'frudbaz' ),
                    'delicious'      => esc_html__( 'Delicious', 'frudbaz' ),
                    'deviantart'     => esc_html__( 'DeviantArt', 'frudbaz' ),
                    'digg'           => esc_html__( 'Digg', 'frudbaz' ),
                    'dribbble'       => esc_html__( 'Dribbble', 'frudbaz' ),
                    'email'          => esc_html__( 'Email', 'frudbaz' ),
                    'flickr'         => esc_html__( 'Flicker', 'frudbaz' ),
                    'foursquare'     => esc_html__( 'FourSquare', 'frudbaz' ),
                    'github'         => esc_html__( 'Github', 'frudbaz' ),
                    'houzz'          => esc_html__( 'Houzz', 'frudbaz' ),
                    'jsfiddle'       => esc_html__( 'JS Fiddle', 'frudbaz' ),
                    'medium'         => esc_html__( 'Medium', 'frudbaz' ),
                    'product-hunt'   => esc_html__( 'Product Hunt', 'frudbaz' ),
                    'reddit'         => esc_html__( 'Reddit', 'frudbaz' ),
                    'slideshare'     => esc_html__( 'Slide Share', 'frudbaz' ),
                    'snapchat'       => esc_html__( 'Snapchat', 'frudbaz' ),
                    'soundcloud'     => esc_html__( 'SoundCloud', 'frudbaz' ),
                    'spotify'        => esc_html__( 'Spotify', 'frudbaz' ),
                    'stack-overflow' => esc_html__( 'StackOverflow', 'frudbaz' ),
                    'tripadvisor'    => esc_html__( 'TripAdvisor', 'frudbaz' ),
                    'tumblr'         => esc_html__( 'Tumblr', 'frudbaz' ),
                    'twitch'         => esc_html__( 'Twitch', 'frudbaz' ),
                    'twitter'        => esc_html__( 'Twitter', 'frudbaz' ),
                    'vimeo'          => esc_html__( 'Vimeo', 'frudbaz' ),
                    'vk'             => esc_html__( 'VK', 'frudbaz' ),
                    'website'        => esc_html__( 'Website', 'frudbaz' ),
                    'whatsapp'       => esc_html__( 'WhatsApp', 'frudbaz' ),
                    'wordpress'      => esc_html__( 'WordPress', 'frudbaz' ),
                    'xing'           => esc_html__( 'Xing', 'frudbaz' ),
                    'yelp'           => esc_html__( 'Yelp', 'frudbaz' ),
                ],
            ],
            'social_profile_link'  => [
                'type'        => 'link',
                'label'       => esc_html__( 'Link URL', 'frudbaz' ),
                'description' => esc_html__( 'This will be the link URL', 'frudbaz' ),
                'default'     => '#',
            ],
        ]
    ];
    return $fields;
}
add_filter( 'kirki/fields', '_footer_social_fields' );


/*
Header Settings
 */
function _header_header_fields( $fields ) {

    $fields[] = [
        'type'        => 'select',
        'settings'    => 'choose_default_header',
        'label'       => esc_html__( 'Choose Header Style', 'frudbaz' ),
        'section'     => 'section_header_logo',
        'default'     => 'header-style-1',
        'placeholder' => esc_html__( 'Select an option...', 'frudbaz' ),
        'priority'    => 10,
        'choices'     => [
            'header-style-1' => esc_html__( 'Header Style 1', 'frudbaz' ),
            'header-style-2' => esc_html__( 'Header Style 2', 'frudbaz' ),
            'header-style-3' => esc_html__( 'Header Style 3', 'frudbaz' ),
            'header-style-4' => esc_html__( 'Header Style 4', 'frudbaz' ),
        ],
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'logo',
        'label'       => esc_html__( 'Header Logo', 'frudbaz' ),
        'description' => esc_html__( 'Upload Your Logo.', 'frudbaz' ),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'seconday_logo',
        'label'       => esc_html__( 'Header Logo', 'frudbaz' ),
        'description' => esc_html__( 'Header White Logo', 'frudbaz' ),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo_white.png',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'favicon_url',
        'label'       => esc_html__( 'Favicon', 'frudbaz' ),
        'description' => esc_html__( 'Favicon Icon', 'frudbaz' ),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/favicon.png',
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_header_fields' );

/*
Header Side Info
 */
function _header_side_fields( $fields ) {
    // side info settings
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'frudbaz_hamburger_hide',
        'label'    => esc_html__( 'Show Hamburger On/Off', 'frudbaz' ),
        'section'  => 'header_side_setting',
        'default'  => 'off',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'frudbaz' ),
            'off' => esc_html__( 'Disable', 'frudbaz' ),
        ],
    ];
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'frudbaz_extra_info_logo',
        'label'       => esc_html__( 'Logo Side', 'frudbaz' ),
        'description' => esc_html__( 'Logo Side', 'frudbaz' ),
        'section'     => 'header_side_setting',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'frudbaz_extra_about_title',
        'label'    => esc_html__( 'About Title', 'frudbaz' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'About Us', 'frudbaz' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'frudbaz_extra_about_text',
        'label'    => esc_html__( 'About Us Desc..', 'frudbaz' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'About Us Desc...', 'frudbaz' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'frudbaz_extra_button',
        'label'    => esc_html__( 'Button Text', 'frudbaz' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'Contact Us', 'frudbaz' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'frudbaz_extra_button_url',
        'label'    => esc_html__( 'Button URL', 'frudbaz' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( '#', 'frudbaz' ),
        'priority' => 10,
    ];
    // contact
    $fields[] = [
        'type'     => 'text',
        'settings' => 'frudbaz_contact_title',
        'label'    => esc_html__( 'Contact Title', 'frudbaz' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'Contact Us', 'frudbaz' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'frudbaz_extra_address',
        'label'    => esc_html__( 'Office Address', 'frudbaz' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'Bowery St., New York, NY 10013, USA', 'frudbaz' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'frudbaz_extra_phone',
        'label'    => esc_html__( 'Phone Number', 'frudbaz' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( '+1255-568-6523', 'frudbaz' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'frudbaz_extra_email',
        'label'    => esc_html__( 'Email ID', 'frudbaz' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'information@gmail.com', 'frudbaz' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', '_header_side_fields' );

/*
_header_page_title_fields
 */
function _header_page_title_fields( $fields ) {
    // Breadcrumb Setting
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'breadcrumb_bg_img',
        'label'       => esc_html__( 'Breadcrumb Background Image', 'frudbaz' ),
        'description' => esc_html__( 'Breadcrumb Background Image', 'frudbaz' ),
        'section'     => 'breadcrumb_setting',
        'default'     => get_template_directory_uri() . '/assets/img/bg/page_title.jpg',
    ];
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'breadcrumb_right_img',
        'label'       => esc_html__( 'Breadcrumb Right Image', 'frudbaz' ),
        'description' => esc_html__( 'Breadcrumb Right Image', 'frudbaz' ),
        'section'     => 'breadcrumb_setting',
    ];
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'breadcrumb_icon_img',
        'label'       => esc_html__( 'Breadcrumb Bottom Icon', 'frudbaz' ),
        'description' => esc_html__( 'Breadcrumb Bottom Icon', 'frudbaz' ),
        'section'     => 'breadcrumb_setting',
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'frudbaz_breadcrumb_bg_color',
        'label'       => __( 'Breadcrumb BG Color', 'frudbaz' ),
        'description' => esc_html__( 'This is a Breadcrumb bg color control.', 'frudbaz' ),
        'section'     => 'breadcrumb_setting',
        'default'     => '#f4f9fc',
        'priority'    => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'frudbaz_breadcrumb_top_spacing',
        'label'    => esc_html__( 'Breadcrumb Padding Top', 'frudbaz' ),
        'section'  => 'breadcrumb_setting',
        'default'  => esc_html__( '160px', 'frudbaz' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'frudbaz_breadcrumb_bottom_spacing',
        'label'    => esc_html__( 'Breadcrumb Padding Bottom', 'frudbaz' ),
        'section'  => 'breadcrumb_setting',
        'default'  => esc_html__( '160px', 'frudbaz' ),
        'priority' => 10,
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_page_title_fields' );

/*
Header Social
 */
function _header_blog_fields( $fields ) {
// Blog Setting
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'frudbaz_blog_btn_switch',
        'label'    => esc_html__( 'Blog BTN On/Off', 'frudbaz' ),
        'section'  => 'blog_setting',
        'default'  => 'on',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'frudbaz' ),
            'off' => esc_html__( 'Disable', 'frudbaz' ),
        ],
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'frudbaz_blog_btn',
        'label'    => esc_html__( 'Blog Button text', 'frudbaz' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Read More', 'frudbaz' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'frudbaz_blog_btn_rtl',
        'label'    => esc_html__( 'Blog Button text rtl', 'frudbaz' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Read More', 'frudbaz' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title',
        'label'    => esc_html__( 'Blog Title', 'frudbaz' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Blog', 'frudbaz' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title_details',
        'label'    => esc_html__( 'Blog Details Title', 'frudbaz' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Blog Details', 'frudbaz' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', '_header_blog_fields' );

/*
Footer
 */
function _header_footer_fields( $fields ) {
    // Footer Setting
    $fields[] = [
        'type'        => 'select',
        'settings'    => 'choose_default_footer',
        'label'       => esc_html__( 'Choose Footer Style', 'frudbaz' ),
        'section'     => 'footer_setting',
        'default'     => 'footer-style-1',
        'placeholder' => esc_html__( 'Select an option...', 'frudbaz' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'footer-style-1' => esc_html__( 'Footer Style 1', 'frudbaz' ),
            'footer-style-2' => esc_html__( 'Footer Style 2', 'frudbaz' ),
            'footer-style-3' => esc_html__( 'Footer Style 3', 'frudbaz' ),
        ],
    ];

    $fields[] = [
        'type'        => 'select',
        'settings'    => 'footer_widget_number',
        'label'       => esc_html__( 'Widget Number', 'frudbaz' ),
        'section'     => 'footer_setting',
        'default'     => '4',
        'placeholder' => esc_html__( 'Select an option...', 'frudbaz' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            '5' => esc_html__( 'Widget Number 5', 'frudbaz' ),
            '4' => esc_html__( 'Widget Number 4', 'frudbaz' ),
            '3' => esc_html__( 'Widget Number 3', 'frudbaz' ),
            '2' => esc_html__( 'Widget Number 2', 'frudbaz' ),
        ],
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'frudbaz_footer_bg',
        'label'       => esc_html__( 'Footer Background Image.', 'frudbaz' ),
        'description' => esc_html__( 'Footer Background Image.', 'frudbaz' ),
        'section'     => 'footer_setting',
    ];

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'frudbaz_footer_bg_color',
        'label'       => __( 'Footer BG Color', 'frudbaz' ),
        'description' => esc_html__( 'This is a Footer bg color control.', 'frudbaz' ),
        'section'     => 'footer_setting',
        'default'     => '#000000',
        'priority'    => 10,
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'frudbaz_footer_logo_hide',
        'label'    => esc_html__( 'Footer Logo On/Off', 'frudbaz' ),
        'section'  => 'footer_setting',
        'default'  => 'off',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'frudbaz' ),
            'off' => esc_html__( 'Disable', 'frudbaz' ),
        ],
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'frudbaz_footer_logo',
        'label'       => esc_html__( 'Footer Logo', 'frudbaz' ),
        'description' => esc_html__( 'Footer Logo', 'frudbaz' ),
        'section'     => 'footer_setting',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo_white.png',
        'active_callback' => [
            [
                'setting'  => 'frudbaz_footer_logo_hide',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'footer_newslater_switch',
        'label'    => esc_html__( 'Footer Newslater On/Off', 'frudbaz' ),
        'section'  => 'footer_setting',
        'default'  => 'off',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'frudbaz' ),
            'off' => esc_html__( 'Disable', 'frudbaz' ),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'footer_newslater_title',
        'label'    => esc_html__( 'Newslater Title', 'frudbaz' ),
        'section'  => 'footer_setting',
        'default'  => esc_html__( 'SUBSCRIBE NEWS LATTER', 'frudbaz' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'footer_newslater_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'footer_newslater_shortcode',
        'label'    => esc_html__( 'Newslater Form Shortcode', 'frudbaz' ),
        'section'  => 'footer_setting',
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'footer_newslater_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'footer_copyright_switch',
        'label'    => esc_html__( 'Footer Copyright On/Off', 'frudbaz' ),
        'section'  => 'footer_setting',
        'default'  => 'on',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'frudbaz' ),
            'off' => esc_html__( 'Disable', 'frudbaz' ),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'frudbaz_copyright',
        'label'    => esc_html__( 'Copy Right', 'frudbaz' ),
        'section'  => 'footer_setting',
        'default'  => esc_html__( 'Copy Right &copy; Example 2022.Design By XpressRow', 'frudbaz' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'footer_copyright_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];
    return $fields;
}
add_filter( 'kirki/fields', '_header_footer_fields' );

// 404
function frudbaz_404_fields( $fields ) {
    // 404 settings
    $fields[] = [
        'type'     => 'text',
        'settings' => 'frudbaz_error_404_text',
        'label'    => esc_html__( '400 Text', 'frudbaz' ),
        'section'  => '404_page',
        'default'  => esc_html__( '404', 'frudbaz' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'frudbaz_error_title',
        'label'    => esc_html__( 'Not Found Title', 'frudbaz' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Page not found', 'frudbaz' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'frudbaz_error_desc',
        'label'    => esc_html__( '404 Description Text', 'frudbaz' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Oops! The page you are looking for does not exist. It might have been moved or deleted', 'frudbaz' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'frudbaz_error_link_text',
        'label'    => esc_html__( '404 Link Text', 'frudbaz' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Back To Home', 'frudbaz' ),
        'priority' => 10,
    ];
    return $fields;

}
add_filter( 'kirki/fields', 'frudbaz_404_fields' );

/**
 * Added Fields
 */
function frudbaz_rtl_fields( $fields ) {
    // rtl settings
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'rtl_switch',
        'label'    => esc_html__( 'RTL On/Off', 'frudbaz' ),
        'section'  => 'rtl_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'frudbaz' ),
            'off' => esc_html__( 'Disable', 'frudbaz' ),
        ],
    ];
    return $fields;
}

//add_filter( 'kirki/fields', 'frudbaz_rtl_fields' );

/**
 * Added Fields
 */
function frudbaz_color_fields( $fields ) {
    // rtl settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'frudbaz_color_option',
        'label'       => __( 'Theme Color', 'frudbaz' ),
        'description' => esc_html__( 'This is for theme color control.', 'frudbaz' ),
        'section'     => 'color_setting',
        'default'     => '#ff8e28',
        'priority'    => 10,
    ];

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'frudbaz_sec_color_option',
        'label'       => __( 'Theme Secondary Color', 'frudbaz' ),
        'description' => esc_html__( 'This is for theme secondary color control.', 'frudbaz' ),
        'section'     => 'color_setting',
        'default'     => '#00a850',
        'priority'    => 10,
    ];
    return $fields;
}

add_filter( 'kirki/fields', 'frudbaz_color_fields' );

/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function frudbaz_theme_option( $name ) {
    $value = '';
    if ( class_exists( 'frudbaz' ) ) {
        $value = Kirki::get_option( frudbaz_get_theme(), $name );
    }

    return apply_filters( 'frudbaz_theme_option', $value, $name );
}

/**
 * Get config ID
 *
 * @return string
 */
function frudbaz_get_theme() {
    return 'frudbaz';
}