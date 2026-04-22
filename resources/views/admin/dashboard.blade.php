@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('header', 'Ringkasan Sistem')

@section('content')
<div class="space-y-10">
    
    <!-- Welcome Header -->
    <div class="bg-slate-900 p-8 md:p-12 rounded-xl shadow-2xl relative overflow-hidden text-white group">
        <div class="absolute -right-20 -top-20 h-64 w-64 bg-amber-500/10 rounded-full blur-3xl transition-all duration-700 group-hover:bg-amber-500/20"></div>
        <div class="relative z-10 max-w-2xl">
            <h2 class="text-3xl md:text-4xl font-black mb-4 tracking-tight">Selamat Datang, {{ Auth::user()->name }}!</h2>
            <p class="text-slate-400 text-base md:text-lg font-medium leading-relaxed mb-8">Pantau pertumbuhan ekosistem edukasi bisnis Anda secara real-time dari satu tempat pusat kendali.</p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('admin.articles.create') }}" class="px-8 py-4 bg-amber-500 text-slate-900 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-amber-400 transition-all shadow-lg shadow-amber-500/20">Tulis Artikel Baru</a>
                <a href="{{ route('admin.traffic.index') }}" class="px-8 py-4 bg-white/5 border border-white/10 text-white rounded-xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-white/10 transition-all">Lihat Traffic</a>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-8 rounded-xl border border-gray-100 shadow-sm hover:shadow-xl transition-all">
            <p class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Konten Edukasi</p>
            <div class="flex items-center justify-between">
                <h3 class="text-4xl font-black text-slate-900 tracking-tighter">{{ number_format($stats['total_articles']) }}</h3>
                <span class="text-[10px] font-black text-blue-500 bg-blue-50 px-2 py-1 rounded-lg">Artikel</span>
            </div>
        </div>
        <div class="bg-white p-8 rounded-xl border border-gray-100 shadow-sm hover:shadow-xl transition-all">
            <p class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Total Interaksi</p>
            <div class="flex items-center justify-between">
                <h3 class="text-4xl font-black text-slate-900 tracking-tighter">{{ number_format($stats['total_interactions']) }}</h3>
                <span class="text-[10px] font-black text-emerald-500 bg-emerald-50 px-2 py-1 rounded-lg">User Klik</span>
            </div>
        </div>
        <div class="bg-white p-8 rounded-xl border border-gray-100 shadow-sm hover:shadow-xl transition-all">
            <p class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Hits Hari Ini</p>
            <div class="flex items-center justify-between">
                <h3 class="text-4xl font-black text-amber-500 tracking-tighter">{{ number_format($stats['today_hits']) }}</h3>
                <span class="text-[10px] font-black text-amber-600 bg-amber-50 px-2 py-1 rounded-lg">Traffic</span>
            </div>
        </div>
        <div class="bg-white p-8 rounded-xl border border-gray-100 shadow-sm hover:shadow-xl transition-all">
            <p class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Kategori Bisnis</p>
            <div class="flex items-center justify-between">
                <h3 class="text-4xl font-black text-slate-900 tracking-tighter">{{ number_format($stats['total_categories']) }}</h3>
                <span class="text-[10px] font-black text-slate-500 bg-slate-50 px-2 py-1 rounded-lg">Topics</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        <!-- Recent Articles Table -->
        <div class="bg-white p-8 md:p-10 rounded-xl border border-gray-100 shadow-sm">
            <div class="flex justify-between items-center mb-10">
                <h4 class="text-xs font-black text-slate-900 uppercase tracking-widest flex items-center gap-3">
                    <span class="h-1.5 w-1.5 bg-blue-500 rounded-full"></span> Artikel Teranyar
                </h4>
                <a href="{{ route('admin.articles.index') }}" class="text-[9px] font-black text-amber-600 uppercase tracking-widest hover:underline">Semua</a>
            </div>
            <div class="space-y-6">
                @foreach($stats['recent_articles'] as $art)
                    <div class="flex items-center gap-5 group">
                        <div class="h-14 w-14 bg-slate-50 rounded-xl overflow-hidden shrink-0 border border-gray-100">
                            @if($art->image)
                                <img src="{{ asset($art->image) }}" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <h5 class="text-sm font-bold text-slate-900 truncate group-hover:text-amber-600 transition-colors">{{ $art->title }}</h5>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mt-1">{{ $art->category_name }} • {{ $art->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Top Performing Card -->
        <div class="bg-white p-8 md:p-10 rounded-xl border border-gray-100 shadow-sm">
            <div class="flex justify-between items-center mb-10">
                <h4 class="text-xs font-black text-slate-900 uppercase tracking-widest flex items-center gap-3">
                    <span class="h-1.5 w-1.5 bg-amber-500 rounded-full"></span> Artikel Terpopuler
                </h4>
                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Berdasarkan Klik</span>
            </div>
            <div class="space-y-6">
                @foreach($stats['top_performing_articles'] as $top)
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl hover:bg-amber-50 transition-all border border-transparent hover:border-amber-100 group">
                        <div class="min-w-0 flex-1 mr-4">
                            <h5 class="text-sm font-bold text-slate-900 truncate group-hover:text-amber-600 transition-colors">{{ $top->title }}</h5>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mt-1">{{ $top->category_name }}</p>
                        </div>
                        <div class="text-right shrink-0">
                            <p class="text-sm font-black text-slate-900">{{ number_format($top->click_count) }}</p>
                            <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest">Clicks</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
