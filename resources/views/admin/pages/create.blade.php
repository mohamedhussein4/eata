@extends('layouts.dashboard')

@section('page-title', 'إضافة صفحة جديدة')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">إضافة صفحة جديدة</h1>
                <p class="text-gray-600 mt-2">إنشاء صفحة جديدة في الموقع</p>
                
                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <a href="{{ route('admin.pages.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">إدارة الصفحات</a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">إضافة صفحة جديدة</span>
                </nav>
            </div>
            
            {{-- Action Buttons --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.pages.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    العودة للقائمة
                </a>
            </div>
        </div>
    </div>

    {{-- Form Section --}}
    <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Basic Information Card --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-6 border-b border-gray-100">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-info-circle text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">المعلومات الأساسية</h2>
                        <p class="text-gray-600 text-sm">املأ المعلومات الأساسية للصفحة</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6 lg:p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Page Title --}}
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-heading text-blue-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            عنوان الصفحة <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title" name="title" required
                               value="{{ old('title') }}"
                               class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 @error('title') border-red-500 @enderror"
                               placeholder="أدخل عنوان الصفحة">
                        @error('title')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Page Slug --}}
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-link text-purple-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            مسار الصفحة (URL)
                        </label>
                        <input type="text" id="slug" name="slug"
                               value="{{ old('slug') }}"
                               class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 @error('slug') border-red-500 @enderror"
                               placeholder="سيتم إنشاؤه تلقائياً">
                        @error('slug')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">إذا تركته فارغاً، سيتم إنشاؤه تلقائياً من العنوان</p>
                    </div>
                </div>

                {{-- Page Content --}}
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-file-alt text-green-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        محتوى الصفحة <span class="text-red-500">*</span>
                    </label>
                    <textarea id="content" name="content" rows="10" required
                              class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 resize-none @error('content') border-red-500 @enderror"
                              placeholder="أدخل محتوى الصفحة...">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- SEO Settings Card --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-green-50 to-green-100 p-6 border-b border-gray-100">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-search text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">إعدادات تحسين محركات البحث (SEO)</h2>
                        <p class="text-gray-600 text-sm">تحسين ظهور الصفحة في محركات البحث</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6 lg:p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Meta Title --}}
                    <div>
                        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-tag text-indigo-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            عنوان ميتا (للSEO)
                        </label>
                        <input type="text" id="meta_title" name="meta_title"
                               value="{{ old('meta_title') }}"
                               class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 @error('meta_title') border-red-500 @enderror"
                               placeholder="عنوان الصفحة في محركات البحث">
                        @error('meta_title')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Sort Order --}}
                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-sort-numeric-down text-orange-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            ترتيب الصفحة
                        </label>
                        <input type="number" id="sort_order" name="sort_order"
                               value="{{ old('sort_order', 0) }}"
                               class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 @error('sort_order') border-red-500 @enderror"
                               placeholder="0">
                        @error('sort_order')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Meta Description --}}
                <div>
                    <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-align-left text-purple-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        وصف ميتا (للSEO)
                    </label>
                    <textarea id="meta_description" name="meta_description" rows="3"
                              class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 resize-none @error('meta_description') border-red-500 @enderror"
                              placeholder="وصف الصفحة في محركات البحث (160 حرف كحد أقصى)">{{ old('meta_description') }}</textarea>
                    @error('meta_description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Media & Settings Card --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-50 to-purple-100 p-6 border-b border-gray-100">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-cog text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">الوسائط والإعدادات</h2>
                        <p class="text-gray-600 text-sm">صورة الصفحة وإعدادات إضافية</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6 lg:p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Featured Image --}}
                    <div>
                        <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-image text-pink-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            صورة الصفحة المميزة
                        </label>
                        <div class="flex items-center justify-center w-full">
                            <label for="featured_image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-2xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-2"></i>
                                    <p class="text-sm text-gray-500">
                                        <span class="font-semibold">اضغط للرفع</span> أو اسحب الملف
                                    </p>
                                    <p class="text-xs text-gray-500">PNG, JPG أو GIF (بحد أقصى 10MB)</p>
                                </div>
                                <input id="featured_image" name="featured_image" type="file" class="hidden" accept="image/*">
                            </label>
                        </div>
                        @error('featured_image')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">يفضل أن تكون الصورة بأبعاد 1200×630 بكسل</p>
                    </div>

                    {{-- Page Status --}}
                    <div class="flex items-center justify-center">
                        <div class="bg-gray-50 rounded-2xl p-6 w-full">
                            <div class="flex items-center justify-between">
                                <div>
                                    <label for="is_active" class="text-sm font-medium text-gray-700">
                                        <i class="fas fa-toggle-on text-green-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                        حالة الصفحة
                                    </label>
                                    <p class="text-xs text-gray-500 mt-1">نشر الصفحة فور الإنشاء</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="is_active" name="is_active" value="1" class="sr-only peer" {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form Actions --}}
        <div class="flex items-center justify-end gap-4 bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
            <a href="{{ route('admin.pages.index') }}" 
               class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                <i class="fas fa-times {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                إلغاء
            </a>
            <button type="submit" 
                    class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-lg hover:shadow-xl">
                <i class="fas fa-save {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                حفظ الصفحة
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // توليد Slug من العنوان
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');
    
    titleInput.addEventListener('keyup', function() {
        if (slugInput.value === '') {
            const title = this.value;
            const slug = title.toLowerCase()
                .replace(/[^\w\u0621-\u064A\s]/gi, '') // إزالة الأحرف الخاصة ما عدا العربية
                .replace(/\s+/g, '-'); // استبدال المسافات بشرطات
            slugInput.value = slug;
        }
    });

    // Preview uploaded image
    const imageInput = document.getElementById('featured_image');
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // يمكن إضافة معاينة للصورة هنا
                console.log('Image selected:', file.name);
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
@endsection