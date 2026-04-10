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
    <!-- Page Loader -->
    <div id="page-loader" class="fixed inset-0 z-[9999] bg-white flex flex-col items-center justify-center transition-opacity duration-700 ease-in-out">
        <div class="relative">
            <!-- Pulsing Logo -->
            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-2xl relative z-10 animate-bounce-slow">
                <img src="{{ asset('images/Logo_Bisnis_Growth.png') }}" alt="Loading..." class="w-12 h-12 object-contain">
            </div>
            <!-- Outer Ripple Effect -->
            <div class="absolute inset-0 bg-burgundy-100 rounded-full animate-ping opacity-25"></div>
        </div>
        
        <!-- Animated Progress Bar -->
        <div class="mt-10 w-48 h-1 bg-gray-100 rounded-full overflow-hidden">
            <div class="h-full bg-logo-gradient w-0 animate-progress"></div>
        </div>
        
        <div class="mt-4 text-[10px] font-black uppercase tracking-[0.3em] text-burgundy-900 animate-pulse">
            Bisnis<span class="text-gold-600">Growth</span>
        </div>
    </div>

    <style>
        @keyframes bounce-slow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        @keyframes progress {
            0% { width: 0%; }
            50% { width: 70%; }
            100% { width: 100%; }
        }
        .animate-bounce-slow { animation: bounce-slow 2s infinite ease-in-out; }
        .animate-progress { animation: progress 2s infinite ease-in-out; }
        
        /* Smooth Fade Out Class */
        .loader-hide { opacity: 0; pointer-events: none; }
    </style>

    <script>
        window.addEventListener('load', function() {
            const loader = document.getElementById('page-loader');
            setTimeout(() => {
                loader.classList.add('loader-hide');
                // Optional: remove from DOM after transition
                setTimeout(() => loader.style.display = 'none', 700);
            }, 500); // Small delay for "cool" effect
        });
    </script>

    <x-header />

    <!-- Main Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <x-footer />
</body>
</body>
</html>
