@extends('frontend.layouts.app')

@section('title', app()->getLocale() === 'ar' ? 'التبرع عبر الرسائل النصية' : 'SMS Donations')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-blue-500 via-indigo-600 to-purple-700 text-white py-[25vh] overflow-hidden">
    <!-- خلفية متحركة -->
    <div class="absolute inset-0">
        <div class="absolute top-10 right-10 w-32 h-32 bg-white/10 rounded-full animate-bounce"></div>
        <div class="absolute bottom-10 left-10 w-24 h-24 bg-white/5 rounded-full animate-pulse animation-delay-1000"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>

        <!-- رموز الرسائل المتحركة -->
        <div class="absolute top-20 left-1/4 text-white/10 text-4xl animate-pulse">💬</div>
        <div class="absolute bottom-20 right-1/4 text-white/10 text-3xl animate-bounce">📱</div>
        <div class="absolute top-1/3 right-1/5 text-white/10 text-2xl animate-spin">✉️</div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-4xl mx-auto text-center" data-aos="fade-up">
            <div class="mb-6">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white/10 rounded-full mb-6">
                    <i class="fas fa-sms text-3xl"></i>
                </div>
            </div>
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                {{ app()->getLocale() === 'ar' ? 'التبرع عبر الرسائل النصية' : 'SMS Donations' }}
            </h1>
            <p class="text-xl md:text-2xl text-white/90 mb-8 leading-relaxed">
                {{ app()->getLocale() === 'ar' ? 'طريقة سهلة وسريعة للتبرع من هاتفك المحمول في ثوانٍ معدودة' : 'An easy and fast way to donate from your mobile phone in seconds' }}
            </p>

            <!-- مميزات التبرع عبر SMS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6" data-aos="fade-up" data-aos-delay="100">
                    <i class="fas fa-clock text-2xl mb-4"></i>
                    <h3 class="text-lg font-semibold mb-2">{{ app()->getLocale() === 'ar' ? 'سريع ومباشر' : 'Fast & Direct' }}</h3>
                    <p class="text-sm text-white/80">{{ app()->getLocale() === 'ar' ? 'تبرع في ثوانٍ من هاتفك' : 'Donate in seconds from your phone' }}</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6" data-aos="fade-up" data-aos-delay="200">
                    <i class="fas fa-mobile-alt text-2xl mb-4"></i>
                    <h3 class="text-lg font-semibold mb-2">{{ app()->getLocale() === 'ar' ? 'متاح دائماً' : 'Always Available' }}</h3>
                    <p class="text-sm text-white/80">{{ app()->getLocale() === 'ar' ? 'لا يحتاج إنترنت أو تطبيقات' : 'No internet or apps required' }}</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6" data-aos="fade-up" data-aos-delay="300">
                    <i class="fas fa-shield-alt text-2xl mb-4"></i>
                    <h3 class="text-lg font-semibold mb-2">{{ app()->getLocale() === 'ar' ? 'آمن ومضمون' : 'Safe & Secure' }}</h3>
                    <p class="text-sm text-white/80">{{ app()->getLocale() === 'ar' ? 'حماية كاملة لبياناتك' : 'Complete protection of your data' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- كيفية التبرع -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center justify-center px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold mb-4">
                {{ app()->getLocale() === 'ar' ? '⚡ سهل وسريع' : '⚡ Easy & Fast' }}
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                {{ app()->getLocale() === 'ar' ? 'كيف يمكنني التبرع؟' : 'How Can I Donate?' }}
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                {{ app()->getLocale() === 'ar' ? 'يمكنك المساهمة في مساعدة المحتاجين بخطوات بسيطة من خلال هاتفك المحمول' : 'You can contribute to helping those in need with simple steps through your mobile phone' }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto mb-16">
            <!-- الخطوة 1 -->
            <div class="text-center group" data-aos="fade-up" data-aos-delay="100">
                <div class="relative mb-6">
                    <div class="w-24 h-24 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto shadow-xl group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                        <i class="fas fa-mobile-alt text-2xl text-white"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold text-sm">1</div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'ar' ? 'اختر مبلغ التبرع' : 'Choose Donation Amount' }}
                </h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ app()->getLocale() === 'ar' ? 'حدد المبلغ الذي ترغب بالتبرع به من القائمة أدناه' : 'Select the amount you want to donate from the list below' }}
                </p>
            </div>

            <!-- الخطوة 2 -->
            <div class="text-center group" data-aos="fade-up" data-aos-delay="200">
                <div class="relative mb-6">
                    <div class="w-24 h-24 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center mx-auto shadow-xl group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                        <i class="fas fa-sms text-2xl text-white"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-indigo-500 text-white rounded-full flex items-center justify-center font-bold text-sm">2</div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'ar' ? 'أرسل الرسالة' : 'Send Message' }}
                </h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ app()->getLocale() === 'ar' ? 'أرسل كلمة "تبرع" إلى رقم الرسالة المخصص' : 'Send the word "donate" to the designated message number' }}
                </p>
            </div>

            <!-- الخطوة 3 -->
            <div class="text-center group" data-aos="fade-up" data-aos-delay="300">
                <div class="relative mb-6">
                    <div class="w-24 h-24 bg-gradient-to-r from-purple-500 to-pink-600 rounded-full flex items-center justify-center mx-auto shadow-xl group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                        <i class="fas fa-check-circle text-2xl text-white"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-purple-500 text-white rounded-full flex items-center justify-center font-bold text-sm">3</div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'ar' ? 'تأكيد التبرع' : 'Confirm Donation' }}
                </h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ app()->getLocale() === 'ar' ? 'ستصلك رسالة تأكيد فورية بنجاح التبرع' : 'You will receive an instant confirmation message of successful donation' }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- مبالغ التبرع -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                {{ app()->getLocale() === 'ar' ? 'اختر مبلغ التبرع' : 'Choose Donation Amount' }}
            </h2>
            <p class="text-xl text-gray-600">
                {{ app()->getLocale() === 'ar' ? 'اختر المبلغ المناسب لك وأرسل الرسالة' : 'Choose the amount that suits you and send the message' }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- مبلغ 10 ريال -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-3xl p-8 border-2 border-blue-200 hover:border-blue-400 transition-all duration-300 transform hover:scale-105 hover:shadow-xl" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-white">10</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">10 {{ app()->getLocale() === 'ar' ? 'ريال' : 'SAR' }}</h3>
                    <p class="text-gray-600 mb-6">{{ app()->getLocale() === 'ar' ? 'وجبة واحدة لطفل' : 'One meal for a child' }}</p>

                    <div class="bg-white rounded-xl p-4 mb-6 shadow-sm">
                        <p class="text-sm text-gray-600 mb-2">{{ app()->getLocale() === 'ar' ? 'أرسل رسالة نصية:' : 'Send SMS:' }}</p>
                        <div class="flex items-center justify-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                            <span class="font-bold text-blue-600">{{ app()->getLocale() === 'ar' ? 'تبرع10' : 'DONATE10' }}</span>
                            <span class="text-gray-400">→</span>
                            <span class="font-bold text-green-600">92000</span>
                        </div>
                    </div>

                    <button onclick="sendSMS('{{ app()->getLocale() === 'ar' ? 'تبرع10' : 'DONATE10' }}', '92000')" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-sms {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        {{ app()->getLocale() === 'ar' ? 'إرسال الرسالة' : 'Send SMS' }}
                    </button>
                </div>
            </div>

            <!-- مبلغ 25 ريال -->
            <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-3xl p-8 border-2 border-purple-200 hover:border-purple-400 transition-all duration-300 transform hover:scale-105 hover:shadow-xl" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-white">25</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">25 {{ app()->getLocale() === 'ar' ? 'ريال' : 'SAR' }}</h3>
                    <p class="text-gray-600 mb-6">{{ app()->getLocale() === 'ar' ? 'وجبات لعائلة صغيرة' : 'Meals for a small family' }}</p>

                    <div class="bg-white rounded-xl p-4 mb-6 shadow-sm">
                        <p class="text-sm text-gray-600 mb-2">{{ app()->getLocale() === 'ar' ? 'أرسل رسالة نصية:' : 'Send SMS:' }}</p>
                        <div class="flex items-center justify-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                            <span class="font-bold text-purple-600">{{ app()->getLocale() === 'ar' ? 'تبرع25' : 'DONATE25' }}</span>
                            <span class="text-gray-400">→</span>
                            <span class="font-bold text-green-600">92000</span>
                        </div>
                    </div>

                    <button onclick="sendSMS('{{ app()->getLocale() === 'ar' ? 'تبرع25' : 'DONATE25' }}', '92000')" class="w-full bg-purple-500 hover:bg-purple-600 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-sms {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        {{ app()->getLocale() === 'ar' ? 'إرسال الرسالة' : 'Send SMS' }}
                    </button>
                </div>
            </div>

            <!-- مبلغ 50 ريال -->
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-3xl p-8 border-2 border-green-200 hover:border-green-400 transition-all duration-300 transform hover:scale-105 hover:shadow-xl" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-white">50</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">50 {{ app()->getLocale() === 'ar' ? 'ريال' : 'SAR' }}</h3>
                    <p class="text-gray-600 mb-6">{{ app()->getLocale() === 'ar' ? 'سلة غذائية كاملة' : 'Complete food basket' }}</p>

                    <div class="bg-white rounded-xl p-4 mb-6 shadow-sm">
                        <p class="text-sm text-gray-600 mb-2">{{ app()->getLocale() === 'ar' ? 'أرسل رسالة نصية:' : 'Send SMS:' }}</p>
                        <div class="flex items-center justify-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                            <span class="font-bold text-green-600">{{ app()->getLocale() === 'ar' ? 'تبرع50' : 'DONATE50' }}</span>
                            <span class="text-gray-400">→</span>
                            <span class="font-bold text-green-600">92000</span>
                        </div>
                    </div>

                    <button onclick="sendSMS('{{ app()->getLocale() === 'ar' ? 'تبرع50' : 'DONATE50' }}', '92000')" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-sms {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        {{ app()->getLocale() === 'ar' ? 'إرسال الرسالة' : 'Send SMS' }}
                    </button>
                </div>
            </div>
        </div>

        <!-- نموذج التسجيل -->
        <div class="max-w-2xl mx-auto mt-16" data-aos="fade-up">
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-3xl p-8 border border-blue-200">
                <h3 class="text-2xl font-bold text-center text-gray-900 mb-6">
                    {{ app()->getLocale() === 'ar' ? 'سجل رقمك للحصول على التحديثات' : 'Register Your Number for Updates' }}
                </h3>

                <form method="post" action="{{ route('sms-donations.store') }}" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="phone_number" class="block text-sm font-semibold text-gray-900">
                                {{ app()->getLocale() === 'ar' ? 'رقم الهاتف' : 'Phone Number' }}
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" id="phone_number" name="phone_number" required
                                   placeholder="{{ app()->getLocale() === 'ar' ? '+966 XX XXX XXXX' : '+966 XX XXX XXXX' }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
                        </div>

                        <div class="space-y-2">
                            <label for="donation_type" class="block text-sm font-semibold text-gray-900">
                                {{ app()->getLocale() === 'ar' ? 'مبلغ التبرع' : 'Donation Amount' }}
                                <span class="text-red-500">*</span>
                            </label>
                            <select id="donation_type" name="donation_type" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
                                <option value="">{{ app()->getLocale() === 'ar' ? 'اختر المبلغ' : 'Select Amount' }}</option>
                                <option value="10">10 {{ app()->getLocale() === 'ar' ? 'ريال' : 'SAR' }}</option>
                                <option value="25">25 {{ app()->getLocale() === 'ar' ? 'ريال' : 'SAR' }}</option>
                                <option value="50">50 {{ app()->getLocale() === 'ar' ? 'ريال' : 'SAR' }}</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-semibold text-gray-900">
                                {{ app()->getLocale() === 'ar' ? 'الاسم' : 'Name' }}
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" name="name" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
                        </div>

                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-semibold text-gray-900">
                                {{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني' : 'Email' }}
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="email" name="email" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
                        </div>

                        <div class="col-span-2 space-y-2">
                            <label for="message_text" class="block text-sm font-semibold text-gray-900">
                                {{ app()->getLocale() === 'ar' ? 'نص الرسالة' : 'Message Text' }}
                                <span class="text-red-500">*</span>
                            </label>
                            <textarea id="message_text" name="message_text" required rows="3"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300"></textarea>
                        </div>

                        <div class="col-span-2 space-y-2">
                            <label for="notes" class="block text-sm font-semibold text-gray-900">
                                {{ app()->getLocale() === 'ar' ? 'ملاحظات إضافية' : 'Additional Notes' }}
                            </label>
                            <textarea id="notes" name="notes" rows="2"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300"></textarea>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-paper-plane {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            {{ app()->getLocale() === 'ar' ? 'إرسال الطلب' : 'Submit Request' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- الأسئلة الشائعة -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                {{ app()->getLocale() === 'ar' ? 'الأسئلة الشائعة' : 'Frequently Asked Questions' }}
            </h2>
            <p class="text-xl text-gray-600">
                {{ app()->getLocale() === 'ar' ? 'إجابات على أكثر الأسئلة شيوعاً حول التبرع عبر الرسائل النصية' : 'Answers to the most common questions about SMS donations' }}
            </p>
        </div>

        <div class="max-w-4xl mx-auto space-y-6">
            <div class="bg-white rounded-2xl p-6 shadow-lg" data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-lg font-bold text-gray-900 mb-3">
                    {{ app()->getLocale() === 'ar' ? 'هل التبرع عبر الرسائل النصية آمن؟' : 'Is SMS donation safe?' }}
                </h3>
                <p class="text-gray-600">
                    {{ app()->getLocale() === 'ar' ? 'نعم، التبرع عبر الرسائل النصية آمن تماماً ومشفر بأحدث تقنيات الأمان.' : 'Yes, SMS donation is completely safe and encrypted with the latest security technologies.' }}
                </p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg" data-aos="fade-up" data-aos-delay="200">
                <h3 class="text-lg font-bold text-gray-900 mb-3">
                    {{ app()->getLocale() === 'ar' ? 'كم تستغرق عملية التبرع؟' : 'How long does the donation process take?' }}
                </h3>
                <p class="text-gray-600">
                    {{ app()->getLocale() === 'ar' ? 'عملية التبرع فورية وتستغرق أقل من دقيقة واحدة.' : 'The donation process is instant and takes less than one minute.' }}
                </p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg" data-aos="fade-up" data-aos-delay="300">
                <h3 class="text-lg font-bold text-gray-900 mb-3">
                    {{ app()->getLocale() === 'ar' ? 'هل يمكنني التبرع بمبلغ مختلف؟' : 'Can I donate a different amount?' }}
                </h3>
                <p class="text-gray-600">
                    {{ app()->getLocale() === 'ar' ? 'حالياً نقبل المبالغ المحددة فقط، لكن يمكنك إرسال أكثر من رسالة.' : 'Currently we only accept specified amounts, but you can send more than one message.' }}
                </p>
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

<script>
function sendSMS(message, number) {
    // محاولة فتح تطبيق الرسائل مع الرسالة المحددة مسبقاً
    const smsUrl = `sms:${number}?body=${encodeURIComponent(message)}`;

    // للموبايل
    if (/Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        window.location.href = smsUrl;
    } else {
        // للديسكتوب - إظهار رسالة تحتوي على التعليمات
        alert(`{{ app()->getLocale() === 'ar' ? 'أرسل رسالة نصية تحتوي على:' : 'Send SMS containing:' }}\n\n"${message}"\n\n{{ app()->getLocale() === 'ar' ? 'إلى الرقم:' : 'To number:' }} ${number}`);
    }
}

// تأثيرات إضافية
document.addEventListener('DOMContentLoaded', function() {
    // تحريك الرموز في الخلفية
    const symbols = document.querySelectorAll('.absolute');
    symbols.forEach((symbol, index) => {
        setTimeout(() => {
            symbol.style.animationDelay = `${index * 0.5}s`;
        }, 100);
    });
});
</script>
