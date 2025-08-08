@extends('frontend.layouts.app')

@section('title', app()->getLocale() === 'ar' ? 'سجل كمتطوع - إيطا' : 'Register as Volunteer - Eata')
@section('description', app()->getLocale() === 'ar' ? 'انضم إلينا كمتطوع وساعد في خدمة الإنسانية - منصة إيطا للتبرعات الخيرية' : 'Join us as a volunteer and help serve humanity - Eata Charity Platform')

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
                    {{ app()->getLocale() === 'ar' ? '🤝 انضم إلينا' : '🤝 Join Us' }}
                </span>
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight font-{{ app()->getLocale() === 'ar' ? 'arabic' : 'english' }}">
                    {{ app()->getLocale() === 'ar' ? 'كن متطوعاً' : 'Become a Volunteer' }}
                    <span class="block bg-gradient-to-r from-warm-300 to-warm-400 bg-clip-text text-transparent">
                        {{ app()->getLocale() === 'ar' ? 'وساعد الآخرين' : 'and Help Others' }}
                    </span>
                </h1>
                <p class="text-xl text-white/90 max-w-3xl mx-auto leading-relaxed">
                    {{ app()->getLocale() === 'ar' ? 'انضم إلى فريق المتطوعين لدينا وساعد في خدمة الإنسانية. كل مساهمة، مهما كانت صغيرة، تصنع فرقاً كبيراً في حياة الناس.' : 'Join our volunteer team and help serve humanity. Every contribution, no matter how small, makes a big difference in people\'s lives.' }}
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
                        {{ app()->getLocale() === 'ar' ? 'سجل كمتطوع' : 'Register as Volunteer' }}
                    </h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                        {{ app()->getLocale() === 'ar' ? 'املأ النموذج أدناه لتصبح متطوعاً في منصتنا الخيرية' : 'Fill out the form below to become a volunteer in our charity platform' }}
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
                    <form method="post" id="volunteer_form" action="{{ route('volunteers.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- المعلومات الشخصية -->
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
                                       required 
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
                                       min="18" 
                                       max="100" 
                                       required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300"
                                       placeholder="{{ app()->getLocale() === 'ar' ? 'عمرك' : 'Your age' }}">
                            </div>

                            <div>
                                <label for="academic_degree" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ app()->getLocale() === 'ar' ? 'الدرجة الأكاديمية' : 'Academic Degree' }}
                                </label>
                                <input type="text" 
                                       name="academic_degree" 
                                       id="academic_degree" 
                                       required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300"
                                       placeholder="{{ app()->getLocale() === 'ar' ? 'درجتك الأكاديمية' : 'Your academic degree' }}">
                            </div>
                        </div>

                        <!-- الخبرات السابقة -->
                        <div>
                            <label for="previous_experiences" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ app()->getLocale() === 'ar' ? 'الخبرات السابقة' : 'Previous Experiences' }}
                            </label>
                            <textarea name="previous_experiences" 
                                      id="previous_experiences" 
                                      rows="4" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300 resize-none"
                                      placeholder="{{ app()->getLocale() === 'ar' ? 'اذكر خبراتك السابقة في العمل التطوعي أو الخيري (اختياري)' : 'Mention your previous experiences in volunteer or charity work (optional)' }}"></textarea>
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

                            <div class="mt-6">
                                <label for="cv" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ app()->getLocale() === 'ar' ? 'السيرة الذاتية' : 'CV/Resume' }}
                                </label>
                                <div class="relative">
                                    <input type="file" 
                                           name="cv" 
                                           id="cv" 
                                           accept=".pdf,.doc,.docx" 
                                           required 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-charity-50 file:text-charity-700 hover:file:bg-charity-100">
                                </div>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ app()->getLocale() === 'ar' ? 'صيغ مقبولة: PDF, DOC, DOCX' : 'Accepted formats: PDF, DOC, DOCX' }}
                                </p>
                            </div>
                        </div>

                        <!-- زر التسجيل -->
                        <div class="text-center pt-6">
                            <button type="submit" 
                                    class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-charity-500 to-charity-600 hover:from-charity-600 hover:to-charity-700 rounded-full transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                                <i class="fas fa-heart {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></i>
                                {{ app()->getLocale() === 'ar' ? 'سجل كمتطوع' : 'Register as Volunteer' }}
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
                    // يمكن إضافة تأثير لعرض اسم الملف المحدد
                    console.log('Selected file:', fileName);
                }
            });
        });
    });
</script>
@endsection
