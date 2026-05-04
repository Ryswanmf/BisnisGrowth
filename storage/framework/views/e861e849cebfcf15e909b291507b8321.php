<!-- Navbar -->
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm py-2">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 gap-8">
            <!-- Kiri: Logo & Nama -->
            <div class="flex shrink-0 items-center">
                <a href="/" class="flex items-center gap-2 text-2xl font-bold tracking-tight text-burgundy-600">
                    <img src="<?php echo e(asset('images/Logo_Bisnis_Growth.png')); ?>" alt="Logo BisnisGrowth" class="h-10 w-10 object-contain">
                    <span class="hidden sm:inline">Bisnis<span class="text-gold-600">Growth</span></span>
                </a>
            </div>
            
            <!-- Tengah: Search Bar (Desktop) -->
            <div class="flex-grow max-w-lg hidden md:block" x-data="{ 
                query: '', 
                results: [], 
                open: false,
                loading: false,
                search() {
                    if (this.query.length < 2) {
                        this.results = [];
                        this.open = false;
                        return;
                    }
                    this.loading = true;
                    fetch(`/artikel-live-search?q=${encodeURIComponent(this.query)}`)
                        .then(res => res.json())
                        .then(data => {
                            this.results = data;
                            this.open = true;
                        })
                        .catch(err => {
                            console.error('Search error:', err);
                            this.results = [];
                        })
                        .finally(() => {
                            this.loading = false;
                        });
                }
            }" @click.outside="open = false">
                <form action="<?php echo e(route('directory.index')); ?>" method="GET" class="relative">
                    <input 
                        type="text" 
                        name="q" 
                        x-model="query"
                        @input.debounce.300ms="search()"
                        @focus="if(results.length > 0) open = true"
                        placeholder="Cari wawasan atau kategori bisnis..." 
                        class="w-full bg-gray-50 border border-gray-200 rounded-full py-2.5 pl-12 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-burgundy-600/20 focus:border-burgundy-600 transition-all"
                        autocomplete="off">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </form>

                <!-- Dropdown Hasil -->
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="absolute mt-2 w-full bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden z-[60]"
                     style="display: none;">
                    <div class="p-3 bg-gray-50/50 border-b border-gray-100 text-[10px] font-black uppercase tracking-widest text-gray-400">Hasil Pencarian</div>
                    <div class="max-h-96 overflow-y-auto">
                        <template x-for="item in results" :key="item.url">
                            <a :href="item.url" class="flex items-center gap-4 p-4 hover:bg-amber-50 transition-colors border-b border-gray-50 last:border-0 group">
                                <div class="h-10 w-10 bg-gray-100 rounded overflow-hidden shrink-0">
                                    <template x-if="item.image">
                                        <img :src="item.image" class="h-full w-full object-cover">
                                    </template>
                                    <template x-if="!item.image">
                                        <div class="h-full w-full flex items-center justify-center text-[10px] font-black text-gray-300">BG</div>
                                    </template>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs font-black text-slate-900 line-clamp-1 group-hover:text-amber-600 transition-colors" x-text="item.title"></p>
                                    <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mt-0.5" x-text="item.category"></p>
                                </div>
                            </a>
                        </template>
                        <div x-show="results.length === 0" class="p-8 text-center">
                            <p class="text-xs font-bold text-gray-400 italic">Tidak menemukan hasil yang cocok.</p>
                        </div>
                    </div>
                    <a :href="'/direktori?q=' + query" class="block py-3 text-center text-[10px] font-black uppercase tracking-widest bg-slate-900 text-white hover:bg-amber-500 hover:text-slate-900 transition-all">
                        Lihat Semua Hasil
                    </a>
                </div>
            </div>

            <!-- Kanan: Menu Navigasi (Desktop) -->
            <div class="hidden md:flex items-center space-x-6 text-sm font-semibold text-gray-600">
                <a href="/" class="hover:text-burgundy-600 transition-colors">Beranda</a>
                <a href="<?php echo e(route('article.index')); ?>" class="hover:text-burgundy-600 transition-colors">Artikel</a>
                <a href="<?php echo e(route('contact')); ?>" class="hover:text-burgundy-600 transition-colors">Kontak</a>                
                <?php if(auth()->guard()->check()): ?>
                    <div class="h-6 w-px bg-gray-200 mx-2 hidden sm:block"></div>
                    <a href="<?php echo e(route('dashboard.index')); ?>" class="btn-primary !py-2 !px-4 text-xs lg:text-sm text-white">Dashboard</a>
                <?php endif; ?>
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex items-center md:hidden">
                <button id="mobile-menu-btn" class="text-gray-500 hover:text-burgundy-600 focus:outline-none p-2 rounded-md bg-gray-50 transition-colors">
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
            <form action="<?php echo e(route('directory.index')); ?>" method="GET" class="relative mb-6">
                <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Cari artikel..." 
                    class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 pl-10 pr-4 text-xs focus:outline-none focus:ring-2 focus:ring-burgundy-600/10 focus:border-burgundy-600 transition-all">
                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </div>
            </form>

            <a href="/" class="block px-4 py-3 rounded-lg text-sm font-bold text-gray-700 hover:bg-burgundy-50 hover:text-burgundy-600 transition-colors">Beranda</a>
            <a href="<?php echo e(route('article.index')); ?>" class="block px-4 py-3 rounded-lg text-sm font-bold text-gray-700 hover:bg-burgundy-50 hover:text-burgundy-600 transition-colors">Artikel</a>
            <a href="<?php echo e(route('contact')); ?>" class="block px-4 py-3 rounded-lg text-sm font-bold text-gray-700 hover:bg-burgundy-50 hover:text-burgundy-600 transition-colors">Kontak</a>
            
            <?php if(auth()->guard()->check()): ?>
                <div class="pt-4 border-t border-gray-100">
                    <a href="<?php echo e(route('dashboard.index')); ?>" class="block text-center btn-primary !py-3 w-full !text-xs uppercase tracking-widest shadow-none">Dashboard</a>
                </div>
            <?php endif; ?>
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
<?php /**PATH D:\laragon\www\BisnisGrowth\resources\views/components/header.blade.php ENDPATH**/ ?>