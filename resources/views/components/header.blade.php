<!-- Navbar -->
<nav class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm py-2">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 gap-8">
            <!-- Kiri: Logo & Nama -->
            <div class="flex shrink-0 items-center">
                <a href="/" class="flex items-center gap-2 text-2xl font-bold tracking-tight text-burgundy-600">
                    <img src="{{ asset('images/Logo_Bisnis_Growth.png') }}" alt="Logo BisnisGrowth" class="h-10 w-10 object-contain">
                    <span class="hidden sm:inline">Bisnis<span class="text-gold-600">Growth</span></span>
                </a>
            </div>
            
            <!-- Tengah: Search Bar -->
            <div class="flex-grow max-w-lg hidden md:block">
                <form action="/direktori" method="GET" class="relative">
                    <input type="text" name="q" placeholder="Cari bisnis atau kategori..." 
                        class="w-full bg-gray-50 border border-gray-200 rounded-full py-2.5 pl-12 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-burgundy-600/20 focus:border-burgundy-600 transition-all">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </form>
            </div>

            <!-- Kanan: Menu Navigasi -->
            <div class="flex items-center space-x-6 text-sm font-semibold text-gray-600">
                <a href="/" class="hover:text-burgundy-600 transition-colors">Beranda</a>
                <a href="/artikel" class="hover:text-burgundy-600 transition-colors">Artikel</a>
                <a href="/kontak" class="hover:text-burgundy-600 transition-colors">Kontak</a>
                
                @auth
                    <div class="h-6 w-px bg-gray-200 mx-2 hidden sm:block"></div>
                    <a href="{{ route('dashboard.index') }}" class="btn-primary !py-2 !px-4 text-xs lg:text-sm text-white">Dashboard</a>
                @endauth
            </div>
        </div>
    </div>
</nav>