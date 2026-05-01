@extends('layouts.admin')

@section('title', 'Edit Domain')
@section('header', 'Edit Domain')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.domains.index') }}" class="text-xs font-black text-gray-400 uppercase tracking-widest flex items-center gap-2 hover:text-amber-500 transition-colors">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Daftar
        </a>
    </div>

    <form action="{{ route('admin.domains.update', $domain) }}" method="POST" class="bg-white p-8 rounded-lg shadow-sm border border-gray-100 space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Nama Domain</label>
            <input type="text" name="name" value="{{ old('name', $domain->name) }}" class="w-full bg-gray-50 border-gray-100 rounded-lg px-4 py-3 focus:ring-amber-500 focus:border-amber-500 @error('name') border-red-500 @enderror" required>
            @error('name') <p class="mt-1 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">URL Dasar (Base URL)</label>
            <input type="url" name="url" value="{{ old('url', $domain->url) }}" class="w-full bg-gray-50 border-gray-100 rounded-lg px-4 py-3 focus:ring-amber-500 focus:border-amber-500 @error('url') border-red-500 @enderror" required>
            <p class="mt-2 text-[10px] text-gray-400 font-medium italic">* Pastikan menggunakan http:// atau https://</p>
            @error('url') <p class="mt-1 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <span class="text-xs font-bold text-slate-900 uppercase tracking-widest">Status Aktif</span>
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ $domain->is_active ? 'checked' : '' }}>
                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-amber-500 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
            </label>
        </div>

        <button type="submit" class="w-full bg-amber-500 text-slate-900 py-4 rounded-lg font-black text-sm uppercase tracking-widest hover:bg-amber-400 transition-all shadow-lg shadow-amber-500/20">
            Perbarui Domain
        </button>
    </form>
</div>
@endsection
