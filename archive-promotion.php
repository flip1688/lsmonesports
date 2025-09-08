<?php
/**
 * The template for displaying promotion archives
 *
 * @package LSM_Sports
 */

get_header();
?>

<main id="primary" class="site-main min-h-screen">
    <div class="w-full mx-auto">
        
        <?php if (have_posts()) : ?>
            
            <div class="page-header w-full">
                <div class="relative min-h-fit text-center bg-fixed"  style="background-image: url('<?php echo get_template_directory_uri(); ?>/src/img/promotion-heading.png'); background-size: 100% auto;">
                    <div class="max-w-7xl mx-auto pt-24 pb-16">
                        <div class="flex justify-center items-center md:justify-start md:items-start mb-8">
                            <div class="flex flex-col items-center justify-center">
                                <h1 class="page-title text-3xl font-bold md:text-4xl text-white max-w-2xl" >
                                โปรโมชั่น ONE-All Sports <br>
แจกโบนัสและสิทธิพิเศษทุกวัน
                                </h1>
                                <p class="align-center text-white mt-4 max-w-2xl">
                                    พบกับโปรโมชั่นสุดคุ้มจาก ONE-All Sports เว็บพนันกีฬาออนไลน์ที่พร้อมมอบโบนัสและสิทธิพิเศษให้สมาชิกทุกท่าน ไม่ว่าจะเป็นผู้เล่นใหม่หรือผู้เล่นประจำ รับรองว่าคุ้มค่าและใช้ได้จริง ครอบคลุมทั้งโบนัสต้อนรับ โปรโมชั่นฝากเงิน และกิจกรรมพิเศษประจำเดือน
                                </p>
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

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <?php
                /* Start the Loop */
                while (have_posts()) :
                    the_post();
                ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300'); ?>>
                        
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="aspect-w-16 aspect-h-9">
                                <a href="<?php the_permalink(); ?>" class="block">
                                    <?php the_post_thumbnail('lsm-card-thumb', array('class' => 'w-full h-48 object-cover')); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="p-6">
                            <header class="entry-header mb-4">
                                <?php
                                the_title('<h2 class="entry-title text-xl font-semibold text-gray-900 mb-2"><a href="' . esc_url(get_permalink()) . '" class="hover:text-blue-600 transition-colors duration-200">', '</a></h2>');
                                ?>
                                
                                <div class="entry-meta text-sm text-gray-500 mb-3">
                                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                        <?php echo esc_html(get_the_date()); ?>
                                    </time>
                                    
                                    <?php
                                    $promotion_categories = get_the_terms(get_the_ID(), 'promotion_category');
                                    if ($promotion_categories && !is_wp_error($promotion_categories)) :
                                    ?>
                                        <span class="separator mx-2">•</span>
                                        <span class="categories">
                                            <?php
                                            $category_links = array();
                                            foreach ($promotion_categories as $category) {
                                                $category_links[] = '<a href="' . esc_url(get_term_link($category)) . '" class="hover:text-blue-600">' . esc_html($category->name) . '</a>';
                                            }
                                            echo implode(', ', $category_links);
                                            ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </header><!-- .entry-header -->

                            <div class="entry-summary text-gray-600 mb-4">
                                <?php the_excerpt(); ?>
                            </div><!-- .entry-summary -->
                            
                            <footer class="entry-footer">
                                <a href="<?php the_permalink(); ?>" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors duration-200">
                                    <?php esc_html_e('Read More', 'lsm-sports'); ?>
                                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </footer><!-- .entry-footer -->
                        </div>
                        
                    </article><!-- #post-<?php the_ID(); ?> -->
                    
                <?php endwhile; ?>
                
            </div><!-- .grid -->

            <?php
            the_posts_navigation(array(
                'prev_text' => __('&larr; Older Promotions', 'lsm-sports'),
                'next_text' => __('Newer Promotions &rarr;', 'lsm-sports'),
                'class' => 'mt-8'
            ));
            ?>

        <?php else : ?>

            <section class="no-results not-found">
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
        
    </div><!-- .container -->
</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
