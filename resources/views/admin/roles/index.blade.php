@extends('layouts.dashboard')

@section('page-title', 'إدارة الأدوار')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">إدارة الأدوار</h1>
                <p class="text-gray-600 mt-2">إدارة أدوار المستخدمين وصلاحيات الوصول في النظام</p>
                
                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">إدارة الأدوار</span>
                </nav>
            </div>
            
            {{-- Action Buttons --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.roles.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-slate-600 hover:bg-slate-700 rounded-2xl transition-all duration-300 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500">
                    <i class="fas fa-plus {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    إضافة دور جديد
                </a>
            </div>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gradient-to-r from-cyan-500 to-cyan-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">إجمالي الأدوار</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $roles->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-user-shield text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-teal-500 to-teal-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">الأدوار النشطة</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $roles->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-sky-500 to-sky-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">المستخدمين المحددين</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ \App\Models\User::whereNotNull('type')->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-users-cog text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Search and Filter --}}
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <input type="text" id="roleSearch" placeholder="البحث في الأدوار..." class="w-full {{ app()->getLocale() === 'ar' ? 'pr-12 pl-4' : 'pl-12 pr-4' }} py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-all duration-300">
                    <i class="fas fa-search absolute {{ app()->getLocale() === 'ar' ? 'right-4' : 'left-4' }} top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Roles Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($roles as $role)
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:border-gray-200 transition-all duration-300 group">
            {{-- Header --}}
            <div class="bg-gradient-to-r from-cyan-50 to-cyan-100 p-6 text-center border-b border-gray-100">
                <div class="w-16 h-16 bg-gradient-to-r from-cyan-500 to-cyan-600 rounded-full flex items-center justify-center text-white font-bold text-xl mx-auto mb-4">
                    <i class="fas fa-user-shield"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">{{ $role->name }}</h3>
                <p class="text-sm text-gray-600 mt-1">دور النظام</p>
            </div>

            {{-- Content --}}
            <div class="p-6">
                {{-- Role Info --}}
                <div class="text-center mb-6">
                    <div class="bg-gray-50 rounded-2xl p-4">
                        <p class="text-sm text-gray-600 mb-2">معرف الدور</p>
                        <p class="text-lg font-bold text-gray-900">#{{ $role->id }}</p>
                    </div>
                </div>

                {{-- Role Description --}}
                <div class="mb-6">
                    <div class="bg-gradient-to-r from-cyan-50 to-cyan-100 rounded-2xl p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-cyan-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-info text-white text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-cyan-700">معلومات الدور</p>
                                <p class="text-xs text-cyan-600">دور مخصص في النظام</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex gap-3">
                    <a href="{{ route('admin.roles.edit', $role->id) }}" 
                       class="flex-1 inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-blue-700 bg-blue-100 hover:bg-blue-200 rounded-2xl transition-all duration-300">
                        <i class="fas fa-edit {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        تعديل
                    </a>
                    
                    <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center justify-center w-10 h-10 text-red-600 bg-red-100 hover:bg-red-200 rounded-2xl transition-all duration-300 hover:scale-110"
                                onclick="return confirm('هل أنت متأكد من حذف هذا الدور؟')">
                            <i class="fas fa-trash text-sm"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full">
            <div class="bg-white rounded-3xl p-12 text-center shadow-sm border border-gray-100">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-user-shield text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">لا توجد أدوار</h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">لم يتم العثور على أي أدوار في النظام. ابدأ بإنشاء أول دور.</p>
                <a href="{{ route('admin.roles.create') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-white bg-slate-600 hover:bg-slate-700 rounded-2xl transition-all duration-300 shadow-sm hover:shadow-md">
                    <i class="fas fa-plus {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    إنشاء أول دور
                </a>
            </div>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if(method_exists($roles, 'hasPages') && $roles->hasPages())
    <div class="flex justify-center">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
            {{ $roles->links() }}
        </div>
    </div>
    @endif
</div>

<script>
// Simple search functionality
document.getElementById('roleSearch').addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const cards = document.querySelectorAll('.grid > div:not(.col-span-full)');
    
    cards.forEach(card => {
        const text = card.textContent.toLowerCase();
        if (text.includes(searchValue)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
});
</script>
@endsection
