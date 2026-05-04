<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard') — BisnisGrowth</title>
    <link rel="icon" type="image/png" href="{{ asset('images/Logo_Bisnis_Growth.png') }}">
    
    <script>
        // Inisialisasi Dark Mode secepat mungkin untuk mencegah FOUC
        if (localStorage.getItem('admin-dark-mode') === 'true' || (!('admin-dark-mode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Summernote Lite (Modern, Free, & Full Features) -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Smooth Theme Transition */
        *, *::before, *::after {
            transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease, box-shadow 0.2s ease !important;
        }

        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.05); border-radius: 10px; }
        .custom-scrollbar:hover::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.1); }
        aside .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.05); }
        aside .custom-scrollbar:hover::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); }

        /* SweetAlert2 Base Styles */
        .swal2-popup { border-radius: 1rem !important; padding: 1.5rem !important; border: 1px solid rgba(0,0,0,0.05) !important; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.1) !important; }
        .swal2-title { font-weight: 900 !important; font-family: 'Inter', sans-serif !important; letter-spacing: -0.025em !important; color: #0f172a !important; font-size: 1.25rem !important; }
        .swal2-html-container { color: #64748b !important; font-weight: 500 !important; font-size: 0.875rem !important; }
        .swal2-confirm { background: #f59e0b !important; color: #0f172a !important; border-radius: 0.5rem !important; font-weight: 900 !important; text-transform: uppercase !important; font-size: 10px !important; letter-spacing: 0.1em !important; padding: 0.8rem 1.5rem !important; border: none !important; }
        .swal2-cancel { background: #f1f5f9 !important; color: #64748b !important; border-radius: 0.5rem !important; font-weight: 900 !important; text-transform: uppercase !important; font-size: 10px !important; letter-spacing: 0.1em !important; padding: 0.8rem 1.5rem !important; }
        .swal2-icon { border-width: 2px !important; }
        
        /* Sleek Toast Style */
        .swal2-toast { 
            padding: 0.75rem 1rem !important; 
            border-radius: 0.75rem !important; 
            background: #ffffff !important; 
            border: 1px solid rgba(245, 158, 11, 0.2) !important;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1) !important;
        }
        .swal2-toast .swal2-title { color: #0f172a !important; font-size: 0.875rem !important; margin-left: 0.5rem !important; }

        /* DARK MODE - COMPREHENSIVE OVERRIDES */
        .dark { color-scheme: dark; }
        .dark .bg-gray-50, .dark .bg-slate-50 { background-color: #020617 !important; }
        .dark .bg-white { background-color: #0f172a !important; }
        .dark .bg-gray-50\/50 { background-color: rgba(15, 23, 42, 0.5) !important; }
        
        .dark .text-slate-900 { color: #f1f5f9 !important; }
        .dark .text-gray-900 { color: #f8fafc !important; }
        .dark .text-gray-600 { color: #94a3b8 !important; }
        .dark .text-gray-500 { color: #64748b !important; }
        .dark .text-gray-400 { color: #475569 !important; }
        
        .dark .border-gray-100, .dark .border-gray-200, .dark .border-gray-50 { border-color: rgba(255,255,255,0.05) !important; }
        .dark header { background-color: #0f172a !important; border-bottom-color: rgba(255,255,255,0.05) !important; }
        .dark .shadow-sm { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2), 0 2px 4px -2px rgba(0, 0, 0, 0.2) !important; }
        
        /* Table Dark Mode */
        .dark table thead th { background-color: #1e293b !important; color: #94a3b8 !important; border-bottom: 1px solid rgba(255,255,255,0.05) !important; }
        .dark table tbody tr { border-bottom: 1px solid rgba(255,255,255,0.05) !important; }
        .dark table tbody tr:hover { background-color: rgba(255,255,255,0.02) !important; }
        
        /* Input Dark Mode */
        .dark input, .dark select, .dark textarea { 
            background-color: #1e293b !important; 
            border: 1px solid rgba(255,255,255,0.1) !important; 
            color: #f1f5f9 !important; 
        }
        .dark input::placeholder { color: #475569 !important; }
        .dark input:focus, .dark select:focus, .dark textarea:focus { 
            border-color: #f59e0b !important; 
            outline: none !important;
        }

        /* Pagination & Buttons Dark Mode */
        .dark .pagination nav span, .dark .pagination nav a { background-color: #1e293b !important; border-color: rgba(255,255,255,0.05) !important; color: #94a3b8 !important; }
        .dark .pagination nav .active span { background-color: #f59e0b !important; color: #020617 !important; border-color: #f59e0b !important; }
        
        /* SweetAlert2 Dark Mode Override */
        .dark .swal2-popup { background-color: #1e293b !important; color: #f1f5f9 !important; border: 1px solid rgba(255,255,255,0.1) !important; }
        .dark .swal2-title { color: #f1f5f9 !important; }
        .dark .swal2-html-container { color: #94a3b8 !important; }
        .dark .swal2-toast { background-color: #0f172a !important; border: 1px solid rgba(245, 158, 11, 0.3) !important; }
        .dark .swal2-toast .swal2-title { color: #f1f5f9 !important; }
        .dark .swal2-cancel { background-color: #334155 !important; color: #cbd5e1 !important; }

        /* Summernote Dark Mode */
        .dark .note-editor { border-color: rgba(255,255,255,0.1) !important; background-color: #1e293b !important; }
        .dark .note-toolbar { background-color: #1e293b !important; border-bottom-color: rgba(255,255,255,0.05) !important; }
        .dark .note-btn { background-color: #334155 !important; border-color: rgba(255,255,255,0.05) !important; color: #f1f5f9 !important; }
        .dark .note-editable { background-color: #1e293b !important; color: #f1f5f9 !important; }
        .dark .note-statusbar { display: none !important; }

        /* Prose / Content Dark Mode */
        .dark .prose { color: #94a3b8 !important; max-width: none !important; }
        .dark .prose h1, .dark .prose h2, .dark .prose h3, .dark .prose h4, .dark .prose strong { color: #f1f5f9 !important; }
        .dark .prose a { color: #f59e0b !important; }

        /* Misc */
        .dark .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); }
        .dark .bg-gray-100 { background-color: rgba(255,255,255,0.05) !important; }
    </style>
</head>
<body class="h-full font-sans antialiased text-gray-900 overflow-hidden" x-data="{ sidebarOpen: false }">
    <!-- Light Minimalist Page Loader -->
    <div id="page-loader" class="fixed inset-0 z-[9999] bg-white dark:bg-slate-900 flex flex-col items-center justify-center transition-all duration-700 ease-in-out">
        <div class="relative">
            <!-- Pulsing Circle Decoration -->
            <div class="absolute inset-0 bg-amber-500/10 rounded-full animate-[ping_2.5s_infinite] scale-150"></div>
            
            <!-- Logo with Breathing & Fade Effect -->
            <div class="relative w-20 h-20 animate-[pulse_2s_infinite]">
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
                    loader.style.pointerEvents = 'none';
                    setTimeout(() => {
                        loader.style.display = 'none';
                    }, 700);
                }
            }, 300);
        });
    </script>

    <div class="flex h-screen bg-gray-50 overflow-hidden">
        
        <!-- Sidebar Desktop -->
        <aside class="hidden md:flex md:flex-col md:w-64 bg-slate-900 text-white shrink-0 shadow-xl border-r border-white/5 h-full">
            <div class="flex items-center h-16 px-6 bg-slate-950/50 shrink-0">
                <img class="h-8 w-8 mr-3" src="{{ asset('images/Logo_Bisnis_Growth.png') }}" alt="Logo">
                <span class="font-bold text-lg tracking-tight">Bisnis<span class="text-amber-400">Growth</span></span>
            </div>
            <div class="flex-1 overflow-y-auto p-4 custom-scrollbar">
                @include('layouts.partials.admin-nav')
            </div>
            <div class="p-4 bg-slate-950/30 border-t border-white/5 shrink-0">
                <div class="flex items-center gap-3">
                    <div class="h-8 w-8 bg-amber-500 rounded-md flex items-center justify-center text-slate-900 font-bold text-xs uppercase overflow-hidden shadow-lg shadow-amber-500/20">
                        @if(Auth::user()->profile_photo)
                            @php
                                $photoPath = Auth::user()->profile_photo;
                                // Jika path tidak diawali uploads/, asumsikan dari storage lama
                                $fullPhotoPath = str_starts_with($photoPath, 'uploads/') ? asset($photoPath) : asset('storage/' . $photoPath);
                            @endphp
                            <img src="{{ $fullPhotoPath }}" class="h-full w-full object-cover">
                        @else
                            {{ substr(Auth::user()->name, 0, 1) }}
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-[10px] font-black uppercase tracking-widest text-white/40 mb-0.5">Admin Server</p>
                        <p class="text-xs font-bold truncate text-white">{{ Auth::user()->name }}</p>
                    </div>
                    <form id="logout-form-desktop" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="button" onclick="logoutConfirm('logout-form-desktop')" class="text-white/40 hover:text-red-400 transition-colors p-1.5 hover:bg-white/5 rounded-md">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Sidebar Mobile Drawer -->
        <div x-show="sidebarOpen" class="fixed inset-0 z-40 md:hidden" role="dialog" aria-modal="true" style="display: none;">
            <div @click="sidebarOpen = false" x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm"></div>
            <div x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="relative flex-1 flex flex-col max-w-xs w-full bg-slate-900 text-white shadow-2xl h-full">
                <div class="absolute top-0 right-0 -mr-12 pt-2">
                    <button @click="sidebarOpen = false" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-white">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                    <div class="flex-shrink-0 flex items-center px-6">
                        <img class="h-8 w-auto mr-3" src="{{ asset('images/Logo_Bisnis_Growth.png') }}" alt="Logo">
                        <span class="font-bold text-lg">Bisnis<span class="text-amber-400">Growth</span></span>
                    </div>
                    <nav class="mt-8 px-4 flex-1">@include('layouts.partials.admin-nav')</nav>
                    <div class="p-4 bg-slate-950/30 border-t border-white/5 mt-auto">
                        <div class="flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 bg-amber-500 rounded-lg flex items-center justify-center text-slate-900 font-bold text-sm uppercase shadow-lg shadow-amber-500/20 overflow-hidden">
                                    @if(Auth::user()->profile_photo)
                                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" class="h-full w-full object-cover">
                                    @else
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    @endif
                                </div>
                                <div class="min-w-0"><p class="text-xs font-bold truncate text-white">{{ Auth::user()->name }}</p><p class="text-[9px] font-black uppercase tracking-widest text-white/30">Administrator</p></div>
                            </div>
                            <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST">@csrf<button type="button" onclick="logoutConfirm('logout-form-mobile')" class="bg-red-500/10 text-red-500 p-2.5 rounded-lg hover:bg-red-500 hover:text-white transition-all"><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg></button></form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 min-w-0 overflow-hidden">
            <header class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow-sm border-b border-gray-200">
                <button @click="sidebarOpen = true" class="px-4 border-r border-gray-200 text-gray-500 md:hidden"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg></button>
                <div class="flex-1 px-6 flex justify-between items-center">
                    <h1 class="text-lg font-black text-slate-900 uppercase tracking-tight">@yield('header', 'Dashboard')</h1>
                    <div class="flex items-center">
                        <div class="hidden md:flex flex-col items-end mr-6"><span class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Server Time</span><span class="text-xs font-bold text-slate-900 dark:text-gray-300 leading-none">{{ now()->translatedFormat('d F Y') }}</span></div>
                        <div class="h-8 w-px bg-gray-100 dark:bg-white/5 mr-6 hidden md:block"></div>
                        
                        <!-- Dark Mode Toggle -->
                        <button @click="document.documentElement.classList.toggle('dark'); localStorage.setItem('admin-dark-mode', document.documentElement.classList.contains('dark'))" 
                                class="bg-gray-50 dark:bg-slate-800 p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-amber-500 dark:hover:text-amber-400 transition-all border border-gray-100 dark:border-white/5 mr-3">
                            <!-- Sun (Light Mode Icon) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9h-1m15.364-6.364l-.707.707M6.343 17.657l-.707.707M16.95 16.95l.707.707M7.05 7.05l.707.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                            </svg>
                            <!-- Moon (Dark Mode Icon) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                        </button>

                        <!-- Notifications Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="bg-gray-50 p-2 rounded-md text-gray-400 hover:text-amber-500 transition-all relative border border-gray-100">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                @if($unreadCount > 0)
                                    <span class="absolute top-2 right-2 block h-2 w-2 rounded-full bg-amber-500 ring-2 ring-white"></span>
                                @endif
                            </button>

                            <div x-show="open" 
                                 @click.outside="open = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden z-50"
                                 style="display: none;">
                                <div class="px-4 py-3 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-900">Pesan Masuk</span>
                                    <span class="bg-amber-500 text-white text-[9px] font-black px-2 py-0.5 rounded-full">{{ $unreadCount }}</span>
                                </div>
                                <div class="max-h-96 overflow-y-auto custom-scrollbar">
                                    @forelse($unreadMessages as $msg)
                                        <a href="{{ route('admin.messages.index') }}" class="block px-4 py-4 hover:bg-amber-50 transition-colors border-b border-gray-50 last:border-0">
                                            <div class="flex gap-3">
                                                <div class="h-8 w-8 bg-slate-100 rounded-md flex items-center justify-center text-slate-400 shrink-0 text-xs font-bold uppercase">
                                                    {{ substr($msg->name, 0, 1) }}
                                                </div>
                                                <div class="min-w-0">
                                                    <p class="text-xs font-black text-slate-900 truncate mb-0.5">{{ $msg->name }}</p>
                                                    <p class="text-[10px] text-gray-500 line-clamp-1 mb-1">{{ $msg->message }}</p>
                                                    <p class="text-[8px] font-bold text-amber-600 uppercase tracking-tighter">{{ $msg->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @empty
                                        <div class="px-4 py-12 text-center">
                                            <p class="text-xs font-bold text-gray-400">Tidak ada pesan baru.</p>
                                        </div>
                                    @endforelse
                                </div>
                                <a href="{{ route('admin.messages.index') }}" class="block py-3 text-center text-[10px] font-black uppercase tracking-widest bg-slate-900 text-white hover:bg-amber-500 hover:text-slate-900 transition-all">
                                    Lihat Semua Pesan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <main class="flex-1 overflow-y-auto focus:outline-none bg-gray-50 p-6 md:p-10 custom-scrollbar">
                <div class="max-w-7xl mx-auto">@yield('content')</div>
            </main>
        </div>
    </div>

    <style>
        /* Smooth Theme Transition */
        *, *::before, *::after {
            transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease, box-shadow 0.2s ease !important;
        }

        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.05); border-radius: 10px; }
        .custom-scrollbar:hover::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.1); }
        aside .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.05); }
        aside .custom-scrollbar:hover::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); }

        /* SweetAlert2 Base Styles */
        .swal2-popup { border-radius: 1rem !important; padding: 1.5rem !important; border: 1px solid rgba(0,0,0,0.05) !important; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.1) !important; }
        .swal2-title { font-weight: 900 !important; font-family: 'Inter', sans-serif !important; letter-spacing: -0.025em !important; color: #0f172a !important; font-size: 1.25rem !important; }
        .swal2-html-container { color: #64748b !important; font-weight: 500 !important; font-size: 0.875rem !important; }
        .swal2-confirm { background: #f59e0b !important; color: #0f172a !important; border-radius: 0.5rem !important; font-weight: 900 !important; text-transform: uppercase !important; font-size: 10px !important; letter-spacing: 0.1em !important; padding: 0.8rem 1.5rem !important; border: none !important; }
        .swal2-cancel { background: #f1f5f9 !important; color: #64748b !important; border-radius: 0.5rem !important; font-weight: 900 !important; text-transform: uppercase !important; font-size: 10px !important; letter-spacing: 0.1em !important; padding: 0.8rem 1.5rem !important; }
        .swal2-icon { border-width: 2px !important; }
        
        /* Sleek Toast Style */
        .swal2-toast { 
            padding: 0.75rem 1rem !important; 
            border-radius: 0.75rem !important; 
            background: #ffffff !important; 
            border: 1px solid rgba(245, 158, 11, 0.2) !important;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1) !important;
        }
        .swal2-toast .swal2-title { color: #0f172a !important; font-size: 0.875rem !important; margin-left: 0.5rem !important; }

        /* DARK MODE - COMPREHENSIVE OVERRIDES */
        .dark { color-scheme: dark; }
        .dark .bg-gray-50, .dark .bg-slate-50 { background-color: #020617 !important; }
        .dark .bg-white { background-color: #0f172a !important; }
        .dark .bg-gray-50\/50 { background-color: rgba(15, 23, 42, 0.5) !important; }
        
        .dark .text-slate-900 { color: #f1f5f9 !important; }
        .dark .text-gray-900 { color: #f8fafc !important; }
        .dark .text-gray-600 { color: #94a3b8 !important; }
        .dark .text-gray-500 { color: #64748b !important; }
        .dark .text-gray-400 { color: #475569 !important; }
        
        .dark .border-gray-100, .dark .border-gray-200, .dark .border-gray-50 { border-color: rgba(255,255,255,0.05) !important; }
        .dark header { background-color: #0f172a !important; border-bottom-color: rgba(255,255,255,0.05) !important; }
        .dark .shadow-sm { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2), 0 2px 4px -2px rgba(0, 0, 0, 0.2) !important; }
        
        /* Table Dark Mode */
        .dark table thead th { background-color: #1e293b !important; color: #94a3b8 !important; border-bottom: 1px solid rgba(255,255,255,0.05) !important; }
        .dark table tbody tr { border-bottom: 1px solid rgba(255,255,255,0.05) !important; }
        .dark table tbody tr:hover { background-color: rgba(255,255,255,0.02) !important; }
        
        /* Input Dark Mode */
        .dark input, .dark select, .dark textarea { 
            background-color: #1e293b !important; 
            border: 1px solid rgba(255,255,255,0.1) !important; 
            color: #f1f5f9 !important; 
        }
        .dark input::placeholder { color: #475569 !important; }
        .dark input:focus, .dark select:focus, .dark textarea:focus { 
            border-color: #f59e0b !important; 
            outline: none !important;
        }

        /* Pagination & Buttons Dark Mode */
        .dark .pagination nav span, .dark .pagination nav a { background-color: #1e293b !important; border-color: rgba(255,255,255,0.05) !important; color: #94a3b8 !important; }
        .dark .pagination nav .active span { background-color: #f59e0b !important; color: #020617 !important; border-color: #f59e0b !important; }
        
        /* SweetAlert2 Dark Mode */
        .dark .swal2-popup { background-color: #1e293b !important; color: #f1f5f9 !important; border: 1px solid rgba(255,255,255,0.1) !important; }
        .dark .swal2-title { color: #f1f5f9 !important; }
        .dark .swal2-html-container { color: #94a3b8 !important; }
        .dark .swal2-toast { background-color: #0f172a !important; border: 1px solid rgba(245, 158, 11, 0.3) !important; }
        .dark .swal2-toast .swal2-title { color: #f1f5f9 !important; }
        .dark .swal2-cancel { background-color: #334155 !important; color: #cbd5e1 !important; }

        /* Summernote Dark Mode */
        .dark .note-editor { border-color: rgba(255,255,255,0.1) !important; background-color: #1e293b !important; }
        .dark .note-toolbar { background-color: #1e293b !important; border-bottom-color: rgba(255,255,255,0.05) !important; }
        .dark .note-btn { background-color: #334155 !important; border-color: rgba(255,255,255,0.05) !important; color: #f1f5f9 !important; }
        .dark .note-editable { background-color: #1e293b !important; color: #f1f5f9 !important; }
        .dark .note-statusbar { display: none !important; }

        /* Prose / Content Dark Mode */
        .dark .prose { color: #94a3b8 !important; max-width: none !important; }
        .dark .prose h1, .dark .prose h2, .dark .prose h3, .dark .prose h4, .dark .prose strong { color: #f1f5f9 !important; }
        .dark .prose a { color: #f59e0b !important; }
    </style>

    @stack('scripts')

    <script>
        // SweetAlert2 Configuration
        const getToastConfig = () => {
            const isDark = document.documentElement.classList.contains('dark');
            return {
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: isDark ? '#0f172a' : '#ffffff',
                color: isDark ? '#f1f5f9' : '#0f172a',
                iconColor: '#f59e0b',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            };
        };

        // Listen for Laravel Flash Messages
        @if(session('success'))
            Swal.mixin(getToastConfig()).fire({ icon: 'success', title: '{{ session('success') }}' });
        @endif

        @if(session('error'))
            Swal.fire({ 
                icon: 'error', 
                title: 'Terjadi Kesalahan', 
                text: '{{ session('error') }}', 
                confirmButtonText: 'TUTUP',
                background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#ffffff',
                color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#0f172a',
            });
        @endif

        // Global Confirm Delete
        window.confirmDelete = function(formId) {
            const isDark = document.documentElement.classList.contains('dark');
            Swal.fire({
                title: 'Hapus Data?',
                text: "Tindakan ini tidak dapat dibatalkan!",
                icon: 'warning',
                iconColor: '#ef4444',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#ef4444',
                cancelButtonColor: isDark ? '#334155' : '#f1f5f9',
                reverseButtons: true,
                background: isDark ? '#1e293b' : '#ffffff',
                color: isDark ? '#f1f5f9' : '#0f172a',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            })
        }

        // Global Confirm Logout
        window.logoutConfirm = function(formId) {
            const isDark = document.documentElement.classList.contains('dark');
            Swal.fire({
                title: 'Ingin Keluar?',
                text: "Sesi Anda akan segera berakhir.",
                icon: 'question',
                iconColor: '#f59e0b',
                showCancelButton: true,
                confirmButtonText: 'YA, KELUAR',
                cancelButtonText: 'BATAL',
                confirmButtonColor: '#f59e0b',
                cancelButtonColor: isDark ? '#334155' : '#f1f5f9',
                reverseButtons: true,
                background: isDark ? '#1e293b' : '#ffffff',
                color: isDark ? '#f1f5f9' : '#0f172a',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            })
        }
    </script>
</body>
</html>
