<?php get_header(); ?>

    <div id="content" class="site-content">
        <div class="container mx-auto px-4 py-8">
            <main id="primary" class="site-main">
                <?php if (have_posts()) : ?>
                    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                        <?php while (have_posts()) : ?>
                            <?php the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow'); ?>>
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="aspect-w-16 aspect-h-9">
                                        <?php the_post_thumbnail('medium_large', array('class' => 'w-full h-48 object-cover')); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="p-6">
                                    <header class="entry-header mb-4">
                                        <?php the_title('<h2 class="entry-title text-xl font-semibold text-gray-900 mb-2"><a href="' . esc_url(get_permalink()) . '" class="hover:text-blue-600 transition-colors">', '</a></h2>'); ?>
                                        
                                        <div class="entry-meta text-sm text-gray-500">
                                            <time class="published" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                                <?php echo esc_html(get_the_date()); ?>
                                            </time>
                                            <span class="byline"> by 
                                                <span class="author vcard">
                                                    <a class="url fn n hover:text-blue-600 transition-colors" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                                        <?php echo esc_html(get_the_author()); ?>
                                                    </a>
                                                </span>
                                            </span>
                                        </div>
                                    </header>

                                    <div class="entry-summary text-gray-600 mb-4">
                                        <?php the_excerpt(); ?>
                                    </div>

                                    <footer class="entry-footer">
                                        <a href="<?php echo esc_url(get_permalink()); ?>" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                            Read More
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </footer>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <div class="mt-12">
                        <?php
                        the_posts_navigation(array(
                            'prev_text' => '<span class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors"><svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>Older Posts</span>',
                            'next_text' => '<span class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">Newer Posts<svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></span>',
                        ));
                        ?>
                    </div>
                <?php else : ?>
                    <section class="no-results not-found bg-white rounded-lg shadow-md p-8 text-center">
                        <header class="page-header mb-6">
                            <h1 class="page-title text-2xl font-semibold text-gray-900">Nothing here</h1>
                        </header>

                        <div class="page-content text-gray-600">
                            <p class="mb-4">It looks like nothing was found at this location. Maybe try one of the links below or a search?</p>
                            <?php get_search_form(); ?>
                        </div>
                    </section>
                <?php endif; ?>
            </main>
        </div>
    </div>

<?php get_footer(); ?>
