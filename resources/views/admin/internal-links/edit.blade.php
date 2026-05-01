@extends('layouts.admin')

@section('title', 'Edit Tautan Internal')
@section('header', 'Edit Tautan Internal')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100">
        <form action="{{ route('admin.internal-links.update', $internalLink) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-xs font-black text-slate-900 uppercase tracking-widest mb-2">Kata Kunci</label>
                <input type="text" name="keyword" value="{{ old('keyword', $internalLink->keyword) }}" 
                       class="w-full bg-gray-50 border-gray-100 rounded-lg px-5 py-4 focus:ring-amber-500 font-bold" required>
                @error('keyword') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-black text-slate-900 uppercase tracking-widest mb-2">URL Tujuan</label>
                <input type="url" name="url" value="{{ old('url', $internalLink->url) }}" 
                       class="w-full bg-gray-50 border-gray-100 rounded-lg px-5 py-4 focus:ring-amber-500 font-bold text-amber-600" required>
                @error('url') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-black text-slate-900 uppercase tracking-widest mb-2">Limit Per Artikel</label>
                <input type="number" name="limit" value="{{ old('limit', $internalLink->limit) }}" min="1" max="10"
                       class="w-full bg-gray-50 border-gray-100 rounded-lg px-5 py-4 focus:ring-amber-500 font-bold">
            </div>

            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <span class="text-xs font-bold text-slate-900 uppercase tracking-widest">Status Aktif</span>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ $internalLink->is_active ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-amber-500 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                </label>
            </div>

            <div class="pt-4 flex gap-4">
                <button type="submit" class="flex-1 bg-amber-500 text-slate-900 py-4 rounded-lg font-black text-sm uppercase tracking-widest hover:bg-amber-400 transition-all shadow-lg shadow-amber-500/20">
                    Perbarui Tautan
                </button>
                <a href="{{ route('admin.internal-links.index') }}" class="px-8 py-4 bg-gray-100 text-gray-400 rounded-lg text-xs font-black uppercase tracking-widest hover:bg-gray-200 transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
