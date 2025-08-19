@extends('frontend.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-20">
    <!-- Breadcrumbs -->
    <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mb-8" data-aos="fade-right">
        <a href="{{ route('home') }}" class="text-gray-500 hover:text-charity-600 transition-colors">
            <i class="fas fa-home"></i>
        </a>
        <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
        <a href="{{ route('projects.index') }}" class="text-gray-500 hover:text-charity-600 transition-colors">
            {{ app()->getLocale() === 'ar' ? 'المشاريع' : 'Projects' }}
        </a>
        <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
        <span class="text-gray-700 font-medium">{{ $project->translated_title }}</span>
    </nav>

    <!-- Project Header -->
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden mb-8" data-aos="fade-up">
        <div class="h-64 bg-gradient-to-br from-charity-400 to-charity-600 flex items-center justify-center relative">
            @if($project->image_or_video)
                <img src="{{ asset('/' . $project->image_or_video) }}" alt="{{ $project->translated_title }}" class="w-full h-full object-cover">
            @else
                <i class="fas fa-hands-helping text-white text-6xl"></i>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
        </div>
        <div class="p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $project->translated_title }}</h1>
            <p class="text-gray-600 text-lg mb-6">{{ $project->translated_description }}</p>

            <!-- Progress Bar -->
            <div class="mb-6">
                <div class="flex justify-between text-sm text-gray-500 mb-2">
                    <span>{{ app()->getLocale() === 'ar' ? 'التقدم' : 'Progress' }}</span>
                    <span>{{ number_format(($project->total_amount - $project->remaining_amount) / $project->total_amount * 100, 1) }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-gradient-to-r from-charity-500 to-charity-600 h-3 rounded-full transition-all duration-500"
                         style="width: {{ ($project->total_amount - $project->remaining_amount) / $project->total_amount * 100 }}%">
                    </div>
                </div>
            </div>

            <!-- Project Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="text-center group">
                    <div class="text-2xl font-bold text-charity-600 group-hover:scale-110 transition-transform duration-300">
                        {{ number_format($project->total_amount - $project->remaining_amount) }}
                    </div>
                    <div class="text-sm text-gray-500">{{ app()->getLocale() === 'ar' ? 'المبلغ المحصل' : 'Amount Raised' }}</div>
                </div>
                <div class="text-center group">
                    <div class="text-2xl font-bold text-charity-600 group-hover:scale-110 transition-transform duration-300">
                        {{ number_format($project->remaining_amount) }}
                    </div>
                    <div class="text-sm text-gray-500">{{ app()->getLocale() === 'ar' ? 'المبلغ المتبقي' : 'Remaining Amount' }}</div>
                </div>
                <div class="text-center group">
                    <div class="text-2xl font-bold text-charity-600 group-hover:scale-110 transition-transform duration-300">
                        {{ number_format($project->visits) }}
                    </div>
                    <div class="text-sm text-gray-500">{{ app()->getLocale() === 'ar' ? 'عدد المشاهدات' : 'Views' }}</div>
                </div>
                <div class="text-center group">
                    <div class="text-2xl font-bold text-charity-600 group-hover:scale-110 transition-transform duration-300">
                        {{ $project->donation_count ?? 0 }}
                    </div>
                    <div class="text-sm text-gray-500">{{ app()->getLocale() === 'ar' ? 'عدد المتبرعين' : 'Donors' }}</div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('donations.index') }}"
                   class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-charity-500 to-charity-600 rounded-full hover:from-charity-600 hover:to-charity-700 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl text-center">
                    <i class="fas fa-heart {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} group-hover:animate-pulse"></i>
                    {{ app()->getLocale() === 'ar' ? 'تبرع الآن' : 'Donate Now' }}
                </a>
                <button class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-charity-600 bg-white border-2 border-charity-600 rounded-full hover:bg-charity-50 transition-colors">
                    <i class="fas fa-share {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} group-hover:animate-pulse"></i>
                    {{ app()->getLocale() === 'ar' ? 'شارك المشروع' : 'Share Project' }}
                </button>
            </div>
        </div>
    </div>

    <!-- Project Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-3xl shadow-xl p-8 mb-8" data-aos="fade-up">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                    {{ app()->getLocale() === 'ar' ? 'تفاصيل المشروع' : 'Project Details' }}
                </h2>
                <div class="prose max-w-none">
                    {!! $project->translated_content !!}
                </div>
            </div>

            <!-- Related Projects -->
            @if($relatedProjects->count() > 0)
            <div class="bg-white rounded-3xl shadow-xl p-8" data-aos="fade-up">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                    {{ app()->getLocale() === 'ar' ? 'مشاريع مشابهة' : 'Similar Projects' }}
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($relatedProjects as $relatedProject)
                    <div class="group bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                        <h3 class="font-semibold text-gray-900 mb-2 group-hover:text-charity-600 transition-colors">
                            {{ $relatedProject->translated_title }}
                        </h3>
                        <p class="text-gray-600 text-sm mb-3">{{ Str::limit($relatedProject->translated_description, 100) }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">
                                {{ number_format($relatedProject->total_amount - $relatedProject->remaining_amount) }} /
                                {{ number_format($relatedProject->total_amount) }}
                                {{ app()->getLocale() === 'ar' ? 'ل.س' : 'SYP' }}
                            </span>
                            <a href="{{ route('projects.show', $relatedProject->id) }}"
                               class="text-charity-600 hover:text-charity-700 text-sm font-semibold group-hover:translate-x-1 transition-all duration-300">
                                {{ app()->getLocale() === 'ar' ? 'عرض التفاصيل' : 'View Details' }}
                                <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} ml-1"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Project Info Card -->
            <div class="bg-white rounded-3xl shadow-xl p-6 mb-6" data-aos="fade-left">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'ar' ? 'معلومات المشروع' : 'Project Information' }}
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">{{ app()->getLocale() === 'ar' ? 'الحالة' : 'Status' }}:</span>
                        <span class="font-semibold text-charity-600">
                            {{ $project->status === 'active' ?
                                (app()->getLocale() === 'ar' ? 'نشط' : 'Active') :
                                (app()->getLocale() === 'ar' ? 'مكتمل' : 'Completed') }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">{{ app()->getLocale() === 'ar' ? 'تاريخ البدء' : 'Start Date' }}:</span>
                        <span class="font-semibold">{{ $project->created_at->format('Y-m-d') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">{{ app()->getLocale() === 'ar' ? 'عدد المستفيدين' : 'Beneficiaries' }}:</span>
                        <span class="font-semibold">{{ $project->beneficiaries_count ?? 0 }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Donation Card -->
            <div class="bg-gradient-to-r from-charity-500 to-charity-600 text-white rounded-3xl p-6" data-aos="fade-left">
                <h3 class="text-lg font-semibold mb-4">{{ app()->getLocale() === 'ar' ? 'تبرع سريع' : 'Quick Donation' }}</h3>
                <p class="text-white/90 mb-4">
                    {{ app()->getLocale() === 'ar' ? 'ساعدنا في تحقيق هذا المشروع بتبرعك' : 'Help us achieve this project with your donation' }}
                </p>
                <a href="{{ route('donations.index', ['project_id' => $project->id]) }}"
                   class="block w-full bg-white text-charity-600 text-center py-3 rounded-xl font-semibold hover:bg-gray-50 transition-colors transform hover:scale-105">
                    {{ app()->getLocale() === 'ar' ? 'تبرع الآن' : 'Donate Now' }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
