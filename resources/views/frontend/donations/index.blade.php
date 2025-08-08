@extends('frontend.layouts.app')

@section('title', app()->getLocale() === 'ar' ? 'تبرع سريع - إيطا' : 'Quick Donation - Eata')
@section('description', app()->getLocale() === 'ar' ? 'تبرع الآن وساعد في خدمة الإنسانية - منصة إيطا للتبرعات الخيرية' : 'Donate now and help serve humanity - Eata Charity Platform')

@section('content')
    <!--==============================
        Hero Section - تصميم جديد عصري
        ==============================-->
    <section class="relative py-[25vh] bg-gradient-to-br from-charity-500 via-charity-600 to-charity-700 overflow-hidden">
        <!-- خلفية متحركة -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 {{ app()->getLocale() === 'ar' ? 'right-10' : 'left-10' }} w-72 h-72 bg-white rounded-full mix-blend-multiply filter blur-xl animate-pulse"></div>
            <div class="absolute bottom-10 {{ app()->getLocale() === 'ar' ? 'left-10' : 'right-10' }} w-48 h-48 bg-warm-300 rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-200"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center" data-aos="fade-up">
                <span class="inline-block px-6 py-2 text-sm font-medium text-white bg-white/20 backdrop-blur-sm rounded-full mb-6">
                    {{ app()->getLocale() === 'ar' ? '💝 تبرع سريع' : '💝 Quick Donation' }}
                </span>
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight font-{{ app()->getLocale() === 'ar' ? 'arabic' : 'english' }}">
                    {{ app()->getLocale() === 'ar' ? 'تبرع الآن' : 'Donate Now' }}
                    <span class="block bg-gradient-to-r from-warm-300 to-warm-400 bg-clip-text text-transparent">
                        {{ app()->getLocale() === 'ar' ? 'وساعد الآخرين' : 'and Help Others' }}
                    </span>
                </h1>
                <p class="text-xl text-white/90 max-w-3xl mx-auto leading-relaxed">
                    {{ app()->getLocale() === 'ar' ? 'كل تبرع، مهما كان صغيراً، يصنع فرقاً كبيراً في حياة الناس. انضم إلينا في رحلة التغيير الإيجابي.' : 'Every donation, no matter how small, makes a big difference in people\'s lives. Join us on the journey of positive change.' }}
                </p>
            </div>
        </div>
    </section>

    <!--==============================
        نموذج التبرع
        ==============================-->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- عنوان القسم -->
                <div class="text-center mb-16" data-aos="fade-up">
                    <span class="inline-block px-6 py-2 text-sm font-medium text-charity-600 bg-charity-100 rounded-full mb-4">
                        {{ app()->getLocale() === 'ar' ? '💳 نموذج التبرع' : '💳 Donation Form' }}
                    </span>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 font-{{ app()->getLocale() === 'ar' ? 'arabic' : 'english' }}">
                        {{ app()->getLocale() === 'ar' ? 'تبرع سريع' : 'Quick Donation' }}
                    </h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                        {{ app()->getLocale() === 'ar' ? 'املأ النموذج أدناه لتقديم تبرعك وساعد في خدمة الإنسانية' : 'Fill out the form below to make your donation and help serve humanity' }}
                    </p>
                </div>

                <!-- ملاحظة الاختبار -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-3xl p-6 mb-8" data-aos="fade-up">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle text-yellow-600 mt-1 mr-3 text-xl"></i>
                        <div>
                            <p class="text-sm text-yellow-800 font-medium mb-2">
                                {{ app()->getLocale() === 'ar' ? 'ملاحظة:' : 'Note:' }}
                            </p>
                            <p class="text-sm text-yellow-700">
                                {{ app()->getLocale() === 'ar' ? 'يتم تمكين وضع الاختبار. لا تبرعات حية تتم معالجتها في هذا الوضع.' : 'Test mode is enabled. No live donations are processed in this mode.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- النموذج -->
                <div class="bg-white rounded-3xl shadow-xl p-8 md:p-12 border border-gray-100" data-aos="fade-up" data-aos-delay="200">
                    <form method="post" id="details_donation" action="{{ route('donations.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? null }}">

                        <!-- مبلغ التبرع -->
                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                {{ app()->getLocale() === 'ar' ? 'مبلغ التبرع' : 'Donation Amount' }}
                            </label>
                            <div class="relative mb-6">
                                <input type="text" 
                                       value="100" 
                                       id="amount" 
                                       name="total_price" 
                                       required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent text-lg font-semibold">
                                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 font-semibold">$</span>
                            </div>

                            <!-- أزرار المبالغ السريعة -->
                            <div class="grid grid-cols-3 gap-2">
                                <button type="button" class="donate-amount-button px-4 py-3 text-sm font-medium text-gray-700 bg-gray-100 rounded-xl hover:bg-charity-100 hover:text-charity-600 transition-all duration-300" data-amount="20">$20</button>
                                <button type="button" class="donate-amount-button px-4 py-3 text-sm font-medium text-gray-700 bg-gray-100 rounded-xl hover:bg-charity-100 hover:text-charity-600 transition-all duration-300" data-amount="50">$50</button>
                                <button type="button" class="donate-amount-button active px-4 py-3 text-sm font-medium text-white bg-charity-600 rounded-xl transition-all duration-300" data-amount="100">$100</button>
                                <button type="button" class="donate-amount-button px-4 py-3 text-sm font-medium text-gray-700 bg-gray-100 rounded-xl hover:bg-charity-100 hover:text-charity-600 transition-all duration-300" data-amount="150">$150</button>
                                <button type="button" class="donate-amount-button px-4 py-3 text-sm font-medium text-gray-700 bg-gray-100 rounded-xl hover:bg-charity-100 hover:text-charity-600 transition-all duration-300" data-amount="200">$200</button>
                                <button type="button" class="donate-amount-button px-4 py-3 text-sm font-medium text-gray-700 bg-gray-100 rounded-xl hover:bg-charity-100 hover:text-charity-600 transition-all duration-300 col-span-3" data-amount="custom">{{ app()->getLocale() === 'ar' ? 'مبلغ مخصص' : 'Custom Amount' }}</button>
                            </div>
                        </div>

                        <!-- طريقة الدفع -->
                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                {{ app()->getLocale() === 'ar' ? 'طريقة الدفع' : 'Payment Method' }}
                            </label>
                            <div class="space-y-3">
                                <label class="flex items-center p-4 border border-gray-200 rounded-2xl hover:border-charity-300 cursor-pointer transition-all duration-300">
                                    <input type="radio" name="payment_method" value="e_wallet" class="mr-3 text-charity-600 focus:ring-charity-500" onclick="showPaymentOptions()">
                                    <div class="flex items-center">
                                        <i class="fas fa-wallet text-charity-600 mr-3"></i>
                                        <span class="font-medium">{{ app()->getLocale() === 'ar' ? 'محفظة إلكترونية' : 'E-Wallet' }}</span>
                                    </div>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-2xl hover:border-charity-300 cursor-pointer transition-all duration-300">
                                    <input type="radio" name="payment_method" value="bank_account" class="mr-3 text-charity-600 focus:ring-charity-500" onclick="showPaymentOptions()">
                                    <div class="flex items-center">
                                        <i class="fas fa-university text-charity-600 mr-3"></i>
                                        <span class="font-medium">{{ app()->getLocale() === 'ar' ? 'حساب بنكي' : 'Bank Account' }}</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- خيارات الحساب البنكي -->
                        <div id="bank_options" class="mb-6 hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                {{ app()->getLocale() === 'ar' ? 'اختر الحساب البنكي' : 'Select Bank Account' }}
                            </label>
                            <select id="bank_account_select" name="account_bank_id" class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent" onchange="showBankDetails()">
                                <option value="">{{ app()->getLocale() === 'ar' ? 'اختر الحساب البنكي' : 'Select Bank Account' }}</option>
                                @foreach ($bankAccounts as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->bank_name }} - {{ $bank->account_name }}</option>
                                @endforeach
                            </select>
                            <div id="bank_details" class="mt-3 p-4 bg-gray-50 rounded-2xl hidden"></div>
                        </div>

                        <!-- خيارات المحفظة الإلكترونية -->
                        <div id="wallet_options" class="mb-6 hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                {{ app()->getLocale() === 'ar' ? 'اختر المحفظة الإلكترونية' : 'Select E-Wallet' }}
                            </label>
                            <select id="wallet_account_select" name="e_wallet_id" class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent" onchange="showWalletDetails()">
                                <option value="">{{ app()->getLocale() === 'ar' ? 'اختر المحفظة الإلكترونية' : 'Select E-Wallet' }}</option>
                                @foreach ($eWallets as $wallet)
                                    <option value="{{ $wallet->id }}">{{ $wallet->provider }} - {{ $wallet->account_id }}</option>
                                @endforeach
                            </select>
                            <div id="wallet_details" class="mt-3 p-4 bg-gray-50 rounded-2xl hidden"></div>
                        </div>

                        <!-- معلومات المتبرع -->
                        <div class="bg-gray-50 rounded-2xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                {{ app()->getLocale() === 'ar' ? 'معلومات المتبرع' : 'Donor Information' }}
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'الاسم الأول' : 'First Name' }}
                                    </label>
                                    <input type="text" 
                                           name="first_name" 
                                           id="first_name" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300"
                                           placeholder="{{ app()->getLocale() === 'ar' ? 'اسمك' : 'Your name' }}">
                                </div>

                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'الاسم الأخير' : 'Last Name' }}
                                    </label>
                                    <input type="text" 
                                           name="last_name" 
                                           id="last_name" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300"
                                           placeholder="{{ app()->getLocale() === 'ar' ? 'اسم العائلة' : 'Family name' }}">
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني' : 'Email' }}
                                    </label>
                                    <input type="email" 
                                           name="email" 
                                           id="email" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300"
                                           placeholder="{{ app()->getLocale() === 'ar' ? 'بريدك الإلكتروني' : 'Your email' }}">
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'ar' ? 'رقم الهاتف' : 'Phone Number' }}
                                    </label>
                                    <input type="text" 
                                           name="phone" 
                                           id="phone" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-300"
                                           placeholder="{{ app()->getLocale() === 'ar' ? 'رقم هاتفك' : 'Your phone number' }}">
                                </div>
                            </div>
                        </div>

                        <!-- زر التبرع -->
                        <div class="text-center pt-6">
                            <button type="submit" 
                                    class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-charity-500 to-charity-600 hover:from-charity-600 hover:to-charity-700 rounded-full transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                                <i class="fas fa-heart {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></i>
                                {{ app()->getLocale() === 'ar' ? 'تبرع الآن' : 'Donate Now' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    // ترجمة النصوص
    const translations = {
        ar: {
            bankName: 'اسم البنك',
            accountName: 'اسم الحساب',
            accountNumber: 'رقم الحساب',
            provider: 'مزود الخدمة',
            accountId: 'معرف الحساب',
            currencyType: 'نوع العملة',
            openWalletLink: 'فتح رابط المحفظة',
            errorFetchingDetails: 'حدث خطأ أثناء جلب البيانات'
        },
        en: {
            bankName: 'Bank Name',
            accountName: 'Account Name',
            accountNumber: 'Account Number',
            provider: 'Provider',
            accountId: 'Account ID',
            currencyType: 'Currency Type',
            openWalletLink: 'Open Wallet Link',
            errorFetchingDetails: 'Error fetching details'
        }
    };

    // تحديد اللغة الحالية
    const currentLocale = '{{ app()->getLocale() }}';
    const isRTL = currentLocale === 'ar';

    // أزرار المبالغ السريعة
    document.querySelectorAll('.donate-amount-button').forEach(button => {
        button.addEventListener('click', function() {
            // إزالة الفئة النشطة من جميع الأزرار
            document.querySelectorAll('.donate-amount-button').forEach(btn => {
                btn.classList.remove('active', 'bg-charity-600', 'text-white');
                btn.classList.add('bg-gray-100', 'text-gray-700');
            });
            
            // إضافة الفئة النشطة للزر المحدد
            this.classList.remove('bg-gray-100', 'text-gray-700');
            this.classList.add('active', 'bg-charity-600', 'text-white');
            
            // تحديث قيمة المبلغ
            const amount = this.getAttribute('data-amount');
            if (amount !== 'custom') {
                document.getElementById('amount').value = amount;
            }
        });
    });

    // إظهار خيارات الدفع
    function showPaymentOptions() {
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
        
        // إخفاء جميع الخيارات
        document.getElementById('bank_options').classList.add('hidden');
        document.getElementById('wallet_options').classList.add('hidden');
        
        // إظهار الخيار المناسب
        if (paymentMethod === 'bank_account') {
            document.getElementById('bank_options').classList.remove('hidden');
        } else if (paymentMethod === 'e_wallet') {
            document.getElementById('wallet_options').classList.remove('hidden');
        }
    }

    // إظهار تفاصيل الحساب البنكي
    function showBankDetails() {
        const select = document.getElementById('bank_account_select');
        const detailsDiv = document.getElementById('bank_details');
        
        if (select.value) {
            detailsDiv.innerHTML = '<div class="flex justify-center"><i class="fas fa-spinner fa-spin text-charity-600"></i></div>';
            detailsDiv.classList.remove('hidden');
            
            fetch(`/bank-accounts/${select.value}/details`)
                .then(response => response.json())
                .then(data => {
                    detailsDiv.innerHTML = `
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">${translations[currentLocale].bankName}</span>
                                <span class="font-medium">${data.bank_name}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">${translations[currentLocale].accountName}</span>
                                <span class="font-medium">${data.account_name}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">${translations[currentLocale].accountNumber}</span>
                                <span class="font-medium">${data.account_number}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">IBAN</span>
                                <span class="font-medium">${data.iban}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">SWIFT Code</span>
                                <span class="font-medium">${data.swift_code}</span>
                            </div>
                        </div>
                    `;
                })
                .catch(error => {
                    detailsDiv.innerHTML = `
                        <div class="text-red-600 text-sm">
                            ${translations[currentLocale].errorFetchingDetails}
                        </div>
                    `;
                });
        } else {
            detailsDiv.classList.add('hidden');
        }
    }

    // إظهار تفاصيل المحفظة الإلكترونية
    function showWalletDetails() {
        const select = document.getElementById('wallet_account_select');
        const detailsDiv = document.getElementById('wallet_details');
        
        if (select.value) {
            detailsDiv.innerHTML = '<div class="flex justify-center"><i class="fas fa-spinner fa-spin text-charity-600"></i></div>';
            detailsDiv.classList.remove('hidden');
            
            fetch(`/e-wallets/${select.value}/details`)
                .then(response => response.json())
                .then(data => {
                    detailsDiv.innerHTML = `
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">${translations[currentLocale].provider}</span>
                                <span class="font-medium">${data.provider}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">${translations[currentLocale].accountId}</span>
                                <span class="font-medium">${data.account_id}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">${translations[currentLocale].currencyType}</span>
                                <span class="font-medium">${data.currency_type}</span>
                            </div>
                            ${data.wallet_link ? `
                                <div class="mt-4">
                                    <a href="${data.wallet_link}" target="_blank" 
                                       class="inline-flex items-center justify-center w-full px-4 py-2 bg-charity-100 text-charity-600 rounded-xl hover:bg-charity-200 transition-all duration-300">
                                        <i class="fas fa-external-link-alt ${isRTL ? 'ml-2' : 'mr-2'}"></i>
                                        ${translations[currentLocale].openWalletLink}
                                    </a>
                                </div>
                            ` : ''}
                        </div>
                    `;
                })
                .catch(error => {
                    detailsDiv.innerHTML = `
                        <div class="text-red-600 text-sm">
                            ${translations[currentLocale].errorFetchingDetails}
                        </div>
                    `;
                });
        } else {
            detailsDiv.classList.add('hidden');
        }
    }

    // تأثيرات إضافية للنموذج
    document.addEventListener('DOMContentLoaded', function() {
        // تأثير التركيز على الحقول
        const inputs = document.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-charity-500');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-charity-500');
            });
        });

        // تأثير التحميل عند الإرسال
        const form = document.querySelector('form');
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = `
                <i class="fas fa-spinner fa-spin ${app().getLocale() === 'ar' ? 'ml-3' : 'mr-3'}"></i>
                ${app().getLocale() === 'ar' ? 'جاري التبرع...' : 'Processing...'}
            `;
            submitBtn.disabled = true;
        });
    });
</script>
@endsection
