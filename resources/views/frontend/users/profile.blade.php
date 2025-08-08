@extends('frontend.layouts.app')

@section('title', app()->getLocale() === 'ar' ? 'الملف الشخصي - إيطا' : 'Profile - Eata')
@section('description', app()->getLocale() === 'ar' ? 'تحديث معلوماتك الشخصية - منصة إيطا للتبرعات الخيرية' : 'Update your personal information - Eata Charity Platform')

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
                    {{ app()->getLocale() === 'ar' ? '👤 الملف الشخصي' : '👤 Profile' }}
                </span>
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight font-{{ app()->getLocale() === 'ar' ? 'arabic' : 'english' }}">
                    {{ app()->getLocale() === 'ar' ? 'الملف الشخصي' : 'Profile' }}
                    <span class="block bg-gradient-to-r from-warm-300 to-warm-400 bg-clip-text text-transparent">
                        {{ app()->getLocale() === 'ar' ? 'وإعدادات الحساب' : '& Account Settings' }}
                    </span>
                </h1>
                <p class="text-xl text-white/90 max-w-3xl mx-auto leading-relaxed">
                    {{ app()->getLocale() === 'ar' ? 'تحديث معلوماتك الشخصية وإدارة إعدادات حسابك في منصتنا الخيرية' : 'Update your personal information and manage your account settings in our charity platform' }}
                </p>
            </div>
        </div>
    </section>

    <!--==============================
        نموذج تحديث الملف الشخصي
        ==============================-->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- عنوان القسم -->
                <div class="text-center mb-16" data-aos="fade-up">
                    <span class="inline-block px-6 py-2 text-sm font-medium text-charity-600 bg-charity-100 rounded-full mb-4">
                        {{ app()->getLocale() === 'ar' ? '📝 تحديث المعلومات' : '📝 Update Information' }}
                    </span>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 font-{{ app()->getLocale() === 'ar' ? 'arabic' : 'english' }}">
                        {{ app()->getLocale() === 'ar' ? 'تحديث المستخدم' : 'Update User' }}
                    </h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                        {{ app()->getLocale() === 'ar' ? 'قم بتحديث معلوماتك الشخصية للحفاظ على بياناتك محدثة' : 'Update your personal information to keep your data current' }}
                    </p>
                </div>

                <!-- النموذج -->
                <div class="bg-white rounded-3xl shadow-xl p-8 md:p-12 border border-gray-100" data-aos="fade-up" data-aos-delay="200">
                    <form action="{{ route('user.update') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- المعلومات الأساسية -->
                        <div class="bg-gray-50 rounded-2xl p-6 mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                {{ app()->getLocale() === 'ar' ? 'المعلومات الأساسية' : 'Basic Information' }}
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'الاسم الكامل' : 'Full Name' }}
                                    </label>
                                    <input type="text" 
                                           name="name" 
                                           value="{{ Auth::user()->name }}" 
                                           required 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300"
                                           placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل الاسم الكامل' : 'Enter full name' }}">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني' : 'Email Address' }}
                                    </label>
                                    <input type="email" 
                                           name="email" 
                                           value="{{ Auth::user()->email }}" 
                                           required 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300"
                                           placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل عنوان البريد الإلكتروني' : 'Enter email address' }}">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'رقم الهاتف' : 'Phone Number' }}
                                    </label>
                                    <input type="tel" 
                                           name="phone" 
                                           value="{{ Auth::user()->phone }}" 
                                           required 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300"
                                           placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل رقم الهاتف' : 'Enter phone number' }}">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'العمر' : 'Age' }}
                                    </label>
                                    <input type="number" 
                                           name="age" 
                                           value="{{ Auth::user()->age }}" 
                                           min="1" 
                                           max="120" 
                                           required 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300"
                                           placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل عمرك' : 'Enter your age' }}">
                                </div>
                            </div>
                        </div>

                        <!-- النوع -->
                        <div class="bg-gray-50 rounded-2xl p-6 mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                {{ app()->getLocale() === 'ar' ? 'النوع' : 'Gender' }}
                            </h3>
                            
                            <div class="flex items-center space-x-6">
                                <label class="flex items-center p-4 border border-gray-200 rounded-2xl hover:border-charity-300 cursor-pointer transition-all duration-300">
                                    <input type="radio" 
                                           name="gender" 
                                           value="male" 
                                           {{ Auth::user()->gender == 'male' ? 'checked' : '' }} 
                                           class="mr-3 text-charity-600 focus:ring-charity-500">
                                    <div class="flex items-center">
                                        <i class="fas fa-mars text-blue-600 mr-3"></i>
                                        <span class="font-medium">{{ app()->getLocale() === 'ar' ? 'ذكر' : 'Male' }}</span>
                                    </div>
                                </label>
                                
                                <label class="flex items-center p-4 border border-gray-200 rounded-2xl hover:border-charity-300 cursor-pointer transition-all duration-300">
                                    <input type="radio" 
                                           name="gender" 
                                           value="female" 
                                           {{ Auth::user()->gender == 'female' ? 'checked' : '' }} 
                                           class="mr-3 text-charity-600 focus:ring-charity-500">
                                    <div class="flex items-center">
                                        <i class="fas fa-venus text-pink-600 mr-3"></i>
                                        <span class="font-medium">{{ app()->getLocale() === 'ar' ? 'أنثى' : 'Female' }}</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- معلومات إضافية (غير متاحة حالياً) -->
                        <div class="bg-gray-50 rounded-2xl p-6 mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                {{ app()->getLocale() === 'ar' ? 'معلومات إضافية' : 'Additional Information' }}
                            </h3>
                            
                            <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-4 mb-6">
                                <div class="flex items-start">
                                    <i class="fas fa-info-circle text-yellow-600 mt-1 mr-3"></i>
                                    <div>
                                        <p class="text-sm text-yellow-800 font-medium mb-1">
                                            {{ app()->getLocale() === 'ar' ? 'قريباً:' : 'Coming Soon:' }}
                                        </p>
                                        <p class="text-sm text-yellow-700">
                                            {{ app()->getLocale() === 'ar' ? 'سيتم إضافة خيارات إدارة العنوان والبلد والمدينة قريباً' : 'Address, country, and city management options will be added soon' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 opacity-50">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'العنوان الأول' : 'Primary Address' }}
                                    </label>
                                    <input type="text" 
                                           disabled 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl bg-gray-100 cursor-not-allowed"
                                           placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل العنوان الأول' : 'Enter primary address' }}">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'العنوان الثاني' : 'Secondary Address' }}
                                    </label>
                                    <input type="text" 
                                           disabled 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl bg-gray-100 cursor-not-allowed"
                                           placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل العنوان الثاني' : 'Enter secondary address' }}">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'البلد' : 'Country' }}
                                    </label>
                                    <select disabled class="w-full px-4 py-3 border border-gray-300 rounded-2xl bg-gray-100 cursor-not-allowed">
                                        <option>{{ app()->getLocale() === 'ar' ? 'اختر البلد' : 'Select Country' }}</option>
                                        <option>America</option>
                                        <option>Japan</option>
                                        <option>India</option>
                                        <option>Nepal</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'المدينة' : 'City' }}
                                    </label>
                                    <input type="text" 
                                           disabled 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl bg-gray-100 cursor-not-allowed"
                                           placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل المدينة' : 'Enter city' }}">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'المنطقة' : 'District' }}
                                    </label>
                                    <input type="text" 
                                           disabled 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl bg-gray-100 cursor-not-allowed"
                                           placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل منطقتك' : 'Enter your district' }}">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'الرمز البريدي' : 'Postal Code' }}
                                    </label>
                                    <input type="text" 
                                           disabled 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl bg-gray-100 cursor-not-allowed"
                                           placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل الرمز البريدي' : 'Enter postal code' }}">
                                </div>
                            </div>
                        </div>

                        <!-- زر التحديث -->
                        <div class="text-center pt-6">
                            <button type="submit" 
                                    class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-charity-500 to-charity-600 hover:from-charity-600 hover:to-charity-700 rounded-full transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                                <i class="fas fa-save {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></i>
                                {{ app()->getLocale() === 'ar' ? 'تحديث المعلومات' : 'Update Information' }}
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
        const inputs = document.querySelectorAll('input:not([disabled]), select:not([disabled])');
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
                ${app().getLocale() === 'ar' ? 'جاري التحديث...' : 'Updating...'}
            `;
            submitBtn.disabled = true;
        });

        // تأثير اختيار النوع
        const genderRadios = document.querySelectorAll('input[name="gender"]');
        genderRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                // إزالة التأثير من جميع الخيارات
                document.querySelectorAll('input[name="gender"]').forEach(r => {
                    r.closest('label').classList.remove('border-charity-300', 'bg-charity-50');
                });
                
                // إضافة التأثير للخيار المحدد
                this.closest('label').classList.add('border-charity-300', 'bg-charity-50');
            });
        });
    });
</script>
@endsection
