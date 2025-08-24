@php
    $notifications = App\Models\Notification::where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->paginate(10);
    $settings = App\Models\Setting::first();
@endphp
<!doctype html>
<html class="no-js" lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title', 'إيطا - منصة التبرعات الخيرية')</title>
    <meta name="description" content="@yield('description', 'منصة إيطا للتبرعات الخيرية - نساعد المحتاجين حول العالم')">
    <meta name="keywords" content="تبرعات, خيرية, مساعدة, إنسانية, إيطا">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'charity': {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            300: '#5eead4',
                            400: '#2dd4bf',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a',
                            950: '#042f2e',
                        },
                        'warm': {
                            50: '#fefdf8',
                            100: '#fef7cd',
                            200: '#feec9b',
                            300: '#fdd862',
                            400: '#fbc638',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f',
                        }
                    },
                    fontFamily: {
                        'arabic': ['Cairo', 'Tajawal', 'sans-serif'],
                        'english': ['Inter', 'Roboto', 'sans-serif']
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'bounce-slow': 'bounce 3s infinite',
                        'fade-in': 'fadeIn 0.8s ease-out',
                        'fade-in-up': 'fadeInUp 0.8s ease-out',
                        'slide-in-right': 'slideInRight 0.8s ease-out',
                        'slide-in-left': 'slideInLeft 0.8s ease-out',
                        'scale-in': 'scaleIn 0.5s ease-out',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0px)'
                            },
                            '50%': {
                                transform: 'translateY(-20px)'
                            }
                        },
                        fadeIn: {
                            '0%': {
                                opacity: '0'
                            },
                            '100%': {
                                opacity: '1'
                            }
                        },
                        fadeInUp: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(30px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            }
                        },
                        slideInRight: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateX(30px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateX(0)'
                            }
                        },
                        slideInLeft: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateX(-30px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateX(0)'
                            }
                        },
                        scaleIn: {
                            '0%': {
                                opacity: '0',
                                transform: 'scale(0.9)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'scale(1)'
                            }
                        },
                        progress: {
                            '0%': {
                                width: '0%'
                            },
                            '50%': {
                                width: '70%'
                            },
                            '100%': {
                                width: '100%'
                            }
                        },
                        wave: {
                            '0%, 100%': {
                                transform: 'translateX(-100%)'
                            },
                            '50%': {
                                transform: 'translateX(100%)'
                            }
                        }
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <style>
        /* Custom Styles */
        body {
            font-family: {{ app()->getLocale() === 'ar' ? "'Cairo', sans-serif" : "'Inter', sans-serif" }};
            {{ app()->getLocale() === 'ar' ? 'direction: rtl;' : 'direction: ltr;' }}
        }

        /* Loading Animation */
        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #14b8a6;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #14b8a6;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #0d9488;
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Animation Delays */
        .animation-delay-200 {
            animation-delay: 0.2s;
        }

        .animation-delay-400 {
            animation-delay: 0.4s;
        }

        .animation-delay-600 {
            animation-delay: 0.6s;
        }

        .animation-delay-800 {
            animation-delay: 0.8s;
        }

        .animation-delay-1000 {
            animation-delay: 1s;
        }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #14b8a6, #0d9488);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Glass Effect */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* تأثيرات خاصة للـ Preloader */
        .animation-reverse {
            animation-direction: reverse;
        }

        @keyframes shimmer {
            0% {
                background-position: -200px 0;
            }

            100% {
                background-position: calc(200px + 100%) 0;
            }
        }

        .shimmer {
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            background-size: 200px 100%;
            animation: shimmer 1.5s infinite;
        }

        .animate-progress {
            animation: progress 2s ease-in-out infinite;
        }

        /* Floating Elements */
        .floating {
            animation: float 6s ease-in-out infinite;
        }

        /* Toast Notifications */
        .toast {
            position: fixed;
            top: 20px;
            {{ app()->getLocale() === 'ar' ? 'left: 20px;' : 'right: 20px;' }} background: white;
            padding: 16px 20px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border-left: 4px solid #14b8a6;
            z-index: 9999;
            max-width: 400px;
            transform: translateX({{ app()->getLocale() === 'ar' ? '-' : '' }}100%);
            transition: transform 0.3s ease;
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast.success {
            border-left-color: #10b981;
        }

        .toast.error {
            border-left-color: #ef4444;
        }

        .toast.warning {
            border-left-color: #f59e0b;
        }

        .toast.info {
            border-left-color: #3b82f6;
        }

        @media (max-width: 768px) {
            #notifications-btn,
            .auth-btn {
                display: none !important;
            }
        }
    </style>

    @yield('styles')
</head>

<body class="bg-gray-50">


    <!-- Loading Screen المحسّن -->
    <div id="loading-screen"
        class="fixed inset-0 z-50 flex items-center justify-center bg-gradient-to-br from-charity-500 via-charity-600 to-charity-700 overflow-hidden">
        <!-- خلفية متحركة -->
        <div class="absolute inset-0">
            <div class="absolute top-20 left-20 w-40 h-40 bg-white/10 rounded-full animate-float"></div>
            <div class="absolute top-40 right-32 w-24 h-24 bg-white/5 rounded-full animate-float animation-delay-200">
            </div>
            <div
                class="absolute bottom-32 left-40 w-32 h-32 bg-white/10 rounded-full animate-float animation-delay-400">
            </div>
            <div
                class="absolute bottom-20 right-20 w-20 h-20 bg-white/5 rounded-full animate-float animation-delay-600">
            </div>

            <!-- خطوط متحركة -->
            <div class="absolute inset-0">
                <div
                    class="absolute top-1/4 left-0 w-full h-px bg-gradient-to-r from-transparent via-white/20 to-transparent animate-pulse">
                </div>
                <div
                    class="absolute top-3/4 left-0 w-full h-px bg-gradient-to-r from-transparent via-white/10 to-transparent animate-pulse animation-delay-300">
                </div>
            </div>
        </div>

        <div class="text-center relative z-10">
            <!-- شعار متحرك -->
            <div class="relative mb-8">
                <div class="w-24 h-24 mx-auto relative">
                    <!-- دائرة خارجية -->
                    <div class="absolute inset-0 border-4 border-white/30 rounded-full animate-spin"></div>
                    <!-- دائرة وسطية -->
                    <div
                        class="absolute inset-2 border-4 border-white/50 border-t-white rounded-full animate-spin animation-reverse animation-delay-200">
                    </div>
                    <!-- دائرة داخلية -->
                    <div
                        class="absolute inset-4 border-4 border-white border-b-transparent rounded-full animate-spin animation-delay-400">
                    </div>
                    <!-- نقطة المركز -->
                    <div class="absolute inset-8 bg-white rounded-full animate-pulse"></div>
                </div>

                <!-- تأثير الهالة -->
                <div class="absolute inset-0 w-24 h-24 mx-auto bg-white/20 rounded-full animate-ping"></div>
            </div>

            <!-- النص -->
            <div class="space-y-4">
                <h2 class="text-3xl font-bold text-white mb-2">
                    {{ app()->getLocale() === 'ar' ? 'إيطا' : 'Eata' }}
                </h2>
                <p class="text-white/90 text-lg font-medium animate-pulse">
                    {{ app()->getLocale() === 'ar' ? 'جاري التحميل...' : 'Loading...' }}
                </p>

                <!-- شريط التقدم -->
                <div class="w-64 h-2 bg-white/20 rounded-full overflow-hidden mx-auto">
                    <div class="h-full bg-gradient-to-r from-white to-white/80 rounded-full animate-progress"></div>
                </div>

                <p class="text-white/70 text-sm mt-4">
                    {{ app()->getLocale() === 'ar' ? 'معاً نصنع الفرق' : 'Together We Make a Difference' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    @include('frontend.layouts.navbar')

    <!-- Main Content -->
    <main class="fit-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('frontend.layouts.footer')

    <!-- Chat (for authenticated users) -->
    @auth
        @include('frontend.layouts.chat')
    @endauth

    <!-- Toast Container -->
    <div id="toast-container"
        class="fixed top-4 {{ app()->getLocale() === 'ar' ? 'left-4' : 'right-4' }} z-50 space-y-2"></div>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });

        // Hide loading screen
        window.addEventListener('load', () => {
            const loadingScreen = document.getElementById('loading-screen');
            if (loadingScreen) {
                // تأثير التلاشي المتدرج
                loadingScreen.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
                loadingScreen.style.opacity = '0';
                loadingScreen.style.transform = 'scale(1.1)';

                setTimeout(() => {
                    loadingScreen.style.display = 'none';
                    // إضافة تأثير ظهور للمحتوى
                    document.body.classList.add('loaded');
                }, 800);
            }
        });

        // تأثيرات إضافية للـ preloader
        document.addEventListener('DOMContentLoaded', () => {
            // تأثير التموج للدوائر
            let wavePhase = 0;
            const updateWave = () => {
                wavePhase += 0.05;
                const circles = document.querySelectorAll('#loading-screen .animate-float');
                circles.forEach((circle, index) => {
                    const offset = Math.sin(wavePhase + index * 0.5) * 10;
                    circle.style.transform = `translateY(${offset}px)`;
                });
                if (document.getElementById('loading-screen').style.display !== 'none') {
                    requestAnimationFrame(updateWave);
                }
            };
            updateWave();
        });

        // Toast notification function
        function showToast(message, type = 'info', duration = 5000) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');

            const icons = {
                success: '<i class="fas fa-check-circle text-green-500"></i>',
                error: '<i class="fas fa-exclamation-circle text-red-500"></i>',
                warning: '<i class="fas fa-exclamation-triangle text-yellow-500"></i>',
                info: '<i class="fas fa-info-circle text-blue-500"></i>'
            };

            toast.className =
                `toast ${type} show bg-white rounded-lg shadow-lg p-4 flex items-center space-x-3 max-w-sm transform transition-all duration-300`;
            toast.innerHTML = `
                ${icons[type] || icons.info}
                <span class="flex-1 text-gray-800">${message}</span>
                <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            `;

            container.appendChild(toast);

            // Auto remove after duration
            setTimeout(() => {
                toast.classList.add('opacity-0', 'transform', 'translate-x-full');
                setTimeout(() => {
                    if (toast.parentElement) {
                        toast.parentElement.removeChild(toast);
                    }
                }, 300);
            }, duration);
        }

        // Show Laravel session messages
        @if (session('success'))
            showToast("{{ session('success') }}", "success", 4000);
        @endif
        @if (session('error'))
            showToast("{{ session('error') }}", "error", 4000);
        @endif
        @if (session('warning'))
            showToast("{{ session('warning') }}", "warning", 4000);
        @endif
        @if (session('info'))
            showToast("{{ session('info') }}", "info", 4000);
        @endif
        @if ($errors->any())
            showToast("{{ $errors->first() }}", "error", 4000);
        @endif

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add scroll effect to navbar
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (navbar) {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            }
        });

        // Counter animation
        function animateCounters() {
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target')) || parseInt(counter.textContent);
                const duration = 2000;
                const step = target / (duration / 16);
                let current = 0;

                const timer = setInterval(() => {
                    current += step;
                    if (current >= target) {
                        counter.textContent = target.toLocaleString();
                        clearInterval(timer);
                    } else {
                        counter.textContent = Math.floor(current).toLocaleString();
                    }
                }, 16);
            });
        }

        // Intersection Observer for counters
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.counter-section').forEach(section => {
            observer.observe(section);
        });

        // Mobile menu toggle
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuButton = document.querySelector('[data-mobile-menu-button]');

            if (mobileMenu && menuButton) {
                const isOpen = mobileMenu.classList.contains('active');

                if (isOpen) {
                    mobileMenu.classList.remove('active');
                    menuButton.innerHTML = '<i class="fas fa-bars"></i>';
                } else {
                    mobileMenu.classList.add('active');
                    menuButton.innerHTML = '<i class="fas fa-times"></i>';
                }
            }
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuButton = document.querySelector('[data-mobile-menu-button]');

            if (mobileMenu && menuButton && !mobileMenu.contains(e.target) && !menuButton.contains(e.target)) {
                mobileMenu.classList.remove('active');
                menuButton.innerHTML = '<i class="fas fa-bars"></i>';
            }
        });
    </script>

    @yield('scripts')
</body>

</html>
