@extends('layouts.dashboard')

@section('page-title', 'إضافة حساب بنكي جديد')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">إضافة حساب بنكي جديد</h1>
                <p class="text-gray-600 mt-2">إضافة حساب بنكي جديد لقبول التبرعات والمدفوعات</p>

                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <a href="{{ route('admin.bank-accounts.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">الحسابات البنكية</a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">إضافة حساب جديد</span>
                </nav>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.bank-accounts.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    العودة للقائمة
                </a>
            </div>
        </div>
    </div>

    {{-- Form Section --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.bank-accounts.store') }}" method="POST" class="p-6 lg:p-8 space-y-6">
            @csrf

            {{-- Form Header --}}
            <div class="border-b border-gray-200 pb-6">
                <h2 class="text-xl font-bold text-gray-900 mb-2">معلومات الحساب البنكي</h2>
                <p class="text-gray-600 text-sm">املأ المعلومات التالية لإضافة حساب بنكي جديد</p>
            </div>

            {{-- Form Fields --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Bank Name --}}
                <div class="space-y-2">
                    <label for="bank_name" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-university text-blue-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        اسم البنك
                    </label>
                    <input type="text" id="bank_name" name="bank_name" required
                           class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300"
                           placeholder="أدخل اسم البنك (مثل: البنك الأهلي السوري)">
                    @error('bank_name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Account Name --}}
                <div class="space-y-2">
                    <label for="account_name" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-user text-green-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        اسم الحساب
                    </label>
                    <input type="text" id="account_name" name="account_name" required
                           class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300"
                           placeholder="أدخل اسم صاحب الحساب أو المؤسسة">
                    @error('account_name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Account Number --}}
                <div class="space-y-2">
                    <label for="account_number" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-hashtag text-purple-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        رقم الحساب
                    </label>
                    <input type="text" id="account_number" name="account_number" required
                           class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 font-mono"
                           placeholder="أدخل رقم الحساب البنكي">
                    @error('account_number')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- IBAN --}}
                <div class="space-y-2">
                    <label for="iban" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-globe text-indigo-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        رقم الآيبان (IBAN)
                    </label>
                    <input type="text" id="iban" name="iban"
                           class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 font-mono uppercase"
                           placeholder="أدخل رقم الآيبان (اختياري)"
                           maxlength="34">
                    @error('iban')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500">رقم الآيبان الدولي للحوالات الخارجية (اختياري)</p>
                </div>

                {{-- SWIFT Code --}}
                <div class="space-y-2">
                    <label for="swift_code" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-code text-orange-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        رمز SWIFT
                    </label>
                    <input type="text" id="swift_code" name="swift_code"
                           class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 font-mono uppercase"
                           placeholder="أدخل رمز SWIFT (اختياري)"
                           maxlength="11">
                    @error('swift_code')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500">رمز SWIFT للحوالات الدولية (اختياري)</p>
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.bank-accounts.index') }}"
                   class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-times {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    إلغاء
                </a>
                <button type="submit"
                        class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 shadow-lg hover:shadow-xl">
                    <i class="fas fa-save {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    حفظ الحساب
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Auto format IBAN and SWIFT codes
document.getElementById('iban').addEventListener('input', function() {
    this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
});

document.getElementById('swift_code').addEventListener('input', function() {
    this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
});

// Auto format account number (numbers only)
document.getElementById('account_number').addEventListener('input', function() {
    this.value = this.value.replace(/[^0-9]/g, '');
});
</script>
@endsection
