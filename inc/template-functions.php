<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function lsm_sports_body_classes($classes) {
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
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function lsm_sports_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'lsm_sports_pingback_header');

/**
 * Add custom logo support
 */
function lsm_sports_custom_logo_setup() {
    $defaults = array(
        'height'               => 100,
        'width'                => 400,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => array('site-title', 'site-description'),
        'unlink-homepage-logo' => true,
    );

    add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'lsm_sports_custom_logo_setup');

/**
 * Enqueue Google Fonts
 */
function lsm_sports_google_fonts() {
    $fonts_url = '';

    /*
     * Translators: If there are characters in your language that are not
     * supported by Inter, translate this to 'off'. Do not translate
     * into your own language.
     */
    $inter = _x('on', 'Inter font: on or off', 'lsm-sports');

    /*
     * Translators: If there are characters in your language that are not
     * supported by Merriweather, translate this to 'off'. Do not translate
     * into your own language.
     */
    $merriweather = _x('on', 'Merriweather font: on or off', 'lsm-sports');

    if ('off' !== $inter || 'off' !== $merriweather) {
        $font_families = array();

        if ('off' !== $inter) {
            $font_families[] = 'Inter:300,400,500,600,700';
        }

        if ('off' !== $merriweather) {
            $font_families[] = 'Merriweather:300,400,700';
        }

        $query_args = array(
            'family'  => urlencode(implode('|', $font_families)),
            'subset'  => urlencode('latin,latin-ext'),
            'display' => urlencode('swap'),
        );

        $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
    }

    if ($fonts_url) {
        wp_enqueue_style('lsm-sports-google-fonts', $fonts_url, array(), null);
    }
}
add_action('wp_enqueue_scripts', 'lsm_sports_google_fonts');

/**
 * Add preconnect for Google Fonts
 */
function lsm_sports_resource_hints($urls, $relation_type) {
    if (wp_style_is('lsm-sports-google-fonts', 'queue') && 'preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }

    return $urls;
}
add_filter('wp_resource_hints', 'lsm_sports_resource_hints', 10, 2);

/**
 * Custom search form
 */
function lsm_sports_search_form($form) {
    $form = '<form role="search" method="get" class="search-form flex" action="' . home_url('/') . '">
        <label class="sr-only">
            <span class="screen-reader-text">' . _x('Search for:', 'label', 'lsm-sports') . '</span>
        </label>
        <input type="search" class="search-field form-input flex-1 mr-2" placeholder="' . esc_attr_x('Search &hellip;', 'placeholder', 'lsm-sports') . '" value="' . get_search_query() . '" name="s" />
        <button type="submit" class="search-submit btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <span class="sr-only">' . _x('Search', 'submit button', 'lsm-sports') . '</span>
        </button>
    </form>';

    return $form;
}
add_filter('get_search_form', 'lsm_sports_search_form');

/**
 * Modify excerpt more link
 */
function lsm_sports_excerpt_more($link) {
    if (is_admin()) {
        return $link;
    }

    $link = sprintf(
        '<p class="link-more mt-4"><a href="%1$s" class="more-link btn-outline">%2$s</a></p>',
        esc_url(get_permalink(get_the_ID())),
        /* translators: %s: Name of current post */
        sprintf(__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'lsm-sports'), get_the_title(get_the_ID()))
    );
    return ' &hellip; ' . $link;
}
add_filter('excerpt_more', 'lsm_sports_excerpt_more');

/**
 * Add custom post navigation
 */
function lsm_sports_post_navigation() {
    $prev_post = get_previous_post();
    $next_post = get_next_post();

    if (!$prev_post && !$next_post) {
        return;
    }

    echo '<nav class="post-navigation flex justify-between items-center py-8 border-t border-gray-200 mt-8">';

    if ($prev_post) {
        echo '<div class="nav-previous flex-1">';
        echo '<a href="' . get_permalink($prev_post) . '" class="flex items-center text-gray-600 hover:text-primary-600 transition-colors group">';
        echo '<svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>';
        echo '<div>';
        echo '<div class="text-sm text-gray-500">' . __('Previous Post', 'lsm-sports') . '</div>';
        echo '<div class="font-medium">' . get_the_title($prev_post) . '</div>';
        echo '</div>';
        echo '</a>';
        echo '</div>';
    }

    if ($next_post) {
        echo '<div class="nav-next flex-1 text-right">';
        echo '<a href="' . get_permalink($next_post) . '" class="flex items-center justify-end text-gray-600 hover:text-primary-600 transition-colors group">';
        echo '<div>';
        echo '<div class="text-sm text-gray-500">' . __('Next Post', 'lsm-sports') . '</div>';
        echo '<div class="font-medium">' . get_the_title($next_post) . '</div>';
        echo '</div>';
        echo '<svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>';
        echo '</a>';
        echo '</div>';
    }

    echo '</nav>';
}

