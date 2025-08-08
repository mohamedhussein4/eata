@extends('layouts.dashboard')

@section('page-title', 'إعدادات الموقع')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">إعدادات الموقع</h1>
                <p class="text-gray-600 mt-2">إدارة الإعدادات العامة للموقع</p>

                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">الإعدادات</span>
                </nav>
            </div>
        </div>
    </div>

    {{-- Settings Form --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="p-6 lg:p-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    {{-- Basic Information --}}
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                <i class="fas fa-info-circle text-indigo-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                المعلومات الأساسية
                            </h3>
                        </div>

                        {{-- Site Name --}}
                        <div>
                            <label for="site_name" class="block text-sm font-medium text-gray-700 mb-2">
                                اسم الموقع <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="site_name" name="site_name" required
                                   value="{{ old('site_name', $settings->site_name ?? '') }}"
                                   class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('site_name') border-red-500 @enderror"
                                   placeholder="أدخل اسم الموقع">
                            @error('site_name')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                البريد الإلكتروني <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="email" name="email" required
                                   value="{{ old('email', $settings->email ?? '') }}"
                                   class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('email') border-red-500 @enderror"
                                   placeholder="أدخل البريد الإلكتروني">
                            @error('email')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                رقم الهاتف
                            </label>
                            <input type="text" id="phone" name="phone"
                                   value="{{ old('phone', $settings->phone ?? '') }}"
                                   class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('phone') border-red-500 @enderror"
                                   placeholder="أدخل رقم الهاتف">
                            @error('phone')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Address --}}
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                العنوان
                            </label>
                            <textarea id="address" name="address" rows="3"
                                      class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 resize-none @error('address') border-red-500 @enderror"
                                      placeholder="أدخل عنوان المؤسسة">{{ old('address', $settings->address ?? '') }}</textarea>
                            @error('address')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Logo --}}
                        <div>
                            <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">
                                شعار الموقع
                            </label>
                            @if(isset($settings->logo) && $settings->logo)
                                <div class="mb-3">
                                    <img src="{{ asset($settings->logo) }}" alt="الشعار الحالي" class="w-20 h-20 object-contain rounded-lg border border-gray-200">
                                </div>
                            @endif
                            <input type="file" id="logo" name="logo" accept="image/*"
                                   class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('logo') border-red-500 @enderror">
                            @error('logo')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-gray-500 text-sm mt-1">أنواع الملفات المسموحة: JPG, PNG, GIF, SVG. الحد الأقصى: 2MB</p>
                        </div>
                    </div>

                    {{-- Social Media & Footer --}}
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                <i class="fas fa-share-alt text-blue-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                وسائل التواصل الاجتماعي
                            </h3>
                        </div>

                        {{-- Facebook --}}
                        <div>
                            <label for="facebook_link" class="block text-sm font-medium text-gray-700 mb-2">
                                رابط فيسبوك
                            </label>
                            <input type="url" id="facebook_link" name="facebook_link"
                                   value="{{ old('facebook_link', $settings->facebook_link ?? '') }}"
                                   class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('facebook_link') border-red-500 @enderror"
                                   placeholder="https://facebook.com/yourpage">
                            @error('facebook_link')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Twitter --}}
                        <div>
                            <label for="twitter_link" class="block text-sm font-medium text-gray-700 mb-2">
                                رابط تويتر
                            </label>
                            <input type="url" id="twitter_link" name="twitter_link"
                                   value="{{ old('twitter_link', $settings->twitter_link ?? '') }}"
                                   class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('twitter_link') border-red-500 @enderror"
                                   placeholder="https://twitter.com/yourhandle">
                            @error('twitter_link')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- YouTube --}}
                        <div>
                            <label for="youtube_link" class="block text-sm font-medium text-gray-700 mb-2">
                                رابط يوتيوب
                            </label>
                            <input type="url" id="youtube_link" name="youtube_link"
                                   value="{{ old('youtube_link', $settings->youtube_link ?? '') }}"
                                   class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('youtube_link') border-red-500 @enderror"
                                   placeholder="https://youtube.com/yourchannel">
                            @error('youtube_link')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- LinkedIn --}}
                        <div>
                            <label for="linkedin_link" class="block text-sm font-medium text-gray-700 mb-2">
                                رابط لينكد إن
                            </label>
                            <input type="url" id="linkedin_link" name="linkedin_link"
                                   value="{{ old('linkedin_link', $settings->linkedin_link ?? '') }}"
                                   class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('linkedin_link') border-red-500 @enderror"
                                   placeholder="https://linkedin.com/company/yourcompany">
                            @error('linkedin_link')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 mt-8">
                                <i class="fas fa-file-alt text-green-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                إعدادات التذييل
                            </h3>
                        </div>

                        {{-- Footer Description --}}
                        <div>
                            <label for="footer_description" class="block text-sm font-medium text-gray-700 mb-2">
                                وصف التذييل
                            </label>
                            <textarea id="footer_description" name="footer_description" rows="4"
                                      class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 resize-none @error('footer_description') border-red-500 @enderror"
                                      placeholder="أدخل وصف المؤسسة في التذييل">{{ old('footer_description', $settings->footer_description ?? '') }}</textarea>
                            @error('footer_description')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Copyright --}}
                        <div>
                            <label for="copyright" class="block text-sm font-medium text-gray-700 mb-2">
                                نص حقوق النشر
                            </label>
                            <input type="text" id="copyright" name="copyright"
                                   value="{{ old('copyright', $settings->copyright ?? '') }}"
                                   class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('copyright') border-red-500 @enderror"
                                   placeholder="© 2024 جميع الحقوق محفوظة">
                            @error('copyright')
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
                    تأكد من صحة البيانات قبل الحفظ
                </div>
                <div class="flex items-center gap-3">
                    <button type="reset" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        <i class="fas fa-undo {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        إعادة تعيين
                    </button>
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-save {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        حفظ الإعدادات
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection