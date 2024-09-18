<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
 {{-- @vite('resources/js/cart.js') --}}
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/cart.js','resources/js/app.js'])

    <!-- Include jQuery before your custom scripts if using CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    @yield('content')

    @yield('scripts')
</body>
</html>