/**
 * Custom comment list
 */
function lsm_sports_comment($comment, $args, $depth) {
    if ('pingback' == $comment->comment_type || 'trackback' == $comment->comment_type) : ?>
        <li id="comment-<?php comment_ID(); ?>" <?php comment_class('pingback'); ?>>
            <div class="comment-body">
                <?php _e('Pingback:', 'lsm-sports'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(__('Edit', 'lsm-sports'), '<span class="edit-link">', '</span>'); ?>
            </div>
    <?php else : ?>
        <li id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?>>
            <article id="div-comment-<?php comment_ID(); ?>" class="comment-body bg-white rounded-lg p-6 shadow-sm">
                <footer class="comment-meta flex items-center space-x-4 mb-4">
                    <div class="comment-author vcard">
                        <?php if (0 != $args['avatar_size']) echo get_avatar($comment, $args['avatar_size'], '', '', array('class' => 'w-10 h-10 rounded-full')); ?>
                    </div>
                    <div class="flex-1">
                        <div class="comment-metadata text-sm text-gray-500">
                            <?php
                            printf(
                                '<cite class="fn font-medium text-gray-900">%s</cite>',
                                get_comment_author_link()
                            );
                            ?>
                            <time datetime="<?php comment_time('c'); ?>" class="ml-2">
                                <?php
                                /* translators: 1: comment date, 2: comment time */
                                printf(__('%1$s at %2$s', 'lsm-sports'), get_comment_date(), get_comment_time());
                                ?>
                            </time>
                            <?php edit_comment_link(__('Edit', 'lsm-sports'), '<span class="edit-link ml-2">', '</span>'); ?>
                        </div>
                    </div>
                </footer>

                <div class="comment-content prose prose-sm max-w-none">
                    <?php if ('0' == $comment->comment_approved) : ?>
                        <p class="comment-awaiting-moderation text-yellow-600 bg-yellow-50 p-3 rounded-md"><?php _e('Your comment is awaiting moderation.', 'lsm-sports'); ?></p>
                    <?php endif; ?>
                    <?php comment_text(); ?>
                </div>

                <div class="reply mt-4">
                    <?php
                    comment_reply_link(
                        array_merge(
                            $args,
                            array(
                                'add_below' => 'div-comment',
                                'depth'     => $depth,
                                'max_depth' => $args['max_depth'],
                                'class'     => 'btn-outline btn-sm',
                            )
                        )
                    );
                    ?>
                </div>
            </article>
    <?php endif;
}

/**
 * Add theme support for block editor color palette
 */
function lsm_sports_editor_color_palette() {
    add_theme_support(
        'editor-color-palette',
        array(
            array(
                'name'  => __('Primary', 'lsm-sports'),
                'slug'  => 'primary',
                'color' => '#2563eb',
            ),
            array(
                'name'  => __('Secondary', 'lsm-sports'),
                'slug'  => 'secondary',
                'color' => '#64748b',
            ),
            array(
                'name'  => __('Accent', 'lsm-sports'),
                'slug'  => 'accent',
                'color' => '#dc2626',
            ),
            array(
                'name'  => __('White', 'lsm-sports'),
                'slug'  => 'white',
                'color' => '#ffffff',
            ),
            array(
                'name'  => __('Black', 'lsm-sports'),
                'slug'  => 'black',
                'color' => '#000000',
            ),
            array(
                'name'  => __('Gray', 'lsm-sports'),
                'slug'  => 'gray',
                'color' => '#6b7280',
            ),
        )
    );
}
add_action('after_setup_theme', 'lsm_sports_editor_color_palette');

/**
 * Add theme support for block editor font sizes
 */
function lsm_sports_editor_font_sizes() {
    add_theme_support(
        'editor-font-sizes',
        array(
            array(
                'name' => __('Small', 'lsm-sports'),
                'size' => 14,
                'slug' => 'small',
            ),
            array(
                'name' => __('Normal', 'lsm-sports'),
                'size' => 16,
                'slug' => 'normal',
            ),
            array(
                'name' => __('Medium', 'lsm-sports'),
                'size' => 20,
                'slug' => 'medium',
            ),
            array(
                'name' => __('Large', 'lsm-sports'),
                'size' => 24,
                'slug' => 'large',
            ),
            array(
                'name' => __('Extra Large', 'lsm-sports'),
                'size' => 32,
                'slug' => 'extra-large',
            ),
        )
    );
}
add_action('after_setup_theme', 'lsm_sports_editor_font_sizes');
