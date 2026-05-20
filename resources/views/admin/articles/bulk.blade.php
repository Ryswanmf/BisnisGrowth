@extends('layouts.admin')

@section('title', 'Bulk Article Generator')
@section('header', 'Bulk Spintax Generator')

@section('content')
<div class="max-w-5xl">
    <div class="mb-8">
        <h3 class="text-lg font-black text-slate-900 tracking-tight mb-1">Generate Artikel Massal</h3>
        <p class="text-xs text-gray-400 font-medium uppercase tracking-widest">Gunakan spintax dan daftar keyword untuk membuat ratusan artikel secara otomatis.</p>
    </div>

    @if(session('error'))
    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm font-bold rounded shadow-sm">
        {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('admin.articles.bulk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        
        <div class="bg-white p-8 md:p-12 rounded-lg border border-gray-100 shadow-sm space-y-8">
            <!-- Section: Spintax Content -->
            <div class="space-y-6">
                <h3 class="text-sm font-black text-slate-900 uppercase tracking-[0.2em] flex items-center gap-2">
                    <svg class="h-5 w-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Master Spintax & Konten
                </h3>
                
                <!-- Spintax Title -->
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Spintax Judul Artikel</label>
                    <input type="text" name="spintax_title" value="{{ old('spintax_title') }}" placeholder="{Jual|Sewa} {Mobil|Motor} Murah di" class="w-full bg-gray-50 border-none rounded-lg px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-amber-500" required>
                    <p class="text-[10px] text-gray-400 font-bold italic ml-1">*Hasil akhir: [Spintax Judul] [Keyword]</p>
                </div>

                <!-- Spintax Excerpt -->
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Spintax Ringkasan (Excerpt)</label>
                    <textarea name="spintax_excerpt" rows="3" class="w-full bg-gray-50 border-none rounded-lg px-5 py-4 text-sm font-medium focus:ring-2 focus:ring-amber-500" placeholder="Ringkasan artikel yang menarik perhatian...">{!! old('spintax_excerpt') !!}</textarea>
                </div>

                <!-- Spintax Content -->
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Spintax Konten Utama</label>
                    <textarea name="spintax_content" id="summernote" rows="10" class="w-full bg-gray-50 border-none rounded-lg px-5 py-4 text-sm font-medium focus:ring-2 focus:ring-amber-500" placeholder="Masukkan konten artikel Anda di sini. Gunakan format {pilihan 1|pilihan 2} untuk variasi kalimat." required>{{ old('spintax_content') }}</textarea>
                </div>
            </div>

            <!-- Section: SEO & Keywords -->
            <div class="pt-8 border-t border-gray-100 space-y-6">
                <h3 class="text-sm font-black text-slate-900 uppercase tracking-[0.2em] flex items-center gap-2">
                    <svg class="h-5 w-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Optimasi SEO & Keywords
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Spintax Meta Title -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Spintax Meta Title</label>
                        <input type="text" name="spintax_meta_title" value="{{ old('spintax_meta_title') }}" placeholder="{Grosir|Agen} [keyword] Termurah" class="w-full bg-gray-50 border-none rounded-lg px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-amber-500">
                    </div>

                    <!-- Spintax Meta Description -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Spintax Meta Description</label>
                        <input type="text" name="spintax_meta_description" value="{{ old('spintax_meta_description') }}" placeholder="Temukan penawaran terbaik untuk [keyword] hanya di sini..." class="w-full bg-gray-50 border-none rounded-lg px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-amber-500">
                    </div>
                </div>

                <!-- Keywords List -->
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Daftar Keyword Utama (Satu per baris)</label>
                    <textarea name="keywords" rows="8" class="w-full bg-gray-50 border-none rounded-lg px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-amber-500" placeholder="Jakarta&#10;Bandung&#10;Surabaya" required>{{ old('keywords') }}</textarea>
                    <p class="text-[10px] text-gray-400 font-bold italic ml-1">*Setiap baris akan menjadi pemicu pembuatan satu artikel.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Domain Selector -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Domain (Untuk Canonical URL)</label>
                        <select name="domain_url" class="w-full bg-gray-50 border-none rounded-lg px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-amber-500">
                            <option value="">-- Pilih Domain --</option>
                            @foreach($domains as $domain)
                                <option value="{{ $domain->url }}">{{ $domain->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Short Keyword Pools -->
                    <div class="space-y-2" x-data="{ 
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
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Short Keyword Pools (Opsional)</label>
                        <div class="relative">
                            <button type="button" @click="open = !open" 
                                    class="w-full bg-gray-50 border-none rounded-lg px-5 py-4 text-left focus:ring-2 focus:ring-amber-500">
                                <span class="text-xs font-bold text-slate-600 truncate inline-block w-[90%]" x-text="selected.length ? selectedTitles : '-- Pilih Pool Keyword --'"></span>
                            </button>

                            <div x-show="open" @click.away="open = false" class="absolute z-50 mt-2 w-full bg-white rounded-xl shadow-xl border border-gray-100 p-4 space-y-4">
                                <input type="text" x-model="search" placeholder="Cari pool..." class="w-full bg-gray-50 border-gray-100 rounded-lg px-4 py-2 text-xs focus:ring-amber-500">
                                <div class="max-h-60 overflow-y-auto space-y-1">
                                    <template x-for="item in filteredItems" :key="item.id">
                                        <label class="flex items-center p-2 rounded-md cursor-pointer hover:bg-amber-50 transition-colors">
                                            <input type="checkbox" name="short_keyword_ids[]" :value="item.id" @change="toggle(item.id)" :checked="selected.includes(item.id)" class="w-4 h-4 text-amber-500 border-gray-300 rounded">
                                            <div class="ml-3">
                                                <span class="block text-[10px] font-black text-slate-900 uppercase tracking-widest" x-text="item.title"></span>
                                                <span class="block text-[8px] text-gray-400 font-bold uppercase" x-text="item.count + ' Keywords'"></span>
                                            </div>
                                        </label>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section: Media & Random Images -->
            <div class="pt-8 border-t border-gray-100 space-y-6">
                <h3 class="text-sm font-black text-slate-900 uppercase tracking-[0.2em] flex items-center gap-2">
                    <svg class="h-5 w-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Media & Gambar Acak
                </h3>
                
                <div class="space-y-4">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Upload Koleksi Gambar (Maks 12)</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4" id="image-previews">
                        <!-- Preview akan muncul di sini -->
                    </div>
                    <div class="relative group">
                        <input type="file" name="bulk_images[]" multiple accept="image/*" onchange="previewImages(this)" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="p-8 border-2 border-dashed border-gray-200 rounded-xl text-center group-hover:border-amber-400 transition-all bg-gray-50 group-hover:bg-amber-50">
                            <svg class="mx-auto h-8 w-8 text-gray-400 group-hover:text-amber-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                            <p class="text-xs font-bold text-gray-500 group-hover:text-amber-700">Pilih hingga 12 gambar untuk dipilih secara acak saat generate.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-gray-100" x-data="{ scheduleMode: 'interval' }">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-sm font-black text-slate-900 uppercase tracking-[0.2em] flex items-center gap-2">
                        <svg class="h-5 w-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Pengaturan Jadwal Terbit
                    </h3>
                    <div class="flex bg-gray-100 p-1 rounded-lg">
                        <button type="button" @click="scheduleMode = 'interval'" :class="scheduleMode === 'interval' ? 'bg-white shadow-sm text-slate-900' : 'text-gray-400'" class="px-4 py-1.5 rounded-md text-[10px] font-black uppercase tracking-widest transition-all">Interval</button>
                        <button type="button" @click="scheduleMode = 'range'" :class="scheduleMode === 'range' ? 'bg-white shadow-sm text-slate-900' : 'text-gray-400'" class="px-4 py-1.5 rounded-md text-[10px] font-black uppercase tracking-widest transition-all">Rentang Tanggal</button>
                    </div>
                </div>

                <input type="hidden" name="schedule_mode" :value="scheduleMode">

                <!-- Mode Interval -->
                <div x-show="scheduleMode === 'interval'" class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Category -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Kategori</label>
                        <select name="category_name" class="w-full bg-gray-50 border-none rounded-lg px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-amber-500" :required="scheduleMode === 'interval'">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Batch Size -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Jumlah Per Batch</label>
                        <input type="number" name="batch_size" value="10" min="1" class="w-full bg-gray-50 border-none rounded-lg px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-amber-500">
                    </div>

                    <!-- Interval -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Jeda Waktu (Menit)</label>
                        <input type="number" name="interval_minutes" value="5" min="1" class="w-full bg-gray-50 border-none rounded-lg px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-amber-500">
                    </div>
                </div>

                <!-- Mode Range -->
                <div x-show="scheduleMode === 'range'" class="grid grid-cols-1 md:grid-cols-3 gap-8" style="display: none;">
                    <!-- Category (Duplicate but with different required logic if needed, or keep one) -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Kategori</label>
                        <select name="category_name_range" class="w-full bg-gray-50 border-none rounded-lg px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-amber-500">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Start Date -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal Mulai</label>
                        <input type="datetime-local" name="start_date" value="{{ now()->format('Y-m-d\TH:i') }}" class="w-full bg-gray-50 border-none rounded-lg px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-amber-500">
                    </div>

                    <!-- End Date -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal Selesai</label>
                        <input type="datetime-local" name="end_date" value="{{ now()->addDays(7)->format('Y-m-d\TH:i') }}" class="w-full bg-gray-50 border-none rounded-lg px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-amber-500">
                    </div>
                </div>
            </div>

            <!-- Information Box -->
            <div class="p-6 bg-blue-50 rounded-lg border border-blue-100">
                <p class="text-[10px] font-black text-blue-700 uppercase tracking-widest mb-2">💡 Cara Kerja Penjadwalan</p>
                <ul class="text-xs text-blue-600 font-medium leading-relaxed list-disc ml-4 space-y-1">
                    <li><strong>Mode Interval:</strong> Artikel diterbitkan dalam kelompok (batch) dengan jeda waktu tertentu.</li>
                    <li><strong>Mode Rentang Tanggal:</strong> Artikel akan didistribusikan secara merata mulai dari tanggal mulai hingga tanggal selesai.</li>
                    <li>Setiap keyword akan diproses menjadi satu artikel unik dengan kombinasi spintax.</li>
                </ul>
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.articles.index') }}" class="px-8 py-5 rounded-lg text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-slate-900 transition-all">
                Batal
            </a>
            <button type="submit" class="bg-amber-500 text-slate-900 px-12 py-5 rounded-lg text-[10px] font-black uppercase tracking-[0.3em] hover:bg-amber-400 transition-all shadow-xl shadow-amber-500/20">
                Mulai Generate Massal
            </button>
        </div>
    </form>

    @push('scripts')
    <script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Masukkan konten master spintax Anda di sini...',
            tabsize: 2,
            height: 400,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear', 'italic']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });

    function previewImages(input) {
        const container = document.getElementById('image-previews');
        container.innerHTML = '';
        
        if (input.files) {
            const filesArray = Array.from(input.files).slice(0, 12);
            filesArray.forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative aspect-video rounded-lg overflow-hidden border border-gray-100 shadow-sm';
                    div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                    container.appendChild(div);
                }
                reader.readAsDataURL(file);
            });
        }
    }
    </script>
    @endpush
</div>
@endsection
