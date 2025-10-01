<?php
/**
 * LSM Sports Theme functions and definitions
 */

if (!defined('_S_VERSION')) {
    define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function lsm_sports_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'menu-1' => esc_html__('Primary', 'lsm-sports'),
        )
    );

    // Switch default core markup for search form, comment form, and comments
    // to output valid HTML5.
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'lsm_sports_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for core custom logo.
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );

    // Add support for wide and full alignment
    add_theme_support('align-wide');

    // Add support for editor styles
    add_theme_support('editor-styles');

    // Add support for responsive embedded content
    add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'lsm_sports_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function lsm_sports_content_width() {
    $GLOBALS['content_width'] = apply_filters('lsm_sports_content_width', 640);
}
add_action('after_setup_theme', 'lsm_sports_content_width', 0);

/**
 * Register widget area.
 */
function lsm_sports_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'lsm-sports'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'lsm-sports'),
            'before_widget' => '<section id="%1$s" class="widget bg-white rounded-lg shadow-md p-6 mb-6 %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title text-xl font-semibold text-gray-900 mb-4">',
            'after_title'   => '</h2>',
        )
    );

    // Register Footer Widget Areas
    register_sidebar(
        array(
            'name'          => esc_html__('Footer Widget Area 1', 'lsm-sports'),
            'id'            => 'footer-1',
            'description'   => esc_html__('Add widgets here to appear in the first footer column.', 'lsm-sports'),
            'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title text-lg font-semibold text-white mb-4">',
            'after_title'   => '</h3>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__('Footer Widget Area 2', 'lsm-sports'),
            'id'            => 'footer-2',
            'description'   => esc_html__('Add widgets here to appear in the second footer column.', 'lsm-sports'),
            'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title text-lg font-semibold text-white mb-4">',
            'after_title'   => '</h3>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__('Footer Widget Area 3', 'lsm-sports'),
            'id'            => 'footer-3',
            'description'   => esc_html__('Add widgets here to appear in the third footer column.', 'lsm-sports'),
            'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title text-lg font-semibold text-white mb-4">',
            'after_title'   => '</h3>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__('Footer Widget Area 4', 'lsm-sports'),
            'id'            => 'footer-4',
            'description'   => esc_html__('Add widgets here to appear in the fourth footer column.', 'lsm-sports'),
            'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title text-lg font-semibold text-white mb-4">',
            'after_title'   => '</h3>',
        )
    );
}
add_action('widgets_init', 'lsm_sports_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function lsm_sports_scripts() {
    // Enqueue the main stylesheet
    wp_enqueue_style('lsm-sports-style', get_stylesheet_uri(), array(), _S_VERSION);
    
    // Enqueue the compiled CSS (this will be generated by our build process)
    wp_enqueue_style(
        'lsm-sports-compiled',
        get_template_directory_uri() . '/dist/css/style.css',
        array(),
        _S_VERSION
    );

    // Enqueue navigation script for mobile menu
    wp_enqueue_script(
        'lsm-sports-navigation',
        get_template_directory_uri() . '/js/navigation.js',
        array(),
        _S_VERSION,
        true
    );

    // Enqueue comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'lsm_sports_scripts');

/**
 * Add favicon to the site
 */
function lsm_sports_add_favicon() {
    $favicon_url = get_template_directory_uri() . '/src/img/One_All_Sports_Logo_fav icon.png';
    echo '<link rel="icon" type="image/png" href="' . esc_url($favicon_url) . '">' . "\n";
    echo '<link rel="shortcut icon" type="image/png" href="' . esc_url($favicon_url) . '">' . "\n";
    echo '<link rel="apple-touch-icon" href="' . esc_url($favicon_url) . '">' . "\n";
}
add_action('wp_head', 'lsm_sports_add_favicon');

/**
 * Add custom classes to navigation menu links
 */
function lsm_sports_nav_menu_link_attributes($atts, $item, $args) {
    if (isset($args->link_class)) {
        $atts['class'] = $args->link_class;
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'lsm_sports_nav_menu_link_attributes', 10, 3);

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes
 */
function lsm_sports_custom_image_sizes() {
    add_image_size('lsm-card-thumb', 400, 250, true);
    add_image_size('lsm-hero', 1200, 600, true);
}
add_action('after_setup_theme', 'lsm_sports_custom_image_sizes');

/**
 * Custom excerpt length
 */
function lsm_sports_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'lsm_sports_excerpt_length', 999);


/**
 * Add custom classes to body
 */
function lsm_sports_body_classes($classes) {
    // Add TailwindCSS classes
    $classes[] = 'font-sans';
    $classes[] = 'antialiased';
    // $classes[] = 'pt-24'; // Add top padding for fixed navbar
    
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }
    
    return $classes;
}
add_filter('body_class', 'lsm_sports_body_classes');

