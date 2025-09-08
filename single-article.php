<?php
/**
 * The template for displaying single article posts
 *
 * @package LSM_Sports
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container mx-auto px-4 py-8">
        
        <?php while (have_posts()) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-lg overflow-hidden'); ?>>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="featured-image mb-8">
                        <?php the_post_thumbnail('lsm-hero', array('class' => 'w-full h-96 object-cover rounded-t-lg')); ?>
                    </div>
                <?php endif; ?>
                
                <div class="content-wrapper px-8 pb-8">
                    
                    <header class="entry-header mb-8">
                        <?php the_title('<h1 class="entry-title text-4xl font-bold text-gray-900 mb-4">', '</h1>'); ?>
                        
                        <div class="entry-meta text-gray-600 mb-6">
                            <div class="flex flex-wrap items-center gap-6 text-sm">
                                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>" class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <?php echo esc_html(get_the_date()); ?>
                                </time>
                                
                                <div class="author flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <?php esc_html_e('By', 'lsm-sports'); ?> 
                                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="ml-1 font-medium text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                        <?php the_author(); ?>
                                    </a>
                                </div>
                                
                                <?php
                                $article_categories = get_the_terms(get_the_ID(), 'article_category');
                                if ($article_categories && !is_wp_error($article_categories)) :
                                ?>
                                    <div class="categories flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                        <?php
                                        $category_links = array();
                                        foreach ($article_categories as $category) {
                                            $category_links[] = '<a href="' . esc_url(get_term_link($category)) . '" class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium hover:bg-blue-200 transition-colors duration-200">' . esc_html($category->name) . '</a>';
                                        }
                                        echo implode(' ', $category_links);
                                        ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php
                                $article_tags = get_the_terms(get_the_ID(), 'article_tag');
                                if ($article_tags && !is_wp_error($article_tags)) :
                                ?>
                                    <div class="tags flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                        <?php
                                        $tag_links = array();
                                        foreach ($article_tags as $tag) {
                                            $tag_links[] = '<a href="' . esc_url(get_term_link($tag)) . '" class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-medium hover:bg-gray-200 transition-colors duration-200">' . esc_html($tag->name) . '</a>';
                                        }
                                        echo implode(' ', $tag_links);
                                        ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if (comments_open() || get_comments_number()) : ?>
                                    <div class="comments-count flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                        <a href="#comments" class="text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                            <?php
                                            $comments_number = get_comments_number();
                                            if ($comments_number == 0) {
                                                esc_html_e('No Comments', 'lsm-sports');
                                            } elseif ($comments_number == 1) {
                                                esc_html_e('1 Comment', 'lsm-sports');
                                            } else {
                                                printf(esc_html__('%s Comments', 'lsm-sports'), $comments_number);
                                            }
                                            ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </header><!-- .entry-header -->

                    <div class="entry-content prose prose-lg max-w-none">
                        <?php
                        the_content(sprintf(
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
                        ));

                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'lsm-sports'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div><!-- .entry-content -->

                    <footer class="entry-footer mt-8 pt-8 border-t border-gray-200">
                        <div class="flex flex-wrap justify-between items-center mb-6">
                            <div class="share-buttons">
                                <span class="text-sm font-medium text-gray-700 mr-4"><?php esc_html_e('Share this article:', 'lsm-sports'); ?></span>
                                <div class="inline-flex space-x-2">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                                       target="_blank" 
                                       class="bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 transition-colors duration-200">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                        </svg>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                                       target="_blank" 
                                       class="bg-blue-400 text-white p-2 rounded-md hover:bg-blue-500 transition-colors duration-200">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                        </svg>
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>" 
                                       target="_blank" 
                                       class="bg-blue-700 text-white p-2 rounded-md hover:bg-blue-800 transition-colors duration-200">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="back-to-archive">
                                <a href="<?php echo esc_url(get_post_type_archive_link('article')); ?>" 
                                   class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                    <?php esc_html_e('Back to Articles', 'lsm-sports'); ?>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Author Bio -->
                        <?php
                        $author_bio = get_the_author_meta('description');
                        if ($author_bio) :
                        ?>
                            <div class="author-bio bg-gray-50 rounded-lg p-6 mb-6">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0">
                                        <?php echo get_avatar(get_the_author_meta('ID'), 64, '', '', array('class' => 'rounded-full')); ?>
                                    </div>
                                    <div class="flex-grow">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                            <?php esc_html_e('About', 'lsm-sports'); ?> <?php the_author(); ?>
                                        </h3>
                                        <p class="text-gray-600 mb-3"><?php echo wp_kses_post($author_bio); ?></p>
                                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" 
                                           class="text-blue-600 hover:text-blue-800 text-sm font-medium transition-colors duration-200">
                                            <?php esc_html_e('View all posts by', 'lsm-sports'); ?> <?php the_author(); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </footer><!-- .entry-footer -->
                    
                </div><!-- .content-wrapper -->
                
            </article><!-- #post-<?php the_ID(); ?> -->

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>

            <?php
            // Related articles
            $related_args = array(
                'post_type' => 'article',
                'posts_per_page' => 3,
                'post__not_in' => array(get_the_ID()),
                'orderby' => 'rand'
            );
            
            $article_categories = get_the_terms(get_the_ID(), 'article_category');
            if ($article_categories && !is_wp_error($article_categories)) {
                $category_ids = wp_list_pluck($article_categories, 'term_id');
                $related_args['tax_query'] = array(
                    array(
                        'taxonomy' => 'article_category',
                        'field'    => 'term_id',
                        'terms'    => $category_ids,
                    ),
                );
            }
            
            $related_articles = new WP_Query($related_args);
            
            if ($related_articles->have_posts()) :
            ?>
                <section class="related-articles mt-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6"><?php esc_html_e('Related Articles', 'lsm-sports'); ?></h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <?php while ($related_articles->have_posts()) : $related_articles->the_post(); ?>
                            <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('lsm-card-thumb', array('class' => 'w-full h-48 object-cover')); ?>
                                    </a>
                                <?php endif; ?>
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold mb-2">
                                        <a href="<?php the_permalink(); ?>" class="text-gray-900 hover:text-blue-600 transition-colors duration-200">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-2"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                    <div class="text-xs text-gray-500">
                                        <?php echo esc_html(get_the_date()); ?> • <?php esc_html_e('By', 'lsm-sports'); ?> <?php the_author(); ?>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>
                </section>
            <?php
                wp_reset_postdata();
            endif;
            ?>

        <?php endwhile; // End of the loop. ?>
        
    </div><!-- .container -->
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
