<div class="language-switcher">
    <div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-globe"></i>
            {{ config('app.available_locales.' . app()->getLocale() . '.name', 'العربية') }}
        </button>
        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
            @foreach(config('app.available_locales', []) as $locale => $config)
                @if($locale !== app()->getLocale())
                    <li>
                        <a class="dropdown-item" href="{{ route('language.switch', $locale) }}?redirect={{ urlencode(request()->fullUrl()) }}">
                            {{ $config['name'] }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>

<style>
.language-switcher {
    display: inline-block;
}

.language-switcher .dropdown-toggle {
    border: 1px solid #dee2e6;
    background: white;
    color: #495057;
}

.language-switcher .dropdown-toggle:hover,
.language-switcher .dropdown-toggle:focus {
    background: #f8f9fa;
    border-color: #adb5bd;
}

.language-switcher .dropdown-item {
    padding: 0.5rem 1rem;
}

.language-switcher .dropdown-item:hover {
    background: #f8f9fa;
}
</style>
