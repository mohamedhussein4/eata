<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'جمعية إحسان') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'cairo': ['Cairo', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
        .rtl {
            direction: rtl;
        }
        .ltr {
            direction: ltr;
        }
    </style>
</head>
<body class="font-cairo">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-green-600">
                        <i class="fas fa-hands-helping mr-2"></i>
                        جمعية إحسان
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-green-600 transition-colors">الرئيسية</a>
                    <a href="{{ route('projects.index') }}" class="text-gray-700 hover:text-green-600 transition-colors">المشاريع</a>
                    <a href="{{ route('donations.index') }}" class="text-gray-700 hover:text-green-600 transition-colors">التبرعات</a>
                    <a href="{{ route('volunteers.index') }}" class="text-gray-700 hover:text-green-600 transition-colors">التطوع</a>
                    <a href="{{ route('contact.index') }}" class="text-gray-700 hover:text-green-600 transition-colors">اتصل بنا</a>
                    
                    @guest
                        <a href="{{ route('login') }}" class="bg-green-600 text-white px-6 py-2 rounded-full hover:bg-green-700 transition-colors">
                            تسجيل دخول
                        </a>
                    @else
                        <div class="relative">
                            <button class="flex items-center text-gray-700 hover:text-green-600 transition-colors">
                                <span class="mr-2">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden">
                                <a href="{{ route('users.profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">الملف الشخصي</a>
                                <a href="{{ route('users.history') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">التاريخ</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-right px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        تسجيل خروج
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button class="text-gray-700 hover:text-green-600 transition-colors">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">جمعية إحسان</h3>
                    <p class="text-gray-400">نساعد المحتاجين ونبني مستقبلاً أفضل للجميع</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">روابط سريعة</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('projects.index') }}" class="text-gray-400 hover:text-white transition-colors">المشاريع</a></li>
                        <li><a href="{{ route('donations.index') }}" class="text-gray-400 hover:text-white transition-colors">التبرعات</a></li>
                        <li><a href="{{ route('volunteers.index') }}" class="text-gray-400 hover:text-white transition-colors">التطوع</a></li>
                        <li><a href="{{ route('contact.index') }}" class="text-gray-400 hover:text-white transition-colors">اتصل بنا</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">معلومات التواصل</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><i class="fas fa-phone mr-2"></i> +963 11 123 4567</li>
                        <li><i class="fas fa-envelope mr-2"></i> info@ihsan.org</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i> دمشق، سوريا</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">تابعنا</h4>
                    <div class="flex space-x-4 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} جمعية إحسان. جميع الحقوق محفوظة.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.querySelector('.md\\:hidden button');
            const mobileMenu = document.querySelector('.md\\:hidden + div');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // Dropdown menu toggle
            const dropdownButton = document.querySelector('.relative button');
            const dropdownMenu = document.querySelector('.relative .absolute');
            
            if (dropdownButton && dropdownMenu) {
                dropdownButton.addEventListener('click', function() {
                    dropdownMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>
