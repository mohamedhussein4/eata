@extends('layouts.dashboard')

@section('page-title', 'إدارة المستفيدين')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">إدارة المستفيدين</h1>
                <p class="text-gray-600 mt-2">عرض وإدارة جميع المستفيدين المسجلين في النظام</p>
                
                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">إدارة المستفيدين</span>
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
        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">إجمالي المستفيدين</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $beneficiaries->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-hands-helping text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">يعانون من أمراض</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $beneficiaries->where('has_diseases', true)->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-heartbeat text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">يدعمون آخرين</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $beneficiaries->where('is_supporting_others', true)->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-people-carry text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium opacity-90">إجمالي أفراد الأسر</p>
                    <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $beneficiaries->sum('family_members_count') }}</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
                    <i class="fas fa-users text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Search and Filter --}}
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <input type="text" id="beneficiarySearch" placeholder="البحث في المستفيدين..." class="w-full {{ app()->getLocale() === 'ar' ? 'pr-12 pl-4' : 'pl-12 pr-4' }} py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-all duration-300">
                    <i class="fas fa-search absolute {{ app()->getLocale() === 'ar' ? 'right-4' : 'left-4' }} top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
            <div class="flex gap-3">
                <select class="px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-all duration-300">
                    <option value="">جميع الحالات</option>
                    <option value="married">متزوج</option>
                    <option value="single">أعزب</option>
                    <option value="divorced">مطلق</option>
                    <option value="widow">أرمل</option>
                </select>
                <select class="px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-all duration-300">
                    <option value="">جميع الأعمار</option>
                    <option value="18-30">18-30 سنة</option>
                    <option value="31-50">31-50 سنة</option>
                    <option value="51+">أكثر من 50 سنة</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Beneficiaries Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse($beneficiaries as $beneficiary)
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:border-gray-200 transition-all duration-300 group">
            {{-- Header --}}
            <div class="bg-gradient-to-r from-green-50 to-green-100 p-6 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            {{ substr($beneficiary->name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">{{ $beneficiary->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $beneficiary->email }}</p>
                        </div>
                    </div>
                    <span class="text-xs text-gray-500 bg-white px-2 py-1 rounded-lg">#{{ $beneficiary->id }}</span>
                </div>
            </div>

            {{-- Content --}}
            <div class="p-6">
                {{-- Basic Info --}}
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="text-center p-3 bg-blue-50 rounded-2xl">
                        <p class="text-lg font-bold text-blue-600">{{ $beneficiary->age }}</p>
                        <p class="text-xs text-gray-600 font-medium mt-1">العمر</p>
                    </div>
                    <div class="text-center p-3 bg-purple-50 rounded-2xl">
                        <p class="text-lg font-bold text-purple-600">{{ $beneficiary->family_members_count }}</p>
                        <p class="text-xs text-gray-600 font-medium mt-1">أفراد الأسرة</p>
                    </div>
                </div>

                {{-- Contact Info --}}
                <div class="space-y-3 mb-6">
                    <div class="flex items-center gap-3 text-sm">
                        <i class="fas fa-phone text-gray-400 w-4"></i>
                        <span class="text-gray-700">{{ $beneficiary->phone ?: 'غير محدد' }}</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <i class="fas fa-map-marker-alt text-gray-400 w-4"></i>
                        <span class="text-gray-700">{{ Str::limit($beneficiary->address, 50) ?: 'غير محدد' }}</span>
                    </div>
                </div>

                {{-- Status Badges --}}
                <div class="flex flex-wrap gap-2 mb-6">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                        @if($beneficiary->marital_status === 'متزوج') bg-blue-100 text-blue-800
                        @elseif($beneficiary->marital_status === 'أعزب') bg-green-100 text-green-800
                        @elseif($beneficiary->marital_status === 'مطلق') bg-orange-100 text-orange-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ $beneficiary->marital_status ?: 'غير محدد' }}
                    </span>
                    
                    @if($beneficiary->has_diseases)
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            <i class="fas fa-heartbeat {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                            يعاني من أمراض
                        </span>
                    @endif
                    
                    @if($beneficiary->is_supporting_others)
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-hands-helping {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                            يدعم آخرين
                        </span>
                    @endif
                </div>

                {{-- Income Info --}}
                @if($beneficiary->average_monthly_income)
                <div class="bg-gray-50 rounded-2xl p-4 mb-6">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">الدخل الشهري</span>
                        <span class="text-lg font-bold text-gray-900">{{ number_format($beneficiary->average_monthly_income) }} ريال</span>
                    </div>
                </div>
                @endif

                {{-- Documents --}}
                <div class="grid grid-cols-3 gap-2 mb-6">
                    @if($beneficiary->document_path)
                        <a href="{{ asset($beneficiary->document_path) }}" target="_blank" 
                           class="flex flex-col items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-2xl transition-colors duration-200">
                            <i class="fas fa-file-alt text-blue-600 mb-1"></i>
                            <span class="text-xs text-blue-700 font-medium">المستند</span>
                        </a>
                                            @endif
                    
                    @if($beneficiary->id_document)
                        <a href="{{ asset($beneficiary->id_document) }}" target="_blank" 
                           class="flex flex-col items-center p-3 bg-green-50 hover:bg-green-100 rounded-2xl transition-colors duration-200">
                            <i class="fas fa-id-card text-green-600 mb-1"></i>
                            <span class="text-xs text-green-700 font-medium">الهوية</span>
                        </a>
                                            @endif
                    
                    @if($beneficiary->family_book)
                        <a href="{{ asset($beneficiary->family_book) }}" target="_blank" 
                           class="flex flex-col items-center p-3 bg-purple-50 hover:bg-purple-100 rounded-2xl transition-colors duration-200">
                            <i class="fas fa-book text-purple-600 mb-1"></i>
                            <span class="text-xs text-purple-700 font-medium">كتاب العائلة</span>
                        </a>
                                            @endif
                </div>

                {{-- Action Buttons --}}
                <div class="flex gap-3">
                    <button class="flex-1 inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-blue-700 bg-blue-100 hover:bg-blue-200 rounded-2xl transition-all duration-300">
                        <i class="fas fa-eye {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        عرض التفاصيل
                    </button>
                    
                    <form action="{{ route('beneficiaries.destroy', $beneficiary->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center justify-center w-10 h-10 text-red-600 bg-red-100 hover:bg-red-200 rounded-2xl transition-all duration-300 hover:scale-110"
                                onclick="return confirm('هل أنت متأكد من حذف هذا المستفيد؟')">
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
                    <i class="fas fa-hands-helping text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">لا يوجد مستفيدين</h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">لم يتم العثور على أي مستفيدين مسجلين في النظام حالياً.</p>
            </div>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if(method_exists($beneficiaries, 'hasPages') && $beneficiaries->hasPages())
    <div class="flex justify-center">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
            {{ $beneficiaries->links() }}
        </div>
    </div>
    @endif
</div>

<script>
// Simple search functionality
document.getElementById('beneficiarySearch').addEventListener('keyup', function() {
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
