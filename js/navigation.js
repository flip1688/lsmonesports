/**
 * Navigation and interactive features for LSM Sports Theme
 */

(function() {
    'use strict';

    // Mobile menu toggle functionality
    function initMobileMenu() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                const isHidden = mobileMenu.classList.contains('hidden');
                
                if (isHidden) {
                    mobileMenu.classList.remove('hidden');
                    mobileMenu.classList.add('animate-slide-down');
                    mobileMenuButton.setAttribute('aria-expanded', 'true');
                } else {
                    mobileMenu.classList.add('hidden');
                    mobileMenu.classList.remove('animate-slide-down');
                    mobileMenuButton.setAttribute('aria-expanded', 'false');
                }
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                    mobileMenu.classList.add('hidden');
                    mobileMenu.classList.remove('animate-slide-down');
                    mobileMenuButton.setAttribute('aria-expanded', 'false');
                }
            });

            // Close mobile menu on escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                    mobileMenu.classList.remove('animate-slide-down');
                    mobileMenuButton.setAttribute('aria-expanded', 'false');
                }
            });
        }
    }

    // Smooth scrolling for anchor links
    function initSmoothScrolling() {
        const anchorLinks = document.querySelectorAll('a[href^="#"]');
        
        anchorLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                if (href === '#') return;
                
                const target = document.querySelector(href);
                
                if (target) {
                    e.preventDefault();
                    
                    const headerOffset = 80; // Adjust based on your header height
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    // Add scroll-based header styling
    function initScrollHeader() {
        const header = document.getElementById('masthead');
        
        if (header) {
            let lastScrollTop = 0;
            
            window.addEventListener('scroll', function() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                if (scrollTop > 100) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
                
                // Hide/show header on scroll (optional)
                if (scrollTop > lastScrollTop && scrollTop > 200) {
                    // Scrolling down
                    header.style.transform = 'translateY(-100%)';
                } else {
                    // Scrolling up
                    header.style.transform = 'translateY(0)';
                }
                
                lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
            });
        }
    }

    // Lazy loading for images
    function initLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        img.classList.add('animate-fade-in');
                        imageObserver.unobserve(img);
                    }
                });
            });

            const lazyImages = document.querySelectorAll('img[data-src]');
            lazyImages.forEach(function(img) {
                imageObserver.observe(img);
            });
        }
    }

    // Form enhancements
    function initFormEnhancements() {
        const forms = document.querySelectorAll('form');
        
        forms.forEach(function(form) {
            // Add loading state to submit buttons
            form.addEventListener('submit', function() {
                const submitButton = form.querySelector('input[type="submit"], button[type="submit"]');
                
                if (submitButton) {
                    submitButton.disabled = true;
                    submitButton.classList.add('opacity-50', 'cursor-not-allowed');
                    
                    const originalText = submitButton.textContent || submitButton.value;
                    submitButton.textContent = 'Sending...';
                    submitButton.value = 'Sending...';
                    
                    // Re-enable after 5 seconds as fallback
                    setTimeout(function() {
                        submitButton.disabled = false;
                        submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
                        submitButton.textContent = originalText;
                        submitButton.value = originalText;
                    }, 5000);
                }
            });
        });

        // Enhanced form validation
        const inputs = document.querySelectorAll('input, textarea, select');
        
        inputs.forEach(function(input) {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                if (this.classList.contains('error')) {
                    validateField(this);
                }
            });
        });
    }

    // Field validation helper
    function validateField(field) {
        const value = field.value.trim();
        const type = field.type;
        const required = field.hasAttribute('required');
        
        // Remove existing error classes
        field.classList.remove('error', 'border-red-500');
        
        let isValid = true;
        
        if (required && !value) {
            isValid = false;
        } else if (type === 'email' && value && !isValidEmail(value)) {
            isValid = false;
        } else if (type === 'url' && value && !isValidUrl(value)) {
            isValid = false;
        }
        
        if (!isValid) {
            field.classList.add('error', 'border-red-500');
        } else {
            field.classList.add('border-green-500');
        }
        
        return isValid;
    }

    // Email validation helper
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // URL validation helper
    function isValidUrl(url) {
        try {
            new URL(url);
            return true;
        } catch {
            return false;
        }
    }

    // Back to top button
    function initBackToTop() {
        const backToTopButton = document.createElement('button');
        backToTopButton.innerHTML = '↑';
        backToTopButton.className = 'fixed bottom-6 right-6 bg-primary-600 text-white p-3 rounded-full shadow-lg hover:bg-primary-700 transition-all duration-300 opacity-0 invisible z-50';
        backToTopButton.setAttribute('aria-label', 'Back to top');
        
        document.body.appendChild(backToTopButton);
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('opacity-0', 'invisible');
                backToTopButton.classList.add('opacity-100', 'visible');
            } else {
                backToTopButton.classList.add('opacity-0', 'invisible');
                backToTopButton.classList.remove('opacity-100', 'visible');
            }
        });
        
        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Initialize all features when DOM is ready
    function init() {
        initMobileMenu();
        initSmoothScrolling();
        initScrollHeader();
        initLazyLoading();
        initFormEnhancements();
        initBackToTop();
        
        // Add loaded class to body for CSS animations
        document.body.classList.add('loaded');
    }

    // Wait for DOM to be ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
