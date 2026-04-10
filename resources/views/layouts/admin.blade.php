<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard') — BisnisGrowth</title>
    <link rel="icon" type="image/png" href="{{ asset('images/Logo_Bisnis_Growth.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-gray-900">

    <div class="min-h-full flex">
        <!-- Sidebar: Dark Burgundy Background -->
        <aside class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0 bg-burgundy-900 border-r border-white/10 shadow-2xl z-30">
            <div class="flex flex-col flex-grow overflow-y-auto">
                
                <!-- Logo Area -->
                <div class="flex items-center h-20 flex-shrink-0 px-6 bg-burgundy-950/40 border-b border-white/5">
                    <div class="flex items-center gap-3">
                        <div class="h-9 w-9 bg-white/10 p-1.5 rounded-lg border border-white/20">
                            <img class="h-full w-full object-contain" src="{{ asset('images/Logo_Bisnis_Growth.png') }}" alt="BisnisGrowth">
                        </div>
                        <div>
                            <span class="block text-white font-extrabold tracking-tight text-sm">Bisnis<span class="text-gold-400">Growth</span></span>
                            <span class="block text-[9px] font-bold text-burgundy-400 uppercase tracking-widest mt-0.5">Control Panel</span>
                        </div>
                    </div>
                </div>
                
                <!-- Navigation -->
                <nav class="mt-6 flex-1 px-3 pb-8 space-y-8">
                    
                    <!-- SECTION: DASHBOARD -->
                    <div>
                        <p class="px-4 text-[10px] font-bold text-white/30 uppercase tracking-[0.2em] mb-3">Utama</p>
                        <div class="space-y-1">
                            <a href="{{ route('dashboard.index') }}" 
                               class="{{ request()->routeIs('dashboard.index') 
                                        ? 'bg-gold-600/10 text-gold-400 shadow-[inset_0_1px_0_0_rgba(255,255,255,0.05)]' 
                                        : 'text-white/60 hover:bg-white/5 hover:text-white' }} 
                                        group flex items-center px-4 py-2.5 text-sm font-semibold rounded-xl transition-all duration-200">
                                <svg class="mr-3.5 h-5 w-5 {{ request()->routeIs('dashboard.index') ? 'text-gold-400' : 'text-white/40 group-hover:text-gold-400' }} transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                Dashboard
                            </a>
                        </div>
                    </div>

                    <!-- SECTION: MANAJEMEN -->
                    <div>
                        <p class="px-4 text-[10px] font-bold text-white/30 uppercase tracking-[0.2em] mb-3">Konten & Bisnis</p>
                        <div class="space-y-1">
                            <a href="#" class="text-white/60 hover:bg-white/5 hover:text-white group flex items-center px-4 py-2.5 text-sm font-semibold rounded-xl transition-all duration-200">
                                <svg class="mr-3.5 h-5 w-5 text-white/40 group-hover:text-gold-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                Daftar Bisnis
                            </a>

                            <a href="{{ route('article.index') }}" 
                               class="{{ request()->routeIs('article.index') 
                                        ? 'bg-gold-600/10 text-gold-400 shadow-[inset_0_1px_0_0_rgba(255,255,255,0.05)]' 
                                        : 'text-white/60 hover:bg-white/5 hover:text-white' }} 
                                        group flex items-center px-4 py-2.5 text-sm font-semibold rounded-xl transition-all duration-200">
                                <svg class="mr-3.5 h-5 w-5 {{ request()->routeIs('article.index') ? 'text-gold-400' : 'text-white/40 group-hover:text-gold-400' }} transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M14 2v4a2 2 0 002 2h4"/>
                                </svg>
                                Kelola Artikel
                            </a>

                            <a href="#" class="text-white/60 hover:bg-white/5 hover:text-white group flex items-center px-4 py-2.5 text-sm font-semibold rounded-xl transition-all duration-200">
                                <svg class="mr-3.5 h-5 w-5 text-white/40 group-hover:text-gold-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                Kategori
                            </a>
                        </div>
                    </div>

                    <!-- SECTION: KONFIGURASI -->
                    <div>
                        <p class="px-4 text-[10px] font-bold text-white/30 uppercase tracking-[0.2em] mb-3">Konfigurasi</p>
                        <div class="space-y-1">
                            <a href="#" class="text-white/60 hover:bg-white/5 hover:text-white group flex items-center px-4 py-2.5 text-sm font-semibold rounded-xl transition-all duration-200">
                                <svg class="mr-3.5 h-5 w-5 text-white/40 group-hover:text-gold-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                Pengguna Admin
                            </a>

                            <a href="#" class="text-white/60 hover:bg-white/5 hover:text-white group flex items-center px-4 py-2.5 text-sm font-semibold rounded-xl transition-all duration-200">
                                <svg class="mr-3.5 h-5 w-5 text-white/40 group-hover:text-gold-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Pengaturan Situs
                            </a>
                        </div>
                    </div>
                </nav>

                <!-- Profile Area -->
                <div class="flex-shrink-0 p-4 bg-burgundy-950/40 border-t border-white/5">
                    <div class="flex items-center gap-3 bg-white/5 p-3 rounded-2xl border border-white/5">
                        <div class="h-10 w-10 bg-gradient-to-br from-gold-400 to-gold-600 rounded-xl flex items-center justify-center text-burgundy-900 font-bold shadow-lg shadow-gold-500/10">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[11px] font-bold text-white truncate">{{ Auth::user()->name }}</p>
                            <p class="text-[9px] font-medium text-white/40 truncate uppercase tracking-widest mt-0.5">Administrator</p>
                        </div>
                        <form action="{{ route('logout') }}" method="POST" class="shrink-0">
                            @csrf
                            <button type="submit" class="p-2 text-white/30 hover:text-white hover:bg-white/10 rounded-lg transition-all" title="Keluar">
                                <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="md:pl-64 flex flex-col flex-1">
            <header class="h-20 bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-20 border-b border-gray-100 flex items-center px-8">
                <div class="flex-1 flex justify-between items-center">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-1">Halaman</p>
                        <h1 class="text-lg font-extrabold text-burgundy-900 tracking-tight">@yield('header')</h1>
                    </div>
                    
                    <div class="flex items-center gap-6">
                        <div class="hidden lg:flex flex-col text-right">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">{{ now()->translatedFormat('d F Y') }}</span>
                            <span class="text-[9px] font-bold text-gold-600 uppercase tracking-widest mt-0.5">Server Time: {{ now()->format('H:i') }}</span>
                        </div>
                        <div class="h-8 w-px bg-gray-100 hidden lg:block"></div>
                        <div class="flex items-center gap-3">
                            <div class="p-2.5 bg-gray-50 rounded-xl text-gray-400 hover:text-burgundy-600 transition-all relative cursor-pointer group">
                                <svg class="h-5 w-5 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                                <span class="absolute top-2.5 right-2.5 h-2 w-2 bg-red-500 rounded-full border-2 border-white animate-pulse"></span>
                            </div>
                            
                            <!-- Mobile Menu Toggle (Simplified) -->
                            <button class="md:hidden p-2.5 bg-burgundy-900 text-white rounded-xl">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-8 bg-gray-50">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
            
            <footer class="h-16 bg-white border-t border-gray-100 flex items-center px-8">
                <div class="w-full flex justify-between items-center">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">&copy; {{ date('Y') }} BisnisGrowth. Dashboard Version 1.0.5</p>
                    <div class="flex items-center gap-6">
                        <a href="#" class="text-[10px] font-bold text-gray-400 hover:text-burgundy-600 uppercase tracking-widest transition-colors">Bantuan</a>
                        <a href="#" class="text-[10px] font-bold text-gray-400 hover:text-burgundy-600 uppercase tracking-widest transition-colors">Privasi</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

</body>
</html>
