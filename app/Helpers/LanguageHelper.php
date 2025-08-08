<?php

namespace App\Helpers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageHelper
{
    /**
     * Get available locales from config
     */
    public static function getAvailableLocales()
    {
        return config('app.available_locales', []);
    }

    /**
     * Get current locale
     */
    public static function getCurrentLocale()
    {
        return App::getLocale();
    }

    /**
     * Get current locale configuration
     */
    public static function getCurrentLocaleConfig()
    {
        $locale = self::getCurrentLocale();
        return config("app.available_locales.{$locale}", []);
    }

    /**
     * Get current direction (rtl/ltr)
     */
    public static function getCurrentDirection()
    {
        $config = self::getCurrentLocaleConfig();
        return $config['script'] ?? 'rtl';
    }

    /**
     * Get current CSS file
     */
    public static function getCurrentCSS()
    {
        $config = self::getCurrentLocaleConfig();
        return $config['css'] ?? 'bootstrap.rtl.min.css';
    }

    /**
     * Get current language name
     */
    public static function getCurrentLanguageName()
    {
        $config = self::getCurrentLocaleConfig();
        return $config['name'] ?? 'العربية';
    }

    /**
     * Check if current locale is RTL
     */
    public static function isRTL()
    {
        return self::getCurrentDirection() === 'rtl';
    }

    /**
     * Check if current locale is LTR
     */
    public static function isLTR()
    {
        return self::getCurrentDirection() === 'ltr';
    }

    /**
     * Set locale and update session
     */
    public static function setLocale($locale)
    {
        $availableLocales = array_keys(self::getAvailableLocales());

        if (in_array($locale, $availableLocales)) {
            App::setLocale($locale);
            Session::put('locale', $locale);
            return true;
        }

        return false;
    }

    /**
     * Get opposite locale (for language switcher)
     */
    public static function getOppositeLocale()
    {
        $current = self::getCurrentLocale();
        $available = array_keys(self::getAvailableLocales());

        foreach ($available as $locale) {
            if ($locale !== $current) {
                return $locale;
            }
        }

        return $current;
    }

    /**
     * Get locale URL prefix
     */
    public static function getLocalePrefix($locale = null)
    {
        $locale = $locale ?: self::getCurrentLocale();
        $defaultLocale = config('app.locale', 'ar');

        return $locale === $defaultLocale ? '' : $locale;
    }

    /**
     * Generate URL with locale prefix
     */
    public static function localizedUrl($path = '', $locale = null)
    {
        $locale = $locale ?: self::getCurrentLocale();
        $prefix = self::getLocalePrefix($locale);

        $path = ltrim($path, '/');

        if ($prefix) {
            return url($prefix . '/' . $path);
        }

        return url($path);
    }

    /**
     * Get language switcher data
     */
    public static function getLanguageSwitcher()
    {
        $current = self::getCurrentLocale();
        $available = self::getAvailableLocales();
        $switcher = [];

        foreach ($available as $locale => $config) {
            $switcher[] = [
                'locale' => $locale,
                'name' => $config['name'],
                'is_current' => $locale === $current,
                'url' => self::localizedUrl(request()->path(), $locale)
            ];
        }

        return $switcher;
    }
}
