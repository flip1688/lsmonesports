<?php
/**
 * Template part for displaying register form
 *
 * @package lsmonsports
 */

// Get banks data
$banks = get_banks_data();
?>

<!-- Register Section with Background -->
<section class="relative min-h-screen w-full flex items-center justify-center py-12">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" 
         style="background-image: url('<?php echo esc_url(home_url('/wp-content/uploads/2025/09/register-heading-scaled.png')); ?>');"></div>
    
    <!-- Overlay (optional, remove if not needed) -->
    <div class="absolute inset-0 bg-black/30"></div>
    
    <!-- Form Container -->
    <div class="relative z-10 w-full max-w-md mx-4">
    <!-- Register Form Card -->
    <div class="bg-gray-400 bg-opacity-30 backdrop-blur-sm rounded-2xl border border-none p-8 shadow-2xl">
        <!-- Logo -->
        <div class="text-center mb-8">
            <img src="<?php echo get_template_directory_uri(); ?>/src/img/ONE-AllSports.webp" 
                 alt="<?php bloginfo( 'name' ); ?>" 
                 class="h-auto w-auto mx-auto mb-4">
        </div>

        <!-- Form Title -->
        <h2 class="text-2xl font-bold text-white text-center mb-8">สมัครสมาชิก</h2>

        <!-- Register Form -->
        <form id="register-form" class="space-y-6" method="post" action="">
            <?php wp_nonce_field('register_user', 'register_nonce'); ?>
            
            <!-- Username/Phone Number Field -->
            <div>
                <label for="username" class="block text-sm font-medium text-white mb-2">เบอร์โทรศัพท์</label>
                <input type="text" 
                       id="username" 
                       name="username" 
                       required
                       class="w-full px-4 py-3 bg-gray-400 bg-opacity-30 border border-gray-300 rounded-lg text-white placeholder-gray-300 focus:border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-300 transition duration-300"
                       placeholder="กรอกเบอร์โทรศัพท์">
            </div>

            <!-- Password Field -->
            <div>
                <label for="password" class="block text-sm font-medium text-white mb-2">รหัสผ่าน</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       required
                       class="w-full px-4 py-3 bg-gray-400 bg-opacity-30 border border-gray-300 rounded-lg text-white placeholder-gray-300 focus:border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-300 transition duration-300"
                       placeholder="กรอกรหัสผ่าน">
            </div>

            <!-- Choose Bank Field -->
            <div>
                <label for="bank" class="block text-sm font-medium text-white mb-2">เลือกธนาคาร</label>
                <div class="relative">
                    <div id="bank-selector" class="w-full px-4 py-3 bg-gray-300 bg-opacity-30 border border-gray-600 rounded-lg text-white cursor-pointer flex items-center justify-between">
                        <div class="flex items-center">
                            <span id="selected-bank-text">เลือกธนาคาร</span>
                        </div>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <input type="hidden" id="bank" name="bank" required />
                    
                    <!-- Dropdown Menu -->
                    <div id="bank-dropdown" class="hidden absolute z-10 w-full mt-2 bg-gray-800 border border-gray-600 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                        <?php if (!empty($banks)): ?>
                            <?php foreach ($banks as $bank): ?>
                                <?php if ($bank['status'] == 1): ?>
                                    <div class="bank-option px-4 py-3 hover:bg-gray-700 cursor-pointer flex items-center space-x-3 transition-colors"
                                         data-bank-id="<?php echo esc_attr($bank['id']); ?>"
                                         data-bank-name="<?php echo esc_attr($bank['name']); ?>"
                                         data-bank-code="<?php echo esc_attr($bank['code']); ?>"
                                         data-bank-logo="<?php echo esc_attr($bank['logo']); ?>">
                                        <img src="https://fs.cdnxn.com/lsm99queen-next/iconbank/<?php echo esc_attr($bank['logo']); ?>" 
                                             alt="<?php echo esc_attr($bank['name']); ?>"
                                             class="w-8 h-8 object-contain"
                                             onerror="this.style.display='none'">
                                        <div class="flex flex-col">
                                            <span class="text-white font-medium"><?php echo esc_html($bank['name']); ?></span>
                                            <?php if (!empty($bank['code'])): ?>
                                                <span class="text-gray-400 text-xs"><?php echo esc_html($bank['code']); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="px-4 py-3 text-gray-400">ไม่มีข้อมูลธนาคาร</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Bank Account Number Field -->
            <div>
                <label for="bank_account_number" class="block text-sm font-medium text-white mb-2">เลขที่บัญชี</label>
                <input type="text" 
                       id="bank_account_number" 
                       name="bank_account_number" 
                       required
                       class="w-full px-4 py-3 bg-gray-400 bg-opacity-30 border border-gray-300 rounded-lg text-white placeholder-gray-300 focus:border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-300 transition duration-300"
                       placeholder="กรอกเลขที่บัญชีธนาคาร">
            </div>

            <!-- Bank Account Name Field -->
            <div>
                <label for="bank_account_name" class="block text-sm font-medium text-white mb-2">ชื่อบัญชี</label>
                <input type="text" 
                       id="bank_account_name" 
                       name="bank_account_name" 
                       required
                       class="w-full px-4 py-3 bg-gray-400 bg-opacity-30 border border-gray-300 rounded-lg text-white placeholder-gray-300 focus:border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-300 transition duration-300"
                       placeholder="กรอกชื่อบัญชีธนาคาร">
            </div>

            <!-- Register Button -->
            <button type="submit" 
                    name="register_submit"
                    class="w-full bg-[#F5D929] text-[#0E0D09] font-semibold py-3 px-6 rounded-lg transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50">
                สมัครสมาชิก
            </button>

            <!-- Divider -->
            <div class="text-center text-white text-sm my-6">
                เป็นสมาชิกแล้ว?
            </div>

            <!-- Login Button -->
            <a href="<?php echo esc_url( home_url( '/login' ) ); ?>" 
               class="block w-full text-center bg-[#006EEB] text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                เข้าสู่ระบบ
            </a>
        </form>

        <!-- Error/Success Messages -->
        <div id="form-messages" class="mt-4"></div>
    </div>
    </div>
