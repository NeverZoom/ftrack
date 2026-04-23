<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead


        <link rel="apple-touch-icon-precomposed" sizes="384x384" href="{{ asset('icon/icon-384x384.png') }}" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('icon/icon-72x72.png') }}" />
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('icon/icon-144x144.png') }}" />
        <link rel="apple-touch-icon-precomposed" sizes="512x512" href="{{ asset('icon/icon-512x512.png') }}" />
        <link rel="apple-touch-icon-precomposed" sizes="128x128" href="{{ asset('icon/icon-128x128.png') }}" />
        {{-- <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{ asset('icon/icon-76x76.png') }}" /> --}}
        <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('icon/icon-152x152.png') }}" />
        <link rel="icon" type="image/png" href="{{ asset('icon/icon-192x192.png') }}" sizes="192x192" />
        <link rel="icon" type="image/png" href="{{ asset('icon/icon-96x96.png') }}" sizes="96x96" />
        {{-- <link rel="icon" type="image/png" href="{{ asset('icon/icon-32x32.png') }}" sizes="32x32" /> --}}
        {{-- <link rel="icon" type="image/png" href="{{ asset('icon/icon-16x16.png') }}" sizes="16x16" /> --}}

        <meta name="theme-color" content="#fafbfd"/>
        <link rel="apple-touch-icon" href="{{ asset('icon/icon-144x144.png') }}">
        <link rel="manifest" href="{{ asset('/manifest.json') }}">
    </head>

    <body class="font-sans antialiased">
        @inertia

        <script src="{{ asset('/sw.js') }}"></script>
        <script>
            if (!navigator.serviceWorker.controller) {
                navigator.serviceWorker.register("/sw.js").then(function (reg) {
                    console.log("Service worker has been registered for scope: " + reg.scope);
                });
            }
        </script>
    </body>
</html>
