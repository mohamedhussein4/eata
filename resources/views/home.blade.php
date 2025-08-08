@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section bg-gradient-to-r from-green-600 to-green-800 text-white py-20">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">جمعية إحسان الخيرية</h1>
            <p class="text-xl md:text-2xl mb-8">نساعد المحتاجين ونبني مستقبلاً أفضل للجميع</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('donations.index') }}" class="bg-white text-green-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition-colors">
                    تبرع الآن
                </a>
                <a href="{{ route('projects.index') }}" class="border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-green-600 transition-colors">
                    استكشف المشاريع
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-3xl md:text-4xl font-bold text-green-600 mb-2">{{ $featuredProjects->count() }}</div>
                <div class="text-gray-600">مشروع نشط</div>
            </div>
            <div>
                <div class="text-3xl md:text-4xl font-bold text-green-600 mb-2">{{ $testimonials->count() }}</div>
                <div class="text-gray-600">رأي إيجابي</div>
            </div>
            <div>
                <div class="text-3xl md:text-4xl font-bold text-green-600 mb-2">{{ $featuredStories->count() }}</div>
                <div class="text-gray-600">قصة نجاح</div>
            </div>
            <div>
                <div class="text-3xl md:text-4xl font-bold text-green-600 mb-2">1000+</div>
                <div class="text-gray-600">مستفيد</div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Projects Section -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">مشاريعنا المميزة</h2>
            <p class="text-gray-600 text-lg">اكتشف مشاريعنا الإنسانية وساعدنا في تحقيق أهدافنا</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredProjects as $project)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                <div class="h-48 bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                    <i class="fas fa-hands-helping text-white text-4xl"></i>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $project->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($project->description, 100) }}</p>
                    <div class="mb-4">
                        <div class="flex justify-between text-sm text-gray-500 mb-1">
                            <span>التقدم</span>
                            <span>{{ number_format(($project->total_amount - $project->remaining_amount) / $project->total_amount * 100, 1) }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-600 h-2 rounded-full" style="width: {{ ($project->total_amount - $project->remaining_amount) / $project->total_amount * 100 }}%"></div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">{{ number_format($project->total_amount - $project->remaining_amount) }} / {{ number_format($project->total_amount) }} ل.س</span>
                        <a href="{{ route('projects.show', $project->id) }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                            تبرع الآن
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('projects.index') }}" class="bg-green-600 text-white px-8 py-3 rounded-full font-semibold hover:bg-green-700 transition-colors">
                عرض جميع المشاريع
            </a>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">آراء المستفيدين</h2>
            <p class="text-gray-600 text-lg">استمع إلى قصص النجاح من المستفيدين من خدماتنا</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($testimonials as $testimonial)
            <div class="bg-white p-6 rounded-2xl shadow-lg">
                <div class="flex items-center mb-4">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $testimonial->rating)
                            <i class="fas fa-star text-yellow-400"></i>
                        @else
                            <i class="far fa-star text-gray-300"></i>
                        @endif
                    @endfor
                </div>
                <p class="text-gray-600 mb-4">{{ Str::limit($testimonial->content, 120) }}</p>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                        {{ substr($testimonial->name, 0, 1) }}
                    </div>
                    <div class="mr-3">
                        <div class="font-semibold text-gray-900">{{ $testimonial->name }}</div>
                        <div class="text-sm text-gray-500">{{ $testimonial->title }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-16 bg-green-600 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">ساعدنا في إحداث فرق</h2>
        <p class="text-xl mb-8">تبرعك مهما كان صغيراً يمكن أن يحدث فرقاً كبيراً في حياة شخص ما</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('donations.index') }}" class="bg-white text-green-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition-colors">
                تبرع الآن
            </a>
            <a href="{{ route('volunteers.index') }}" class="border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-green-600 transition-colors">
                تطوع معنا
            </a>
        </div>
    </div>
</section>
@endsection
