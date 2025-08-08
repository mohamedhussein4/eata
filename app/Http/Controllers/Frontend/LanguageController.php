<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function switch($locale)
    {
        // التحقق من أن اللغة مدعومة
        if (in_array($locale, ['ar', 'en'])) {
            // حفظ اللغة في الجلسة
            Session::put('locale', $locale);
            
            // تطبيق اللغة فوراً
            App::setLocale($locale);
        }

        return redirect()->back();
    }

    public function getCurrentLocale()
    {
        return response()->json([
            'locale' => app()->getLocale(),
            'direction' => app()->getLocale() === 'ar' ? 'rtl' : 'ltr'
        ]);
    }

    public function getSupportedLocales()
    {
        return response()->json([
            'locales' => [
                'ar' => [
                    'name' => 'العربية',
                    'flag' => '🇸🇦',
                    'direction' => 'rtl'
                ],
                'en' => [
                    'name' => 'English',
                    'flag' => '🇺🇸',
                    'direction' => 'ltr'
                ]
            ],
            'current' => app()->getLocale()
        ]);
    }
} 