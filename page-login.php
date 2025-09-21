<?php get_header(); ?>

    <div id="content" class="site-content relative">
        <div class="">
            <main id="primary" class="site-main min-h-screen flex flex-col w-full">
                 <!-- Background Image -->
    <div class="absolute inset-0 bg-fixed max-h-screen bg-cover" style="background-image: url('<?php echo get_template_directory_uri(); ?>/src/img/login-bg.png');background-size:100% auto%"></div>

    <!-- Login Form Container -->
    <div class="relative z-10 flex items-center justify-center lg:justify-end min-h-fit pb-5 pt-16 lg:pt-32 max-w-7xl mx-auto w-full">
        <div class="w-full max-w-md mx-4">
            <!-- Login Form Card -->
            <div class="bg-gray-400 bg-opacity-30 backdrop-blur-sm rounded-2xl border border-none p-8 shadow-2xl">
                <!-- Logo -->
                <div class="text-center mb-8">
                    <img src="<?php echo get_template_directory_uri(); ?>/src/img/ONE-AllSports.webp" 
                         alt="<?php bloginfo( 'name' ); ?>" 
                         class="h-auto w-auto mx-auto mb-4">
                </div>

                <!-- Form Title -->
                <h2 class="text-2xl font-bold text-white text-center mb-8">เข้าสู่ระบบ</h2>

                <!-- Login Form -->
                <form id="login-form" class="space-y-6" method="post" action="">
                    <?php wp_nonce_field('login_user', 'login_nonce'); ?>
                    
                    <!-- Username Field -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-300 mb-2">User</label>
                        <input type="text" 
                               id="username" 
                               name="username" 
                               required
                               class="w-full px-4 py-3 bg-gray-400 bg-opacity-30 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-300 transition duration-300"
                               placeholder="กรอกชื่อผู้ใช้/หมายเลขโทรศัพท์">
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required
                               class="w-full px-4 py-3 bg-gray-400 bg-opacity-30 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-300 transition duration-300"
                               placeholder="กรอกรหัสผ่าน">
                    </div>

                    <!-- Login Button -->
                    <button type="submit" 
                            name="login_submit"
                            class="w-full bg-[#F5D929] text-[#0E0D09] font-semibold py-3 px-6 rounded-lg transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50">
                        เข้าสู่ระบบ
                    </button>

                    <!-- Divider -->
                    <div class="text-center text-gray-400 text-sm my-6">
                        ยังไม่เป็นสมาชิก?
                    </div>

                    <!-- Register Link -->
                    <a href="https://play.lsm-onesports.info/register?partner=103" 
                       class="block w-full text-center bg-[#006EEB]  text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                        สมัครสมาชิก
                    </a>
                </form>

                <!-- Error/Success Messages -->
                <div id="form-messages" class="mt-4"></div>
            </div>
        </div>
    </div>
    <article class="">
    <!-- Page Content (if any) -->
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <div class="relative z-10 container mx-auto px-4 py-8">
                <div class="prose lg:prose-xl max-w-none text-white">
                    <?php the_content(); ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
    </article>
            </main>
        </div>
    </div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('login-form');
    const messagesDiv = document.getElementById('form-messages');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        const username = formData.get('username');
        const password = formData.get('password');
        
        // Clear previous messages
        messagesDiv.innerHTML = '';
        
        // Validate required fields
        if (!username || !password) {
            showMessage('กรุณากรอกชื่อผู้ใช้และรหัสผ่าน', 'error');
            return;
        }
        
        // Show loading state
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'กำลังเข้าสู่ระบบ...';
        submitBtn.disabled = true;
        
        // Call external login API
        login(username, password)
            .then(token => {
                showMessage('เข้าสู่ระบบสำเร็จ! กำลังเปลี่ยนหน้า...', 'success');
                
                // Get the configured login redirect URL
                const loginUrl = '<?php echo get_option('onesports_login_url', ''); ?>';
                
                setTimeout(() => {
                    if (loginUrl) {
                        // Redirect to configured URL with token parameter
                        const separator = loginUrl.includes('?') ? '&' : '?';
                        window.location.href = loginUrl + separator + 'token=' + encodeURIComponent(token);
                    } else {
                        // Fallback to home page if no login URL configured
                        window.location.href = '<?php echo esc_url( home_url( '/' ) ); ?>';
                    }
                }, 2000);
            })
            .catch(error => {
                showMessage(error.message || 'เกิดข้อผิดพลาดในการเข้าสู่ระบบ', 'error');
            })
            .finally(() => {
                // Reset button state
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            });
    });

    function showMessage(message, type) {
        const messagesDiv = document.getElementById('form-messages');
        const alertClass = type === 'success' ? 'bg-green-600' : 'bg-red-600';
        
        messagesDiv.innerHTML = `
            <div class="${alertClass} text-white px-4 py-3 rounded-lg text-sm">
                ${message}
            </div>
        `;
    }

    // Login function using external API
    function login(username, password) {
        const apiUrl = '<?php echo get_option('onesports_api_url', ''); ?>';
        const subdomain = '<?php echo get_option('onesports_subdomain', 'lsmdemo1'); ?>';
        
        if (!apiUrl) {
            return Promise.reject(new Error('API URL not configured'));
        }
        
        return fetch(`${apiUrl}/api/member/auth/login`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ username, password, subdomain }),
        })
        .then((response) => response.json())
        .then((data) => {
            // Store the token in the local storage
            if (data.token) {
                localStorage.setItem("token", data.token);
                return data.token;
            } else {
                throw new Error(data.error || 'Login failed');
            }
        });
    }
});
</script>
<?php get_footer(); ?>
