@extends('layouts.dashboard')

@section('page-title', 'إدارة المتطوعين')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">إدارة المتطوعين</h1>
                <p class="text-gray-600 mt-2">عرض وإدارة جميع طلبات التطوع</p>

                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">المتطوعين</span>
                </nav>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.volunteers.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-plus {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    إضافة متطوع
                </a>
            </div>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Total Volunteers --}}
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">إجمالي المتطوعين</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $volunteers->total() ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-hands-helping text-white"></i>
                </div>
            </div>
        </div>

        {{-- Approved --}}
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">المعتمدين</p>
                    <p class="text-2xl font-bold text-green-600">{{ $volunteers->where('status', 'approved')->count() ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-white"></i>
                </div>
            </div>
        </div>

        {{-- Pending --}}
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">في الانتظار</p>
                    <p class="text-2xl font-bold text-orange-600">{{ $volunteers->where('status', 'pending')->count() ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-clock text-white"></i>
                </div>
            </div>
        </div>

        {{-- Rejected --}}
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">المرفوضين</p>
                    <p class="text-2xl font-bold text-red-600">{{ $volunteers->where('status', 'rejected')->count() ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-red-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-times-circle text-white"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
        <form method="GET" action="{{ route('admin.volunteers.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            {{-- Search --}}
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">البحث</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}" 
                       placeholder="ابحث في المتطوعين..." 
                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300">
            </div>

            {{-- Status Filter --}}
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">الحالة</label>
                <select id="status" name="status" class="w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300">
                    <option value="">جميع الحالات</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>في الانتظار</option>
                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>معتمد</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>مرفوض</option>
                </select>
            </div>

            {{-- Specialization Filter --}}
            <div>
                <label for="specialization" class="block text-sm font-medium text-gray-700 mb-2">التخصص</label>
                <select id="specialization" name="specialization" class="w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300">
                    <option value="">جميع التخصصات</option>
                    <option value="medical" {{ request('specialization') === 'medical' ? 'selected' : '' }}>طبي</option>
                    <option value="education" {{ request('specialization') === 'education' ? 'selected' : '' }}>تعليمي</option>
                    <option value="social" {{ request('specialization') === 'social' ? 'selected' : '' }}>اجتماعي</option>
                    <option value="technical" {{ request('specialization') === 'technical' ? 'selected' : '' }}>تقني</option>
                </select>
            </div>

            {{-- Actions --}}
            <div class="flex items-end gap-3">
                <button type="submit" class="flex-1 inline-flex items-center justify-center px-4 py-3 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-search {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    بحث
                </button>
                <a href="{{ route('admin.volunteers.index') }}" class="inline-flex items-center justify-center px-4 py-3 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-redo {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    إعادة تعيين
                </a>
            </div>
        </form>
    </div>

    {{-- Volunteers Table --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">
                            المتطوع
                        </th>
                        <th scope="col" class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">
                            البيانات
                        </th>
                        <th scope="col" class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">
                            التخصص
                        </th>
                        <th scope="col" class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">
                            الحالة
                        </th>
                        <th scope="col" class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">
                            تاريخ التقديم
                        </th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            الإجراءات
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($volunteers ?? [] as $volunteer)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-hands-helping text-indigo-600"></i>
                                    </div>
                                    <div class="{{ app()->getLocale() === 'ar' ? 'mr-4' : 'ml-4' }}">
                                        <div class="text-sm font-medium text-gray-900">{{ $volunteer->name }}</div>
                                        <div class="text-sm text-gray-500">#{{ $volunteer->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $volunteer->email }}</div>
                                <div class="text-sm text-gray-500">{{ $volunteer->phone }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $specialization = $volunteer->specialization ?? 'general';
                                    $specializationColors = [
                                        'medical' => 'bg-red-100 text-red-800',
                                        'education' => 'bg-blue-100 text-blue-800',
                                        'social' => 'bg-green-100 text-green-800',
                                        'technical' => 'bg-purple-100 text-purple-800',
                                        'general' => 'bg-gray-100 text-gray-800',
                                    ];
                                    $specializationLabels = [
                                        'medical' => 'طبي',
                                        'education' => 'تعليمي',
                                        'social' => 'اجتماعي',
                                        'technical' => 'تقني',
                                        'general' => 'عام',
                                    ];
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $specializationColors[$specialization] }}">
                                    {{ $specializationLabels[$specialization] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $status = $volunteer->status ?? 'pending';
                                    $statusColors = [
                                        'pending' => 'bg-orange-100 text-orange-800',
                                        'approved' => 'bg-green-100 text-green-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                    ];
                                    $statusLabels = [
                                        'pending' => 'في الانتظار',
                                        'approved' => 'معتمد',
                                        'rejected' => 'مرفوض',
                                    ];
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $statusColors[$status] }}">
                                    {{ $statusLabels[$status] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $volunteer->created_at->format('Y-m-d') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.volunteers.show', $volunteer->id) }}" 
                                       class="inline-flex items-center justify-center w-8 h-8 text-blue-600 hover:text-blue-800 hover:bg-blue-100 rounded-lg transition-all duration-200"
                                       title="عرض التفاصيل">
                                        <i class="fas fa-eye text-sm"></i>
                                    </a>
                                    <a href="{{ route('admin.volunteers.edit', $volunteer->id) }}" 
                                       class="inline-flex items-center justify-center w-8 h-8 text-indigo-600 hover:text-indigo-800 hover:bg-indigo-100 rounded-lg transition-all duration-200"
                                       title="تعديل">
                                        <i class="fas fa-edit text-sm"></i>
                                    </a>
                                    @if($volunteer->status === 'pending')
                                        <form action="{{ route('admin.volunteers.approve', $volunteer->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" 
                                                    class="inline-flex items-center justify-center w-8 h-8 text-green-600 hover:text-green-800 hover:bg-green-100 rounded-lg transition-all duration-200"
                                                    title="اعتماد">
                                                <i class="fas fa-check text-sm"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.volunteers.destroy', $volunteer->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center justify-center w-8 h-8 text-red-600 hover:text-red-800 hover:bg-red-100 rounded-lg transition-all duration-200"
                                                onclick="return confirm('هل أنت متأكد من حذف هذا المتطوع؟')"
                                                title="حذف">
                                            <i class="fas fa-trash text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-hands-helping text-4xl text-gray-300 mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">لا يوجد متطوعين</h3>
                                    <p class="text-gray-500">لم يتم العثور على أي متطوعين حتى الآن.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if(isset($volunteers) && $volunteers->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $volunteers->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
