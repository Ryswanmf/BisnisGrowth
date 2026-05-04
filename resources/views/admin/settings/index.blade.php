@extends('layouts.admin')

@section('title', 'Pengaturan Website')
@section('header', 'Pengaturan Umum')

@section('content')
<div class="max-w-5xl" x-data="{ tab: 'identity' }">
    <!-- Tab Navigation -->
    <div class="flex gap-2 mb-8 bg-gray-100 p-1.5 rounded-lg w-fit">
        <button @click="tab = 'identity'" :class="tab === 'identity' ? 'bg-white text-slate-900 shadow-sm' : 'text-gray-400 hover:text-gray-600'" class="px-6 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-lg transition-all">Identitas</button>
        <button @click="tab = 'seo'" :class="tab === 'seo' ? 'bg-white text-slate-900 shadow-sm' : 'text-gray-400 hover:text-gray-600'" class="px-6 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-lg transition-all">SEO & Meta</button>
        <button @click="tab = 'api'" :class="tab === 'api' ? 'bg-white text-slate-900 shadow-sm' : 'text-gray-400 hover:text-gray-600'" class="px-6 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-lg transition-all">AI & API</button>
        <button @click="tab = 'maintenance'" :class="tab === 'maintenance' ? 'bg-white text-slate-900 shadow-sm' : 'text-gray-400 hover:text-gray-600'" class="px-6 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-lg transition-all">Pemeliharaan</button>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
...
        <!-- Tab: Maintenance -->
        <div x-show="tab === 'maintenance'" x-transition class="bg-white p-8 md:p-12 rounded-lg border border-gray-100 shadow-sm space-y-10">
            <div>
                <h3 class="text-lg font-black text-slate-900 tracking-tight mb-1">Pemeliharaan Sistem</h3>
                <p class="text-xs text-gray-400 font-medium uppercase tracking-widest">Alat bantu untuk menjaga stabilitas dan data website.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Sitemap Tool -->
                <div class="p-8 bg-slate-50 rounded-[2rem] border border-gray-100 space-y-4">
                    <div class="h-12 w-12 bg-blue-500 rounded-lg flex items-center justify-center text-white shadow-lg shadow-blue-500/20">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest">Sitemap XML</h4>
                        <p class="text-xs text-gray-500 leading-relaxed mt-1">Daftar semua URL website untuk membantu Google melakukan indeksasi artikel Anda.</p>
                    </div>
                    <a href="/sitemap.xml" target="_blank" class="inline-block px-6 py-3 bg-white border border-gray-200 rounded-lg text-[10px] font-black uppercase tracking-widest text-slate-600 hover:bg-slate-900 hover:text-white hover:border-slate-900 transition-all">
                        Lihat Sitemap
                    </a>
                </div>

                <!-- Database Backup Tool -->
                <div class="p-8 bg-slate-50 rounded-[2rem] border border-gray-100 space-y-4">
                    <div class="h-12 w-12 bg-amber-500 rounded-lg flex items-center justify-center text-slate-900 shadow-lg shadow-amber-500/20">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest">Cadangan Database</h4>
                        <p class="text-xs text-gray-500 leading-relaxed mt-1">Unduh seluruh data website (Artikel, User, Settings) dalam format file .SQL.</p>
                    </div>
                    <a href="{{ route('admin.settings.backup') }}" class="inline-block px-6 py-3 bg-amber-500 text-slate-900 rounded-lg text-[10px] font-black uppercase tracking-widest hover:bg-amber-400 transition-all shadow-lg shadow-amber-500/10">
                        Download Backup
                    </a>
                </div>
            </div>
        </div>
        @csrf
        @method('PUT')

        <!-- Tab: Identitas -->
        <div x-show="tab === 'identity'" x-transition class="bg-white p-8 md:p-12 rounded-lg border border-gray-100 shadow-sm space-y-8">
            <div>
                <h3 class="text-lg font-black text-slate-900 tracking-tight mb-1">Identitas Dasar</h3>
                <p class="text-xs text-gray-400 font-medium uppercase tracking-widest">Informasi utama profil website.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Nama Website</label>
                    <input type="text" name="site_name" value="{{ $settings['site_name'] ?? 'BisnisGrowth' }}" class="w-full bg-gray-50 border-none rounded-lg px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-amber-500">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tagline</label>
                    <input type="text" name="site_tagline" value="{{ $settings['site_tagline'] ?? 'Satu Link untuk Semua Bisnismu' }}" class="w-full bg-gray-50 border-none rounded-lg px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-amber-500">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Deskripsi Bisnis</label>
                <textarea name="site_description" rows="4" class="w-full bg-gray-50 border-none rounded-lg px-5 py-4 text-sm font-medium focus:ring-2 focus:ring-amber-500">{{ $settings['site_description'] ?? '' }}</textarea>
            </div>
        </div>

        <!-- Tab: SEO -->
        <div x-show="tab === 'seo'" x-transition class="bg-white p-8 md:p-12 rounded-lg border border-gray-100 shadow-sm space-y-8">
            <div>
                <h3 class="text-lg font-black text-slate-900 tracking-tight mb-1">Optimasi Mesin Pencari</h3>
                <p class="text-xs text-gray-400 font-medium uppercase tracking-widest">Meta tag global untuk Google dan Sosial Media.</p>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Google Analytics ID</label>
                <input type="text" name="ga_id" value="{{ $settings['ga_id'] ?? '' }}" placeholder="G-XXXXXXXXXX" class="w-full bg-gray-50 border-none rounded-lg px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-amber-500">
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Meta Keywords</label>
                <input type="text" name="meta_keywords" value="{{ $settings['meta_keywords'] ?? '' }}" placeholder="umkm, bisnis, edukasi, direktori" class="w-full bg-gray-50 border-none rounded-lg px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-amber-500">
            </div>
        </div>

        <!-- Tab: AI & API -->
        <div x-show="tab === 'api'" x-transition class="bg-white p-8 md:p-12 rounded-lg border border-gray-100 shadow-sm space-y-8">
            <div>
                <h3 class="text-lg font-black text-slate-900 tracking-tight mb-1">Integrasi AI & API</h3>
                <p class="text-xs text-gray-400 font-medium uppercase tracking-widest">Konfigurasi kunci layanan pihak ketiga.</p>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Official WhatsApp Number</label>
                <input type="text" name="official_whatsapp" value="{{ $settings['official_whatsapp'] ?? '089515915699' }}" class="w-full bg-gray-50 border-none rounded-lg px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-amber-500">
                <p class="text-[10px] text-gray-400 font-bold italic ml-1">*Nomor ini digunakan sebagai default tombol kontak di artikel.</p>
            </div>

            <div class="p-6 bg-amber-50 rounded-lg border border-amber-100">
                <p class="text-[10px] font-black text-amber-700 uppercase tracking-widest mb-2">💡 Tips Keamanan</p>
                <p class="text-xs text-amber-600 font-medium leading-relaxed">Kunci API (seperti Gemini/OpenAI) tetap disarankan dikelola melalui file <strong>.env</strong> untuk keamanan maksimal. Gunakan halaman ini untuk pengaturan yang bersifat dinamis.</p>
            </div>
        </div>

        <div class="flex justify-end gap-4 pt-4">
            <button type="submit" class="bg-slate-900 text-white px-12 py-5 rounded-lg text-[10px] font-black uppercase tracking-[0.3em] hover:bg-slate-800 transition-all shadow-xl shadow-slate-900/20">
                Simpan Semua Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
