<?php get_header(); ?>

    <div id="content" class="site-content relative">
        <div class="">
            <main id="primary" class="site-main w-full">
             <?php if ( have_posts() ) : ?>
                 <?php while ( have_posts() ) : the_post(); ?>
            <article class="">
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="mb-8">
                        <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto rounded-lg' ) ); ?>
                    </div>
                <?php endif; ?>

                <div class="prose lg:prose-xl max-w-none">
                    <?php the_content(); ?>
                </div>

                <?php
                // If the page has child pages, display them
                $children = wp_list_pages( array(
                    'child_of'    => get_the_ID(),
                    'title_li'    => '',
                    'echo'        => 0,
                    'depth'       => 1,
                ) );

                if ( $children ) : ?>
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Subpages</h2>
                        <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <?php echo $children; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </article>

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                echo '<div class="mt-8">';
                comments_template();
                echo '</div>';
            endif;
            ?>

        <?php endwhile; ?>
    <?php else : ?>
        <div class="text-center py-12">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Page Not Found</h1>
            <p class="text-gray-700 mb-6">Sorry, the page you're looking for doesn't exist.</p>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="bg-brand-primary text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-300">
                Return Home
            </a>
        </div>
    <?php endif; ?>
            </main>
        </div>
    </div>

<?php get_footer(); ?>
