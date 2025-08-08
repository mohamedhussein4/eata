@extends('layouts.dashboard')

@section('page-title', 'تعديل ترجمة الصفحة')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">تعديل ترجمة الصفحة</h1>
                <p class="text-gray-600 mt-2">تحديث ترجمة الصفحة: {{ $page->title }}</p>

                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <a href="{{ route('admin.translations.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        الترجمات
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <a href="{{ route('admin.translations.pages') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        الصفحات
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">تعديل الترجمة</span>
                </nav>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.translations.pages') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    العودة للقائمة
                </a>
            </div>
        </div>
    </div>

    {{-- Translation Form --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.translations.pages.update', $page->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="p-6 lg:p-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    {{-- Arabic Content --}}
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                <i class="fas fa-globe text-green-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                المحتوى العربي (الأصلي)
                            </h3>
                        </div>

                        {{-- Arabic Title --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                العنوان العربي
                            </label>
                            <input type="text" value="{{ $page->title }}" disabled
                                   class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl bg-gray-50 text-gray-600">
                        </div>

                        {{-- Arabic Content --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                المحتوى العربي
                            </label>
                            <textarea rows="4" disabled
                                      class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl bg-gray-50 text-gray-600 resize-none">{{ $page->content }}</textarea>
                        </div>
                    </div>

                    {{-- English Translation --}}
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                <i class="fas fa-language text-blue-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                الترجمة الإنجليزية
                            </h3>
                        </div>

                        <input type="hidden" name="translations[en][locale]" value="en">

                        {{-- English Title --}}
                        <div>
                            <label for="translations.en.title" class="block text-sm font-medium text-gray-700 mb-2">
                                العنوان الإنجليزي <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="translations.en.title" 
                                   name="translations[en][title]" 
                                   required
                                   value="{{ old('translations.en.title', $page->translation('en')?->title) }}"
                                   class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('translations.en.title') border-red-500 @enderror"
                                   placeholder="أدخل العنوان باللغة الإنجليزية">
                            @error('translations.en.title')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- English Content --}}
                        <div>
                            <label for="translations.en.content" class="block text-sm font-medium text-gray-700 mb-2">
                                المحتوى الإنجليزي <span class="text-red-500">*</span>
                            </label>
                            <textarea id="translations.en.content" 
                                      name="translations[en][content]" 
                                      rows="4" 
                                      required
                                      class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 resize-none @error('translations.en.content') border-red-500 @enderror"
                                      placeholder="أدخل المحتوى باللغة الإنجليزية">{{ old('translations.en.content', $page->translation('en')?->content) }}</textarea>
                            @error('translations.en.content')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-info-circle {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    تأكد من صحة الترجمة قبل الحفظ
                </div>
                <div class="flex items-center gap-3">
                    <button type="reset" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        <i class="fas fa-undo {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        إعادة تعيين
                    </button>
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-save {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        حفظ الترجمة
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
