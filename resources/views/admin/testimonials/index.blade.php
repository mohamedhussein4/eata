@extends('layouts.dashboard')

@section('page-title', 'إدارة آراء المستخدمين')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">إدارة آراء المستخدمين</h1>
                <p class="text-gray-600 mt-2">عرض وإدارة جميع آراء وشهادات المستخدمين</p>
                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">آراء المستخدمين</span>
                </nav>
            </div>
            {{-- Action Buttons --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.testimonials.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-2xl transition-all duration-300 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-plus {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    إضافة رأي جديد
                </a>
                <a href="{{ route('admin.testimonials.pending') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-orange-700 bg-orange-100 hover:bg-orange-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                    <i class="fas fa-clock {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    الآراء المعلقة
                    @php
                        $pendingCount = isset($testimonials) ? $testimonials->where('status', 'pending')->count() : 0;
                    @endphp
                    <span class="bg-orange-200 text-orange-800 {{ app()->getLocale() === 'ar' ? 'mr-2' : 'ml-2' }} px-2 py-0.5 rounded-full text-xs font-bold">{{ $pendingCount }}</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Search and Filter Section --}}
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label for="search" class="block text-sm font-semibold text-gray-700 mb-3">البحث</label>
                <div class="relative">
                    <input type="text"
                           id="search"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="ابحث في الآراء..."
                           class="w-full {{ app()->getLocale() === 'ar' ? 'pr-12 pl-4' : 'pl-12 pr-4' }} py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300">
                    <i class="fas fa-search absolute {{ app()->getLocale() === 'ar' ? 'right-4' : 'left-4' }} top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>

            <div>
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-3">الحالة</label>
                <select id="status" name="status" class="w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300">
                    <option value="">جميع الحالات</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>منشورة</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>معلقة</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>مسودة</option>
                </select>
            </div>

            <div class="flex items-end gap-3">
                <button type="submit" class="flex-1 inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-filter {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    تصفية
                </button>
                <a href="{{ route('admin.testimonials.index') }}" class="flex-1 inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-redo {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    إعادة تعيين
                </a>
            </div>
        </form>
    </div>

    {{-- Testimonials Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($testimonials as $testimonial)
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300">
            {{-- Testimonial Header --}}
            <div class="relative">
                @if($testimonial->image)
                    <img src="{{ asset('/' . $testimonial->image) }}" alt="{{ $testimonial->name }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                        <i class="fas fa-quote-right text-4xl text-gray-400"></i>
                    </div>
                @endif
                <div class="absolute top-4 right-4">
                    @if($testimonial->status === 'published')
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                            منشورة
                        </span>
                    @elseif($testimonial->status === 'pending')
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
                </div>
            </div>

            {{-- Testimonial Content --}}
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">{{ $testimonial->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $testimonial->title }}</p>
                    </div>
                    <div class="flex items-center">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }} text-sm"></i>
                        @endfor
                    </div>
                </div>

                <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $testimonial->content }}</p>

                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                    <span>
                        <i class="fas fa-calendar {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                        {{ $testimonial->created_at->format('Y-m-d') }}
                    </span>
                    @if($testimonial->is_featured)
                        <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-medium bg-purple-100 text-purple-800">
                            <i class="fas fa-star {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                            مميز
                        </span>
                    @endif
                </div>

                {{-- Action Buttons --}}
                <div class="flex gap-2">
                    <a href="{{ route('admin.testimonials.show', $testimonial->id) }}" class="flex-1 inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-blue-700 bg-blue-100 hover:bg-blue-200 rounded-lg transition-colors duration-200">
                        <i class="fas fa-eye {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                        عرض
                    </a>

                    <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="flex-1 inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200 rounded-lg transition-colors duration-200">
                        <i class="fas fa-edit {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                        تعديل
                    </a>

                    <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-red-700 bg-red-100 hover:bg-red-200 rounded-lg transition-colors duration-200" onclick="return confirm('هل أنت متأكد من حذف هذا الرأي؟')">
                            <i class="fas fa-trash {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                            حذف
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full">
            <div class="text-center bg-white rounded-3xl p-12 shadow-sm border border-gray-100">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-quote-right text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">لا توجد آراء</h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">لم يتم العثور على أي آراء. يمكنك إضافة رأي جديد من خلال الزر أعلاه.</p>
                <a href="{{ route('admin.testimonials.create') }}" class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-2xl transition-all duration-300 shadow-sm hover:shadow-md">
                    <i class="fas fa-plus {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    إضافة رأي جديد
                </a>
            </div>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($testimonials->hasPages())
    <div class="flex justify-center">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
            {{ $testimonials->links() }}
        </div>
    </div>
    @endif
</div>
@endsection
