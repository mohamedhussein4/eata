@extends('frontend.layouts.app')

@section('title', app()->getLocale() === 'ar' ? 'التطوع باللوازم' : 'Volunteer with Supplies')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-emerald-500 via-teal-600 to-cyan-600 text-white py-[25vh] overflow-hidden">
    <!-- خلفية متحركة -->
    <div class="absolute inset-0">
        <div class="absolute top-20 left-20 w-40 h-40 bg-white/10 rounded-full animate-pulse"></div>
        <div class="absolute bottom-20 right-20 w-32 h-32 bg-white/5 rounded-full animate-pulse animation-delay-1000"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-4xl mx-auto text-center" data-aos="fade-up">
            <div class="mb-6">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white/10 rounded-full mb-6">
                    <i class="fas fa-box-open text-3xl"></i>
                </div>
            </div>
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                {{ app()->getLocale() === 'ar' ? 'التطوع باللوازم' : 'Volunteer with Supplies' }}
            </h1>
            <p class="text-xl md:text-2xl text-white/90 mb-8 leading-relaxed">
                {{ app()->getLocale() === 'ar' ? 'تبرع بالطعام والملابس والأدوية لمساعدة المحتاجين في مجتمعنا' : 'Donate food, clothes, and medicine to help those in need in our community' }}
            </p>

            <!-- إحصائيات سريعة -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-3xl font-bold text-white">500+</div>
                    <div class="text-white/80">{{ app()->getLocale() === 'ar' ? 'عائلة مستفيدة' : 'Families Helped' }}</div>
                </div>
                <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-3xl font-bold text-white">1000+</div>
                    <div class="text-white/80">{{ app()->getLocale() === 'ar' ? 'وجبة موزعة' : 'Meals Distributed' }}</div>
                </div>
                <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-3xl font-bold text-white">200+</div>
                    <div class="text-white/80">{{ app()->getLocale() === 'ar' ? 'متطوع نشط' : 'Active Volunteers' }}</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- نموذج التبرع -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <!-- عنوان القسم -->
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'ar' ? 'نموذج التطوع' : 'Volunteer Form' }}
                </h2>
                <p class="text-xl text-gray-600">
                    {{ app()->getLocale() === 'ar' ? 'املأ البيانات أدناه وسنتواصل معك قريباً' : 'Fill out the form below and we\'ll contact you soon' }}
                </p>
            </div>

            <!-- تنبيه -->
            <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border-l-4 border-yellow-400 p-6 rounded-xl mb-8" data-aos="fade-up">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-yellow-600 text-xl"></i>
                    </div>
                    <div class="ml-3 {{ app()->getLocale() === 'ar' ? 'mr-3 ml-0' : '' }}">
                        <h3 class="text-sm font-semibold text-yellow-800">
                            {{ app()->getLocale() === 'ar' ? 'ملاحظة مهمة' : 'Important Note' }}
                        </h3>
                        <p class="mt-1 text-sm text-yellow-700">
                            {{ app()->getLocale() === 'ar' ? 'يتم تمكين وضع الاختبار. بينما في وضع الاختبار لا تتم معالجة التبرعات الحية.' : 'Test mode is enabled. While in test mode, no live donations are processed.' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- النموذج -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-12" data-aos="fade-up" data-aos-delay="200">
                <form method="post" action="{{ route('food-donations.store') }}" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <!-- نوع التبرع -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="donation_type" class="block text-sm font-semibold text-gray-900">
                                {{ app()->getLocale() === 'ar' ? 'نوع التبرع' : 'Donation Type' }}
                                <span class="text-red-500">*</span>
                            </label>
                            <select id="donation_type" name="donation_type" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300">
                                <option value="">{{ app()->getLocale() === 'ar' ? 'اختر النوع' : 'Select Type' }}</option>
                                <option value="food">{{ app()->getLocale() === 'ar' ? '🍎 طعام' : '🍎 Food' }}</option>
                                <option value="clothes">{{ app()->getLocale() === 'ar' ? '👕 ملابس' : '👕 Clothes' }}</option>
                                <option value="medicine">{{ app()->getLocale() === 'ar' ? '💊 أدوية' : '💊 Medicine' }}</option>
                                <option value="other">{{ app()->getLocale() === 'ar' ? '📦 أخرى' : '📦 Other' }}</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label for="is_available" class="block text-sm font-semibold text-gray-900">
                                {{ app()->getLocale() === 'ar' ? 'حالة التبرع' : 'Availability Status' }}
                                <span class="text-red-500">*</span>
                            </label>
                            <select id="is_available" name="is_available" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300">
                                <option value="">{{ app()->getLocale() === 'ar' ? 'اختر الحالة' : 'Select Status' }}</option>
                                <option value="1">{{ app()->getLocale() === 'ar' ? '✅ متوفر الآن' : '✅ Available Now' }}</option>
                                <option value="0">{{ app()->getLocale() === 'ar' ? '⏳ سيتوفر قريباً' : '⏳ Available Soon' }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- المعلومات الشخصية -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-semibold text-gray-900">
                                {{ app()->getLocale() === 'ar' ? 'الاسم الكامل' : 'Full Name' }}
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" name="name" required
                                   placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل اسمك الكامل' : 'Enter your full name' }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300">
                        </div>

                        <div class="space-y-2">
                            <label for="phone" class="block text-sm font-semibold text-gray-900">
                                {{ app()->getLocale() === 'ar' ? 'رقم الهاتف' : 'Phone Number' }}
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" id="phone" name="phone" required
                                   placeholder="{{ app()->getLocale() === 'ar' ? '+966 XX XXX XXXX' : '+966 XX XXX XXXX' }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-semibold text-gray-900">
                                {{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني' : 'Email Address' }}
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="email" name="email" required
                                   placeholder="{{ app()->getLocale() === 'ar' ? 'example@email.com' : 'example@email.com' }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300">
                        </div>

                        <div class="space-y-2">
                            <label for="address" class="block text-sm font-semibold text-gray-900">
                                {{ app()->getLocale() === 'ar' ? 'العنوان' : 'Address' }}
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="address" name="address" required
                                   placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل عنوانك الكامل' : 'Enter your full address' }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300">
                        </div>
                    </div>

                    <!-- ملاحظات إضافية -->
                    <div class="space-y-2">
                        <label for="notes" class="block text-sm font-semibold text-gray-900">
                            {{ app()->getLocale() === 'ar' ? 'ملاحظات إضافية' : 'Additional Notes' }}
                        </label>
                        <textarea id="notes" name="notes" rows="4"
                                  placeholder="{{ app()->getLocale() === 'ar' ? 'أي معلومات إضافية تود مشاركتها...' : 'Any additional information you\'d like to share...' }}"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 resize-none"></textarea>
                    </div>

                    <!-- زر الإرسال -->
                    <div class="pt-4">
                        <button type="submit" class="w-full md:w-auto inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-heart {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></i>
                            {{ app()->getLocale() === 'ar' ? 'إرسال طلب التطوع' : 'Submit Volunteer Request' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- كيفية العمل -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                {{ app()->getLocale() === 'ar' ? 'كيف يعمل التطوع؟' : 'How Does Volunteering Work?' }}
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                {{ app()->getLocale() === 'ar' ? 'عملية بسيطة وسهلة في ثلاث خطوات للمساهمة في مساعدة المحتاجين' : 'A simple and easy three-step process to contribute to helping those in need' }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- الخطوة 1 -->
            <div class="text-center group" data-aos="fade-up" data-aos-delay="100">
                <div class="relative mb-6">
                    <div class="w-24 h-24 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-full flex items-center justify-center mx-auto shadow-xl group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                        <span class="text-2xl font-bold text-white">1</span>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-yellow-400 rounded-full animate-bounce"></div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'ar' ? 'املأ النموذج' : 'Fill the Form' }}
                </h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ app()->getLocale() === 'ar' ? 'أدخل معلوماتك ونوع التبرع الذي تريد المساهمة به' : 'Enter your information and the type of donation you want to contribute' }}
                </p>
            </div>

            <!-- الخطوة 2 -->
            <div class="text-center group" data-aos="fade-up" data-aos-delay="200">
                <div class="relative mb-6">
                    <div class="w-24 h-24 bg-gradient-to-r from-teal-500 to-cyan-600 rounded-full flex items-center justify-center mx-auto shadow-xl group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                        <span class="text-2xl font-bold text-white">2</span>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-green-400 rounded-full animate-pulse"></div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'ar' ? 'نتواصل معك' : 'We Contact You' }}
                </h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ app()->getLocale() === 'ar' ? 'فريقنا سيتواصل معك خلال 24 ساعة لتنسيق عملية التبرع' : 'Our team will contact you within 24 hours to coordinate the donation process' }}
                </p>
            </div>

            <!-- الخطوة 3 -->
            <div class="text-center group" data-aos="fade-up" data-aos-delay="300">
                <div class="relative mb-6">
                    <div class="w-24 h-24 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-full flex items-center justify-center mx-auto shadow-xl group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                        <span class="text-2xl font-bold text-white">3</span>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-red-400 rounded-full animate-ping"></div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'ar' ? 'التوصيل والتوزيع' : 'Delivery & Distribution' }}
                </h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ app()->getLocale() === 'ar' ? 'نقوم بجمع التبرعات وتوزيعها على المستحقين في المجتمع' : 'We collect donations and distribute them to deserving members of the community' }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- دعوة للعمل -->
<section class="py-20 bg-gradient-to-r from-emerald-500 to-teal-600 text-white">
    <div class="container mx-auto px-6 text-center">
        <div class="max-w-4xl mx-auto" data-aos="fade-up">
            <h2 class="text-3xl md:text-5xl font-bold mb-6">
                {{ app()->getLocale() === 'ar' ? 'كن جزءاً من التغيير' : 'Be Part of the Change' }}
            </h2>
            <p class="text-xl text-white/90 mb-8 leading-relaxed">
                {{ app()->getLocale() === 'ar' ? 'انضم إلى مئات المتطوعين الذين يساهمون في صنع فرق حقيقي في حياة المحتاجين' : 'Join hundreds of volunteers who contribute to making a real difference in the lives of those in need' }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact.index') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-emerald-600 font-bold rounded-xl hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-phone {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    {{ app()->getLocale() === 'ar' ? 'اتصل بنا' : 'Contact Us' }}
                </a>
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-xl hover:bg-white hover:text-emerald-600 transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-home {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    {{ app()->getLocale() === 'ar' ? 'العودة للرئيسية' : 'Back to Home' }}
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

<style>
.animation-delay-1000 {
    animation-delay: 1000ms;
}
</style>
