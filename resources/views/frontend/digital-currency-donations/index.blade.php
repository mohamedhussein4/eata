@extends('frontend.layouts.app')

@section('title', app()->getLocale() === 'ar' ? 'التبرع بالعملات الرقمية' : 'Digital Currency Donations')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-yellow-500 via-orange-500 to-red-600 text-white py-20 overflow-hidden">
    <!-- خلفية متحركة -->
    <div class="absolute inset-0">
        <div class="absolute top-10 right-10 w-32 h-32 bg-white/10 rounded-full animate-pulse"></div>
        <div class="absolute bottom-10 left-10 w-24 h-24 bg-white/5 rounded-full animate-pulse animation-delay-1000"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>

        <!-- رموز العملات المتحركة -->
        <div class="absolute top-20 left-1/4 text-white/10 text-4xl animate-bounce">₿</div>
        <div class="absolute bottom-20 right-1/4 text-white/10 text-3xl animate-pulse">Ξ</div>
        <div class="absolute top-1/3 right-1/5 text-white/10 text-2xl animate-spin">$</div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-4xl mx-auto text-center" data-aos="fade-up">
            <div class="mb-6">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white/10 rounded-full mb-6">
                    <i class="fas fa-coins text-3xl"></i>
                </div>
            </div>
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                {{ app()->getLocale() === 'ar' ? 'التبرع بالعملات الرقمية' : 'Digital Currency Donations' }}
            </h1>
            <p class="text-xl md:text-2xl text-white/90 mb-8 leading-relaxed">
                {{ app()->getLocale() === 'ar' ? 'تبرع بشكل آمن وسريع باستخدام العملات المشفرة والمحافظ الإلكترونية' : 'Donate safely and quickly using cryptocurrencies and digital wallets' }}
            </p>

            <!-- مميزات التبرع الرقمي -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6" data-aos="fade-up" data-aos-delay="100">
                    <i class="fas fa-shield-alt text-2xl mb-4"></i>
                    <h3 class="text-lg font-semibold mb-2">{{ app()->getLocale() === 'ar' ? 'آمن ومضمون' : 'Safe & Secure' }}</h3>
                    <p class="text-sm text-white/80">{{ app()->getLocale() === 'ar' ? 'تشفير متقدم لحماية معاملاتك' : 'Advanced encryption to protect your transactions' }}</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6" data-aos="fade-up" data-aos-delay="200">
                    <i class="fas fa-bolt text-2xl mb-4"></i>
                    <h3 class="text-lg font-semibold mb-2">{{ app()->getLocale() === 'ar' ? 'سريع وفوري' : 'Fast & Instant' }}</h3>
                    <p class="text-sm text-white/80">{{ app()->getLocale() === 'ar' ? 'معالجة فورية للتبرعات' : 'Instant processing of donations' }}</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6" data-aos="fade-up" data-aos-delay="300">
                    <i class="fas fa-globe text-2xl mb-4"></i>
                    <h3 class="text-lg font-semibold mb-2">{{ app()->getLocale() === 'ar' ? 'عالمي ومتاح' : 'Global & Available' }}</h3>
                    <p class="text-sm text-white/80">{{ app()->getLocale() === 'ar' ? 'متاح من أي مكان في العالم' : 'Available from anywhere in the world' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- نموذج التبرع -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <!-- عنوان القسم -->
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'ar' ? 'تبرع الآن' : 'Donate Now' }}
                </h2>
                <p class="text-xl text-gray-600">
                    {{ app()->getLocale() === 'ar' ? 'اختر المبلغ وطريقة الدفع المناسبة لك' : 'Choose the amount and payment method that suits you' }}
                </p>
            </div>

            <!-- تنبيه -->
            <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border-l-4 border-yellow-400 p-6 rounded-xl mb-8" data-aos="fade-up">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-yellow-600 text-xl"></i>
                    </div>
                    <div class="ml-3 {{ app()->getLocale() === 'ar' ? 'mr-3 ml-0' : '' }}">
                        <h3 class="text-sm font-semibold text-yellow-800">
                            {{ app()->getLocale() === 'ar' ? 'ملاحظة مهمة' : 'Important Note' }}
                        </h3>
                        <p class="mt-1 text-sm text-yellow-700">
                            {{ app()->getLocale() === 'ar' ? 'يتم تمكين وضع الاختبار. بينما في وضع الاختبار لا تتم معالجة التبرعات الحية.' : 'Test mode is enabled. While in test mode, no live donations are processed.' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- النموذج -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-12" data-aos="fade-up" data-aos-delay="200">
                <form method="post" action="{{ route('digital-currency-donations.store') }}" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <!-- اختيار المبلغ -->
                    <div class="space-y-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">
                            {{ app()->getLocale() === 'ar' ? '💰 اختر مبلغ التبرع' : '💰 Choose Donation Amount' }}
                        </h3>

                        <!-- حقل المبلغ -->
                        <div class="relative">
                            <input type="number" id="amount" name="amount" value="100" min="1" required
                                   class="w-full text-center text-3xl font-bold py-6 px-4 border-2 border-yellow-300 rounded-2xl focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-300 bg-gradient-to-r from-yellow-50 to-orange-50">
                            <span class="absolute {{ app()->getLocale() === 'ar' ? 'right-4' : 'left-4' }} top-1/2 transform -translate-y-1/2 text-2xl font-bold text-yellow-600">ل.س</span>
                        </div>

                        <!-- أزرار المبالغ السريعة -->
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <button type="button" class="amount-btn py-3 px-6 border-2 border-gray-300 rounded-xl hover:border-yellow-500 hover:bg-yellow-50 transition-all duration-300 font-semibold" data-amount="5000">5,000 ل.س</button>
                            <button type="button" class="amount-btn py-3 px-6 border-2 border-gray-300 rounded-xl hover:border-yellow-500 hover:bg-yellow-50 transition-all duration-300 font-semibold" data-amount="10000">10,000 ل.س</button>
                            <button type="button" class="amount-btn py-3 px-6 border-2 border-yellow-500 bg-yellow-50 rounded-xl font-semibold" data-amount="25000">25,000 ل.س</button>
                            <button type="button" class="amount-btn py-3 px-6 border-2 border-gray-300 rounded-xl hover:border-yellow-500 hover:bg-yellow-50 transition-all duration-300 font-semibold" data-amount="50000">50,000 ل.س</button>
                            <button type="button" class="amount-btn py-3 px-6 border-2 border-gray-300 rounded-xl hover:border-yellow-500 hover:bg-yellow-50 transition-all duration-300 font-semibold" data-amount="100000">100,000 ل.س</button>
                            <button type="button" class="amount-btn py-3 px-6 border-2 border-gray-300 rounded-xl hover:border-yellow-500 hover:bg-yellow-50 transition-all duration-300 font-semibold" data-amount="custom">{{ app()->getLocale() === 'ar' ? 'مبلغ آخر' : 'Custom' }}</button>
                        </div>
                    </div>

                    <!-- طريقة الدفع -->
                    <div class="space-y-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">
                            {{ app()->getLocale() === 'ar' ? '💳 اختر طريقة الدفع' : '💳 Choose Payment Method' }}
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- المحفظة الإلكترونية -->
                            <label class="payment-method-card cursor-pointer">
                                <input type="radio" name="payment_method" value="e_wallet" class="sr-only" required>
                                <div class="p-6 border-2 border-gray-300 rounded-2xl transition-all duration-300 hover:border-blue-500 hover:shadow-lg">
                                    <div class="flex items-center justify-center mb-4">
                                        <i class="fas fa-wallet text-3xl text-blue-500"></i>
                                    </div>
                                    <h4 class="text-lg font-semibold text-center mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'المحفظة الإلكترونية' : 'Digital Wallet' }}
                                    </h4>
                                    <p class="text-sm text-gray-600 text-center">
                                        {{ app()->getLocale() === 'ar' ? 'PayPal, Apple Pay, Google Pay' : 'PayPal, Apple Pay, Google Pay' }}
                                    </p>
                                </div>
                            </label>

                            <!-- الحساب البنكي -->
                            <label class="payment-method-card cursor-pointer">
                                <input type="radio" name="payment_method" value="bank_account" class="sr-only" required>
                                <div class="p-6 border-2 border-gray-300 rounded-2xl transition-all duration-300 hover:border-green-500 hover:shadow-lg">
                                    <div class="flex items-center justify-center mb-4">
                                        <i class="fas fa-university text-3xl text-green-500"></i>
                                    </div>
                                    <h4 class="text-lg font-semibold text-center mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'الحساب البنكي' : 'Bank Account' }}
                                    </h4>
                                    <p class="text-sm text-gray-600 text-center">
                                        {{ app()->getLocale() === 'ar' ? 'تحويل بنكي مباشر' : 'Direct bank transfer' }}
                                    </p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- خيارات المحفظة الإلكترونية -->
                    <div id="e_wallet_options" class="payment-options hidden space-y-4">
                        <h4 class="text-lg font-semibold text-gray-900">{{ app()->getLocale() === 'ar' ? 'اختر المحفظة الإلكترونية' : 'Choose Digital Wallet' }}</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach($eWallets as $wallet)
                            <label class="wallet-option cursor-pointer">
                                <input type="radio" name="e_wallet_id" value="{{ $wallet->id }}" class="sr-only wallet-radio">
                                <div class="p-4 border border-gray-300 rounded-xl hover:border-blue-500 transition-all duration-300 text-center payment-option-card">
                                    @switch($wallet->provider)
                                        @case('paypal')
                                            <i class="fab fa-paypal text-2xl text-blue-500 mb-2"></i>
                                            @break
                                        @case('apple_pay')
                                            <i class="fab fa-apple text-2xl text-gray-800 mb-2"></i>
                                            @break
                                        @case('google_pay')
                                            <i class="fab fa-google text-2xl text-green-500 mb-2"></i>
                                            @break
                                        @default
                                            <i class="fas fa-wallet text-2xl text-blue-500 mb-2"></i>
                                    @endswitch
                                    <div class="font-semibold">{{ $wallet->wallet_name }}</div>
                                    <div class="text-sm text-gray-600">{{ $wallet->account_id }}</div>
                                </div>
                            </label>
                            @endforeach
                        </div>
                        <!-- تفاصيل المحفظة المختارة -->
                        <div id="wallet_details" class="hidden mt-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
                            <h5 class="font-semibold mb-3">{{ app()->getLocale() === 'ar' ? 'تفاصيل المحفظة' : 'Wallet Details' }}</h5>
                            <div class="space-y-2"></div>
                        </div>
                    </div>

                    <!-- خيارات الحساب البنكي -->
                    <div id="bank_account_options" class="payment-options hidden space-y-4">
                        <h4 class="text-lg font-semibold text-gray-900">{{ app()->getLocale() === 'ar' ? 'اختر البنك' : 'Choose Bank' }}</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($bankAccounts as $bank)
                            <label class="bank-option cursor-pointer">
                                <input type="radio" name="bank_account_id" value="{{ $bank->id }}" class="sr-only bank-radio">
                                <div class="p-4 border border-gray-300 rounded-xl hover:border-blue-600 transition-all duration-300 payment-option-card">
                                    <div class="flex items-center">
                                        <i class="fas fa-university text-blue-600 mr-3"></i>
                                        <span class="font-semibold">{{ $bank->bank_name }}</span>
                                    </div>
                                    <div class="mt-2 text-sm text-gray-600">
                                        <div>{{ $bank->account_name }}</div>
                                        <div>IBAN: {{ $bank->iban }}</div>
                                    </div>
                                </div>
                            </label>
                            @endforeach
                        </div>
                        <!-- تفاصيل الحساب البنكي المختار -->
                        <div id="bank_details" class="hidden mt-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
                            <h5 class="font-semibold mb-3">{{ app()->getLocale() === 'ar' ? 'تفاصيل الحساب البنكي' : 'Bank Account Details' }}</h5>
                            <div class="space-y-2"></div>
                        </div>
                    </div>

                    <!-- معلومات المتبرع -->
                    <div class="space-y-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">
                            {{ app()->getLocale() === 'ar' ? '👤 معلوماتك الشخصية' : '👤 Your Information' }}
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="donor_name" class="block text-sm font-semibold text-gray-900">
                                    {{ app()->getLocale() === 'ar' ? 'الاسم الكامل' : 'Full Name' }}
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="donor_name" name="name" required
                                       placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل اسمك الكامل' : 'Enter your full name' }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-300">
                            </div>

                            <div class="space-y-2">
                                <label for="donor_email" class="block text-sm font-semibold text-gray-900">
                                    {{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني' : 'Email Address' }}
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="donor_email" name="email" required
                                       placeholder="{{ app()->getLocale() === 'ar' ? 'example@email.com' : 'example@email.com' }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-300">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="phone" class="block text-sm font-semibold text-gray-900">
                                {{ app()->getLocale() === 'ar' ? 'رقم الهاتف' : 'Phone Number' }}
                            </label>
                            <input type="tel" id="phone" name="phone"
                                   placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل رقم هاتفك' : 'Enter your phone number' }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-300">
                        </div>

                        <div class="space-y-2">
                            <label for="proof_document" class="block text-sm font-semibold text-gray-900">
                                {{ app()->getLocale() === 'ar' ? 'مستند إثبات الدفع' : 'Payment Proof Document' }}
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="file" id="proof_document" name="proof_document" required
                                   accept=".jpg,.jpeg,.png,.pdf"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-300">
                            <p class="text-sm text-gray-500 mt-1">
                                {{ app()->getLocale() === 'ar' ? 'الملفات المسموحة: JPG، JPEG، PNG، PDF. الحد الأقصى: 2 ميجابايت' : 'Allowed files: JPG, JPEG, PNG, PDF. Max size: 2MB' }}
                            </p>
                        </div>

                        <div class="space-y-2">
                            <label for="message" class="block text-sm font-semibold text-gray-900">
                                {{ app()->getLocale() === 'ar' ? 'رسالة (اختيارية)' : 'Message (Optional)' }}
                            </label>
                            <textarea id="message" name="notes" rows="4"
                                      placeholder="{{ app()->getLocale() === 'ar' ? 'اكتب رسالة تشجيعية أو دعاء...' : 'Write an encouraging message or prayer...' }}"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-300 resize-none"></textarea>
                        </div>
                    </div>

                    <!-- زر الإرسال -->
                    <div class="pt-6">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-yellow-500 to-orange-600 hover:from-yellow-600 hover:to-orange-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-coins {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></i>
                            {{ app()->getLocale() === 'ar' ? 'إتمام التبرع' : 'Complete Donation' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- العملات المدعومة -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                {{ app()->getLocale() === 'ar' ? 'العملات والطرق المدعومة' : 'Supported Currencies & Methods' }}
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                {{ app()->getLocale() === 'ar' ? 'نقبل مجموعة واسعة من العملات الرقمية وطرق الدفع الآمنة' : 'We accept a wide range of digital currencies and secure payment methods' }}
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6 max-w-4xl mx-auto">
            <div class="text-center p-6 bg-gray-50 rounded-2xl hover:bg-yellow-50 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                <div class="text-3xl mb-2">₿</div>
                <div class="font-semibold text-sm">Bitcoin</div>
            </div>
            <div class="text-center p-6 bg-gray-50 rounded-2xl hover:bg-yellow-50 transition-all duration-300" data-aos="fade-up" data-aos-delay="150">
                <div class="text-3xl mb-2">Ξ</div>
                <div class="font-semibold text-sm">Ethereum</div>
            </div>
            <div class="text-center p-6 bg-gray-50 rounded-2xl hover:bg-yellow-50 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                <i class="fab fa-paypal text-3xl text-blue-500 mb-2"></i>
                <div class="font-semibold text-sm">PayPal</div>
            </div>
            <div class="text-center p-6 bg-gray-50 rounded-2xl hover:bg-yellow-50 transition-all duration-300" data-aos="fade-up" data-aos-delay="250">
                <i class="fab fa-apple-pay text-3xl text-gray-800 mb-2"></i>
                <div class="font-semibold text-sm">Apple Pay</div>
            </div>
            <div class="text-center p-6 bg-gray-50 rounded-2xl hover:bg-yellow-50 transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
                <i class="fab fa-google-pay text-3xl text-green-500 mb-2"></i>
                <div class="font-semibold text-sm">Google Pay</div>
            </div>
            <div class="text-center p-6 bg-gray-50 rounded-2xl hover:bg-yellow-50 transition-all duration-300" data-aos="fade-up" data-aos-delay="350">
                <i class="fas fa-university text-3xl text-blue-600 mb-2"></i>
                <div class="font-semibold text-sm">{{ app()->getLocale() === 'ar' ? 'بنوك محلية' : 'Local Banks' }}</div>
            </div>
        </div>
    </div>
</section>

<style>
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // أزرار المبالغ
    const amountButtons = document.querySelectorAll('.amount-btn');
    const amountInput = document.querySelector('input[name="amount"]');

    amountButtons.forEach(button => {
        button.addEventListener('click', function() {
            // إزالة النمط النشط من جميع الأزرار
            amountButtons.forEach(btn => {
                btn.classList.remove('active', 'border-yellow-500', 'bg-yellow-50');
                btn.classList.add('border-gray-300');
            });
            // إضافة النمط النشط للزر المحدد
            this.classList.remove('border-gray-300');
            this.classList.add('active', 'border-yellow-500', 'bg-yellow-50');

            const amount = this.dataset.amount;
            if (amount !== 'custom') {
                amountInput.value = amount;
            } else {
                amountInput.focus();
            }
        });
    });

    // طرق الدفع
    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
    const eWalletOptions = document.getElementById('e_wallet_options');
    const bankAccountOptions = document.getElementById('bank_account_options');
    const bankDetails = document.getElementById('bank_details');
    const walletDetails = document.getElementById('wallet_details');
    let selectedBankId = null;
    let selectedWalletId = null;

    function hideAllOptions() {
        eWalletOptions.classList.add('hidden');
        bankAccountOptions.classList.add('hidden');
        bankDetails.classList.add('hidden');
        walletDetails.classList.add('hidden');
    }

    function clearSelections() {
        // إلغاء تحديد جميع البنوك
        document.querySelectorAll('.bank-radio').forEach(radio => {
            radio.checked = false;
            radio.closest('.bank-option').classList.remove('selected');
        });
        // إلغاء تحديد جميع المحافظ
        document.querySelectorAll('.wallet-radio').forEach(radio => {
            radio.checked = false;
            radio.closest('.wallet-option').classList.remove('selected');
        });
    }

    paymentMethods.forEach(method => {
        method.addEventListener('change', function() {
            hideAllOptions();
            clearSelections();

            // إظهار الخيارات المناسبة
            if (this.value === 'e_wallet') {
                eWalletOptions.classList.remove('hidden');
                if (selectedWalletId) {
                    const walletRadio = document.querySelector(`.wallet-radio[value="${selectedWalletId}"]`);
                    if (walletRadio) {
                        walletRadio.checked = true;
                        walletRadio.dispatchEvent(new Event('change'));
                    }
                }
            } else if (this.value === 'bank_account') {
                bankAccountOptions.classList.remove('hidden');
                if (selectedBankId) {
                    const bankRadio = document.querySelector(`.bank-radio[value="${selectedBankId}"]`);
                    if (bankRadio) {
                        bankRadio.checked = true;
                        bankRadio.dispatchEvent(new Event('change'));
                    }
                }
            }
        });
    });

    // تطبيق النمط المحدد على البطاقة المختارة
    function applySelectedStyle(element, isSelected) {
        // تحديث النمط على بطاقة البنك
        const bankCard = element.closest('.bank-option')?.querySelector('.payment-option-card');
        if (bankCard) {
            if (isSelected) {
                bankCard.classList.add('border-2', 'border-blue-600', 'bg-blue-50');
            } else {
                bankCard.classList.remove('border-2', 'border-blue-600', 'bg-blue-50');
            }
        }

        // تحديث النمط على بطاقة المحفظة
        const walletCard = element.closest('.wallet-option')?.querySelector('.payment-option-card');
        if (walletCard) {
            if (isSelected) {
                walletCard.classList.add('border-2', 'border-blue-600', 'bg-blue-50');
            } else {
                walletCard.classList.remove('border-2', 'border-blue-600', 'bg-blue-50');
            }
        }
    }

    // عرض تفاصيل البنك عند اختياره
    document.querySelectorAll('.bank-radio').forEach(radio => {
        radio.addEventListener('change', function() {
            const bankId = this.value;
            selectedBankId = bankId;

            // تحديث النمط المرئي
            document.querySelectorAll('.bank-radio').forEach(r => {
                applySelectedStyle(r, r.value === bankId);
            });

            fetch(`/digital-currency-donations/bank-details/${bankId}`)
                .then(response => response.json())
                .then(data => {
                    const detailsDiv = document.querySelector('#bank_details .space-y-2');
                    detailsDiv.innerHTML = `
                        <div class="flex justify-between">
                            <span class="text-gray-600">{{ app()->getLocale() === 'ar' ? 'اسم البنك' : 'Bank Name' }}</span>
                            <span class="font-medium">${data.bank_name}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">{{ app()->getLocale() === 'ar' ? 'اسم صاحب الحساب' : 'Account Name' }}</span>
                            <span class="font-medium">${data.account_name}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">{{ app()->getLocale() === 'ar' ? 'رقم الحساب' : 'Account Number' }}</span>
                            <span class="font-medium">${data.account_number}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">IBAN</span>
                            <span class="font-medium">${data.iban}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">SWIFT</span>
                            <span class="font-medium">${data.swift_code}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">{{ app()->getLocale() === 'ar' ? 'العملة' : 'Currency' }}</span>
                            <span class="font-medium">${data.currency}</span>
                        </div>
                    `;
                    bankDetails.classList.remove('hidden');
                });
        });
    });

    // عرض تفاصيل المحفظة عند اختيارها
    document.querySelectorAll('.wallet-radio').forEach(radio => {
        radio.addEventListener('change', function() {
            const walletId = this.value;
            selectedWalletId = walletId;

            // تحديث النمط المرئي
            document.querySelectorAll('.wallet-radio').forEach(r => {
                applySelectedStyle(r, r.value === walletId);
            });

            fetch(`/digital-currency-donations/wallet-details/${walletId}`)
                .then(response => response.json())
                .then(data => {
                    const detailsDiv = document.querySelector('#wallet_details .space-y-2');
                    detailsDiv.innerHTML = `
                        <div class="flex justify-between">
                            <span class="text-gray-600">{{ app()->getLocale() === 'ar' ? 'اسم المحفظة' : 'Wallet Name' }}</span>
                            <span class="font-medium">${data.wallet_name}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">{{ app()->getLocale() === 'ar' ? 'مزود الخدمة' : 'Provider' }}</span>
                            <span class="font-medium">${data.provider}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">{{ app()->getLocale() === 'ar' ? 'معرف الحساب' : 'Account ID' }}</span>
                            <span class="font-medium">${data.account_id}</span>
                        </div>
                        ${data.wallet_link ? `
                        <div class="mt-3">
                            <a href="${data.wallet_link}" target="_blank" class="text-blue-600 hover:text-blue-800 inline-flex items-center">
                                <i class="fas fa-external-link-alt mr-2"></i>
                                {{ app()->getLocale() === 'ar' ? 'رابط الدفع المباشر' : 'Direct Payment Link' }}
                            </a>
                        </div>
                        ` : ''}
                        ${data.instructions ? `
                        <div class="mt-3 p-3 bg-yellow-50 rounded-lg">
                            <h6 class="font-semibold mb-2">{{ app()->getLocale() === 'ar' ? 'تعليمات الدفع' : 'Payment Instructions' }}</h6>
                            <p class="text-sm text-gray-600">${data.instructions}</p>
                        </div>
                        ` : ''}
                    `;
                    walletDetails.classList.remove('hidden');
                });
        });
    });
});
</script>


@endsection

