<?php
/**
 * Template part for displaying sticky bottom menu
 *
 * @package LSM_Sports
 */
?>

<div class="fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-gray-200 shadow-lg">
    <div class="flex justify-center items-center py-3 px-4">
        <div class="flex space-x-8">
            <!-- Register Icon -->
            <a href="/register" class="flex flex-col items-center justify-center p-2 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                <div class="w-8 h-8 mb-1 flex items-center justify-center bg-gradient-to-b from-[#FFC900] to-[#F89939] rounded-full">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <span class="text-xs text-gray-600 font-medium">สมัครสมาชิก</span>
            </a>

            <!-- Login Icon -->
            <a href="<?php echo esc_url(home_url('/login')); ?>" class="flex flex-col items-center justify-center p-2 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                <div class="w-8 h-8 mb-1 flex items-center justify-center bg-blue-600 rounded-full">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                </div>
                <span class="text-xs text-gray-600 font-medium">เข้าสู่ระบบ</span>
            </a>

            <!-- LINE Contact Icon -->
            <a href="https://line.me/ti/p/~@lsm99.green" target="_blank" rel="noopener noreferrer" class="flex flex-col items-center justify-center p-2 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                <div class="w-8 h-8 mb-1 flex items-center justify-center bg-[#00B900] rounded-full">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63h2.386c.349 0 .63.285.63.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63.349 0 .631.285.631.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.348 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.281.628-.629.628M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/>
                    </svg>
                </div>
                <span class="text-xs text-gray-600 font-medium">ติดต่อ LINE</span>
            </a>
        </div>
    </div>
</div>
