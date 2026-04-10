@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('header', 'Dashboard Utama')

@section('content')
<div class="space-y-8">
    <!-- Welcome Header -->
    <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-center gap-6">
        <div>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
            <p class="text-gray-500 mt-1 font-medium text-sm">Berikut adalah ringkasan performa BisnisGrowth hari ini.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" target="_blank" class="bg-slate-900 text-white px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 hover:bg-slate-800 transition-all shadow-lg shadow-slate-900/10">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                Lihat Situs
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1 -->
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-amber-100 text-amber-600 rounded-2xl">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <span class="text-[10px] font-black text-green-500 bg-green-50 px-2.5 py-1 rounded-full uppercase tracking-widest">+12%</span>
            </div>
            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Total Bisnis</p>
            <h3 class="text-2xl font-black text-slate-900 mt-1">128</h3>
        </div>

        <!-- Card 2 -->
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-blue-100 text-blue-600 rounded-2xl">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-black text-blue-500 bg-blue-50 px-2.5 py-1 rounded-full uppercase tracking-widest">Baru</span>
            </div>
            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Total Artikel</p>
            <h3 class="text-2xl font-black text-slate-900 mt-1">42</h3>
        </div>

        <!-- Card 3 -->
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-rose-100 text-rose-600 rounded-2xl">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-black text-rose-500 bg-rose-50 px-2.5 py-1 rounded-full uppercase tracking-widest">Populer</span>
            </div>
            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Kunjungan</p>
            <h3 class="text-2xl font-black text-slate-900 mt-1">8.4k</h3>
        </div>

        <!-- Card 4 -->
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-indigo-100 text-indigo-600 rounded-2xl">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
                <span class="text-[10px] font-black text-indigo-500 bg-indigo-50 px-2.5 py-1 rounded-full uppercase tracking-widest">Growth</span>
            </div>
            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Klik Link</p>
            <h3 class="text-2xl font-black text-slate-900 mt-1">1.2k</h3>
        </div>
    </div>

    <!-- Recent Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Articles -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                <h3 class="font-black text-slate-900 text-sm uppercase tracking-widest">Artikel Terbaru</h3>
                <a href="{{ route('article.index') }}" class="text-xs font-bold text-amber-600 hover:underline">Lihat Semua</a>
            </div>
            <div class="divide-y divide-gray-50">
                <!-- Loop placeholder -->
                @for ($i = 0; $i < 4; $i++)
                <div class="p-4 hover:bg-gray-50 transition-colors flex items-center gap-4">
                    <div class="h-12 w-12 bg-gray-100 rounded-xl flex-shrink-0 animate-pulse"></div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-slate-900 truncate">Judul Artikel Terkini yang Menarik Perhatian...</p>
                        <p class="text-[11px] text-gray-400 font-medium uppercase tracking-widest mt-0.5">10 April 2026</p>
                    </div>
                    <button class="p-2 text-gray-400 hover:text-slate-900">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
                @endfor
            </div>
        </div>

        <!-- Activity Log -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-50 bg-gray-50/50">
                <h3 class="font-black text-slate-900 text-sm uppercase tracking-widest">Log Aktivitas</h3>
            </div>
            <div class="p-6">
                <div class="flow-root">
                    <ul role="list" class="-mb-8">
                        @php
                            $activities = [
                                ['user' => 'Riswan', 'action' => 'Menambahkan Bisnis baru', 'target' => 'Kedai Kopi Bahagia', 'time' => '10 menit yang lalu'],
                                ['user' => 'Admin', 'action' => 'Mengedit Artikel', 'target' => 'Strategi Digital 2026', 'time' => '1 jam yang lalu'],
                                ['user' => 'System', 'action' => 'Backup database berhasil', 'target' => 'bisnisgrowth_prod', 'time' => '5 jam yang lalu'],
                            ];
                        @endphp
                        @foreach ($activities as $activity)
                        <li>
                            <div class="relative pb-8">
                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-100"></span>
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span class="h-8 w-8 rounded-full bg-amber-500 flex items-center justify-center text-white ring-8 ring-white">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-500">
                                            <span class="font-bold text-slate-900">{{ $activity['user'] }}</span> 
                                            {{ $activity['action'] }} 
                                            <span class="font-semibold text-amber-600 underline">{{ $activity['target'] }}</span>
                                        </p>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">{{ $activity['time'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
