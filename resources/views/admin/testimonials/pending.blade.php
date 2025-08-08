@extends('layouts.dashboard')

@section('page-title', 'الآراء المعلقة')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">الآراء المعلقة</h1>
                <p class="text-gray-600 mt-2">عرض وإدارة الآراء التي تحتاج للمراجعة والموافقة</p>
                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <a href="{{ route('admin.testimonials.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        آراء المستخدمين
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">الآراء المعلقة</span>
                </nav>
            </div>
        </div>
    </div>

    {{-- Testimonials Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($testimonials as $testimonial)
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300">
            {{-- Testimonial Header --}}
            <div class="relative">
                @if($testimonial->image)
                    <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                        <i class="fas fa-quote-right text-4xl text-gray-400"></i>
                    </div>
                @endif
                <div class="absolute top-4 right-4">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        <i class="fas fa-clock {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                        معلقة
                    </span>
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
                </div>

                {{-- Action Buttons --}}
                <div class="flex gap-2">
                    <a href="{{ route('admin.testimonials.show', $testimonial->id) }}" class="flex-1 inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-blue-700 bg-blue-100 hover:bg-blue-200 rounded-lg transition-colors duration-200">
                        <i class="fas fa-eye {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                        عرض
                    </a>

                    <form action="{{ route('admin.testimonials.approve', $testimonial->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-green-700 bg-green-100 hover:bg-green-200 rounded-lg transition-colors duration-200">
                            <i class="fas fa-check {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                            موافقة
                        </button>
                    </form>

                    <form action="{{ route('admin.testimonials.reject', $testimonial->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-red-700 bg-red-100 hover:bg-red-200 rounded-lg transition-colors duration-200" onclick="return confirm('هل أنت متأكد من رفض هذا الرأي؟')">
                            <i class="fas fa-times {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                            رفض
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full">
            <div class="text-center bg-white rounded-3xl p-12 shadow-sm border border-gray-100">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-check-circle text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">لا توجد آراء معلقة</h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">جميع الآراء تمت مراجعتها والموافقة عليها.</p>
                <a href="{{ route('admin.testimonials.index') }}" class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 shadow-sm hover:shadow-md">
                    <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    العودة للقائمة
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
