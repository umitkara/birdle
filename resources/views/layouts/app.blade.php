<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset("css/all.css") }}">
    <link rel="icon" href="{{ asset("img/favicon.svg") }}" type="image/svg+xml">
    <script>
        var User = {
            id: {{ optional(auth()->user())->id ?? 'null' }},
            username: '{{ optional(auth()->user())->username ?? '' }}',
            avatar: '{{ optional(auth()->user())->avatar() ?? '' }}',
        }
    </script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <main class="container mx-auto">
            @yield('content')
            <modals-container></modals-container>
        </main>
    </div>
</body>
</html>
