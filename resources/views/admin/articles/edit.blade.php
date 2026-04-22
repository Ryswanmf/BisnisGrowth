@extends('layouts.admin')

@section('title', 'Edit Artikel')
@section('header', 'Edit Artikel')

@section('content')
<form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Side: Content Area -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 space-y-6">
                <div>
                    <label class="block text-xs font-black text-slate-900 uppercase tracking-widest mb-2">Judul Artikel</label>
                    <input type="text" name="title" value="{{ old('title', $article->title) }}" class="w-full bg-gray-50 border-gray-100 rounded-xl px-5 py-4 focus:ring-amber-500 font-bold text-lg">
                </div>

                <div>
                    <div class="flex justify-between items-end mb-2">
                        <label class="block text-xs font-black text-slate-900 uppercase tracking-widest">Konten Lengkap</label>
                        <div id="word-count-wrapper" class="text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded-lg bg-red-50 text-red-500 border border-red-100 transition-all">
                            <span id="word-count">0</span> Kata
                        </div>
                    </div>
                    <textarea name="content" id="article-content" rows="15" 
                              class="w-full bg-gray-50 border-gray-100 rounded-xl px-5 py-4 focus:ring-amber-500 transition-all">{{ old('content', $article->content) }}</textarea>
                    <p id="word-count-feedback" class="mt-2 text-[10px] text-red-400 font-bold italic">Saran: Tambahkan minimal 300 kata agar tampilan artikel terlihat profesional.</p>
                </div>

                <div>
                    <label class="block text-xs font-black text-slate-900 uppercase tracking-widest mb-2">Ringkasan (Excerpt)</label>
                    <textarea name="excerpt" rows="3" class="w-full bg-gray-50 border-gray-100 rounded-xl px-5 py-3 focus:ring-amber-500">{{ old('excerpt', $article->excerpt) }}</textarea>
                </div>
            </div>

            <!-- SEO Card -->
            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
                <h3 class="text-sm font-black text-slate-900 uppercase tracking-[0.2em] mb-6 flex items-center gap-2">SEO Settings</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $article->meta_title) }}" class="w-full bg-gray-50 border-gray-100 rounded-xl px-4 py-3">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Meta Description</label>
                        <textarea name="meta_description" rows="3" class="w-full bg-gray-50 border-gray-100 rounded-xl px-4 py-3">{{ old('meta_description', $article->meta_description) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Focus Keyword</label>
                        <input type="text" name="focus_keyword" value="{{ old('focus_keyword', $article->focus_keyword) }}" class="w-full bg-gray-50 border-gray-100 rounded-xl px-4 py-3">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Canonical URL</label>
                        <input type="text" name="canonical_url" value="{{ old('canonical_url', $article->canonical_url) }}" class="w-full bg-gray-50 border-gray-100 rounded-xl px-4 py-3">
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Sidebar -->
        <div class="space-y-6">
            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 space-y-6">
                <button type="submit" class="w-full bg-amber-500 text-slate-900 py-4 rounded-xl font-black text-sm uppercase tracking-widest hover:bg-amber-400 shadow-lg">Perbarui Artikel</button>

                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                    <span class="text-xs font-bold text-slate-900 uppercase tracking-widest">Status Publik</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_published" value="1" class="sr-only peer" {{ $article->is_published ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-amber-500 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                    <span class="text-xs font-bold text-slate-900 uppercase tracking-widest">Headline</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ $article->is_featured ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-amber-500 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                    </label>
                </div>
            </div>

            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 space-y-6">
                <h3 class="text-xs font-black text-slate-900 uppercase tracking-widest">Gambar Utama</h3>
                @if($article->image)
                    <div class="relative group">
                        <img src="{{ asset($article->image) }}" class="w-full h-32 object-cover rounded-xl border border-gray-100 shadow-sm">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center text-white text-[10px] font-black uppercase tracking-widest">Ganti Gambar</div>
                    </div>
                @endif
                <div class="space-y-4">
                    <input type="file" name="image" class="w-full text-xs text-gray-400 file:bg-amber-50 file:text-amber-600 file:rounded-full file:border-0 file:px-4 file:py-2">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Alt Gambar</label>
                        <input type="text" name="image_alt" value="{{ old('image_alt', $article->image_alt) }}" class="w-full bg-gray-50 border-gray-100 rounded-xl px-4 py-2 text-sm">
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 space-y-6">
                <h3 class="text-xs font-black text-slate-900 uppercase tracking-widest">Gambar Tambahan</h3>
                <div class="grid grid-cols-1 gap-6">
                    @foreach(['image_2', 'image_3', 'image_4'] as $imgField)
                        <div class="space-y-3">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">Gambar {{ substr($imgField, -1) }}</label>
                            @if($article->$imgField)
                                <img src="{{ asset('storage/' . $article->$imgField) }}" class="h-20 w-full object-cover rounded-lg border border-gray-100">
                            @endif
                            <input type="file" name="{{ $imgField }}" class="w-full text-[10px] text-gray-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-slate-50 file:text-slate-600">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
                <h3 class="text-xs font-black text-slate-900 uppercase tracking-widest mb-4">Kategori</h3>
                <select name="category_name" class="w-full bg-gray-50 border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-amber-500 font-bold" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->name }}" {{ old('category_name', $article->category_name) == $cat->name ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    const textarea = document.getElementById('article-content');
    const wordCountDisplay = document.getElementById('word-count');
    const wrapper = document.getElementById('word-count-wrapper');
    const feedback = document.getElementById('word-count-feedback');

    function updateWordCount() {
        const text = textarea.value.trim();
        const words = text ? text.split(/\s+/).length : 0;
        
        wordCountDisplay.innerText = words;

        if (words >= 300) {
            wrapper.classList.remove('bg-red-50', 'text-red-500', 'border-red-100');
            wrapper.classList.add('bg-emerald-50', 'text-emerald-600', 'border-emerald-100');
            feedback.innerText = 'Luar biasa! Panjang artikel sudah ideal untuk SEO dan tampilan.';
            feedback.classList.remove('text-red-400');
            feedback.classList.add('text-emerald-500');
        } else {
            wrapper.classList.add('bg-red-50', 'text-red-500', 'border-red-100');
            wrapper.classList.remove('bg-emerald-50', 'text-emerald-600', 'border-emerald-100');
            feedback.innerText = 'Saran: Tambahkan minimal 300 kata agar tampilan artikel terlihat profesional.';
            feedback.classList.add('text-red-400');
            feedback.classList.remove('text-emerald-500');
        }
    }

    textarea.addEventListener('input', updateWordCount);
    window.addEventListener('load', updateWordCount);
</script>
@endpush
