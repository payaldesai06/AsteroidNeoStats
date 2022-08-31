<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />

    <!-- SEO -->
    <title>
        @yield('title', config('app.name'))
        @hasSection('title')
            - {{ config('app.name') }}
        @endif
    </title>

    @yield('css_before')
    <!-- CSS -->
    <link href="{{ asset('css/tabler.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    @yield('css_after')
</head>

<body class="antialiased border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
        <div class="container-tight py-4">
            <div class="text-center mb-4">
                <a href="."><img src="{{ asset('static/logos/logo.png') }}" height="70" alt=""></a>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                {{ __('auth.error') }}: {{ $errors->first() }}
            </div>
            @endif
            @yield('content')
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('js/tabler.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js_after')
</body>

</html>
