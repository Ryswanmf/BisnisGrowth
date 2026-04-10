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
    
    <div class="w-full max-w-[360px]">
        <!-- Compact Header -->
        <div class="flex items-center justify-center gap-3 mb-6">
            <div class="bg-white p-2 rounded-xl shadow-xl">
                <img src="{{ asset('images/Logo_Bisnis_Growth.png') }}" alt="Logo" class="h-7 w-7">
            </div>
            <h1 class="text-base font-black text-white tracking-[0.2em] uppercase">
                Bisnis<span class="text-gold-400">Growth</span>
            </h1>
        </div>

        <!-- Ultra Compact Card -->
        <div class="bg-white rounded-[1.5rem] p-6 md:p-8 shadow-2xl">
            <div class="mb-6">
                <h2 class="text-xl font-black text-burgundy-950 tracking-tight">Login Admin</h2>
                <div class="w-10 h-1 bg-gold-400 mt-1 rounded-full"></div>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                
                <!-- Email -->
                <div class="space-y-1">
                    <label for="email" class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Email</label>
                    <div class="relative">
                        <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-300">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"/></svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full bg-gray-50 border border-gray-100 rounded-lg py-2.5 pl-10 pr-4 text-xs font-bold text-gray-700 focus:outline-none focus:ring-2 focus:ring-burgundy-600/10 focus:border-burgundy-600 transition-all"
                            placeholder="admin@bisnisgrowth.id">
                    </div>
                    @error('email')
                        <p class="text-red-600 text-[8px] font-bold uppercase ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="space-y-1">
                    <div class="flex justify-between items-center ml-1">
                        <label for="password" class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Password</label>
                        <a href="#" class="text-[9px] font-black text-gold-600 uppercase tracking-widest">Lupa?</a>
                    </div>
                    <div class="relative">
                        <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-300">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <input id="password" type="password" name="password" required
                            class="w-full bg-gray-50 border border-gray-100 rounded-lg py-2.5 pl-10 pr-4 text-xs font-bold text-gray-700 focus:outline-none focus:ring-2 focus:ring-burgundy-600/10 focus:border-burgundy-600 transition-all"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center gap-2 px-1">
                    <input type="checkbox" name="remember" id="remember" class="w-3 h-3 rounded border-gray-300 text-burgundy-600 focus:ring-0">
                    <label for="remember" class="text-[9px] font-bold text-gray-400 uppercase tracking-tighter cursor-pointer">Ingat Saya</label>
                </div>

                <button type="submit" class="w-full bg-burgundy-600 text-white font-black py-3 px-6 rounded-xl text-[9px] uppercase tracking-[0.2em] hover:bg-burgundy-800 transition-all shadow-lg shadow-burgundy-900/20 active:scale-[0.97]">
                    Masuk
                </button>
            </form>
        </div>

        <!-- Minimal Footer -->
        <div class="mt-6 text-center">
            <a href="/" class="text-[9px] font-black text-burgundy-200 uppercase tracking-[0.3em] hover:text-white transition-colors">
                ← Kembali ke Situs
            </a>
        </div>
    </div>

</body>
</html>
