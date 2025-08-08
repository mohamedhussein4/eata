@extends('layouts.dashboard')

@section('page-title', 'تبرعات الطلبات')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">تبرعات الطلبات</h1>
                <p class="text-gray-600 mt-2">إدارة ومراجعة طلبات التبرعات المباشرة</p>
                
                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">تبرعات الطلبات</span>
                </nav>
            </div>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        @php
            $totalDonations = $orders->where('project_id', null)->count();
            $pendingDonations = $orders->where('project_id', null)->filter(function($order) {
                return $order->payment && $order->payment->status === 'pending';
            })->count();
            $completedDonations = $orders->where('project_id', null)->filter(function($order) {
                return $order->payment && $order->payment->status === 'completed';
            })->count();
            $rejectedDonations = $orders->where('project_id', null)->filter(function($order) {
                return $order->payment && $order->payment->status === 'rejected';
            })->count();
        @endphp

        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">إجمالي التبرعات</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $totalDonations }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-hand-holding-heart text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">في الانتظار</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $pendingDonations }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">مقبولة</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $completedDonations }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">مرفوضة</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $rejectedDonations }}</p>
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
                    <input type="text" id="donationSearch" placeholder="البحث في التبرعات..." class="w-full {{ app()->getLocale() === 'ar' ? 'pr-12 pl-4' : 'pl-12 pr-4' }} py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
                    <i class="fas fa-search absolute {{ app()->getLocale() === 'ar' ? 'right-4' : 'left-4' }} top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
            <div class="sm:w-48">
                <select id="statusFilter" class="w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
                    <option value="">جميع الحالات</option>
                    <option value="pending">في الانتظار</option>
                    <option value="completed">مقبول</option>
                    <option value="rejected">مرفوض</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Donations Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6" id="donationsGrid">
        @forelse($orders as $order)
            @if($order->project_id == null && $order->payment)
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:border-gray-200 transition-all duration-300 group donation-card" 
                 data-status="{{ $order->payment->status }}" 
                 data-search="{{ strtolower($order->payment->first_name . ' ' . $order->payment->last_name . ' ' . $order->payment->email . ' ' . $order->payment->phone) }}">
                
                {{-- Header --}}
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                <i class="fas fa-hand-holding-heart"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">{{ $order->payment->first_name . ' ' . $order->payment->last_name }}</h3>
                                <p class="text-sm text-gray-600">{{ $order->payment->email }}</p>
                            </div>
                        </div>
                        @php
                            $statusColors = [
                                'pending' => 'bg-orange-100 text-orange-800',
                                'completed' => 'bg-green-100 text-green-800',
                                'rejected' => 'bg-red-100 text-red-800',
                            ];
                            $statusColor = $statusColors[$order->payment->status] ?? 'bg-gray-100 text-gray-800';
                            $statusText = [
                                'pending' => 'في الانتظار',
                                'completed' => 'مقبول',
                                'rejected' => 'مرفوض',
                            ][$order->payment->status] ?? $order->payment->status;
                        @endphp
                        <span class="text-xs px-2 py-1 rounded-lg {{ $statusColor }} font-medium">{{ $statusText }}</span>
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-6">
                    {{-- Contact Info --}}
                    <div class="grid grid-cols-1 gap-4 mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-phone text-gray-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">رقم الهاتف</p>
                                <p class="font-medium text-gray-900">{{ $order->payment->phone }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-credit-card text-gray-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">طريقة الدفع</p>
                                <p class="font-medium text-gray-900">
                                    @if($order->payment_method == 'e_wallet')
                                        محفظة إلكترونية
                                                    @else
                                                        حساب بنكي
                                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Payment Document --}}
                    @if($order->payment->confirmation_document)
                    <div class="mb-6">
                        <p class="text-sm font-medium text-gray-700 mb-3">مستند الدفع</p>
                        <div class="relative">
                            <img src="{{ asset('/' . $order->payment->confirmation_document) }}" 
                                 alt="مستند الدفع" 
                                 class="w-full h-40 object-cover rounded-2xl border border-gray-200 cursor-pointer hover:opacity-90 transition-opacity"
                                 onclick="openImageModal('{{ asset('/' . $order->payment->confirmation_document) }}')">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-2xl pointer-events-none"></div>
                        </div>
                    </div>
                    @else
                    <div class="mb-6">
                        <div class="bg-gray-50 rounded-2xl p-6 text-center">
                            <i class="fas fa-image text-gray-400 text-2xl mb-2"></i>
                            <p class="text-gray-500 text-sm">لا يوجد مستند دفع</p>
                        </div>
                    </div>
                    @endif

                    {{-- Timestamps --}}
                    <div class="grid grid-cols-2 gap-4 mb-6 text-sm">
                        <div>
                            <p class="text-gray-600">تاريخ الإنشاء</p>
                            <p class="font-medium text-gray-900">{{ $order->created_at->format('Y-m-d') }}</p>
                            <p class="text-gray-500">{{ $order->created_at->format('H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">آخر تحديث</p>
                            <p class="font-medium text-gray-900">{{ $order->updated_at->format('Y-m-d') }}</p>
                            <p class="text-gray-500">{{ $order->updated_at->format('H:i') }}</p>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    @if($order->payment->status === 'pending')
                    <div class="flex gap-3">
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="flex-1">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="completed">
                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-green-700 bg-green-100 hover:bg-green-200 rounded-2xl transition-all duration-300" onclick="return confirm('هل أنت متأكد من الموافقة على هذا التبرع؟')">
                                <i class="fas fa-check {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                موافقة
                            </button>
                                                    </form>
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="flex-1">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-red-700 bg-red-100 hover:bg-red-200 rounded-2xl transition-all duration-300" onclick="return confirm('هل أنت متأكد من رفض هذا التبرع؟')">
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
            @endif
        @empty
        <div class="col-span-full">
            <div class="bg-white rounded-3xl p-12 text-center shadow-sm border border-gray-100">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-hand-holding-heart text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">لا توجد تبرعات</h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">لم يتم العثور على أي طلبات تبرعات. ستظهر هنا عندما يقوم المتبرعون بإرسال طلباتهم.</p>
            </div>
        </div>
        @endforelse
            </div>

    {{-- Pagination --}}
    @if(method_exists($orders, 'hasPages') && $orders->hasPages())
    <div class="flex justify-center">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
            {{ $orders->links() }}
        </div>
    </div>
    @endif
</div>

{{-- Image Modal --}}
<div id="imageModal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-75 backdrop-blur-sm">
    <div class="relative max-w-4xl max-h-[90vh] m-4">
        <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white bg-black bg-opacity-50 rounded-full w-10 h-10 flex items-center justify-center hover:bg-opacity-75 transition-all">
            <i class="fas fa-times"></i>
        </button>
        <img id="modalImage" src="" alt="مستند الدفع" class="max-w-full max-h-full rounded-2xl">
    </div>
</div>

<script>
// Search functionality
document.getElementById('dashboard.donationsearch').addEventListener('keyup', function() {
    filterDonations();
});

// Status filter
document.getElementById('statusFilter').addEventListener('change', function() {
    filterDonations();
});

function filterDonations() {
    const searchValue = document.getElementById('dashboard.donationsearch').value.toLowerCase();
    const statusValue = document.getElementById('statusFilter').value;
    const cards = document.querySelectorAll('.donation-card');
    
    cards.forEach(card => {
        const searchMatch = card.dataset.search.includes(searchValue);
        const statusMatch = !statusValue || card.dataset.status === statusValue;
        
        if (searchMatch && statusMatch) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}

// Image modal functions
function openImageModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('imageModal').classList.remove('hidden');
    document.getElementById('imageModal').classList.add('flex');
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
    document.getElementById('imageModal').classList.remove('flex');
}

// Close modal when clicking outside
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImageModal();
    }
});
</script>
@endsection