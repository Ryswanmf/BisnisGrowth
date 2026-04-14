@extends('layouts.admin')

@section('title', 'Pengaturan Website')
@section('header', 'Pengaturan Umum')

@section('content')
<div class="max-w-5xl" x-data="{ tab: 'identity' }">
    @if(session('success'))
        <div class="mb-8 bg-emerald-50 border border-emerald-100 text-emerald-600 px-6 py-4 rounded-2xl text-sm font-bold animate-pulse">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tab Navigation -->
    <div class="flex gap-2 mb-8 bg-gray-100 p-1.5 rounded-2xl w-fit">
        <button @click="tab = 'identity'" :class="tab === 'identity' ? 'bg-white text-slate-900 shadow-sm' : 'text-gray-400 hover:text-gray-600'" class="px-6 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all">Identitas</button>
        <button @click="tab = 'seo'" :class="tab === 'seo' ? 'bg-white text-slate-900 shadow-sm' : 'text-gray-400 hover:text-gray-600'" class="px-6 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all">SEO & Meta</button>
        <button @click="tab = 'api'" :class="tab === 'api' ? 'bg-white text-slate-900 shadow-sm' : 'text-gray-400 hover:text-gray-600'" class="px-6 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all">AI & API</button>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')

        <!-- Tab: Identitas -->
        <div x-show="tab === 'identity'" x-transition class="bg-white p-8 md:p-12 rounded-[3rem] border border-gray-100 shadow-sm space-y-8">
            <div>
                <h3 class="text-lg font-black text-slate-900 tracking-tight mb-1">Identitas Dasar</h3>
                <p class="text-xs text-gray-400 font-medium uppercase tracking-widest">Informasi utama profil website.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Nama Website</label>
                    <input type="text" name="site_name" value="{{ $settings['site_name'] ?? 'BisnisGrowth' }}" class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-amber-500">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tagline</label>
                    <input type="text" name="site_tagline" value="{{ $settings['site_tagline'] ?? 'Satu Link untuk Semua Bisnismu' }}" class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-amber-500">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Deskripsi Bisnis</label>
                <textarea name="site_description" rows="4" class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 text-sm font-medium focus:ring-2 focus:ring-amber-500">{{ $settings['site_description'] ?? '' }}</textarea>
            </div>
        </div>

        <!-- Tab: SEO -->
        <div x-show="tab === 'seo'" x-transition class="bg-white p-8 md:p-12 rounded-[3rem] border border-gray-100 shadow-sm space-y-8">
            <div>
                <h3 class="text-lg font-black text-slate-900 tracking-tight mb-1">Optimasi Mesin Pencari</h3>
                <p class="text-xs text-gray-400 font-medium uppercase tracking-widest">Meta tag global untuk Google dan Sosial Media.</p>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Google Analytics ID</label>
                <input type="text" name="ga_id" value="{{ $settings['ga_id'] ?? '' }}" placeholder="G-XXXXXXXXXX" class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-amber-500">
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Meta Keywords</label>
                <input type="text" name="meta_keywords" value="{{ $settings['meta_keywords'] ?? '' }}" placeholder="umkm, bisnis, edukasi, direktori" class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-amber-500">
            </div>
        </div>

        <!-- Tab: AI & API -->
        <div x-show="tab === 'api'" x-transition class="bg-white p-8 md:p-12 rounded-[3rem] border border-gray-100 shadow-sm space-y-8">
            <div>
                <h3 class="text-lg font-black text-slate-900 tracking-tight mb-1">Integrasi AI & API</h3>
                <p class="text-xs text-gray-400 font-medium uppercase tracking-widest">Konfigurasi kunci layanan pihak ketiga.</p>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Official WhatsApp Number</label>
                <input type="text" name="official_whatsapp" value="{{ $settings['official_whatsapp'] ?? '089515915699' }}" class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-amber-500">
                <p class="text-[10px] text-gray-400 font-bold italic ml-1">*Nomor ini digunakan sebagai default tombol kontak di artikel.</p>
            </div>

            <div class="p-6 bg-amber-50 rounded-2xl border border-amber-100">
                <p class="text-[10px] font-black text-amber-700 uppercase tracking-widest mb-2">💡 Tips Keamanan</p>
                <p class="text-xs text-amber-600 font-medium leading-relaxed">Kunci API (seperti Gemini/OpenAI) tetap disarankan dikelola melalui file <strong>.env</strong> untuk keamanan maksimal. Gunakan halaman ini untuk pengaturan yang bersifat dinamis.</p>
            </div>
        </div>

        <div class="flex justify-end gap-4 pt-4">
            <button type="submit" class="bg-slate-900 text-white px-12 py-5 rounded-2xl text-[10px] font-black uppercase tracking-[0.3em] hover:bg-slate-800 transition-all shadow-xl shadow-slate-900/20">
                Simpan Semua Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
