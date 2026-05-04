<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'BisnisGrowth — Wawasan Bisnis & Strategi UMKM' }}</title>

    <link rel="icon" type="image/png" href="{{ asset('images/Logo_Bisnis_Growth.png') }}">
    
    <!-- PWA Settings -->
    <meta name="theme-color" content="#f59e0b">
    <link rel="apple-touch-icon" href="{{ asset('images/Logo_Bisnis_Growth.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    
    {{ $seo ?? '' }}
    {{ $styles ?? '' }}

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Modern Minimalist Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #e2e8f0; /* slate-200 */
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #f59e0b; /* amber-500 */
        }
        
        /* For Firefox */
        * {
            scrollbar-width: thin;
            scrollbar-color: #e2e8f0 transparent;
        }

        /* Hide scrollbar for Chrome, Safari and Opera (utility for specific containers) */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        /* Hide scrollbar for IE, Edge and Firefox */
        .no-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-900 min-h-full flex flex-col">
    <!-- Light Minimalist Page Loader -->
    <div id="page-loader" class="fixed inset-0 z-[9999] bg-white flex flex-col items-center justify-center transition-all duration-700 ease-in-out">
        <div class="relative">
            <!-- Pulsing Circle Decoration -->
            <div class="absolute inset-0 bg-amber-500/10 rounded-full animate-[ping_2.5s_infinite] scale-150"></div>
            
            <!-- Logo with Breathing & Fade Effect -->
            <div class="relative w-20 h-20 md:w-24 md:h-24 animate-[pulse_2s_infinite]">
                <img src="{{ asset('images/Logo_Bisnis_Growth.png') }}" alt="Loading..." class="w-full h-full object-contain opacity-90">
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('load', function() {
            const loader = document.getElementById('page-loader');
            setTimeout(() => {
                if(loader) {
                    loader.style.opacity = '0';
                    loader.style.pointerEvents = 'none'; // Pastikan tidak menghalangi klik saat memudar
                    setTimeout(() => {
                        loader.style.display = 'none';
                    }, 700);
                }
            }, 400);
        });
    </script>

    <x-header />

    <!-- Main Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <x-footer />

    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/service-worker.js');
            });
        }
    </script>
    {{ $scripts ?? '' }}
</body>
</html>
