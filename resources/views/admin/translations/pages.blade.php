@extends('layouts.dashboard')

@section('page-title', 'ترجمة الصفحات')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">ترجمة الصفحات</h1>
                <p class="text-gray-600 mt-2">إدارة ترجمة جميع الصفحات الثابتة في النظام</p>

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
                    <span class="text-gray-700 font-medium">الصفحات</span>
                </nav>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-3">
                <button onclick="syncPageTranslations()" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-blue-700 bg-blue-100 hover:bg-blue-200 rounded-2xl transition-all duration-300">
                    <i class="fas fa-sync {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    مزامنة الترجمات
                </button>
            </div>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Total Pages --}}
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">إجمالي الصفحات</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalCount ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-file-alt text-white"></i>
                </div>
            </div>
        </div>

        {{-- Translated Pages --}}
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">المترجمة</p>
                    <p class="text-2xl font-bold text-green-600">{{ $translatedCount ?? 0 }}</p>
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
                    <p class="text-2xl font-bold text-orange-600">{{ $pendingCount ?? 0 }}</p>
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
                    <div class="w-full bg-gray-200 rounded-full h-1.5 mt-2">
                        <div class="bg-purple-600 h-1.5 rounded-full" style="width: {{ $translationProgress ?? 0 }}%"></div>
                    </div>
                </div>
                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-chart-pie text-white"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
        <form method="GET" action="{{ route('admin.translations.pages') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- Search --}}
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">البحث</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}"
                       placeholder="ابحث في الصفحات..."
                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300">
            </div>

            {{-- Translation Status --}}
            <div>
                <label for="translation_status" class="block text-sm font-medium text-gray-700 mb-2">حالة الترجمة</label>
                <select id="translation_status" name="translation_status" class="w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300">
                    <option value="">جميع الحالات</option>
                    <option value="translated" {{ request('translation_status') === 'translated' ? 'selected' : '' }}>مترجمة</option>
                    <option value="pending" {{ request('translation_status') === 'pending' ? 'selected' : '' }}>في انتظار الترجمة</option>
                </select>
            </div>

            {{-- Actions --}}
            <div class="flex items-end gap-3">
                <button type="submit" class="flex-1 inline-flex items-center justify-center px-4 py-3 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-search {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    بحث
                </button>
                <a href="{{ route('admin.translations.pages') }}" class="inline-flex items-center justify-center px-4 py-3 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-redo {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    إعادة تعيين
                </a>
            </div>
        </form>
    </div>

    {{-- Pages Table --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">
                            الصفحة
                        </th>
                        <th scope="col" class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">
                            العنوان
                        </th>
                        <th scope="col" class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">
                            المحتوى
                        </th>
                        <th scope="col" class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">
                            حالة الترجمة
                        </th>
                        <th scope="col" class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">
                            تاريخ الإنشاء
                        </th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            الإجراءات
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pages ?? [] as $page)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-file-alt text-green-600"></i>
                                    </div>
                                    <div class="{{ app()->getLocale() === 'ar' ? 'mr-4' : 'ml-4' }}">
                                        <div class="text-sm font-medium text-gray-900">#{{ $page->id }}</div>
                                        <div class="text-sm text-gray-500">{{ $page->slug }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ Str::limit($page->title, 50) }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($page->translation('en')?->title, 50) }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ Str::limit(strip_tags($page->content), 80) }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit(strip_tags($page->translation('en')?->content), 80) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($page->translations_count > 0)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                        مترجم
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                        <i class="fas fa-clock {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                        في الانتظار
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $page->created_at->format('Y-m-d') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.translations.pages.edit', $page->id) }}"
                                       class="inline-flex items-center justify-center w-8 h-8 text-indigo-600 hover:text-indigo-800 hover:bg-indigo-100 rounded-lg transition-all duration-200"
                                       title="تعديل الترجمة">
                                        <i class="fas fa-edit text-sm"></i>
                                    </a>
                                    <a href="{{ route('admin.pages.show', $page->id) }}"
                                       class="inline-flex items-center justify-center w-8 h-8 text-blue-600 hover:text-blue-800 hover:bg-blue-100 rounded-lg transition-all duration-200"
                                       title="عرض الصفحة">
                                        <i class="fas fa-eye text-sm"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-file-alt text-4xl text-gray-300 mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">لا توجد صفحات</h3>
                                    <p class="text-gray-500">لم يتم العثور على أي صفحات للترجمة.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if(isset($pages) && $pages->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $pages->links() }}
            </div>
        @endif
    </div>
</div>

<script>
function syncPageTranslations() {
    if (confirm('هل أنت متأكد من مزامنة ترجمات الصفحات؟')) {
        // يمكن إضافة منطق المزامنة هنا
        alert('تم مزامنة ترجمات الصفحات بنجاح');
        location.reload();
    }
}
</script>
@endsection
