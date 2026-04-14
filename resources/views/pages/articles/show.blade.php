<x-app-layout>
    <x-slot name="seo">
        <x-seo-head 
            :title="$article->seo_title"
            :description="$article->seo_description"
            :ogImage="$article->image ? asset('storage/' . $article->image) : asset('images/Logo_Bisnis_Growth.png')"
            :jsonLd="[
                '@context' => 'https://schema.org',
                '@type' => 'NewsArticle',
                'headline' => $article->title,
                'image' => [$article->image ? asset('storage/' . $article->image) : asset('images/Logo_Bisnis_Growth.png')],
                'datePublished' => ($article->published_at ?: $article->created_at)->toIso8601String(),
                'author' => ['@type' => 'Organization', 'name' => 'BisnisGrowth Team']
            ]"
        />
        <meta name="keywords" content="{{ $article->focus_keyword }}">
    </x-slot>

    <div class="bg-white py-12 md:py-20 px-6">
        <div class="max-w-[1400px] mx-auto">
            
            <!-- Breadcrumbs -->
            <nav class="flex text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-12 overflow-x-auto whitespace-nowrap pb-2 no-scrollbar">
                <a href="{{ route('home') }}" class="hover:text-amber-600 transition-colors">Home</a>
                <span class="mx-3 text-gray-200">/</span>
                <a href="{{ route('article.index') }}" class="hover:text-amber-600 transition-colors">Artikel</a>
                <span class="mx-3 text-gray-200">/</span>
                <span class="text-slate-900 truncate">{{ $article->title }}</span>
            </nav>

            <div class="flex flex-col lg:flex-row gap-16">
                <!-- MAIN CONTENT (LEFT) -->
                <main class="flex-1 min-w-0">
                    <article>
                        <!-- Header -->
                        <header class="mb-12">
                            @if($article->category_name)
                                <a href="{{ route('article.index', ['category' => $article->category_name]) }}" 
                                   class="inline-block bg-amber-500 text-white text-[10px] font-black uppercase tracking-[0.2em] px-5 py-2 rounded-full mb-8 shadow-lg shadow-amber-500/20 transition-transform hover:-translate-y-1">
                                    {{ $article->category_name }}
                                </a>
                            @endif
                            
                            <h1 class="text-4xl md:text-6xl font-black text-slate-900 leading-[1.1] mb-10 tracking-tight">
                                {{ $article->title }}
                            </h1>

                            <div class="flex flex-wrap items-center gap-x-8 gap-y-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-t border-gray-100 pt-8">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 bg-slate-900 rounded-2xl flex items-center justify-center text-white text-xs font-black shadow-xl">BG</div>
                                    <div class="flex flex-col gap-0.5">
                                        <span class="text-slate-900">Redaksi BisnisGrowth</span>
                                        <span class="text-[8px] opacity-60">Verified Editorial</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="h-4 w-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span>{{ ($article->published_at ?: $article->created_at)->translatedFormat('d F Y') }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="h-4 w-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span>{{ $readingTime }} Menit Baca</span>
                                </div>
                            </div>
                        </header>

                        <!-- IMAGES SECTION (TOP) -->
                        <div class="space-y-6 mb-16">
                            <!-- Main Hero Image -->
                            @if($article->image)
                                <div class="aspect-[21/9] rounded-[3rem] overflow-hidden bg-gray-100 shadow-2xl shadow-slate-200/50 border-[12px] border-white ring-1 ring-gray-100">
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->image_alt ?: $article->title }}" class="w-full h-full object-cover">
                                </div>
                            @endif

                            <!-- Triple Gallery Grid (Below Main Image) -->
                            @if($article->image_2 || $article->image_3 || $article->image_4)
                                <div class="grid grid-cols-3 gap-4 md:gap-6">
                                    @foreach(['image_2', 'image_3', 'image_4'] as $img)
                                        @if($article->$img)
                                            <div class="relative group aspect-video rounded-2xl md:rounded-[2rem] overflow-hidden shadow-xl border-4 md:border-8 border-white transition-transform hover:scale-[1.05] duration-500">
                                                <img src="{{ asset('storage/' . $article->$img) }}" class="w-full h-full object-cover">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                            </div>
                                        @else
                                            <!-- Placeholder if some images are missing -->
                                            <div class="aspect-video rounded-2xl md:rounded-[2rem] bg-gray-50 border-4 border-dashed border-gray-100 flex items-center justify-center">
                                                <span class="text-[10px] font-black text-gray-200 uppercase tracking-widest">Gallery</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- ARTICLE BODY -->
                        <div class="prose prose-slate prose-lg max-w-none 
                                    prose-headings:font-black prose-headings:text-slate-900 prose-headings:tracking-tight
                                    prose-p:text-gray-600 prose-p:leading-[1.8] prose-p:text-xl
                                    prose-strong:text-slate-900 prose-strong:font-black
                                    prose-a:text-amber-600 prose-a:no-underline hover:prose-a:underline
                                    prose-img:rounded-[2.5rem] prose-img:shadow-2xl prose-img:my-16
                                    selection:bg-amber-100 selection:text-amber-900">
                            
                            <div class="first-letter:text-7xl first-letter:font-black first-letter:text-slate-900 first-letter:mr-3 first-letter:float-left first-line:uppercase first-line:tracking-widest">
                                {!! nl2br($article->content) !!}
                            </div>
                        </div>

                        <!-- Article Footer -->
                        <div class="mt-20 pt-12 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-8">
                            <div class="flex items-center gap-5">
                                <div class="h-14 w-14 bg-amber-500 rounded-2xl flex items-center justify-center text-slate-900 shadow-xl shadow-amber-500/20">
                                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Topik Utama</p>
                                    <p class="text-lg font-black text-slate-900">{{ $article->category_name ?: 'Wawasan Bisnis' }}</p>
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-4">
                                @php
                                    $waNumber = $siteSettings['official_whatsapp'] ?? '089515915699';
                                    // Pastikan format nomor diawali 62 untuk WhatsApp link
                                    $waFormatted = preg_replace('/^0/', '62', preg_replace('/[^\d]/', '', $waNumber));
                                @endphp
                                <button onclick="trackAndRedirect('whatsapp', 'https://wa.me/{{ $waFormatted }}?text={{ urlencode($article->title . ' - ' . url()->current()) }}')"
                                   class="px-8 py-4 bg-green-500 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-green-600 hover:shadow-xl hover:shadow-green-500/20 transition-all flex items-center gap-3">
                                    <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.328-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.13.57-.072 1.758-.713 2.006-1.403.248-.69.248-1.288.173-1.403-.074-.115-.272-.19-.57-.339zM12 22c-1.83 0-3.622-.47-5.202-1.363L2 22l1.393-5.113C2.493 15.298 2 13.67 2 12 2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
                                    WhatsApp
                                </button>
                                <button onclick="trackAndRedirect('phone', 'tel:{{ $waNumber }}')"
                                   class="px-8 py-4 bg-slate-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-800 hover:shadow-xl transition-all flex items-center gap-3">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    Telepon
                                </button>
                                <a href="{{ route('article.index') }}" class="px-8 py-4 bg-gray-100 text-gray-400 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-200 transition-all">
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </article>
                </main>

                <!-- SIDEBAR (RIGHT) -->
                <aside class="w-full lg:w-96">
                    <div class="sticky top-24 space-y-12">
                        <!-- Popular Articles -->
                        <div class="bg-gray-50 p-8 rounded-[3rem] border border-gray-100">
                            <h3 class="text-[10px] font-black text-slate-900 uppercase tracking-[0.3em] mb-10 flex items-center gap-3">
                                <span class="h-1.5 w-1.5 bg-amber-500 rounded-full animate-pulse"></span> Artikel Populer
                            </h3>
                            <div class="space-y-8">
                                @foreach($popularArticles as $pop)
                                    <a href="{{ route('article.show', $pop->slug) }}" class="group flex gap-5">
                                        <div class="h-20 w-20 bg-white rounded-2xl overflow-hidden shrink-0 shadow-sm border border-gray-100">
                                            @if($pop->image)
                                                <img src="{{ asset('storage/' . $pop->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-all duration-700">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-[10px] font-black text-slate-200">BG</div>
                                            @endif
                                        </div>
                                        <div class="min-w-0 py-1">
                                            <h4 class="text-sm font-black text-slate-900 leading-snug group-hover:text-amber-600 transition-colors line-clamp-2 mb-2">{{ $pop->title }}</h4>
                                            <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">{{ number_format($pop->view_count) }} Views</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Recommended -->
                        <div class="bg-slate-900 p-10 rounded-[3rem] shadow-2xl text-white relative overflow-hidden group">
                            <div class="absolute -top-10 -right-10 h-40 w-40 bg-amber-500/10 rounded-full blur-3xl group-hover:bg-amber-500/20 transition-all duration-700"></div>
                            <h3 class="text-[10px] font-black text-amber-400 uppercase tracking-[0.3em] mb-10 flex items-center gap-3">
                                <span class="h-1.5 w-1.5 bg-white rounded-full"></span> Terkait
                            </h3>
                            <div class="space-y-8">
                                @foreach($relatedArticles->take(4) as $rel)
                                    <a href="{{ route('article.show', $rel->slug) }}" class="group block relative z-10">
                                        <p class="text-[8px] font-black text-amber-500/60 uppercase tracking-[0.2em] mb-2">{{ $rel->category_name }}</p>
                                        <h4 class="text-sm font-bold text-white leading-relaxed group-hover:text-amber-400 transition-colors line-clamp-2">{{ $rel->title }}</h4>
                                        <div class="h-[1px] w-full bg-white/5 mt-6 group-hover:bg-amber-500/20 transition-all"></div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>

    <!-- Script Tracking Klik -->
    <script>
        function trackAndRedirect(type, url) {
            fetch('{{ route('article.track-click', $article->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ type: type })
            }).finally(() => {
                window.open(url, '_blank');
            });
        }
    </script>
</x-app-layout>
