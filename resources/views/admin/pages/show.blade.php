@extends('layouts.dashboard')

@section('page-title', 'عرض الصفحة')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">{{ $page->title }}</h1>
                <p class="text-gray-600 mt-2">عرض تفاصيل الصفحة والمحتوى</p>
                
                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <a href="{{ route('admin.pages.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">إدارة الصفحات</a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">{{ Str::limit($page->title, 30) }}</span>
                </nav>
            </div>
            
            {{-- Action Buttons --}}
            <div class="flex items-center gap-3">
                @if($page->url ?? false)
                <a href="{{ $page->url }}" target="_blank" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-blue-700 bg-blue-100 hover:bg-blue-200 rounded-2xl transition-all duration-300">
                    <i class="fas fa-external-link-alt {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    عرض في الموقع
                </a>
                @endif
                <a href="{{ route('admin.pages.edit', $page->id) }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-yellow-700 bg-yellow-100 hover:bg-yellow-200 rounded-2xl transition-all duration-300">
                    <i class="fas fa-edit {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    تعديل
                </a>
                <a href="{{ route('admin.pages.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    العودة للقائمة
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Page Content Card --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-6 border-b border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">محتوى الصفحة</h2>
                            <p class="text-gray-600 text-sm">المحتوى الأساسي للصفحة</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6 lg:p-8">
                    <div class="prose prose-lg max-w-none">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>

            {{-- Featured Image Card --}}
            @if($page->featured_image)
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-50 to-purple-100 p-6 border-b border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-image text-white"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">الصورة المميزة</h2>
                            <p class="text-gray-600 text-sm">صورة الصفحة الرئيسية</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <img src="{{ asset('/' . $page->featured_image) }}" 
                         alt="{{ $page->title }}" 
                         class="w-full rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                </div>
            </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">
            {{-- Page Info Card --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-green-50 to-green-100 p-6 border-b border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-info-circle text-white"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900">معلومات الصفحة</h2>
                            <p class="text-gray-600 text-sm">تفاصيل الصفحة</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6 space-y-4">
                    {{-- Status --}}
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 font-medium">الحالة</span>
                        @if($page->is_active)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                نشط
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <i class="fas fa-times-circle {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                غير نشط
                            </span>
                        @endif
                    </div>

                    {{-- Slug --}}
                    <div class="flex items-start justify-between">
                        <span class="text-gray-600 font-medium">المسار</span>
                        <span class="text-gray-900 font-mono text-sm text-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}">{{ $page->slug ?: 'غير محدد' }}</span>
                    </div>

                    {{-- Sort Order --}}
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 font-medium">الترتيب</span>
                        <span class="text-gray-900 font-medium">{{ $page->sort_order }}</span>
                    </div>

                    {{-- Created Date --}}
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 font-medium">تاريخ الإنشاء</span>
                        <span class="text-gray-900 font-medium">{{ $page->created_at->format('Y-m-d') }}</span>
                    </div>

                    {{-- Last Update --}}
                    @if($page->updated_at && $page->updated_at != $page->created_at)
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 font-medium">آخر تحديث</span>
                        <span class="text-gray-900 font-medium">{{ $page->updated_at->format('Y-m-d H:i') }}</span>
                    </div>
                    @endif
                </div>
            </div>

            {{-- SEO Info Card --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 p-6 border-b border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-search text-white"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900">إعدادات SEO</h2>
                            <p class="text-gray-600 text-sm">تحسين محركات البحث</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6 space-y-4">
                    {{-- Meta Title --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">عنوان ميتا</label>
                        <div class="bg-gray-50 rounded-2xl p-3">
                            <p class="text-gray-900 text-sm">{{ $page->meta_title ?: $page->title }}</p>
                        </div>
                    </div>

                    {{-- Meta Description --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">وصف ميتا</label>
                        <div class="bg-gray-50 rounded-2xl p-3">
                            <p class="text-gray-900 text-sm">{{ $page->meta_description ?: 'غير محدد' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Actions Card --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-orange-50 to-orange-100 p-6 border-b border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-cog text-white"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900">الإجراءات</h2>
                            <p class="text-gray-600 text-sm">إدارة الصفحة</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6 space-y-3">
                    <a href="{{ route('admin.pages.edit', $page->id) }}" 
                       class="w-full inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-yellow-700 bg-yellow-100 hover:bg-yellow-200 rounded-2xl transition-all duration-300">
                        <i class="fas fa-edit {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        تعديل الصفحة
                    </a>

                    @if($page->url ?? false)
                    <a href="{{ $page->url }}" target="_blank"
                       class="w-full inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-blue-700 bg-blue-100 hover:bg-blue-200 rounded-2xl transition-all duration-300">
                        <i class="fas fa-external-link-alt {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        عرض في الموقع
                    </a>
                    @endif

                    <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('هل أنت متأكد من حذف هذه الصفحة؟ هذا الإجراء لا يمكن التراجع عنه!')"
                                class="w-full inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-red-700 bg-red-100 hover:bg-red-200 rounded-2xl transition-all duration-300">
                            <i class="fas fa-trash {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            حذف الصفحة
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection