<?php
/**
 * LSM Sports Theme Customizer
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function lsm_sports_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'lsm_sports_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'lsm_sports_customize_partial_blogdescription',
            )
        );
    }

    // Theme Options Section
    $wp_customize->add_section(
        'lsm_sports_theme_options',
        array(
            'title'    => __('Theme Options', 'lsm-sports'),
            'priority' => 130,
        )
    );

    // Header Options
    $wp_customize->add_setting(
        'lsm_sports_header_style',
        array(
            'default'           => 'default',
            'sanitize_callback' => 'lsm_sports_sanitize_select',
        )
    );

    $wp_customize->add_control(
        'lsm_sports_header_style',
        array(
            'label'    => __('Header Style', 'lsm-sports'),
            'section'  => 'lsm_sports_theme_options',
            'type'     => 'select',
            'choices'  => array(
                'default' => __('Default', 'lsm-sports'),
                'centered' => __('Centered', 'lsm-sports'),
                'minimal' => __('Minimal', 'lsm-sports'),
            ),
        )
    );

    // Footer Text
    $wp_customize->add_setting(
        'lsm_sports_footer_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );

    $wp_customize->add_control(
        'lsm_sports_footer_text',
        array(
            'label'    => __('Footer Text', 'lsm-sports'),
            'section'  => 'lsm_sports_theme_options',
            'type'     => 'textarea',
            'description' => __('Custom text to display in the footer. HTML allowed.', 'lsm-sports'),
        )
    );

    // Social Media Links Section
    $wp_customize->add_section(
        'lsm_sports_social_media',
        array(
            'title'    => __('Social Media Links', 'lsm-sports'),
            'priority' => 135,
        )
    );

    // Social Media Links
    $social_sites = array(
        'facebook' => __('Facebook', 'lsm-sports'),
        'twitter' => __('Twitter', 'lsm-sports'),
        'instagram' => __('Instagram', 'lsm-sports'),
        'youtube' => __('YouTube', 'lsm-sports'),
        'linkedin' => __('LinkedIn', 'lsm-sports'),
        'tiktok' => __('TikTok', 'lsm-sports'),
    );

    foreach ($social_sites as $social_site => $label) {
        $wp_customize->add_setting(
            'lsm_sports_' . $social_site . '_url',
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        $wp_customize->add_control(
            'lsm_sports_' . $social_site . '_url',
            array(
                'label'   => $label . ' ' . __('URL', 'lsm-sports'),
                'section' => 'lsm_sports_social_media',
                'type'    => 'url',
            )
        );
    }

    // Colors Section Enhancement
    $wp_customize->add_setting(
        'lsm_sports_primary_color',
        array(
            'default'           => '#2563eb',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'lsm_sports_primary_color',
            array(
                'label'    => __('Primary Color', 'lsm-sports'),
                'section'  => 'colors',
                'settings' => 'lsm_sports_primary_color',
            )
        )
    );

    $wp_customize->add_setting(
        'lsm_sports_secondary_color',
        array(
            'default'           => '#64748b',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'lsm_sports_secondary_color',
            array(
                'label'    => __('Secondary Color', 'lsm-sports'),
                'section'  => 'colors',
                'settings' => 'lsm_sports_secondary_color',
            )
        )
    );

    // Typography Section
    $wp_customize->add_section(
        'lsm_sports_typography',
        array(
            'title'    => __('Typography', 'lsm-sports'),
            'priority' => 140,
        )
    );

    // Body Font
    $wp_customize->add_setting(
        'lsm_sports_body_font',
        array(
            'default'           => 'Inter',
            'sanitize_callback' => 'lsm_sports_sanitize_select',
        )
    );

    $wp_customize->add_control(
        'lsm_sports_body_font',
        array(
            'label'    => __('Body Font', 'lsm-sports'),
            'section'  => 'lsm_sports_typography',
            'type'     => 'select',
            'choices'  => array(
                'Inter' => 'Inter',
                'Roboto' => 'Roboto',
                'Open Sans' => 'Open Sans',
                'Lato' => 'Lato',
                'Poppins' => 'Poppins',
            ),
        )
    );

    // Heading Font
    $wp_customize->add_setting(
        'lsm_sports_heading_font',
        array(
            'default'           => 'Inter',
            'sanitize_callback' => 'lsm_sports_sanitize_select',
        )
    );

    $wp_customize->add_control(
        'lsm_sports_heading_font',
        array(
            'label'    => __('Heading Font', 'lsm-sports'),
            'section'  => 'lsm_sports_typography',
            'type'     => 'select',
            'choices'  => array(
                'Inter' => 'Inter',
                'Merriweather' => 'Merriweather',
                'Playfair Display' => 'Playfair Display',
                'Montserrat' => 'Montserrat',
                'Oswald' => 'Oswald',
            ),
        )
    );

    // Layout Section
    $wp_customize->add_section(
        'lsm_sports_layout',
        array(
            'title'    => __('Layout Options', 'lsm-sports'),
            'priority' => 145,
        )
    );

    // Container Width
    $wp_customize->add_setting(
        'lsm_sports_container_width',
        array(
            'default'           => 'default',
            'sanitize_callback' => 'lsm_sports_sanitize_select',
        )
    );

    $wp_customize->add_control(
        'lsm_sports_container_width',
        array(
            'label'    => __('Container Width', 'lsm-sports'),
            'section'  => 'lsm_sports_layout',
            'type'     => 'select',
            'choices'  => array(
                'narrow' => __('Narrow (1024px)', 'lsm-sports'),
                'default' => __('Default (1280px)', 'lsm-sports'),
                'wide' => __('Wide (1536px)', 'lsm-sports'),
                'full' => __('Full Width', 'lsm-sports'),
            ),
        )
    );

    // Blog Layout
    $wp_customize->add_setting(
        'lsm_sports_blog_layout',
        array(
            'default'           => 'grid',
            'sanitize_callback' => 'lsm_sports_sanitize_select',
        )
    );

    $wp_customize->add_control(
        'lsm_sports_blog_layout',
        array(
            'label'    => __('Blog Layout', 'lsm-sports'),
            'section'  => 'lsm_sports_layout',
            'type'     => 'select',
            'choices'  => array(
                'list' => __('List View', 'lsm-sports'),
                'grid' => __('Grid View', 'lsm-sports'),
                'masonry' => __('Masonry', 'lsm-sports'),
            ),
        )
    );
}
add_action('customize_register', 'lsm_sports_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function lsm_sports_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function lsm_sports_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function lsm_sports_customize_preview_js() {
    wp_enqueue_script('lsm-sports-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), _S_VERSION, true);
}
add_action('customize_preview_init', 'lsm_sports_customize_preview_js');

/**
 * Sanitize select fields
 */
