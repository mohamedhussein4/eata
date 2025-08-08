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
                <i class="fas fa-envelope-open-text text-white text-2xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">
                {{ app()->getLocale() === 'ar' ? 'تحقق من بريدك الإلكتروني' : 'Verify Your Email Address' }}
            </h2>
            <p class="text-gray-600">
                {{ app()->getLocale() === 'ar' ? 'يرجى التحقق من بريدك الإلكتروني قبل المتابعة' : 'Please check your email before proceeding' }}
            </p>
        </div>

        <!-- Verification Form -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 border border-gray-100">
            @if (session('resent'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-2xl">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-800">
                                {{ app()->getLocale() === 'ar' ? 'تم إرسال رابط تحقق جديد إلى بريدك الإلكتروني' : 'A fresh verification link has been sent to your email address' }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="text-center space-y-6">
                <div class="text-gray-600">
                    <p class="mb-4">
                        {{ app()->getLocale() === 'ar' ? 'قبل المتابعة، يرجى التحقق من بريدك الإلكتروني للحصول على رابط التحقق' : 'Before proceeding, please check your email for a verification link' }}
                    </p>
                    <p>
                        {{ app()->getLocale() === 'ar' ? 'إذا لم تستلم البريد الإلكتروني' : 'If you did not receive the email' }}
                    </p>
                </div>

                <form class="inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit"
                            class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-2xl text-white bg-gradient-to-r from-charity-500 to-charity-600 hover:from-charity-600 hover:to-charity-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-charity-500 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <i class="fas fa-paper-plane mr-2"></i>
                        {{ app()->getLocale() === 'ar' ? 'انقر هنا لطلب رابط آخر' : 'Click here to request another' }}
                    </button>
                </form>

                <!-- Back to Login -->
                <div class="pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600">
                        {{ app()->getLocale() === 'ar' ? 'تم التحقق بالفعل؟' : 'Already verified?' }}
                        <a href="{{ route('login') }}" class="font-medium text-charity-600 hover:text-charity-500 transition-colors duration-300">
                            {{ app()->getLocale() === 'ar' ? 'سجل دخولك' : 'Sign in' }}
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center">
            <p class="text-xs text-gray-500">
                {{ app()->getLocale() === 'ar' ? 'بالتحقق من بريدك الإلكتروني، أنت توافق على' : 'By verifying your email, you agree to our' }}
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
