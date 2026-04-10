<x-app-layout>
    <x-slot name="seo">
        <x-seo-head 
            title="Wawasan Bisnis & Strategi UMKM Indonesia"
            description="Temukan artikel terbaru seputar strategi pemasaran, pengelolaan keuangan, dan tren teknologi untuk mengembangkan bisnis Anda."
        />
    </x-slot>

    <style>
        /* Pagination Overrides - Perfect Centering */
        .article-pagination { 
            margin-top: 5rem; 
            width: 100%; 
            display: flex !important; 
            justify-content: center !important; 
        }
        .article-pagination nav { 
            display: flex !important; 
            justify-content: center !important; 
            align-items: center !important; 
            background: transparent !important; 
            border: none !important; 
            box-shadow: none !important;
        }
        
        /* Hide Mobile Version & Info Text */
        .article-pagination nav > div:first-child { display: none !important; }
        .article-pagination nav > div:last-child > div:first-child { display: none !important; }
        
        /* Link Container Centering */
        .article-pagination nav > div:last-child { 
            display: flex !important; 
            justify-content: center !important; 
            width: auto !important; 
        }
        .article-pagination nav > div:last-child > div:last-child { 
            display: inline-flex !important; 
            position: relative !important; 
            justify-content: center !important; 
            border: none !important; 
            box-shadow: none !important;
            background: transparent !important;
        }

        /* Modern Pagination Links Styling */
        .article-pagination nav a, 
        .article-pagination nav span { 
            border: none !important; 
            background: white !important; 
            color: #6B7280 !important; 
            font-weight: 800 !important; 
            font-size: 0.75rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.05em !important;
            border-radius: 0.75rem !important; 
            padding: 0.75rem 1.25rem !important; 
            margin: 0 0.25rem !important; 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05) !important;
        }

        /* Active Page State */
        .article-pagination nav span[aria-current="page"] span { 
            background: #B91C1C !important; 
            color: white !important; 
            box-shadow: 0 10px 15px -3px rgba(185, 28, 28, 0.2) !important;
            transform: scale(1.1) !important;
            z-index: 10 !important;
        }

        /* Hover Effect */
        .article-pagination nav a:hover { 
            background: #FEF2F2 !important; 
            color: #B91C1C !important; 
            transform: translateY(-3px) !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
        }

        .article-pagination svg { width: 1.25rem; height: 1.25rem; }
    </style>

    <!-- Hero Section: Featured + Sidebar Grid -->
    <section class="bg-white py-10 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- Main Featured (Left) -->
                @if($featuredArticle)
                <div class="lg:col-span-8">
                    <a href="/artikel/{{ $featuredArticle->slug }}" class="group relative block overflow-hidden rounded-3xl bg-gray-900 h-[300px] md:h-[500px] shadow-xl">
                        <img src="{{ $featuredArticle->image }}" alt="{{ $featuredArticle->title }}" 
                             class="absolute inset-0 h-full w-full object-cover opacity-80 transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>
                        
                        <div class="absolute bottom-0 p-5 md:p-10 lg:p-12 max-w-2xl">
                            <span class="inline-block px-3 py-1 mb-3 md:mb-4 text-[9px] md:text-[10px] font-black uppercase tracking-[0.2em] text-burgundy-900 bg-gold-400 rounded-md">
                                UTAMA • {{ $featuredArticle->category_name }}
                            </span>
                            <h2 class="text-xl sm:text-2xl md:text-4xl font-black text-white mb-3 md:mb-4 leading-tight group-hover:text-gold-100 transition-colors">
                                {{ $featuredArticle->title }}
                            </h2>
                            <p class="text-gray-300 text-sm md:text-base line-clamp-2 font-medium opacity-90 hidden sm:block">
                                {{ $featuredArticle->excerpt }}
                            </p>
                        </div>
                    </a>
                </div>
                @endif

                <!-- Sidebar Grid (Right) -->
                <div class="lg:col-span-4 flex flex-col gap-6">
                    <div class="flex items-center gap-4 mb-2">
                        <h3 class="text-xs font-black uppercase tracking-[0.3em] text-burgundy-600">Terpopuler</h3>
                        <div class="h-px flex-grow bg-gray-100"></div>
                    </div>
                    
                    @foreach($sidebarArticles as $sideArticle)
                    <a href="/artikel/{{ $sideArticle->slug }}" class="group flex gap-4 items-center">
                        <div class="shrink-0 w-24 h-24 rounded-2xl overflow-hidden shadow-sm">
                            <img src="{{ $sideArticle->image }}" alt="{{ $sideArticle->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-[9px] font-black uppercase text-gold-600 tracking-widest">{{ $sideArticle->category_name }}</span>
                            <h4 class="text-sm font-bold text-burgundy-900 leading-snug group-hover:text-burgundy-600 transition-colors line-clamp-2">
                                {{ $sideArticle->title }}
                            </h4>
                            <span class="text-[9px] text-gray-400 font-bold">{{ $sideArticle->published_at->format('d M Y') }}</span>
                        </div>
                    </a>
                    @if(!$loop->last) <div class="h-px w-full bg-gray-50"></div> @endif
                    @endforeach

                    <!-- Explore Categories Link -->
                    <div class="mt-auto">
                        <a href="/artikel" class="flex items-center justify-center w-full py-4 bg-gray-50 rounded-2xl text-[10px] font-black uppercase tracking-widest text-burgundy-600 hover:bg-burgundy-50 transition-colors">
                            Lihat Semua Wawasan
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Articles Section -->
    <section class="py-16 px-4 bg-gray-50/50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-12">
                <div class="flex flex-col">
                    <span class="text-gold-600 text-[10px] font-black uppercase tracking-[0.3em] mb-2">Teranyar</span>
                    <h2 class="text-3xl font-black text-burgundy-900 tracking-tight uppercase">Artikel Terbaru</h2>
                </div>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 md:gap-6">
                @foreach($articles as $article)
                <article class="group bg-white rounded-xl overflow-hidden border border-gray-100 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex flex-col h-full">
                    <a href="/artikel/{{ $article->slug }}" class="relative aspect-[16/10] overflow-hidden block">
                        <img src="{{ $article->image }}" alt="{{ $article->title }}" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                             loading="lazy">
                        <div class="absolute top-2 left-2 md:top-3 md:left-3">
                            <span class="px-1.5 py-0.5 md:px-2 md:py-0.5 bg-white/90 backdrop-blur-sm text-[7px] md:text-[9px] font-black uppercase tracking-wider text-burgundy-800 rounded shadow-sm">
                                {{ $article->category_name }}
                            </span>
                        </div>
                    </a>
                    
                    <div class="p-3 md:p-5 flex-grow flex flex-col">
                        <div class="flex items-center text-gray-400 text-[7px] md:text-[9px] font-bold uppercase tracking-widest mb-2 md:mb-3">
                            <span>{{ $article->published_at->format('d M y') }}</span>
                            <span class="mx-1 text-gold-400">•</span>
                            <span>{{ ceil(str_word_count(strip_tags($article->content)) / 200) }} Min</span>
                        </div>
                        
                        <h3 class="text-xs md:text-lg font-bold text-burgundy-900 mb-1 md:mb-2 leading-snug group-hover:text-burgundy-600 transition-colors line-clamp-2">
                            <a href="/artikel/{{ $article->slug }}">{{ $article->title }}</a>
                        </h3>
                        
                        <p class="text-gray-500 text-[10px] md:text-xs leading-relaxed line-clamp-2 mb-3 hidden md:block">
                            {{ $article->excerpt }}
                        </p>

                        <div class="mt-auto pt-3 md:pt-4 border-t border-gray-50 flex items-center justify-between">
                            <a href="/artikel/{{ $article->slug }}" class="inline-flex items-center text-[8px] md:text-[10px] font-black text-burgundy-600 uppercase tracking-widest hover:text-burgundy-800 transition-colors">
                                Baca
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-2.5 w-2.5 md:h-3 md:w-3 ml-1 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="article-pagination">
                {{ $articles->links() }}
            </div>
        </div>
    </section>

</x-app-layout>
