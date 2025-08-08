@extends('frontend.layouts.app')

@section('title', app()->getLocale() === 'ar' ? 'اتصل بنا - إيطا' : 'Contact Us - Eata')
@section('description', app()->getLocale() === 'ar' ? 'تواصل معنا لأي استفسار أو مساعدة - منصة إيطا للتبرعات الخيرية' : 'Contact us for any inquiry or help - Eata Charity Platform')

@section('content')
    <!--==============================
        Hero Section - تصميم جديد عصري
        ==============================-->
    <section class="relative py-20 bg-gradient-to-br from-charity-500 via-charity-600 to-charity-700 overflow-hidden">
        <!-- خلفية متحركة -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 {{ app()->getLocale() === 'ar' ? 'right-10' : 'left-10' }} w-72 h-72 bg-white rounded-full mix-blend-multiply filter blur-xl animate-pulse"></div>
            <div class="absolute bottom-10 {{ app()->getLocale() === 'ar' ? 'left-10' : 'right-10' }} w-48 h-48 bg-warm-300 rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-200"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center" data-aos="fade-up">
                <span class="inline-block px-6 py-2 text-sm font-medium text-white bg-white/20 backdrop-blur-sm rounded-full mb-6">
                    {{ app()->getLocale() === 'ar' ? '📞 اتصل بنا' : '📞 Contact Us' }}
                </span>
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight font-{{ app()->getLocale() === 'ar' ? 'arabic' : 'english' }}">
                    {{ app()->getLocale() === 'ar' ? 'نحن هنا' : 'We Are Here' }}
                    <span class="block bg-gradient-to-r from-warm-300 to-warm-400 bg-clip-text text-transparent">
                        {{ app()->getLocale() === 'ar' ? 'للمساعدة' : 'To Help' }}
                    </span>
                </h1>
                <p class="text-xl text-white/90 max-w-3xl mx-auto leading-relaxed">
                    {{ app()->getLocale() === 'ar' ? 'تواصل معنا لأي استفسار أو مساعدة. فريقنا متاح دائماً للإجابة على أسئلتك وتقديم الدعم اللازم.' : 'Contact us for any inquiry or help. Our team is always available to answer your questions and provide the necessary support.' }}
                </p>
            </div>
        </div>
    </section>

    <!--==============================
        معلومات الاتصال
        ==============================-->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- معلومات الاتصال -->
                <div class="lg:col-span-1 space-y-6" data-aos="fade-up">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8 font-{{ app()->getLocale() === 'ar' ? 'arabic' : 'english' }}">
                        {{ app()->getLocale() === 'ar' ? 'معلومات الاتصال' : 'Contact Information' }}
                    </h2>

                    <!-- العنوان -->
                    <div class="bg-white rounded-3xl p-6 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 group">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-br from-charity-400 to-charity-600 rounded-2xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-map-marker-alt text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    {{ app()->getLocale() === 'ar' ? 'العنوان' : 'Address' }}
                                </h3>
                                <p class="text-gray-600 leading-relaxed">
                                    15 Maniel Lane, Front Line Berlin, Germany
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- الهاتف -->
                    <div class="bg-white rounded-3xl p-6 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 group">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-phone text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    {{ app()->getLocale() === 'ar' ? 'رقم الهاتف' : 'Phone Number' }}
                                </h3>
                                <p class="text-gray-600 mb-1">
                                    <a href="tel:+58125253158" class="hover:text-charity-600 transition-colors duration-300">(+58-125) 25-3158</a>
                                </p>
                                <p class="text-gray-600">
                                    <a href="tel:+1635244521" class="hover:text-charity-600 transition-colors duration-300">+163-524-4521</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- البريد الإلكتروني -->
                    <div class="bg-white rounded-3xl p-6 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 group">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-envelope text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    {{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني' : 'Email' }}
                                </h3>
                                <p class="text-gray-600 mb-1">
                                    <a href="mailto:info@donet.com" class="hover:text-charity-600 transition-colors duration-300">info@donet.com</a>
                                </p>
                                <p class="text-gray-600">
                                    <a href="mailto:allinfo@donet.com" class="hover:text-charity-600 transition-colors duration-300">allinfo@donet.com</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- الأسئلة -->
                    <div class="bg-white rounded-3xl p-6 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 group">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-question-circle text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    {{ app()->getLocale() === 'ar' ? 'هل لديك سؤال؟' : 'Have a Question?' }}
                                </h3>
                                <p class="text-gray-600 leading-relaxed">
                                    {{ app()->getLocale() === 'ar' ? 'أرسل لنا كل استفساراتك وسوف يتم التواصل معك في أقرب وقت' : 'Send us all your inquiries and we will contact you as soon as possible' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- الخريطة -->
                <div class="lg:col-span-2" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                        <div class="h-96 md:h-[500px]">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3644.7310056272386!2d89.2286059153658!3d24.00527418490799!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fe9b97badc6151%3A0x30b048c9fb2129bc!2sAngfuztheme!5e0!3m2!1sen!2sbd!4v1651028958211!5m2!1sen!2sbd"
                                class="w-full h-full"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--==============================
        نموذج الاتصال
        ==============================-->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- عنوان القسم -->
                <div class="text-center mb-16" data-aos="fade-up">
                    <span class="inline-block px-6 py-2 text-sm font-medium text-charity-600 bg-charity-100 rounded-full mb-4">
                        {{ app()->getLocale() === 'ar' ? '💬 أرسل رسالة' : '💬 Send Message' }}
                    </span>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 font-{{ app()->getLocale() === 'ar' ? 'arabic' : 'english' }}">
                        {{ app()->getLocale() === 'ar' ? 'تواصل معنا' : 'Get In Touch' }}
                    </h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                        {{ app()->getLocale() === 'ar' ? 'أرسل لنا رسالتك وسنرد عليك في أقرب وقت ممكن' : 'Send us your message and we will respond to you as soon as possible' }}
                    </p>
                </div>

                <!-- النموذج -->
                <div class="bg-white rounded-3xl shadow-xl p-8 md:p-12 border border-gray-100" data-aos="fade-up" data-aos-delay="200">
                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- الاسم -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ app()->getLocale() === 'ar' ? 'الاسم الكامل' : 'Full Name' }}
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300"
                                   placeholder="{{ app()->getLocale() === 'ar' ? 'اكتب اسمك الكامل' : 'Enter your full name' }}">
                        </div>

                        <!-- البريد الإلكتروني -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني' : 'Email Address' }}
                            </label>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300"
                                   placeholder="{{ app()->getLocale() === 'ar' ? 'بريدك الإلكتروني' : 'Your email address' }}">
                        </div>

                        <!-- رقم الهاتف -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ app()->getLocale() === 'ar' ? 'رقم الهاتف' : 'Phone Number' }}
                            </label>
                            <input type="text" 
                                   name="phone" 
                                   id="phone" 
                                   required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300"
                                   placeholder="{{ app()->getLocale() === 'ar' ? 'رقم هاتفك' : 'Your phone number' }}">
                        </div>

                        <!-- الرسالة -->
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ app()->getLocale() === 'ar' ? 'الرسالة' : 'Message' }}
                            </label>
                            <textarea name="message" 
                                      id="message" 
                                      rows="6" 
                                      required 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300 resize-none"
                                      placeholder="{{ app()->getLocale() === 'ar' ? 'اكتب رسالتك هنا...' : 'Write your message here...' }}"></textarea>
                        </div>

                        <!-- زر الإرسال -->
                        <div class="text-center">
                            <button type="submit" 
                                    class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-charity-500 to-charity-600 hover:from-charity-600 hover:to-charity-700 rounded-full transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                                <i class="fas fa-paper-plane {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></i>
                                {{ app()->getLocale() === 'ar' ? 'إرسال الرسالة' : 'Send Message' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    // تأثيرات إضافية للنموذج
    document.addEventListener('DOMContentLoaded', function() {
        // تأثير التركيز على الحقول
        const inputs = document.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-charity-500');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-charity-500');
            });
        });

        // تأثير التحميل عند الإرسال
        const form = document.querySelector('form');
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = `
                <i class="fas fa-spinner fa-spin ${app().getLocale() === 'ar' ? 'ml-3' : 'mr-3'}"></i>
                ${app().getLocale() === 'ar' ? 'جاري الإرسال...' : 'Sending...'}
            `;
            submitBtn.disabled = true;
        });
    });
</script>
@endsection
