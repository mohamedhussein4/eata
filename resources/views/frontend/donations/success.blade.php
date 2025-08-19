@extends('frontend.layouts.app')

@section('title', app()->getLocale() === 'ar' ? 'تم تسجيل التبرع بنجاح - إيطا' : 'Donation Successful - Eata')

@section('content')
<div class="container mx-auto px-4 py-20">
    <div class="max-w-2xl mx-auto text-center">
        <!-- Success Icon -->
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-8" data-aos="zoom-in">
            <i class="fas fa-check text-green-600 text-3xl"></i>
        </div>

        <!-- Success Message -->
        <div data-aos="fade-up">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                {{ app()->getLocale() === 'ar' ? '🎉 تم تسجيل تبرعك بنجاح!' : '🎉 Your Donation Was Successful!' }}
            </h1>
            <p class="text-xl text-gray-600 mb-8">
                {{ app()->getLocale() === 'ar' ? 'شكراً لك على دعمك وكرمك. سيتم مراجعة تبرعك وإشعارك بالنتيجة قريباً.' : 'Thank you for your support and generosity. Your donation will be reviewed and you will be notified of the result soon.' }}
            </p>

            <!-- Next Steps -->
            <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6 mb-8" data-aos="fade-up" data-aos-delay="200">
                <h3 class="text-lg font-semibold text-blue-900 mb-3">
                    {{ app()->getLocale() === 'ar' ? 'الخطوات التالية:' : 'Next Steps:' }}
                </h3>
                <ul class="text-blue-800 space-y-2 text-left">
                    <li class="flex items-center">
                        <i class="fas fa-clock text-blue-600 mr-3"></i>
                        {{ app()->getLocale() === 'ar' ? 'سيتم مراجعة تبرعك خلال 24-48 ساعة' : 'Your donation will be reviewed within 24-48 hours' }}
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope text-blue-600 mr-3"></i>
                        {{ app()->getLocale() === 'ar' ? 'ستصلك رسالة تأكيد على بريدك الإلكتروني' : 'You will receive a confirmation email' }}
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-bell text-blue-600 mr-3"></i>
                        {{ app()->getLocale() === 'ar' ? 'ستتلقى إشعاراً عند قبول التبرع' : 'You will receive a notification when the donation is accepted' }}
                    </li>
                </ul>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="400">
                <a href="{{ route('projects.index') }}"
                   class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-white bg-charity-600 hover:bg-charity-700 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-charity-500">
                    <i class="fas fa-project-diagram mr-2"></i>
                    {{ app()->getLocale() === 'ar' ? 'تصفح المشاريع' : 'Browse Projects' }}
                </a>

                <a href="{{ route('home') }}"
                   class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-home mr-2"></i>
                    {{ app()->getLocale() === 'ar' ? 'العودة للرئيسية' : 'Back to Home' }}
                </a>
            </div>

            <!-- Share Section -->
            <div class="mt-12 pt-8 border-t border-gray-200" data-aos="fade-up" data-aos-delay="600">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'ar' ? 'شارك العمل الخيري مع الآخرين' : 'Share the Charity with Others' }}
                </h3>
                <div class="flex justify-center gap-4">
                    <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(route('home')) }}" target="_blank"
                       class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('home')) }}&text={{ urlencode(app()->getLocale() === 'ar' ? 'لقد تبرعت لمنصة إيطا الخيرية' : 'I just donated to Eata charity platform') }}" target="_blank"
                       class="w-12 h-12 bg-blue-400 text-white rounded-full flex items-center justify-center hover:bg-blue-500 transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://wa.me/?text={{ urlencode(app()->getLocale() === 'ar' ? 'لقد تبرعت لمنصة إيطا الخيرية - ' . route('home') : 'I just donated to Eata charity platform - ' . route('home')) }}" target="_blank"
                       class="w-12 h-12 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition-colors">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
