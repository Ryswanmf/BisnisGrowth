@extends('layouts.admin')

@section('title', 'Kelola Halaman')
@section('header', 'Halaman Statis')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-xl font-black text-slate-900 tracking-tight">Daftar Halaman</h2>
            <p class="text-gray-500 text-sm font-medium">Kelola Kebijakan Privasi, Ketentuan Layanan, dan halaman lainnya.</p>
        </div>
        <a href="{{ route('admin.pages.create') }}" class="bg-amber-500 text-slate-900 px-6 py-3 rounded-lg text-sm font-black flex items-center gap-2 hover:bg-amber-400 transition-all shadow-lg shadow-amber-500/20">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
            </svg>
            Buat Halaman Baru
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm font-bold">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-100">
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Judul Halaman</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Slug</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Status</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($pages as $page)
                <tr class="hover:bg-gray-50/50 transition-colors group">
                    <td class="px-6 py-4">
                        <p class="text-sm font-bold text-slate-900 group-hover:text-amber-600 transition-colors">{{ $page->title }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <code class="text-[11px] bg-slate-100 px-2 py-1 rounded text-slate-500 font-bold">/{{ $page->slug }}</code>
                    </td>
                    <td class="px-6 py-4">
                        @if($page->is_published)
                            <span class="text-green-600 text-[10px] font-black uppercase tracking-widest bg-green-50 px-3 py-1 rounded-md">Published</span>
                        @else
                            <span class="text-gray-400 text-[10px] font-black uppercase tracking-widest bg-gray-50 px-3 py-1 rounded-md">Draft</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.pages.edit', $page) }}" class="p-2 bg-white border border-gray-100 rounded-md text-gray-400 hover:text-amber-500 transition-all">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" onsubmit="return confirm('Hapus halaman ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 bg-white border border-gray-100 rounded-md text-gray-400 hover:text-red-500 transition-all">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-20 text-center text-gray-400 font-bold italic">Belum ada halaman khusus.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
