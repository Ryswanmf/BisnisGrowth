@extends('layouts.admin')

@section('title', isset($category) ? 'Edit Kategori' : 'Tambah Kategori')
@section('header', isset($category) ? 'Edit Kategori' : 'Tambah Kategori Baru')

@section('content')
<div class="max-w-2xl">
    <form action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}" method="POST" class="space-y-8">
        @csrf
        @if(isset($category)) @method('PUT') @endif

        <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100 space-y-6">
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" placeholder="e.g. Digital Marketing" class="w-full bg-gray-50 border-none rounded-lg px-5 py-3 text-sm focus:ring-2 focus:ring-amber-500 font-bold" required>
                @error('name') <p class="mt-1 text-red-500 text-xs font-bold">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Urutan Tampilan</label>
                <input type="number" name="order" value="{{ old('order', $category->order ?? 0) }}" class="w-full bg-gray-50 border-none rounded-lg px-5 py-3 text-sm focus:ring-2 focus:ring-amber-500 font-bold">
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" id="is_active" {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }} class="rounded text-amber-500 focus:ring-amber-500">
                <label for="is_active" class="text-sm font-bold text-slate-700">Aktifkan Kategori</label>
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.categories.index') }}" class="px-8 py-4 text-xs font-black uppercase tracking-widest text-gray-400 hover:text-slate-900 transition-all">Batal</a>
            <button type="submit" class="bg-slate-900 text-white px-10 py-4 rounded-lg text-sm font-black uppercase tracking-widest hover:bg-slate-800 transition-all shadow-lg">
                {{ isset($category) ? 'Simpan Perubahan' : 'Tambah Kategori' }}
            </button>
        </div>
    </form>
</div>
@endsection
