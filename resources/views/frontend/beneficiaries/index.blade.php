@extends('frontend.layouts.app')

@section('title', app()->getLocale() === 'ar' ? 'سجل كمستفيد - إيطا' : 'Register as Beneficiary - Eata')
@section('description', app()->getLocale() === 'ar' ? 'سجل كمستفيد واحصل على المساعدة التي تحتاجها - منصة إيطا للتبرعات الخيرية' : 'Register as a beneficiary and get the help you need - Eata Charity Platform')

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
                    {{ app()->getLocale() === 'ar' ? '🤲 احصل على المساعدة' : '🤲 Get Help' }}
                </span>
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight font-{{ app()->getLocale() === 'ar' ? 'arabic' : 'english' }}">
                    {{ app()->getLocale() === 'ar' ? 'سجل كمستفيد' : 'Register as Beneficiary' }}
                    <span class="block bg-gradient-to-r from-warm-300 to-warm-400 bg-clip-text text-transparent">
                        {{ app()->getLocale() === 'ar' ? 'واحصل على المساعدة' : 'and Get Support' }}
                    </span>
                </h1>
                <p class="text-xl text-white/90 max-w-3xl mx-auto leading-relaxed">
                    {{ app()->getLocale() === 'ar' ? 'نحن هنا لمساعدتك. سجل كمستفيد واحصل على الدعم والمساعدة التي تحتاجها من مجتمعنا الخيري.' : 'We are here to help you. Register as a beneficiary and get the support and help you need from our charity community.' }}
                </p>
            </div>
        </div>
    </section>

    <!--==============================
        نموذج التسجيل
        ==============================-->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- عنوان القسم -->
                <div class="text-center mb-16" data-aos="fade-up">
                    <span class="inline-block px-6 py-2 text-sm font-medium text-charity-600 bg-charity-100 rounded-full mb-4">
                        {{ app()->getLocale() === 'ar' ? '📝 نموذج التسجيل' : '📝 Registration Form' }}
                    </span>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 font-{{ app()->getLocale() === 'ar' ? 'arabic' : 'english' }}">
                        {{ app()->getLocale() === 'ar' ? 'سجل كمستفيد' : 'Register as Beneficiary' }}
                    </h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                        {{ app()->getLocale() === 'ar' ? 'املأ النموذج أدناه لتسجيل نفسك كمستفيد والحصول على المساعدة المطلوبة' : 'Fill out the form below to register yourself as a beneficiary and get the required help' }}
                    </p>
                </div>

                <!-- ملاحظة الاختبار -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-3xl p-6 mb-8" data-aos="fade-up">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle text-yellow-600 mt-1 mr-3 text-xl"></i>
                        <div>
                            <p class="text-sm text-yellow-800 font-medium mb-2">
                                {{ app()->getLocale() === 'ar' ? 'ملاحظة:' : 'Note:' }}
                            </p>
                            <p class="text-sm text-yellow-700">
                                {{ app()->getLocale() === 'ar' ? 'يتم تمكين وضع الاختبار. سيتم مراجعة طلبك من قبل فريقنا قبل الموافقة عليه.' : 'Test mode is enabled. Your application will be reviewed by our team before approval.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- النموذج -->
                <div class="bg-white rounded-3xl shadow-xl p-8 md:p-12 border border-gray-100" data-aos="fade-up" data-aos-delay="200">
                    <form method="post" id="beneficiary_form" action="{{ route('beneficiaries.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- المعلومات الشخصية -->
                        <div class="bg-gray-50 rounded-2xl p-6 mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                {{ app()->getLocale() === 'ar' ? 'المعلومات الشخصية' : 'Personal Information' }}
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'الاسم الكامل' : 'Full Name' }}
                                    </label>
                                    <input type="text" 
                                           name="name" 
                                           id="name" 
                                           required 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300"
                                           placeholder="{{ app()->getLocale() === 'ar' ? 'اسمك الكامل' : 'Your full name' }}">
                                </div>

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

                                <div>
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'العنوان' : 'Address' }}
                                    </label>
                                    <input type="text" 
                                           name="address" 
                                           id="address" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300"
                                           placeholder="{{ app()->getLocale() === 'ar' ? 'عنوانك' : 'Your address' }}">
                                </div>

                                <div>
                                    <label for="age" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'العمر' : 'Age' }}
                                    </label>
                                    <input type="number" 
                                           name="age" 
                                           id="age" 
                                           min="1" 
                                           max="120" 
                                           required 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300"
                                           placeholder="{{ app()->getLocale() === 'ar' ? 'عمرك' : 'Your age' }}">
                                </div>

                                <div>
                                    <label for="marital_status" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'الحالة الاجتماعية' : 'Marital Status' }}
                                    </label>
                                    <select name="marital_status" 
                                            id="marital_status" 
                                            required 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300">
                                        <option value="" disabled selected>{{ app()->getLocale() === 'ar' ? 'اختر الحالة' : 'Select Status' }}</option>
                                        <option value="single">{{ app()->getLocale() === 'ar' ? 'أعزب' : 'Single' }}</option>
                                        <option value="married">{{ app()->getLocale() === 'ar' ? 'متزوج' : 'Married' }}</option>
                                        <option value="divorced">{{ app()->getLocale() === 'ar' ? 'مطلق' : 'Divorced' }}</option>
                                        <option value="widowed">{{ app()->getLocale() === 'ar' ? 'أرمل' : 'Widowed' }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- معلومات العائلة -->
                        <div class="bg-gray-50 rounded-2xl p-6 mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                {{ app()->getLocale() === 'ar' ? 'معلومات العائلة' : 'Family Information' }}
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="family_members_count" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'عدد أفراد العائلة' : 'Family Members Count' }}
                                    </label>
                                    <input type="number" 
                                           name="family_members_count" 
                                           id="family_members_count" 
                                           min="1" 
                                           required 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300"
                                           placeholder="{{ app()->getLocale() === 'ar' ? 'عدد أفراد العائلة' : 'Number of family members' }}">
                                </div>

                                <div>
                                    <label for="children_under_10_count" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'عدد الأطفال تحت سن الـ 10 سنوات' : 'Children Under 10 Years' }}
                                    </label>
                                    <input type="number" 
                                           name="children_under_10_count" 
                                           id="children_under_10_count" 
                                           min="0" 
                                           required 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300"
                                           placeholder="{{ app()->getLocale() === 'ar' ? 'عدد الأطفال' : 'Number of children' }}">
                                </div>
                            </div>
                        </div>

                        <!-- المعلومات المالية والصحية -->
                        <div class="bg-gray-50 rounded-2xl p-6 mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                {{ app()->getLocale() === 'ar' ? 'المعلومات المالية والصحية' : 'Financial & Health Information' }}
                            </h3>
                            
                            <div class="space-y-6">
                                <div>
                                    <label for="average_monthly_income" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'متوسط الدخل الشهري' : 'Average Monthly Income' }}
                                    </label>
                                    <input type="number" 
                                           name="average_monthly_income" 
                                           id="average_monthly_income" 
                                           min="0" 
                                           required 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300"
                                           placeholder="{{ app()->getLocale() === 'ar' ? 'الدخل الشهري' : 'Monthly income' }}">
                                </div>

                                <div>
                                    <label for="critical_surgery_diseases" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'أمراض بحاجة لعمليات جراحية حرجة' : 'Critical Surgery Diseases' }}
                                    </label>
                                    <textarea name="critical_surgery_diseases" 
                                              id="critical_surgery_diseases" 
                                              rows="3" 
                                              class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300 resize-none"
                                              placeholder="{{ app()->getLocale() === 'ar' ? 'اذكر الأمراض التي تحتاج لعمليات جراحية (إن وجدت)' : 'Mention diseases that need critical surgery (if any)' }}"></textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'هل لديك أمراض؟' : 'Do you have diseases?' }}
                                    </label>
                                    <div class="flex items-center space-x-6">
                                        <label class="flex items-center">
                                            <input type="radio" 
                                                   name="has_diseases" 
                                                   value="yes" 
                                                   class="mr-2 text-charity-600 focus:ring-charity-500">
                                            <span class="text-sm text-gray-700">{{ app()->getLocale() === 'ar' ? 'نعم' : 'Yes' }}</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="radio" 
                                                   name="has_diseases" 
                                                   value="no" 
                                                   class="mr-2 text-charity-600 focus:ring-charity-500">
                                            <span class="text-sm text-gray-700">{{ app()->getLocale() === 'ar' ? 'لا' : 'No' }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div id="diseases_details" class="hidden">
                                    <label for="diseases_details_text" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'تفاصيل الأمراض' : 'Diseases Details' }}
                                    </label>
                                    <textarea name="diseases_details" 
                                              id="diseases_details_text" 
                                              rows="3" 
                                              class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300 resize-none"
                                              placeholder="{{ app()->getLocale() === 'ar' ? 'اذكر تفاصيل الأمراض التي تعاني منها' : 'Mention details of diseases you suffer from' }}"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- الملفات المطلوبة -->
                        <div class="bg-gray-50 rounded-2xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                {{ app()->getLocale() === 'ar' ? 'الملفات المطلوبة' : 'Required Documents' }}
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="document" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'مستند شخصي' : 'Personal Document' }}
                                    </label>
                                    <div class="relative">
                                        <input type="file" 
                                               name="document" 
                                               id="document" 
                                               accept=".jpg,.jpeg,.png,.pdf" 
                                               required 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-charity-50 file:text-charity-700 hover:file:bg-charity-100">
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ app()->getLocale() === 'ar' ? 'صيغ مقبولة: JPG, PNG, PDF' : 'Accepted formats: JPG, PNG, PDF' }}
                                    </p>
                                </div>

                                <div>
                                    <label for="id_document" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'مستند الهوية' : 'ID Document' }}
                                    </label>
                                    <div class="relative">
                                        <input type="file" 
                                               name="id_document" 
                                               id="id_document" 
                                               accept=".jpg,.jpeg,.png,.pdf" 
                                               required 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-charity-50 file:text-charity-700 hover:file:bg-charity-100">
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ app()->getLocale() === 'ar' ? 'صيغ مقبولة: JPG, PNG, PDF' : 'Accepted formats: JPG, PNG, PDF' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- زر التسجيل -->
                        <div class="text-center pt-6">
                            <button type="submit" 
                                    class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-charity-500 to-charity-600 hover:from-charity-600 hover:to-charity-700 rounded-full transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                                <i class="fas fa-heart {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></i>
                                {{ app()->getLocale() === 'ar' ? 'سجل كمستفيد' : 'Register as Beneficiary' }}
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
        const inputs = document.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-charity-500');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-charity-500');
            });
        });

        // إظهار/إخفاء تفاصيل الأمراض
        const diseaseRadios = document.querySelectorAll('input[name="has_diseases"]');
        const diseasesDetails = document.getElementById('diseases_details');
        
        diseaseRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'yes') {
                    diseasesDetails.classList.remove('hidden');
                } else {
                    diseasesDetails.classList.add('hidden');
                }
            });
        });

        // تأثير التحميل عند الإرسال
        const form = document.querySelector('form');
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = `
                <i class="fas fa-spinner fa-spin ${app().getLocale() === 'ar' ? 'ml-3' : 'mr-3'}"></i>
                ${app().getLocale() === 'ar' ? 'جاري التسجيل...' : 'Registering...'}
            `;
            submitBtn.disabled = true;
        });

        // تأثير رفع الملفات
        const fileInputs = document.querySelectorAll('input[type="file"]');
        fileInputs.forEach(input => {
            input.addEventListener('change', function() {
                const fileName = this.files[0]?.name;
                if (fileName) {
                    console.log('Selected file:', fileName);
                }
            });
        });
    });
</script>
@endsection
