@extends('layouts.dashboard')

@section('page-title', 'إضافة محفظة إلكترونية جديدة')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">إضافة محفظة إلكترونية جديدة</h1>
                <p class="text-gray-600 mt-2">إضافة محفظة إلكترونية جديدة لقبول التبرعات</p>

                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <a href="{{ route('admin.e-wallets.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">المحافظ الإلكترونية</a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">إضافة محفظة جديدة</span>
                </nav>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.e-wallets.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    العودة للقائمة
                </a>
            </div>
        </div>
    </div>

    {{-- Form Section --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.e-wallets.store') }}" method="POST" class="p-6 lg:p-8 space-y-6">
            @csrf

            {{-- Form Header --}}
            <div class="border-b border-gray-200 pb-6">
                <h2 class="text-xl font-bold text-gray-900 mb-2">معلومات المحفظة الإلكترونية</h2>
                <p class="text-gray-600 text-sm">املأ المعلومات التالية لإضافة محفظة إلكترونية جديدة</p>
            </div>

            {{-- Form Fields --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Provider --}}
                <div class="space-y-2">
                    <label for="provider" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-layer-group text-blue-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        مقدم الخدمة
                    </label>
                    <input type="text" id="provider" name="provider" required
                           class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300"
                           placeholder="أدخل مقدم الخدمة (مثل: PayPal, MTN Cash)">
                    @error('provider')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Account ID --}}
                <div class="space-y-2">
                    <label for="account_id" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-id-card text-purple-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        معرف الحساب
                    </label>
                    <input type="text" id="account_id" name="account_id" required
                           class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 font-mono"
                           placeholder="أدخل معرف الحساب أو رقم المحفظة">
                    @error('account_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Currency Type --}}
                <div class="space-y-2">
                    <label for="currency_type" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-coins text-yellow-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        نوع العملة
                    </label>
                    <select id="currency_type" name="currency_type" class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
                        <option value="">اختر نوع العملة (اختياري)</option>
                        <option value="USD">دولار أمريكي (USD)</option>
                        <option value="EUR">يورو (EUR)</option>
                        <option value="SYP">ليرة سورية (SYP)</option>
                        <option value="LY">دينار ليبي (LY)</option>
                        <option value="EGP">جنيه مصري (EGP)</option>
                        <option value="SAR">ريال سعودي (SAR)</option>
                        <option value="AED">درهم إماراتي (AED)</option>
                        <option value="BTC">بيتكوين (BTC)</option>
                        <option value="ETH">إيثيريوم (ETH)</option>
                    </select>
                    @error('currency_type')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Wallet Link --}}
                <div class="space-y-2">
                    <label for="wallet_link" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-link text-indigo-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        رابط المحفظة (اختياري)
                    </label>
                    <input type="url" id="wallet_link" name="wallet_link"
                           class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300"
                           placeholder="أدخل رابط المحفظة إن وجد">
                    @error('wallet_link')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.e-wallets.index') }}"
                   class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-times {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    إلغاء
                </a>
                <button type="submit"
                        class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-lg hover:shadow-xl">
                    <i class="fas fa-save {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    حفظ المحفظة
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
