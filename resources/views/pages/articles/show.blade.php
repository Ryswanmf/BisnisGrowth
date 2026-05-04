<x-app-layout>
    <x-slot name="seo">
        @php
            $currentHost = request()->getHost();
            $activeDomain = \App\Models\Domain::where('url', 'LIKE', "%{$currentHost}%")->where('is_active', true)->first();
            $canonicalUrl = $activeDomain 
                ? rtrim($activeDomain->url, '/') . '/artikel/' . $article->slug 
                : route('article.show', $article->slug);
        @endphp
        <x-seo-head 
            :title="$article->seo_title"
            :description="$article->seo_description"
            :canonical="$canonicalUrl"
            :ogImage="route('og.image', ['type' => 'article', 'id' => $article->id])"
            :jsonLd="[
                '@context' => 'https://schema.org',
                '@type' => 'NewsArticle',
                'headline' => $article->title,
                'description' => $article->seo_description,
                'image' => [$article->image ? asset($article->image) : asset('images/Logo_Bisnis_Growth.png')],
                'datePublished' => ($article->published_at ?: $article->created_at)->toIso8601String(),
                'dateModified' => $article->updated_at->toIso8601String(),
                'author' => [
                    '@type' => 'Person',
                    'name' => $article->user ? $article->user->name : 'Redaksi BisnisGrowth',
                    'url' => url('/')
                ],
                'publisher' => [
                    '@type' => 'Organization',
                    'name' => 'BisnisGrowth',
                    'logo' => [
                        '@type' => 'ImageObject',
                        'url' => asset('images/Logo_Bisnis_Growth.png')
                    ]
                ]
            ]"
        />
        <meta name="keywords" content="{{ $article->shortKeywords->flatMap(fn($p) => preg_split('/[,\n\r]+/', $p->description))->filter()->take(20)->implode(', ') }}">
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
                                    <div class="h-10 w-10 bg-slate-900 rounded overflow-hidden flex items-center justify-center text-white text-xs font-black shadow-xl">
                                        @if($article->user && $article->user->profile_photo)
                                            <img src="{{ asset('storage/' . $article->user->profile_photo) }}" class="h-full w-full object-cover">
                                        @else
                                            {{ $article->user ? substr($article->user->name, 0, 1) : 'B' }}
                                        @endif
                                    </div>
                                    <div class="flex flex-col gap-0.5">
                                        <span class="text-slate-900">{{ $article->user ? $article->user->name : 'Redaksi BisnisGrowth' }}</span>
                                        <span class="text-[8px] opacity-60">Verified {{ $article->user && $article->user->role === 'admin' ? 'Administrator' : 'Contributor' }}</span>
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
                        <div class="space-y-4 mb-16">
                            <!-- Main Hero Image -->
                            @if($article->image)
                                <div class="aspect-[21/9] rounded md:rounded overflow-hidden bg-gray-100 shadow-xl shadow-slate-200/50 border-[6px] md:border-[10px] border-white ring-1 ring-gray-100">
                                    <img src="{{ asset($article->image) }}" alt="{{ $article->image_alt ?: $article->title }}" class="w-full h-full object-cover">
                                </div>
                            @endif

                            <!-- Triple Gallery Grid (Below Main Image) -->
                            @if($article->image_2 || $article->image_3 || $article->image_4)
                                <div class="grid grid-cols-3 gap-3 md:gap-5">
                                    @foreach(['image_2', 'image_3', 'image_4'] as $img)
                                        @if($article->$img)
                                            <div class="relative group aspect-video rounded md:rounded overflow-hidden shadow-lg border-2 md:border-4 border-white transition-transform hover:scale-[1.03] duration-500">
                                                <img src="{{ asset('storage/' . $article->$img) }}" class="w-full h-full object-cover">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                            </div>
                                        @else
                                            <!-- Placeholder to keep grid level -->
                                            <div class="aspect-video rounded md:rounded bg-gray-50 border-2 border-dashed border-gray-100 flex items-center justify-center">
                                                <span class="text-[8px] font-black text-gray-200 uppercase tracking-widest">Gallery</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- ARTICLE BODY -->
                        <div class="prose prose-slate prose-lg max-w-none 
                                    prose-headings:font-black prose-headings:text-slate-900 prose-headings:tracking-tight prose-headings:mb-6 prose-headings:mt-12
                                    prose-p:text-slate-600 prose-p:leading-[1.9] prose-p:text-lg md:prose-p:text-xl prose-p:mb-8
                                    prose-strong:text-slate-900 prose-strong:font-black
                                    prose-a:text-amber-600 prose-a:font-bold prose-a:no-underline hover:prose-a:underline
                                    prose-img:rounded prose-img:shadow-2xl prose-img:my-16
                                    prose-blockquote:border-l-4 prose-blockquote:border-amber-500 prose-blockquote:bg-slate-50 prose-blockquote:py-2 prose-blockquote:px-8 prose-blockquote:rounded-r-xl prose-blockquote:italic prose-blockquote:text-slate-700
                                    prose-ul:list-disc prose-ul:pl-6 prose-ol:list-decimal prose-ol:pl-6
                                    prose-li:text-slate-600 prose-li:mb-2
                                    selection:bg-amber-100 selection:text-amber-900">
                            
                            @if($article->excerpt)
                                <p class="text-2xl md:text-3xl font-medium text-slate-500 leading-relaxed mb-12 italic border-l-4 border-gray-100 pl-8">
                                    {{ $article->excerpt }}
                                </p>
                            @endif

                            <div class="article-content-wrapper">
                                {!! $article->content !!}
                            </div>
                        </div>

                        <!-- Author Bio Box -->
                        <div class="mt-20 p-8 md:p-12 bg-slate-900 rounded-2xl text-white relative overflow-hidden group">
                            <div class="absolute -right-10 -bottom-10 h-40 w-40 bg-amber-500/10 rounded-full blur-3xl group-hover:bg-amber-500/20 transition-all duration-700"></div>
                            <div class="relative z-10 flex flex-col md:flex-row items-center gap-8 md:gap-12 text-center md:text-left">
                                <div class="h-24 w-24 md:h-32 md:w-32 bg-amber-500 rounded-2xl overflow-hidden shrink-0 shadow-2xl shadow-amber-500/20 rotate-3 group-hover:rotate-0 transition-transform duration-500">
                                    @if($article->user && $article->user->profile_photo)
                                        <img src="{{ asset('storage/' . $article->user->profile_photo) }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="h-full w-full flex items-center justify-center text-3xl font-black text-slate-900">
                                            {{ $article->user ? substr($article->user->name, 0, 1) : 'B' }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <span class="inline-block px-3 py-1 bg-amber-500 text-slate-900 text-[10px] font-black uppercase tracking-widest rounded mb-4">Penulis Terverifikasi</span>
                                    <h3 class="text-2xl font-black mb-3">{{ $article->user ? $article->user->name : 'Redaksi BisnisGrowth' }}</h3>
                                    <p class="text-slate-400 text-sm md:text-base leading-relaxed mb-6 font-medium">
                                        {{ $article->user && $article->user->role === 'admin' ? 'Administrator utama dan pakar strategi bisnis di BisnisGrowth. Fokus dalam membantu UMKM Indonesia naik kelas melalui literasi digital dan keuangan.' : 'Kontributor ahli di BisnisGrowth yang berdedikasi memberikan wawasan praktis bagi para pelaku usaha lokal.' }}
                                    </p>
                                    <div class="flex flex-wrap justify-center md:justify-start gap-4">
                                        <a href="#" class="text-[10px] font-black uppercase tracking-widest text-amber-500 hover:text-white transition-colors">Lihat Semua Artikel</a>
                                        <span class="text-slate-800">•</span>
                                        <a href="#" class="text-[10px] font-black uppercase tracking-widest text-amber-500 hover:text-white transition-colors">Ikuti Penulis</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <style>
                            /* Custom Drop Cap for the first letter of the content */
                            .article-content-wrapper > p:first-of-type::first-letter {
                                float: left;
                                font-size: 4.5rem;
                                line-height: 1;
                                font-weight: 900;
                                padding-right: 0.75rem;
                                color: #0f172a;
                                font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
                            }
                        </style>

                        <!-- Comments Section -->
                        <div class="mt-24 border-t border-gray-100 pt-20">
                            <div class="flex items-center justify-between mb-12">
                                <h3 class="text-2xl font-black text-slate-900 tracking-tight">Komentar ({{ $article->comments->count() }})</h3>
                                <div class="h-1 flex-1 bg-gray-50 mx-8 rounded-full"></div>
                            </div>

                            @if(session('success_comment'))
                                <div class="bg-emerald-50 border border-emerald-100 text-emerald-600 p-6 rounded mb-12 text-sm font-bold animate-bounce">
                                    {{ session('success_comment') }}
                                </div>
                            @endif

                            <div class="space-y-10 mb-16">
                                @forelse($article->comments as $comment)
                                    <div class="flex gap-6">
                                        <div class="h-12 w-14 md:h-16 md:w-16 bg-slate-100 rounded flex items-center justify-center text-slate-400 shrink-0">
                                            <svg class="h-6 w-6 md:h-8 md:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center gap-3 mb-2">
                                                <h4 class="font-black text-slate-900 text-sm md:text-base">{{ $comment->name }}</h4>
                                                <span class="text-[10px] font-bold text-gray-300 uppercase tracking-widest">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-gray-600 text-sm md:text-base leading-relaxed bg-gray-50 p-4 md:p-6 rounded border border-gray-100">
                                                {{ $comment->content }}
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-12 bg-gray-50 rounded border border-dashed border-gray-200">
                                        <p class="text-gray-400 font-bold text-sm">Belum ada komentar. Jadilah yang pertama!</p>
                                    </div>
                                @endforelse
                            </div>

                            <!-- Comment Form -->
                            <div class="bg-white p-8 md:p-16 rounded shadow-2xl shadow-slate-200/50 border border-gray-100 relative overflow-hidden group">
                                <!-- Background Decorations -->
                                <div class="absolute -right-20 -top-20 h-64 w-64 bg-amber-50 rounded-full opacity-50 blur-3xl group-hover:bg-amber-100 transition-colors duration-700"></div>
                                <div class="absolute -left-20 -bottom-20 h-64 w-64 bg-slate-50 rounded-full opacity-50 blur-3xl"></div>
                                
                                <div class="relative z-10">
                                    <div class="text-center mb-12">
                                        <h4 class="text-2xl md:text-3xl font-black text-slate-900 mb-3 tracking-tight">Bagikan Pemikiran Anda</h4>
                                        <p class="text-slate-400 text-xs font-black uppercase tracking-[0.2em]">Diskusi terbuka untuk wawasan bisnis yang lebih baik</p>
                                    </div>
                                    
                                    <form action="{{ route('article.comment.store', $article->id) }}" method="POST" class="space-y-8">
                                        @csrf
                                        <div style="display:none;">
                                            <input type="text" name="my_full_name" value="">
                                        </div>
                                        <div class="grid grid-cols-1 gap-8">
                                            <div class="relative group/input">
                                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1 group-focus-within/input:text-amber-500 transition-colors">Nama Lengkap</label>
                                                <div class="relative">
                                                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-300 group-focus-within/input:text-amber-500 transition-colors">
                                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                                    </div>
                                                    <input type="text" name="name" required placeholder="Siapa nama Anda?" 
                                                           class="w-full bg-gray-50 border-2 border-transparent rounded pl-14 pr-6 py-5 text-slate-900 text-sm font-bold focus:bg-white focus:border-amber-400 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all shadow-sm">
                                                </div>
                                            </div>

                                            <div class="relative group/input">
                                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1 group-focus-within/input:text-amber-500 transition-colors">Pesan Anda</label>
                                                <div class="relative">
                                                    <div class="absolute top-5 left-5 pointer-events-none text-gray-300 group-focus-within/input:text-amber-500 transition-colors">
                                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                                                    </div>
                                                    <textarea name="content" rows="6" required placeholder="Tuliskan komentar atau pertanyaan Anda di sini..." 
                                                              class="w-full bg-gray-50 border-2 border-transparent rounded pl-14 pr-6 py-5 text-slate-900 text-sm font-bold focus:bg-white focus:border-amber-400 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all shadow-sm resize-none"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex flex-col md:flex-row items-center justify-between gap-6 pt-4">
                                            <p class="text-[10px] text-gray-400 font-bold italic text-center md:text-left">
                                                * Komentar Anda akan dimoderasi sebelum tampil ke publik.
                                            </p>
                                            <button type="submit" class="w-full md:w-auto bg-slate-900 text-white px-12 py-5 rounded text-xs font-black uppercase tracking-widest hover:bg-amber-500 hover:text-slate-900 hover:shadow-2xl hover:shadow-amber-500/30 transition-all duration-300 transform active:scale-95 flex items-center justify-center gap-3 group/btn">
                                                <span>Kirim Komentar</span>
                                                <svg class="h-4 w-4 group-hover/btn:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Article Footer -->
                        <div class="mt-20 pt-12 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-8">
                            <div class="flex items-center gap-5">
                                <div class="h-14 w-14 bg-amber-500 rounded flex items-center justify-center text-slate-900 shadow-xl shadow-amber-500/20">
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
                                   class="px-8 py-4 bg-green-500 text-white rounded text-[10px] font-black uppercase tracking-widest hover:bg-green-600 hover:shadow-xl hover:shadow-green-500/20 transition-all flex items-center gap-3">
                                    <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.328-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.13.57-.072 1.758-.713 2.006-1.403.248-.69.248-1.288.173-1.403-.074-.115-.272-.19-.57-.339zM12 22c-1.83 0-3.622-.47-5.202-1.363L2 22l1.393-5.113C2.493 15.298 2 13.67 2 12 2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
                                    WhatsApp
                                </button>
                                <button onclick="trackAndRedirect('phone', 'tel:{{ $waNumber }}')"
                                   class="px-8 py-4 bg-slate-900 text-white rounded text-[10px] font-black uppercase tracking-widest hover:bg-slate-800 hover:shadow-xl transition-all flex items-center gap-3">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    Telepon
                                </button>
                                <a href="{{ route('article.index') }}" class="px-8 py-4 bg-gray-100 text-gray-400 rounded text-[10px] font-black uppercase tracking-widest hover:bg-gray-200 transition-all">
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
                        <div class="bg-gray-50 p-8 rounded border border-gray-100">
                            <h3 class="text-[10px] font-black text-slate-900 uppercase tracking-[0.3em] mb-10 flex items-center gap-3">
                                <span class="h-1.5 w-1.5 bg-amber-500 rounded-full animate-pulse"></span> Artikel Populer
                            </h3>
                            <div class="space-y-8">
                                @foreach($popularArticles as $pop)
                                    <a href="{{ route('article.show', $pop->slug) }}" class="group flex gap-5">
                                        <div class="h-20 w-20 bg-white rounded overflow-hidden shrink-0 shadow-sm border border-gray-100">
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
                        <div class="bg-slate-900 p-10 rounded shadow-2xl text-white relative overflow-hidden group">
                            <div class="absolute -top-10 -right-10 h-40 w-40 bg-amber-500/10 rounded-full blur-3xl group-hover:bg-amber-100/10 transition-all duration-700"></div>
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
