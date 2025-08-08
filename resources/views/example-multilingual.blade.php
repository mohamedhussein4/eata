<!DOCTYPE html>
@include('components.language-meta')

<head>
    <title>{{ __('messages.site_name') }} - @yield('title', __('messages.home'))</title>

    {{-- Dynamic CSS based on language --}}
    <link href="{{ asset('assets2/css/' . (app()->getLocale() === 'ar' ? 'bootstrap.rtl.min.css' : 'bootstrap.min.css')) }}" rel="stylesheet">

    <style>
        .content-wrapper {
            @if(app()->getLocale() === 'ar')
                direction: rtl;
                text-align: right;
            @else
                direction: ltr;
                text-align: left;
            @endif
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">{{ __('messages.site_name') }}</a>

            <div class="navbar-nav ms-auto">
                {{-- Language Switcher --}}
                @include('components.language-switcher')
            </div>
        </div>
    </nav>

    <div class="container mt-4 content-wrapper">
        <div class="row">
            <div class="col-12">
                <h1>{{ __('messages.welcome') }}</h1>
                <p>{{ __('messages.current_language') }}: {{ config('app.available_locales.' . app()->getLocale() . '.name') }}</p>

                {{-- Example of multilingual project display --}}
                @if(isset($projects) && $projects->count() > 0)
                    <div class="row">
                        @foreach($projects as $project)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    @if($project->image_or_video)
                                        <img src="{{ asset('storage/images/' . $project->image_or_video) }}" class="card-img-top" alt="{{ $project->translated_title }}">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $project->translated_title }}</h5>
                                        <p class="card-text">{{ Str::limit($project->translated_description, 100) }}</p>

                                        <div class="project-stats">
                                            <small class="text-muted">
                                                {{ __('messages.total_amount') }}: {{ number_format($project->total_amount) }} {{ __('messages.currency') }}
                                                <br>
                                                {{ __('messages.beneficiaries_count') }}: {{ $project->beneficiaries_count }}
                                            </small>
                                        </div>

                                        <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-primary mt-2">
                                            {{ __('messages.view_project') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Example of form with multilingual labels --}}
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>{{ __('messages.contact_form') }}</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('messages.name') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('messages.email') }} <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">{{ __('messages.phone') }}</label>
                                <input type="tel" class="form-control" id="phone">
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">{{ __('messages.message') }} <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="message" rows="4" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-success">{{ __('messages.submit') }}</button>
                            <button type="reset" class="btn btn-secondary">{{ __('messages.reset') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-light mt-5 py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h6>{{ __('messages.about_us') }}</h6>
                    <p>{{ __('messages.footer_description') }}</p>
                </div>
                <div class="col-md-6">
                    <h6>{{ __('messages.quick_links') }}</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ url('/') }}" class="text-light">{{ __('messages.home') }}</a></li>
                        <li><a href="{{ url('/projects') }}" class="text-light">{{ __('messages.projects') }}</a></li>
                        <li><a href="{{ url('/donate') }}" class="text-light">{{ __('messages.donate') }}</a></li>
                        <li><a href="{{ url('/contact') }}" class="text-light">{{ __('messages.contact') }}</a></li>
                    </ul>
                </div>
            </div>
            <hr class="my-3">
            <div class="text-center">
                <p>&copy; {{ date('Y') }} {{ __('messages.site_name') }}. {{ __('messages.all_rights_reserved') }}</p>
            </div>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="{{ asset('assets2/js/bootstrap.min.js') }}"></script>

    {{-- Language-specific JavaScript --}}
    <script>
        // Set document language and direction
        document.documentElement.lang = '{{ app()->getLocale() }}';
        document.documentElement.dir = '{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}';

        // Language-specific functionality
        @if(app()->getLocale() === 'ar')
            // Arabic-specific JavaScript
            console.log('Arabic language loaded');
        @else
            // English-specific JavaScript
            console.log('English language loaded');
        @endif
    </script>
</body>
</html>
