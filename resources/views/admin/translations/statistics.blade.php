@extends('layouts.dashboard')

@section('page-title', 'إحصائيات الترجمات')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">إحصائيات الترجمات</h1>
                <p class="text-gray-600 mt-2">إحصائيات مفصلة عن حالة الترجمات في النظام</p>

                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <a href="{{ route('admin.translations.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        الترجمات
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">الإحصائيات</span>
                </nav>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-3">
                <button onclick="refreshStatistics()" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-blue-700 bg-blue-100 hover:bg-blue-200 rounded-2xl transition-all duration-300">
                    <i class="fas fa-sync {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    تحديث الإحصائيات
                </button>
                <a href="{{ route('admin.translations.export') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-green-700 bg-green-100 hover:bg-green-200 rounded-2xl transition-all duration-300">
                    <i class="fas fa-download {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    تصدير التقرير
                </a>
            </div>
        </div>
    </div>

    {{-- Overall Statistics --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Total Content --}}
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">إجمالي المحتوى</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalContent ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-globe text-white"></i>
                </div>
            </div>
        </div>

        {{-- Translated Content --}}
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">المحتوى المترجم</p>
                    <p class="text-2xl font-bold text-green-600">{{ $translatedContent ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-white"></i>
                </div>
            </div>
        </div>

        {{-- Pending Translation --}}
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">في انتظار الترجمة</p>
                    <p class="text-2xl font-bold text-orange-600">{{ $pendingTranslation ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-clock text-white"></i>
                </div>
            </div>
        </div>

        {{-- Translation Progress --}}
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">نسبة الترجمة</p>
                    <p class="text-2xl font-bold text-purple-600">{{ $translationProgress ?? 0 }}%</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-chart-pie text-white"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Detailed Statistics by Category --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Projects Statistics --}}
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-project-diagram text-blue-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    إحصائيات المشاريع
                </h3>
                <a href="{{ route('admin.translations.projects') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                    عرض التفاصيل
                </a>
            </div>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">إجمالي المشاريع</span>
                    <span class="text-sm font-medium text-gray-900">{{ $projectsStats['total'] ?? 0 }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">المترجمة</span>
                    <span class="text-sm font-medium text-green-600">{{ $projectsStats['translated'] ?? 0 }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">في الانتظار</span>
                    <span class="text-sm font-medium text-orange-600">{{ $projectsStats['pending'] ?? 0 }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $projectsStats['progress'] ?? 0 }}%"></div>
                </div>
                <div class="text-center text-sm text-gray-500">{{ $projectsStats['progress'] ?? 0 }}% مكتمل</div>
            </div>
        </div>

        {{-- Pages Statistics --}}
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-file-alt text-green-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    إحصائيات الصفحات
                </h3>
                <a href="{{ route('admin.translations.pages') }}" class="text-green-600 hover:text-green-800 text-sm">
                    عرض التفاصيل
                </a>
            </div>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">إجمالي الصفحات</span>
                    <span class="text-sm font-medium text-gray-900">{{ $pagesStats['total'] ?? 0 }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">المترجمة</span>
                    <span class="text-sm font-medium text-green-600">{{ $pagesStats['translated'] ?? 0 }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">في الانتظار</span>
                    <span class="text-sm font-medium text-orange-600">{{ $pagesStats['pending'] ?? 0 }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-green-600 h-2 rounded-full" style="width: {{ $pagesStats['progress'] ?? 0 }}%"></div>
                </div>
                <div class="text-center text-sm text-gray-500">{{ $pagesStats['progress'] ?? 0 }}% مكتمل</div>
            </div>
        </div>

        {{-- Testimonials Statistics --}}
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-star text-orange-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    إحصائيات الآراء
                </h3>
                <a href="{{ route('admin.translations.testimonials') }}" class="text-orange-600 hover:text-orange-800 text-sm">
                    عرض التفاصيل
                </a>
            </div>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">إجمالي الآراء</span>
                    <span class="text-sm font-medium text-gray-900">{{ $testimonialsStats['total'] ?? 0 }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">المترجمة</span>
                    <span class="text-sm font-medium text-green-600">{{ $testimonialsStats['translated'] ?? 0 }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">في الانتظار</span>
                    <span class="text-sm font-medium text-orange-600">{{ $testimonialsStats['pending'] ?? 0 }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-orange-600 h-2 rounded-full" style="width: {{ $testimonialsStats['progress'] ?? 0 }}%"></div>
                </div>
                <div class="text-center text-sm text-gray-500">{{ $testimonialsStats['progress'] ?? 0 }}% مكتمل</div>
            </div>
        </div>

        {{-- Stories Statistics --}}
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-book text-purple-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    إحصائيات القصص
                </h3>
                <a href="{{ route('admin.translations.stories') }}" class="text-purple-600 hover:text-purple-800 text-sm">
                    عرض التفاصيل
                </a>
            </div>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">إجمالي القصص</span>
                    <span class="text-sm font-medium text-gray-900">{{ $storiesStats['total'] ?? 0 }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">المترجمة</span>
                    <span class="text-sm font-medium text-green-600">{{ $storiesStats['translated'] ?? 0 }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">في الانتظار</span>
                    <span class="text-sm font-medium text-orange-600">{{ $storiesStats['pending'] ?? 0 }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $storiesStats['progress'] ?? 0 }}%"></div>
                </div>
                <div class="text-center text-sm text-gray-500">{{ $storiesStats['progress'] ?? 0 }}% مكتمل</div>
            </div>
        </div>
    </div>

    {{-- Recent Translation Activity --}}
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">
            <i class="fas fa-history text-indigo-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
            النشاط الأخير في الترجمة
        </h3>
        
        <div class="space-y-4">
            @forelse($recentActivity ?? [] as $activity)
                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-2xl">
                    <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-edit text-indigo-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">{{ $activity['action'] }}</p>
                        <p class="text-sm text-gray-500">{{ $activity['item'] }} - {{ $activity['date'] }}</p>
                    </div>
                    <div class="text-sm text-gray-400">{{ $activity['time'] }}</div>
                </div>
            @empty
                <div class="text-center py-8">
                    <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">لا يوجد نشاط حديث في الترجمة</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Translation Recommendations --}}
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-3xl p-6 border border-blue-200">
        <h3 class="text-lg font-semibold text-blue-900 mb-4">
            <i class="fas fa-lightbulb text-blue-600 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
            توصيات الترجمة
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white rounded-2xl p-4">
                <h4 class="font-medium text-gray-900 mb-2">الأولوية العالية</h4>
                <p class="text-sm text-gray-600">ركز على ترجمة المحتوى الأكثر زيارة من المستخدمين</p>
            </div>
            <div class="bg-white rounded-2xl p-4">
                <h4 class="font-medium text-gray-900 mb-2">التحسين المستمر</h4>
                <p class="text-sm text-gray-600">راجع الترجمات الموجودة بانتظام لتحسين الجودة</p>
            </div>
        </div>
    </div>
</div>

<script>
function refreshStatistics() {
    if (confirm('هل تريد تحديث الإحصائيات؟')) {
        location.reload();
    }
}
</script>
@endsection