function lsm_sports_sanitize_select($input, $setting) {
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control($setting->id)->choices;
    return (array_key_exists($input, $choices) ? $input : $setting->default);
}

/**
 * Output custom CSS based on customizer settings
 */
function lsm_sports_customizer_css() {
    $primary_color = get_theme_mod('lsm_sports_primary_color', '#2563eb');
    $secondary_color = get_theme_mod('lsm_sports_secondary_color', '#64748b');
    $body_font = get_theme_mod('lsm_sports_body_font', 'Inter');
    $heading_font = get_theme_mod('lsm_sports_heading_font', 'Inter');

    $css = "
        :root {
            --primary-color: {$primary_color};
            --secondary-color: {$secondary_color};
            --body-font: '{$body_font}', sans-serif;
            --heading-font: '{$heading_font}', sans-serif;
        }
        
        body {
            font-family: var(--body-font);
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: var(--heading-font);
        }
        
        .btn-primary,
        .bg-primary-600 {
            background-color: var(--primary-color);
        }
        
        .text-primary-600 {
            color: var(--primary-color);
        }
        
        .border-primary-600 {
            border-color: var(--primary-color);
        }
        
        .text-secondary-600 {
            color: var(--secondary-color);
        }
        
        .bg-secondary-600 {
            background-color: var(--secondary-color);
        }
    ";

    // Container width
    $container_width = get_theme_mod('lsm_sports_container_width', 'default');
    switch ($container_width) {
        case 'narrow':
            $css .= '.container { max-width: 1024px; }';
            break;
        case 'wide':
            $css .= '.container { max-width: 1536px; }';
            break;
        case 'full':
            $css .= '.container { max-width: 100%; }';
            break;
    }

    wp_add_inline_style('lsm-sports-style', $css);
}
add_action('wp_enqueue_scripts', 'lsm_sports_customizer_css');

/**
 * Get social media links
 */
function lsm_sports_get_social_links() {
    $social_sites = array(
        'facebook' => array(
            'url' => get_theme_mod('lsm_sports_facebook_url', ''),
            'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
        ),
        'twitter' => array(
            'url' => get_theme_mod('lsm_sports_twitter_url', ''),
            'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>',
        ),
        'instagram' => array(
            'url' => get_theme_mod('lsm_sports_instagram_url', ''),
            'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987 6.62 0 11.987-5.367 11.987-11.987C24.014 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.323-1.297C4.198 14.895 3.708 13.744 3.708 12.447s.49-2.448 1.297-3.323C5.902 8.198 7.053 7.708 8.35 7.708s2.448.49 3.323 1.297c.897.875 1.387 2.026 1.387 3.323s-.49 2.448-1.297 3.323c-.875.897-2.026 1.387-3.323 1.387zm7.718 0c-1.297 0-2.448-.49-3.323-1.297-.897-.875-1.387-2.026-1.387-3.323s.49-2.448 1.297-3.323c.875-.897 2.026-1.387 3.323-1.387s2.448.49 3.323 1.297c.897.875 1.387 2.026 1.387 3.323s-.49 2.448-1.297 3.323c-.875.897-2.026 1.387-3.323 1.387z"/></svg>',
        ),
        'youtube' => array(
            'url' => get_theme_mod('lsm_sports_youtube_url', ''),
            'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
        ),
        'linkedin' => array(
            'url' => get_theme_mod('lsm_sports_linkedin_url', ''),
            'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>',
        ),
        'tiktok' => array(
            'url' => get_theme_mod('lsm_sports_tiktok_url', ''),
            'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>',
        ),
    );

    return $social_sites;
}
