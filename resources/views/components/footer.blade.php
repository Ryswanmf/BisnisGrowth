<!-- Footer -->
<footer class="bg-burgundy-600 text-[#FFF8E7] py-16 md:py-24 mt-auto">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 lg:gap-20">
            
            <!-- Column 1: Brand & About -->
            <div class="space-y-8">
                <a href="/" class="flex items-center gap-4 text-2xl font-black text-white group">
                    <div class="bg-white p-2 rounded-2xl shadow-xl transition-all duration-500 group-hover:rotate-6 group-hover:scale-110 shrink-0">
                        @if($footerSetting && $footerSetting->logo)
                            <img src="{{ asset($footerSetting->logo) }}" alt="Logo" class="h-10 w-10 object-contain">
                        @else
                            <img src="{{ asset('images/Logo_Bisnis_Growth.png') }}" alt="Logo" class="h-10 w-10 object-contain">
                        @endif
                    </div>
                    <span class="tracking-tight">Bisnis<span class="text-gold-400">Growth</span></span>
                </a>
                <p class="text-base text-burgundy-100 leading-relaxed opacity-80">
                    {{ $footerSetting->about_text ?? 'Satu Link untuk Semua Bisnismu. Solusi direktori & link-in-bio modern untuk UMKM Indonesia.' }}
                </p>
            </div>

            <!-- Column 2: Navigation -->
            <div class="md:pl-10">
                <h4 class="font-black text-gold-400 mb-8 uppercase tracking-[0.2em] text-[10px]">Navigasi Utama</h4>
                <ul class="space-y-5 text-sm font-bold">
                    <li><a href="{{ route('home') }}" class="text-burgundy-50 hover:text-gold-400 transition-colors flex items-center gap-3 group">
                        <span class="h-1 w-1 bg-gold-400 rounded-full opacity-0 group-hover:opacity-100 transition-all"></span> Beranda
                    </a></li>
                    <li><a href="{{ route('article.index') }}" class="text-burgundy-50 hover:text-gold-400 transition-colors flex items-center gap-3 group">
                        <span class="h-1 w-1 bg-gold-400 rounded-full opacity-0 group-hover:opacity-100 transition-all"></span> Wawasan Bisnis
                    </a></li>
                    <li><a href="{{ route('contact') }}" class="text-burgundy-50 hover:text-gold-400 transition-colors flex items-center gap-3 group">
                        <span class="h-1 w-1 bg-gold-400 rounded-full opacity-0 group-hover:opacity-100 transition-all"></span> Hubungi Kami
                    </a></li>
                </ul>
            </div>

            <!-- Column 3: Contact & Social -->
            <div class="space-y-8">
                <h4 class="font-black text-gold-400 mb-8 uppercase tracking-[0.2em] text-[10px]">Kontak Resmi</h4>
                <ul class="space-y-6 text-sm font-bold">
                    <li class="flex items-start gap-4">
                        <svg class="h-5 w-5 text-gold-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span class="text-burgundy-50">{{ $footerSetting->email ?? 'hello@bisnisgrowth.id' }}</span>
                    </li>
                    <li class="flex items-start gap-4">
                        <svg class="h-5 w-5 text-gold-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span class="text-burgundy-50">{{ $footerSetting->phone ?? '+62 812-3456-7890' }}</span>
                    </li>
                    <li class="flex items-start gap-4">
                        <svg class="h-5 w-5 text-gold-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span class="text-burgundy-50 leading-relaxed">{{ $footerSetting->address ?? 'Jakarta, Indonesia.' }}</span>
                    </li>
                </ul>
                
                <!-- Social Icons -->
                <div class="flex gap-4 pt-4">
                    @if($footerSetting)
                        @foreach(['facebook_url' => 'M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z', 
                                  'instagram_url' => 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z'] as $field => $svg)
                            @if($footerSetting->$field)
                                <a href="{{ $footerSetting->$field }}" target="_blank" class="w-10 h-10 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-gold-400 hover:text-burgundy-900 hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="{{ $svg }}"/></svg>
                                </a>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-20 pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6 text-[10px] font-black uppercase tracking-[0.3em] text-burgundy-200/40">
            <div>{{ $footerSetting->copyright_text ?? '© ' . date('Y') . ' BisnisGrowth. All rights reserved.' }}</div>
            <div class="flex gap-8">
                <a href="#" class="hover:text-white transition-colors">Server Status: Online</a>
                <a href="#" class="hover:text-white transition-colors">Privacy Protected</a>
            </div>
        </div>
    </div>
</footer>
