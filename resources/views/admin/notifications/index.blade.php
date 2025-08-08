@extends('layouts.dashboard')

@section('page-title', 'إدارة الإشعارات')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">إدارة الإشعارات</h1>
                <p class="text-gray-600 mt-2">عرض وإدارة جميع إشعارات النظام</p>

                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">الإشعارات</span>
                </nav>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-3">
                <form action="{{ route('admin.notifications.mark-all-read') }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-green-700 bg-green-100 hover:bg-green-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-check-circle {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        تعليم الكل كمقروء
                    </button>
                </form>
                <form action="{{ route('admin.notifications.clear-read') }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-red-700 bg-red-100 hover:bg-red-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('هل أنت متأكد من حذف الإشعارات المقروءة؟')">
                        <i class="fas fa-trash {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        حذف المقروءة
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">إجمالي الإشعارات</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $notifications->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-bell text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">غير مقروءة</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $notifications->where('read_at', null)->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-exclamation-circle text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">مقروءة</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $notifications->where('read_at', '!=', null)->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">اليوم</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $notifications->where('created_at', '>=', today())->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-calendar-day text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Search and Filter --}}
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
        <div class="flex flex-col lg:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <input type="text" id="notificationSearch" placeholder="البحث في الإشعارات..." class="w-full {{ app()->getLocale() === 'ar' ? 'pr-12 pl-4' : 'pl-12 pr-4' }} py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-all duration-300">
                    <i class="fas fa-search absolute {{ app()->getLocale() === 'ar' ? 'right-4' : 'left-4' }} top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
            <div class="flex gap-3">
                <select id="type-filter" class="px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-all duration-300">
                    <option value="">كل الأنواع</option>
                    <option value="donation">تبرعات</option>
                    <option value="sms_donation">تبرعات بالرسائل النصية</option>
                    <option value="volunteer">متطوعين</option>
                    <option value="beneficiary">مستفيدين</option>
                    <option value="contact">رسائل اتصال</option>
                    <option value="ticket">تذاكر دعم</option>
                </select>
                <select id="read-filter" class="px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-all duration-300">
                    <option value="">الكل</option>
                    <option value="unread">غير مقروء</option>
                    <option value="read">مقروء</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-2xl">
            <div class="flex items-center">
                <i class="fas fa-check-circle {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif

    {{-- Notifications List --}}
    @if($notifications->isEmpty())
        <div class="bg-white rounded-3xl p-12 text-center shadow-sm border border-gray-100">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-bell text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">لا توجد إشعارات</h3>
            <p class="text-gray-600 mb-8 max-w-md mx-auto">لم يتم العثور على أي إشعارات في النظام حالياً.</p>
        </div>
    @else
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider w-16">الحالة</th>
                            <th class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">العنوان</th>
                            <th class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">الرسالة</th>
                            <th class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">النوع</th>
                            <th class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">التاريخ</th>
                            <th class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($notifications as $notification)
                            <tr class="hover:bg-gray-50 transition-colors duration-200 {{ !$notification->is_read ? 'bg-blue-50' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if(!$notification->is_read)
                                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                    @else
                                        <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center {{ app()->getLocale() === 'ar' ? 'ml-4' : 'mr-4' }}">
                                            <i class="fas fa-bell text-white"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $notification->title }}</div>
                                            <div class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 max-w-xs truncate">{{ $notification->message }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $typeColors = [
                                            'donation' => 'bg-green-100 text-green-800',
                                            'sms_donation' => 'bg-blue-100 text-blue-800',
                                            'volunteer' => 'bg-purple-100 text-purple-800',
                                            'beneficiary' => 'bg-orange-100 text-orange-800',
                                            'contact' => 'bg-yellow-100 text-yellow-800',
                                            'ticket' => 'bg-red-100 text-red-800',
                                        ];
                                        $typeColor = $typeColors[$notification->type] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $typeColor }}">
                                        @switch($notification->type)
                                            @case('donation')
                                                تبرع
                                                @break
                                            @case('sms_donation')
                                                تبرع بالرسائل النصية
                                                @break
                                            @case('volunteer')
                                                متطوع
                                                @break
                                            @case('beneficiary')
                                                مستفيد
                                                @break
                                            @case('contact')
                                                رسالة اتصال
                                                @break
                                            @case('ticket')
                                                تذكرة دعم
                                                @break
                                            @default
                                                {{ $notification->type }}
                                        @endswitch
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $notification->created_at->format('Y-m-d') }}</div>
                                    <div class="text-sm text-gray-500">{{ $notification->created_at->format('H:i') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex gap-2">
                                        @if($notification->url)
                                            <form action="{{ route('admin.notifications.mark-read', $notification->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-lg text-blue-700 bg-blue-100 hover:bg-blue-200 transition-colors duration-200">
                                                    <i class="fas fa-external-link-alt {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                                    عرض
                                                </button>
                                            </form>
                                        @endif

                                        @if(!$notification->is_read)
                                            <form action="{{ route('admin.notifications.mark-read', $notification->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-lg text-green-700 bg-green-100 hover:bg-green-200 transition-colors duration-200">
                                                    <i class="fas fa-check {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                                    تعليم كمقروء
                                                </button>
                                            </form>
                                        @endif

                                        <form action="{{ route('admin.notifications.destroy', $notification->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-lg text-red-700 bg-red-100 hover:bg-red-200 transition-colors duration-200" onclick="return confirm('هل أنت متأكد من حذف هذا الإشعار؟')">
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
        @if(method_exists($notifications, 'hasPages') && $notifications->hasPages())
        <div class="flex justify-center">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
                {{ $notifications->links() }}
            </div>
        </div>
        @endif
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const typeFilter = document.getElementById('type-filter');
    const readFilter = document.getElementById('read-filter');
    const searchField = document.getElementById('notificationSearch');
    const table = document.querySelector('table');
    const rows = table ? table.querySelectorAll('tbody tr') : [];

    function applyFilters() {
        const selectedType = typeFilter.value;
        const selectedRead = readFilter.value;
        const searchValue = searchField.value.toLowerCase();

        rows.forEach(row => {
            // Check read status from row class
            const isRead = !row.classList.contains('bg-blue-50');

            // Check type from badge text
            const typeSpan = row.querySelector('td:nth-child(4) span');
            const typeText = typeSpan ? typeSpan.textContent.trim() : '';

            // Apply type filter
            let showByType = true;
            if (selectedType) {
                const typeMap = {
                    'donation': 'تبرع',
                    'sms_donation': 'تبرع بالرسائل النصية',
                    'volunteer': 'متطوع',
                    'beneficiary': 'مستفيد',
                    'contact': 'رسالة اتصال',
                    'ticket': 'تذكرة دعم'
                };
                showByType = typeText === typeMap[selectedType];
            }

            // Apply read filter
            let showByRead = true;
            if (selectedRead === 'read') {
                showByRead = isRead;
            } else if (selectedRead === 'unread') {
                showByRead = !isRead;
            }

            // Apply search filter
            let showBySearch = true;
            if (searchValue) {
                showBySearch = false;
                const cells = row.querySelectorAll('td');
                cells.forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(searchValue)) {
                        showBySearch = true;
                    }
                });
            }

            // Show/hide row
            if (showByType && showByRead && showBySearch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Bind event listeners
    if (typeFilter) typeFilter.addEventListener('change', applyFilters);
    if (readFilter) readFilter.addEventListener('change', applyFilters);
    if (searchField) searchField.addEventListener('keyup', applyFilters);
});
</script>
@endsection
