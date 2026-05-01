@extends('layouts.admin')

@section('title', 'Tambah Pool Keyword')
@section('header', 'Keyword Pool Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.short-keywords.index') }}" class="text-xs font-black text-amber-600 uppercase tracking-widest flex items-center gap-2 hover:text-amber-700 transition-colors">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Daftar
        </a>
    </div>

    <form action="{{ route('admin.short-keywords.store') }}" method="POST" class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 space-y-6">
        @csrf
        <div>
            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Judul (Title)</label>
            <input type="text" name="title" value="{{ old('title') }}" placeholder="Contoh: Laundry" class="w-full bg-gray-50 border-gray-100 rounded-lg px-4 py-3 focus:ring-amber-500 focus:border-amber-500 @error('title') border-red-500 @enderror" required>
            @error('title') <p class="mt-1 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Daftar Keyword (Deskripsi)</label>
            <textarea name="description" rows="10" placeholder="Pisahkan dengan koma atau baris baru..." class="w-full bg-gray-50 border-gray-100 rounded-lg px-4 py-3 focus:ring-amber-500 focus:border-amber-500 @error('description') border-red-500 @enderror" required>{{ old('description') }}</textarea>
            <p class="mt-2 text-[10px] text-gray-400 font-medium italic">* Anda bisa memasukkan puluhan keyword di sini.</p>
            @error('description') <p class="mt-1 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <span class="text-xs font-bold text-slate-900 uppercase tracking-widest">Aktifkan Pool Ini</span>
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
            </label>
        </div>

        <button type="submit" class="w-full bg-amber-500 text-slate-900 py-4 rounded-lg font-black text-sm uppercase tracking-widest hover:bg-amber-400 transition-all shadow-lg shadow-amber-500/20">
            Simpan Pool Keyword
        </button>
    </form>
</div>
@endsection