/**
 * Disable WordPress default styles that might conflict with TailwindCSS
 */
function lsm_sports_dequeue_styles() {
    // wp_dequeue_style('wp-block-library');
    // wp_dequeue_style('wp-block-library-theme');
    // wp_dequeue_style('wc-block-style');   
}
add_action('wp_enqueue_scripts', 'lsm_sports_dequeue_styles', 100);

/**
 * Add editor styles for Gutenberg
 */
function lsm_sports_add_editor_styles() {
    add_editor_style('dist/css/editor-style.css');
}
add_action('admin_init', 'lsm_sports_add_editor_styles');

/**
 * Register Custom Post Types
 */
function lsm_sports_register_custom_post_types() {
    // Register Promotion Post Type
    $promotion_labels = array(
        'name'                  => _x('Promotions', 'Post Type General Name', 'lsm-sports'),
        'singular_name'         => _x('Promotion', 'Post Type Singular Name', 'lsm-sports'),
        'menu_name'             => __('Promotions', 'lsm-sports'),
        'name_admin_bar'        => __('Promotion', 'lsm-sports'),
        'archives'              => __('Promotion Archives', 'lsm-sports'),
        'attributes'            => __('Promotion Attributes', 'lsm-sports'),
        'parent_item_colon'     => __('Parent Promotion:', 'lsm-sports'),
        'all_items'             => __('All Promotions', 'lsm-sports'),
        'add_new_item'          => __('Add New Promotion', 'lsm-sports'),
        'add_new'               => __('Add New', 'lsm-sports'),
        'new_item'              => __('New Promotion', 'lsm-sports'),
        'edit_item'             => __('Edit Promotion', 'lsm-sports'),
        'update_item'           => __('Update Promotion', 'lsm-sports'),
        'view_item'             => __('View Promotion', 'lsm-sports'),
        'view_items'            => __('View Promotions', 'lsm-sports'),
        'search_items'          => __('Search Promotion', 'lsm-sports'),
        'not_found'             => __('Not found', 'lsm-sports'),
        'not_found_in_trash'    => __('Not found in Trash', 'lsm-sports'),
        'featured_image'        => __('Featured Image', 'lsm-sports'),
        'set_featured_image'    => __('Set featured image', 'lsm-sports'),
        'remove_featured_image' => __('Remove featured image', 'lsm-sports'),
        'use_featured_image'    => __('Use as featured image', 'lsm-sports'),
        'insert_into_item'      => __('Insert into promotion', 'lsm-sports'),
        'uploaded_to_this_item' => __('Uploaded to this promotion', 'lsm-sports'),
        'items_list'            => __('Promotions list', 'lsm-sports'),
        'items_list_navigation' => __('Promotions list navigation', 'lsm-sports'),
        'filter_items_list'     => __('Filter promotions list', 'lsm-sports'),
    );

    $promotion_args = array(
        'label'                 => __('Promotion', 'lsm-sports'),
        'description'           => __('Sports promotions and special offers', 'lsm-sports'),
        'labels'                => $promotion_labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions'),
        'taxonomies'            => array('promotion_category', 'promotion_tag'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-megaphone',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array('slug' => 'promotions'),
    );

    register_post_type('promotion', $promotion_args);

    // Register Article Post Type
    $article_labels = array(
        'name'                  => _x('Articles', 'Post Type General Name', 'lsm-sports'),
        'singular_name'         => _x('Article', 'Post Type Singular Name', 'lsm-sports'),
        'menu_name'             => __('Articles', 'lsm-sports'),
        'name_admin_bar'        => __('Article', 'lsm-sports'),
        'archives'              => __('Article Archives', 'lsm-sports'),
        'attributes'            => __('Article Attributes', 'lsm-sports'),
        'parent_item_colon'     => __('Parent Article:', 'lsm-sports'),
        'all_items'             => __('All Articles', 'lsm-sports'),
        'add_new_item'          => __('Add New Article', 'lsm-sports'),
        'add_new'               => __('Add New', 'lsm-sports'),
        'new_item'              => __('New Article', 'lsm-sports'),
        'edit_item'             => __('Edit Article', 'lsm-sports'),
        'update_item'           => __('Update Article', 'lsm-sports'),
        'view_item'             => __('View Article', 'lsm-sports'),
        'view_items'            => __('View Articles', 'lsm-sports'),
        'search_items'          => __('Search Article', 'lsm-sports'),
        'not_found'             => __('Not found', 'lsm-sports'),
        'not_found_in_trash'    => __('Not found in Trash', 'lsm-sports'),
        'featured_image'        => __('Featured Image', 'lsm-sports'),
        'set_featured_image'    => __('Set featured image', 'lsm-sports'),
        'remove_featured_image' => __('Remove featured image', 'lsm-sports'),
        'use_featured_image'    => __('Use as featured image', 'lsm-sports'),
        'insert_into_item'      => __('Insert into article', 'lsm-sports'),
        'uploaded_to_this_item' => __('Uploaded to this article', 'lsm-sports'),
        'items_list'            => __('Articles list', 'lsm-sports'),
        'items_list_navigation' => __('Articles list navigation', 'lsm-sports'),
        'filter_items_list'     => __('Filter articles list', 'lsm-sports'),
    );

    $article_args = array(
        'label'                 => __('Article', 'lsm-sports'),
        'description'           => __('Sports articles and news content', 'lsm-sports'),
        'labels'                => $article_labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions', 'author', 'comments'),
        'taxonomies'            => array('article_category', 'article_tag'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-media-document',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array('slug' => 'articles'),
    );

    register_post_type('article', $article_args);
}
add_action('init', 'lsm_sports_register_custom_post_types', 0);

/**
 * Register Custom Taxonomies for Custom Post Types
 */
function lsm_sports_register_custom_taxonomies() {
    // Register Promotion Categories
    $promotion_cat_labels = array(
        'name'                       => _x('Promotion Categories', 'Taxonomy General Name', 'lsm-sports'),
        'singular_name'              => _x('Promotion Category', 'Taxonomy Singular Name', 'lsm-sports'),
        'menu_name'                  => __('Categories', 'lsm-sports'),
        'all_items'                  => __('All Categories', 'lsm-sports'),
        'parent_item'                => __('Parent Category', 'lsm-sports'),
        'parent_item_colon'          => __('Parent Category:', 'lsm-sports'),
        'new_item_name'              => __('New Category Name', 'lsm-sports'),
        'add_new_item'               => __('Add New Category', 'lsm-sports'),
        'edit_item'                  => __('Edit Category', 'lsm-sports'),
        'update_item'                => __('Update Category', 'lsm-sports'),
        'view_item'                  => __('View Category', 'lsm-sports'),
        'separate_items_with_commas' => __('Separate categories with commas', 'lsm-sports'),
        'add_or_remove_items'        => __('Add or remove categories', 'lsm-sports'),
        'choose_from_most_used'      => __('Choose from the most used', 'lsm-sports'),
        'popular_items'              => __('Popular Categories', 'lsm-sports'),
        'search_items'               => __('Search Categories', 'lsm-sports'),
        'not_found'                  => __('Not Found', 'lsm-sports'),
        'no_terms'                   => __('No categories', 'lsm-sports'),
        'items_list'                 => __('Categories list', 'lsm-sports'),
        'items_list_navigation'      => __('Categories list navigation', 'lsm-sports'),
    );

    $promotion_cat_args = array(
        'labels'                     => $promotion_cat_labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
        'rewrite'                    => array('slug' => 'promotion-category'),
    );

    register_taxonomy('promotion_category', array('promotion'), $promotion_cat_args);

    // Register Promotion Tags
    $promotion_tag_labels = array(
        'name'                       => _x('Promotion Tags', 'Taxonomy General Name', 'lsm-sports'),
        'singular_name'              => _x('Promotion Tag', 'Taxonomy Singular Name', 'lsm-sports'),
        'menu_name'                  => __('Tags', 'lsm-sports'),
        'all_items'                  => __('All Tags', 'lsm-sports'),
        'parent_item'                => __('Parent Tag', 'lsm-sports'),
        'parent_item_colon'          => __('Parent Tag:', 'lsm-sports'),
        'new_item_name'              => __('New Tag Name', 'lsm-sports'),
        'add_new_item'               => __('Add New Tag', 'lsm-sports'),
        'edit_item'                  => __('Edit Tag', 'lsm-sports'),
        'update_item'                => __('Update Tag', 'lsm-sports'),
        'view_item'                  => __('View Tag', 'lsm-sports'),
        'separate_items_with_commas' => __('Separate tags with commas', 'lsm-sports'),
        'add_or_remove_items'        => __('Add or remove tags', 'lsm-sports'),
        'choose_from_most_used'      => __('Choose from the most used', 'lsm-sports'),
        'popular_items'              => __('Popular Tags', 'lsm-sports'),
        'search_items'               => __('Search Tags', 'lsm-sports'),
        'not_found'                  => __('Not Found', 'lsm-sports'),
        'no_terms'                   => __('No tags', 'lsm-sports'),
        'items_list'                 => __('Tags list', 'lsm-sports'),
        'items_list_navigation'      => __('Tags list navigation', 'lsm-sports'),
    );

    $promotion_tag_args = array(
        'labels'                     => $promotion_tag_labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
        'rewrite'                    => array('slug' => 'promotion-tag'),
    );

    register_taxonomy('promotion_tag', array('promotion'), $promotion_tag_args);

    // Register Article Categories
    $article_cat_labels = array(
        'name'                       => _x('Article Categories', 'Taxonomy General Name', 'lsm-sports'),
        'singular_name'              => _x('Article Category', 'Taxonomy Singular Name', 'lsm-sports'),
        'menu_name'                  => __('Categories', 'lsm-sports'),
        'all_items'                  => __('All Categories', 'lsm-sports'),
        'parent_item'                => __('Parent Category', 'lsm-sports'),
        'parent_item_colon'          => __('Parent Category:', 'lsm-sports'),
        'new_item_name'              => __('New Category Name', 'lsm-sports'),
        'add_new_item'               => __('Add New Category', 'lsm-sports'),
        'edit_item'                  => __('Edit Category', 'lsm-sports'),
        'update_item'                => __('Update Category', 'lsm-sports'),
        'view_item'                  => __('View Category', 'lsm-sports'),
        'separate_items_with_commas' => __('Separate categories with commas', 'lsm-sports'),
        'add_or_remove_items'        => __('Add or remove categories', 'lsm-sports'),
        'choose_from_most_used'      => __('Choose from the most used', 'lsm-sports'),
        'popular_items'              => __('Popular Categories', 'lsm-sports'),
        'search_items'               => __('Search Categories', 'lsm-sports'),
        'not_found'                  => __('Not Found', 'lsm-sports'),
        'no_terms'                   => __('No categories', 'lsm-sports'),
        'items_list'                 => __('Categories list', 'lsm-sports'),
        'items_list_navigation'      => __('Categories list navigation', 'lsm-sports'),
    );

    $article_cat_args = array(
        'labels'                     => $article_cat_labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
        'rewrite'                    => array('slug' => 'article-category'),
    );

    register_taxonomy('article_category', array('article'), $article_cat_args);

    // Register Article Tags
    $article_tag_labels = array(
        'name'                       => _x('Article Tags', 'Taxonomy General Name', 'lsm-sports'),
        'singular_name'              => _x('Article Tag', 'Taxonomy Singular Name', 'lsm-sports'),
        'menu_name'                  => __('Tags', 'lsm-sports'),
        'all_items'                  => __('All Tags', 'lsm-sports'),
        'parent_item'                => __('Parent Tag', 'lsm-sports'),
        'parent_item_colon'          => __('Parent Tag:', 'lsm-sports'),
        'new_item_name'              => __('New Tag Name', 'lsm-sports'),
        'add_new_item'               => __('Add New Tag', 'lsm-sports'),
        'edit_item'                  => __('Edit Tag', 'lsm-sports'),
        'update_item'                => __('Update Tag', 'lsm-sports'),
        'view_item'                  => __('View Tag', 'lsm-sports'),
        'separate_items_with_commas' => __('Separate tags with commas', 'lsm-sports'),
        'add_or_remove_items'        => __('Add or remove tags', 'lsm-sports'),
        'choose_from_most_used'      => __('Choose from the most used', 'lsm-sports'),
        'popular_items'              => __('Popular Tags', 'lsm-sports'),
        'search_items'               => __('Search Tags', 'lsm-sports'),
        'not_found'                  => __('Not Found', 'lsm-sports'),
        'no_terms'                   => __('No tags', 'lsm-sports'),
        'items_list'                 => __('Tags list', 'lsm-sports'),
        'items_list_navigation'      => __('Tags list navigation', 'lsm-sports'),
    );

    $article_tag_args = array(
        'labels'                     => $article_tag_labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
        'rewrite'                    => array('slug' => 'article-tag'),
    );

    register_taxonomy('article_tag', array('article'), $article_tag_args);
}
add_action('init', 'lsm_sports_register_custom_taxonomies', 0);

// Add admin menu for theme settings
function onesports_admin_menu() {
    add_options_page(
        __( 'OneSports Settings', 'lsm-sports' ),
        __( 'OneSports Settings', 'lsm-sports' ),
        'manage_options',
        'onesports-settings',
        'onesports_settings_page'
    );
}
add_action( 'admin_menu', 'onesports_admin_menu' );

function onesports_settings_init() {
    // Production-safe checks
    if ( ! function_exists( 'is_admin' ) || ! is_admin() ) {
        return;
    }

    if ( ! function_exists( 'register_setting' ) || ! function_exists( 'add_settings_section' ) || ! function_exists( 'add_settings_field' ) ) {
        return;
    }

    // Wrap in try-catch for production safety
    try {
        register_setting( 'onesports_settings', 'onesports_api_url' );
        register_setting( 'onesports_settings', 'onesports_subdomain' );
        register_setting( 'onesports_settings', 'onesports_login_url' );

        add_settings_section(
            'onesports_settings_section',
            __( 'API Configuration', 'lsm-sports' ),
            'onesports_settings_section_callback',
            'onesports_settings'
        );

        add_settings_field(
            'onesports_api_url',
            __( 'API URL', 'lsm-sports' ),
            'onesports_api_url_render',
            'onesports_settings',
            'onesports_settings_section'
        );

        add_settings_field(
            'onesports_subdomain',
            __( 'Subdomain', 'lsm-sports' ),
            'onesports_subdomain_render',
            'onesports_settings',
            'onesports_settings_section'
        );

        add_settings_field(
            'onesports_login_url',
            __( 'Login Redirect URL', 'lsm-sports' ),
            'onesports_login_url_render',
            'onesports_settings',
            'onesports_settings_section'
        );
    } catch ( Exception $e ) {
        // Silently fail in production to prevent 502 errors
        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            error_log( 'ONESPORTS Settings Error: ' . $e->getMessage() );
        }
    }
}
add_action( 'admin_init', 'onesports_settings_init' );

// Settings page display function
function onesports_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields( 'onesports_settings' );
            do_settings_sections( 'onesports_settings' );
            submit_button( __( 'Save Settings', 'lsm-sports' ) );
            ?>
        </form>
    </div>
    <?php
}

