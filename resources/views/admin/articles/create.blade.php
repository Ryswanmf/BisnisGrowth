@extends('layouts.admin')

@section('title', 'Tulis Artikel Baru')
@section('header', 'Tulis Artikel')

@section('content')
<div class="space-y-6">
    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Side: Content Area -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100 space-y-6">
                <div>
                    <label class="block text-xs font-black text-slate-900 uppercase tracking-widest mb-2">Judul Artikel</label>
                    <input type="text" name="title" value="{{ old('title') }}" 
                           class="w-full bg-gray-50 border-gray-100 rounded-lg px-5 py-4 focus:ring-amber-500 focus:border-amber-500 font-bold text-lg">
                </div>

                <div>
                    <div class="flex justify-between items-end mb-2">
                        <label class="block text-xs font-black text-slate-900 uppercase tracking-widest">Konten Lengkap</label>
                        <div id="word-count-wrapper" class="text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded-md bg-red-50 text-red-500 border border-red-100 transition-all">
                            <span id="word-count">0</span> Kata
                        </div>
                    </div>
                    <!-- Editor Summernote -->
                    <textarea name="content" id="summernote">{{ old('content') }}</textarea>
                    <p id="word-count-feedback" class="mt-2 text-[10px] text-red-400 font-bold italic">Saran: Tambahkan minimal 300 kata agar tampilan artikel terlihat profesional.</p>
                </div>

                <div>
                    <label class="block text-xs font-black text-slate-900 uppercase tracking-widest mb-2">Ringkasan (Excerpt)</label>
                    <textarea name="excerpt" rows="3" class="w-full bg-gray-50 border-gray-100 rounded-lg px-5 py-3 focus:ring-amber-500 focus:border-amber-500">{{ old('excerpt') }}</textarea>
                </div>
            </div>

            <!-- SEO Settings Card -->
            <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100">
                <h3 class="text-sm font-black text-slate-900 uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                    <svg class="h-5 w-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Optimasi SEO (Search Engine Optimization)
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Meta Title (Google Title)</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title') }}" class="w-full bg-gray-50 border-gray-100 rounded-lg px-4 py-3 focus:ring-amber-500 focus:border-amber-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Meta Description</label>
                        <textarea name="meta_description" rows="3" class="w-full bg-gray-50 border-gray-100 rounded-lg px-4 py-3 focus:ring-amber-500 focus:border-amber-500">{{ old('meta_description') }}</textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Domain Canonical</label>
                        <select id="domain_selector" class="w-full bg-gray-50 border-gray-100 rounded-lg px-4 py-3 focus:ring-amber-500 focus:border-amber-500 text-sm font-bold mb-2">
                            <option value="">-- Pilih Domain --</option>
                            @foreach($domains as $domain)
                                <option value="{{ $domain->url }}">{{ $domain->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="canonical_url" id="canonical_url" value="{{ old('canonical_url') }}" placeholder="URL Lengkap (Otomatis terisi jika domain dipilih)" class="w-full bg-gray-50 border-gray-100 rounded-lg px-4 py-3 focus:ring-amber-500 focus:border-amber-500 text-sm">
                    </div>
                    <div class="md:col-span-2" x-data="{ 
                        open: false, 
                        search: '',
                        selected: [],
                        items: [
                            @foreach($shortKeywords as $sk)
                            { id: {{ $sk->id }}, title: '{{ $sk->title }}', count: {{ count(explode(',', $sk->description)) }} },
                            @endforeach
                        ],
                        toggle(id) {
                            if (this.selected.includes(id)) {
                                this.selected = this.selected.filter(i => i !== id);
                            } else {
                                this.selected.push(id);
                            }
                        },
                        get filteredItems() {
                            return this.items.filter(i => i.title.toLowerCase().includes(this.search.toLowerCase()));
                        },
                        get selectedTitles() {
                            return this.items.filter(i => this.selected.includes(i.id)).map(i => i.title).join(', ');
                        }
                    }">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Short Keyword Pools (Opsional)</label>
                        
                        <!-- Dropdown Trigger -->
                        <div class="relative">
                            <button type="button" @click="open = !open" 
                                    class="w-full bg-gray-50 border border-gray-100 rounded-lg px-4 py-3 flex items-center justify-between hover:bg-white transition-all focus:ring-2 focus:ring-amber-500">
                                <span class="text-xs font-bold text-slate-600 truncate" x-text="selected.length ? selectedTitles : '-- Pilih Pool Keyword --'"></span>
                                <svg class="h-4 w-4 text-gray-400 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>

                            <!-- Dropdown Menu (Slider) -->
                            <div x-show="open" @click.away="open = false" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 class="absolute z-50 mt-2 w-full bg-white rounded-xl shadow-xl border border-gray-100 p-4 space-y-4">
                                
                                <!-- Search Input -->
                                <input type="text" x-model="search" placeholder="Cari pool..." 
                                       class="w-full bg-gray-50 border-gray-100 rounded-lg px-4 py-2 text-xs focus:ring-amber-500 focus:border-amber-500">

                                <!-- Items List -->
                                <div class="max-h-60 overflow-y-auto custom-scrollbar space-y-1">
                                    <template x-for="item in filteredItems" :key="item.id">
                                        <label class="flex items-center p-2 rounded-md cursor-pointer hover:bg-amber-50 transition-colors group">
                                            <input type="checkbox" name="short_keyword_ids[]" :value="item.id" 
                                                   @change="toggle(item.id)" :checked="selected.includes(item.id)"
                                                   class="w-4 h-4 text-amber-500 border-gray-300 rounded focus:ring-amber-500">
                                            <div class="ml-3">
                                                <span class="block text-[10px] font-black text-slate-900 uppercase tracking-widest" x-text="item.title"></span>
                                                <span class="block text-[8px] text-gray-400 font-bold uppercase" x-text="item.count + ' Keywords'"></span>
                                            </div>
                                        </label>
                                    </template>
                                </div>
                            </div>
                        </div>
                        <p class="mt-2 text-[10px] text-gray-400 font-medium italic">* Klik untuk memilih satu atau lebih pool keyword.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Meta & Sidebar -->
        <div class="space-y-6">
            <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100 space-y-6">
                <button type="submit" class="w-full bg-amber-500 text-slate-900 py-4 rounded-lg font-black text-sm uppercase tracking-widest hover:bg-amber-400 transition-all shadow-lg shadow-amber-500/20">
                    Simpan Artikel
                </button>

                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Status Artikel</label>
                    <select name="status" class="w-full bg-gray-50 border-none rounded-lg px-4 py-3 text-xs font-bold focus:ring-2 focus:ring-amber-500">
                        <option value="publish" selected>Terbitkan (Publish)</option>
                        <option value="draft">Draft (Simpan Saja)</option>
                        <option value="private">Privat (Hanya Admin)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Jadwal Tayang (Opsional)</label>
                    <input type="datetime-local" name="published_at" class="w-full bg-gray-50 border-none rounded-lg px-4 py-3 text-xs font-bold focus:ring-2 focus:ring-amber-500">
                    <p class="mt-1 text-[8px] text-gray-400 font-medium italic">* Kosongkan untuk terbit instan. Isi waktu masa depan untuk penjadwalan.</p>
                </div>

                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <span class="text-xs font-bold text-slate-900 uppercase tracking-widest">Headline / Unggulan</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                    </label>
                </div>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100 space-y-6">
                <h3 class="text-xs font-black text-slate-900 uppercase tracking-widest">Gambar Utama</h3>
                <div class="space-y-4">
                    <input type="file" name="image" class="w-full text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-amber-50 file:text-amber-600 hover:file:bg-amber-100">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Teks Alt Gambar (SEO Gambar)</label>
                        <input type="text" name="image_alt" value="{{ old('image_alt') }}" class="w-full bg-gray-50 border-gray-100 rounded-lg px-4 py-2 text-sm focus:ring-amber-500 focus:border-amber-500">
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100 space-y-6">
                <h3 class="text-xs font-black text-slate-900 uppercase tracking-widest">Gambar Tambahan (Opsional)</h3>
                <div class="grid grid-cols-1 gap-4">
                    @foreach(['image_2', 'image_3', 'image_4'] as $imgField)
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Gambar {{ substr($imgField, -1) }}</label>
                            <input type="file" name="{{ $imgField }}" class="w-full text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-slate-50 file:text-slate-600 hover:file:bg-slate-100">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100">
                <h3 class="text-xs font-black text-slate-900 uppercase tracking-widest mb-4">Kategori</h3>
                <select name="category_name" class="w-full bg-gray-50 border-gray-100 rounded-lg px-4 py-3 text-sm focus:ring-amber-500 focus:border-amber-500 font-bold" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->name }}" {{ old('category_name') == $cat->name ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</form>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Tulis konten artikel Anda di sini...',
            tabsize: 2,
            height: 500,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear', 'italic']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    updateWordCount();
                }
            }
        });

        const wordCountDisplay = document.getElementById('word-count');
        const wrapper = document.getElementById('word-count-wrapper');
        const feedback = document.getElementById('word-count-feedback');

        function updateWordCount() {
            const text = $('#summernote').summernote('code').replace(/<[^>]*>/g, ' ').trim();
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

        updateWordCount();
    });

    // Domain & Slug JS
    const domainSelector = document.getElementById('domain_selector');
    const canonicalInput = document.getElementById('canonical_url');
    const titleInput = document.querySelector('input[name="title"]');

    function slugify(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-')
            .replace(/^-+/, '')
            .replace(/-+$/, '');
    }

    domainSelector.addEventListener('change', function() {
        if (this.value) {
            const slug = slugify(titleInput.value);
            canonicalInput.value = this.value.replace(/\/$/, '') + '/artikel/' + slug;
        }
    });

    titleInput.addEventListener('input', function() {
        if (domainSelector.value) {
            const slug = slugify(this.value);
            canonicalInput.value = domainSelector.value.replace(/\/$/, '') + '/artikel/' + slug;
        }
    });
</script>
@endpush
