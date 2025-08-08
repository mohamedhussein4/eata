@extends('frontend.layouts.app')

@section('title', app()->getLocale() === 'ar' ? 'إيطا - معاً نصنع الفرق' : 'Eata - Together We Make a Difference')
@section('description', app()->getLocale() === 'ar' ? 'منصة إيطا للتبرعات الخيرية - ابني مستقبلاً مليء بالأمل مع أكثر من
    15 ألف متطوع و1000 مشروع مكتمل' : 'Eata Charity Platform - Build a future full of hope with over 15k volunteers and 1000
    completed projects')

@section('content')
    <!--==============================
        Hero Section - تصميم جديد عصري
        ==============================-->
    <section
        class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-charity-500 via-charity-600 to-charity-700"
        id="hero">
        <!-- خلفية متحركة -->
        <div class="absolute inset-0 opacity-10">
            <div
                class="absolute top-10 {{ app()->getLocale() === 'ar' ? 'right-10' : 'left-10' }} w-72 h-72 bg-white rounded-full mix-blend-multiply filter blur-xl animate-pulse">
            </div>
            <div
                class="absolute top-0 {{ app()->getLocale() === 'ar' ? 'left-4' : 'right-4' }} w-72 h-72 bg-warm-300 rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-200">
            </div>
            <div
                class="absolute -bottom-8 {{ app()->getLocale() === 'ar' ? 'right-20' : 'left-20' }} w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-400">
            </div>
        </div>

        <!-- أشكال هندسية متحركة -->
        <div class="absolute inset-0 overflow-hidden"></div>
            <div
                class="absolute top-1/4 {{ app()->getLocale() === 'ar' ? 'left-10' : 'right-10' }} w-20 h-20 bg-white/10 rounded-lg rotate-45 animate-bounce">
            </div>
            <div
                class="absolute bottom-1/4 {{ app()->getLocale() === 'ar' ? 'right-10' : 'left-10' }} w-16 h-16 bg-white/10 rounded-full animate-ping">
            </div>
            <div
                class="absolute top-1/2 {{ app()->getLocale() === 'ar' ? 'left-1/4' : 'right-1/4' }} w-8 h-8 bg-white/20 rounded-full animate-pulse">
            </div>
        </div>

        <div class="relative z-10 text-center px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto" data-aos="fade-up">
            <!-- النص الرئيسي -->
            <div class="mb-8">
                <span
                    class="inline-block px-6 py-3 text-sm font-medium text-white bg-white/20 backdrop-blur-sm rounded-full mb-6 animate-pulse"
                    data-aos="fade-down">
                    {{ app()->getLocale() === 'ar' ? '🤝 معاً نصنع الفرق' : '🤝 Together We Make a Difference' }}
                </span>

                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight font-{{ app()->getLocale() === 'ar' ? 'arabic' : 'english' }}"
                    data-aos="fade-up" data-aos-delay="200">
                    <span class="block">
                        {{ app()->getLocale() === 'ar' ? 'ابني مستقبلاً' : 'Build a Future' }}
                    </span>
                    <span class="block bg-gradient-to-r from-warm-300 to-warm-400 bg-clip-text text-transparent">
                        {{ app()->getLocale() === 'ar' ? 'مليء بالأمل' : 'Full of Hope' }}
                    </span>
                </h1>

                <p class="text-xl md:text-2xl text-white/90 mb-8 max-w-4xl mx-auto leading-relaxed" data-aos="fade-up"
                    data-aos-delay="400">
                    {{ app()->getLocale() === 'ar' ? 'انضم إلينا في رحلة تغيير حياة الآلاف من المحتاجين حول العالم. كل تبرع، مهما كان صغيراً، يصنع فرقاً كبيراً في حياة الناس.' : 'Join us on a journey to change the lives of thousands of people in need around the world. Every donation, no matter how small, makes a big difference in people\'s lives.' }}
                </p>
            </div>

            <!-- أزرار العمل -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12" data-aos="fade-up"
                data-aos-delay="600">
                <a href="{{ route('donations.index') }}"
                    class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-charity-600 bg-white rounded-full hover:bg-gray-50 transform hover:scale-105 transition-all duration-300 shadow-2xl hover:shadow-3xl">
                    <span class="relative z-10">
                        {{ app()->getLocale() === 'ar' ? 'ابدأ التبرع الآن' : 'Start Donating Now' }}
                    </span>
                    <i
                        class="fas fa-heart {{ app()->getLocale() === 'ar' ? 'mr-2' : 'ml-2' }} text-red-500 group-hover:animate-pulse"></i>
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-charity-500 to-charity-600 opacity-0 group-hover:opacity-10 rounded-full transition-opacity duration-300">
                    </div>
                </a>

                <button onclick="playVideo()"
                    class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-white/20 backdrop-blur-sm rounded-full hover:bg-white/30 transform hover:scale-105 transition-all duration-300 border-2 border-white/30 hover:border-white/50">
                    <i
                        class="fas fa-play {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} group-hover:animate-pulse"></i>
                    {{ app()->getLocale() === 'ar' ? 'شاهد قصص النجاح' : 'Watch Success Stories' }}
                </button>
            </div>

            <!-- إحصائيات سريعة -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto counter-section" data-aos="fade-up"
                data-aos-delay="800">
                <div class="text-center group">
                    <div class="text-3xl md:text-4xl font-bold text-white mb-2 group-hover:scale-110 transition-transform duration-300 counter"
                        data-target="15000">
                        15K+
                    </div>
                    <div class="text-white/80 text-sm md:text-base">
                        {{ app()->getLocale() === 'ar' ? 'متطوع نشط' : 'Active Volunteers' }}
                    </div>
                </div>

                <div class="text-center group">
                    <div class="text-3xl md:text-4xl font-bold text-white mb-2 group-hover:scale-110 transition-transform duration-300 counter"
                        data-target="1000">
                        1K+
                    </div>
                    <div class="text-white/80 text-sm md:text-base">
                        {{ app()->getLocale() === 'ar' ? 'مشروع مكتمل' : 'Completed Projects' }}
                    </div>
                </div>

                <div class="text-center group">
                    <div class="text-3xl md:text-4xl font-bold text-white mb-2 group-hover:scale-110 transition-transform duration-300 counter"
                        data-target="50000">
                        50K+
                    </div>
                    <div class="text-white/80 text-sm md:text-base">
                        {{ app()->getLocale() === 'ar' ? 'مستفيد' : 'Beneficiaries' }}
                    </div>
                </div>

                <div class="text-center group">
                    <div class="text-3xl md:text-4xl font-bold text-white mb-2 group-hover:scale-110 transition-transform duration-300 counter"
                        data-target="25">
                        25+
                    </div>
                    <div class="text-white/80 text-sm md:text-base">
                        {{ app()->getLocale() === 'ar' ? 'دولة' : 'Countries' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- مؤشر التمرير -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce" data-aos="fade-up"
            data-aos-delay="1000">
            <i class="fas fa-chevron-down text-white text-2xl opacity-70"></i>
        </div>
        </section>

    <!--==============================
    خدماتنا - تصميم جديد عصري
    ==============================-->
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
        <!-- خلفية متحركة -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-20 {{ app()->getLocale() === 'ar' ? 'left-10' : 'right-10' }} w-64 h-64 bg-charity-500 rounded-full filter blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 {{ app()->getLocale() === 'ar' ? 'right-10' : 'left-10' }} w-48 h-48 bg-charity-600 rounded-full filter blur-3xl animate-pulse animation-delay-200"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- عنوان القسم -->
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="inline-block px-6 py-2 text-sm font-medium text-charity-600 bg-charity-100 rounded-full mb-4">
                    {{ app()->getLocale() === 'ar' ? '🎯 خدماتنا الخيرية' : '🎯 Our Charity Services' }}
                </span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 font-{{ app()->getLocale() === 'ar' ? 'arabic' : 'english' }}">
                    {{ app()->getLocale() === 'ar' ? 'نحن نخدم الإنسانية' : 'We Serve Humanity' }}
                    <span class="block text-charity-600">
                        {{ app()->getLocale() === 'ar' ? 'بكل حب وإخلاص' : 'With Love and Dedication' }}
                    </span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    {{ app()->getLocale() === 'ar' ? 'نقدم مجموعة شاملة من الخدمات الإنسانية لمساعدة المحتاجين في جميع أنحاء العالم' : 'We provide a comprehensive range of humanitarian services to help those in need around the world' }}
                </p>
            </div>

            <!-- بطاقات الخدمات -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- خدمة الطعام -->
                <div class="group bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500 border border-gray-100 hover:border-charity-300" data-aos="fade-up">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-utensils text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-charity-600 transition-colors duration-300">
                        {{ app()->getLocale() === 'ar' ? 'الأطعمة الصحية' : 'Healthy Food' }}
                    </h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        {{ app()->getLocale() === 'ar' ? 'نوفر وجبات صحية ومغذية للأسر المحتاجة والأطفال في المناطق الفقيرة لضمان حصولهم على التغذية السليمة.' : 'We provide healthy and nutritious meals to needy families and children in poor areas to ensure they receive proper nutrition.' }}
                    </p>
                    <a href="{{ route('food-donations.index') }}" class="inline-flex items-center text-charity-600 font-semibold hover:text-charity-700 transition-colors duration-300">
                        {{ app()->getLocale() === 'ar' ? 'اعرف المزيد' : 'Learn More' }}
                        <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} {{ app()->getLocale() === 'ar' ? 'mr-2' : 'ml-2' }} group-hover:translate-x-1 transition-transform duration-300"></i>
                    </a>
                </div>

                <!-- خدمة التعليم -->
                <div class="group bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500 border border-gray-100 hover:border-blue-300" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-graduation-cap text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors duration-300">
                        {{ app()->getLocale() === 'ar' ? 'التعليم' : 'Education' }}
                    </h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        {{ app()->getLocale() === 'ar' ? 'نساعد في توفير فرص تعليمية للأطفال والشباب المحرومين من خلال بناء المدارس وتوفير المواد التعليمية.' : 'We help provide educational opportunities for disadvantaged children and youth by building schools and providing educational materials.' }}
                    </p>
                    <a href="{{ route('projects.index') }}" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-700 transition-colors duration-300">
                        {{ app()->getLocale() === 'ar' ? 'اعرف المزيد' : 'Learn More' }}
                        <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} {{ app()->getLocale() === 'ar' ? 'mr-2' : 'ml-2' }} group-hover:translate-x-1 transition-transform duration-300"></i>
                    </a>
                </div>

                <!-- خدمة الصحة -->
                <div class="group bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500 border border-gray-100 hover:border-red-300" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-400 to-red-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-heartbeat text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-red-600 transition-colors duration-300">
                        {{ app()->getLocale() === 'ar' ? 'المساعدة الطبية' : 'Medical Assistance' }}
                    </h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        {{ app()->getLocale() === 'ar' ? 'نقدم الرعاية الصحية والأدوية للمرضى المحتاجين ونساعد في بناء المستشفيات والعيادات الطبية.' : 'We provide healthcare and medicines to patients in need and help build hospitals and medical clinics.' }}
                    </p>
                    <a href="{{ route('donations.index') }}" class="inline-flex items-center text-red-600 font-semibold hover:text-red-700 transition-colors duration-300">
                        {{ app()->getLocale() === 'ar' ? 'اعرف المزيد' : 'Learn More' }}
                        <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} {{ app()->getLocale() === 'ar' ? 'mr-2' : 'ml-2' }} group-hover:translate-x-1 transition-transform duration-300"></i>
                    </a>
                </div>
            </div>

            <!-- إحصائيات الخدمات -->
            <div class="mt-20 bg-gradient-to-r from-charity-500 to-charity-600 rounded-3xl p-8 md:p-12 text-white counter-section" data-aos="fade-up" data-aos-delay="600">
                <div class="text-center mb-8">
                    <h3 class="text-3xl font-bold mb-4">
                        {{ app()->getLocale() === 'ar' ? 'إنجازاتنا في أرقام' : 'Our Achievements in Numbers' }}
                    </h3>
                    <p class="text-white/90 text-lg">
                        {{ app()->getLocale() === 'ar' ? 'نفتخر بما حققناه معاً في خدمة الإنسانية' : 'We are proud of what we have achieved together in serving humanity' }}
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="text-4xl font-bold mb-2 counter" data-target="250000">250K+</div>
                        <div class="text-white/80">{{ app()->getLocale() === 'ar' ? 'وجبة قدمت' : 'Meals Served' }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold mb-2 counter" data-target="15000">15K+</div>
                        <div class="text-white/80">{{ app()->getLocale() === 'ar' ? 'طفل تعلم' : 'Children Educated' }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold mb-2 counter" data-target="5000">5K+</div>
                        <div class="text-white/80">{{ app()->getLocale() === 'ar' ? 'مريض عولج' : 'Patients Treated' }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold mb-2 counter" data-target="100">100+</div>
                        <div class="text-white/80">{{ app()->getLocale() === 'ar' ? 'مشروع مكتمل' : 'Projects Completed' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--==============================
    المشاريع المميزة
    ==============================-->
    <section class="py-20 bg-white relative overflow-hidden">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- عنوان القسم -->
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="inline-block px-6 py-2 text-sm font-medium text-charity-600 bg-charity-100 rounded-full mb-4">
                    {{ app()->getLocale() === 'ar' ? '💝 مشاريعنا المميزة' : '💝 Our Featured Projects' }}
                </span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 font-{{ app()->getLocale() === 'ar' ? 'arabic' : 'english' }}">
                    {{ app()->getLocale() === 'ar' ? 'شاهد تأثيرك' : 'See Your Impact' }}
                    <span class="block text-charity-600">
                        {{ app()->getLocale() === 'ar' ? 'في حياة الآخرين' : 'In Others\' Lives' }}
                    </span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    {{ app()->getLocale() === 'ar' ? 'تصفح مشاريعنا النشطة واختر المشروع الذي تريد دعمه لتكون جزءاً من التغيير الإيجابي' : 'Browse our active projects and choose the project you want to support to be part of positive change' }}
                </p>
            </div>

            <!-- شبكة المشاريع -->
            @if(isset($featuredProjects) && $featuredProjects->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($featuredProjects->take(6) as $index => $project)
                <div class="group bg-white rounded-3xl shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500 border border-gray-100 overflow-hidden" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <!-- صورة المشروع -->
                    <div class="relative h-48 overflow-hidden">
                        @if($project->image_or_video)
                        <img src="{{ asset('storage/' . $project->image_or_video) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                        <div class="w-full h-full bg-gradient-to-br from-charity-400 to-charity-600 flex items-center justify-center">
                            <i class="fas fa-heart text-white text-4xl"></i>
                        </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        <div class="absolute top-4 right-4">
                            <span class="bg-white/90 backdrop-blur-sm text-charity-600 px-3 py-1 rounded-full text-sm font-semibold">
                                {{ number_format(($project->total_amount - $project->remaining_amount) / $project->total_amount * 100, 0) }}%
                            </span>
                        </div>
                    </div>

                    <!-- محتوى المشروع -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-charity-600 transition-colors duration-300">
                            {{ Str::limit($project->translated_title, 50) }}
                        </h3>
                        <p class="text-gray-600 mb-4 leading-relaxed">
                            {{ Str::limit($project->translated_description, 100) }}
                        </p>

                        <!-- شريط التقدم -->
                        <div class="mb-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-gray-700">
                                    {{ app()->getLocale() === 'ar' ? 'المبلغ المجمع' : 'Raised Amount' }}
                                </span>
                                <span class="text-sm font-medium text-charity-600">
                                    {{ number_format($project->total_amount - $project->remaining_amount) }} {{ app()->getLocale() === 'ar' ? 'ل.س' : 'SYP' }}
                                </span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                                <div class="bg-gradient-to-r from-charity-500 to-charity-600 h-2 rounded-full transition-all duration-500" style="width: {{ min(($project->total_amount - $project->remaining_amount) / $project->total_amount * 100, 100) }}%"></div>
                            </div>
                            <div class="flex justify-between text-xs text-gray-500">
                                <span>{{ app()->getLocale() === 'ar' ? 'الهدف:' : 'Goal:' }} {{ number_format($project->total_amount) }} {{ app()->getLocale() === 'ar' ? 'ل.س' : 'SYP' }}</span>
                                <span>{{ $project->beneficiaries_count ?? 0 }} {{ app()->getLocale() === 'ar' ? 'مستفيد' : 'beneficiaries' }}</span>
                            </div>
                        </div>

                        <!-- زر التبرع -->
                        <a href="{{ route('projects.show', $project->id) }}" class="w-full bg-gradient-to-r from-charity-500 to-charity-600 hover:from-charity-600 hover:to-charity-700 text-white font-semibold py-3 px-6 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center group">
                            <i class="fas fa-heart {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} group-hover:animate-pulse"></i>
                            {{ app()->getLocale() === 'ar' ? 'تبرع الآن' : 'Donate Now' }}
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            <!-- زر عرض المزيد -->
            <div class="text-center" data-aos="fade-up">
                <a href="{{ route('projects.index') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-charity-500 to-charity-600 hover:from-charity-600 hover:to-charity-700 rounded-full transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                    {{ app()->getLocale() === 'ar' ? 'عرض جميع المشاريع' : 'View All Projects' }}
                    <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} {{ app()->getLocale() === 'ar' ? 'mr-3' : 'ml-3' }}"></i>
                </a>
            </div>
        </div>
    </section>

    <!--==============================
    دعوة للعمل
    ==============================-->
    <section class="py-20 bg-gradient-to-r from-charity-600 via-charity-700 to-charity-800 relative overflow-hidden">
        <!-- خلفية متحركة -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-64 h-64 bg-white rounded-full filter blur-3xl animate-float"></div>
            <div class="absolute bottom-10 right-10 w-48 h-48 bg-warm-300 rounded-full filter blur-3xl animate-float animation-delay-200"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-4xl mx-auto" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 font-{{ app()->getLocale() === 'ar' ? 'arabic' : 'english' }}">
                    {{ app()->getLocale() === 'ar' ? 'كن جزءاً من التغيير' : 'Be Part of the Change' }}
                </h2>
                <p class="text-xl md:text-2xl text-white/90 mb-8 leading-relaxed">
                    {{ app()->getLocale() === 'ar' ? 'بابنا مفتوح دائماً لمزيد من الأشخاص الذين يرغبون في دعم بعضهم البعض ومساعدة المحتاجين حول العالم' : 'Our door is always open for more people who want to support each other and help those in need around the world' }}
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('contact.index') }}" class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-charity-600 bg-white rounded-full hover:bg-gray-50 transform hover:scale-105 transition-all duration-300 shadow-2xl hover:shadow-3xl">
                        <i class="fas fa-envelope {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} group-hover:animate-pulse"></i>
                        {{ app()->getLocale() === 'ar' ? 'تواصل معنا' : 'Contact Us' }}
                    </a>

                    <a href="{{ route('volunteers.index') }}" class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-white/20 backdrop-blur-sm rounded-full hover:bg-white/30 transform hover:scale-105 transition-all duration-300 border-2 border-white/30 hover:border-white/50">
                        <i class="fas fa-hands-helping {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} group-hover:animate-pulse"></i>
                        {{ app()->getLocale() === 'ar' ? 'انضم كمتطوع' : 'Join as Volunteer' }}
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
<script>
    // Function to play video
    function playVideo() {
        // Add video modal or redirect to video
        showToast('{{ app()->getLocale() === "ar" ? "قريباً سيتم إضافة الفيديو" : "Video will be added soon" }}', 'info');
    }

    // Swiper initialization for projects (if needed)
    document.addEventListener('DOMContentLoaded', function() {
        // Add any additional JavaScript here
    });
</script>
@endsection
