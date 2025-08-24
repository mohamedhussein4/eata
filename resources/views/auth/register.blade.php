@extends('frontend.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-charity-50 via-white to-charity-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -left-40 w-80 h-80 bg-gradient-to-br from-charity-200 to-charity-300 rounded-full opacity-20 animate-float"></div>
        <div class="absolute -bottom-40 -right-40 w-80 h-80 bg-gradient-to-br from-warm-200 to-warm-300 rounded-full opacity-20 animate-float animation-delay-400"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-br from-charity-100 to-warm-100 rounded-full opacity-30 animate-pulse-slow"></div>
    </div>

    <div class="max-w-lg w-full space-y-8 relative z-10">
        <!-- Header -->
        <div class="text-center">
            <div class="mx-auto h-16 w-16 bg-gradient-to-br from-charity-500 to-charity-600 rounded-full flex items-center justify-center mb-6 shadow-lg">
                <i class="fas fa-user-plus text-white text-2xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">
                {{ app()->getLocale() === 'ar' ? 'انضم إلينا اليوم' : 'Join Us Today' }}
            </h2>
            <p class="text-gray-600">
                {{ app()->getLocale() === 'ar' ? 'سجل حسابك وابدأ رحلة العطاء' : 'Create your account and start your giving journey' }}
            </p>
        </div>

        <!-- Register Form -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 border border-gray-100">
            <form class="space-y-6" action="{{ route('register') }}" method="POST">
                @csrf

                <!-- Name Field -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        {{ app()->getLocale() === 'ar' ? 'الاسم الكامل' : 'Full Name' }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input id="name" name="name" type="text" required
                               class="appearance-none relative block w-full pl-10 pr-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-2xl focus:outline-none focus:ring-2 focus:ring-charity-500 focus:border-charity-500 focus:z-10 sm:text-sm transition-all duration-300"
                               placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل اسمك الكامل' : 'Enter your full name' }}"
                               value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        {{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني' : 'Email Address' }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input id="email" name="email" type="email" required
                               class="appearance-none relative block w-full pl-10 pr-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-2xl focus:outline-none focus:ring-2 focus:ring-charity-500 focus:border-charity-500 focus:z-10 sm:text-sm transition-all duration-300"
                               placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل بريدك الإلكتروني' : 'Enter your email' }}"
                               value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Field -->
                <div class="space-y-2">
                    <label for="phone" class="block text-sm font-medium text-gray-700">
                        {{ app()->getLocale() === 'ar' ? 'رقم الهاتف' : 'Phone Number' }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-phone text-gray-400"></i>
                        </div>
                        <input id="phone" name="phone" type="text"
                               class="appearance-none relative block w-full pl-10 pr-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-2xl focus:outline-none focus:ring-2 focus:ring-charity-500 focus:border-charity-500 focus:z-10 sm:text-sm transition-all duration-300"
                               placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل رقم هاتفك' : 'Enter your phone number' }}"
                               value="{{ old('phone') }}">
                    </div>
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Age Field -->
                <div class="space-y-2">
                    <label for="age" class="block text-sm font-medium text-gray-700">
                        {{ app()->getLocale() === 'ar' ? 'العمر' : 'Age' }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-birthday-cake text-gray-400"></i>
                        </div>
                        <input id="age" name="age" type="number" min="1" max="120"
                               class="appearance-none relative block w-full pl-10 pr-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-2xl focus:outline-none focus:ring-2 focus:ring-charity-500 focus:border-charity-500 focus:z-10 sm:text-sm transition-all duration-300"
                               placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل عمرك' : 'Enter your age' }}"
                               value="{{ old('age') }}">
                    </div>
                    @error('age')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gender Field -->
                <div class="space-y-2">
                    <label for="gender" class="block text-sm font-medium text-gray-700">
                        {{ app()->getLocale() === 'ar' ? 'الجنس' : 'Gender' }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-venus-mars text-gray-400"></i>
                        </div>
                        <select id="gender" name="gender" required
                                class="appearance-none relative block w-full pl-10 pr-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-2xl focus:outline-none focus:ring-2 focus:ring-charity-500 focus:border-charity-500 focus:z-10 sm:text-sm transition-all duration-300">
                            <option value="">{{ app()->getLocale() === 'ar' ? 'اختر الجنس' : 'Select gender' }}</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>
                                {{ app()->getLocale() === 'ar' ? 'ذكر' : 'Male' }}
                            </option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>
                                {{ app()->getLocale() === 'ar' ? 'أنثى' : 'Female' }}
                            </option>
                        </select>
                    </div>
                    @error('gender')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Type Field -->
                <div class="space-y-2">
                    <label for="type" class="block text-sm font-medium text-gray-700">
                        {{ app()->getLocale() === 'ar' ? 'نوع الحساب' : 'Account Type' }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user-tag text-gray-400"></i>
                        </div>
                        <select id="type" name="type" required onchange="toggleBeneficiaryFields()"
                                class="appearance-none relative block w-full pl-10 pr-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-2xl focus:outline-none focus:ring-2 focus:ring-charity-500 focus:border-charity-500 focus:z-10 sm:text-sm transition-all duration-300">
                            <option value="">{{ app()->getLocale() === 'ar' ? 'اختر نوع الحساب' : 'Select account type' }}</option>
                            <option value="volunteer" {{ old('type') == 'volunteer' ? 'selected' : '' }}>
                                {{ app()->getLocale() === 'ar' ? 'متطوع' : 'Volunteer' }}
                            </option>
                            <option value="beneficiary" {{ old('type') == 'beneficiary' ? 'selected' : '' }}>
                                {{ app()->getLocale() === 'ar' ? 'مستفيد' : 'Beneficiary' }}
                            </option>
                        </select>
                    </div>
                    @error('type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Beneficiary Additional Fields -->
                <div id="beneficiaryFields" class="space-y-6 hidden">
                    <div class="bg-charity-50 p-6 rounded-2xl border-2 border-charity-200">
                        <h3 class="text-lg font-semibold text-charity-800 mb-4 flex items-center">
                            <i class="fas fa-heart text-charity-600 mr-2"></i>
                            {{ app()->getLocale() === 'ar' ? 'معلومات إضافية للمستفيدين' : 'Additional Information for Beneficiaries' }}
                        </h3>
                        
                        <!-- Address Field -->
                        <div class="space-y-2 mb-4">
                            <label for="address" class="block text-sm font-medium text-gray-700">
                                {{ app()->getLocale() === 'ar' ? 'العنوان' : 'Address' }}
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-map-marker-alt text-gray-400"></i>
                                </div>
                                <input id="address" name="address" type="text"
                                       class="appearance-none relative block w-full pl-10 pr-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-2xl focus:outline-none focus:ring-2 focus:ring-charity-500 focus:border-charity-500 focus:z-10 sm:text-sm transition-all duration-300"
                                       placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل عنوانك' : 'Enter your address' }}"
                                       value="{{ old('address') }}">
                            </div>
                            @error('address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Marital Status Field -->
                        <div class="space-y-2 mb-4">
                            <label for="marital_status" class="block text-sm font-medium text-gray-700">
                                {{ app()->getLocale() === 'ar' ? 'الحالة الاجتماعية' : 'Marital Status' }}
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-users text-gray-400"></i>
                                </div>
                                <select id="marital_status" name="marital_status"
                                        class="appearance-none relative block w-full pl-10 pr-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-2xl focus:outline-none focus:ring-2 focus:ring-charity-500 focus:border-charity-500 focus:z-10 sm:text-sm transition-all duration-300">
                                    <option value="">{{ app()->getLocale() === 'ar' ? 'اختر الحالة الاجتماعية' : 'Select marital status' }}</option>
                                    <option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>
                                        {{ app()->getLocale() === 'ar' ? 'أعزب' : 'Single' }}
                                    </option>
                                    <option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>
                                        {{ app()->getLocale() === 'ar' ? 'متزوج' : 'Married' }}
                                    </option>
                                    <option value="divorced" {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>
                                        {{ app()->getLocale() === 'ar' ? 'مطلق' : 'Divorced' }}
                                    </option>
                                    <option value="widow" {{ old('marital_status') == 'widow' ? 'selected' : '' }}>
                                        {{ app()->getLocale() === 'ar' ? 'أرمل' : 'Widow' }}
                                    </option>
                                </select>
                            </div>
                            @error('marital_status')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Family Members Count -->
                        <div class="space-y-2 mb-4">
                            <label for="family_members_count" class="block text-sm font-medium text-gray-700">
                                {{ app()->getLocale() === 'ar' ? 'عدد أفراد الأسرة' : 'Family Members Count' }}
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-home text-gray-400"></i>
                                </div>
                                <input id="family_members_count" name="family_members_count" type="number" min="1"
                                       class="appearance-none relative block w-full pl-10 pr-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-2xl focus:outline-none focus:ring-2 focus:ring-charity-500 focus:border-charity-500 focus:z-10 sm:text-sm transition-all duration-300"
                                       placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل عدد أفراد الأسرة' : 'Enter family members count' }}"
                                       value="{{ old('family_members_count') }}">
                            </div>
                            @error('family_members_count')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Children Under 10 Count -->
                        <div class="space-y-2 mb-4">
                            <label for="children_under_10_count" class="block text-sm font-medium text-gray-700">
                                {{ app()->getLocale() === 'ar' ? 'عدد الأطفال تحت 10 سنوات' : 'Children Under 10 Count' }}
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-child text-gray-400"></i>
                                </div>
                                <input id="children_under_10_count" name="children_under_10_count" type="number" min="0"
                                       class="appearance-none relative block w-full pl-10 pr-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-2xl focus:outline-none focus:ring-2 focus:ring-charity-500 focus:border-charity-500 focus:z-10 sm:text-sm transition-all duration-300"
                                       placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل عدد الأطفال تحت 10 سنوات' : 'Enter children under 10 count' }}"
                                       value="{{ old('children_under_10_count') }}">
                            </div>
                            @error('children_under_10_count')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Average Monthly Income -->
                        <div class="space-y-2 mb-4">
                            <label for="average_monthly_income" class="block text-sm font-medium text-gray-700">
                                {{ app()->getLocale() === 'ar' ? 'متوسط الدخل الشهري' : 'Average Monthly Income' }}
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-dollar-sign text-gray-400"></i>
                                </div>
                                <input id="average_monthly_income" name="average_monthly_income" type="number" min="0"
                                       class="appearance-none relative block w-full pl-10 pr-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-2xl focus:outline-none focus:ring-2 focus:ring-charity-500 focus:border-charity-500 focus:z-10 sm:text-sm transition-all duration-300"
                                       placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل متوسط الدخل الشهري' : 'Enter average monthly income' }}"
                                       value="{{ old('average_monthly_income') }}">
                            </div>
                            @error('average_monthly_income')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Has Diseases -->
                        <div class="space-y-2 mb-4">
                            <label class="block text-sm font-medium text-gray-700">
                                {{ app()->getLocale() === 'ar' ? 'هل تعاني من أمراض؟' : 'Do you have any diseases?' }}
                            </label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="has_diseases" value="1" {{ old('has_diseases') == '1' ? 'checked' : '' }}
                                           class="form-radio h-4 w-4 text-charity-600 focus:ring-charity-500 border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">{{ app()->getLocale() === 'ar' ? 'نعم' : 'Yes' }}</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="has_diseases" value="0" {{ old('has_diseases') == '0' ? 'checked' : '' }}
                                           class="form-radio h-4 w-4 text-charity-600 focus:ring-charity-500 border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">{{ app()->getLocale() === 'ar' ? 'لا' : 'No' }}</span>
                                </label>
                            </div>
                            @error('has_diseases')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Critical Surgery Diseases -->
                        <div class="space-y-2 mb-4">
                            <label for="critical_surgery_diseases" class="block text-sm font-medium text-gray-700">
                                {{ app()->getLocale() === 'ar' ? 'أمراض تحتاج عمليات جراحية حرجة' : 'Critical Surgery Diseases' }}
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-procedures text-gray-400"></i>
                                </div>
                                <textarea id="critical_surgery_diseases" name="critical_surgery_diseases" rows="3"
                                          class="appearance-none relative block w-full pl-10 pr-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-2xl focus:outline-none focus:ring-2 focus:ring-charity-500 focus:border-charity-500 focus:z-10 sm:text-sm transition-all duration-300"
                                          placeholder="{{ app()->getLocale() === 'ar' ? 'اذكر الأمراض إن وجدت' : 'Mention diseases if any' }}">{{ old('critical_surgery_diseases') }}</textarea>
                            </div>
                            @error('critical_surgery_diseases')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Supporting Others -->
                        <div class="space-y-2 mb-4">
                            <label class="block text-sm font-medium text-gray-700">
                                {{ app()->getLocale() === 'ar' ? 'هل تعيل أشخاص آخرين؟' : 'Are you supporting others?' }}
                            </label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="is_supporting_others" value="1" {{ old('is_supporting_others') == '1' ? 'checked' : '' }}
                                           class="form-radio h-4 w-4 text-charity-600 focus:ring-charity-500 border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">{{ app()->getLocale() === 'ar' ? 'نعم' : 'Yes' }}</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="is_supporting_others" value="0" {{ old('is_supporting_others') == '0' ? 'checked' : '' }}
                                           class="form-radio h-4 w-4 text-charity-600 focus:ring-charity-500 border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">{{ app()->getLocale() === 'ar' ? 'لا' : 'No' }}</span>
                                </label>
                            </div>
                            @error('is_supporting_others')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        {{ app()->getLocale() === 'ar' ? 'كلمة المرور' : 'Password' }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input id="password" name="password" type="password" required
                               class="appearance-none relative block w-full pl-10 pr-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-2xl focus:outline-none focus:ring-2 focus:ring-charity-500 focus:border-charity-500 focus:z-10 sm:text-sm transition-all duration-300"
                               placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل كلمة المرور' : 'Enter your password' }}">
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                        {{ app()->getLocale() === 'ar' ? 'تأكيد كلمة المرور' : 'Confirm Password' }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                               class="appearance-none relative block w-full pl-10 pr-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-2xl focus:outline-none focus:ring-2 focus:ring-charity-500 focus:border-charity-500 focus:z-10 sm:text-sm transition-all duration-300"
                               placeholder="{{ app()->getLocale() === 'ar' ? 'أعد إدخال كلمة المرور' : 'Confirm your password' }}">
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="terms" name="terms" type="checkbox" required
                               class="h-4 w-4 text-charity-600 focus:ring-charity-500 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="terms" class="text-gray-700">
                            {{ app()->getLocale() === 'ar' ? 'أوافق على' : 'I agree to the' }}
                            <a href="#" class="text-charity-600 hover:text-charity-500">
                                {{ app()->getLocale() === 'ar' ? 'الشروط والأحكام' : 'Terms of Service' }}
                            </a>
                            {{ app()->getLocale() === 'ar' ? 'و' : 'and' }}
                            <a href="#" class="text-charity-600 hover:text-charity-500">
                                {{ app()->getLocale() === 'ar' ? 'سياسة الخصوصية' : 'Privacy Policy' }}
                            </a>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-2xl text-white bg-gradient-to-r from-charity-500 to-charity-600 hover:from-charity-600 hover:to-charity-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-charity-500 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-user-plus text-charity-200 group-hover:text-charity-100 transition-colors duration-300"></i>
                        </span>
                        {{ app()->getLocale() === 'ar' ? 'إنشاء الحساب' : 'Create Account' }}
                    </button>
                </div>

                <!-- Divider -->
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">
                            {{ app()->getLocale() === 'ar' ? 'أو' : 'Or' }}
                        </span>
                    </div>
                </div>

                <!-- Social Register -->
                <div class="grid grid-cols-3 gap-3">
                    <button type="button" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-2xl shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-all duration-300 transform hover:scale-105">
                        <i class="fab fa-google text-red-500"></i>
                    </button>
                    <button type="button" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-2xl shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-all duration-300 transform hover:scale-105">
                        <i class="fab fa-facebook text-blue-600"></i>
                    </button>
                    <button type="button" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-2xl shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-all duration-300 transform hover:scale-105">
                        <i class="fab fa-twitter text-blue-400"></i>
                    </button>
                </div>

                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        {{ app()->getLocale() === 'ar' ? 'لديك حساب بالفعل؟' : 'Already have an account?' }}
                        <a href="{{ route('login') }}" class="font-medium text-charity-600 hover:text-charity-500 transition-colors duration-300">
                            {{ app()->getLocale() === 'ar' ? 'سجل دخولك' : 'Sign in' }}
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center">
            <p class="text-xs text-gray-500">
                {{ app()->getLocale() === 'ar' ? 'بالتسجيل، أنت توافق على' : 'By registering, you agree to our' }}
                <a href="#" class="text-charity-600 hover:text-charity-500">{{ app()->getLocale() === 'ar' ? 'الشروط والأحكام' : 'Terms of Service' }}</a>
                {{ app()->getLocale() === 'ar' ? 'و' : 'and' }}
                <a href="#" class="text-charity-600 hover:text-charity-500">{{ app()->getLocale() === 'ar' ? 'سياسة الخصوصية' : 'Privacy Policy' }}</a>
            </p>
        </div>
    </div>
</div>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    .animation-delay-400 {
        animation-delay: 0.4s;
    }

    .animate-pulse-slow {
        animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    .form-radio:checked {
        background-color: #dc2626;
        border-color: #dc2626;
    }

    .slide-down {
        animation: slideDown 0.3s ease-out;
    }

    .slide-up {
        animation: slideUp 0.3s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideUp {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-10px);
        }
    }
</style>

<script>
    function toggleBeneficiaryFields() {
        const typeSelect = document.getElementById('type');
        const beneficiaryFields = document.getElementById('beneficiaryFields');
        
        if (typeSelect.value === 'beneficiary') {
            beneficiaryFields.classList.remove('hidden');
            beneficiaryFields.classList.add('slide-down');
            
            // Make beneficiary fields required
            const requiredFields = ['address', 'marital_status', 'family_members_count', 'average_monthly_income'];
            requiredFields.forEach(fieldName => {
                const field = document.querySelector(`[name="${fieldName}"]`);
                if (field) {
                    field.required = true;
                }
            });
        } else {
            beneficiaryFields.classList.add('hidden');
            beneficiaryFields.classList.remove('slide-down');
            
            // Remove required from beneficiary fields
            const beneficiaryInputs = beneficiaryFields.querySelectorAll('input, select, textarea');
            beneficiaryInputs.forEach(input => {
                input.required = false;
            });
        }
    }

    // Check on page load in case of old input values
    document.addEventListener('DOMContentLoaded', function() {
        toggleBeneficiaryFields();
    });
</script>
@endsection
