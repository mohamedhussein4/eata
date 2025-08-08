@extends('layouts.dashboard')

@section('page-title', 'تعديل تبرع SMS')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">تعديل تبرع SMS #{{ $donation->id }}</h1>
                <p class="text-gray-600 mt-2">تعديل معلومات التبرع عبر الرسائل النصية</p>

                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <a href="{{ route('admin.sms-donations.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">تبرعات SMS</a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">تعديل تبرع #{{ $donation->id }}</span>
                </nav>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.sms-donations.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    العودة للقائمة
                </a>
            </div>
        </div>
    </div>

    {{-- Current Donation Info --}}
    <div class="bg-blue-50 border border-blue-200 rounded-3xl p-6">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-sms text-white"></i>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-blue-900 mb-2">معلومات التبرع الحالية</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <span class="text-blue-700 font-medium">رقم الهاتف:</span>
                        <p class="text-blue-900">{{ $donation->phone_number }}</p>
                    </div>
                    <div>
                        <span class="text-blue-700 font-medium">المبلغ:</span>
                        <p class="text-blue-900">{{ number_format($donation->amount, 2) }} ل.س</p>
                    </div>
                    <div>
                        <span class="text-blue-700 font-medium">الحالة:</span>
                        @if($donation->status === 'pending')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                معلق
                            </span>
                        @elseif($donation->status === 'completed')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                مكتمل
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-red-100 text-red-800">
                                <i class="fas fa-times {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                فاشل
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Form Section --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.sms-donations.update', $donation->id) }}" method="POST" class="p-6 lg:p-8 space-y-6">
            @csrf
            @method('PUT')

            {{-- Form Header --}}
            <div class="border-b border-gray-200 pb-6">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-sms text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">تعديل معلومات التبرع</h2>
                        <p class="text-gray-600 text-sm">قم بتحديث معلومات التبرع عبر SMS</p>
                    </div>
                </div>
            </div>

            {{-- Form Fields --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Phone Number --}}
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-phone text-indigo-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        رقم الهاتف <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="phone_number" name="phone_number" required
                           value="{{ old('phone_number', $donation->phone_number) }}"
                           class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('phone_number') border-red-500 @enderror"
                           placeholder="أدخل رقم الهاتف">
                    @error('phone_number')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Amount --}}
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-money-bill-wave text-green-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        المبلغ <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="amount" name="amount" required step="0.01"
                           value="{{ old('amount', $donation->amount) }}"
                           class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('amount') border-red-500 @enderror"
                           placeholder="أدخل مبلغ التبرع">
                    @error('amount')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-info-circle text-blue-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        الحالة <span class="text-red-500">*</span>
                    </label>
                    <select id="status" name="status" required
                            class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('status') border-red-500 @enderror">
                        <option value="pending" {{ old('status', $donation->status) === 'pending' ? 'selected' : '' }}>معلق</option>
                        <option value="completed" {{ old('status', $donation->status) === 'completed' ? 'selected' : '' }}>مكتمل</option>
                        <option value="failed" {{ old('status', $donation->status) === 'failed' ? 'selected' : '' }}>فاشل</option>
                    </select>
                    @error('status')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Notes --}}
                <div class="md:col-span-2">
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-sticky-note text-yellow-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        ملاحظات
                    </label>
                    <textarea id="notes" name="notes" rows="4"
                              class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 resize-none @error('notes') border-red-500 @enderror"
                              placeholder="أدخل أي ملاحظات إضافية...">{{ old('notes', $donation->notes) }}</textarea>
                    @error('notes')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="flex items-center justify-between gap-4 pt-6 border-t border-gray-200">
                <div>
                    <form action="{{ route('admin.sms-donations.destroy', $donation->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-red-700 bg-red-100 hover:bg-red-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('هل أنت متأكد من حذف هذا التبرع؟')">
                            <i class="fas fa-trash {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            حذف التبرع
                        </button>
                    </form>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.sms-donations.index') }}" 
                       class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        <i class="fas fa-times {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        إلغاء
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-lg hover:shadow-xl">
                        <i class="fas fa-save {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        حفظ التعديلات
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection 