@extends('layouts.dashboard')

@section('page-title', 'تعديل المحفظة الإلكترونية')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">تعديل المحفظة الإلكترونية</h1>
                <p class="text-gray-600 mt-2">تعديل بيانات المحفظة الإلكترونية: {{ $eWallet->wallet_name ?? $eWallet->provider ?? 'محفظة رقم ' . $eWallet->id }}</p>

                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <a href="{{ route('admin.e-wallets.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">المحافظ الإلكترونية</a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">تعديل المحفظة</span>
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
        <form action="{{ route('admin.e-wallets.update', $eWallet->id) }}" method="POST" class="p-6 lg:p-8 space-y-6">
            @csrf
            @method('PUT')

            {{-- Form Header --}}
            <div class="border-b border-gray-200 pb-6">
                <h2 class="text-xl font-bold text-gray-900 mb-2">تعديل معلومات المحفظة الإلكترونية</h2>
                <p class="text-gray-600 text-sm">قم بتحديث المعلومات حسب الحاجة</p>
            </div>

            {{-- Current Info Display --}}
            <div class="bg-blue-50 border border-blue-200 rounded-2xl p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                        @switch($eWallet->wallet_type ?? $eWallet->provider)
                            @case('paypal')
                                <i class="fab fa-paypal text-white"></i>
                                @break
                            @case('mobile_money')
                                <i class="fas fa-mobile-alt text-white"></i>
                                @break
                            @case('crypto')
                                <i class="fab fa-bitcoin text-white"></i>
                                @break
                            @default
                                <i class="fas fa-wallet text-white"></i>
                        @endswitch
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-900">المعلومات الحالية</h3>
                        <p class="text-sm text-gray-600">
                            {{ $eWallet->wallet_name ?? 'غير محدد' }} -
                            {{ $eWallet->wallet_id ?? $eWallet->account_id ?? 'غير محدد' }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Form Fields --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Wallet Type --}}
                <div class="space-y-2">
                    <label for="wallet_type" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-layer-group text-blue-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        نوع المحفظة
                    </label>
                    <select id="wallet_type" name="wallet_type" required class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
                        <option value="">اختر نوع المحفظة</option>
                        <option value="paypal" {{ ($eWallet->wallet_type ?? $eWallet->provider) == 'paypal' ? 'selected' : '' }}>PayPal</option>
                        <option value="mobile_money" {{ ($eWallet->wallet_type ?? $eWallet->provider) == 'mobile_money' ? 'selected' : '' }}>محفظة جوال</option>
                        <option value="crypto" {{ ($eWallet->wallet_type ?? $eWallet->provider) == 'crypto' ? 'selected' : '' }}>عملة رقمية</option>
                        <option value="other" {{ ($eWallet->wallet_type ?? $eWallet->provider) == 'other' ? 'selected' : '' }}>أخرى</option>
                    </select>
                    @error('wallet_type')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Wallet Name --}}
                <div class="space-y-2">
                    <label for="wallet_name" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-wallet text-green-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        اسم المحفظة
                    </label>
                    <input type="text" id="wallet_name" name="wallet_name" required
                           value="{{ old('wallet_name', $eWallet->wallet_name) }}"
                           class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300"
                           placeholder="أدخل اسم المحفظة (مثل: محفظة التبرعات الرئيسية)">
                    @error('wallet_name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Wallet ID/Address --}}
                <div class="space-y-2">
                    <label for="wallet_id" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-id-card text-purple-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        معرف المحفظة أو العنوان
                    </label>
                    <input type="text" id="wallet_id" name="wallet_id" required
                           value="{{ old('wallet_id', $eWallet->wallet_id ?? $eWallet->account_id) }}"
                           class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 font-mono"
                           placeholder="أدخل معرف المحفظة أو العنوان">
                    @error('wallet_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Currency Type --}}
                <div class="space-y-2">
                    <label for="currency_type" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-coins text-yellow-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        نوع العملة
                    </label>
                    <select id="currency_type" name="currency_type" required class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
                        <option value="">اختر نوع العملة</option>
                        <option value="USD" {{ ($eWallet->currency_type ?? '') == 'USD' ? 'selected' : '' }}>دولار أمريكي (USD)</option>
                        <option value="EUR" {{ ($eWallet->currency_type ?? '') == 'EUR' ? 'selected' : '' }}>يورو (EUR)</option>
                        <option value="SYP" {{ ($eWallet->currency_type ?? '') == 'SYP' ? 'selected' : '' }}>ليرة سورية (SYP)</option>
                        <option value="EGP" {{ ($eWallet->currency_type ?? '') == 'EGP' ? 'selected' : '' }}>جنيه مصري (EGP)</option>
                        <option value="SAR" {{ ($eWallet->currency_type ?? '') == 'SAR' ? 'selected' : '' }}>ريال سعودي (SAR)</option>
                        <option value="AED" {{ ($eWallet->currency_type ?? '') == 'AED' ? 'selected' : '' }}>درهم إماراتي (AED)</option>
                        <option value="BTC" {{ ($eWallet->currency_type ?? '') == 'BTC' ? 'selected' : '' }}>بيتكوين (BTC)</option>
                        <option value="ETH" {{ ($eWallet->currency_type ?? '') == 'ETH' ? 'selected' : '' }}>إيثيريوم (ETH)</option>
                    </select>
                    @error('currency_type')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Additional Information --}}
            <div class="space-y-2">
                <label for="additional_info" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-info-circle text-indigo-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    معلومات إضافية (اختياري)
                </label>
                <textarea id="additional_info" name="additional_info" rows="4"
                          class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 resize-none"
                          placeholder="أدخل أي معلومات إضافية عن المحفظة (مثل: تعليمات خاصة، قيود، إلخ...)">{{ old('additional_info', $eWallet->additional_info ?? '') }}</textarea>
                @error('additional_info')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status --}}
            <div class="flex items-center">
                <input type="checkbox" id="is_active" name="is_active" value="1"
                       {{ ($eWallet->is_active ?? true) ? 'checked' : '' }}
                       class="h-5 w-5 text-blue-600 border-2 border-gray-300 rounded focus:ring-2 focus:ring-blue-500 transition-all duration-300">
                <label for="is_active" class="{{ app()->getLocale() === 'ar' ? 'mr-3' : 'ml-3' }} text-sm font-medium text-gray-700">
                    <i class="fas fa-toggle-on text-green-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    المحفظة نشطة ومتاحة للاستخدام
                </label>
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
                    حفظ التعديلات
                </button>
            </div>
        </form>
    </div>

    {{-- Delete Section --}}
    <div class="bg-red-50 border border-red-200 rounded-3xl p-6">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 bg-red-500 rounded-lg flex items-center justify-center flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-white"></i>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-red-900 mb-2">منطقة خطر</h3>
                <p class="text-red-700 text-sm mb-4">حذف المحفظة الإلكترونية عملية غير قابلة للتراجع. سيتم حذف جميع البيانات المرتبطة بها نهائياً.</p>
                <form action="{{ route('admin.e-wallets.destroy', $eWallet->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('هل أنت متأكد من حذف هذه المحفظة؟ هذا الإجراء لا يمكن التراجع عنه!')"
                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-red-700 bg-red-100 hover:bg-red-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <i class="fas fa-trash {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        حذف المحفظة نهائياً
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Dynamic form behavior
document.getElementById('wallet_type').addEventListener('change', function() {
    const walletIdLabel = document.querySelector('label[for="wallet_id"]');
    const walletIdInput = document.getElementById('wallet_id');

    switch(this.value) {
        case 'paypal':
            walletIdLabel.innerHTML = '<i class="fas fa-envelope text-purple-500 {{ app()->getLocale() === "ar" ? "ml-2" : "mr-2" }}"></i>البريد الإلكتروني لـ PayPal';
            walletIdInput.placeholder = 'أدخل البريد الإلكتروني لحساب PayPal';
            walletIdInput.type = 'email';
            break;
        case 'mobile_money':
            walletIdLabel.innerHTML = '<i class="fas fa-mobile-alt text-purple-500 {{ app()->getLocale() === "ar" ? "ml-2" : "mr-2" }}"></i>رقم الهاتف';
            walletIdInput.placeholder = 'أدخل رقم الهاتف المرتبط بالمحفظة';
            walletIdInput.type = 'tel';
            break;
        case 'crypto':
            walletIdLabel.innerHTML = '<i class="fas fa-wallet text-purple-500 {{ app()->getLocale() === "ar" ? "ml-2" : "mr-2" }}"></i>عنوان المحفظة';
            walletIdInput.placeholder = 'أدخل عنوان المحفظة الرقمية';
            walletIdInput.type = 'text';
            break;
        default:
            walletIdLabel.innerHTML = '<i class="fas fa-id-card text-purple-500 {{ app()->getLocale() === "ar" ? "ml-2" : "mr-2" }}"></i>معرف المحفظة أو العنوان';
            walletIdInput.placeholder = 'أدخل معرف المحفظة أو العنوان';
            walletIdInput.type = 'text';
    }
});

// Initialize form based on current wallet type
document.addEventListener('DOMContentLoaded', function() {
    const walletTypeSelect = document.getElementById('wallet_type');
    if (walletTypeSelect.value) {
        walletTypeSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endsection
