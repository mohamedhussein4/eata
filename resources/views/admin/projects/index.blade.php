@extends('layouts.dashboard')

@section('title', 'المشاريع')
@section('page-title', 'إدارة المشاريع')

@section('content')
<x-admin-layout title="إدارة المشاريع" subtitle="قم بإدارة جميع المشاريع والتحكم في حالتها وبياناتها" :breadcrumbs="[['name' => 'المشاريع', 'url' => '#']]">

    <x-slot name="headerActions">
        <x-admin-button href="{{ route('admin.projects.create') }}" icon="fas fa-plus" variant="primary">
            إضافة مشروع جديد
        </x-admin-button>
    </x-slot>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <x-stat-card
            title="إجمالي المشاريع"
            :value="$projects->total() ?? 0"
            icon="fas fa-project-diagram"
            color="blue"
            trend="up"
            trendValue="+12%" />

        <x-stat-card
            title="المشاريع النشطة"
            :value="$projects->where('status', '!=', 'completed')->count()"
            icon="fas fa-play-circle"
            color="green"
            trend="up"
            trendValue="+8%" />

        <x-stat-card
            title="إجمالي المستفيدين"
            :value="$projects->sum('beneficiaries_count')"
            icon="fas fa-users"
            color="orange"
            trend="up"
            trendValue="+15%" />

        <x-stat-card
            title="إجمالي التبرعات"
            :value="$projects->sum('donation_count')"
            icon="fas fa-hand-holding-heart"
            color="purple"
            trend="up"
            trendValue="+23%" />
    </div>

    {{-- Search and Filter Section --}}
    <x-admin-card title="البحث والتصفية" icon="fas fa-filter">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">البحث</label>
                <div class="relative">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="ابحث في المشاريع..."
                           class="w-full {{ app()->getLocale() === 'ar' ? 'pr-12 pl-4' : 'pl-12 pr-4' }} py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-all duration-300">
                    <i class="fas fa-search absolute {{ app()->getLocale() === 'ar' ? 'right-4' : 'left-4' }} top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">الحالة</label>
                <select name="status" class="w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-all duration-300">
                    <option value="">جميع الحالات</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>نشط</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>مكتمل</option>
                    <option value="paused" {{ request('status') === 'paused' ? 'selected' : '' }}>متوقف</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">ترتيب حسب</label>
                <select name="sort" class="w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-all duration-300">
                    <option value="created_at_desc" {{ request('sort') === 'created_at_desc' ? 'selected' : '' }}>الأحدث أولاً</option>
                    <option value="created_at_asc" {{ request('sort') === 'created_at_asc' ? 'selected' : '' }}>الأقدم أولاً</option>
                    <option value="title_asc" {{ request('sort') === 'title_asc' ? 'selected' : '' }}>ترتيب أبجدي</option>
                    <option value="total_amount_desc" {{ request('sort') === 'total_amount_desc' ? 'selected' : '' }}>أعلى مبلغ</option>
                </select>
            </div>

            <div class="flex items-end gap-3">
                <x-admin-button type="submit" icon="fas fa-filter" variant="primary" class="flex-1">
                    تصفية
                </x-admin-button>
                <x-admin-button href="{{ route('admin.projects.index') }}" variant="secondary" class="flex-1">
                    إعادة تعيين
                </x-admin-button>
            </div>
        </form>
    </x-admin-card>

    {{-- Projects Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse($projects as $project)
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:border-gray-200 transition-all duration-300 group">
            {{-- Project Image --}}
            <div class="relative h-48 bg-gradient-to-br from-slate-500 to-slate-700">
                @if($project->image_or_video)
                    <img src="{{ asset('storage/images/' . $project->image_or_video) }}"
                         alt="{{ $project->translated_title }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-white">
                        <i class="fas fa-project-diagram text-6xl opacity-50"></i>
                    </div>
                @endif

                {{-- Status Badge --}}
                <div class="absolute top-4 {{ app()->getLocale() === 'ar' ? 'left-4' : 'right-4' }}">
                    <span class="bg-green-500 text-white text-xs px-3 py-1.5 rounded-full font-medium shadow-lg">
                        نشط
                    </span>
                </div>

                {{-- Language Indicators --}}
                <div class="absolute bottom-4 {{ app()->getLocale() === 'ar' ? 'left-4' : 'right-4' }} flex gap-2">
                    @if($project->translations->where('locale', 'ar')->count())
                        <span class="bg-white bg-opacity-90 text-xs px-2 py-1 rounded-lg text-gray-700 font-medium">AR</span>
                    @endif
                    @if($project->translations->where('locale', 'en')->count())
                        <span class="bg-white bg-opacity-90 text-xs px-2 py-1 rounded-lg text-gray-700 font-medium">EN</span>
                    @endif
                </div>
            </div>

            {{-- Project Content --}}
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-900 flex-1 line-clamp-2">
                        {{ $project->translated_title ?: $project->title }}
                    </h3>
                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-lg {{ app()->getLocale() === 'ar' ? 'mr-3' : 'ml-3' }}">
                        #{{ $project->id }}
                    </span>
                </div>

                <p class="text-gray-600 text-sm mb-6 line-clamp-3">
                    {{ Str::limit($project->translated_description ?: $project->description, 120) }}
                </p>

                {{-- Project Stats --}}
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="text-center p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-2xl">
                        <p class="text-2xl font-bold text-blue-600">{{ number_format($project->total_amount) }}</p>
                        <p class="text-xs text-gray-600 font-medium mt-1">إجمالي المبلغ</p>
                    </div>
                    <div class="text-center p-4 bg-gradient-to-r from-green-50 to-green-100 rounded-2xl">
                        <p class="text-2xl font-bold text-green-600">{{ $project->beneficiaries_count }}</p>
                        <p class="text-xs text-gray-600 font-medium mt-1">المستفيدين</p>
                    </div>
                </div>

                {{-- Progress Bar --}}
                <div class="mb-6">
                    <div class="flex justify-between text-sm text-gray-600 mb-2 font-medium">
                        <span>التقدم</span>
                        <span>{{ number_format(($project->total_amount - $project->remaining_amount) / $project->total_amount * 100, 1) }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-gradient-to-r from-slate-500 to-slate-600 h-3 rounded-full transition-all duration-500"
                             style="width: {{ ($project->total_amount - $project->remaining_amount) / $project->total_amount * 100 }}%"></div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex gap-3">
                    {{-- <x-admin-button href="{{ route('admin.projects.show', $project->id) }}"
                                   variant="outline"
                                   size="sm"
                                   icon="fas fa-eye"
                                   class="flex-1">
                        عرض
                    </x-admin-button> --}}

                    <x-admin-button href="{{ route('admin.projects.edit', $project->id) }}"
                                   variant="secondary"
                                   size="sm"
                                   icon="fas fa-edit"
                                   class="flex-1">
                        تعديل
                    </x-admin-button>

                    <x-admin-button onclick="deleteProject({{ $project->id }})"
                                   variant="danger"
                                   size="sm"
                                   icon="fas fa-trash">
                    </x-admin-button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full">
            <x-admin-card padding="p-12">
                <div class="text-center">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-project-diagram text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">لا توجد مشاريع</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">لم يتم العثور على أي مشاريع. ابدأ بإنشاء مشروعك الأول لمساعدة المحتاجين.</p>
                    <x-admin-button href="{{ route('admin.projects.create') }}"
                                   variant="primary"
                                   icon="fas fa-plus">
                        إنشاء أول مشروع
                    </x-admin-button>
                </div>
            </x-admin-card>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($projects->hasPages())
    <div class="flex justify-center">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
            {{ $projects->links() }}
        </div>
    </div>
    @endif
</x-admin-layout>

{{-- Delete Confirmation Modal --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
    <div class="bg-white rounded-3xl p-8 m-4 max-w-md w-full shadow-2xl transform transition-all">
        <div class="text-center">
            <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-exclamation-triangle text-red-600 text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">حذف المشروع</h3>
            <p class="text-gray-600 mb-8">هل أنت متأكد من حذف هذا المشروع؟ لن تتمكن من التراجع عن هذا الإجراء.</p>
            <div class="flex gap-4">
                <x-admin-button onclick="closeDeleteModal()" variant="secondary" class="flex-1">
                    إلغاء
                </x-admin-button>
                <form id="deleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <x-admin-button type="submit" variant="danger" class="w-full">
                        حذف
                    </x-admin-button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function deleteProject(projectId) {
    document.getElementById('deleteForm').action = `/admin/projects/${projectId}`;
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
}

// Close modal when clicking outside
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});
</script>
@endsection
