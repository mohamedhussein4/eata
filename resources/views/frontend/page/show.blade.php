@extends('frontend.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-20">
    <!-- Breadcrumbs -->
    <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mb-8" data-aos="fade-right">
        <a href="{{ route('home') }}" class="text-gray-500 hover:text-charity-600 transition-colors">
            <i class="fas fa-home"></i>
        </a>
        <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
        <span class="text-gray-700 font-medium">{{ $page->title }}</span>
    </nav>

    <!-- Page Content -->
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden" data-aos="fade-up">
        <!-- Header Image/Banner -->
        <div class="h-64 bg-gradient-to-br from-charity-400 to-charity-600 flex items-center justify-center relative">
            @if($page->image)
                <img src="{{ asset('storage/' . $page->image) }}" alt="{{ $page->title }}" class="w-full h-full object-cover">
            @else
                <div class="text-white text-6xl">
                    <i class="fas fa-file-alt"></i>
                </div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-8">
                <h1 class="text-3xl md:text-4xl font-bold text-white">{{ $page->title }}</h1>
            </div>
        </div>

        <!-- Page Content -->
        <div class="p-8">
            <div class="prose max-w-none">
                {!! $page->content !!}
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-gradient-to-r from-charity-600 via-charity-700 to-charity-800 text-white rounded-3xl p-8 mt-12 text-center relative overflow-hidden" data-aos="fade-up">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-64 h-64 bg-white rounded-full filter blur-3xl animate-float"></div>
            <div class="absolute bottom-10 right-10 w-48 h-48 bg-warm-300 rounded-full filter blur-3xl animate-float animation-delay-200"></div>
        </div>
        <div class="relative z-10">
            <h2 class="text-2xl font-bold mb-4">
                {{ app()->getLocale() === 'ar' ? 'هل تريد المساهمة في مشاريعنا؟' : 'Want to Contribute to Our Projects?' }}
            </h2>
            <p class="text-white/90 mb-6">
                {{ app()->getLocale() === 'ar' ? 'انضم إلينا في رحلة العطاء وساعدنا في تحقيق أهدافنا الإنسانية' : 'Join us in our journey of giving and help us achieve our humanitarian goals' }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('donations.index') }}"
                   class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-charity-600 bg-white rounded-full hover:bg-gray-50 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                    <i class="fas fa-heart {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} group-hover:animate-pulse"></i>
                    {{ app()->getLocale() === 'ar' ? 'تبرع الآن' : 'Donate Now' }}
                </a>
                <a href="{{ route('volunteers.index') }}"
                   class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-white/20 backdrop-blur-sm rounded-full hover:bg-white/30 transform hover:scale-105 transition-all duration-300 border-2 border-white/30 hover:border-white/50">
                    <i class="fas fa-hands-helping {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} group-hover:animate-pulse"></i>
                    {{ app()->getLocale() === 'ar' ? 'كن متطوعاً' : 'Become a Volunteer' }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
