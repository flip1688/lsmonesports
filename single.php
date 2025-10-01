<?php
/**
 * The template for displaying all single posts
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main container mx-auto px-4 py-8">
        <?php
        while (have_posts()) :
            the_post();
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-md overflow-hidden mb-8'); ?>>
                <?php lsm_sports_post_thumbnail(); ?>
                
                <div class="p-8">
                    <header class="entry-header mb-6">
                        <?php the_title('<h1 class="entry-title text-3xl md:text-4xl font-bold text-gray-900 mb-4">', '</h1>'); ?>
                        
                        <div class="entry-meta flex flex-wrap items-center text-sm text-gray-500 space-x-4 mb-4">
                            <?php
                            lsm_sports_posted_on();
                            lsm_sports_posted_by();
                            ?>
                        </div>
                    </header>

                    <div class="entry-content prose prose-lg max-w-none">
                        <?php
                        the_content(
                            sprintf(
                                wp_kses(
                                    /* translators: %s: Name of current post. Only visible to screen readers */
                                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'lsm-sports'),
                                    array(
                                        'span' => array(
                                            'class' => array(),
                                        ),
                                    )
                                ),
                                wp_kses_post(get_the_title())
                            )
                        );

                        wp_link_pages(
                            array(
                                'before' => '<div class="page-links flex items-center space-x-2 mt-8 pt-8 border-t border-gray-200"><span class="font-medium text-gray-700">' . esc_html__('Pages:', 'lsm-sports') . '</span>',
                                'after'  => '</div>',
                                'link_before' => '<span class="inline-flex items-center justify-center w-8 h-8 bg-gray-100 hover:bg-primary-600 hover:text-white rounded transition-colors">',
                                'link_after' => '</span>',
                            )
                        );
                        ?>
                    </div>

                    <footer class="entry-footer mt-8 pt-6 border-t border-gray-200">
                        <?php lsm_sports_entry_footer(); ?>
                    </footer>
                </div>
            </article>

            <?php lsm_sports_post_navigation(); ?>

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) :
                ?>
                <div class="comments-section bg-white rounded-lg shadow-md p-8 mt-8">
                    <?php comments_template(); ?>
                </div>
                <?php
            endif;
            ?>

        <?php
        endwhile; // End of the loop.
        ?>
    </main>
</div>

<?php
get_sidebar();
get_footer();
