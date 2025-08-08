@extends('frontend.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="text-center mb-12" data-aos="fade-up">
        <span class="inline-block px-6 py-2 text-sm font-medium text-charity-600 bg-charity-100 rounded-full mb-4">
            {{ app()->getLocale() === 'ar' ? '💝 قالوا عنا' : '💝 Testimonials' }}
        </span>
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 font-{{ app()->getLocale() === 'ar' ? 'arabic' : 'english' }}">
            {{ app()->getLocale() === 'ar' ? 'آراء المتبرعين' : 'What Our Donors Say' }}
            <span class="block text-charity-600">
                {{ app()->getLocale() === 'ar' ? 'والمستفيدين' : 'and Beneficiaries' }}
            </span>
        </h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
            {{ app()->getLocale() === 'ar' ? 'اطلع على تجارب وقصص نجاح المتبرعين والمستفيدين من خدماتنا' : 'Read about the experiences and success stories of our donors and beneficiaries' }}
        </p>
    </div>

    <!-- Testimonials Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($testimonials as $testimonial)
        <div class="bg-white rounded-3xl shadow-xl p-8 relative group hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up">
            <!-- Quote Icon -->
            <div class="absolute top-6 {{ app()->getLocale() === 'ar' ? 'right-6' : 'left-6' }} text-4xl text-charity-200 group-hover:text-charity-300 transition-colors duration-300">
                <i class="fas fa-quote-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}"></i>
            </div>

            <!-- Content -->
            <div class="mt-8">
                <p class="text-gray-600 mb-6 leading-relaxed">{{ $testimonial->content }}</p>
                
                <!-- Author Info -->
                <div class="flex items-center">
                    @if($testimonial->image)
                        <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}" 
                             class="w-12 h-12 rounded-full object-cover border-2 border-charity-500">
                    @else
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-charity-400 to-charity-600 flex items-center justify-center text-white">
                            <i class="fas fa-user"></i>
                        </div>
                    @endif
                    <div class="{{ app()->getLocale() === 'ar' ? 'mr-4' : 'ml-4' }}">
                        <h4 class="font-semibold text-gray-900">{{ $testimonial->name }}</h4>
                        <p class="text-sm text-gray-500">{{ $testimonial->role }}</p>
                    </div>
                </div>
            </div>

            <!-- Rating Stars -->
            @if($testimonial->rating)
            <div class="absolute top-6 {{ app()->getLocale() === 'ar' ? 'left-6' : 'right-6' }} flex">
                @for($i = 0; $i < $testimonial->rating; $i++)
                    <i class="fas fa-star text-yellow-400"></i>
                @endfor
            </div>
            @endif
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <div class="text-4xl text-gray-300 mb-4">
                <i class="fas fa-comments"></i>
            </div>
            <p class="text-gray-500">
                {{ app()->getLocale() === 'ar' ? 'لا توجد توصيات حالياً' : 'No testimonials available yet' }}
            </p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($testimonials->hasPages())
    <div class="mt-12" data-aos="fade-up">
        {{ $testimonials->links() }}
    </div>
    @endif

    <!-- Add Testimonial CTA -->
    <div class="bg-gradient-to-r from-charity-600 via-charity-700 to-charity-800 text-white rounded-3xl p-8 mt-12 text-center relative overflow-hidden" data-aos="fade-up">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-64 h-64 bg-white rounded-full filter blur-3xl animate-float"></div>
            <div class="absolute bottom-10 right-10 w-48 h-48 bg-warm-300 rounded-full filter blur-3xl animate-float animation-delay-200"></div>
        </div>
        <div class="relative z-10">
            <h2 class="text-2xl font-bold mb-4">
                {{ app()->getLocale() === 'ar' ? 'شاركنا تجربتك' : 'Share Your Experience' }}
            </h2>
            <p class="text-white/90 mb-6">
                {{ app()->getLocale() === 'ar' ? 'هل لديك قصة نجاح مع مؤسستنا؟ شاركها معنا وألهم الآخرين' : 'Do you have a success story with our organization? Share it with us and inspire others' }}
            </p>
            <a href="{{ route('contact.index') }}" 
               class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-charity-600 bg-white rounded-full hover:bg-gray-50 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                <i class="fas fa-pen {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                {{ app()->getLocale() === 'ar' ? 'أضف توصيتك' : 'Add Your Testimonial' }}
            </a>
        </div>
    </div>
</div>
@endsection 