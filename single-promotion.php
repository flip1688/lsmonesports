<?php
/**
 * The template for displaying single promotion posts
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
                                
                                <?php
                                $promotion_categories = get_the_terms(get_the_ID(), 'promotion_category');
                                if ($promotion_categories && !is_wp_error($promotion_categories)) :
                                ?>
                                    <div class="categories flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                        <?php
                                        $category_links = array();
                                        foreach ($promotion_categories as $category) {
                                            $category_links[] = '<a href="' . esc_url(get_term_link($category)) . '" class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium hover:bg-blue-200 transition-colors duration-200">' . esc_html($category->name) . '</a>';
                                        }
                                        echo implode(' ', $category_links);
                                        ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php
                                $promotion_tags = get_the_terms(get_the_ID(), 'promotion_tag');
                                if ($promotion_tags && !is_wp_error($promotion_tags)) :
                                ?>
                                    <div class="tags flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                        <?php
                                        $tag_links = array();
                                        foreach ($promotion_tags as $tag) {
                                            $tag_links[] = '<a href="' . esc_url(get_term_link($tag)) . '" class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-medium hover:bg-gray-200 transition-colors duration-200">' . esc_html($tag->name) . '</a>';
                                        }
                                        echo implode(' ', $tag_links);
                                        ?>
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
                        <div class="flex flex-wrap justify-between items-center">
                            <div class="share-buttons">
                                <span class="text-sm font-medium text-gray-700 mr-4"><?php esc_html_e('Share this promotion:', 'lsm-sports'); ?></span>
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
                                </div>
                            </div>
                            
                            <div class="back-to-archive">
                                <a href="<?php echo esc_url(get_post_type_archive_link('promotion')); ?>" 
                                   class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                    <?php esc_html_e('Back to Promotions', 'lsm-sports'); ?>
                                </a>
                            </div>
                        </div>
                    </footer><!-- .entry-footer -->
                    
                </div><!-- .content-wrapper -->
                
            </article><!-- #post-<?php the_ID(); ?> -->

            <?php
            // Related promotions
            $related_args = array(
                'post_type' => 'promotion',
                'posts_per_page' => 3,
                'post__not_in' => array(get_the_ID()),
                'orderby' => 'rand'
            );
            
            $promotion_categories = get_the_terms(get_the_ID(), 'promotion_category');
            if ($promotion_categories && !is_wp_error($promotion_categories)) {
                $category_ids = wp_list_pluck($promotion_categories, 'term_id');
                $related_args['tax_query'] = array(
                    array(
                        'taxonomy' => 'promotion_category',
                        'field'    => 'term_id',
                        'terms'    => $category_ids,
                    ),
                );
            }
            
            $related_promotions = new WP_Query($related_args);
            
            if ($related_promotions->have_posts()) :
            ?>
                <section class="related-promotions mt-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6"><?php esc_html_e('Related Promotions', 'lsm-sports'); ?></h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <?php while ($related_promotions->have_posts()) : $related_promotions->the_post(); ?>
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
                                    <p class="text-gray-600 text-sm"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
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
