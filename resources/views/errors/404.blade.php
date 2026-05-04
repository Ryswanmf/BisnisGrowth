<x-app-layout>
    <x-slot name="seo">
        <x-seo-head 
            title="404 — Halaman Tidak Ditemukan"
            description="Ups! Sepertinya Anda tersesat di labirin bisnis kami. Halaman yang Anda cari tidak tersedia di BisnisGrowth."
        />
    </x-slot>

    <section class="min-h-[80vh] flex items-center justify-center px-4 bg-white relative overflow-hidden">
        <!-- Background Decorations -->
        <div class="absolute top-1/4 -left-20 w-64 h-64 bg-amber-500/5 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 -right-20 w-80 h-80 bg-burgundy-900/5 rounded-full blur-3xl animate-pulse"></div>

        <div class="max-w-2xl w-full text-center relative z-10">
            <!-- 404 Illustration Area -->
            <div class="relative inline-block mb-12">
                <h1 class="text-[120px] md:text-[180px] font-black text-slate-100 leading-none select-none">404</h1>
                <div class="absolute inset-0 flex items-center justify-center translate-y-4">
                    <div class="w-32 h-32 md:w-40 md:h-40 bg-white rounded-3xl shadow-2xl flex items-center justify-center p-8 rotate-12 hover:rotate-0 transition-transform duration-500">
                        <img src="{{ asset('images/Logo_Bisnis_Growth.png') }}" alt="BisnisGrowth" class="w-full h-full object-contain">
                    </div>
                </div>
            </div>

            <!-- Error Message -->
            <div class="space-y-4">
                <h2 class="text-2xl md:text-3xl font-black text-slate-900 uppercase tracking-tight">Ups! Sepertinya Anda Tersesat</h2>
                <p class="text-gray-500 text-sm md:text-base max-w-md mx-auto leading-relaxed">
                    Halaman yang Anda cari tidak ditemukan atau mungkin telah dipindahkan. Jangan khawatir, mari kita kembali ke jalan yang benar untuk mengembangkan bisnis Anda.
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="mt-12 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/" class="w-full sm:w-auto px-8 py-4 bg-amber-500 text-slate-900 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-amber-400 transition-all shadow-xl shadow-amber-500/20">
                    Kembali ke Beranda
                </a>
                <a href="{{ route('article.index') }}" class="w-full sm:w-auto px-8 py-4 bg-slate-50 text-slate-900 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-gray-100 transition-all border border-gray-100">
                    Jelajahi Wawasan
                </a>
            </div>

            <!-- Quick Links -->
            <div class="mt-16 pt-8 border-t border-gray-50 flex flex-wrap justify-center gap-x-8 gap-y-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                <a href="{{ route('contact') }}" class="hover:text-amber-500 transition-colors">Laporkan Masalah</a>
                <span class="opacity-20 hidden sm:inline">•</span>
                <a href="/faq" class="hover:text-amber-500 transition-colors">Pusat Bantuan</a>
                <span class="opacity-20 hidden sm:inline">•</span>
                <a href="{{ route('pages.show', 'tentang-kami') }}" class="hover:text-amber-500 transition-colors">Tentang Kami</a>
            </div>
        </div>
    </section>
</x-app-layout>
