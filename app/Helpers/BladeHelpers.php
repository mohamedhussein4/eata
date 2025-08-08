<?php

// This file will be loaded by AppServiceProvider

// Language helper directives
Blade::directive('lang', function ($expression) {
    return "<?php echo app()->getLocale(); ?>";
});

Blade::directive('isRTL', function ($expression) {
    return "<?php if(app()->getLocale() === 'ar'): ?>";
});

Blade::directive('isLTR', function ($expression) {
    return "<?php if(app()->getLocale() === 'en'): ?>";
});

Blade::directive('endisRTL', function ($expression) {
    return "<?php endif; ?>";
});

Blade::directive('endisLTR', function ($expression) {
    return "<?php endif; ?>";
});

Blade::directive('direction', function ($expression) {
    return "<?php echo app()->getLocale() === 'ar' ? 'rtl' : 'ltr'; ?>";
});

Blade::directive('langurl', function ($expression) {
    return "<?php echo \\App\\Helpers\\LanguageHelper::localizedUrl({$expression}); ?>";
});

// Translated content directives
Blade::directive('translated', function ($expression) {
    return "<?php echo {$expression} ?: ''; ?>";
});

// CSS file based on language
Blade::directive('langcss', function ($expression) {
    return "<?php echo app()->getLocale() === 'ar' ? 'bootstrap.rtl.min.css' : 'bootstrap.min.css'; ?>";
});

// Language switcher directive
Blade::directive('languageSwitcher', function ($expression) {
    return "<?php echo view('components.language-switcher')->render(); ?>";
});

// Check if translation exists
Blade::directive('hastranslation', function ($expression) {
    return "<?php if({$expression}): ?>";
});

Blade::directive('endhastranslation', function ($expression) {
    return "<?php endif; ?>";
});

// Get opposite language
Blade::directive('oppositelang', function ($expression) {
    return "<?php echo \\App\\Helpers\\LanguageHelper::getOppositeLocale(); ?>";
});
