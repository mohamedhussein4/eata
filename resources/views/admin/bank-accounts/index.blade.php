@extends('layouts.dashboard')

@section('page-title', 'إدارة الحسابات البنكية')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">إدارة الحسابات البنكية</h1>
                <p class="text-gray-600 mt-2">عرض وإدارة جميع الحسابات البنكية المتاحة للتبرع</p>

                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">الحسابات البنكية</span>
                </nav>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.bank-accounts.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-2xl transition-all duration-300 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <i class="fas fa-plus {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    إضافة حساب
                </a>

            </div>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">إجمالي الحسابات</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $bankAccounts->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-university text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">نشطة</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $bankAccounts->where('is_active', true)->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">غير نشطة</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $bankAccounts->where('is_active', false)->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-times-circle text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">أنواع البنوك</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $bankAccounts->pluck('bank_name')->unique()->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-building text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Search and Filter --}}
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <input type="text" id="banksSearch" placeholder="البحث في الحسابات البنكية..." class="w-full {{ app()->getLocale() === 'ar' ? 'pr-12 pl-4' : 'pl-12 pr-4' }} py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-all duration-300">
                    <i class="fas fa-search absolute {{ app()->getLocale() === 'ar' ? 'right-4' : 'left-4' }} top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
            <div class="flex gap-3">
                <select id="statusFilter" class="px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-all duration-300">
                    <option value="">جميع الحالات</option>
                    <option value="active">نشطة</option>
                    <option value="inactive">غير نشطة</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Banks List --}}
    @if($bankAccounts->isEmpty())
        <div class="bg-white rounded-3xl p-12 text-center shadow-sm border border-gray-100">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-university text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">لا توجد حسابات بنكية</h3>
            <p class="text-gray-600 mb-8 max-w-md mx-auto">لم يتم العثور على أي حسابات بنكية في النظام حالياً.</p>
                            <a href="{{ route('admin.bank-accounts.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-2xl transition-all duration-300">
                <i class="fas fa-plus {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                إضافة حساب جديد
            </a>
        </div>
    @else
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">البنك</th>
                            <th class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">اسم الحساب</th>
                            <th class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">رقم الحساب</th>
                            <th class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">الآيبان</th>
                            <th class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">الحالة</th>
                            <th class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">الإجراءات</th>
                                    </tr>
                                </thead>
                                    @foreach ($bankAccounts as $bankAccount)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-green-600 rounded-lg flex items-center justify-center {{ app()->getLocale() === 'ar' ? 'ml-4' : 'mr-4' }}">
                                            <i class="fas fa-university text-white"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $bankAccount->bank_name }}</div>
                                            @if($bankAccount->swift_code)
                                                <div class="text-sm text-gray-500">{{ $bankAccount->swift_code }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $bankAccount->account_name }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 font-mono">{{ $bankAccount->account_number }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 font-mono">{{ $bankAccount->iban ?: 'غير محدد' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $isActive = $bankAccount->is_active ?? true;
                                        $statusColor = $isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                                        $statusText = $isActive ? 'نشط' : 'غير نشط';
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                        <i class="fas fa-circle {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                        {{ $statusText }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.bank-accounts.edit', $bankAccount->id) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-lg text-yellow-700 bg-yellow-100 hover:bg-yellow-200 transition-colors duration-200">
                                            <i class="fas fa-edit {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                            تعديل
                                        </a>
                                        <form action="{{ route('admin.bank-accounts.destroy', $bankAccount->id) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-lg text-red-700 bg-red-100 hover:bg-red-200 transition-colors duration-200" onclick="return confirm('هل أنت متأكد من حذف هذا الحساب؟')">
                                                <i class="fas fa-trash {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                                حذف
                                            </button>
                                                </form>
                                    </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

        {{-- Pagination --}}
        @if(method_exists($bankAccounts, 'hasPages') && $bankAccounts->hasPages())
        <div class="flex justify-center">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
                {{ $bankAccounts->links() }}
            </div>
        </div>
        @endif
    @endif
    </div>

<script>
// Simple search functionality
document.getElementById('banksSearch').addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');

    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        if (text.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Status filter
document.getElementById('statusFilter').addEventListener('change', function() {
    const filterValue = this.value;
    const rows = document.querySelectorAll('tbody tr');

    rows.forEach(row => {
        const statusSpan = row.querySelector('td:nth-child(5) span');
        if (statusSpan) {
            const isActive = statusSpan.textContent.trim().includes('نشط') && !statusSpan.textContent.trim().includes('غير نشط');

            if (filterValue === '') {
                row.style.display = '';
            } else if (filterValue === 'active' && isActive) {
                row.style.display = '';
            } else if (filterValue === 'inactive' && !isActive) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
});
</script>
@endsection
