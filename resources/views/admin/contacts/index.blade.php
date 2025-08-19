@extends('layouts.dashboard')

@section('page-title', 'إدارة رسائل الاتصال')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">إدارة رسائل الاتصال</h1>
                <p class="text-gray-600 mt-2">عرض وإدارة جميع رسائل التواصل الواردة</p>

                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">رسائل الاتصال</span>
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
        <div class="bg-gradient-to-r from-cyan-500 to-cyan-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">إجمالي الرسائل</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $contacts->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-envelope text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">غير مقروءة</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $contacts->where('read_at', null)->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-envelope-open text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">مقروءة</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $contacts->where('read_at', '!=', null)->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">اليوم</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $contacts->where('created_at', '>=', today())->count() }}</p>
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
                    <input type="text" id="contactsSearch" placeholder="البحث في الرسائل..." class="w-full {{ app()->getLocale() === 'ar' ? 'pr-12 pl-4' : 'pl-12 pr-4' }} py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-all duration-300">
                    <i class="fas fa-search absolute {{ app()->getLocale() === 'ar' ? 'right-4' : 'left-4' }} top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
            <div class="flex gap-3">
                <select class="px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-all duration-300">
                    <option value="">جميع الحالات</option>
                    <option value="unread">غير مقروءة</option>
                    <option value="read">مقروءة</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Contacts List --}}
    @if($contacts->isEmpty())
        <div class="bg-white rounded-3xl p-12 text-center shadow-sm border border-gray-100">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-envelope text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">لا توجد رسائل اتصال</h3>
            <p class="text-gray-600 mb-8 max-w-md mx-auto">لم يتم العثور على أي رسائل اتصال في النظام حالياً.</p>
        </div>
    @else
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider w-16">الحالة</th>
                            <th class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">المرسل</th>
                            <th class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">الموضوع</th>
                            <th class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">الرسالة</th>
                            <th class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">التاريخ</th>
                            <th class="px-6 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">الإجراءات</th>
                                    </tr>
                                </thead>
                                    @foreach ($contacts as $contact)
                            <tr class="hover:bg-gray-50 transition-colors duration-200 {{ !$contact->read_at ? 'bg-blue-50' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if(!$contact->read_at)
                                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                    @else
                                        <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-r from-cyan-500 to-cyan-600 rounded-lg flex items-center justify-center {{ app()->getLocale() === 'ar' ? 'ml-4' : 'mr-4' }}">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $contact->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $contact->email }}</div>
                                            @if($contact->phone)
                                                <div class="text-sm text-gray-500">{{ $contact->phone }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $contact->subject ?? 'بدون موضوع' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 max-w-xs truncate">{{ Str::limit($contact->message, 50) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $contact->created_at->format('Y-m-d') }}</div>
                                    <div class="text-sm text-gray-500">{{ $contact->created_at->format('H:i') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex gap-2">
                                        @if(!$contact->read_at)
                                        <form action="{{ route('admin.contacts.mark-read', $contact->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-lg text-green-700 bg-green-100 hover:bg-green-200 transition-colors duration-200">
                                                <i class="fas fa-check {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                                تعليم كمقروءة
                                            </button>
                                        </form>
                                        @endif

                                        <button onclick="showMessage('{{ addslashes($contact->message) }}')" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-lg text-blue-700 bg-blue-100 hover:bg-blue-200 transition-colors duration-200">
                                            <i class="fas fa-eye {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                            عرض
                                        </button>

                                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-lg text-red-700 bg-red-100 hover:bg-red-200 transition-colors duration-200" onclick="return confirm('هل أنت متأكد من حذف هذه الرسالة؟')">
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
        @if(method_exists($contacts, 'hasPages') && $contacts->hasPages())
        <div class="flex justify-center">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
                {{ $contacts->links() }}
            </div>
        </div>
        @endif
    @endif
</div>

{{-- Message Modal --}}
<div id="messageModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-3xl bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900">محتوى الرسالة</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
                </div>
            <div id="messageContent" class="p-4 bg-gray-50 rounded-2xl border border-gray-200 text-gray-900 leading-relaxed"></div>
            <div class="flex justify-end mt-6">
                <button onclick="closeModal()" class="px-4 py-2 bg-gray-500 text-white rounded-2xl hover:bg-gray-600 transition-colors duration-200">
                    إغلاق
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Simple search functionality
document.getElementById('contactsSearch').addEventListener('keyup', function() {
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

// Modal functions
function showMessage(message) {
    document.getElementById('messageContent').textContent = message;
    document.getElementById('messageModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('messageModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('messageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>
@endsection
