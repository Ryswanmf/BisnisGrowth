<!-- Footer -->
<footer class="bg-gray-50 border-t border-gray-100 py-12 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="col-span-1 md:col-span-1">
                <a href="/" class="flex items-center gap-2 text-xl font-bold text-burgundy-600">
                    <img src="{{ asset('images/Logo_Bisnis_Growth.png') }}" alt="Logo BisnisGrowth" class="h-8 w-8 object-contain">
                    <span>Bisnis<span class="text-gold-400">Growth</span></span>
                </a>
                <p class="mt-4 text-sm text-gray-500 leading-relaxed">
                    Satu Link untuk Semua Bisnismu. Solusi direktori & link-in-bio modern untuk UMKM Indonesia agar lebih dikenal dan mudah dihubungi.
                </p>
            </div>
            <div>
                <h4 class="font-semibold text-burgundy-800 mb-4 uppercase tracking-wider text-xs">Navigasi</h4>
                <ul class="space-y-3 text-sm text-gray-600">
                    <li><a href="/" class="hover:text-burgundy-600 transition-colors">Beranda</a></li>
                    <li><a href="/direktori" class="hover:text-burgundy-600 transition-colors">Direktori Bisnis</a></li>
                    <li><a href="/register" class="hover:text-burgundy-600 transition-colors">Daftar Sekarang</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-burgundy-800 mb-4 uppercase tracking-wider text-xs">Kategori Populer</h4>
                <ul class="space-y-3 text-sm text-gray-600">
                    <li><a href="/kategori/kuliner" class="hover:text-burgundy-600 transition-colors">Kuliner</a></li>
                    <li><a href="/kategori/fashion-batik" class="hover:text-burgundy-600 transition-colors">Fashion & Batik</a></li>
                    <li><a href="/kategori/teknologi-digital" class="hover:text-burgundy-600 transition-colors">Teknologi</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-burgundy-800 mb-4 uppercase tracking-wider text-xs">Hubungi Kami</h4>
                <ul class="space-y-3 text-sm text-gray-600">
                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-burgundy-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        hello@bisnisgrowth.id
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-burgundy-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        +62 812-3456-7890
                    </li>
                </ul>
            </div>
        </div>
        <div class="mt-12 pt-8 border-t border-gray-100 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} BisnisGrowth.id. All rights reserved.
        </div>
    </div>
</footer>