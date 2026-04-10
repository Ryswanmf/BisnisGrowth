<x-app-layout>
    <x-slot name="seo">
        <x-seo-head 
            :title="$article->title"
            :description="$article->excerpt ?? Str::limit(strip_tags($article->content), 160)"
            :ogImage="$article->image"
        />
    </x-slot>

    <div class="bg-white">
        <!-- Header Section -->
        <div class="pt-12 pb-10 px-4 lg:px-6 bg-gray-50/20 border-b border-gray-100">
            <div class="max-w-6xl mx-auto">
                <nav class="flex items-center gap-3 mb-8 text-[9px] font-black uppercase tracking-[0.2em]">
                    <a href="/" class="text-gray-400 hover:text-burgundy-600 transition-colors">Beranda</a>
                    <span class="text-gray-200">/</span>
                    <span class="text-burgundy-600">{{ $article->category_name }}</span>
                </nav>
                
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-black text-burgundy-900 leading-[1.1] tracking-tighter mb-10 max-w-5xl">
                    {{ $article->title }}
                </h1>

                <div class="flex flex-wrap items-center gap-8 pt-8 border-t border-gray-200/60">
                    <!-- Author & Date -->
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-burgundy-600 flex items-center justify-center text-white text-[10px] font-black shadow-lg shadow-burgundy-600/20">
                            BG
                        </div>
                        <div class="flex flex-col gap-0.5">
                            <span class="text-[9px] font-black text-burgundy-900 uppercase tracking-widest">Redaksi BisnisGrowth</span>
                            <span class="text-[9px] font-bold text-gray-400 uppercase tracking-tighter">{{ $article->published_at->format('d F Y') }}</span>
                        </div>
                    </div>
                    
                    <div class="hidden sm:block h-8 w-px bg-gray-200"></div>

                    <!-- Stats Row -->
                    <div class="flex items-center gap-8">
                        <div class="flex flex-col gap-0.5">
                            <span class="text-[8px] font-black text-gray-300 uppercase tracking-widest text-left">Durasi</span>
                            <span class="text-[10px] font-black text-burgundy-900 uppercase tracking-tighter">{{ ceil(str_word_count(strip_tags($article->content)) / 200) }} Menit</span>
                        </div>
                        <div class="flex flex-col gap-0.5">
                            <span class="text-[8px] font-black text-gray-300 uppercase tracking-widest text-left">Kunjungan</span>
                            <span class="text-[10px] font-black text-burgundy-900 uppercase tracking-tighter">{{ number_format($article->view_count) }} Kali</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Media Gallery Section (Slightly Smaller) -->
        <div class="max-w-6xl mx-auto px-4 mt-8 mb-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3 h-[300px] md:h-[450px]">
                <!-- Main Big Photo -->
                <div class="md:col-span-2 md:row-span-2 relative overflow-hidden rounded-2xl group shadow-xl">
                    <img src="{{ $article->image }}" alt="Gallery 1" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                </div>
                
                <!-- Extra Photo 2 -->
                <div class="md:col-span-2 relative overflow-hidden rounded-2xl group shadow-lg">
                    <img src="{{ $article->image_2 ?? 'https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80&w=800' }}" alt="Gallery 2" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                </div>

                <!-- Extra Photo 3 -->
                <div class="relative overflow-hidden rounded-2xl group shadow-lg">
                    <img src="{{ $article->image_3 ?? 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80&w=800' }}" alt="Gallery 3" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                </div>

                <!-- Extra Photo 4 -->
                <div class="relative overflow-hidden rounded-2xl group shadow-lg">
                    <img src="{{ $article->image_4 ?? 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&q=80&w=800' }}" alt="Gallery 4" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                </div>
            </div>
        </div>

        <!-- Content + Sidebar Grid -->
        <div class="max-w-6xl mx-auto px-4 lg:px-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                
                <!-- Left: Article Body -->
                <main class="lg:col-span-8">
                    <div class="prose prose-lg prose-burgundy max-w-none">
                        <p class="text-xl text-gray-500 font-medium leading-relaxed mb-10 font-serif italic border-l-4 border-gold-400 pl-6">
                            {{ $article->excerpt }}
                        </p>
                        
                        <div class="text-gray-700 leading-relaxed font-serif text-lg">
                            {!! nl2br(e($article->content)) !!}
                            
                            <p class="mt-6">
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                            </p>

                            <blockquote class="my-10 p-8 bg-gray-50 rounded-2xl border-none italic text-burgundy-900 font-bold text-xl relative overflow-hidden">
                                <p class="relative z-10">"Kunci kesuksesan UMKM di masa depan adalah kolaborasi teknologi dengan sentuhan personal yang kuat kepada pelanggan."</p>
                            </blockquote>
                        </div>
                    </div>

                    <!-- Article Tags & Share -->
                    <div class="mt-12 pt-8 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-6">
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1.5 bg-gray-50 text-[8px] font-black uppercase tracking-widest text-gray-500 rounded-lg hover:bg-gold-400 hover:text-burgundy-900 transition-colors cursor-pointer">#UMKM</span>
                            <span class="px-3 py-1.5 bg-gray-50 text-[8px] font-black uppercase tracking-widest text-gray-500 rounded-lg hover:bg-gold-400 hover:text-burgundy-900 transition-colors cursor-pointer">#DigitalMarketing</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-[8px] font-black uppercase tracking-widest text-gray-400">Share:</span>
                            <div class="flex gap-1.5">
                                <button class="w-9 h-9 rounded-xl bg-burgundy-50 flex items-center justify-center text-burgundy-600 hover:bg-burgundy-600 hover:text-white transition-all">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                </button>
                                <button class="w-9 h-9 rounded-xl bg-burgundy-50 flex items-center justify-center text-burgundy-600 hover:bg-green-500 hover:text-white transition-all">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.417-.003 6.557-5.338 11.892-11.893 11.892-1.997-.001-3.951-.5-5.688-1.448l-6.305 1.652zm6.599-3.835c1.404.835 3.128 1.42 4.908 1.42 5.432 0 9.851-4.419 9.853-9.85.002-2.634-1.025-5.111-2.893-6.98-1.869-1.869-4.347-2.894-6.981-2.895-5.433 0-9.851 4.419-9.854 9.85-.001 1.777.475 3.51 1.378 4.98l-1.077 3.931 4.066-1.056zm11.391-7.147c-.313-.157-1.853-.915-2.14-.984-.287-.07-.496-.105-.705.21-.209.314-.805 1.015-1.014 1.258-.209.243-.418.272-.731.115-.313-.157-1.32-.486-2.515-1.553-.929-.829-1.556-1.854-1.739-2.169-.183-.314-.02-.484.137-.64.141-.141.313-.366.47-.55.157-.183.209-.314.313-.523.104-.21.052-.392-.026-.55-.078-.157-.705-1.701-.966-2.33-.255-.612-.516-.529-.705-.539-.182-.01-.391-.011-.6-.011-.209 0-.548.078-.835.392-.287.314-1.096 1.072-1.096 2.615 0 1.543 1.122 3.033 1.278 3.243.157.21 2.208 3.372 5.35 4.731.747.323 1.33.516 1.784.661.751.24 1.436.206 1.977.125.603-.09 1.853-.758 2.114-1.492.261-.735.261-1.362.183-1.492-.078-.13-.287-.21-.6-.367z"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </main>

                <!-- Right: Sticky Sidebar Recommendation -->
                <aside class="lg:col-span-4 border-l border-gray-50 pl-8 hidden lg:block">
                    <div class="sticky top-24 space-y-10">
                        <div>
                            <div class="flex items-center gap-3 mb-6">
                                <h3 class="text-[9px] font-black uppercase tracking-[0.2em] text-burgundy-600">Rekomendasi</h3>
                                <div class="h-px flex-grow bg-gray-100"></div>
                            </div>
                            
                            <div class="space-y-5">
                                @foreach($relatedArticles as $related)
                                <a href="/artikel/{{ $related->slug }}" class="group flex gap-3 items-center">
                                    <div class="shrink-0 w-16 h-16 rounded-xl overflow-hidden shadow-sm">
                                        <img src="{{ $related->image }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    </div>
                                    <div class="flex flex-col gap-0.5">
                                        <span class="text-[7px] font-black uppercase text-gold-600">{{ $related->category_name }}</span>
                                        <h4 class="text-xs font-bold text-burgundy-900 leading-snug group-hover:text-burgundy-600 transition-colors line-clamp-2 italic">
                                            {{ $related->title }}
                                        </h4>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Compact Sidebar Ad -->
                        <div class="bg-logo-gradient p-6 rounded-2xl text-center shadow-xl relative overflow-hidden group">
                            <h4 class="text-white font-bold text-sm mb-3 relative z-10">Link-in-Bio Gratis?</h4>
                            <p class="text-burgundy-100 text-[10px] mb-4 opacity-80 relative z-10 leading-relaxed">Daftarkan bisnis Anda & dapatkan satu link profesional.</p>
                            <a href="/register" class="bg-white text-burgundy-900 font-black py-2 px-4 rounded-lg text-[9px] uppercase tracking-widest relative z-10 inline-block">Daftar</a>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </div>

    <!-- Minimal Back Footer -->
    <div class="bg-gray-50 py-12 mt-12">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <a href="/artikel" class="text-[10px] font-black uppercase tracking-widest text-burgundy-600 hover:text-burgundy-800 transition-colors">
                ← Kembali ke Direktori Artikel
            </a>
        </div>
    </div>
</x-app-layout>
