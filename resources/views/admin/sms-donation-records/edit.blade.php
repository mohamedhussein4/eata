@extends('layouts.dashboard')

@section('page-title', 'تعديل سجل تبرع SMS')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">تعديل سجل التبرع #{{ $donationRecord->id }}</h1>
                <p class="text-gray-600 mt-2">قم بتحديث بيانات سجل التبرع عبر الرسائل النصية</p>
                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <a href="{{ route('admin.sms_donation_records.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        سجلات التبرعات
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">تعديل السجل #{{ $donationRecord->id }}</span>
                </nav>
            </div>
            {{-- Action Buttons --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.sms_donation_records.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    العودة للقائمة
                </a>
            </div>
        </div>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-2xl" role="alert">
        <div class="flex items-center">
            <i class="fas fa-check-circle {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}"></i>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif

    {{-- Form Section --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.sms_donation_records.update', $donationRecord->id) }}" method="POST" class="p-6 lg:p-8 space-y-6">
            @csrf
            @method('PUT')

            {{-- Form Header --}}
            <div class="border-b border-gray-200 pb-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-edit text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">تعديل بيانات السجل</h2>
                        <p class="text-gray-600 text-sm">قم بتحديث المعلومات المطلوبة لسجل التبرع</p>
                    </div>
                </div>
            </div>
            {{-- Form Fields --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Donation Amount --}}
                <div class="space-y-2">
                    <label for="amount" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-dollar-sign text-green-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        قيمة التبرع (ل.س)
                    </label>
                    <input type="number" id="amount" name="amount" required min="1"
                           value="{{ old('amount', $donationRecord->amount) }}"
                           class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                           placeholder="أدخل قيمة التبرع">
                    @error('amount')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- SMS Code --}}
                <div class="space-y-2">
                    <label for="sms_code" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-hashtag text-blue-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        رقم الرسالة النصية
                    </label>
                    <select id="sms_code" name="sms_code" required class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300">
                        <option value="">اختر رقم الرسالة</option>
                        @foreach($smsDonations as $donation)
                            <option value="{{ $donation->sms_code }}" {{ old('sms_code', $donationRecord->sms_code) == $donation->sms_code ? 'selected' : '' }}>
                                {{ $donation->sms_code }} - تبرع بـ {{ $donation->amount }} ل.س
                            </option>
                        @endforeach
                    </select>
                    @error('sms_code')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Phone Number --}}
                <div class="space-y-2">
                    <label for="phone_number" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-mobile-alt text-purple-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        رقم هاتف التبرع
                    </label>
                    <input type="tel" id="phone_number" name="phone_number" required
                           value="{{ old('phone_number', $donationRecord->phone_number) }}"
                           class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                           placeholder="أدخل رقم الهاتف">
                    @error('phone_number')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="space-y-2">
                    <label for="status" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-info-circle text-orange-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        حالة التبرع
                    </label>
                    <select id="status" name="status" required class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300">
                        <option value="pending" {{ old('status', $donationRecord->status) == 'pending' ? 'selected' : '' }}>معلق</option>
                        <option value="completed" {{ old('status', $donationRecord->status) == 'completed' ? 'selected' : '' }}>مكتمل</option>
                        <option value="failed" {{ old('status', $donationRecord->status) == 'failed' ? 'selected' : '' }}>فشل</option>
                    </select>
                    @error('status')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Message Text --}}
            <div class="space-y-2">
                <label for="message_text" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-comment text-indigo-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    نص الرسالة
                </label>
                <input type="text" id="message_text" name="message_text" required
                       value="{{ old('message_text', $donationRecord->message_text) }}"
                       class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                       placeholder="أدخل نص الرسالة">
                @error('message_text')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Notes --}}
            <div class="space-y-2">
                <label for="notes" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-sticky-note text-yellow-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    ملاحظات إضافية (اختياري)
                </label>
                <textarea id="notes" name="notes" rows="3"
                          class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 resize-none"
                          placeholder="أدخل أي ملاحظات إضافية">{{ old('notes', $donationRecord->notes) }}</textarea>
                @error('notes')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Form Actions --}}
            <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.sms_donation_records.index') }}"
                   class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300">
                    <i class="fas fa-times {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    إلغاء
                </a>
                <button type="submit"
                        class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl">
                    <i class="fas fa-save {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    حفظ التغييرات
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="status">حالة التبرع</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="pending" {{ old('status', $donationRecord->status) == 'pending' ? 'selected' : '' }}>معلق</option>
                                            <option value="completed" {{ old('status', $donationRecord->status) == 'completed' ? 'selected' : '' }}>مكتمل</option>
                                            <option value="failed" {{ old('status', $donationRecord->status) == 'failed' ? 'selected' : '' }}>فشل</option>
                                        </select>
                                        @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="notes">ملاحظات إضافية</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes', $donationRecord->notes) }}</textarea>
                                        @error('notes')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary mt-3">حفظ التغييرات</button>
                                        <a href="{{ route('admin.sms_donation_records.index') }}" class="btn btn-danger mt-3">إلغاء</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row end -->
    </div>
    <!-- Content wrapper end -->

    <script>
        // ربط مبلغ التبرع بكود الرسالة المختار
        document.addEventListener('DOMContentLoaded', function() {
            const smsCodeSelect = document.getElementById('sms_code');
            const amountInput = document.getElementById('amount');

            smsCodeSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const optionText = selectedOption.text;
                const amountMatch = optionText.match(/تبرع بـ (\d+) ل\.س/);

                if (amountMatch && amountMatch[1]) {
                    amountInput.value = amountMatch[1];
                }
            });
        });
    </script>
@endsection
