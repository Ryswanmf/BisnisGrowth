<x-app-layout>
    <x-slot name="title">{{ $page->meta_title ?: $page->title }} — BisnisGrowth</x-slot>
    <x-slot name="seo">
        <meta name="description" content="{{ $page->meta_description }}">
    </x-slot>

    <div class="bg-gray-50 min-h-screen py-24 px-6">
        <article class="max-w-4xl mx-auto bg-white p-12 md:p-20 rounded-[4rem] shadow-2xl shadow-slate-200 border border-gray-100">
            <header class="text-center mb-16">
                <span class="text-amber-600 text-[10px] font-black uppercase tracking-[0.3em] mb-4 block">Informasi Resmi</span>
                <h1 class="text-4xl md:text-6xl font-black text-slate-900 tracking-tight leading-tight">
                    {{ $page->title }}
                </h1>
                <div class="h-1.5 w-20 bg-amber-500 rounded-full mx-auto mt-8"></div>
            </header>

            <div class="prose prose-slate prose-lg max-w-none 
                        prose-headings:font-black prose-headings:text-slate-900 
                        prose-p:text-gray-600 prose-p:leading-relaxed prose-p:text-lg
                        prose-strong:text-slate-900 prose-strong:font-black
                        prose-a:text-amber-600 prose-a:no-underline hover:prose-a:underline
                        prose-img:rounded-[2rem]">
                {!! $page->content !!}
            </div>
            
            <div class="mt-20 pt-10 border-t border-gray-100 text-center">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-10">Terakhir diperbarui pada {{ $page->updated_at->translatedFormat('d F Y') }}</p>
                <div class="flex flex-col md:flex-row justify-center gap-4">
                    <a href="{{ route('home') }}" class="px-10 py-4 bg-slate-900 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl hover:bg-slate-800 transition-all">
                        Beranda
                    </a>
                    <a href="{{ route('contact') }}" class="px-10 py-4 bg-amber-500 text-slate-900 text-[10px] font-black uppercase tracking-widest rounded-2xl hover:bg-amber-400 transition-all">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </article>
    </div>
</x-app-layout>
