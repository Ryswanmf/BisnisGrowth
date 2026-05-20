@extends('layouts.admin')

@section('title', 'Kelola Artikel')
@section('header', 'Manajemen Artikel')

@section('content')
<div class="space-y-6">
    <!-- Action Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-xl font-black text-slate-900 tracking-tight">Daftar Artikel</h2>
            <p class="text-gray-500 text-sm font-medium">Pantau performa konten edukasi bisnis Anda.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.articles.bulk') }}" class="bg-slate-900 text-white px-6 py-3 rounded-lg text-sm font-black flex items-center gap-2 hover:bg-slate-800 transition-all shadow-lg shadow-slate-900/10">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                Bulk Generator
            </a>
            <a href="{{ route('admin.articles.create') }}" class="bg-amber-500 text-slate-900 px-6 py-3 rounded-lg text-sm font-black flex items-center gap-2 hover:bg-amber-400 transition-all shadow-lg shadow-amber-500/20">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                Tulis Artikel Baru
            </a>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Artikel</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Kategori</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Interaksi Pengunjung</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Status</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($articles as $article)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                @if($article->image)
                                    <img src="{{ asset($article->image) }}" class="h-12 w-16 object-cover rounded-lg border border-gray-100">
                                @else
                                    <div class="h-12 w-16 bg-gray-50 rounded-lg flex items-center justify-center text-gray-200 font-black text-xs">BG</div>
                                @endif
                                <div class="min-w-0">
                                    <p class="text-sm font-bold text-slate-900 truncate group-hover:text-amber-600 transition-colors">{{ $article->title }}</p>
                                    <p class="text-[10px] text-gray-400 font-medium truncate italic">/artikel/{{ $article->slug }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-slate-100 text-slate-600 text-[9px] font-black uppercase tracking-widest rounded-md">
                                {{ $article->category_name ?: 'Wawasan' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <!-- Article Clicks (Blue) -->
                                <div class="flex flex-col items-center min-w-[45px] px-2 py-1 bg-blue-50 rounded-lg border border-blue-100">
                                    <span class="text-[8px] font-black text-blue-400 uppercase tracking-tighter">Klik</span>
                                    <span class="text-[11px] font-black text-blue-600">{{ number_format($article->click_count) }}</span>
                                </div>
                                <!-- WhatsApp Clicks (Green) -->
                                <div class="flex flex-col items-center min-w-[45px] px-2 py-1 bg-emerald-50 rounded-lg border border-emerald-100">
                                    <span class="text-[8px] font-black text-emerald-400 uppercase tracking-tighter">WA</span>
                                    <span class="text-[11px] font-black text-emerald-600">{{ number_format($article->whatsapp_clicks) }}</span>
                                </div>
                                <!-- Phone Clicks (Gray) -->
                                <div class="flex flex-col items-center min-w-[45px] px-2 py-1 bg-slate-100 rounded-lg border border-slate-200">
                                    <span class="text-[8px] font-black text-slate-400 uppercase tracking-tighter">Telp</span>
                                    <span class="text-[11px] font-black text-slate-600">{{ number_format($article->phone_clicks) }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($article->status === 'publish')
                                @if($article->published_at && $article->published_at->isFuture())
                                    <span class="text-amber-600 text-[10px] font-black uppercase tracking-widest bg-amber-50 px-3 py-1 rounded-md border border-amber-100">Scheduled</span>
                                    <p class="text-[8px] text-amber-500 font-bold mt-1">{{ $article->published_at->format('d M, H:i') }}</p>
                                @else
                                    <span class="text-emerald-600 text-[10px] font-black uppercase tracking-widest bg-emerald-50 px-3 py-1 rounded-md border border-emerald-100">Published</span>
                                @endif
                            @elseif($article->status === 'private')
                                <span class="text-indigo-600 text-[10px] font-black uppercase tracking-widest bg-indigo-50 px-3 py-1 rounded-md border border-indigo-100">Private</span>
                            @else
                                <span class="text-gray-400 text-[10px] font-black uppercase tracking-widest bg-gray-50 px-3 py-1 rounded-md border border-gray-100">Draft</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.articles.edit', $article) }}" class="p-2 bg-white border border-gray-100 rounded-md text-gray-400 hover:text-amber-500 transition-all">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form id="delete-form-{{ $article->id }}" action="{{ route('admin.articles.destroy', $article) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDelete('delete-form-{{ $article->id }}')" class="p-2 bg-white border border-gray-100 rounded-md text-gray-400 hover:text-red-500 transition-all">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center text-gray-400 font-bold italic">Belum ada artikel ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100">
            {{ $articles->links() }}
        </div>
    </div>
</div>
@endsection
