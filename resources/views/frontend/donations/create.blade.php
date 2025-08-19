@extends('frontend.layouts.app')

@section('title', app()->getLocale() === 'ar' ? 'تبرع للمشروع - إيطا' : 'Donate to Project - Eata')

@section('content')
<div class="container mx-auto px-4 py-20">
    <!-- Breadcrumbs -->
    <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mb-8" data-aos="fade-right">
        <a href="{{ route('home') }}" class="text-gray-500 hover:text-charity-600 transition-colors">
            <i class="fas fa-home"></i>
        </a>
        <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
        @if($selectedProject)
        <a href="{{ route('projects.show', $selectedProject->id) }}" class="text-gray-500 hover:text-charity-600 transition-colors">
            {{ $selectedProject->translated_title }}
        </a>
        <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
        @endif
        <span class="text-gray-700 font-medium">{{ app()->getLocale() === 'ar' ? 'تبرع' : 'Donate' }}</span>
    </nav>

    <div class="max-w-4xl mx-auto">
        <!-- Project Info (if selected) -->
        @if($selectedProject)
        <div class="bg-gradient-to-r from-charity-500 to-charity-600 text-white rounded-3xl p-8 mb-8" data-aos="fade-up">
            <div class="flex items-center gap-6">
                @if($selectedProject->image_or_video)
                <img src="{{ asset('/' . $selectedProject->image_or_video) }}" alt="{{ $selectedProject->translated_title }}" class="w-24 h-24 rounded-2xl object-cover">
                @else
                <div class="w-24 h-24 bg-white/20 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-hands-helping text-3xl"></i>
                </div>
                @endif
                <div class="flex-1">
                    <h2 class="text-2xl font-bold mb-2">{{ app()->getLocale() === 'ar' ? 'تبرع لمشروع:' : 'Donate to Project:' }}</h2>
                    <h3 class="text-xl font-semibold mb-2">{{ $selectedProject->translated_title }}</h3>
                    <p class="text-white/90">{{ Str::limit($selectedProject->translated_description, 120) }}</p>
                    <div class="mt-4 flex items-center gap-4">
                        <span class="text-sm">{{ app()->getLocale() === 'ar' ? 'الهدف:' : 'Goal:' }} {{ number_format($selectedProject->total_amount) }} ل.س</span>
                        <span class="text-sm">{{ app()->getLocale() === 'ar' ? 'تم جمع:' : 'Raised:' }} {{ number_format($selectedProject->total_amount - $selectedProject->remaining_amount) }} ل.س</span>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Donation Form -->
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden" data-aos="fade-up">
            <div class="bg-gradient-to-r from-charity-50 to-charity-100 p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">
                    {{ app()->getLocale() === 'ar' ? 'نموذج التبرع' : 'Donation Form' }}
                </h1>
                <p class="text-gray-600">
                    {{ app()->getLocale() === 'ar' ? 'املأ النموذج أدناه لإتمام تبرعك وساعد في خدمة الإنسانية' : 'Fill out the form below to complete your donation and help serve humanity' }}
                </p>
            </div>

            <form method="POST" action="{{ route('donations.store') }}" enctype="multipart/form-data" class="p-8 space-y-8">
                @csrf

                <!-- Hidden field for project_id -->
                @if($selectedProject)
                <input type="hidden" name="project_id" value="{{ $selectedProject->id }}">
                @endif

                <!-- اختيار المشروع (إذا لم يكن محدد) -->
                @if(!$selectedProject)
                <div class="space-y-3">
                    <label for="project_id" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-project-diagram text-charity-500 mr-2"></i>
                        {{ app()->getLocale() === 'ar' ? 'اختر المشروع (اختياري)' : 'Select Project (Optional)' }}
                    </label>
                    <select id="project_id" name="project_id" class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-charity-500 transition-all duration-300">
                        <option value="">{{ app()->getLocale() === 'ar' ? 'تبرع عام' : 'General Donation' }}</option>
                        @foreach($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->translated_title }}</option>
                        @endforeach
                    </select>
                    @error('project_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                @endif

                <!-- مبلغ التبرع -->
                <div class="space-y-3">
                    <label for="amount" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-money-bill-wave text-green-500 mr-2"></i>
                        {{ app()->getLocale() === 'ar' ? 'مبلغ التبرع (ل.س)' : 'Donation Amount (SYP)' }}
                    </label>
                    <input type="number" id="amount" name="amount" step="0.01" min="1" required
                           class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-charity-500 transition-all duration-300 text-lg font-semibold"
                           placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل مبلغ التبرع' : 'Enter donation amount' }}"
                           value="{{ old('amount', 100) }}">
                    @error('amount')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <!-- أزرار المبالغ السريعة -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-4">
                        <button type="button" class="amount-btn px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-xl hover:bg-charity-100 hover:text-charity-600 transition-all duration-300" data-amount="50">50 ل.س</button>
                        <button type="button" class="amount-btn px-4 py-2 text-sm font-medium text-white bg-charity-600 rounded-xl transition-all duration-300" data-amount="100">100 ل.س</button>
                        <button type="button" class="amount-btn px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-xl hover:bg-charity-100 hover:text-charity-600 transition-all duration-300" data-amount="250">250 ل.س</button>
                        <button type="button" class="amount-btn px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-xl hover:bg-charity-100 hover:text-charity-600 transition-all duration-300" data-amount="500">500 ل.س</button>
                    </div>
                </div>

                <!-- معلومات المتبرع -->
                <div class="bg-gray-50 rounded-2xl p-6 space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-user text-blue-500 mr-2"></i>
                        {{ app()->getLocale() === 'ar' ? 'معلومات المتبرع' : 'Donor Information' }}
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- الاسم -->
                        <div class="space-y-2">
                            <label for="donor_name" class="block text-sm font-medium text-gray-700">
                                {{ app()->getLocale() === 'ar' ? 'الاسم الكامل' : 'Full Name' }}
                            </label>
                            <input type="text" id="donor_name" name="donor_name" required
                                   class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-charity-500 transition-all duration-300"
                                   placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل اسمك الكامل' : 'Enter your full name' }}"
                                   value="{{ old('donor_name', auth()->user()->name ?? '') }}">
                            @error('donor_name')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- البريد الإلكتروني -->
                        <div class="space-y-2">
                            <label for="donor_email" class="block text-sm font-medium text-gray-700">
                                {{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني' : 'Email Address' }}
                            </label>
                            <input type="email" id="donor_email" name="donor_email" required
                                   class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-charity-500 transition-all duration-300"
                                   placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل بريدك الإلكتروني' : 'Enter your email address' }}"
                                   value="{{ old('donor_email', auth()->user()->email ?? '') }}">
                            @error('donor_email')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- رقم الهاتف -->
                        <div class="space-y-2 md:col-span-2">
                            <label for="donor_phone" class="block text-sm font-medium text-gray-700">
                                {{ app()->getLocale() === 'ar' ? 'رقم الهاتف' : 'Phone Number' }}
                            </label>
                            <input type="tel" id="donor_phone" name="donor_phone" required
                                   class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-charity-500 transition-all duration-300"
                                   placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل رقم هاتفك' : 'Enter your phone number' }}"
                                   value="{{ old('donor_phone') }}">
                            @error('donor_phone')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- طريقة الدفع -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-credit-card text-purple-500 mr-2"></i>
                        {{ app()->getLocale() === 'ar' ? 'طريقة الدفع' : 'Payment Method' }}
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- حساب بنكي -->
                        <label class="relative">
                            <input type="radio" name="payment_method" value="bank_account" class="sr-only payment-method-radio" required>
                            <div class="payment-method-card border-2 border-gray-200 rounded-2xl p-6 cursor-pointer hover:border-charity-300 transition-all duration-300">
                                <div class="text-center">
                                    <i class="fas fa-university text-3xl text-gray-400 mb-3"></i>
                                    <h4 class="font-semibold text-gray-900">{{ app()->getLocale() === 'ar' ? 'حساب بنكي' : 'Bank Account' }}</h4>
                                    <p class="text-sm text-gray-600 mt-1">{{ app()->getLocale() === 'ar' ? 'تحويل بنكي' : 'Bank Transfer' }}</p>
                                </div>
                            </div>
                        </label>

                        <!-- محفظة إلكترونية -->
                        <label class="relative">
                            <input type="radio" name="payment_method" value="e_wallet" class="sr-only payment-method-radio">
                            <div class="payment-method-card border-2 border-gray-200 rounded-2xl p-6 cursor-pointer hover:border-charity-300 transition-all duration-300">
                                <div class="text-center">
                                    <i class="fas fa-wallet text-3xl text-gray-400 mb-3"></i>
                                    <h4 class="font-semibold text-gray-900">{{ app()->getLocale() === 'ar' ? 'محفظة إلكترونية' : 'E-Wallet' }}</h4>
                                    <p class="text-sm text-gray-600 mt-1">{{ app()->getLocale() === 'ar' ? 'دفع رقمي' : 'Digital Payment' }}</p>
                                </div>
                            </div>
                        </label>

                        <!-- نقدي -->
                        <label class="relative">
                            <input type="radio" name="payment_method" value="cash" class="sr-only payment-method-radio">
                            <div class="payment-method-card border-2 border-gray-200 rounded-2xl p-6 cursor-pointer hover:border-charity-300 transition-all duration-300">
                                <div class="text-center">
                                    <i class="fas fa-money-bill-alt text-3xl text-gray-400 mb-3"></i>
                                    <h4 class="font-semibold text-gray-900">{{ app()->getLocale() === 'ar' ? 'نقدي' : 'Cash' }}</h4>
                                    <p class="text-sm text-gray-600 mt-1">{{ app()->getLocale() === 'ar' ? 'تسليم يدوي' : 'Hand Delivery' }}</p>
                                </div>
                            </div>
                        </label>
                    </div>
                    @error('payment_method')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- تفاصيل الحساب البنكي -->
                <div id="bank_account_details" class="payment-details hidden space-y-4">
                    <h4 class="font-semibold text-gray-900">{{ app()->getLocale() === 'ar' ? 'اختر الحساب البنكي' : 'Select Bank Account' }}</h4>
                    <div class="space-y-3">
                        @foreach($bankAccounts as $bank)
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-charity-300 transition-all duration-300">
                            <input type="radio" name="bank_account_id" value="{{ $bank->id }}" class="mr-3">
                            <div class="flex-1">
                                <div class="font-semibold">{{ $bank->bank_name }}</div>
                                <div class="text-sm text-gray-600">{{ $bank->account_number }}</div>
                                @if($bank->iban)
                                <div class="text-xs text-gray-500">IBAN: {{ $bank->iban }}</div>
                                @endif
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @error('bank_account_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- تفاصيل المحفظة الإلكترونية -->
                <div id="e_wallet_details" class="payment-details hidden space-y-4">
                    <h4 class="font-semibold text-gray-900">{{ app()->getLocale() === 'ar' ? 'اختر المحفظة الإلكترونية' : 'Select E-Wallet' }}</h4>
                    <div class="space-y-3">
                        @foreach($eWallets as $wallet)
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-charity-300 transition-all duration-300">
                            <input type="radio" name="e_wallet_id" value="{{ $wallet->id }}" class="mr-3">
                            <div class="flex-1">
                                <div class="font-semibold">{{ $wallet->provider }}</div>
                                <div class="text-sm text-gray-600">{{ $wallet->account_id }}</div>
                                @if($wallet->currency_type)
                                <div class="text-xs text-gray-500">{{ $wallet->currency_type }}</div>
                                @endif
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @error('e_wallet_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- إثبات الدفع -->
                <div id="payment_proof_section" class="hidden space-y-3">
                    <label for="payment_proof" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-file-upload text-indigo-500 mr-2"></i>
                        {{ app()->getLocale() === 'ar' ? 'إثبات الدفع (اختياري)' : 'Payment Proof (Optional)' }}
                    </label>
                    <input type="file" id="payment_proof" name="payment_proof" accept="image/*,application/pdf"
                           class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-charity-500 transition-all duration-300">
                    <p class="text-sm text-gray-500">{{ app()->getLocale() === 'ar' ? 'يمكنك رفع صورة لإيصال الدفع (JPG, PNG, PDF)' : 'You can upload an image of payment receipt (JPG, PNG, PDF)' }}</p>
                    @error('payment_proof')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ملاحظات إضافية -->
                <div class="space-y-3">
                    <label for="notes" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-sticky-note text-yellow-500 mr-2"></i>
                        {{ app()->getLocale() === 'ar' ? 'ملاحظات إضافية (اختياري)' : 'Additional Notes (Optional)' }}
                    </label>
                    <textarea id="notes" name="notes" rows="3"
                              class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-charity-500 focus:border-charity-500 transition-all duration-300 resize-none"
                              placeholder="{{ app()->getLocale() === 'ar' ? 'أي ملاحظات أو رسالة إضافية...' : 'Any additional notes or message...' }}">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- أزرار النموذج -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <a href="{{ $selectedProject ? route('projects.show', $selectedProject->id) : route('projects.index') }}"
                       class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{ app()->getLocale() === 'ar' ? 'العودة' : 'Back' }}
                    </a>
                    <button type="submit"
                            class="flex-1 inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-white bg-gradient-to-r from-charity-500 to-charity-600 hover:from-charity-600 hover:to-charity-700 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-charity-500 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <i class="fas fa-heart mr-2"></i>
                        {{ app()->getLocale() === 'ar' ? 'تأكيد التبرع' : 'Confirm Donation' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // أزرار المبالغ السريعة
    const amountButtons = document.querySelectorAll('.amount-btn');
    const amountInput = document.getElementById('amount');

    amountButtons.forEach(button => {
        button.addEventListener('click', function() {
            const amount = this.dataset.amount;
            amountInput.value = amount;

            // تحديث الأزرار النشطة
            amountButtons.forEach(btn => {
                btn.classList.remove('bg-charity-600', 'text-white');
                btn.classList.add('bg-gray-100', 'text-gray-700');
            });
            this.classList.remove('bg-gray-100', 'text-gray-700');
            this.classList.add('bg-charity-600', 'text-white');
        });
    });

    // طريقة الدفع
    const paymentMethodRadios = document.querySelectorAll('.payment-method-radio');
    const paymentDetails = document.querySelectorAll('.payment-details');
    const paymentProofSection = document.getElementById('payment_proof_section');

    paymentMethodRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            // إخفاء جميع التفاصيل
            paymentDetails.forEach(detail => detail.classList.add('hidden'));

            // تحديث بطاقات طريقة الدفع
            document.querySelectorAll('.payment-method-card').forEach(card => {
                card.classList.remove('border-charity-500', 'bg-charity-50');
                card.classList.add('border-gray-200');
            });

            // تفعيل البطاقة المختارة
            const selectedCard = this.closest('label').querySelector('.payment-method-card');
            selectedCard.classList.remove('border-gray-200');
            selectedCard.classList.add('border-charity-500', 'bg-charity-50');

            // إظهار التفاصيل المناسبة
            if (this.value === 'bank_account') {
                document.getElementById('bank_account_details').classList.remove('hidden');
                paymentProofSection.classList.remove('hidden');
            } else if (this.value === 'e_wallet') {
                document.getElementById('e_wallet_details').classList.remove('hidden');
                paymentProofSection.classList.remove('hidden');
            } else {
                paymentProofSection.classList.add('hidden');
            }
        });
    });
});
</script>
@endsection
