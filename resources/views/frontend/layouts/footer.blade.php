<!-- الفوتر -->
<footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white relative overflow-hidden">
    <!-- خلفية متحركة -->
    <div class="absolute inset-0 opacity-5">
        <div
            class="absolute top-10 {{ app()->getLocale() === 'ar' ? 'right-10' : 'left-10' }} w-64 h-64 bg-charity-500 rounded-full filter blur-3xl animate-pulse">
        </div>
        <div
            class="absolute bottom-10 {{ app()->getLocale() === 'ar' ? 'left-10' : 'right-10' }} w-48 h-48 bg-warm-500 rounded-full filter blur-3xl animate-pulse animation-delay-200">
        </div>
    </div>

    <div class="relative z-10">
        <!-- قسم النشرة الإخبارية -->
        <div class="bg-charity-600 py-12" data-aos="fade-up">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto text-center">
                    <div class="flex items-center justify-center mb-6">
                        <div
                            class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center {{ app()->getLocale() === 'ar' ? 'ml-4' : 'mr-4' }}">
                            <i class="fas fa-envelope text-2xl"></i>
                        </div>
                        <div class="text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}">
                            <h3 class="text-2xl lg:text-3xl font-bold mb-2">
                                {{ app()->getLocale() === 'ar' ? 'اشترك في النشرة الإخبارية' : 'Subscribe to Newsletter' }}
                            </h3>
                            <p class="text-white/90">
                                {{ app()->getLocale() === 'ar' ? 'احصل على آخر الأخبار والتحديثات حول أنشطتنا الخيرية' : 'Get the latest news and updates about our charity activities' }}
                            </p>
                        </div>
                    </div>

                    <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto"
                        onsubmit="subscribeNewsletter(event)">
                        <div class="flex-1">
                            <input type="email"
                                placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل بريدك الإلكتروني' : 'Enter your email' }}"
                                class="w-full px-6 py-3 rounded-xl bg-white/20 backdrop-blur-sm border border-white/30 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-200"
                                required>
                        </div>
                        <button type="submit"
                            class="px-8 py-3 bg-white text-charity-600 font-semibold rounded-xl hover:bg-gray-100 transition-all duration-200 transform hover:scale-105 flex items-center justify-center">
                            <i class="fas fa-paper-plane {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            {{ app()->getLocale() === 'ar' ? 'اشتراك' : 'Subscribe' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- محتوى الفوتر الرئيسي -->
        <div class="py-16">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- معلومات الشركة -->
                    <div class="lg:col-span-2" data-aos="fade-up">
                        <div class="flex items-center mb-6">
                            <img src="{{ asset('' . $settings->logo) }}" alt="Logo"
                                class="w-12 h-12 rounded-full {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}">
                            <div>
                                <h2 class="text-2xl font-bold">{{ app()->getLocale() === 'ar' ? 'إيطا' : 'Eata' }}</h2>
                                <p class="text-charity-400">
                                    {{ app()->getLocale() === 'ar' ? 'معاً نصنع الفرق' : 'Together We Make a Difference' }}
                                </p>
                            </div>
                        </div>

                        <p class="text-gray-300 mb-6 leading-relaxed">
                            {{ $settings->footer_description ?? (app()->getLocale() === 'ar' ? 'منصة إيطا للتبرعات الخيرية تهدف إلى مساعدة المحتاجين حول العالم من خلال ربط المتبرعين بالمشاريع الخيرية الموثوقة والشفافة.' : 'Eata charity platform aims to help those in need around the world by connecting donors with trusted and transparent charity projects.') }}
                        </p>

                        <!-- شبكات التواصل -->
                        <div
                            class="flex items-center space-x-4 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                            <span
                                class="text-sm font-medium text-gray-400">{{ app()->getLocale() === 'ar' ? 'تابعنا:' : 'Follow us:' }}</span>
                            <div class="flex space-x-3 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                                <a href="{{ $settings->facebook_link }}"
                                    class="w-10 h-10 bg-charity-600 hover:bg-charity-500 rounded-full flex items-center justify-center transition-all duration-200 transform hover:scale-110">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="{{ $settings->twitter_link }}"
                                    class="w-10 h-10 bg-charity-600 hover:bg-charity-500 rounded-full flex items-center justify-center transition-all duration-200 transform hover:scale-110">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="{{ $settings->youtube_link }}"
                                    class="w-10 h-10 bg-charity-600 hover:bg-charity-500 rounded-full flex items-center justify-center transition-all duration-200 transform hover:scale-110">
                                    <i class="fab fa-youtube"></i>
                                </a>
                                <a href="{{ $settings->linkedin_link }}"
                                    class="w-10 h-10 bg-charity-600 hover:bg-charity-500 rounded-full flex items-center justify-center transition-all duration-200 transform hover:scale-110">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- روابط سريعة -->
                    <div data-aos="fade-up" data-aos-delay="200">
                        <h3 class="text-xl font-bold mb-6 flex items-center">
                            <i
                                class="fas fa-link {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} text-charity-500"></i>
                            {{ app()->getLocale() === 'ar' ? 'روابط سريعة' : 'Quick Links' }}
                        </h3>
                        <ul class="space-y-3">
                            <li>
                                <a href="{{ route('home') }}"
                                    class="text-gray-300 hover:text-charity-400 transition-colors duration-200 flex items-center group">
                                    <i
                                        class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} text-xs group-hover:translate-x-1 transition-transform duration-200"></i>
                                    {{ app()->getLocale() === 'ar' ? 'الرئيسية' : 'Home' }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('food-donations.index') }}"
                                    class="text-gray-300 hover:text-charity-400 transition-colors duration-200 flex items-center group">
                                    <i
                                        class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} text-xs group-hover:translate-x-1 transition-transform duration-200"></i>
                                    {{ app()->getLocale() === 'ar' ? 'التطوع باللوازم' : 'Volunteer with Supplies' }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('digital-currency-donations.index') }}"
                                    class="text-gray-300 hover:text-charity-400 transition-colors duration-200 flex items-center group">
                                    <i
                                        class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} text-xs group-hover:translate-x-1 transition-transform duration-200"></i>
                                    {{ app()->getLocale() === 'ar' ? 'التطوع بالعملات الرقمية' : 'Digital Currency Volunteer' }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('contact.index') }}"
                                    class="text-gray-300 hover:text-charity-400 transition-colors duration-200 flex items-center group">
                                    <i
                                        class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} text-xs group-hover:translate-x-1 transition-transform duration-200"></i>
                                    {{ app()->getLocale() === 'ar' ? 'الدعم الفني' : 'Support' }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('testimonials.index') }}"
                                    class="text-gray-300 hover:text-charity-400 transition-colors duration-200 flex items-center group">
                                    <i
                                        class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} text-xs group-hover:translate-x-1 transition-transform duration-200"></i>
                                    {{ app()->getLocale() === 'ar' ? 'آراء المستخدمين' : 'Testimonials' }}
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- معلومات الاتصال -->
                    <div data-aos="fade-up" data-aos-delay="400">
                        <h3 class="text-xl font-bold mb-6 flex items-center">
                            <i
                                class="fas fa-phone {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} text-charity-500"></i>
                            {{ app()->getLocale() === 'ar' ? 'تواصل معنا' : 'Contact Us' }}
                        </h3>
                        <div class="space-y-4">
                            <!-- العنوان -->
                            <div
                                class="flex items-start space-x-3 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                                <div
                                    class="w-10 h-10 bg-charity-600/20 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-map-marker-alt text-charity-500"></i>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-sm mb-1">
                                        {{ app()->getLocale() === 'ar' ? 'العنوان:' : 'Address:' }}</p>
                                    <p class="text-gray-300">{{ $settings->address }}</p>
                                </div>
                            </div>

                            <!-- الهاتف -->
                            <div
                                class="flex items-start space-x-3 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                                <div
                                    class="w-10 h-10 bg-charity-600/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-phone text-charity-500"></i>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-sm mb-1">
                                        {{ app()->getLocale() === 'ar' ? 'الهاتف:' : 'Phone:' }}</p>
                                    <a href="tel:{{ $settings->phone }}"
                                        class="text-gray-300 hover:text-charity-400 transition-colors duration-200">{{ $settings->phone }}</a>
                                </div>
                            </div>

                            <!-- البريد الإلكتروني -->
                            <div
                                class="flex items-start space-x-3 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                                <div
                                    class="w-10 h-10 bg-charity-600/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-envelope text-charity-500"></i>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-sm mb-1">
                                        {{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني:' : 'Email:' }}</p>
                                    <a href="mailto:{{ $settings->email }}"
                                        class="text-gray-300 hover:text-charity-400 transition-colors duration-200">{{ $settings->email }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- شريط حقوق الطبع -->
        <div class="border-t border-gray-700 py-8">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="flex items-center mb-4 md:mb-0">
                        <i
                            class="fas fa-copyright text-charity-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        <p class="text-gray-400">
                            {{ $settings->copyright ?? '2024 إيطا. جميع الحقوق محفوظة.' }}
                        </p>
                    </div>

                    <!-- روابط إضافية -->
                    <div
                        class="flex items-center space-x-6 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                        @php
                            $footerPages = \App\Models\Page::where('is_active', true)
                                ->orderBy('sort_order')
                                ->take(3)
                                ->get();
                        @endphp
                        @foreach ($footerPages as $page)
                            <a href="{{ route('pages.show', $page->slug) }}"
                                class="text-gray-400 hover:text-charity-400 text-sm transition-colors duration-200">
                                {{ $page->title }}
                            </a>
                        @endforeach
                        <div
                            class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                            <i class="fas fa-heart text-red-500 animate-pulse"></i>
                            <span
                                class="text-gray-400 text-sm">{{ app()->getLocale() === 'ar' ? 'صُنع بحب' : 'Made with Love' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- زر العودة للأعلى -->
<button id="back-to-top"
    class="fixed bottom-28 {{ app()->getLocale() === 'ar' ? 'left-6' : 'right-6' }} w-16 h-16 bg-gray-700 hover:bg-gray-600 text-white rounded-full shadow-2xl opacity-0 invisible transition-all duration-300 transform translate-y-4 z-40">
    <i class="fas fa-chevron-up"></i>
</button>

<script>
    // النشرة الإخبارية
    function subscribeNewsletter(event) {
        event.preventDefault();
        const email = event.target.querySelector('input[type="email"]').value;

        // هنا يمكنك إضافة منطق الاشتراك
        showToast(
            '{{ app()->getLocale() === 'ar' ? 'شكراً لك! تم الاشتراك بنجاح في النشرة الإخبارية' : 'Thank you! Successfully subscribed to newsletter' }}',
            'success'
        );
        event.target.reset();
    }

    // زر العودة للأعلى
    window.addEventListener('scroll', () => {
        const backToTopButton = document.getElementById('back-to-top');

        if (window.scrollY > 300) {
            backToTopButton.classList.remove('opacity-0', 'invisible', 'translate-y-4');
            backToTopButton.classList.add('opacity-100', 'visible', 'translate-y-0');
        } else {
            backToTopButton.classList.add('opacity-0', 'invisible', 'translate-y-4');
            backToTopButton.classList.remove('opacity-100', 'visible', 'translate-y-0');
        }
    });

    document.getElementById('back-to-top').addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>
