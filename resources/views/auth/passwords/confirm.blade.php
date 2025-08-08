@extends('frontend.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-charity-50 via-white to-charity-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -left-40 w-80 h-80 bg-gradient-to-br from-charity-200 to-charity-300 rounded-full opacity-20 animate-float"></div>
        <div class="absolute -bottom-40 -right-40 w-80 h-80 bg-gradient-to-br from-warm-200 to-warm-300 rounded-full opacity-20 animate-float animation-delay-400"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-br from-charity-100 to-warm-100 rounded-full opacity-30 animate-pulse-slow"></div>
    </div>

    <div class="max-w-md w-full space-y-8 relative z-10">
        <!-- Header -->
        <div class="text-center">
            <div class="mx-auto h-16 w-16 bg-gradient-to-br from-charity-500 to-charity-600 rounded-full flex items-center justify-center mb-6 shadow-lg">
                <i class="fas fa-shield-alt text-white text-2xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">
                {{ app()->getLocale() === 'ar' ? 'تأكيد كلمة المرور' : 'Confirm Password' }}
            </h2>
            <p class="text-gray-600">
                {{ app()->getLocale() === 'ar' ? 'يرجى تأكيد كلمة المرور قبل المتابعة' : 'Please confirm your password before continuing' }}
            </p>
        </div>

        <!-- Confirm Form -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 border border-gray-100">
            <form class="space-y-6" method="POST" action="{{ route('password.confirm') }}">
                @csrf

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

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-2xl text-white bg-gradient-to-r from-charity-500 to-charity-600 hover:from-charity-600 hover:to-charity-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-charity-500 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-check text-charity-200 group-hover:text-charity-100 transition-colors duration-300"></i>
                        </span>
                        {{ app()->getLocale() === 'ar' ? 'تأكيد كلمة المرور' : 'Confirm Password' }}
                    </button>
                </div>

                <!-- Forgot Password Link -->
                @if (Route::has('password.request'))
                    <div class="text-center">
                        <a href="{{ route('password.request') }}" class="font-medium text-charity-600 hover:text-charity-500 transition-colors duration-300">
                            {{ app()->getLocale() === 'ar' ? 'نسيت كلمة المرور؟' : 'Forgot Your Password?' }}
                        </a>
                    </div>
                @endif
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center">
            <p class="text-xs text-gray-500">
                {{ app()->getLocale() === 'ar' ? 'بتأكيد كلمة المرور، أنت توافق على' : 'By confirming your password, you agree to our' }}
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
</style>
@endsection
