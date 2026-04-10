<x-app-layout>
    <x-slot name="seo">
        <x-seo-head 
            title="Wawasan Bisnis & Strategi UMKM - BisnisGrowth"
            description="Pelajari strategi pemasaran, keuangan, dan operasional terbaik untuk pertumbuhan bisnis Anda."
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
            font-size: 0.7rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.05em !important;
            border-radius: 0.75rem !important; 
            padding: 0.6rem 1rem !important; 
            margin: 0 0.2rem !important; 
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
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
        }

        .article-pagination svg { width: 1.25rem; height: 1.25rem; }
    </style>

    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 lg:px-8 py-12 md:py-16">
            <nav class="flex items-center gap-2 mb-6">
                <a href="/" class="text-[10px] font-black text-gray-400 hover:text-burgundy-600 transition-colors uppercase tracking-[0.2em]">Beranda</a>
                <span class="text-gray-300">/</span>
                <span class="text-[10px] font-black text-burgundy-600 uppercase tracking-[0.2em]">Artikel</span>
            </nav>
            <h1 class="text-4xl md:text-6xl font-black text-burgundy-900 tracking-tighter leading-none mb-4 uppercase">
                Wawasan <span class="text-gold-600">Bisnis</span>
            </h1>
            <p class="text-gray-500 text-sm md:text-base font-medium max-w-2xl leading-relaxed">
                Kumpulan strategi dan tips mendalam untuk membantu UMKM Indonesia bertransformasi menjadi bisnis yang lebih profesional dan menguntungkan.
            </p>
        </div>
    </div>

    <main class="bg-gray-50/50 py-12 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 lg:px-8 py-12">
            <div class="flex flex-col lg:flex-row gap-8">
                
                <!-- Sidebar: Filters -->
                <aside class="w-full lg:w-56 shrink-0">
                    <div class="sticky top-24 space-y-8">
                        
                        <!-- Search Section -->
                        <form action="{{ route('article.index') }}" method="GET" class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
                            <h3 class="text-[9px] font-black uppercase tracking-[0.2em] text-burgundy-900 mb-3">Cari</h3>
                            <div class="relative">
                                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari..." 
                                    class="w-full bg-gray-50 border border-gray-100 rounded-lg py-2.5 pl-9 pr-3 text-[11px] focus:outline-none focus:ring-2 focus:ring-burgundy-600/10 focus:border-burgundy-600 transition-all">
                                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                </div>
                            </div>
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                        </form>

                        <!-- Categories Section -->
                        <div class="space-y-3">
                            <h3 class="text-[9px] font-black uppercase tracking-[0.2em] text-burgundy-900 px-1">Topik</h3>
                            <nav class="flex flex-col gap-0.5">
                                <a href="{{ route('article.index', request()->only(['q', 'sort'])) }}" 
                                   class="flex items-center justify-between px-3 py-2 rounded-xl transition-all {{ !request('category') ? 'bg-burgundy-600 text-white shadow-md shadow-burgundy-600/10' : 'hover:bg-white text-gray-500 hover:text-burgundy-600 border border-transparent' }}">
                                    <span class="text-[9px] font-bold uppercase tracking-widest">Semua</span>
                                    <span class="text-[9px] font-black {{ !request('category') ? 'opacity-60' : 'text-gray-300' }}">{{ $totalArticles }}</span>
                                </a>
                                @foreach($categoriesWithCount as $category)
                                <a href="{{ route('article.index', array_merge(request()->only(['q', 'sort']), ['category' => $category['category_name']])) }}" 
                                   class="flex items-center justify-between px-3 py-2 rounded-xl transition-all {{ request('category') == $category['category_name'] ? 'bg-burgundy-600 text-white shadow-md shadow-burgundy-600/10' : 'hover:bg-white text-gray-500 hover:text-burgundy-600 border border-transparent hover:border-gray-100' }}">
                                    <span class="text-[9px] font-bold uppercase tracking-widest">{{ $category['category_name'] }}</span>
                                    <span class="text-[9px] font-black {{ request('category') == $category['category_name'] ? 'opacity-60' : 'text-gray-300 group-hover:text-gold-500' }}">
                                        {{ $category['total'] }}
                                    </span>
                                </a>
                                @endforeach
                            </nav>
                        </div>

                        <!-- Sidebar Ad -->
                        <div class="bg-logo-gradient p-8 rounded-[2.5rem] text-center shadow-xl relative overflow-hidden group hidden lg:block">
                            <h4 class="text-white font-bold text-lg mb-2 relative z-10 leading-tight">Digitalisasi Bisnis Anda</h4>
                            <p class="text-burgundy-100 text-[10px] mb-6 opacity-80 relative z-10 leading-relaxed font-medium">Buat halaman profil & link-in-bio profesional gratis.</p>
                            <a href="/register" class="bg-white text-burgundy-900 font-black py-3 px-6 rounded-xl text-[9px] uppercase tracking-widest relative z-10 inline-block hover:bg-gold-400 hover:text-burgundy-900 transition-colors">Mulai Sekarang</a>
                        </div>
                    </div>
                </aside>

                <!-- Content Area -->
                <div class="flex-grow">
                    <div class="flex items-center justify-between mb-8 px-2">
                        <div class="flex items-center gap-2 text-gray-400 text-[10px] font-black uppercase tracking-widest">
                            @if(request('q') || request('category'))
                                <a href="{{ route('article.index') }}" class="text-gold-600 hover:underline">Reset Filter</a>
                                <span class="text-gray-200">|</span>
                            @endif
                            <span class="text-burgundy-600">{{ $articles->total() }}</span> Hasil Ditemukan
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-[9px] font-black text-gray-300 uppercase tracking-widest">Urutan:</span>
                            <form action="{{ route('article.index') }}" method="GET" id="sortForm">
                                @if(request('q')) <input type="hidden" name="q" value="{{ request('q') }}"> @endif
                                @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                                <select name="sort" onchange="document.getElementById('sortForm').submit()" class="bg-transparent border-none text-[10px] font-black text-burgundy-900 uppercase tracking-widest focus:ring-0 cursor-pointer">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Populer</option>
                                </select>
                            </form>
                        </div>
                    </div>

                    @if($articles->isEmpty())
                        <div class="bg-white rounded-3xl p-20 text-center border border-dashed border-gray-200">
                            <div class="text-gray-300 mb-4 flex justify-center">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <h3 class="text-lg font-bold text-burgundy-900 mb-2">Tidak ada artikel ditemukan</h3>
                            <p class="text-gray-500 text-sm">Coba kata kunci lain atau pilih kategori yang berbeda.</p>
                        </div>
                    @else
                        <!-- Article Grid -->
                        <div class="grid grid-cols-2 xl:grid-cols-3 gap-4 md:gap-8">
                            @foreach($articles as $article)
                            <article class="group flex flex-col bg-white rounded-2xl md:rounded-3xl overflow-hidden border border-gray-100 transition-all duration-500 hover:shadow-2xl hover:shadow-burgundy-900/5 hover:-translate-y-1 h-full">
                                <a href="/artikel/{{ $article->slug }}" class="relative aspect-[16/10] overflow-hidden block shrink-0">
                                    <img src="{{ $article->image }}{{ str_contains($article->image, '?') ? '&' : '?' }}w=600&q=80" alt="{{ $article->title }}" 
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">                                    <div class="absolute top-2 left-2 md:top-4 md:left-4">
                                        <span class="px-1.5 py-0.5 md:px-3 md:py-1 bg-white/95 backdrop-blur-sm text-[7px] md:text-[9px] font-black uppercase tracking-widest text-burgundy-800 rounded-md md:rounded-lg shadow-sm border border-gray-100">
                                            {{ $article->category_name }}
                                        </span>
                                    </div>
                                </a>
                                
                                <div class="p-3 md:p-7 flex-grow flex flex-col">
                                    <div class="flex items-center text-gray-400 text-[7px] md:text-[9px] font-bold uppercase tracking-[0.15em] mb-2 md:mb-4">
                                        <span>{{ $article->published_at->format('d M y') }}</span>
                                        <span class="mx-1 md:mx-2 text-gold-400">•</span>
                                        <span>{{ ceil(str_word_count(strip_tags($article->content)) / 200) }} Min</span>
                                    </div>
                                    
                                    <h3 class="text-xs md:text-lg font-black text-burgundy-900 mb-1 md:mb-3 leading-snug group-hover:text-burgundy-600 transition-colors line-clamp-2">
                                        <a href="/artikel/{{ $article->slug }}">{{ $article->title }}</a>
                                    </h3>
                                    
                                    <p class="text-gray-500 text-[11px] leading-relaxed line-clamp-3 mb-6 opacity-80 hidden md:block">
                                        {{ $article->excerpt }}
                                    </p>

                                    <div class="mt-auto pt-2 md:pt-6 border-t border-gray-50">
                                        <a href="/artikel/{{ $article->slug }}" class="inline-flex items-center text-[8px] md:text-[10px] font-black text-burgundy-600 uppercase tracking-[0.2em] hover:text-burgundy-800 group/link transition-colors">
                                            Baca
                                            <svg class="w-2.5 h-2.5 md:w-3.5 md:h-3.5 ml-1 md:ml-2 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
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
                    @endif
                </div>

            </div>
        </div>
    </main>
</x-app-layout>
