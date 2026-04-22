@extends('layouts.admin')

@section('title', isset($page) ? 'Edit Halaman' : 'Buat Halaman')
@section('header', isset($page) ? 'Edit Halaman' : 'Buat Halaman Baru')

@section('content')
<div class="max-w-4xl">
    <form action="{{ isset($page) ? route('admin.pages.update', $page) : route('admin.pages.store') }}" method="POST" class="space-y-8">
        @csrf
        @if(isset($page)) @method('PUT') @endif

        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 space-y-6">
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Judul Halaman</label>
                <input type="text" name="title" value="{{ old('title', $page->title ?? '') }}" placeholder="Contoh: Kebijakan Privasi" class="w-full bg-gray-50 border-none rounded-xl px-5 py-3 text-sm focus:ring-2 focus:ring-amber-500" required>
            </div>

            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Konten Halaman</label>
                <textarea name="content" rows="15" class="w-full bg-gray-50 border-none rounded-xl px-5 py-3 text-sm focus:ring-2 focus:ring-amber-500" required>{{ old('content', $page->content ?? '') }}</textarea>
                <p class="mt-2 text-[10px] text-gray-400 font-medium italic">*Anda bisa menggunakan tag HTML untuk memformat teks.</p>
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_published" id="is_published" {{ old('is_published', $page->is_published ?? true) ? 'checked' : '' }} class="rounded text-amber-500 focus:ring-amber-500">
                <label for="is_published" class="text-sm font-bold text-slate-700">Publikasikan Halaman</label>
            </div>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 space-y-6">
            <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-3">
                <span class="h-2 w-2 bg-amber-500 rounded-full"></span> SEO & Metadata (Opsional)
            </h3>
            
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Meta Title</label>
                <input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title ?? '') }}" class="w-full bg-gray-50 border-none rounded-xl px-5 py-3 text-sm focus:ring-2 focus:ring-amber-500">
            </div>

            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Meta Description</label>
                <textarea name="meta_description" rows="3" class="w-full bg-gray-50 border-none rounded-xl px-5 py-3 text-sm focus:ring-2 focus:ring-amber-500">{{ old('meta_description', $page->meta_description ?? '') }}</textarea>
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.pages.index') }}" class="px-8 py-4 text-xs font-black uppercase tracking-widest text-gray-400 hover:text-slate-900 transition-all">Batal</a>
            <button type="submit" class="bg-slate-900 text-white px-10 py-4 rounded-xl text-sm font-black uppercase tracking-widest hover:bg-slate-800 transition-all shadow-lg">
                {{ isset($page) ? 'Simpan Perubahan' : 'Buat Halaman' }}
            </button>
        </div>
    </form>
</div>
@endsection