</section>

<!-- OTP Modal -->
<div id="otp-modal" class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-gray-800 border-2 border-gray-600 rounded-2xl p-8 max-w-md w-full mx-4 shadow-2xl">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-[#F5D929]">กรอกรหัส OTP</h3>
            <button id="close-otp-modal" class="text-gray-400 hover:text-[#F5D929] text-2xl transition-colors">&times;</button>
        </div>
        <div>
            <p class="text-center mb-6 text-white">กรุณายืนยันตัวตนด้วยรหัส OTP 6 หลัก ที่ระบบได้ส่ง SMS<br />
            ไปให้ยังหมายเลขโทรศัพท์ <span id="masked-phone" class="text-[#F5D929] font-semibold"></span> ของคุณ</p>
            
            <form id="otp-form">
                <div class="flex justify-center items-center w-full my-6 space-x-2">
                    <input type="text" maxlength="1" class="otp-input w-12 h-12 bg-gray-700 border-2 border-gray-600 rounded-lg text-center text-white text-xl font-bold focus:border-[#F5D929] focus:outline-none transition-colors" data-index="0" />
                    <input type="text" maxlength="1" class="otp-input w-12 h-12 bg-gray-700 border-2 border-gray-600 rounded-lg text-center text-white text-xl font-bold focus:border-[#F5D929] focus:outline-none transition-colors" data-index="1" />
                    <input type="text" maxlength="1" class="otp-input w-12 h-12 bg-gray-700 border-2 border-gray-600 rounded-lg text-center text-white text-xl font-bold focus:border-[#F5D929] focus:outline-none transition-colors" data-index="2" />
                    <input type="text" maxlength="1" class="otp-input w-12 h-12 bg-gray-700 border-2 border-gray-600 rounded-lg text-center text-white text-xl font-bold focus:border-[#F5D929] focus:outline-none transition-colors" data-index="3" />
                    <input type="text" maxlength="1" class="otp-input w-12 h-12 bg-gray-700 border-2 border-gray-600 rounded-lg text-center text-white text-xl font-bold focus:border-[#F5D929] focus:outline-none transition-colors" data-index="4" />
                    <input type="text" maxlength="1" class="otp-input w-12 h-12 bg-gray-700 border-2 border-gray-600 rounded-lg text-center text-white text-xl font-bold focus:border-[#F5D929] focus:outline-none transition-colors" data-index="5" />
                </div>
                <div class="w-full flex justify-center h-5 mb-4">
                    <span id="otp-error" class="text-red-400 text-sm"></span>
                </div>
                
                <div id="countdown-container" class="text-center mb-4">
                    <span class="text-white">ขอรหัส OTP ได้อีกครั้งใน </span><span id="countdown" class="text-[#F5D929] font-semibold">10:00 วินาที</span>
                </div>
                
                <div id="resend-container" class="hidden mb-4 p-3 w-full text-center bg-[#F5D929] hover:bg-[#FFD700] text-[#0E0D09] font-semibold rounded-lg cursor-pointer transition-colors">
                    ขอรหัส OTP อีกครั้ง
                </div>

                <div class="flex space-x-3 w-full">
                    <button type="submit" class="flex-1 py-3 bg-[#F5D929] hover:bg-[#FFD700] text-[#0E0D09] font-semibold rounded-lg transition-all duration-300">ยืนยัน</button>
                    <button type="button" id="cancel-otp" class="flex-1 py-3 border-2 border-gray-600 hover:border-[#F5D929] text-white hover:text-[#F5D929] rounded-lg transition-all duration-300">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div id="success-modal" class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-gray-800 border-2 border-green-600 rounded-2xl p-8 max-w-md w-full mx-4 shadow-2xl">
        <div class="text-center mb-6">
            <h3 class="text-2xl font-bold text-green-500">สมัครสมาชิกสำเร็จ</h3>
        </div>
        <div class="text-center">
            <p class="mb-6 text-white leading-relaxed">รหัสผ่านเข้าสู่ระบบของท่านคือ <span id="user-password" class="text-green-500 font-bold text-lg"></span> โปรดบันทึกเก็บไว้สำหรับเข้าสู่ระบบในครั้งถัดไป</p>
            <button id="login-btn" class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg transition-all duration-300 transform hover:scale-105">เข้าสู่ระบบ</button>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div id="error-modal" class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-gray-800 border-2 border-red-600 rounded-2xl p-8 max-w-md w-full mx-4 shadow-2xl">
        <div class="text-center mb-6">
            <h3 id="error-title" class="text-2xl font-bold text-red-500">เกิดข้อผิดพลาด</h3>
        </div>
        <div class="text-center">
            <p id="error-message" class="mb-6 text-white"></p>
            <button id="close-error-modal" class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg transition-all duration-300">ปิด</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const apiUrl = '<?php echo esc_js(get_option('onesports_api_url', '')); ?>';
    const subdomain = '<?php echo esc_js(get_option('onesports_subdomain', 'lsmdemo1')); ?>';
    const loginUrl = '<?php echo esc_js(get_option('onesports_login_url', '')); ?>';
    
    const form = document.getElementById('register-form');
    const messagesDiv = document.getElementById('form-messages');
    const bankSelector = document.getElementById('bank-selector');
    const bankDropdown = document.getElementById('bank-dropdown');
    const bankInput = document.getElementById('bank');
    const selectedBankText = document.getElementById('selected-bank-text');
    const bankOptions = document.querySelectorAll('.bank-option');
    
    // Modals
    const otpModal = document.getElementById('otp-modal');
    const successModal = document.getElementById('success-modal');
    const errorModal = document.getElementById('error-modal');
    
    // OTP inputs
    const otpInputs = document.querySelectorAll('.otp-input');
    const otpForm = document.getElementById('otp-form');
    
    // Stored data
    let submittedData = null;
    let countdown = 600; // 10 minutes in seconds
    let countdownInterval = null;

    // Toggle dropdown
    bankSelector.addEventListener('click', function(e) {
        e.stopPropagation();
        bankDropdown.classList.toggle('hidden');
    });

    // Select bank option
    bankOptions.forEach(option => {
        option.addEventListener('click', function() {
            const bankId = this.getAttribute('data-bank-id');
            const bankName = this.getAttribute('data-bank-name');
            const bankCode = this.getAttribute('data-bank-code');
            const bankLogo = this.getAttribute('data-bank-logo');
            
            bankInput.value = bankId;
            clearFieldError('bank');
            
            const logoImg = this.querySelector('img');
            if (logoImg && logoImg.style.display !== 'none') {
                selectedBankText.innerHTML = `
                    <div class="flex items-center space-x-3">
                        <img src="https://fs.cdnxn.com/lsm99queen-next/iconbank/${bankLogo}" 
                             alt="${bankName}"
                             class="w-6 h-6 object-contain">
                        <div class="flex flex-col">
                            <span class="text-white">${bankName}</span>
                            ${bankCode ? `<span class="text-gray-400 text-xs">${bankCode}</span>` : ''}
                        </div>
                    </div>
                `;
            } else {
                selectedBankText.innerHTML = `
                    <div class="flex flex-col">
                        <span class="text-white">${bankName}</span>
                        ${bankCode ? `<span class="text-gray-400 text-xs">${bankCode}</span>` : ''}
                    </div>
                `;
            }
            
            bankDropdown.classList.add('hidden');
        });
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!bankSelector.contains(e.target) && !bankDropdown.contains(e.target)) {
            bankDropdown.classList.add('hidden');
        }
    });

    // OTP Input handlers
    otpInputs.forEach((input, index) => {
        input.addEventListener('input', function(e) {
            const value = e.target.value;
            if (!/^\d*$/.test(value)) {
                e.target.value = '';
                return;
            }
            
            if (value && index < 5) {
                otpInputs[index + 1].focus();
            }
        });

        input.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && !input.value && index > 0) {
                otpInputs[index - 1].focus();
            }
        });

        input.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedData = e.clipboardData.getData('text').replace(/\D/g, '').slice(0, 6);
            
            otpInputs.forEach((inp, idx) => {
                if (idx < pastedData.length) {
                    inp.value = pastedData[idx];
                }
            });
            
            if (pastedData.length < 6) {
                otpInputs[pastedData.length].focus();
            }
        });
    });

    // Form validation
    function validateForm() {
        let isValid = true;
        clearAllErrors();

        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value;
        const bankId = bankInput.value;
        const bankNumber = document.getElementById('bank_account_number').value.trim();
        const fullName = document.getElementById('bank_account_name').value.trim();

        if (!username || username.length !== 10 || !/^\d{10}$/.test(username)) {
            showFieldError('username', 'โปรดใส่เบอร์โทรศัพท์ให้ถูกต้อง');
            isValid = false;
        }

        if (!password || password.length < 6) {
            showFieldError('password', 'รหัสผ่านต้องมีอย่างน้อย 6 ตัวอักษร');
            isValid = false;
        }

        if (!bankId || bankId === '0') {
            showFieldError('bank', 'เลือกธนาคาร');
            isValid = false;
        }

        if (!bankNumber) {
            showFieldError('bank_account_number', 'โปรดใส่หมายเลขธนาคาร');
            isValid = false;
        }

        if (!fullName) {
            showFieldError('bank_account_name', 'โปรดใส่ชื่อบัญชีธนาคาร');
            isValid = false;
        } else if (!/^[A-Za-z\u0E00-\u0E7F\s]+$/.test(fullName)) {
            showFieldError('bank_account_name', 'เฉพาะตัวอักษรเท่านั้น');
            isValid = false;
        } else if (!/^(?:[A-Za-z\u0E00-\u0E7F]+\s[A-Za-z\u0E00-\u0E7F]+)$/.test(fullName)) {
            showFieldError('bank_account_name', 'ต้องใส่ชื่อ และนามสกุล');
            isValid = false;
        }

        return isValid;
    }

    function showFieldError(fieldId, message) {
        const field = document.getElementById(fieldId);
        if (field) {
            field.classList.add('border-red-600');
            field.classList.remove('border-gray-600');
            
            const errorSpan = document.createElement('span');
            errorSpan.className = 'text-red-400 text-sm mt-1 block field-error';
            errorSpan.textContent = message;
            
            if (field.parentElement.querySelector('.field-error')) {
                field.parentElement.querySelector('.field-error').remove();
            }
            
            field.parentElement.appendChild(errorSpan);
        }
    }

    function clearFieldError(fieldId) {
        const field = document.getElementById(fieldId);
        if (field) {
            field.classList.remove('border-red-600');
            field.classList.add('border-gray-600');
            
            const errorSpan = field.parentElement.querySelector('.field-error');
            if (errorSpan) {
                errorSpan.remove();
            }
        }
    }

    function clearAllErrors() {
        document.querySelectorAll('.field-error').forEach(el => el.remove());
        document.querySelectorAll('input').forEach(input => {
            input.classList.remove('border-red-600');
            input.classList.add('border-gray-600');
        });
    }

    // Form submission
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        if (!validateForm()) {
            return;
        }

        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'กำลังดำเนินการ...';
        submitBtn.disabled = true;

        const formData = {
            username: document.getElementById('username').value.trim(),
            password: document.getElementById('password').value,
            bankId: parseInt(bankInput.value),
            bankNumber: document.getElementById('bank_account_number').value.trim(),
            fullName: document.getElementById('bank_account_name').value.trim()
        };

        try {
            const response = await checkRegister(formData);
            
            if (response.status === 'success') {
                submittedData = formData;
                
                if (response.is_otp_register === 1) {
                    countdown = response.data?.expires_in ? response.data.expires_in * 60 : 600;
                    openOtpModal();
                } else {
                    openSuccessModal();
                }
            } else {
                handleRegistrationError(response);
            }
        } catch (error) {
            showErrorModal('เกิดข้อผิดพลาด', error.message || 'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้');
        } finally {
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        }
    });

    async function checkRegister(data) {
        const response = await fetch(`${apiUrl}/api/member/check-register`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                bank_id: data.bankId,
                bank_no: data.bankNumber,
                channel: '<?php echo esc_js(get_option('onesports_partner_channel', '')); ?>',
                code: '',
                email: '',
                full_name_th: data.fullName,
                login_username: '',
                otp: '',
                partner_code: '<?php echo esc_js(get_option('onesports_partner_code', '')); ?>',
                phone_number: data.username,
                password: data.password,
                sub_domain: subdomain
            })
        });

        if (response.status === 200) {
            const responseData = await response.json();
            return Object.assign(responseData, { status: 'success' });
        } else {
            const responseData = await response.json();
            return Object.assign(responseData, { status: 'error' });
        }
    }

    function handleRegistrationError(response) {
        clearAllErrors();
        
        if (response.errors?.bank_no) {
            if (response.errors.bank_no[0] === "bank no is unique") {
                showFieldError('bank_account_number', 'บัญชีธนาคารซ้ำ');
            } else {
                showFieldError('bank_account_number', 'เลขที่บัญชีธนาคารต้องไม่เกิน 13 หลัก');
            }
        }
        
        if (response.errors?.phone_number) {
            showFieldError('username', 'หมายเลขโทรศัพท์ซ้ำ');
        }
        
        if (response.message === "Failed to add member since Membership in the system is full.") {
            showErrorModal('สมัครสมาชิกไม่สำเร็จ', 'ขณะนี้สมาชิกในระบบเต็มแล้ว');
        }
    }

    // OTP Modal functions
    function openOtpModal() {
        const maskedPhone = maskPhoneNumber(submittedData.username);
        document.getElementById('masked-phone').textContent = maskedPhone;
        
        otpModal.classList.remove('hidden');
        startCountdown();
        otpInputs[0].focus();
    }

    function closeOtpModal() {
        otpModal.classList.add('hidden');
        clearOtpInputs();
        stopCountdown();
    }

    function clearOtpInputs() {
        otpInputs.forEach(input => input.value = '');
        document.getElementById('otp-error').textContent = '';
    }

    function maskPhoneNumber(phone) {
        if (!phone || phone.length < 7) return phone;
        const first3 = phone.substring(0, 3);
        const last4 = phone.substring(phone.length - 4);
        const masked = '*'.repeat(phone.length - 7);
        return `${first3}${masked}${last4}`;
    }

    function startCountdown() {
        document.getElementById('countdown-container').classList.remove('hidden');
        document.getElementById('resend-container').classList.add('hidden');
        
        countdownInterval = setInterval(() => {
            countdown--;
            
            const minutes = Math.floor(countdown / 60);
            const seconds = countdown % 60;
            document.getElementById('countdown').textContent = 
                `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')} วินาที`;
            
            if (countdown <= 0) {
                stopCountdown();
                document.getElementById('countdown-container').classList.add('hidden');
                document.getElementById('resend-container').classList.remove('hidden');
            }
        }, 1000);
    }

    function stopCountdown() {
        if (countdownInterval) {
            clearInterval(countdownInterval);
            countdownInterval = null;
        }
    }

    // OTP form submission
    otpForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const otp = Array.from(otpInputs).map(input => input.value).join('');
        
        if (otp.length !== 6) {
            document.getElementById('otp-error').textContent = 'โปรดระบุ OTP ให้ครบ 6 หลัก';
            return;
        }

        const submitBtn = otpForm.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'กำลังตรวจสอบ...';
        submitBtn.disabled = true;

        try {
            const response = await verifyOtp({...submittedData, otp});
            
            if (response.status === 'success') {
                closeOtpModal();
                openSuccessModal();
            } else {
                if (response.errors?.otp) {
                    document.getElementById('otp-error').textContent = 'รหัส OTP ไม่ถูกต้อง';
                }
            }
        } catch (error) {
            document.getElementById('otp-error').textContent = 'เกิดข้อผิดพลาดในการตรวจสอบ OTP';
        } finally {
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        }
    });

    async function verifyOtp(data) {
        const response = await fetch(`${apiUrl}/api/member/verify-otp-reg`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                bank_id: data.bankId,
                bank_no: data.bankNumber,
                channel: '<?php echo esc_js(get_option('onesports_partner_channel', '')); ?>',
                code: '',
                email: '',
                full_name_th: data.fullName,
                login_username: '',
                otp: data.otp,
                partner_code: '<?php echo esc_js(get_option('onesports_partner_code', '')); ?>',
                phone_number: data.username,
                password: data.password,
                sub_domain: subdomain
            })
        });

        if (response.status === 200) {
            const responseData = await response.json();
            return Object.assign(responseData, { status: 'success' });
        } else {
            const responseData = await response.json();
            return Object.assign(responseData, { status: 'error' });
        }
    }

    // Resend OTP
    document.getElementById('resend-container').addEventListener('click', async function() {
        if (!submittedData) return;
        
        try {
            const response = await checkRegister(submittedData);
            
            if (response.status === 'success' && response.is_otp_register === 1) {
                countdown = response.data?.expires_in ? response.data.expires_in * 60 : 600;
                clearOtpInputs();
                startCountdown();
            }
        } catch (error) {
            document.getElementById('otp-error').textContent = 'ไม่สามารถส่ง OTP ได้';
        }
    });

    // Success modal
    function openSuccessModal() {
        document.getElementById('user-password').textContent = submittedData.password;
        successModal.classList.remove('hidden');
    }

    document.getElementById('login-btn').addEventListener('click', async function() {
        try {
            const token = await login(submittedData.username, submittedData.password);
            
            if (loginUrl) {
                const separator = loginUrl.includes('?') ? '&' : '?';
                window.location.replace(`${loginUrl}${separator}token=${encodeURIComponent(token)}`);
            } else {
                window.location.replace('<?php echo esc_url(home_url('/')); ?>');
            }
        } catch (error) {
            showErrorModal('เกิดข้อผิดพลาด', 'ไม่สามารถเข้าสู่ระบบได้');
        }
    });

    async function login(username, password) {
        const response = await fetch(`${apiUrl}/api/member/auth/login`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                username,
                password,
                subdomain
            })
        });

        const data = await response.json();
        
        if (data.token) {
            localStorage.setItem('token', data.token);
            return data.token;
        } else {
            throw new Error(data.error || 'Login failed');
        }
    }

    // Error modal
    function showErrorModal(title, message) {
        document.getElementById('error-title').textContent = title;
        document.getElementById('error-message').textContent = message;
        errorModal.classList.remove('hidden');
    }

    // Modal close handlers
    document.getElementById('close-otp-modal').addEventListener('click', closeOtpModal);
    document.getElementById('cancel-otp').addEventListener('click', closeOtpModal);
    document.getElementById('close-error-modal').addEventListener('click', function() {
        errorModal.classList.add('hidden');
    });

    // Input change handlers to clear errors
    ['username', 'password', 'bank_account_number', 'bank_account_name'].forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (field) {
            field.addEventListener('input', function() {
                clearFieldError(fieldId);
            });
        }
    });
});
</script>
