@extends('layouts.dashboard')

@section('title', __('messages.pages'))
@section('page-title', __('messages.pages_management'))

@section('content')
<div class="space-y-6">
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">{{ __('messages.all_pages') }}</h2>
            <p class="text-gray-600 mt-1">{{ __('messages.manage_all_pages_desc') }}</p>
        </div>
        <div class="flex items-center space-x-3 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
            <a href="{{ route('admin.pages.create') }}"
               class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-6 py-3 rounded-lg hover:shadow-lg transform hover:scale-105 transition-all duration-300 flex items-center">
                <i class="fas fa-plus {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                {{ __('messages.add_new_page') }}
            </a>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">{{ __('messages.total_pages') }}</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $pages->total() ?? 0 }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-file-alt text-blue-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">{{ __('messages.active_pages') }}</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $pages->where('is_active', true)->count() }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-check-circle text-green-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">{{ __('messages.draft_pages') }}</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $pages->where('is_active', false)->count() }}</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <i class="fas fa-edit text-yellow-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">{{ __('messages.translated_pages') }}</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $pages->filter(function($page) { return $page->translations->count() > 0; })->count() }}</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <i class="fas fa-language text-purple-600"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Search and Filter Section --}}
    <div class="bg-white rounded-xl shadow-lg p-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.search') }}</label>
                <div class="relative">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="{{ __('messages.search_pages') }}"
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.status') }}</label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="">{{ __('messages.all_statuses') }}</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>{{ __('messages.active') }}</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>{{ __('messages.draft') }}</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.sort_by') }}</label>
                <select name="sort" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="sort_order" {{ request('sort') === 'sort_order' ? 'selected' : '' }}>{{ __('messages.sort_order') }}</option>
                    <option value="created_at_desc" {{ request('sort') === 'created_at_desc' ? 'selected' : '' }}>{{ __('messages.newest_first') }}</option>
                    <option value="created_at_asc" {{ request('sort') === 'created_at_asc' ? 'selected' : '' }}>{{ __('messages.oldest_first') }}</option>
                    <option value="title_asc" {{ request('sort') === 'title_asc' ? 'selected' : '' }}>{{ __('messages.title_asc') }}</option>
                    <option value="title_desc" {{ request('sort') === 'title_desc' ? 'selected' : '' }}>{{ __('messages.title_desc') }}</option>
                </select>
            </div>

            <div class="flex items-end space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                <button type="submit"
                        class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition-colors flex items-center">
                    <i class="fas fa-filter {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    {{ __('messages.filter') }}
                </button>
                <a href="{{ route('admin.pages.index') }}"
                   class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition-colors">
                    {{ __('messages.reset') }}
                </a>
            </div>
        </form>
    </div>

    {{-- Pages Table --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('messages.page') }}
                        </th>
                        <th class="px-6 py-3 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('messages.status') }}
                        </th>
                        <th class="px-6 py-3 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('messages.translations') }}
                        </th>
                        <th class="px-6 py-3 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('messages.created_at') }}
                        </th>
                        <th class="px-6 py-3 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('messages.actions') }}
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pages as $page)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center {{ app()->getLocale() === 'ar' ? 'ml-4' : 'mr-4' }}">
                                    @if($page->featured_image)
                                        <img src="{{ asset('/' . $page->featured_image) }}"
                                             alt="{{ $page->translated_title ?: $page->title }}"
                                             class="w-12 h-12 rounded-lg object-cover">
                                    @else
                                        <i class="fas fa-file-alt text-blue-600"></i>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $page->translated_title ?: $page->title }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $page->slug }}
                                    </div>
                                    @if($page->sort_order > 0)
                                        <div class="text-xs text-purple-600">
                                            {{ __('messages.order') }}: {{ $page->sort_order }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($page->is_active)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                    {{ __('messages.active') }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-edit {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                    {{ __('messages.draft') }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex space-x-1 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                                @if($page->translations->where('locale', 'ar')->count())
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">AR</span>
                                @else
                                    <span class="bg-gray-100 text-gray-500 text-xs px-2 py-1 rounded">AR</span>
                                @endif
                                @if($page->translations->where('locale', 'en')->count())
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">EN</span>
                                @else
                                    <span class="bg-gray-100 text-gray-500 text-xs px-2 py-1 rounded">EN</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $page->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                                <a href="{{ route('admin.pages.show', $page) }}"
                                   class="text-blue-600 hover:text-blue-900 p-2 rounded-lg hover:bg-blue-50 transition-colors">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.pages.edit', $page) }}"
                                   class="text-purple-600 hover:text-purple-900 p-2 rounded-lg hover:bg-purple-50 transition-colors">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('pages.show', $page->slug) }}"
                                   target="_blank"
                                   class="text-green-600 hover:text-green-900 p-2 rounded-lg hover:bg-green-50 transition-colors">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                <button onclick="deletePage({{ $page->id }})"
                                        class="text-red-600 hover:text-red-900 p-2 rounded-lg hover:bg-red-50 transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-file-alt text-gray-400 text-2xl"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('messages.no_pages_found') }}</h3>
                                <p class="text-gray-600 mb-6">{{ __('messages.no_pages_desc') }}</p>
                                <a href="{{ route('admin.pages.create') }}"
                                   class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition-colors inline-flex items-center">
                                    <i class="fas fa-plus {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                    {{ __('messages.create_first_page') }}
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($pages->hasPages())
    <div class="flex justify-center">
        {{ $pages->links() }}
    </div>
    @endif
</div>

{{-- Delete Confirmation Modal --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg p-6 m-4 max-w-md w-full">
        <div class="text-center">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('messages.delete_page') }}</h3>
            <p class="text-gray-600 mb-6">{{ __('messages.delete_page_confirmation') }}</p>
            <div class="flex space-x-3 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                <button onclick="closeDeleteModal()"
                        class="flex-1 bg-gray-300 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-400 transition-colors">
                    {{ __('messages.cancel') }}
                </button>
                <form id="deleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition-colors">
                        {{ __('messages.delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function deletePage(pageId) {
    document.getElementById('deleteForm').action = `/admin/pages/${pageId}`;
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
