@extends('layouts.dashboard')

@section('page-title', 'إدارة تبرعات الطعام')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">إدارة تبرعات الطعام</h1>
                <p class="text-gray-600 mt-2">عرض وإدارة جميع تبرعات الطعام الواردة</p>

                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">تبرعات الطعام</span>
                </nav>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-3">
                <button class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-download {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    تصدير
                </button>
            </div>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">إجمالي التبرعات</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $foodDonations->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-utensils text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">متاحة</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $foodDonations->where('is_available', true)->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">غير متاحة</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $foodDonations->where('is_available', false)->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-times-circle text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">اليوم</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $foodDonations->where('created_at', '>=', today())->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-calendar-day text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Search and Filter --}}
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <input type="text" id="foodDonationSearch" placeholder="البحث في تبرعات الطعام..." class="w-full {{ app()->getLocale() === 'ar' ? 'pr-12 pl-4' : 'pl-12 pr-4' }} py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-all duration-300">
                    <i class="fas fa-search absolute {{ app()->getLocale() === 'ar' ? 'right-4' : 'left-4' }} top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
            <div class="flex gap-3">
                <select class="px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-all duration-300">
                    <option value="">جميع الحالات</option>
                    <option value="available">متاح</option>
                    <option value="unavailable">غير متاح</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Food Donations List --}}
    @if($foodDonations->isEmpty())
        <div class="bg-white rounded-3xl p-12 text-center shadow-sm border border-gray-100">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-utensils text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">لا توجد تبرعات طعام</h3>
            <p class="text-gray-600 mb-8 max-w-md mx-auto">لم يتم العثور على أي تبرعات طعام في النظام حالياً.</p>
        </div>
    @else
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">المتبرع</th>
                            <th class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">نوع التبرع</th>
                            <th class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">التفاصيل</th>
                            <th class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">الحالة</th>
                            <th class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">التاريخ</th>
                            <th class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($foodDonations as $donation)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center {{ app()->getLocale() === 'ar' ? 'ml-4' : 'mr-4' }}">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $donation->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $donation->email }}</div>
                                            <div class="text-sm text-gray-500">{{ $donation->phone }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                        {{ $donation->donation_type }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">
                                        @if($donation->supply_category && $donation->supply_type)
                                        <div class="flex items-center gap-2 mb-1">
                                            <i class="fas fa-tag text-blue-500"></i>
                                            <span class="font-medium">{{ $donation->supply_category }}</span>
                                            <span class="text-gray-400">-</span>
                                            <span>{{ $donation->supply_type }}</span>
                                        </div>
                                        @endif

                                        @if($donation->quantity && $donation->unit)
                                        <div class="flex items-center gap-2 mb-1">
                                            <i class="fas fa-weight text-emerald-500"></i>
                                            <span>{{ $donation->quantity }} {{ $donation->unit }}</span>
                                        </div>
                                        @endif

                                        <div class="flex items-center gap-2 mb-1">
                                            <i class="fas fa-map-marker-alt text-gray-400"></i>
                                            <span class="truncate">{{ $donation->address ?: 'غير محدد' }}</span>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-{{ $donation->is_available ? 'check-circle text-green-500' : 'times-circle text-red-500' }}"></i>
                                            <span>{{ $donation->is_available ? 'متاح' : 'غير متاح' }}</span>
                                        </div>

                                        @if($donation->description)
                                        <div class="mt-2 p-2 bg-gray-50 rounded text-xs text-gray-600">
                                            <i class="fas fa-info-circle {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                            {{ Str::limit($donation->description, 50) }}
                                        </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-orange-100 text-orange-800',
                                            'completed' => 'bg-green-100 text-green-800',
                                            'rejected' => 'bg-red-100 text-red-800',
                                        ];
                                        $statusColor = $statusColors[$donation->status] ?? 'bg-gray-100 text-gray-800';
                                        $statusText = [
                                            'pending' => 'في الانتظار',
                                            'completed' => 'مكتمل',
                                            'rejected' => 'مرفوض',
                                        ][$donation->status] ?? $donation->status;
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                        <i class="fas fa-circle {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                        {{ $statusText }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $donation->created_at->format('Y-m-d') }}</div>
                                    <div class="text-sm text-gray-500">{{ $donation->created_at->format('H:i') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($donation->status === 'pending')
                                    <div class="flex gap-2">
                                        <form action="{{ route('admin.food-donations.update-status', $donation->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-lg text-green-700 bg-green-100 hover:bg-green-200 transition-colors duration-200" onclick="return confirm('هل أنت متأكد من الموافقة على هذا التبرع؟')">
                                                <i class="fas fa-check {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                                موافقة
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.food-donations.update-status', $donation->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-lg text-red-700 bg-red-100 hover:bg-red-200 transition-colors duration-200" onclick="return confirm('هل أنت متأكد من رفض هذا التبرع؟')">
                                                <i class="fas fa-times {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                                رفض
                                            </button>
                                        </form>
                                    </div>
                                    @else
                                    <span class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-gray-500 bg-gray-100 rounded-lg">
                                        <i class="fas fa-info-circle {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                        تم {{ $statusText }}
                                    </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        @if(method_exists($foodDonations, 'hasPages') && $foodDonations->hasPages())
        <div class="flex justify-center">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
                {{ $foodDonations->links() }}
            </div>
        </div>
        @endif
    @endif
</div>

<script>
// Simple search functionality
document.getElementById('foodDonationSearch').addEventListener('keyup', function() {
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
</script>
@endsection
