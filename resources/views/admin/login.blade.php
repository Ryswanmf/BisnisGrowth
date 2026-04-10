<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login — BisnisGrowth</title>
    <link rel="icon" type="image/png" href="{{ asset('images/Logo_Bisnis_Growth.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: radial-gradient(circle at center, #7F1D1D 0%, #450A0A 100%);
        }
    </style>
</head>
<body class="h-full font-sans antialiased flex items-center justify-center p-4">
    <!-- Loading Screen -->
    <div id="loader" class="fixed inset-0 z-[100] flex flex-col items-center justify-center bg-burgundy-900 transition-opacity duration-500">
        <div class="relative">
            <div class="w-20 h-20 border-4 border-gold-400/20 border-t-gold-400 rounded-full animate-spin"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <img src="{{ asset('images/Logo_Bisnis_Growth.png') }}" alt="Logo" class="h-8 w-8 animate-pulse">
            </div>
        </div>
        <p class="mt-4 text-gold-400 text-xs font-black tracking-[0.3em] uppercase animate-pulse">Memuat...</p>
    </div>
    
    <div class="w-full max-w-[400px]">
        <!-- Header Section -->
        <div class="flex flex-col items-center mb-8">
            <div class="bg-white p-3 rounded-2xl shadow-2xl mb-4 transform hover:scale-105 transition-transform duration-300">
                <img src="{{ asset('images/Logo_Bisnis_Growth.png') }}" alt="Logo BisnisGrowth" class="h-10 w-10">
            </div>
            <h1 class="text-xl font-black text-white tracking-[0.2em] uppercase">
                Bisnis<span class="text-gold-400">Growth</span>
            </h1>
            <p class="text-burgundy-200 text-xs mt-2 font-medium tracking-widest uppercase">Management Portal</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-2xl relative overflow-hidden">
            <!-- Decorative element -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-gold-400/5 rounded-full -mr-16 -mt-16"></div>
            
            <div class="mb-8 relative">
                <h2 class="text-2xl font-black text-burgundy-900 tracking-tight">Login Admin</h2>
                <p class="text-gray-500 text-sm mt-1">Silakan masuk ke akun Anda.</p>
                <div class="w-12 h-1.5 bg-gold-400 mt-3 rounded-full"></div>
            </div>

            <form id="loginForm" action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Email Field -->
                <div class="space-y-2">
                    <label for="email" class="text-xs font-bold text-gray-500 uppercase tracking-wider ml-1">Alamat Email</label>
                    <div class="relative group">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-burgundy-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"/>
                            </svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full bg-gray-50 border border-gray-100 rounded-xl py-3.5 pl-12 pr-4 text-sm font-semibold text-gray-700 focus:outline-none focus:ring-4 focus:ring-burgundy-600/5 focus:border-burgundy-600 focus:bg-white transition-all"
                            placeholder="admin@bisnisgrowth.id">
                    </div>
                    @error('email')
                        <p class="text-red-600 text-xs font-semibold mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="space-y-2">
                    <div class="flex justify-between items-center ml-1">
                        <label for="password" class="text-xs font-bold text-gray-500 uppercase tracking-wider">Password</label>
                        <a href="#" class="text-xs font-bold text-gold-600 hover:text-gold-700 transition-colors">Lupa Password?</a>
                    </div>
                    <div class="relative group">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-burgundy-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input id="password" type="password" name="password" required
                            class="w-full bg-gray-50 border border-gray-100 rounded-xl py-3.5 pl-12 pr-4 text-sm font-semibold text-gray-700 focus:outline-none focus:ring-4 focus:ring-burgundy-600/5 focus:border-burgundy-600 focus:bg-white transition-all"
                            placeholder="••••••••">
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center gap-3 px-1">
                    <div class="relative flex items-center h-5">
                        <input type="checkbox" name="remember" id="remember" 
                            class="w-4 h-4 rounded border-gray-300 text-burgundy-600 focus:ring-burgundy-600/20 cursor-pointer">
                    </div>
                    <label for="remember" class="text-sm font-medium text-gray-500 cursor-pointer select-none">Ingat saya di perangkat ini</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-burgundy-600 text-white font-bold py-4 px-6 rounded-xl text-sm uppercase tracking-widest hover:bg-burgundy-700 transition-all shadow-xl shadow-burgundy-900/20 active:scale-[0.98] transform flex items-center justify-center gap-2">
                    <span>Masuk ke Dashboard</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </button>
            </form>
        </div>

        <!-- Footer Links -->
        <div class="mt-8 text-center">
            <a href="/" class="group inline-flex items-center gap-2 text-xs font-bold text-burgundy-100 uppercase tracking-widest hover:text-white transition-all">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Situs Utama
            </a>
        </div>
    </div>

    <script>
        // Sembunyikan loader setelah halaman selesai dimuat
        window.addEventListener('load', () => {
            const loader = document.getElementById('loader');
            loader.classList.add('opacity-0');
            setTimeout(() => {
                loader.classList.add('hidden');
            }, 500);
        });

        // Tampilkan kembali loader saat form di-submit
        document.getElementById('loginForm').addEventListener('submit', () => {
            const loader = document.getElementById('loader');
            loader.classList.remove('hidden');
            setTimeout(() => {
                loader.classList.remove('opacity-0');
            }, 10);
        });
    </script>
</body>
</html>
