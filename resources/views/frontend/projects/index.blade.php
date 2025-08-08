@extends('frontend.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-[25vh]">
    <!-- Page Header -->
    <div class="text-center mb-12" data-aos="fade-up">
        <span class="inline-block px-6 py-2 text-sm font-medium text-charity-600 bg-charity-100 rounded-full mb-4">
            {{ app()->getLocale() === 'ar' ? '🎯 مشاريعنا الخيرية' : '🎯 Our Charity Projects' }}
        </span>
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 font-{{ app()->getLocale() === 'ar' ? 'arabic' : 'english' }}">
            {{ app()->getLocale() === 'ar' ? 'مشاريعنا الإنسانية' : 'Our Humanitarian Projects' }}
            <span class="block text-charity-600">
                {{ app()->getLocale() === 'ar' ? 'معاً نصنع الفرق' : 'Together We Make a Difference' }}
            </span>
        </h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
            {{ app()->getLocale() === 'ar' ? 'اكتشف مشاريعنا المختلفة وساعدنا في تحقيق أهدافنا الإنسانية' : 'Discover our various projects and help us achieve our humanitarian goals' }}
        </p>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-3xl shadow-xl p-6 mb-8" data-aos="fade-up">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" placeholder="{{ app()->getLocale() === 'ar' ? 'البحث في المشاريع...' : 'Search projects...' }}" 
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300">
            </div>
            <div class="flex gap-4">
                <select class="px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300">
                    <option value="">{{ app()->getLocale() === 'ar' ? 'جميع الحالات' : 'All Statuses' }}</option>
                    <option value="active">{{ app()->getLocale() === 'ar' ? 'نشط' : 'Active' }}</option>
                    <option value="completed">{{ app()->getLocale() === 'ar' ? 'مكتمل' : 'Completed' }}</option>
                </select>
                <select class="px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300">
                    <option value="">{{ app()->getLocale() === 'ar' ? 'ترتيب حسب' : 'Sort by' }}</option>
                    <option value="latest">{{ app()->getLocale() === 'ar' ? 'الأحدث' : 'Latest' }}</option>
                    <option value="oldest">{{ app()->getLocale() === 'ar' ? 'الأقدم' : 'Oldest' }}</option>
                    <option value="amount">{{ app()->getLocale() === 'ar' ? 'المبلغ' : 'Amount' }}</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Projects Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($projects as $project)
        <div class="group bg-white rounded-3xl shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500 border border-gray-100 overflow-hidden" data-aos="fade-up">
            <div class="h-48 bg-gradient-to-br from-charity-400 to-charity-600 flex items-center justify-center relative">
                @if($project->image_or_video)
                    <img src="{{ asset('storage/' . $project->image_or_video) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                @else
                <i class="fas fa-hands-helping text-white text-4xl"></i>
                @endif
                @if($project->status === 'completed')
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm text-charity-600 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ app()->getLocale() === 'ar' ? 'مكتمل' : 'Completed' }}
                </div>
                @endif
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-charity-600 transition-colors duration-300">
                    {{ $project->translated_title }}
                </h3>
                <p class="text-gray-600 mb-4">{{ Str::limit($project->translated_description, 120) }}</p>
                
                <!-- Progress Bar -->
                <div class="mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-gray-700">{{ app()->getLocale() === 'ar' ? 'التقدم' : 'Progress' }}</span>
                        <span class="text-sm font-medium text-charity-600">
                            {{ number_format(($project->total_amount - $project->remaining_amount) / $project->total_amount * 100, 1) }}%
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-gradient-to-r from-charity-500 to-charity-600 h-2 rounded-full transition-all duration-500" 
                             style="width: {{ ($project->total_amount - $project->remaining_amount) / $project->total_amount * 100 }}%">
                        </div>
                    </div>
                </div>

                <!-- Project Stats -->
                <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
                    <div>
                        <div class="font-semibold text-charity-600">{{ number_format($project->total_amount - $project->remaining_amount) }}</div>
                        <div class="text-gray-500">{{ app()->getLocale() === 'ar' ? 'محصل' : 'Raised' }}</div>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-600">{{ number_format($project->total_amount) }}</div>
                        <div class="text-gray-500">{{ app()->getLocale() === 'ar' ? 'المطلوب' : 'Goal' }}</div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-2">
                    <a href="{{ route('projects.show', $project->id) }}" 
                       class="flex-1 bg-gradient-to-r from-charity-500 to-charity-600 hover:from-charity-600 hover:to-charity-700 text-white text-center py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        {{ app()->getLocale() === 'ar' ? 'عرض التفاصيل' : 'View Details' }}
                    </a>
                    <a href="{{ route('donations.index') }}" 
                       class="bg-white border-2 border-charity-600 text-charity-600 px-4 py-3 rounded-xl hover:bg-charity-50 transition-colors">
                        <i class="fas fa-heart"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if($projects->hasPages())
    <div class="mt-12" data-aos="fade-up">
        {{ $projects->links() }}
    </div>
    @endif

    <!-- Call to Action -->
    <div class="bg-gradient-to-r from-charity-600 via-charity-700 to-charity-800 text-white rounded-3xl p-8 mt-12 text-center relative overflow-hidden" data-aos="fade-up">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-64 h-64 bg-white rounded-full filter blur-3xl animate-float"></div>
            <div class="absolute bottom-10 right-10 w-48 h-48 bg-warm-300 rounded-full filter blur-3xl animate-float animation-delay-200"></div>
        </div>
        <div class="relative z-10">
            <h2 class="text-2xl font-bold mb-4">{{ app()->getLocale() === 'ar' ? 'ساعدنا في إحداث فرق' : 'Help Us Make a Difference' }}</h2>
            <p class="text-white/90 mb-6">{{ app()->getLocale() === 'ar' ? 'تبرعك مهما كان صغيراً يمكن أن يحدث فرقاً كبيراً في حياة شخص ما' : 'Your donation, no matter how small, can make a big difference in someone\'s life' }}</p>
            <a href="{{ route('donations.index') }}" 
               class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-charity-600 bg-white rounded-full hover:bg-gray-50 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                <i class="fas fa-heart {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                {{ app()->getLocale() === 'ar' ? 'تبرع الآن' : 'Donate Now' }}
        </a>
        </div>
    </div>
</div>
@endsection 