{{-- Language and Direction Meta Tags --}}
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Language alternates --}}
    @foreach(config('app.available_locales', []) as $locale => $config)
        <link rel="alternate" hreflang="{{ $locale }}" href="{{ url()->current() }}?lang={{ $locale }}" />
    @endforeach

    {{-- CSS based on language --}}
    @if(app()->getLocale() === 'ar')
        <link href="{{ asset('assets2/css/bootstrap.rtl.min.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('assets2/css/bootstrap.min.css') }}" rel="stylesheet">
    @endif

    {{-- Additional RTL/LTR specific styles --}}
    <style>
        @if(app()->getLocale() === 'ar')
        body {
            direction: rtl;
            text-align: right;
            font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .text-left { text-align: right !important; }
        .text-right { text-align: left !important; }
        .float-left { float: right !important; }
        .float-right { float: left !important; }
        .ml-auto { margin-right: auto !important; margin-left: 0 !important; }
        .mr-auto { margin-left: auto !important; margin-right: 0 !important; }
        @else
        body {
            direction: ltr;
            text-align: left;
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        @endif
    </style>
