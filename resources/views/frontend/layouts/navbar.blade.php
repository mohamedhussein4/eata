@php
    $unreadCount = 0;
    $notifications = collect();
    if (auth()->check()) {
        $notifications = \App\Models\Notification::where('user_id', auth()->id())
            ->latest()
            ->take(10)
            ->get();
        $unreadCount = \App\Models\Notification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->count();
    }
@endphp

<!-- Navbar أنيقة وفاخرة -->
<nav class="relative w-full top-0 z-50 transition-all duration-500" id="navbar">
    <!-- الشريط العلوي الأنيق -->
    <div class="bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 text-white py-3 relative overflow-hidden">
        <!-- خلفية متحركة -->
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="absolute top-0 left-1/4 w-32 h-32 bg-white/5 rounded-full blur-xl animate-pulse"></div>
        <div
            class="absolute bottom-0 right-1/3 w-24 h-24 bg-white/5 rounded-full blur-xl animate-pulse animation-delay-1000">
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="flex items-center justify-between">
                <!-- معلومات التواصل الأنيقة -->
                <div
                    class="hidden lg:flex items-center space-x-8 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                    <div
                        class="flex items-center space-x-3 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} group">
                        <div
                            class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center group-hover:bg-white/20 transition-all duration-300">
                            <i class="fas fa-map-marker-alt text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-white/70">{{ app()->getLocale() === 'ar' ? 'الموقع' : 'Location' }}
                            </p>
                            <p class="text-sm font-medium">
                                {{ $settings->address ?? 'الرياض، المملكة العربية السعودية' }}</p>
                        </div>
                    </div>

                    <div
                        class="flex items-center space-x-3 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} group">
                        <div
                            class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center group-hover:bg-white/20 transition-all duration-300">
                            <i class="fas fa-phone text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-white/70">{{ app()->getLocale() === 'ar' ? 'اتصل بنا' : 'Call Us' }}
                            </p>
                            <a href="tel:{{ $settings->phone ?? '+966123456789' }}"
                                class="text-sm font-medium hover:text-white/90 transition-colors">
                                {{ $settings->phone ?? '+966 12 345 6789' }}
                            </a>
                        </div>
                    </div>

                    <div
                        class="flex items-center space-x-3 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} group">
                        <div
                            class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center group-hover:bg-white/20 transition-all duration-300">
                            <i class="fas fa-envelope text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-white/70">{{ app()->getLocale() === 'ar' ? 'راسلنا' : 'Email Us' }}
                            </p>
                            <a href="mailto:{{ $settings->email ?? 'info@eata.com' }}"
                                class="text-sm font-medium hover:text-white/90 transition-colors">
                                {{ $settings->email ?? 'info@eata.com' }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- الجانب الأيمن الأنيق -->
                <div class="flex items-center space-x-6 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                    <!-- مبدل اللغات السويتش الأنيق -->
                    <div class="language-switch">
                        <div
                            class="flex items-center bg-white/10 backdrop-blur-sm rounded-full p-1 border border-white/20">
                            <a href="{{ route('language.switch', 'ar') }}?redirect={{ urlencode(request()->fullUrl()) }}"
                                class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} px-3 py-2 rounded-full transition-all duration-300 {{ app()->getLocale() === 'ar' ? 'bg-white text-emerald-600 shadow-lg font-semibold' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                                <div
                                    class="w-5 h-5 rounded-full overflow-hidden border-2 {{ app()->getLocale() === 'ar' ? 'border-emerald-200' : 'border-white/30' }}">
                                    <div class="w-full h-full bg-gradient-to-b from-green-500 via-white to-red-500">
                                    </div>
                                </div>
                                <span class="text-sm font-medium">عربي</span>
                            </a>
                            <a href="{{ route('language.switch', 'en') }}?redirect={{ urlencode(request()->fullUrl()) }}"
                                class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} px-3 py-2 rounded-full transition-all duration-300 {{ app()->getLocale() === 'en' ? 'bg-white text-emerald-600 shadow-lg font-semibold' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                                <div
                                    class="w-5 h-5 rounded-full overflow-hidden border-2 {{ app()->getLocale() === 'en' ? 'border-emerald-200' : 'border-white/30' }}">
                                    <div class="w-full h-full bg-gradient-to-b from-blue-900 via-white to-red-500">
                                    </div>
                                </div>
                                <span class="text-sm font-medium">EN</span>
                            </a>
                        </div>
                    </div>

                    <!-- شبكات التواصل الأنيقة -->
                    <div
                        class="hidden md:flex items-center space-x-3 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                        <a href="{{ $settings->facebook_link ?? '#' }}"
                            class="w-9 h-9 bg-white/10 hover:bg-blue-500 rounded-full flex items-center justify-center transition-all duration-300 transform hover:scale-110 hover:rotate-3">
                            <i class="fab fa-facebook-f text-sm"></i>
                        </a>
                        <a href="{{ $settings->twitter_link ?? '#' }}"
                            class="w-9 h-9 bg-white/10 hover:bg-blue-400 rounded-full flex items-center justify-center transition-all duration-300 transform hover:scale-110 hover:-rotate-3">
                            <i class="fab fa-twitter text-sm"></i>
                        </a>
                        <a href="{{ $settings->youtube_link ?? '#' }}"
                            class="w-9 h-9 bg-white/10 hover:bg-red-500 rounded-full flex items-center justify-center transition-all duration-300 transform hover:scale-110 hover:rotate-3">
                            <i class="fab fa-youtube text-sm"></i>
                        </a>
                        <a href="{{ $settings->linkedin_link ?? '#' }}"
                            class="w-9 h-9 bg-white/10 hover:bg-blue-600 rounded-full flex items-center justify-center transition-all duration-300 transform hover:scale-110 hover:-rotate-3">
                            <i class="fab fa-linkedin-in text-sm"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- الشريط الرئيسي الفاخر -->
    <div class="bg-white/95 backdrop-blur-md border-b border-gray-200/50 shadow-lg">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between h-20">
                <!-- الشعار الأنيق -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}"
                        class="flex items-center space-x-4 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} group">
                        <div class="relative">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-emerald-400 to-teal-500 rounded-2xl blur-lg opacity-30 group-hover:opacity-50 transition-opacity duration-300">
                            </div>
                            <div
                                class="relative w-16 h-16 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-105">
                                <img src="{{ asset($settings->logo ?? 'default-logo.png') }}" alt="Logo"
                                    class="w-12 h-12 rounded-xl">
                            </div>
                        </div>
                        <div>
                            <h1
                                class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-teal-700 bg-clip-text text-transparent group-hover:from-emerald-700 group-hover:to-teal-800 transition-all duration-300">
                                {{ app()->getLocale() === 'ar' ? 'إيطا' : 'Eata' }}
                            </h1>
                            <p class="text-sm text-gray-600 font-medium">
                                {{ app()->getLocale() === 'ar' ? 'معاً نصنع الفرق في العالم' : 'Together We Make a Difference' }}
                            </p>
                        </div>
                    </a>
                </div>

                <!-- القائمة الرئيسية الأنيقة -->
                <div
                    class="hidden lg:flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                    <a href="{{ route('home') }}"
                        class="relative px-6 py-3 text-gray-700 hover:text-emerald-600 font-semibold transition-all duration-300 group">
                        <span class="relative z-10">{{ app()->getLocale() === 'ar' ? 'الرئيسية' : 'Home' }}</span>
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-95 group-hover:scale-100">
                        </div>
                        <div
                            class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transition-all duration-300 group-hover:w-12">
                        </div>
                    </a>

                    <!-- قائمة التبرعات الفاخرة -->
                    <div class="relative group">
                        <button
                            class="relative px-6 py-3 flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} text-gray-700 hover:text-emerald-600 font-semibold transition-all duration-300">
                            <span
                                class="relative z-10">{{ app()->getLocale() === 'ar' ? 'التبرعات' : 'donations' }}</span>
                            <i
                                class="fas fa-chevron-down text-sm group-hover:rotate-180 transition-transform duration-300"></i>
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-95 group-hover:scale-100">
                            </div>
                        </button>
                        <div
                            class="absolute top-full {{ app()->getLocale() === 'ar' ? 'left-0' : 'right-0' }} mt-3 w-80 bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl border border-gray-200/50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                            <div class="p-6">
                                <div class="grid grid-cols-1 gap-4">
                                    <a href="{{ route('food-donations.index') }}"
                                        class="flex items-center p-4 rounded-xl hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 transition-all duration-300 group">
                                        <div
                                            class="w-14 h-14 bg-gradient-to-r from-emerald-100 to-teal-100 rounded-xl flex items-center justify-center {{ app()->getLocale() === 'ar' ? 'ml-4' : 'mr-4' }} group-hover:from-emerald-500 group-hover:to-teal-500 group-hover:text-white transition-all duration-300">
                                            <i class="fas fa-box-open text-lg"></i>
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-800 group-hover:text-emerald-700">
                                                {{ app()->getLocale() === 'ar' ? 'التطوع باللوازم' : 'Volunteer with Supplies' }}
                                            </div>
                                            <div class="text-sm text-gray-500 mt-1">
                                                {{ app()->getLocale() === 'ar' ? 'تبرع بالطعام والملابس والأدوية' : 'Donate food, clothes and medicine' }}
                                            </div>
                                        </div>
                                    </a>
                                    <a href="{{ route('digital-currency-donations.index') }}"
                                        class="flex items-center p-4 rounded-xl hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 transition-all duration-300 group">
                                        <div
                                            class="w-14 h-14 bg-gradient-to-r from-yellow-100 to-orange-100 rounded-xl flex items-center justify-center {{ app()->getLocale() === 'ar' ? 'ml-4' : 'mr-4' }} group-hover:from-yellow-500 group-hover:to-orange-500 group-hover:text-white transition-all duration-300">
                                            <i class="fas fa-coins text-lg"></i>
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-800 group-hover:text-emerald-700">
                                                {{ app()->getLocale() === 'ar' ? 'العملات الرقمية' : 'Digital Currency' }}
                                            </div>
                                            <div class="text-sm text-gray-500 mt-1">
                                                {{ app()->getLocale() === 'ar' ? 'تبرع بالعملات المشفرة الآمنة' : 'Donate with secure cryptocurrencies' }}
                                            </div>
                                        </div>
                                    </a>
                                    <a href="{{ route('sms-donations.index') }}"
                                        class="flex items-center p-4 rounded-xl hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 transition-all duration-300 group">
                                        <div
                                            class="w-14 h-14 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-xl flex items-center justify-center {{ app()->getLocale() === 'ar' ? 'ml-4' : 'mr-4' }} group-hover:from-blue-500 group-hover:to-indigo-500 group-hover:text-white transition-all duration-300">
                                            <i class="fas fa-sms text-lg"></i>
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-800 group-hover:text-emerald-700">
                                                {{ app()->getLocale() === 'ar' ? 'الرسائل النصية' : 'SMS Donations' }}
                                            </div>
                                            <div class="text-sm text-gray-500 mt-1">
                                                {{ app()->getLocale() === 'ar' ? 'تبرع سريع عبر الرسائل النصية' : 'Quick donation via text messages' }}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="border-t border-gray-200/50 mt-4 pt-4">
                                    <a href="#"
                                        class="flex items-center justify-center p-3 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white rounded-xl font-semibold transition-all duration-300 transform hover:scale-105">
                                        <i
                                            class="fas fa-heart {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                        {{ app()->getLocale() === 'ar' ? 'تبرع سريع الآن' : 'Quick Donate Now' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('contact.index') }}"
                        class="relative px-6 py-3 text-gray-700 hover:text-emerald-600 font-semibold transition-all duration-300 group">
                        <span
                            class="relative z-10">{{ app()->getLocale() === 'ar' ? 'الدعم الفني' : 'Support' }}</span>
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-95 group-hover:scale-100">
                        </div>
                        <div
                            class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transition-all duration-300 group-hover:w-12">
                        </div>
                    </a>

                    <!-- قائمة المزيد الأنيقة -->
                    <div class="relative group">
                        <button
                            class="relative px-6 py-3 flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} text-gray-700 hover:text-emerald-600 font-semibold transition-all duration-300">
                            <span class="relative z-10">{{ app()->getLocale() === 'ar' ? 'المزيد' : 'More' }}</span>
                            <i
                                class="fas fa-chevron-down text-sm group-hover:rotate-180 transition-transform duration-300"></i>
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-95 group-hover:scale-100">
                            </div>
                        </button>
                        <div
                            class="absolute top-full {{ app()->getLocale() === 'ar' ? 'left-0' : 'right-0' }} mt-3 w-64 bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl border border-gray-200/50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                            <div class="py-4">
                                @php
                                    $pages = \App\Models\Page::where('is_active', true)
                                        ->orderBy('sort_order')
                                        ->take(5)
                                        ->get();
                                @endphp
                                @foreach ($pages as $page)
                                    <a href="{{ route('pages.show', $page->slug) }}"
                                        class="flex items-center px-6 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 hover:text-emerald-600 transition-all duration-200">
                                        <i
                                            class="fas fa-file-alt text-emerald-500 w-5 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></i>
                                        {{ $page->title }}
                                    </a>
                                @endforeach
                                <div class="border-t border-gray-200/50 my-2"></div>
                                <a href="{{ route('testimonials.index') }}"
                                    class="flex items-center px-6 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 hover:text-emerald-600 transition-all duration-200">
                                    <i
                                        class="fas fa-comments text-emerald-500 w-5 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></i>
                                    {{ app()->getLocale() === 'ar' ? 'آراء المستخدمين' : 'Testimonials' }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- أزرار العمل الأنيقة -->
                <div class="flex items-center space-x-4 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                    @auth
                        <!-- الإشعارات الأنيقة -->
                        <button id="notifications-btn"
                            class="relative p-3 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all duration-300">
                            <i class="fas fa-bell text-lg"></i>
                            @if($unreadCount > 0)
                                <span class="absolute -top-1 -{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}-1 bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center animate-pulse">
                                    {{ $unreadCount }}
                                </span>
                            @endif
                        </button>

                        <!-- قائمة المستخدم الأنيقة -->
                        <div class="relative group">
                            <button
                                class="flex items-center space-x-3 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} p-3 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all duration-300">
                                <div
                                    class="w-8 h-8 bg-gradient-to-r from-emerald-400 to-teal-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                                <i
                                    class="fas fa-chevron-down text-xs group-hover:rotate-180 transition-transform duration-300"></i>
                            </button>
                            <div
                                class="absolute top-full {{ app()->getLocale() === 'ar' ? 'left-0' : 'right-0' }} mt-2 w-48 bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl border border-gray-200/50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                                <div class="py-3">
                                    <a href="{{ route('users.profile') }}"
                                        class="flex items-center px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 hover:text-emerald-600 transition-all duration-200">
                                        <i
                                            class="fas fa-user text-emerald-500 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></i>
                                        {{ app()->getLocale() === 'ar' ? 'الملف الشخصي' : 'Profile' }}
                                    </a>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="flex items-center px-4 py-3 text-red-600 hover:bg-red-50 transition-all duration-200">
                                        <i
                                            class="fas fa-sign-out-alt {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></i>
                                        {{ app()->getLocale() === 'ar' ? 'تسجيل خروج' : 'Logout' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="auth-btn flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} px-6 py-3 text-emerald-600 hover:text-emerald-700 font-semibold transition-all duration-300">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>{{ app()->getLocale() === 'ar' ? 'تسجيل دخول' : 'Login' }}</span>
                        </a>
                        <a href="{{ route('volunteers.index') }}"
                            class="auth-btn flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-heart"></i>
                            <span>{{ app()->getLocale() === 'ar' ? 'انضم إلينا' : 'Join Us' }}</span>
                        </a>
                    @endauth

                    <!-- زر القائمة المحمولة -->
                    <button id="mobile-menu-btn"
                        class="lg:hidden p-3 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all duration-300">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- القائمة المحمولة الأنيقة -->
    <div id="mobile-menu" class="lg:hidden bg-white/95 backdrop-blur-md border-b border-gray-200/50 hidden">
        <div class="px-6 py-4 space-y-2">
            <a href="{{ route('home') }}"
                class="block px-4 py-3 text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl font-medium transition-all duration-200">
                {{ app()->getLocale() === 'ar' ? 'الرئيسية' : 'Home' }}
            </a>

            <!-- التبرعات في الموبايل -->
            <div class="mobile-dropdown">
                <button
                    class="mobile-dropdown-btn flex items-center justify-between w-full px-4 py-3 text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl font-medium transition-all duration-200">
                    <span>{{ app()->getLocale() === 'ar' ? 'التبرعات' : 'donations' }}</span>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
                </button>
                <div
                    class="mobile-dropdown-content hidden {{ app()->getLocale() === 'ar' ? 'mr-6' : 'ml-6' }} mt-2 space-y-1">
                    <a href="{{ route('food-donations.index') }}"
                        class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                        {{ app()->getLocale() === 'ar' ? 'التطوع باللوازم' : 'Volunteer with Supplies' }}
                    </a>
                    <a href="{{ route('digital-currency-donations.index') }}"
                        class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                        {{ app()->getLocale() === 'ar' ? 'العملات الرقمية' : 'Digital Currency' }}
                    </a>
                    <a href="{{ route('sms-donations.index') }}"
                        class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                        {{ app()->getLocale() === 'ar' ? 'الرسائل النصية' : 'SMS Donations' }}
                    </a>
                </div>
            </div>

            <a href="{{ route('contact.index') }}"
                class="block px-4 py-3 text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl font-medium transition-all duration-200">
                {{ app()->getLocale() === 'ar' ? 'الدعم الفني' : 'Support' }}
            </a>

            <!-- المزيد في الموبايل -->
            <div class="mobile-dropdown">
                <button
                    class="mobile-dropdown-btn flex items-center justify-between w-full px-4 py-3 text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl font-medium transition-all duration-200">
                    <span>{{ app()->getLocale() === 'ar' ? 'المزيد' : 'More' }}</span>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
                </button>
                <div
                    class="mobile-dropdown-content hidden {{ app()->getLocale() === 'ar' ? 'mr-6' : 'ml-6' }} mt-2 space-y-1">
                    @foreach ($pages ?? [] as $page)
                        <a href="{{ route('pages.show', $page->slug) }}"
                            class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                            {{ $page->title }}
                        </a>
                    @endforeach
                    <a href="{{ route('testimonials.index') }}"
                        class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                        {{ app()->getLocale() === 'ar' ? 'آراء المستخدمين' : 'Testimonials' }}
                    </a>
                </div>
            </div>

            <!-- مبدل اللغات في الموبايل -->
            <div class="border-t border-gray-200/50 pt-4 mt-4">
                <div class="px-4 mb-4">
                    <p class="text-sm text-gray-600 mb-2">{{ app()->getLocale() === 'ar' ? 'اللغة' : 'Language' }}</p>
                    <div class="flex bg-gray-100 rounded-xl p-1">
                        <a href="{{ route('language.switch', 'ar') }}?redirect={{ urlencode(request()->fullUrl()) }}"
                            class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} flex-1 px-3 py-2 rounded-lg transition-all duration-300 {{ app()->getLocale() === 'ar' ? 'bg-white text-emerald-600 shadow-sm font-semibold' : 'text-gray-600 hover:text-emerald-600' }}">
                            <div
                                class="w-4 h-4 rounded-full overflow-hidden border {{ app()->getLocale() === 'ar' ? 'border-emerald-200' : 'border-gray-300' }}">
                                <div class="w-full h-full bg-gradient-to-b from-green-500 via-white to-red-500"></div>
                            </div>
                            <span class="text-sm">عربي</span>
                        </a>
                        <a href="{{ route('language.switch', 'en') }}?redirect={{ urlencode(request()->fullUrl()) }}"
                            class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} flex-1 px-3 py-2 rounded-lg transition-all duration-300 {{ app()->getLocale() === 'en' ? 'bg-white text-emerald-600 shadow-sm font-semibold' : 'text-gray-600 hover:text-emerald-600' }}">
                            <div
                                class="w-4 h-4 rounded-full overflow-hidden border {{ app()->getLocale() === 'en' ? 'border-emerald-200' : 'border-gray-300' }}">
                                <div class="w-full h-full bg-gradient-to-b from-blue-900 via-white to-red-500"></div>
                            </div>
                            <span class="text-sm">EN</span>
                        </a>
                    </div>
                </div>
            </div>

            @guest
                <div class="border-t border-gray-200/50 pt-4 space-y-2">
                    <a href="{{ route('login') }}"
                        class="block px-4 py-3 text-emerald-600 hover:text-emerald-700 hover:bg-emerald-50 rounded-xl font-medium transition-all duration-200">
                        {{ app()->getLocale() === 'ar' ? 'تسجيل دخول' : 'Login' }}
                    </a>
                    <a href="{{ route('volunteers.index') }}"
                        class="block px-4 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 text-white hover:from-emerald-600 hover:to-teal-700 rounded-xl font-semibold text-center transition-all duration-200">
                        {{ app()->getLocale() === 'ar' ? 'انضم إلينا' : 'Join Us' }}
                    </a>
                </div>
            @endguest
        </div>
    </div>
</nav>

<!-- الإشعارات Sidebar الأنيقة -->
<div id="notifications-sidebar"
    class="fixed inset-y-0 {{ app()->getLocale() === 'ar' ? 'left-0' : 'right-0' }} z-50 w-96 bg-white/95 backdrop-blur-md shadow-2xl transform {{ app()->getLocale() === 'ar' ? '-translate-x-full' : 'translate-x-full' }} transition-transform duration-300">
    <div class="flex flex-col h-full">
        <div
            class="flex items-center justify-between p-6 border-b border-gray-200/50 bg-gradient-to-r from-emerald-500 to-teal-600 text-white">
            <h3 class="text-xl font-bold flex items-center">
                <i class="fas fa-bell {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></i>
                {{ app()->getLocale() === 'ar' ? 'الإشعارات' : 'Notifications' }}
            </h3>
            <button id="close-notifications" class="p-2 hover:bg-white/20 rounded-lg transition-colors">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto p-6">
            @if($notifications->count() > 0)
                <div class="space-y-4">
                    @foreach($notifications as $notification)
                        <div class="flex items-start gap-4 p-4 {{ $notification->is_read ? 'bg-white' : 'bg-emerald-50' }} rounded-2xl hover:bg-emerald-50/80 transition-all duration-300 group">
                            <div class="w-10 h-10 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:from-emerald-200 group-hover:to-teal-200">
                                @switch($notification->type)
                                    @case('donation')
                                        <i class="fas fa-hand-holding-heart text-emerald-600"></i>
                                        @break
                                    @case('project')
                                        <i class="fas fa-project-diagram text-emerald-600"></i>
                                        @break
                                    @case('volunteer')
                                        <i class="fas fa-hands-helping text-emerald-600"></i>
                                        @break
                                    @default
                                        <i class="fas fa-bell text-emerald-600"></i>
                                @endswitch
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 text-sm group-hover:text-emerald-600">
                                    {{ $notification->title }}
                                </h4>
                                <p class="text-gray-600 text-sm mt-1">
                                    {{ $notification->message }}
                                </p>
                                <div class="flex items-center justify-between mt-2">
                                    <p class="text-gray-400 text-xs">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                    @if(!$notification->is_read)
                                        <form action="{{ route('notifications.mark-read', $notification->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-xs text-emerald-600 hover:text-emerald-700 font-medium">
                                                {{ app()->getLocale() === 'ar' ? 'تحديد كمقروء' : 'Mark as Read' }}
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('notifications.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-semibold rounded-xl hover:from-emerald-600 hover:to-teal-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <i class="fas fa-list-ul {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        {{ app()->getLocale() === 'ar' ? 'عرض كل الإشعارات' : 'View All Notifications' }}
                    </a>
                </div>
            @else
                <div class="text-center text-gray-500 py-12">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-bell-slash text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-semibold mb-2">
                        {{ app()->getLocale() === 'ar' ? 'لا توجد إشعارات' : 'No Notifications' }}
                    </h4>
                    <p class="text-sm">
                        {{ app()->getLocale() === 'ar' ? 'سنعلمك عند وصول إشعارات جديدة' : 'We\'ll notify you when new notifications arrive' }}
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- الخلفية الشفافة الأنيقة -->
<div id="overlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 hidden transition-all duration-300"></div>

<style>
    /* الأنيميشن المخصص */
    @keyframes float {

        0%,
        100% {
            transform: translateY(0px) rotate(0deg);
        }

        50% {
            transform: translateY(-10px) rotate(5deg);
        }
    }

    .animation-delay-1000 {
        animation-delay: 1000ms;
    }

    /* تحسينات إضافية */
    .language-switch {
        position: relative;
    }

    .mobile-dropdown-btn.active i {
        transform: rotate(180deg);
    }

    /* تأثيرات الانتقال */
    * {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* تحسين الخطوط */
    body {
        font-family: 'Cairo', 'Inter', sans-serif;
    }

    /* تحسين الظلال */
    .shadow-2xl {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    /* تحسين البلور الخلفي */
    .backdrop-blur-md {
        backdrop-filter: blur(12px);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const overlay = document.getElementById('overlay');
    const menuIcon = document.querySelector('.mobile-menu-icon');
    const closeIcon = document.querySelector('.mobile-close-icon');

    mobileMenuBtn.addEventListener('click', function() {
        const isOpen = mobileMenu.classList.contains('show');

        if (isOpen) {
            // Close menu
            mobileMenu.classList.remove('show');
            overlay.classList.add('hidden');
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
            document.body.style.overflow = '';
        } else {
            // Open menu
            mobileMenu.classList.add('show');
            overlay.classList.remove('hidden');
            menuIcon.classList.add('hidden');
            closeIcon.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    });

    // Mobile accordion functionality
    document.querySelectorAll('.mobile-accordion-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const content = this.nextElementSibling;
            const icon = this.querySelector('.accordion-icon');

            // Close other accordions
            document.querySelectorAll('.mobile-accordion-content').forEach(otherContent => {
                if (otherContent !== content) {
                    otherContent.classList.remove('show');
                    otherContent.previousElementSibling.querySelector('.accordion-icon').classList.remove('rotated');
                }
            });

            // Toggle current accordion
            content.classList.toggle('show');
            icon.classList.toggle('rotated');
        });
    });

    // Notifications sidebar
    const notificationsBtn = document.getElementById('notifications-btn');
    const mobileNotificationsBtn = document.getElementById('mobile-notifications-btn');
    const notificationsSidebar = document.getElementById('notifications-sidebar');
    const closeNotifications = document.getElementById('close-notifications');

    function openNotifications() {
        notificationsSidebar.classList.remove('{{ app()->getLocale() === 'ar' ? '-translate-x-full' : 'translate-x-full' }}');
        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        // Close mobile menu if open
        if (mobileMenu.classList.contains('show')) {
            mobileMenu.classList.remove('show');
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
        }
    }

    function closeNotificationsFunc() {
        notificationsSidebar.classList.add('{{ app()->getLocale() === 'ar' ? '-translate-x-full' : 'translate-x-full' }}');
        if (!mobileMenu.classList.contains('show')) {
            overlay.classList.add('hidden');
            document.body.style.overflow = '';
        }
    }

    if (notificationsBtn) {
        notificationsBtn.addEventListener('click', openNotifications);
    }

    if (mobileNotificationsBtn) {
        mobileNotificationsBtn.addEventListener('click', openNotifications);
    }

    if (closeNotifications) {
        closeNotifications.addEventListener('click', closeNotificationsFunc);
    }

    // Overlay click handler
    overlay.addEventListener('click', function() {
        // Close notifications
        closeNotificationsFunc();

        // Close mobile menu
        if (mobileMenu.classList.contains('show')) {
            mobileMenu.classList.remove('show');
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
        }

        overlay.classList.add('hidden');
        document.body.style.overflow = '';
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
            // Close mobile menu on desktop
            mobileMenu.classList.remove('show');
            overlay.classList.add('hidden');
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
            document.body.style.overflow = '';
        }
    });

    // Navbar scroll effect
    let lastScrollY = window.scrollY;
    const navbar = document.getElementById('navbar');

    window.addEventListener('scroll', function() {
        const currentScrollY = window.scrollY;

        if (currentScrollY > 100) {
            navbar.classList.add('shadow-xl');
            navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.98)';
        } else {
            navbar.classList.remove('shadow-xl');
            navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
        }

        // Auto-hide navbar on scroll down (mobile only)
        if (window.innerWidth < 1024) {
            if (currentScrollY > lastScrollY && currentScrollY > 100) {
                // Scrolling down
                navbar.style.transform = 'translateY(-100%)';
            } else {
                // Scrolling up
                navbar.style.transform = 'translateY(0)';
            }
        }

        lastScrollY = currentScrollY;
    });

    // Touch gesture improvements for mobile
    if ('ontouchstart' in window) {
        // Add touch feedback
        document.querySelectorAll('.mobile-nav-item, .nav-link, .btn-primary, .btn-secondary').forEach(element => {
            element.addEventListener('touchstart', function() {
                this.style.transform = 'scale(0.98)';
            });

            element.addEventListener('touchend', function() {
                this.style.transform = 'scale(1)';
            });
        });
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            // Close mobile menu and notifications on Escape
            if (mobileMenu.classList.contains('show')) {
                mobileMenuBtn.click();
            }
            if (!notificationsSidebar.classList.contains('{{ app()->getLocale() === 'ar' ? '-translate-x-full' : 'translate-x-full' }}')) {
                closeNotificationsFunc();
            }
        }
    });

    console.log('🚀 Modern Navbar initialized successfully!');
});
</script>

