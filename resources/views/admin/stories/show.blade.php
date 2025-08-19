@extends('layouts.dashboard')
@section('page-title', 'عرض قصة المستفيد')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">{{ $story->title }}</h1>
                <p class="text-gray-600 mt-2">عرض تفاصيل قصة المستفيد</p>
                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <a href="{{ route('admin.stories.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        قصص المستفيدين
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">عرض القصة</span>
                </nav>
            </div>
            {{-- Action Buttons --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.stories.edit', $story->id) }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-edit {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    تعديل القصة
                </a>
                <a href="{{ route('admin.stories.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    العودة للقائمة
                </a>
            </div>
        </div>
    </div>

    {{-- Story Details --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 lg:p-8">
            {{-- Story Header --}}
            <div class="flex items-start gap-4 mb-6 pb-6 border-b border-gray-200">
                <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-book text-white"></i>
                </div>
                <div class="flex-1">
                    <h2 class="text-xl font-bold text-gray-900 mb-1">معلومات القصة</h2>
                    <p class="text-gray-600">تفاصيل قصة المستفيد</p>
                </div>
                <div class="flex-shrink-0">
                    @if($story->status === 'published')
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            منشورة
                        </span>
                    @elseif($story->status === 'pending')
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-clock {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            معلقة
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            <i class="fas fa-pencil-alt {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            مسودة
                        </span>
                    @endif
                </div>
            </div>

            {{-- Story Information --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Basic Information --}}
                <div class="bg-gray-50 rounded-2xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-info-circle text-indigo-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        المعلومات الأساسية
                    </h3>
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">رقم القصة</dt>
                            <dd class="mt-1 text-sm text-gray-900">#{{ $story->id }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">المستفيد</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $story->beneficiary->name ?? 'غير محدد' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">تاريخ الإنشاء</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $story->created_at->format('Y-m-d H:i:s') }}</dd>
                        </div>
                    </dl>
                </div>

                {{-- Additional Information --}}
                <div class="bg-gray-50 rounded-2xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-clipboard-list text-indigo-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        معلومات إضافية
                    </h3>
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">الحالة</dt>
                            <dd class="mt-1">
                                @if($story->status === 'published')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                        منشورة
                                    </span>
                                @elseif($story->status === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                        معلقة
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        <i class="fas fa-pencil-alt {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                        مسودة
                                    </span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">آخر تحديث</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $story->updated_at->format('Y-m-d H:i:s') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">عدد الكلمات</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ str_word_count(strip_tags($story->content)) }} كلمة</dd>
                        </div>
                    </dl>
                </div>
            </div>

            {{-- Story Content --}}
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-book-open text-indigo-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    محتوى القصة
                </h3>
                <div class="bg-gray-50 rounded-2xl p-6">
                    @if($story->image)
                        <div class="mb-6">
                            <img src="{{ asset('/' . $story->image) }}" alt="{{ $story->title }}" class="w-full h-64 object-cover rounded-xl">
                        </div>
                    @endif
                    <div class="prose max-w-none">
                        {!! $story->content !!}
                    </div>
                </div>
            </div>

            {{-- Story Actions --}}
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <form action="{{ route('admin.stories.destroy', $story->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-red-700 bg-red-100 hover:bg-red-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('هل أنت متأكد من حذف هذه القصة؟')">
                                <i class="fas fa-trash {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                حذف القصة
                            </button>
                        </form>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.stories.edit', $story->id) }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fas fa-edit {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            تعديل القصة
                        </a>
                        <a href="{{ route('admin.stories.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            العودة للقائمة
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