// Settings section callback
function onesports_settings_section_callback() {
    echo '<p>' . __( 'Configure the API settings for OneSports theme.', 'lsm-sports' ) . '</p>';
}

// API URL field render
function onesports_api_url_render() {
    $value = get_option( 'onesports_api_url', '' );
    ?>
    <input type="url" name="onesports_api_url" value="<?php echo esc_attr( $value ); ?>" class="regular-text" />
    <p class="description"><?php _e( 'Enter the API URL for the OneSports platform.', 'lsm-sports' ); ?></p>
    <?php
}

// Subdomain field render
function onesports_subdomain_render() {
    $value = get_option( 'onesports_subdomain', '' );
    ?>
    <input type="text" name="onesports_subdomain" value="<?php echo esc_attr( $value ); ?>" class="regular-text" />
    <p class="description"><?php _e( 'Enter the subdomain for the OneSports platform.', 'lsm-sports' ); ?></p>
    <?php
}

// Login URL field render
function onesports_login_url_render() {
    $value = get_option( 'onesports_login_url', '' );
    ?>
    <input type="url" name="onesports_login_url" value="<?php echo esc_attr( $value ); ?>" class="regular-text" />
    <p class="description"><?php _e( 'Enter the login redirect URL for the OneSports platform.', 'lsm-sports' ); ?></p>
    <?php
}