<script>
    // مبدل اللغات السويتش - لا يحتاج JavaScript! 🎉

    // القائمة المحمولة الأنيقة
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');

        // تأثير الأيقونة
        const icon = this.querySelector('i');
        icon.classList.toggle('fa-bars');
        icon.classList.toggle('fa-times');
    });

    // القوائم المنسدلة في الموبايل
    document.querySelectorAll('.mobile-dropdown-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const content = this.nextElementSibling;
            const icon = this.querySelector('i');

            content.classList.toggle('hidden');
            this.classList.toggle('active');
        });
    });

    // الإشعارات الأنيقة
    const notificationsBtn = document.getElementById('notifications-btn');
    const notificationsSidebar = document.getElementById('notifications-sidebar');
    const closeNotifications = document.getElementById('close-notifications');
    const overlay = document.getElementById('overlay');

    if (notificationsBtn) {
        notificationsBtn.addEventListener('click', function() {
            notificationsSidebar.classList.remove(
                '{{ app()->getLocale() === 'ar' ? '-translate-x-full' : 'translate-x-full' }}');
            overlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
    }

    if (closeNotifications) {
        closeNotifications.addEventListener('click', function() {
            notificationsSidebar.classList.add(
                '{{ app()->getLocale() === 'ar' ? '-translate-x-full' : 'translate-x-full' }}');
            overlay.classList.add('hidden');
            document.body.style.overflow = '';
        });
    }

    if (overlay) {
        overlay.addEventListener('click', function() {
            notificationsSidebar.classList.add(
                '{{ app()->getLocale() === 'ar' ? '-translate-x-full' : 'translate-x-full' }}');
            overlay.classList.add('hidden');
            document.getElementById('mobile-menu').classList.add('hidden');
            document.body.style.overflow = '';

            // إعادة تعيين أيقونة القائمة المحمولة
            const mobileBtn = document.getElementById('mobile-menu-btn');
            const icon = mobileBtn.querySelector('i');
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        });
    }

    // تأثير التمرير الأنيق
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 100) {
            navbar.classList.add('shadow-2xl');
            navbar.querySelector('.bg-white\\/95').style.backgroundColor = 'rgba(255, 255, 255, 0.98)';
        } else {
            navbar.classList.remove('shadow-2xl');
            navbar.querySelector('.bg-white\\/95').style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
        }
    });

    // تأثيرات إضافية عند التحميل
    document.addEventListener('DOMContentLoaded', function() {
        // تأثير التحميل
        const navbar = document.getElementById('navbar');
        navbar.style.transform = 'translateY(-100%)';
        setTimeout(() => {
            navbar.style.transform = 'translateY(0)';
        }, 100);

        console.log('🎨 Elegant Navbar loaded successfully!');
    });
</script>
