<header id="masthead" class="site-header bg-none bg-opacity-50 backdrop-blur-md shadow-lg fixed top-0 left-0 right-0 w-full z-50 transition-all duration-300">
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center">
            <div class="site-branding hidden lg:block">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <h1 class="site-title text-2xl font-bold text-gray-900">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-blue-600 transition-colors">
                            <?php bloginfo('name'); ?>
                        </a>
                    </h1>
                    <?php
                    $description = get_bloginfo('description', 'display');
                    if ($description || is_customize_preview()) :
                    ?>
                        <p class="site-description text-gray-600 mt-1"><?php echo $description; ?></p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <nav id="site-navigation" class="main-navigation hidden lg:block">
                <div class="flex space-x-6 items-center">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'menu_class'     => 'flex space-x-6',
                    'link_class'     => 'text-white hover:text-blue-600 transition-colors font-medium',
                ));
                ?>
                    <div>
                        <a href="/register" class="px-12 text-base bg-gradient-to-b from-[#FFC900] to-[#F89939] text-white font-semibold py-2 rounded-md hover:bg-[#FDB714] transition-colors duration-200">
                            สมัครสมาชิก
                        </a>
                    </div>
                </div>
            </nav>

            <!-- Mobile menu button -->
            <button class="lg:hidden p-2 rounded-md text-gray-700 hover:text-blue-600 hover:bg-gray-100" id="mobile-menu-button">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile menu -->
        <nav id="mobile-menu" class="lg:hidden mt-4 hidden">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'menu-1',
                'menu_id'        => 'mobile-primary-menu',
                'container'      => false,
                'menu_class'     => 'flex flex-col space-y-2',
                'link_class'     => 'text-white hover:text-blue-600 transition-colors font-medium py-2',
            ));
            ?>
        </nav>
    </div>
</header>
