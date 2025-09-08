<?php
/**
 * The template for displaying article archives
 *
 * @package LSM_Sports
 */

get_header();
?>

<main id="primary" class="site-main min-h-screen">
    <div class="w-full mx-auto ">
        <div class="page-header w-full">
            <div class="relative min-h-fit text-center bg-fixed"  style="background-image: url('<?php echo get_template_directory_uri(); ?>/src/img/article-heading.png'); background-size: 100% auto;">
                <div class="max-w-7xl mx-auto pt-24 pb-16">
                    <div class="flex justify-center items-center md:justify-start md:items-start mb-8">
                        <div class="flex flex-col items-center justify-center">
                            <h1 class="page-title text-3xl font-bold md:text-4xl text-white max-w-2xl" >
                                บทความ ONE-All Sports เทคนิคเดิมพัน <br>
กีฬาออนไลน์ & คาสิโนออนไลน์
                            </h1>
                            <p class="align-center text-white mt-4 max-w-2xl">
                                    ศูนย์รวมบทความคุณภาพ ที่คัดสรรมาเพื่อผู้เล่น ทั้ง เทคนิคการเดิมพันกีฬาออนไลน์ วิธีสมัคร โปรโมชั่นล่าสุด รีวิวเกมยอดนิยม และเคล็ดลับในการเล่นอย่างมืออาชีพ
                            </p>
                            <div class="space-y-12"></div>
                            <div class="flex-row items-center justify-stretch mt-6">
                                <a href="#promotion-list" class="inline-block px-6 py-3 bg-gradient-to-b from-[#FFC900] to-[#F89939] text-white font-medium rounded-md hover:bg-blue-700 transition-colors duration-200">
                                        สมัครสมาชิก
                                </a>
                                <a href="#promotion-list" class="inline-block px-6 py-3 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition-colors duration-200">
                                        เข้าสู่ระบบ
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .page-header -->
        <div class="bg-gradient-to-br from-[#A5D4FF] to-50% to-white/40 bg-opacity-25">
        <?php if (have_posts()) : ?>
            

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-7xl mx-auto p-6" id="article-list">

                <?php
                /* Start the Loop */
                while (have_posts()) :
                    the_post();
                ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300'); ?>>
                        
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="aspect-w-16 aspect-h-9">
                                <a href="<?php the_permalink(); ?>" class="block">
                                    <?php the_post_thumbnail('lsm-hero', array('class' => 'w-full h-64 object-cover')); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="p-6">
                            <header class="entry-header mb-4">
                                <?php
                                the_title('<h2 class="entry-title text-2xl font-bold text-gray-900 mb-3"><a href="' . esc_url(get_permalink()) . '" class="hover:text-blue-600 transition-colors duration-200">', '</a></h2>');
                                ?>
                                
                                <div class="entry-meta text-sm text-gray-500 mb-3 flex flex-wrap items-center gap-4">
                                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                        <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <?php echo esc_html(get_the_date()); ?>
                                    </time>
                                    
                                    <span class="author">
                                        <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <?php esc_html_e('By', 'lsm-sports'); ?> 
                                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="hover:text-blue-600">
                                            <?php the_author(); ?>
                                        </a>
                                    </span>
                                    
                                    <?php
                                    $article_categories = get_the_terms(get_the_ID(), 'article_category');
                                    if ($article_categories && !is_wp_error($article_categories)) :
                                    ?>
                                        <span class="categories">
                                            <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                            </svg>
                                            <?php
                                            $category_links = array();
                                            foreach ($article_categories as $category) {
                                                $category_links[] = '<a href="' . esc_url(get_term_link($category)) . '" class="hover:text-blue-600">' . esc_html($category->name) . '</a>';
                                            }
                                            echo implode(', ', $category_links);
                                            ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </header><!-- .entry-header -->

                            <div class="entry-summary text-gray-600 mb-6 leading-relaxed">
                                <?php the_excerpt(); ?>
                            </div><!-- .entry-summary -->
                            
                            <footer class="entry-footer flex justify-between items-center">
                                <a href="<?php the_permalink(); ?>" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors duration-200">
                                    <?php esc_html_e('Read Full Article', 'lsm-sports'); ?>
                                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                                
                                <?php if (comments_open() || get_comments_number()) : ?>
                                    <div class="comments-link text-sm text-gray-500">
                                        <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                        <a href="<?php the_permalink(); ?>#comments" class="hover:text-blue-600">
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
                            </footer><!-- .entry-footer -->
                        </div>
                        
                    </article><!-- #post-<?php the_ID(); ?> -->
                    
                <?php endwhile; ?>
                
            </div><!-- .grid -->

            <?php
            the_posts_navigation(array(
                'prev_text' => __('&larr; Older Articles', 'lsm-sports'),
                'next_text' => __('Newer Articles &rarr;', 'lsm-sports'),
                'class' => 'mt-8'
            ));
            ?>

        <?php else : ?>

            <section class="no-results not-found max-w-7xl mx-auto pt-40">
                <header class="page-header">
                    <h1 class="page-title text-2xl font-bold text-gray-900 mb-4">
                        <?php esc_html_e('Nothing here', 'lsm-sports'); ?>
                    </h1>
                </header><!-- .page-header -->

                <div class="page-content text-gray-600">
                    <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try a search?', 'lsm-sports'); ?></p>
                    <?php get_search_form(); ?>
                </div><!-- .page-content -->
            </section><!-- .no-results -->

        <?php endif; ?>
        </div>
    </div><!-- .container -->
</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
