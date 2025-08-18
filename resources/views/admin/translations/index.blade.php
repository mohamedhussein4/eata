@extends('layouts.dashboard')

@section('page-title', 'إدارة الترجمات')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">إدارة الترجمات</h1>
                <p class="text-gray-600 mt-2">إدارة وترجمة المحتوى متعدد اللغات</p>

                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">الترجمات</span>
                </nav>
            </div>

        </div>
    </div>

    {{-- Translation Categories --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Projects --}}
        <a href="{{ route('admin.translations.projects') }}" class="block bg-white rounded-3xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-project-diagram text-white"></i>
                </div>
                <span class="text-sm text-gray-500">{{ $projectsCount ?? 0 }}</span>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">المشاريع</h3>
            <p class="text-gray-600 text-sm">إدارة ترجمة المشاريع</p>
        </a>

        {{-- Pages --}}
        <a href="{{ route('admin.translations.pages') }}" class="block bg-white rounded-3xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-file-alt text-white"></i>
                </div>
                <span class="text-sm text-gray-500">{{ $pagesCount ?? 0 }}</span>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">الصفحات</h3>
            <p class="text-gray-600 text-sm">إدارة ترجمة الصفحات</p>
        </a>

        {{-- Testimonials --}}
        <a href="{{ route('admin.translations.testimonials') }}" class="block bg-white rounded-3xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-star text-white"></i>
                </div>
                <span class="text-sm text-gray-500">{{ $testimonialsCount ?? 0 }}</span>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">الآراء</h3>
            <p class="text-gray-600 text-sm">إدارة ترجمة آراء العملاء</p>
        </a>

        {{-- Stories --}}
        <a href="{{ route('admin.translations.stories') }}" class="block bg-white rounded-3xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-book text-white"></i>
                </div>
                <span class="text-sm text-gray-500">{{ $storiesCount ?? 0 }}</span>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">القصص</h3>
            <p class="text-gray-600 text-sm">إدارة ترجمة قصص المستفيدين</p>
        </a>
    </div>

    {{-- Translation Statistics --}}
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
        <h2 class="text-xl font-bold text-gray-900 mb-6">إحصائيات الترجمة</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Arabic Content --}}
            <div class="text-center">
                <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-globe text-white text-xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">{{ $arabicContent ?? 0 }}</h3>
                <p class="text-gray-600">المحتوى العربي</p>
            </div>

            {{-- English Content --}}
            <div class="text-center">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-language text-white text-xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">{{ $englishContent ?? 0 }}</h3>
                <p class="text-gray-600">المحتوى الإنجليزي</p>
            </div>

            {{-- Translation Progress --}}
            <div class="text-center">
                <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chart-pie text-white text-xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">{{ $translationProgress ?? 0 }}%</h3>
                <p class="text-gray-600">نسبة الترجمة</p>
                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-2">
                    <div class="bg-purple-600 h-1.5 rounded-full" style="width: {{ $translationProgress ?? 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
        <h2 class="text-xl font-bold text-gray-900 mb-6">إجراءات سريعة</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <button onclick="syncTranslations()" class="inline-flex items-center justify-center px-4 py-3 text-sm font-medium text-blue-700 bg-blue-100 hover:bg-blue-200 rounded-2xl transition-all duration-300">
                <i class="fas fa-sync {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                مزامنة الترجمات
            </button>

            <a href="{{ route('admin.translations.export') }}" class="inline-flex items-center justify-center px-4 py-3 text-sm font-medium text-green-700 bg-green-100 hover:bg-green-200 rounded-2xl transition-all duration-300">
                <i class="fas fa-download {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                تصدير الترجمات
            </a>

            <button onclick="document.getElementById('importFile').click()" class="inline-flex items-center justify-center px-4 py-3 text-sm font-medium text-orange-700 bg-orange-100 hover:bg-orange-200 rounded-2xl transition-all duration-300">
                <i class="fas fa-upload {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                استيراد ترجمات
            </button>

            <a href="{{ route('admin.translations.statistics') }}" class="inline-flex items-center justify-center px-4 py-3 text-sm font-medium text-purple-700 bg-purple-100 hover:bg-purple-200 rounded-2xl transition-all duration-300">
                <i class="fas fa-chart-bar {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                إحصائيات مفصلة
            </a>
        </div>
    </div>
</div>

{{-- Hidden Import File Input --}}
<form id="importForm" action="{{ route('admin.translations.import') }}" method="POST" enctype="multipart/form-data" style="display: none;">
    @csrf
    <input type="file" id="importFile" name="file" accept=".json,.csv" onchange="document.getElementById('importForm').submit()">
</form>

<script>
function syncTranslations() {
    if (confirm('هل أنت متأكد من مزامنة جميع الترجمات؟')) {
        fetch('{{ route("admin.translations.sync") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('تم تحديث الترجمات بنجاح');
                location.reload();
            } else {
                alert('حدث خطأ أثناء التحديث');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('حدث خطأ أثناء التحديث');
        });
    }
}
</script>
@endsection
