<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard') — BisnisGrowth</title>
    <link rel="icon" type="image/png" href="{{ asset('images/Logo_Bisnis_Growth.png') }}">
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-gray-900 overflow-hidden" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen bg-gray-50 overflow-hidden">
        
        <!-- Sidebar Desktop -->
        <aside class="hidden md:flex md:flex-col md:w-64 bg-slate-900 text-white shrink-0 shadow-xl border-r border-white/5 h-full">
            <!-- Logo Area (Fixed at top of sidebar) -->
            <div class="flex items-center h-16 px-6 bg-slate-950/50 shrink-0">
                <img class="h-8 w-8 mr-3" src="{{ asset('images/Logo_Bisnis_Growth.png') }}" alt="Logo">
                <span class="font-bold text-lg tracking-tight">Bisnis<span class="text-amber-400">Growth</span></span>
            </div>
            
            <!-- Navigasi (Scrollable within sidebar) -->
            <div class="flex-1 overflow-y-auto p-4 custom-scrollbar">
                @include('layouts.partials.admin-nav')
            </div>

            <!-- Profile / Logout (Fixed at bottom of sidebar) -->
            <div class="p-4 bg-slate-950/30 border-t border-white/5 shrink-0">
                <div class="flex items-center gap-3">
                    <div class="h-8 w-8 bg-amber-500 rounded-lg flex items-center justify-center text-slate-900 font-bold text-xs uppercase">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-[10px] font-black uppercase tracking-widest text-white/40 mb-0.5">Admin Server</p>
                        <p class="text-xs font-bold truncate text-white">{{ Auth::user()->name }}</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-white/40 hover:text-red-400 transition-colors p-1.5 hover:bg-white/5 rounded-lg">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Sidebar Mobile Drawer (Remains fixed) -->
        <div x-show="sidebarOpen" class="fixed inset-0 z-40 md:hidden" role="dialog" aria-modal="true" style="display: none;">
            <div @click="sidebarOpen = false" x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm"></div>
            
            <div x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="relative flex-1 flex flex-col max-w-xs w-full bg-slate-900 text-white shadow-2xl h-full">
                <div class="absolute top-0 right-0 -mr-12 pt-2">
                    <button @click="sidebarOpen = false" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-white">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                    <div class="flex-shrink-0 flex items-center px-6">
                        <img class="h-8 w-auto mr-3" src="{{ asset('images/Logo_Bisnis_Growth.png') }}" alt="Logo">
                        <span class="font-bold text-lg">Bisnis<span class="text-amber-400">Growth</span></span>
                    </div>
                    <nav class="mt-8 px-4">
                        @include('layouts.partials.admin-nav')
                    </nav>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex flex-col flex-1 min-w-0 overflow-hidden">
            <!-- Top Header (Fixed at top of content area) -->
            <header class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow-sm border-b border-gray-200">
                <button @click="sidebarOpen = true" class="px-4 border-r border-gray-200 text-gray-500 md:hidden">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="flex-1 px-6 flex justify-between items-center">
                    <div class="flex-1 flex items-center">
                        <h1 class="text-lg font-black text-slate-900 uppercase tracking-tight">@yield('header', 'Dashboard')</h1>
                    </div>
                    <div class="ml-4 flex items-center md:ml-6">
                        <div class="hidden md:flex flex-col items-end mr-6">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Server Time</span>
                            <span class="text-xs font-bold text-slate-900 leading-none">{{ now()->translatedFormat('d F Y') }}</span>
                        </div>
                        <div class="h-8 w-px bg-gray-100 mr-6 hidden md:block"></div>
                        <button class="bg-gray-50 p-2 rounded-xl text-gray-400 hover:text-amber-500 transition-all relative border border-gray-100">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="absolute top-2 right-2 block h-2 w-2 rounded-full bg-amber-500 ring-2 ring-white"></span>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Main Content (Independent Scroll) -->
            <main class="flex-1 overflow-y-auto focus:outline-none bg-gray-50 p-6 md:p-10 custom-scrollbar">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.05); border-radius: 10px; }
        .custom-scrollbar:hover::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.1); }
        aside .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.05); }
        aside .custom-scrollbar:hover::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); }
    </style>

    @stack('scripts')

</body>
</html>
