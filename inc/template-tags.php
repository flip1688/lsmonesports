<?php
/**
 * Custom template tags for this theme
 */

if (!function_exists('lsm_sports_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function lsm_sports_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );

        $posted_on = sprintf(
            /* translators: %s: post date. */
            esc_html_x('Posted on %s', 'post date', 'lsm-sports'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark" class="text-primary-600 hover:text-primary-800 transition-colors">' . $time_string . '</a>'
        );

        echo '<span class="posted-on text-sm text-gray-500">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;

if (!function_exists('lsm_sports_posted_by')) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function lsm_sports_posted_by() {
        $byline = sprintf(
            /* translators: %s: post author. */
            esc_html_x('by %s', 'post author', 'lsm-sports'),
            '<span class="author vcard"><a class="url fn n text-primary-600 hover:text-primary-800 transition-colors" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<span class="byline text-sm text-gray-500"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;

if (!function_exists('lsm_sports_entry_footer')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function lsm_sports_entry_footer() {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(', ', 'lsm-sports'));
            if ($categories_list) {
                /* translators: 1: list of categories. */
                printf('<span class="cat-links inline-flex items-center text-sm text-gray-500 mr-4"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>' . esc_html__('Posted in %1$s', 'lsm-sports') . '</span>', $categories_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'lsm-sports'));
            if ($tags_list) {
                /* translators: 1: list of tags. */
                printf('<span class="tags-links inline-flex items-center text-sm text-gray-500"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>' . esc_html__('Tagged %1$s', 'lsm-sports') . '</span>', $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }
        }

        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link inline-flex items-center text-sm text-gray-500 ml-4">';
            echo '<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'lsm-sports'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post(get_the_title())
                ),
                null,
                null,
                'text-primary-600 hover:text-primary-800 transition-colors'
            );
            echo '</span>';
        }

        edit_post_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Edit <span class="screen-reader-text">%s</span>', 'lsm-sports'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            ),
            '<span class="edit-link inline-flex items-center text-sm text-gray-500 ml-4"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>',
            '</span>',
            null,
            'text-primary-600 hover:text-primary-800 transition-colors'
        );
    }
endif;

if (!function_exists('lsm_sports_post_thumbnail')) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function lsm_sports_post_thumbnail() {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }

        if (is_singular()) :
            ?>
            <div class="post-thumbnail mb-6">
                <?php the_post_thumbnail('large', array('class' => 'w-full h-auto rounded-lg shadow-md')); ?>
            </div><!-- .post-thumbnail -->
        <?php else : ?>
            <a class="post-thumbnail block mb-4 group" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php
                the_post_thumbnail(
                    'medium_large',
                    array(
                        'class' => 'w-full h-48 object-cover rounded-lg group-hover:opacity-90 transition-opacity',
                        'alt' => the_title_attribute(
                            array(
                                'echo' => false,
                            )
                        ),
                    )
                );
                ?>
            </a>
            <?php
        endif; // End is_singular().
    }
endif;

if (!function_exists('wp_body_open')) :
    /**
     * Shim for sites older than 5.2.
     *
     * @link https://core.trac.wordpress.org/ticket/12563
     */
    function wp_body_open() {
        do_action('wp_body_open');
    }
endif;

if (!function_exists('lsm_sports_comment_form')) :
    /**
     * Custom comment form
     */
    function lsm_sports_comment_form() {
        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');
        $aria_req = ($req ? " aria-required='true'" : '');

        $fields = array(
            'author' => '<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4"><div><label for="author" class="block text-sm font-medium text-gray-700 mb-1">' . __('Name', 'lsm-sports') . ($req ? ' <span class="text-red-500">*</span>' : '') . '</label>' .
                '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" class="form-input"' . $aria_req . ' /></div>',
            'email' => '<div><label for="email" class="block text-sm font-medium text-gray-700 mb-1">' . __('Email', 'lsm-sports') . ($req ? ' <span class="text-red-500">*</span>' : '') . '</label>' .
                '<input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" class="form-input"' . $aria_req . ' /></div></div>',
            'url' => '<div class="mb-4"><label for="url" class="block text-sm font-medium text-gray-700 mb-1">' . __('Website', 'lsm-sports') . '</label>' .
                '<input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" class="form-input" /></div>',
        );

        $args = array(
            'fields' => $fields,
            'comment_field' => '<div class="mb-4"><label for="comment" class="block text-sm font-medium text-gray-700 mb-1">' . _x('Comment', 'noun', 'lsm-sports') . ' <span class="text-red-500">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" class="form-textarea" aria-required="true"></textarea></div>',
            'class_submit' => 'btn-primary',
            'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
            'title_reply' => __('Leave a Reply', 'lsm-sports'),
            'title_reply_to' => __('Leave a Reply to %s', 'lsm-sports'),
            'cancel_reply_link' => __('Cancel Reply', 'lsm-sports'),
            'label_submit' => __('Post Comment', 'lsm-sports'),
        );

        comment_form($args);
    }
endif;
