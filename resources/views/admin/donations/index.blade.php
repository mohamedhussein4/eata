@extends('layouts.dashboard')

@section('page-title', 'إدارة التبرعات')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">إدارة التبرعات</h1>
                <p class="text-gray-600 mt-2">عرض وإدارة جميع التبرعات والطلبات</p>

                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">إدارة التبرعات</span>
                </nav>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-3">
                <button class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-download {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    تصدير
                </button>
                <button class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-slate-600 hover:bg-slate-700 rounded-2xl transition-all duration-300 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500">
                    <i class="fas fa-print {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    طباعة
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
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $donations->total() }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-donate text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">تبرعات مؤكدة</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $donations->where('status', 'confirmed')->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">في الانتظار</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $donations->where('status', 'pending')->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">تبرعات مرفوضة</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $donations->where('status', 'rejected')->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-times-circle text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Search and Filter --}}
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <input type="text" id="donationSearch" placeholder="البحث في التبرعات..." class="w-full {{ app()->getLocale() === 'ar' ? 'pr-12 pl-4' : 'pl-12 pr-4' }} py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-all duration-300">
                    <i class="fas fa-search absolute {{ app()->getLocale() === 'ar' ? 'right-4' : 'left-4' }} top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
            <div class="flex gap-3">
                <select class="px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-all duration-300">
                    <option value="">جميع الحالات</option>
                    <option value="pending">في الانتظار</option>
                    <option value="confirmed">مؤكد</option>
                    <option value="rejected">مرفوض</option>
                </select>
                <select class="px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-all duration-300">
                    <option value="">جميع طرق الدفع</option>
                    <option value="bank_account">حساب بنكي</option>
                    <option value="e_wallet">محفظة إلكترونية</option>
                    <option value="cash">نقدي</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Donations Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse($donations as $donation)
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:border-gray-200 transition-all duration-300 group">
            {{-- Header --}}
            <div class="bg-gradient-to-r from-emerald-50 to-emerald-100 p-6 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            <i class="fas fa-donate"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">{{ $donation->donor_name ?: ($donation->user ? $donation->user->name : 'غير محدد') }}</h3>
                            <p class="text-sm text-gray-600">{{ $donation->donor_email ?: ($donation->user ? $donation->user->email : 'غير محدد') }}</p>
                        </div>
                    </div>
                    <span class="text-xs text-gray-500 bg-white px-2 py-1 rounded-lg">#{{ $donation->id }}</span>
                </div>
            </div>

            {{-- Content --}}
            <div class="p-6">
                {{-- Donation Info --}}
                <div class="space-y-3 mb-6">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">مبلغ التبرع:</span>
                        <span class="text-lg font-bold text-emerald-600">{{ number_format($donation->amount) }} ل.س</span>
                    </div>

                    @if($donation->project)
                    <div class="flex items-center gap-3 text-sm">
                        <i class="fas fa-project-diagram text-gray-400 w-4"></i>
                        <span class="text-gray-700">{{ $donation->project->translated_title }}</span>
                    </div>
                    @else
                    <div class="flex items-center gap-3 text-sm">
                        <i class="fas fa-heart text-gray-400 w-4"></i>
                        <span class="text-gray-700">تبرع عام</span>
                    </div>
                    @endif

                    @if($donation->donor_phone)
                    <div class="flex items-center gap-3 text-sm">
                        <i class="fas fa-phone text-gray-400 w-4"></i>
                        <span class="text-gray-700">{{ $donation->donor_phone }}</span>
                    </div>
                    @endif

                    <div class="flex items-center gap-3 text-sm">
                        <i class="fas fa-credit-card text-gray-400 w-4"></i>
                        <span class="text-gray-700">
                            @switch($donation->payment_method)
                                @case('bank_account')
                                    حساب بنكي
                                    @if($donation->bankAccount)
                                        - {{ $donation->bankAccount->bank_name }}
                                    @endif
                                    @break
                                @case('e_wallet')
                                    محفظة إلكترونية
                                    @if($donation->eWallet)
                                        - {{ $donation->eWallet->provider }}
                                    @endif
                                    @break
                                @case('cash')
                                    نقدي
                                    @break
                                @default
                                    {{ $donation->payment_method }}
                            @endswitch
                        </span>
                    </div>
                </div>

                {{-- Status --}}
                <div class="flex justify-center mb-6">
                    @php
                        $statusColor = '';
                        $statusText = '';
                        switch($donation->status) {
                            case 'confirmed':
                                $statusColor = 'bg-green-100 text-green-800';
                                $statusText = 'مؤكد';
                                break;
                            case 'pending':
                                $statusColor = 'bg-orange-100 text-orange-800';
                                $statusText = 'في الانتظار';
                                break;
                            case 'rejected':
                                $statusColor = 'bg-red-100 text-red-800';
                                $statusText = 'مرفوض';
                                break;
                            default:
                                $statusColor = 'bg-gray-100 text-gray-800';
                                $statusText = $donation->status;
                        }
                    @endphp
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $statusColor }}">
                        <i class="fas fa-circle {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                        {{ $statusText }}
                    </span>
                </div>

                {{-- Payment Proof --}}
                @if($donation->payment_proof)
                <div class="mb-6">
                    <a href="{{ asset('/' . $donation->payment_proof) }}" target="_blank"
                       class="flex items-center justify-center gap-3 p-4 bg-gradient-to-r from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 rounded-2xl transition-all duration-300 group">
                        <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-file-image text-white text-sm"></i>
                        </div>
                        <span class="text-blue-700 font-medium">عرض إثبات الدفع</span>
                        <i class="fas fa-external-link-alt text-blue-600 text-sm group-hover:transform group-hover:translate-x-1 transition-transform duration-300"></i>
                    </a>
                </div>
                @endif

                {{-- Notes --}}
                @if($donation->notes)
                <div class="mb-6 p-3 bg-gray-50 rounded-2xl">
                    <p class="text-xs text-gray-600 mb-1">ملاحظات:</p>
                    <p class="text-sm text-gray-800">{{ $donation->notes }}</p>
                </div>
                @endif

                {{-- Dates --}}
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="text-center p-3 bg-gray-50 rounded-2xl">
                        <p class="text-xs text-gray-600 mb-1">تاريخ التبرع</p>
                        <p class="text-sm font-bold text-gray-900">{{ $donation->created_at->format('Y-m-d') }}</p>
                    </div>
                    <div class="text-center p-3 bg-gray-50 rounded-2xl">
                        <p class="text-xs text-gray-600 mb-1">آخر تحديث</p>
                        <p class="text-sm font-bold text-gray-900">{{ $donation->updated_at->format('Y-m-d') }}</p>
                    </div>
                </div>

                {{-- Action Buttons --}}
                @if($donation->status === 'pending')
                <div class="flex gap-3">
                    <form action="{{ route('admin.donations.update-status', $donation->id) }}" method="POST" class="flex-1">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="confirmed">
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-green-700 bg-green-100 hover:bg-green-200 rounded-2xl transition-all duration-300"
                                onclick="return confirm('هل أنت متأكد من الموافقة على هذا التبرع؟')">
                            <i class="fas fa-check {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            تأكيد
                        </button>
                    </form>

                    <form action="{{ route('admin.donations.update-status', $donation->id) }}" method="POST" class="flex-1">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-red-700 bg-red-100 hover:bg-red-200 rounded-2xl transition-all duration-300"
                                onclick="return confirm('هل أنت متأكد من رفض هذا التبرع؟')">
                            <i class="fas fa-times {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            رفض
                        </button>
                    </form>
                </div>
                @else
                <div class="flex justify-center">
                    <button class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-2xl cursor-not-allowed" disabled>
                        <i class="fas fa-info-circle {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        تم {{ $statusText }}
                    </button>
                </div>
                @endif
            </div>
        </div>
        @empty
        <div class="col-span-full">
            <div class="bg-white rounded-3xl p-12 text-center shadow-sm border border-gray-100">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-donate text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">لا توجد تبرعات</h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">لم يتم العثور على أي تبرعات في النظام حالياً.</p>
            </div>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if(method_exists($donations, 'hasPages') && $donations->hasPages())
    <div class="flex justify-center">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
            {{ $donations->links() }}
        </div>
    </div>
    @endif
</div>

<script>
// Simple search functionality
document.getElementById('donationSearch').addEventListener('keyup', function() {
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

// Filter functionality
document.querySelectorAll('select').forEach(select => {
    select.addEventListener('change', function() {
        // Here you can add filter functionality
        console.log('Filter changed:', this.value);
    });
});
</script>
@endsection
