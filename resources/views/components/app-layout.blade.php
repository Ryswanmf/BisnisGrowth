<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('images/Logo_Bisnis_Growth.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/Logo_Bisnis_Growth.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{ $seo ?? '' }}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 min-h-full flex flex-col">
    <x-header />

    <!-- Main Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <x-footer />
</body>
</body>
</html>
