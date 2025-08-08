@extends('frontend.layouts.app')

@section('title', app()->getLocale() === 'ar' ? 'سلة التبرعات - إيطا' : 'Donation Cart - Eata')
@section('description', app()->getLocale() === 'ar' ? 'راجع تبرعاتك وأكمل عملية الدفع - منصة إيطا للتبرعات الخيرية' : 'Review your donations and complete payment - Eata Charity Platform')

@section('content')
    <!--==============================
        Hero Section - تصميم جديد عصري
        ==============================-->
    <section class="relative py-20 bg-gradient-to-br from-charity-500 via-charity-600 to-charity-700 overflow-hidden">
        <!-- خلفية متحركة -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 {{ app()->getLocale() === 'ar' ? 'right-10' : 'left-10' }} w-72 h-72 bg-white rounded-full mix-blend-multiply filter blur-xl animate-pulse"></div>
            <div class="absolute bottom-10 {{ app()->getLocale() === 'ar' ? 'left-10' : 'right-10' }} w-48 h-48 bg-warm-300 rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-200"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center" data-aos="fade-up">
                <span class="inline-block px-6 py-2 text-sm font-medium text-white bg-white/20 backdrop-blur-sm rounded-full mb-6">
                    {{ app()->getLocale() === 'ar' ? '🛒 سلة التبرعات' : '🛒 Donation Cart' }}
                </span>
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight font-{{ app()->getLocale() === 'ar' ? 'arabic' : 'english' }}">
                    {{ app()->getLocale() === 'ar' ? 'سلة تبرعاتك' : 'Your Donation Cart' }}
                    <span class="block bg-gradient-to-r from-warm-300 to-warm-400 bg-clip-text text-transparent">
                        {{ app()->getLocale() === 'ar' ? 'وأكمل التبرع' : '& Complete Donation' }}
                    </span>
                </h1>
                <p class="text-xl text-white/90 max-w-3xl mx-auto leading-relaxed">
                    {{ app()->getLocale() === 'ar' ? 'راجع مشاريع التبرع المختارة وأكمل عملية الدفع لمساعدة المحتاجين' : 'Review your selected donation projects and complete the payment to help those in need' }}
                </p>
            </div>
        </div>
    </section>

    <!--==============================
        محتوى سلة التبرعات
        ==============================-->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="mb-8" aria-label="breadcrumb">
                <ol class="flex items-center space-x-2 text-sm text-gray-600">
                    <li><a href="{{ route('home') }}" class="hover:text-charity-600 transition-colors duration-300">{{ app()->getLocale() === 'ar' ? 'الرئيسية' : 'Home' }}</a></li>
                    <li class="flex items-center">
                        <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} mx-2 text-gray-400"></i>
                        <span class="text-charity-600">{{ app()->getLocale() === 'ar' ? 'سلة التبرعات' : 'Donation Cart' }}</span>
                    </li>
                </ol>
            </nav>

            <div id="cart-content" data-errors="">
                @if ($cart->isEmpty())
                    <!-- سلة فارغة -->
                    <div class="max-w-2xl mx-auto text-center" data-aos="fade-up">
                        <div class="bg-white rounded-3xl shadow-xl p-12 border border-gray-100">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-shopping-cart text-4xl text-gray-400"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">
                                {{ app()->getLocale() === 'ar' ? 'سلة التبرعات فارغة' : 'Your Cart is Empty' }}
                            </h3>
                            <p class="text-gray-600 mb-8">
                                {{ app()->getLocale() === 'ar' ? 'لم تقم بإضافة أي مشاريع للتبرع بها بعد. تصفح مشاريعنا الخيرية وابدأ بالتبرع.' : 'You haven\'t added any donation projects yet. Browse our charity projects and start donating.' }}
                            </p>
                            <a href="{{ route('home') }}" 
                               class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-charity-500 to-charity-600 hover:from-charity-600 hover:to-charity-700 rounded-full transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                                <i class="fas fa-heart {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></i>
                                {{ app()->getLocale() === 'ar' ? 'تصفح المشاريع' : 'Browse Projects' }}
                            </a>
                        </div>
                    </div>
                @else
                    <!-- محتوى السلة -->
                    <form action="{{ route('payments.process') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                            <!-- قائمة المشاريع -->
                            <div class="lg:col-span-2 space-y-6" data-aos="fade-up">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                                    {{ app()->getLocale() === 'ar' ? 'مشاريع التبرع' : 'Donation Projects' }}
                                </h2>
                                        @foreach ($cart as $item)
                                            <div class="rounded-12px align-items-center card card-shadow d-flex flex-row justify-content-between mb-30px overflow-hidden itemcartwrapper"
                                                data-cart-id="{{ $item->id }}" data-cart-typeid="Charity"
                                                data-cart-title="{{ $item->project->title }}">
                                                <a class="position-relative"
                                                    href="/projects/{{ $item->project->id }}/{{ $item->id }}?amount=null">
                                                    <div class="img-holder">
                                                        <img class="h-80px w-100"
                                                            src="{{ asset('public/images/' . $item->project->image_or_video) }}"
                                                            onerror="this.src='/assets/images/Default_card.svg';this.onerror='';"
                                                            alt="">
                                                    </div>
                                                    <span
                                                        class="bg-primary-green text-center bottom-0 d-block fs-12px position-absolute py-1 text-capitalize text-white w-100"
                                                        aria-hidden="true">{{ $item->project->title }}</span>
                                                </a>
                                                <div class="ms-3 w-100 case-wrapper pe-3">
                                                    <div class="d-flex flex-md-row justify-content-between mb-3">
                                                        <div class="">
                                                            <h5 class="fs-15px mb--5px text-primary-blue tex-warp text-start mb-1"
                                                                aria-level="3"><span class="visually-hidden">مشاريع عامة -
                                                                </span><a class="text-primary-blue"
                                                                    href="/projects/{{ $item->project->id }}/{{ $item->id }}?amount=null">{{ $item->project->title }}</a>
                                                            </h5>
                                                        </div>
                                                        <button
                                                            class="align-items-center align-self-md-center btn  cart-remove d-flex fas fa-times fs-15px h-30px justify-content-center rounded-circle text-grey-2 hover-delete w-30px"
                                                            data-accountnumber="0" data-initiativetypeid="1"
                                                            data-id="{{ $item->project->id }}" data-priceperunit="1"
                                                            data-cart-id="{{ $item->id }}" data-cart-remove-item="true"
                                                            aria-label="إزالة {{ $item->project->title }} من سلة تبرعاتك"
                                                            fdprocessedid="idppy"></button>
                                                    </div>
                                                    <div class="price-details h-34px mt--5px">
                                                        <input type="number" name="CartItems[{{ $loop->index }}].Amount"
                                                            class="item-amount cart-amount-input ext-primary-green me-1 only-number w-100"
                                                            maxlength="10" onpaste="return false;" ondrop="return false;"
                                                            autocomplete="off"
                                                            onkeydown="if(event.key==='.' || event.key==='-' || event.key==='+'){event.preventDefault();}"
                                                            placeholder="قيمة المبلغ" data-cart-id="{{ $item->id }}"
                                                            value="{{ $item->total_price }}" min="1"
                                                            data-max="235200"
                                                            aria-label="مبلغ التبرع لِ {{ $item->project->title }} (ريال سعودي)"
                                                            inputmode="numeric" pattern="[0-9]*" lang="en">
                                                        <span class="text-primary-green float-end"
                                                            aria-hidden="true">ل.س</span>
                                                        <input type="hidden"
                                                            name="CartItems[{{ $loop->index }}].InitiativeType"
                                                            value="Project">
                                                    </div>

                                                    <label
                                                        class="fs-14px pe-5 remaining-error-msg text-warning w-100 d-none my-1"
                                                        role="alert">أعلى قيمة يمكنك التبرع بها هي <span
                                                            class="maxAmountText">235200</span> ل.س</label>
                                                    <label class="fs-14px pe-5 text-danger w-100 d-none my-1 server-err"
                                                        role="alert"></label>
                                                    <input type="hidden" name="CartItems[{{ $loop->index }}].CaseId"
                                                        value="{{ $item->project->id }}">
                                                    <input type="hidden"
                                                        name="CartItems[{{ $loop->index }}].InitiativeType"
                                                        value="Project">
                                                    <input type="hidden" name="CartItems[{{ $loop->index }}].Title"
                                                        value="{{ $item->project->title }}">
                                                    <input type="hidden"
                                                        name="CartItems[{{ $loop->index }}].AccountNumber" value="0">
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                                <button type="button"
                                    class="align-items-center btn btn-light-grey btn-sm d-flex float-end fs-14px rounded-pill mb-4 valid"
                                    data-bs-toggle="modal" data-bs-target="#removeAllCartItemsModal" fdprocessedid="i606nb"
                                    aria-invalid="false"><i class="fa-trash-alt fas fs-12px me-1"></i>حذف الكل</button>
                            </div>
                            <div class="col-12 col-lg-6 Payment-details-page">
                                <div
                                    class="card card-shadow overflow-auto pb-0 pt-4 rounded-10px shadow-md total-amount ms-md-5 ms-0 decoration overflow-hidden">
                                    <input type="hidden" id="cart_total" name="cart_total"
                                        value="{{ $cart->sum('total_price') }}">
                                    <h6 class="title text-truncate mb-3 text-center" aria-level="3">المجموع</h6>
                                    <div class="amount-unit m-auto text-primary-green w-fit-content">
                                        <span class="amount d-block font-semibold fs-36px lh-16px mt-4"
                                            id="cart_total">{{ $cart->sum('total_price') }}</span>
                                        <span class="float-end me--25px mt--5px text-grey-3 mt-2">ل.س</span>
                                    </div>

                                    <div class="payment p-4">
                                        <!-- اختيار نوع الدفع -->
                                        <div class="mt-3">
                                            <label for="payment_method" class="form-label">اختر نوع الدفع</label>
                                            <select id="payment_method" name="payment_method" class="form-select"
                                                onchange="showPaymentOptions()">
                                                <option value="">اختر نوع الدفع</option>
                                                <option value="bank_account">حساب بنكي</option>
                                                <option value="e_wallet">محفظة إلكترونية</option>
                                            </select>
                                        </div>

                                        <!-- خيارات الحساب البنكي -->
                                        <div id="bank_options" class="d-none mt-4">
                                            <label for="bank_account" class="form-label">اختر الحساب البنكي</label>
                                            <select id="bank_account" name="account_bank_id" class="form-select"
                                                onchange="showBankDetails()">
                                                <option value="">اختر الحساب البنكي</option>
                                                @foreach ($bankAccounts as $bank)
                                                    <option value="{{ $bank->id }}">{{ $bank->bank_name }} -
                                                        {{ $bank->account_name }}</option>
                                                @endforeach
                                            </select>
                                            <div id="bank_details" class="mt-2">
                                                <!-- هنا تظهر تفاصيل الحساب البنكي -->
                                            </div>
                                        </div>

                                        <!-- خيارات المحفظة الإلكترونية -->
                                        <div id="wallet_options" class="d-none mt-4">
                                            <label for="wallet_account" class="form-label">اختر المحفظة
                                                الإلكترونية</label>
                                            <select id="wallet_account" name="e_wallet_id" class="form-select"
                                                onchange="showWalletDetails()">
                                                <option value="">اختر المحفظة الإلكترونية</option>
                                                @foreach ($eWallets as $wallet)
                                                    <option value="{{ $wallet->id }}">{{ $wallet->provider }} -
                                                        {{ $wallet->account_id }}</option>
                                                @endforeach
                                            </select>
                                            <div id="wallet_details" class="mt-2">
                                                <!-- هنا تظهر تفاصيل المحفظة الإلكترونية -->
                                            </div>
                                        </div>

                                        <div id="wallet_transfer_confirmation" class="mt-2">
                                            <label for="confirmation_document" class="form-label">أرفق مستند تأكيد
                                                التحويل</label>
                                            <input type="file" id="confirmation_document" name="confirmation_document"
                                                class="form-control">
                                        </div>

                                    </div>

                                    <div class="bg-light mt-4 py-2 text-center">
                                        <button class="btn btn-primary-blue m-auto my-1 rounded-pill w-70"
                                            type="submit">المتابعة للدفع</button>
                                    </div>
                                </div>
                            </div>

                            <script>
                                function showPaymentOptions() {
                                    const paymentType = document.getElementById("payment_method").value;
                                    document.getElementById("bank_options").classList.toggle("d-none", paymentType !== "bank_account");
                                    document.getElementById("wallet_options").classList.toggle("d-none", paymentType !== "e_wallet");
                                }

                                function showBankDetails() {
                                    const selectedBankId = document.getElementById("bank_account").value;
                                    if (selectedBankId) {
                                        fetch(`/bank-details/${selectedBankId}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                document.getElementById("bank_details").innerHTML = `
                                                    <p><strong>اسم البنك:</strong> ${data.bank_name}</p>
                                                    <p><strong>رقم الحساب:</strong> ${data.account_number}</p>
                                                    <p><strong>IBAN:</strong> ${data.iban}</p>
                                                    <p><strong>Swift Code:</strong> ${data.swift_code}</p>
                                                `;
                                            })
                                            .catch(error => console.error('Error fetching bank details:', error));
                                    } else {
                                        document.getElementById("bank_details").innerHTML = "";
                                    }
                                }

                                function showWalletDetails() {
                                    const selectedWalletId = document.getElementById("wallet_account").value;
                                    if (selectedWalletId) {
                                        fetch(`/wallet-details/${selectedWalletId}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                document.getElementById("wallet_details").innerHTML = `
                                                    <p><strong>مزود الخدمة:</strong> ${data.provider}</p>
                                                    <p><strong>ID الحساب:</strong> ${data.account_id}</p>
                                                `;
                                            })
                                            .catch(error => console.error('Error fetching wallet details:', error));
                                    } else {
                                        document.getElementById("wallet_details").innerHTML = "";
                                    }
                                }
                            </script>



                        </div>
                    </form>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    // حساب إجمالي المبالغ
    function calculateTotal() {
        const amounts = document.querySelectorAll('input[name*="[Amount]"]');
        let total = 0;
        
        amounts.forEach(input => {
            const value = parseFloat(input.value) || 0;
            total += value;
        });
        
        document.getElementById('total-amount').textContent = total.toLocaleString() + ' ل.س';
    }

    // تحديث الإجمالي عند تغيير المبالغ
    document.addEventListener('DOMContentLoaded', function() {
        const amountInputs = document.querySelectorAll('input[name*="[Amount]"]');
        amountInputs.forEach(input => {
            input.addEventListener('input', calculateTotal);
        });
        
        // حساب الإجمالي الأولي
        calculateTotal();

        // إزالة عنصر من السلة
        const removeButtons = document.querySelectorAll('.cart-remove');
        removeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const cartId = this.getAttribute('data-cart-id');
                const projectId = this.getAttribute('data-id');
                
                if (confirm('{{ app()->getLocale() === "ar" ? "هل أنت متأكد من إزالة هذا المشروع من السلة؟" : "Are you sure you want to remove this project from cart?" }}')) {
                    // هنا يمكن إضافة AJAX لإزالة العنصر
                    this.closest('[data-cart-id]').remove();
                    calculateTotal();
                }
            });
        });

        // تأثير التحميل عند الإرسال
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.innerHTML = `
                    <i class="fas fa-spinner fa-spin ${app().getLocale() === 'ar' ? 'ml-3' : 'mr-3'}"></i>
                    ${app().getLocale() === 'ar' ? 'جاري المعالجة...' : 'Processing...'}
                `;
                submitBtn.disabled = true;
            });
        }
    });
</script>
@endsection
