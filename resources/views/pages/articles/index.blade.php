@extends('layouts.admin')

@section('title', 'Kelola Artikel')
@section('header', 'Manajemen Artikel')

@section('content')
<div class="space-y-6">
    <!-- Action Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-xl font-black text-slate-900 tracking-tight">Daftar Artikel</h2>
            <p class="text-gray-500 text-sm font-medium">Kelola semua konten edukasi dan berita bisnis Anda.</p>
        </div>
        <button class="bg-amber-500 text-slate-900 px-6 py-3 rounded-2xl text-sm font-black flex items-center gap-2 hover:bg-amber-400 transition-all shadow-lg shadow-amber-500/20">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
            </svg>
            Tulis Artikel Baru
        </button>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Artikel</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Kategori</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Status</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Tanggal</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($articles as $article)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                @if($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" class="h-12 w-16 object-cover rounded-xl border border-gray-100 shadow-sm" alt="">
                                @else
                                    <div class="h-12 w-16 bg-gray-100 rounded-xl flex items-center justify-center text-gray-300">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <p class="text-sm font-bold text-slate-900 truncate group-hover:text-amber-600 transition-colors">{{ $article->title }}</p>
                                    <p class="text-[11px] text-gray-400 font-medium truncate italic">/artikel/{{ $article->slug }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-slate-100 text-slate-600 text-[10px] font-black rounded-full uppercase tracking-widest">
                                {{ $article->category->name ?? 'Uncategorized' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="flex items-center gap-1.5 text-green-600 text-[11px] font-bold uppercase tracking-widest">
                                <span class="h-1.5 w-1.5 rounded-full bg-green-500 animate-pulse"></span>
                                Published
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-xs font-bold text-gray-500 tracking-tight">{{ $article->created_at->format('d M Y') }}</p>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('article.show', $article->slug) }}" class="p-2 bg-white border border-gray-100 rounded-lg text-gray-400 hover:text-blue-500 hover:shadow-sm transition-all">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                <button class="p-2 bg-white border border-gray-100 rounded-lg text-gray-400 hover:text-amber-500 hover:shadow-sm transition-all">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="h-16 w-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                    <svg class="h-8 w-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <h4 class="text-slate-900 font-bold">Belum Ada Artikel</h4>
                                <p class="text-gray-400 text-sm mt-1 font-medium">Mulai buat konten pertama Anda untuk menarik pengunjung.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($articles->hasPages())
        <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100">
            {{ $articles->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
