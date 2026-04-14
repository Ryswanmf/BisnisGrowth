<!-- Navbar -->
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm py-2">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 gap-8">
            <!-- Kiri: Logo & Nama -->
            <div class="flex shrink-0 items-center">
                <a href="/" class="flex items-center gap-2 text-2xl font-bold tracking-tight text-burgundy-600">
                    <img src="{{ asset('images/Logo_Bisnis_Growth.png') }}" alt="Logo BisnisGrowth" class="h-10 w-10 object-contain">
                    <span class="hidden sm:inline">Bisnis<span class="text-gold-600">Growth</span></span>
                </a>
            </div>
            
            <!-- Tengah: Search Bar (Desktop) -->
            <div class="flex-grow max-w-lg hidden md:block">
                <form action="{{ route('directory.index') }}" method="GET" class="relative">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari wawasan atau kategori bisnis..." 
                        class="w-full bg-gray-50 border border-gray-200 rounded-full py-2.5 pl-12 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-burgundy-600/20 focus:border-burgundy-600 transition-all">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </form>
            </div>

            <!-- Kanan: Menu Navigasi (Desktop) -->
            <div class="hidden md:flex items-center space-x-6 text-sm font-semibold text-gray-600">
                <a href="/" class="hover:text-burgundy-600 transition-colors">Beranda</a>
                <a href="{{ route('article.index') }}" class="hover:text-burgundy-600 transition-colors">Artikel</a>
                <a href="{{ route('contact') }}" class="hover:text-burgundy-600 transition-colors">Kontak</a>                
                @auth
                    <div class="h-6 w-px bg-gray-200 mx-2 hidden sm:block"></div>
                    <a href="{{ route('dashboard.index') }}" class="btn-primary !py-2 !px-4 text-xs lg:text-sm text-white">Dashboard</a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex items-center md:hidden">
                <button id="mobile-menu-btn" class="text-gray-500 hover:text-burgundy-600 focus:outline-none p-2 rounded-lg bg-gray-50 transition-colors">
                    <svg id="icon-menu" class="h-6 w-6 block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="icon-close" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Panel -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 absolute w-full left-0 shadow-lg">
        <div class="px-4 pt-4 pb-6 space-y-3">
            <!-- Mobile Search Bar -->
            <form action="{{ route('directory.index') }}" method="GET" class="relative mb-6">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari artikel..." 
                    class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 pl-10 pr-4 text-xs focus:outline-none focus:ring-2 focus:ring-burgundy-600/10 focus:border-burgundy-600 transition-all">
                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </div>
            </form>

            <a href="/" class="block px-4 py-3 rounded-xl text-sm font-bold text-gray-700 hover:bg-burgundy-50 hover:text-burgundy-600 transition-colors">Beranda</a>
            <a href="{{ route('article.index') }}" class="block px-4 py-3 rounded-xl text-sm font-bold text-gray-700 hover:bg-burgundy-50 hover:text-burgundy-600 transition-colors">Artikel</a>
            <a href="{{ route('contact') }}" class="block px-4 py-3 rounded-xl text-sm font-bold text-gray-700 hover:bg-burgundy-50 hover:text-burgundy-600 transition-colors">Kontak</a>
            
            @auth
                <div class="pt-4 border-t border-gray-100">
                    <a href="{{ route('dashboard.index') }}" class="block text-center btn-primary !py-3 w-full !text-xs uppercase tracking-widest shadow-none">Dashboard</a>
                </div>
            @endauth
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        const iconMenu = document.getElementById('icon-menu');
        const iconClose = document.getElementById('icon-close');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            iconMenu.classList.toggle('hidden');
            iconMenu.classList.toggle('block');
            iconClose.classList.toggle('hidden');
            iconClose.classList.toggle('block');
        });
    });
</script>
