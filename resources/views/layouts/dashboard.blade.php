<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'لوحة التحكم') - {{ config('app.name') }}</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Alpine.js --}}
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Google Fonts - أخف وأجمل --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700&family=Poppins:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            font-weight: 300;
            letter-spacing: 0.3px;
        }

        .font-medium {
            font-weight: 400;
        }

        .font-semibold {
            font-weight: 500;
        }

        .font-bold {
            font-weight: 600;
        }
    </style>

    {{-- Tailwind Configuration --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e'
                        },
                        soft: {
                            blue: '#e6f3ff',
                            gray: '#f8fafc',
                            green: '#f0fdf4',
                            orange: '#fff7ed',
                            red: '#fef2f2'
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gradient-to-br from-gray-50 to-slate-100 {{ app()->getLocale() === 'ar' ? 'font-ar' : 'font-en' }}"
    x-data="{
        sidebarOpen: false,
        sidebarLocked: false,
        isMobile: window.innerWidth < 1024,
        currentTime: '',
        currentDate: '',
        init() {
            this.updateTime();
            setInterval(() => this.updateTime(), 1000);

            // Handle resize
            window.addEventListener('resize', () => {
                this.isMobile = window.innerWidth < 1024;
                if (this.isMobile) {
                    this.sidebarLocked = false;
                }
            });

            // Auto-close sidebar on mobile when clicking outside
            document.addEventListener('click', (e) => {
                if (this.isMobile && this.sidebarOpen && !e.target.closest('#sidebar') && !e.target.closest('#mobile-menu-btn')) {
                    this.sidebarOpen = false;
                }
            });
        },
        updateTime() {
            const now = new Date();
            this.currentTime = now.toLocaleString('{{ app()->getLocale() }}', {
                hour: '2-digit',
                minute: '2-digit'
            });
            this.currentDate = now.toLocaleDateString('{{ app()->getLocale() }}', {
                weekday: 'long',
                day: 'numeric',
                month: 'long'
            });
        },
        toggleSidebarLock() {
            this.sidebarLocked = !this.sidebarLocked;
            if (this.sidebarLocked) {
                this.sidebarOpen = true;
            }
        }
    }" x-init="init()" :class="{ 'overflow-hidden': isMobile && sidebarOpen }">

    {{-- Mobile/Tablet Sidebar Overlay --}}
    <div x-show="sidebarOpen && !sidebarLocked" x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-black bg-opacity-50 xl:hidden"></div>

    {{-- Sidebar --}}
    <div id="sidebar"
        class="fixed inset-y-0 {{ app()->getLocale() === 'ar' ? 'right-0' : 'left-0' }} z-50
                w-64 md:w-72 lg:w-80 xl:w-72
                bg-gradient-to-b from-slate-700 via-slate-800 to-slate-900
                transform transition-all duration-300 ease-in-out
                overflow-y-auto shadow-2xl"
        :class="{
            'translate-x-0': sidebarOpen || sidebarLocked,
            '{{ app()->getLocale() === 'ar' ? 'translate-x-full' : '-translate-x-full' }}': !sidebarOpen && !
                sidebarLocked && isMobile,
            'xl:translate-x-0': !isMobile
        }"
        x-trap="sidebarOpen && isMobile">

        {{-- Logo & Brand with Lock Button --}}
        <div class="px-6 py-6 bg-black bg-opacity-10">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                    <div
                        class="w-10 h-10 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-heart text-white text-lg"></i>
                    </div>
                    <div class="text-white">
                        <h1 class="text-xl font-bold">{{ config('app.name', 'Teamwork') }}</h1>
                        <p class="text-sm opacity-80">لوحة التحكم</p>
                    </div>
                </div>

                {{-- Sidebar Lock/Pin Button (Hidden on mobile) --}}
                <div class="hidden lg:flex xl:hidden">
                    <button @click="toggleSidebarLock()"
                        class="p-2 text-white hover:bg-white hover:bg-opacity-20 rounded-xl transition-all duration-300"
                        :class="{ 'bg-white bg-opacity-20': sidebarLocked }"
                        :title="sidebarLocked ? 'إلغاء تثبيت القائمة' : 'تثبيت القائمة'">
                        <i :class="sidebarLocked ? 'fas fa-thumbtack' : 'fas fa-thumbtack transform rotate-45'"
                            class="text-sm"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- Search Bar --}}
        <div class="px-6 mb-8">
            <div class="relative">
                <input type="text" placeholder="بحث..."
                    class="w-full bg-white bg-opacity-20 border border-white border-opacity-30 rounded-2xl px-4 py-3 {{ app()->getLocale() === 'ar' ? 'pr-12' : 'pl-12' }} text-white placeholder-white placeholder-opacity-70 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 focus:bg-opacity-30 transition-all duration-300">
                <div
                    class="absolute {{ app()->getLocale() === 'ar' ? 'right-4' : 'left-4' }} top-1/2 transform -translate-y-1/2 text-white opacity-70">
                    <i class="fas fa-search"></i>
                </div>
            </div>
        </div>

        {{-- Navigation Menu --}}
        <nav class="px-4 space-y-2">
            {{-- القائمة الرئيسية --}}
            <div class="text-white text-xs uppercase tracking-wider font-semibold mb-4 px-4 opacity-70">
                القائمة الرئيسية
            </div>

            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center px-4 py-3 text-white rounded-2xl transition-all duration-300 hover:bg-white hover:bg-opacity-20 hover:transform hover:translate-x-1 {{ request()->routeIs('admin.dashboard') ? 'bg-white bg-opacity-20 shadow-lg' : '' }}">
                <div
                    class="flex items-center justify-center w-8 h-8 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}">
                    <i class="fas fa-chart-pie text-lg"></i>
                </div>
                <span class="font-medium">لوحة التحكم</span>
            </a>

            {{-- إدارة المشاريع --}}
            <div class="text-white text-xs uppercase tracking-wider font-semibold mb-4 mt-8 px-4 opacity-70">
                إدارة المشاريع
            </div>

            {{-- Projects --}}
            <div x-data="{ open: {{ request()->routeIs('admin.projects.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full px-4 py-3 text-white rounded-2xl transition-all duration-300 hover:bg-white hover:bg-opacity-20">
                    <div class="flex items-center">
                        <div
                            class="flex items-center justify-center w-8 h-8 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}">
                            <i class="fas fa-project-diagram text-lg"></i>
                        </div>
                        <span class="font-medium">إدارة المشاريع</span>
                    </div>
                    <i class="fas fa-chevron-down transition-transform duration-300" :class="open && 'rotate-180'"></i>
                </button>
                <div x-show="open" x-transition class="mt-2 space-y-1 {{ app()->getLocale() === 'ar' ? 'mr-8' : 'ml-8' }}">
                    <a href="{{ route('admin.projects.index') }}"
                        class="flex items-center px-4 py-2 text-white text-sm rounded-xl transition-all duration-300 hover:bg-white hover:bg-opacity-20 {{ request()->routeIs('admin.projects.index') ? 'bg-white bg-opacity-20' : '' }}">
                        <i class="fas fa-list {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        قائمة المشاريع
                    </a>
                    <a href="{{ route('admin.projects.create') }}"
                        class="flex items-center px-4 py-2 text-white text-sm rounded-xl transition-all duration-300 hover:bg-white hover:bg-opacity-20 {{ request()->routeIs('admin.projects.create') ? 'bg-white bg-opacity-20' : '' }}">
                        <i class="fas fa-plus {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        إضافة مشروع
                    </a>
                </div>
            </div>

            {{-- إدارة التبرعات --}}
            <div class="text-white text-xs uppercase tracking-wider font-semibold mb-4 mt-8 px-4 opacity-70">
                إدارة التبرعات
            </div>

            {{-- Donations Management --}}
            <div x-data="{ open: {{ request()->routeIs('admin.food-donations.*', 'admin.digital-currency-donations.*', 'admin.sms-donations.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="flex items-center justify-between w-full px-4 py-3 text-white rounded-2xl transition-all duration-300 hover:bg-white hover:bg-opacity-20">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-8 h-8 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}">
                            <i class="fas fa-hand-holding-heart text-lg"></i>
                        </div>
                        <span class="font-medium">التبرعات</span>
                    </div>
                    <i class="fas fa-chevron-down transform transition-transform text-sm" :class="open ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="open" x-transition class="{{ app()->getLocale() === 'ar' ? 'mr-11' : 'ml-11' }} mt-2 space-y-1">
                    <a href="{{ route('admin.food-donations.index') }}"
                       class="flex items-center px-4 py-2 text-white text-sm rounded-xl transition-all duration-300 hover:bg-white hover:bg-opacity-10">
                        <div class="w-2 h-2 bg-white bg-opacity-50 rounded-full {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></div>
                        <span>تبرعات الطعام</span>
                    </a>
                    <a href="{{ route('admin.digital-currency-donations.index') }}"
                       class="flex items-center px-4 py-2 text-white text-sm rounded-xl transition-all duration-300 hover:bg-white hover:bg-opacity-10">
                        <div class="w-2 h-2 bg-white bg-opacity-50 rounded-full {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></div>
                        <span>العملات الرقمية</span>
                    </a>
                    <a href="{{ route('admin.sms-donations.index') }}"
                       class="flex items-center px-4 py-2 text-white text-sm rounded-xl transition-all duration-300 hover:bg-white hover:bg-opacity-10">
                        <div class="w-2 h-2 bg-white bg-opacity-50 rounded-full {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></div>
                        <span>تبرعات SMS</span>
                    </a>
                    <a href="{{ route('admin.sms-donation-records.index') }}"
                       class="flex items-center px-4 py-2 text-white text-sm rounded-xl transition-all duration-300 hover:bg-white hover:bg-opacity-10">
                        <div class="w-2 h-2 bg-white bg-opacity-50 rounded-full {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></div>
                        <span>سجلات SMS</span>
                    </a>
                </div>
            </div>

            {{-- Orders --}}
            <a href="{{ route('admin.donations.index') }}"
               class="flex items-center px-4 py-3 text-white rounded-2xl transition-all duration-300 hover:bg-white hover:bg-opacity-20 {{ request()->routeIs('admin.orders.*') ? 'bg-white bg-opacity-20' : '' }}">
                <div class="flex items-center justify-center w-8 h-8 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}">
                    <i class="fas fa-shopping-cart text-lg"></i>
                </div>
                <span class="font-medium">طلبات التبرع</span>
            </a>

            {{-- إدارة المستخدمين --}}
            <div class="text-white text-xs uppercase tracking-wider font-semibold mb-4 mt-8 px-4 opacity-70">
                إدارة المستخدمين
            </div>

            {{-- Users Management --}}
            <div x-data="{ open: {{ request()->routeIs('admin.users.*', 'admin.volunteers.*', 'admin.beneficiaries.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="flex items-center justify-between w-full px-4 py-3 text-white rounded-2xl transition-all duration-300 hover:bg-white hover:bg-opacity-20">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-8 h-8 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}">
                            <i class="fas fa-users text-lg"></i>
                        </div>
                        <span class="font-medium">المستخدمين</span>
                    </div>
                    <i class="fas fa-chevron-down transform transition-transform text-sm" :class="open ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="open" x-transition class="{{ app()->getLocale() === 'ar' ? 'mr-11' : 'ml-11' }} mt-2 space-y-1">
                    <a href="{{ route('admin.users.index') }}"
                       class="flex items-center px-4 py-2 text-white text-sm rounded-xl transition-all duration-300 hover:bg-white hover:bg-opacity-10">
                        <div class="w-2 h-2 bg-white bg-opacity-50 rounded-full {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></div>
                        <span>جميع المستخدمين</span>
                    </a>
                    <a href="{{ route('admin.volunteers.index') }}"
                       class="flex items-center px-4 py-2 text-white text-sm rounded-xl transition-all duration-300 hover:bg-white hover:bg-opacity-10">
                        <div class="w-2 h-2 bg-white bg-opacity-50 rounded-full {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></div>
                        <span>المتطوعين</span>
                    </a>
                    <a href="{{ route('admin.beneficiaries.index') }}"
                       class="flex items-center px-4 py-2 text-white text-sm rounded-xl transition-all duration-300 hover:bg-white hover:bg-opacity-10">
                        <div class="w-2 h-2 bg-white bg-opacity-50 rounded-full {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></div>
                        <span>المستفيدين</span>
                    </a>
                    <a href="{{ route('admin.roles.index') }}"
                       class="flex items-center px-4 py-2 text-white text-sm rounded-xl transition-all duration-300 hover:bg-white hover:bg-opacity-10">
                        <div class="w-2 h-2 bg-white bg-opacity-50 rounded-full {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></div>
                        <span>الأدوار</span>
                    </a>
                </div>
            </div>

            {{-- إدارة المحتوى --}}
            <div class="text-white text-xs uppercase tracking-wider font-semibold mb-4 mt-8 px-4 opacity-70">
                إدارة المحتوى
            </div>

            {{-- Content Management --}}
            <div x-data="{ open: {{ request()->routeIs('admin.stories.*', 'admin.testimonials.*', 'admin.pages.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="flex items-center justify-between w-full px-4 py-3 text-white rounded-2xl transition-all duration-300 hover:bg-white hover:bg-opacity-20">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-8 h-8 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}">
                            <i class="fas fa-file-alt text-lg"></i>
                        </div>
                        <span class="font-medium">المحتوى</span>
                    </div>
                    <i class="fas fa-chevron-down transform transition-transform text-sm" :class="open ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="open" x-transition class="{{ app()->getLocale() === 'ar' ? 'mr-11' : 'ml-11' }} mt-2 space-y-1">
                    <a href="{{ route('admin.stories.index') }}"
                       class="flex items-center px-4 py-2 text-white text-sm rounded-xl transition-all duration-300 hover:bg-white hover:bg-opacity-10">
                        <div class="w-2 h-2 bg-white bg-opacity-50 rounded-full {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></div>
                        <span>قصص المستفيدين</span>
                    </a>
                    <a href="{{ route('admin.testimonials.index') }}"
                       class="flex items-center px-4 py-2 text-white text-sm rounded-xl transition-all duration-300 hover:bg-white hover:bg-opacity-10">
                        <div class="w-2 h-2 bg-white bg-opacity-50 rounded-full {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></div>
                        <span>آراء المستخدمين</span>
                    </a>
                    <a href="{{ route('admin.pages.index') }}"
                       class="flex items-center px-4 py-2 text-white text-sm rounded-xl transition-all duration-300 hover:bg-white hover:bg-opacity-10">
                        <div class="w-2 h-2 bg-white bg-opacity-50 rounded-full {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></div>
                        <span>الصفحات</span>
                    </a>
                </div>
            </div>

            {{-- النظام المالي --}}
            <div class="text-white text-xs uppercase tracking-wider font-semibold mb-4 mt-8 px-4 opacity-70">
                النظام المالي
            </div>

            {{-- Financial Management --}}
            <div x-data="{ open: {{ request()->routeIs('admin.bank-accounts.*', 'admin.e-wallets.*', 'admin.financial.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="flex items-center justify-between w-full px-4 py-3 text-white rounded-2xl transition-all duration-300 hover:bg-white hover:bg-opacity-20">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-8 h-8 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}">
                            <i class="fas fa-university text-lg"></i>
                        </div>
                        <span class="font-medium">الأنظمة المالية</span>
                    </div>
                    <i class="fas fa-chevron-down transform transition-transform text-sm" :class="open ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="open" x-transition class="{{ app()->getLocale() === 'ar' ? 'mr-11' : 'ml-11' }} mt-2 space-y-1">
                    <a href="{{ route('admin.financial.dashboard') }}"
                       class="flex items-center px-4 py-2 text-white text-sm rounded-xl transition-all duration-300 hover:bg-white hover:bg-opacity-10">
                        <div class="w-2 h-2 bg-white bg-opacity-50 rounded-full {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></div>
                        <span>لوحة المالية</span>
                    </a>
                    <a href="{{ route('admin.bank-accounts.index') }}"
                       class="flex items-center px-4 py-2 text-white text-sm rounded-xl transition-all duration-300 hover:bg-white hover:bg-opacity-10">
                        <div class="w-2 h-2 bg-white bg-opacity-50 rounded-full {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></div>
                        <span>الحسابات البنكية</span>
                    </a>
                    <a href="{{ route('admin.e-wallets.index') }}"
                       class="flex items-center px-4 py-2 text-white text-sm rounded-xl transition-all duration-300 hover:bg-white hover:bg-opacity-10">
                        <div class="w-2 h-2 bg-white bg-opacity-50 rounded-full {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></div>
                        <span>المحافظ الإلكترونية</span>
                    </a>
                </div>
            </div>

            {{-- الدعم التقني --}}
            <div class="text-white text-xs uppercase tracking-wider font-semibold mb-4 mt-8 px-4 opacity-70">
                الدعم التقني
            </div>

            {{-- Support --}}
            <a href="{{ route('admin.support.tickets.index') }}"
               class="flex items-center px-4 py-3 text-white rounded-2xl transition-all duration-300 hover:bg-white hover:bg-opacity-20 {{ request()->routeIs('admin.support.tickets.*') ? 'bg-white bg-opacity-20' : '' }}">
                <div class="flex items-center justify-center w-8 h-8 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}">
                    <i class="fas fa-headset text-lg"></i>
                </div>
                <span class="font-medium">التذاكر</span>
            </a>

            <a href="{{ route('admin.contacts.index') }}"
               class="flex items-center px-4 py-3 text-white rounded-2xl transition-all duration-300 hover:bg-white hover:bg-opacity-20 {{ request()->routeIs('admin.contacts.*') ? 'bg-white bg-opacity-20' : '' }}">
                <div class="flex items-center justify-center w-8 h-8 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}">
                    <i class="fas fa-envelope text-lg"></i>
                </div>
                <span class="font-medium">رسائل التواصل</span>
            </a>

            {{-- إعدادات النظام --}}
            <div class="text-white text-xs uppercase tracking-wider font-semibold mb-4 mt-8 px-4 opacity-70">
                إعدادات النظام
            </div>

            {{-- Notifications --}}
            <a href="{{ route('admin.notifications.index') }}"
               class="flex items-center px-4 py-3 text-white rounded-2xl transition-all duration-300 hover:bg-white hover:bg-opacity-20 relative {{ request()->routeIs('admin.notifications.*') ? 'bg-white bg-opacity-20' : '' }}">
                <div class="flex items-center justify-center w-8 h-8 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}">
                    <i class="fas fa-bell text-lg"></i>
                </div>
                <span class="font-medium">الإشعارات</span>
                <div class="absolute top-2 {{ app()->getLocale() === 'ar' ? 'right-2' : 'left-10' }} w-2 h-2 bg-red-500 rounded-full"></div>
            </a>

            {{-- Translations --}}
            <a href="{{ route('admin.translations.index') }}"
               class="flex items-center px-4 py-3 text-white rounded-2xl transition-all duration-300 hover:bg-white hover:bg-opacity-20 {{ request()->routeIs('admin.translations.*') ? 'bg-white bg-opacity-20' : '' }}">
                <div class="flex items-center justify-center w-8 h-8 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}">
                    <i class="fas fa-language text-lg"></i>
                </div>
                <span class="font-medium">الترجمات</span>
            </a>

            {{-- Settings --}}
            <a href="{{ route('admin.settings.index') }}"
                class="flex items-center px-4 py-3 text-white rounded-2xl transition-all duration-300 hover:bg-white hover:bg-opacity-20 {{ request()->routeIs('admin.settings.*') ? 'bg-white bg-opacity-20' : '' }}">
                <div
                    class="flex items-center justify-center w-8 h-8 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}">
                    <i class="fas fa-cog text-lg"></i>
                </div>
                <span class="font-medium">إعدادات النظام</span>
            </a>

            {{-- Logout Button --}}
            <div
                class="text-white rounded-2xl transition-all duration-300 hover:bg-white hover:bg-opacity-20">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center px-4 py-3 text-white bg-white bg-opacity-20 rounded-2xl transition-all duration-300 hover:bg-opacity-30">
                        <div
                            class="flex items-center justify-center w-8 h-8 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}">
                            <i class="fas fa-sign-out-alt text-lg"></i>
                        </div>
                        <span class="font-medium">تسجيل الخروج</span>
                    </button>
                </form>
            </div>

        </nav>

    </div>

    {{-- Main Content --}}
    <div class="transition-all duration-300 ease-in-out"
        :class="{
            'xl:{{ app()->getLocale() === 'ar' ? 'mr' : 'ml' }}-72': !isMobile,
            'lg:{{ app()->getLocale() === 'ar' ? 'mr' : 'ml' }}-80': !isMobile && sidebarLocked && window.innerWidth >=
                1024 && window.innerWidth < 1280,
            '{{ app()->getLocale() === 'ar' ? 'mr' : 'ml' }}-0': isMobile || (!sidebarLocked && window.innerWidth >=
                1024 && window.innerWidth < 1280)
        }">
        {{-- Header --}}
        <header class="bg-white/80 backdrop-blur-md shadow-sm border-b border-gray-200 sticky top-0 z-30">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16 lg:h-20">
                    {{-- Left Side --}}
                    <div
                        class="flex items-center space-x-4 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                        {{-- Mobile/Tablet Menu Button --}}
                        <button id="mobile-menu-btn" @click="sidebarOpen = !sidebarOpen"
                            class="xl:hidden p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition-all duration-300"
                            x-show="!sidebarLocked || isMobile">
                            <i class="fas fa-bars text-lg"></i>
                        </button>

                        {{-- Sidebar Toggle for Desktop/Tablet --}}
                        <button @click="toggleSidebarLock()"
                            class="hidden lg:flex xl:hidden p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition-all duration-300"
                            :class="{ 'bg-gray-100 text-gray-900': sidebarLocked }">
                            <i :class="sidebarLocked ? 'fas fa-times' : 'fas fa-bars'" class="text-lg"></i>
                        </button>

                        {{-- Title & Date --}}
                        <div>
                            <h1 class="text-xl lg:text-2xl font-bold text-gray-900">
                                @yield('page-title', 'لوحة التحكم')
                            </h1>
                            <p class="hidden sm:block text-sm text-gray-500" x-text="currentDate"></p>
                        </div>
                    </div>

                    {{-- Right Side --}}
                    <div
                        class="flex items-center space-x-3 lg:space-x-4 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                        {{-- Search --}}
                        <div class="hidden md:block relative">
                            <input type="text" placeholder="بحث..."
                                class="w-64 lg:w-80 px-4 py-2 {{ app()->getLocale() === 'ar' ? 'pr-10' : 'pl-10' }} bg-gray-50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300">
                            <div
                                class="absolute {{ app()->getLocale() === 'ar' ? 'right-3' : 'left-3' }} top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>

                        {{-- Add Button --}}
                        <button
                            class="p-2 lg:p-3 text-gray-600 hover:text-white hover:bg-slate-600 rounded-xl transition-all duration-300 shadow-sm hover:shadow-md">
                            <i class="fas fa-plus text-lg"></i>
                        </button>

                        {{-- Notifications --}}
                        <div class="relative">
                            <button
                                class="p-2 lg:p-3 text-gray-600 hover:text-white hover:bg-slate-600 rounded-xl transition-all duration-300 relative shadow-sm hover:shadow-md">
                                <i class="fas fa-bell text-lg"></i>
                                <div class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full animate-pulse">
                                </div>
                            </button>
                        </div>

                        {{-- User Profile --}}
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center space-x-3 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} p-2 rounded-xl hover:bg-gray-100 transition-all duration-300">
                                <div
                                    class="w-8 h-8 lg:w-10 lg:h-10 bg-gradient-to-r from-slate-500 to-slate-600 rounded-full flex items-center justify-center text-white font-bold text-sm lg:text-base shadow-lg">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <div
                                    class="hidden lg:block text-right {{ app()->getLocale() === 'ar' ? 'text-left' : '' }}">
                                    <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500" x-text="currentTime"></p>
                                </div>
                                <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                            </button>

                            {{-- User Dropdown --}}
                            <div x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 transform scale-95"
                                x-transition:enter-end="opacity-1 transform scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-1 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-95"
                                class="absolute {{ app()->getLocale() === 'ar' ? 'left-0' : 'right-0' }} mt-2 w-48 bg-white rounded-2xl shadow-lg border border-gray-200 py-2 z-50">
                                <a href="#"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                    <i
                                        class="fas fa-user {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }} text-gray-400"></i>
                                    الملف الشخصي
                                </a>
                                <a href="#"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                    <i
                                        class="fas fa-cog {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }} text-gray-400"></i>
                                    الإعدادات
                                </a>
                                <hr class="my-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                        <i
                                            class="fas fa-sign-out-alt {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }} text-red-400"></i>
                                        تسجيل الخروج
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        {{-- Main Content Area --}}
        <main class="p-3 sm:p-4 md:p-6 lg:p-8">
            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-2xl shadow-sm">
                    <div class="flex items-center">
                        <div
                            class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center {{ app()->getLocale() === 'ar' ? 'ml-4' : 'mr-4' }}">
                            <i class="fas fa-check text-green-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">نجح العملية</h4>
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-2xl shadow-sm">
                    <div class="flex items-center">
                        <div
                            class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center {{ app()->getLocale() === 'ar' ? 'ml-4' : 'mr-4' }}">
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">حدث خطأ</h4>
                            <p class="text-sm">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Page Content --}}
            <div class="animate-fade-in">
                @yield('content')
            </div>
        </main>
    </div>

    {{-- Animation Styles --}}
    <style>
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</body>

</html>
