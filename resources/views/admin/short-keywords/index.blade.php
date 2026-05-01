@extends('layouts.admin')

@section('title', 'Kelola Short Keyword')
@section('header', 'Short Keyword (Pool)')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div>
            <h2 class="text-xl font-black text-slate-900 tracking-tight">Daftar Short Keyword</h2>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1">Kelola kumpulan keyword untuk SEO artikel</p>
        </div>
        <a href="{{ route('admin.short-keywords.create') }}" class="bg-amber-500 text-slate-900 px-6 py-3 rounded-lg font-black text-xs uppercase tracking-widest hover:bg-amber-400 transition-all shadow-lg shadow-amber-500/20 flex items-center gap-2">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
            Tambah Pool Baru
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-900 text-white">
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest">Judul (Title)</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest">Jumlah Keyword</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-center">Status</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($keywords as $kw)
                <tr class="hover:bg-gray-50/50 transition-colors group">
                    <td class="px-6 py-4">
                        <p class="font-black text-slate-900">{{ $kw->title }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-xs font-bold text-slate-500 bg-slate-100 px-2 py-1 rounded-md">
                            {{ count(preg_split('/[,\n\r]+/', $kw->description)) }} Keywords
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $kw->is_active ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600' }}">
                            {{ $kw->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.short-keywords.edit', $kw->id) }}" class="p-2 bg-amber-50 text-amber-600 rounded-md hover:bg-amber-500 hover:text-white transition-all">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <button onclick="confirmDelete('delete-form-{{ $kw->id }}')" class="p-2 bg-red-50 text-red-600 rounded-md hover:bg-red-500 hover:text-white transition-all">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                            <form id="delete-form-{{ $kw->id }}" action="{{ route('admin.short-keywords.destroy', $kw->id) }}" method="POST" class="hidden">
                                @csrf @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-20 text-center text-gray-400 font-bold italic">Belum ada short keyword pool.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