/**
 * Flush rewrite rules on theme activation
 */
function lsm_sports_flush_rewrite_rules() {
    // First, we "add" the custom post type via the above written function.
    // Note: "add" is written with quotes because we are only registering the post type
    lsm_sports_register_custom_post_types();
    lsm_sports_register_custom_taxonomies();
    
    // ATTENTION: This is *only* done during plugin activation hook in this example!
    // You should *NEVER EVER* do this on every page load!!
    flush_rewrite_rules();
}

// Hook into the 'after_switch_theme' action
add_action('after_switch_theme', 'lsm_sports_flush_rewrite_rules');

/**
 * Flush rewrite rules on theme deactivation
 */
function lsm_sports_deactivation() {
    flush_rewrite_rules();
}
add_action('switch_theme', 'lsm_sports_deactivation');



/**
 * Temporary function to flush rewrite rules - call this once after adding custom post types
 * This can be removed after the first page load
 */
function lsm_sports_flush_rewrite_rules_once() {
    if (get_option('lsm_sports_flush_rewrite_rules_flag') != 'done') {
        lsm_sports_register_custom_post_types();
        lsm_sports_register_custom_taxonomies();
        flush_rewrite_rules();
        update_option('lsm_sports_flush_rewrite_rules_flag', 'done');
    }
}
add_action('init', 'lsm_sports_flush_rewrite_rules_once', 999);
