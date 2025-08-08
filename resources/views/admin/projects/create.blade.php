@extends('layouts.dashboard')

@section('page-title', 'إضافة مشروع جديد')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    {{-- Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">إضافة مشروع جديد</h1>
                <p class="text-gray-600 mt-2">أنشئ مشروعاً خيرياً جديداً لجمع التبرعات</p>
                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <a href="{{ route('admin.projects.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        إدارة المشاريع
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">إضافة مشروع جديد</span>
                </nav>
            </div>
            {{-- Action Buttons --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    العودة للقائمة
                </a>
            </div>
        </div>
    </div>

    {{-- Error Messages --}}
    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-2xl" role="alert">
        <div class="flex items-start">
            <i class="fas fa-exclamation-triangle {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }} mt-0.5"></i>
            <div>
                <h4 class="font-medium mb-2">يرجى تصحيح الأخطاء التالية:</h4>
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Basic Information Card --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-indigo-100 rounded-2xl flex items-center justify-center {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}">
                    <i class="fas fa-info-circle text-indigo-600 text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">المعلومات الأساسية</h2>
                    <p class="text-sm text-gray-600">أدخل المعلومات الأساسية للمشروع</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Arabic Title --}}
                <div class="lg:col-span-2">
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-3">
                        عنوان المشروع (بالعربية) <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="title"
                           name="title"
                           value="{{ old('title') }}"
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('title') border-red-500 @enderror"
                           placeholder="أدخل عنوان المشروع بالعربية"
                           required>
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- English Title --}}
                <div class="lg:col-span-2">
                    <label for="title_en" class="block text-sm font-semibold text-gray-700 mb-3">
                        عنوان المشروع (بالإنجليزية)
                    </label>
                    <input type="text"
                           id="title_en"
                           name="title_en"
                           value="{{ old('title_en') }}"
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('title_en') border-red-500 @enderror"
                           placeholder="Enter project title in English">
                    @error('title_en')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Project Image --}}
            <div class="mt-6">
                <label for="image_or_video" class="block text-sm font-semibold text-gray-700 mb-3">
                    صورة المشروع
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-2xl hover:border-gray-400 transition-colors duration-200">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="image_or_video" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                <span>رفع صورة</span>
                                <input id="image_or_video" name="image_or_video" type="file" class="sr-only" accept="image/*" onchange="previewImage(this)">
                            </label>
                            <p class="{{ app()->getLocale() === 'ar' ? 'pr-1' : 'pl-1' }}">أو اسحب وأفلت</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF حتى 10MB</p>
                    </div>
                </div>
                <img id="image-preview" src="#" alt="Image Preview" class="mt-4 hidden w-full h-64 rounded-2xl object-cover">
                @error('image_or_video')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Project Description Card --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}">
                    <i class="fas fa-file-alt text-green-600 text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">وصف المشروع</h2>
                    <p class="text-sm text-gray-600">اكتب وصفاً مفصلاً وجذاباً للمشروع</p>
                </div>
            </div>

            {{-- Arabic Description --}}
            <div class="mb-6">
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-3">
                    وصف المشروع (بالعربية) <span class="text-red-500">*</span>
                </label>
                <textarea id="description"
                          name="description"
                          rows="6"
                          class="w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 @error('description') border-red-500 @enderror"
                          placeholder="اكتب وصفاً مفصلاً للمشروع وأهدافه..."
                          required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- English Description --}}
            <div>
                <label for="description_en" class="block text-sm font-semibold text-gray-700 mb-3">
                    وصف المشروع (بالإنجليزية)
                </label>
                <textarea id="description_en"
                          name="description_en"
                          rows="6"
                          class="w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 @error('description_en') border-red-500 @enderror"
                          placeholder="Write a detailed description of the project and its goals...">{{ old('description_en') }}</textarea>
                @error('description_en')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Project Details Card --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}">
                    <i class="fas fa-chart-bar text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">تفاصيل المشروع</h2>
                    <p class="text-sm text-gray-600">حدد المبلغ المستهدف وعدد المستفيدين</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Target Amount --}}
                <div>
                    <label for="target_amount" class="block text-sm font-semibold text-gray-700 mb-3">
                        المبلغ المستهدف <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number"
                               id="target_amount"
                               name="target_amount"
                               value="{{ old('target_amount') }}"
                               class="w-full px-4 py-3 {{ app()->getLocale() === 'ar' ? 'pl-16' : 'pr-16' }} border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 @error('target_amount') border-red-500 @enderror"
                               placeholder="0"
                               min="0"
                               step="0.01"
                               required>
                        <div class="absolute inset-y-0 {{ app()->getLocale() === 'ar' ? 'left-0' : 'right-0' }} {{ app()->getLocale() === 'ar' ? 'pl-3' : 'pr-3' }} flex items-center pointer-events-none">
                            <span class="text-gray-500 text-sm font-medium">ليرة سورية</span>
                        </div>
                    </div>
                    @error('target_amount')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Beneficiaries Count --}}
                <div>
                    <label for="beneficiaries_count" class="block text-sm font-semibold text-gray-700 mb-3">
                        عدد المستفيدين
                    </label>
                    <input type="number"
                           id="beneficiaries_count"
                           name="beneficiaries_count"
                           value="{{ old('beneficiaries_count', 0) }}"
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 @error('beneficiaries_count') border-red-500 @enderror"
                           placeholder="0"
                           min="0">
                    @error('beneficiaries_count')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Project Category --}}
                <div>
                    <label for="category" class="block text-sm font-semibold text-gray-700 mb-3">
                        فئة المشروع
                    </label>
                    <select id="category"
                            name="category"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 @error('category') border-red-500 @enderror">
                        <option value="">اختر فئة المشروع</option>
                        <option value="health" {{ old('category') === 'health' ? 'selected' : '' }}>الصحة</option>
                        <option value="education" {{ old('category') === 'education' ? 'selected' : '' }}>التعليم</option>
                        <option value="food" {{ old('category') === 'food' ? 'selected' : '' }}>الغذاء</option>
                        <option value="housing" {{ old('category') === 'housing' ? 'selected' : '' }}>الإسكان</option>
                        <option value="emergency" {{ old('category') === 'emergency' ? 'selected' : '' }}>الطوارئ</option>
                        <option value="other" {{ old('category') === 'other' ? 'selected' : '' }}>أخرى</option>
                    </select>
                    @error('category')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Additional Settings Card --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-orange-100 rounded-2xl flex items-center justify-center {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}">
                    <i class="fas fa-cog text-orange-600 text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">إعدادات إضافية</h2>
                    <p class="text-sm text-gray-600">حدد إعدادات النشر والرؤية</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Project Visibility --}}
                <div class="bg-gray-50 rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-base font-bold text-gray-900">مشروع مميز</h4>
                            <p class="text-sm text-gray-600 mt-1">سيظهر في المقدمة على الموقع</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ old('is_featured') ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-600"></div>
                        </label>
                    </div>
                </div>

                {{-- Allow Donations --}}
                <div class="bg-gray-50 rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-base font-bold text-gray-900">السماح بالتبرعات</h4>
                            <p class="text-sm text-gray-600 mt-1">سمح للمستخدمين بالتبرع لهذا المشروع</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="allow_donations" value="1" class="sr-only peer" {{ old('allow_donations', true) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{-- Submit Buttons --}}
        <div class="flex flex-col sm:flex-row justify-end gap-3">
            <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-2xl shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-300">
                <i class="fas fa-times {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                إلغاء
            </a>
            <button type="submit"
                    name="action"
                    value="draft"
                    class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-2xl shadow-sm text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-all duration-300">
                <i class="fas fa-save {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                حفظ كمسودة
            </button>
            <button type="submit"
                    name="action"
                    value="publish"
                    class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-2xl shadow-sm text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300">
                <i class="fas fa-rocket {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                إنشاء ونشر
            </button>
        </div>
    </form>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('image-preview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        }

        reader.readAsDataURL(input.files[0]);
    }
}

// Form validation
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const requiredFields = form.querySelectorAll('[required]');

    form.addEventListener('submit', function(e) {
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('border-red-500');
                isValid = false;
            } else {
                field.classList.remove('border-red-500');
            }
        });

        if (!isValid) {
            e.preventDefault();

            // Show notification
            const notification = document.createElement('div');
            notification.className = 'fixed top-4 {{ app()->getLocale() === 'ar' ? 'left-4' : 'right-4' }} bg-red-500 text-white px-6 py-4 rounded-2xl shadow-lg z-50';
            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></i>
                    يرجى ملء جميع الحقول المطلوبة
                </div>
            `;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 5000);
        }
    });
});
</script>
@endsection
