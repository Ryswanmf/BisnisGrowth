<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'BisnisGrowth — Wawasan Bisnis & Strategi UMKM' }}</title>

    <link rel="icon" type="image/png" href="{{ asset('images/Logo_Bisnis_Growth.png') }}">
    
    {{ $seo ?? '' }}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 min-h-full flex flex-col">
    <!-- Page Loader -->
    <div id="page-loader" class="fixed inset-0 z-[9999] bg-white flex flex-col items-center justify-center transition-opacity duration-700">
        <div class="relative">
            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-2xl relative z-10 animate-bounce">
                <img src="{{ asset('images/Logo_Bisnis_Growth.png') }}" alt="Loading..." class="w-12 h-12 object-contain">
            </div>
            <div class="absolute inset-0 bg-red-100 rounded-full animate-ping opacity-25"></div>
        </div>
    </div>

    <script>
        window.addEventListener('load', function() {
            const loader = document.getElementById('page-loader');
            setTimeout(() => {
                loader.style.opacity = '0';
                setTimeout(() => loader.style.display = 'none', 700);
            }, 500);
        });
    </script>

    <x-header />

    <!-- Main Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <x-footer />
</body>
</html>
