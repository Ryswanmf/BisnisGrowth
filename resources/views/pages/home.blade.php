<x-app-layout>
    <x-slot name="seo">
        <x-seo-head 
            title="Wawasan Bisnis & Strategi UMKM Indonesia"
            description="BisnisGrowth — Solusi direktori UMKM dan portal edukasi bisnis terpercaya di Indonesia. Temukan strategi pemasaran, manajemen keuangan, dan tips sukses bisnis lokal."
            :ogImage="asset('images/Logo_Bisnis_Growth.png')"
        />
    </x-slot>

    <x-slot name="styles">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        <style>
            .hero-swiper {
                width: 100%;
                height: 100%;
            }
            .swiper-pagination-bullet {
                background: white !important;
                opacity: 0.5;
            }
            .swiper-pagination-bullet-active {
                background: #f59e0b !important;
                opacity: 1;
                width: 24px;
                border-radius: 4px;
            }
        </style>
    </x-slot>

    <!-- Hero Section: Featured Slider + Sidebar Grid -->
    <section class="bg-white py-10 px-4">
        <div class="max-w-7xl mx-auto">
            @if($featuredArticles->isNotEmpty())
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- Main Featured Slider (Left) -->
                <div class="lg:col-span-8 overflow-hidden rounded shadow-xl">
                    <div class="swiper hero-swiper">
                        <div class="swiper-wrapper">
                            @foreach($featuredArticles as $fArt)
                            <div class="swiper-slide">
                                <a href="javascript:void(0)" onclick="trackArticleClick({{ $fArt->id }}, '{{ route('article.show', $fArt->slug) }}')" class="group relative block bg-slate-100 h-[300px] md:h-[500px]">
                                    @if($fArt->image)
                                        <img src="{{ \App\Helpers\ContentHelper::imageUrl($fArt->image) }}" alt="{{ $fArt->title }}" 
                                             class="absolute inset-0 h-full w-full object-cover opacity-80 transition-transform duration-700 group-hover:scale-105"
                                             loading="eager" fetchpriority="high" decoding="async">
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>
                                    
                                    <div class="absolute bottom-0 p-5 md:p-10 lg:p-12 max-w-2xl">
                                        <span class="inline-block px-3 py-1 mb-3 md:mb-4 text-[9px] md:text-[10px] font-black uppercase tracking-[0.2em] text-burgundy-900 bg-amber-400 rounded">
                                            UTAMA • {{ $fArt->category_name }}
                                        </span>
                                        <h2 class="text-xl sm:text-2xl md:text-4xl font-black text-white mb-3 md:mb-4 leading-tight group-hover:text-amber-100 transition-colors">
                                            {{ $fArt->title }}
                                        </h2>
                                        <p class="text-gray-300 text-sm md:text-base line-clamp-2 font-medium opacity-90 hidden sm:block">
                                            {{ $fArt->excerpt }}
                                        </p>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                        <!-- Add Pagination only if more than 1 slide -->
                        @if($featuredArticles->count() > 1)
                            <div class="swiper-pagination"></div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar Grid (Right) -->
                <div class="lg:col-span-4 flex flex-col gap-6">
                    <div class="flex items-center gap-4 mb-2">
                        <h3 class="text-xs font-black uppercase tracking-[0.3em] text-burgundy-600">Terpopuler</h3>
                        <div class="h-px flex-grow bg-gray-100"></div>
                    </div>
                    
                    @if($sidebarArticles->isNotEmpty())
                        @foreach($sidebarArticles as $sideArticle)
                        <a href="javascript:void(0)" onclick="trackArticleClick({{ $sideArticle->id }}, '{{ route('article.show', $sideArticle->slug) }}')" class="group flex gap-4 items-center">
                            <div class="shrink-0 w-24 h-24 rounded overflow-hidden shadow-sm bg-gray-50">
                                @if($sideArticle->image)
                                    <img src="{{ \App\Helpers\ContentHelper::imageUrl($sideArticle->image) }}" alt="{{ $sideArticle->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                         loading="lazy" decoding="async">
                                @endif
                            </div>
                            <div class="flex flex-col gap-1">
                                <span class="text-[9px] font-black uppercase text-amber-600 tracking-widest">{{ $sideArticle->category_name }}</span>
                                <h4 class="text-sm font-bold text-slate-900 leading-snug group-hover:text-amber-600 transition-colors line-clamp-2">
                                    {{ $sideArticle->title }}
                                </h4>
                                <span class="text-[9px] text-gray-400 font-bold">{{ \Carbon\Carbon::parse($sideArticle->published_at ?? $sideArticle->created_at)->format('d M Y') }}</span>
                            </div>
                        </a>
                        @if(!$loop->last) <div class="h-px w-full bg-gray-50"></div> @endif
                        @endforeach
                    @else
                        <div class="py-10 text-center bg-gray-50 rounded border border-dashed border-gray-200">
                            <p class="text-xs text-gray-400 font-bold italic uppercase tracking-widest">Belum ada artikel populer</p>
                        </div>
                    @endif

                    <div class="mt-auto">
                        <a href="{{ route('article.index') }}" class="flex items-center justify-center w-full py-4 bg-gray-50 rounded text-[10px] font-black uppercase tracking-widest text-slate-900 hover:bg-gray-100 transition-colors">
                            Lihat Semua Wawasan
                            <svg class="h-3 w-3 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            @else
                <div class="py-20 text-center bg-gray-50 rounded-2xl border-2 border-dashed border-gray-100">
                    <h2 class="text-xl font-black text-gray-400 uppercase tracking-widest">Selamat Datang di BisnisGrowth</h2>
                    <p class="mt-2 text-gray-400 text-sm">Belum ada artikel unggulan untuk ditampilkan.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Latest Articles Section -->
    <section class="py-10 px-4 bg-gray-50/50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-8">
                <div class="flex flex-col">
                    <span class="text-amber-600 text-[10px] font-black uppercase tracking-[0.3em] mb-1">Terbaru</span>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight uppercase">Artikel Terbaru</h2>
                </div>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
                @foreach($articlesData as $article)
                <article class="group bg-white rounded overflow-hidden border border-gray-100 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex flex-col h-full">
                    <a href="javascript:void(0)" onclick="trackArticleClick({{ $article->id }}, '{{ route('article.show', $article->slug) }}')" class="relative aspect-[16/10] overflow-hidden block bg-gray-50">
                        @if($article->image)
                            <img src="{{ \App\Helpers\ContentHelper::imageUrl($article->image) }}" alt="{{ $article->title }}" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" 
                                 loading="lazy" decoding="async">
                        @endif
                        <div class="absolute top-2 left-2">
                            <span class="px-2 py-0.5 bg-white/90 backdrop-blur-sm text-[7px] md:text-[9px] font-black uppercase tracking-wider text-slate-900 rounded shadow-sm">
                                {{ $article->category_name }}
                            </span>
                        </div>
                    </a>
                    
                    <div class="p-3 md:p-5 flex-grow flex flex-col">
                        <div class="flex items-center text-gray-400 text-[7px] md:text-[9px] font-bold uppercase tracking-widest mb-1.5 md:mb-2">
                            <span>{{ \Carbon\Carbon::parse($article->published_at ?? $article->created_at)->format('d F Y') }}</span>
                            <span class="mx-1 text-amber-400">•</span>
                            <span>{{ number_format($article->click_count) }} Klik</span>
                        </div>
                        
                        <h3 class="text-xs md:text-lg font-bold text-slate-900 mb-1 md:mb-1.5 leading-snug group-hover:text-amber-600 transition-colors line-clamp-2">
                            <a href="javascript:void(0)" onclick="trackArticleClick({{ $article->id }}, '{{ route('article.show', $article->slug) }}')">{{ $article->title }}</a>
                        </h3>
                        
                        <p class="text-gray-500 text-[10px] md:text-xs leading-relaxed line-clamp-2 mb-2 hidden md:block">
                            {{ $article->excerpt }}
                        </p>

                        <div class="mt-auto pt-2 border-t border-gray-50">
                            <a href="javascript:void(0)" onclick="trackArticleClick({{ $article->id }}, '{{ route('article.show', $article->slug) }}')" class="inline-flex items-center text-[8px] md:text-[10px] font-black text-amber-600 uppercase tracking-widest hover:text-amber-800 transition-colors group">
                                Baca
                                <svg class="h-2.5 w-2.5 ml-1 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- Premium Pagination -->
            <div class="mt-12 flex justify-center">
                <div class="pagination-amber-theme bg-slate-900 p-2 rounded shadow-2xl shadow-slate-900/40 border border-slate-800">
                    {!! $links !!}
                </div>
            </div>
        </div>
    </section>

    <style>
        .pagination-amber-theme nav div div span.relative.z-0, 
        .pagination-amber-theme nav div div a.relative.z-0 {
            display: flex; gap: 4px; border: none;
        }
        .pagination-amber-theme nav span[aria-current="page"] span {
            background-color: #f59e0b !important; color: #0f172a !important; border-radius: 12px; border: none !important; font-weight: 900; padding: 8px 16px;
        }
        .pagination-amber-theme nav a, 
        .pagination-amber-theme nav span.relative.inline-flex {
            background-color: transparent !important; color: #94a3b8 !important; border: none !important; border-radius: 12px; padding: 8px 16px; font-weight: 700; transition: all 0.3s;
        }
        .pagination-amber-theme nav a:hover {
            background-color: rgba(255,255,255,0.05) !important; color: #ffffff !important;
        }
        .pagination-amber-theme nav div:first-child { display: none !important; }
        .pagination-amber-theme nav div:last-child { display: flex !important; justify-content: center; }
    </style>

    <x-slot name="scripts">
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const slidesCount = {{ $featuredArticles->count() }};
                
                if (slidesCount > 0) {
                    const swiper = new Swiper('.hero-swiper', {
                        loop: slidesCount > 1, // Loop hanya jika slide > 1
                        autoplay: slidesCount > 1 ? {
                            delay: 5000,
                            disableOnInteraction: false,
                        } : false,
                        pagination: slidesCount > 1 ? {
                            el: '.swiper-pagination',
                            clickable: true,
                        } : false,
                        effect: 'fade',
                        fadeEffect: {
                            crossFade: true
                        },
                    });
                }
            });

            function trackArticleClick(id, url) {
                fetch('/artikel/' + id + '/track-click', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ type: 'article' })
                }).finally(() => {
                    window.location.href = url;
                });
            }
        </script>
    </x-slot>
</x-app-layout>
