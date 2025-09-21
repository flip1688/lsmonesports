<?php
/**
 * The template for displaying the footer
 */

?>

    <footer id="colophon" class="site-footer bg-gray-900 text-white">
        <div class="container mx-auto px-4 py-12">
            <?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4')) : ?>
                <div class="footer-widgets grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                    <?php if (is_active_sidebar('footer-1')) : ?>
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar('footer-1'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (is_active_sidebar('footer-2')) : ?>
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar('footer-2'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (is_active_sidebar('footer-3')) : ?>
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar('footer-3'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (is_active_sidebar('footer-4')) : ?>
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar('footer-4'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="footer-bottom border-t border-gray-700 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="site-info text-center md:text-left mb-4 md:mb-0">
                        <?php
                        $footer_text = get_theme_mod('lsm_sports_footer_text', '');
                        if ($footer_text) :
                            echo wp_kses_post($footer_text);
                        else :
                        ?>
                            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('All rights reserved.', 'lsm-sports'); ?></p>
                            <p class="mt-2 text-gray-400">
                                <?php esc_html_e('Powered by', 'lsm-sports'); ?> 
                                <a href="<?php echo esc_url(__('https://wordpress.org/')); ?>" class="hover:text-white transition-colors">WordPress</a>
                                <?php esc_html_e('&', 'lsm-sports'); ?> 
                                <a href="https://tailwindcss.com/" class="hover:text-white transition-colors" target="_blank" rel="noopener">TailwindCSS</a>
                            </p>
                        <?php endif; ?>
                    </div>

                    <?php
                    $social_links = lsm_sports_get_social_links();
                    $has_social = false;
                    foreach ($social_links as $social) {
                        if (!empty($social['url'])) {
                            $has_social = true;
                            break;
                        }
                    }
                    
                    if ($has_social) :
                    ?>
                        <div class="social-links">
                            <div class="flex space-x-4">
                                <?php foreach ($social_links as $platform => $social) : ?>
                                    <?php if (!empty($social['url'])) : ?>
                                        <a href="<?php echo esc_url($social['url']); ?>" 
                                           class="text-gray-400 hover:text-white transition-colors p-2 rounded-full hover:bg-gray-800"
                                           target="_blank" 
                                           rel="noopener noreferrer"
                                           aria-label="<?php echo esc_attr(ucfirst($platform)); ?>">
                                            <?php echo $social['icon']; ?>
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
