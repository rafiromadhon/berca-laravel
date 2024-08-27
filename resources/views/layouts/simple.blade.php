<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>@yield('title') - Super Bank App</title>

        <meta name="description" content="Agent Command Center">
        <meta name="author" content="tacc">
        <meta name="robots" content="noindex, nofollow">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="{{ asset('assets/ta-logo.png') }}">

        @yield('css_before')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
        <link rel="stylesheet" id="css-main" href="{{ url('/css/oneui.css') }}">

        <link rel="stylesheet" id="css-theme" href="{{ url('/css/themes/city.css') }}">
        @yield('css_after')

        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
    </head>
    <body>

        <div id="page-container">

            <main id="main-container">
                @yield('content')
            </main>
        </div>


        <script src="{{ url('js/oneui.app.js') }}"></script>

        {{-- <script src="{{ url('/js/laravel.app.js') }}"></script> --}}

        @yield('js_after')
    </body>
</html>
