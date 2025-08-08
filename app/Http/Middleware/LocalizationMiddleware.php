<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get available locales from config
        $availableLocales = array_keys(config('app.available_locales', ['ar', 'en']));

        // Check if locale is provided in URL
        $locale = $request->segment(1);

        // If locale is not in URL, check session, then default
        if (!in_array($locale, $availableLocales)) {
            $locale = Session::get('locale', config('app.locale', 'ar'));
        }

        // Set the locale
        App::setLocale($locale);
        Session::put('locale', $locale);

        // Set direction and CSS file in view
        $localeConfig = config("app.available_locales.{$locale}", config('app.available_locales.ar'));
        view()->share('currentLocale', $locale);
        view()->share('currentDirection', $localeConfig['script'] ?? 'rtl');
        view()->share('currentCSS', $localeConfig['css'] ?? 'bootstrap.rtl.min.css');
        view()->share('availableLocales', config('app.available_locales', []));

        return $next($request);
    }
}
