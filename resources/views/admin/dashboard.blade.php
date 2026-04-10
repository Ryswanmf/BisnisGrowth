@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Ringkasan Dashboard')

@section('content')
<!-- Stats Grid -->
<div class="grid grid-cols-1 gap-6 sm:grid-cols-3 mb-10">
    <!-- Stat 1 -->
    <div class="bg-white overflow-hidden shadow-sm rounded-3xl border border-gray-100 p-8 flex items-center group hover:shadow-xl transition-all duration-300">
        <div class="p-4 bg-burgundy-50 rounded-2xl mr-5 group-hover:scale-110 transition-transform">
            <svg class="h-8 w-8 text-burgundy-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
        </div>
        <div>
            <p class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Total Bisnis</p>
            <p class="text-3xl font-black text-burgundy-900 leading-none">{{ $stats['total_businesses'] }}</p>
        </div>
    </div>

    <!-- Stat 2 -->
    <div class="bg-white overflow-hidden shadow-sm rounded-3xl border border-gray-100 p-8 flex items-center group hover:shadow-xl transition-all duration-300">
        <div class="p-4 bg-gold-50 rounded-2xl mr-5 group-hover:scale-110 transition-transform">
            <svg class="h-8 w-8 text-gold-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <div>
            <p class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Total Artikel</p>
            <p class="text-3xl font-black text-burgundy-900 leading-none">{{ $stats['total_articles'] }}</p>
        </div>
    </div>

    <!-- Stat 3 -->
    <div class="bg-white overflow-hidden shadow-sm rounded-3xl border border-gray-100 p-8 flex items-center group hover:shadow-xl transition-all duration-300">
        <div class="p-4 bg-gray-50 rounded-2xl mr-5 group-hover:scale-110 transition-transform">
            <svg class="h-8 w-8 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
        </div>
        <div>
            <p class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Total Views</p>
            <p class="text-3xl font-black text-burgundy-900 leading-none">{{ $stats['total_views'] }}</p>
        </div>
    </div>
</div>

<!-- Recent Views Table -->
<div class="bg-white shadow-sm rounded-3xl border border-gray-100 overflow-hidden">
    <div class="px-8 py-6 border-b border-gray-50 flex justify-between items-center bg-white">
        <div>
            <h3 class="text-base font-black text-burgundy-950 uppercase tracking-tight">Kunjungan Terakhir</h3>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1">Data real-time aktivitas pengguna</p>
        </div>
        <a href="#" class="px-4 py-2 bg-gray-50 text-[10px] font-black text-burgundy-900 hover:bg-burgundy-900 hover:text-white rounded-xl uppercase tracking-[0.2em] transition-all">Lihat Semua</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-100">
            <thead>
                <tr class="bg-gray-50/50">
                    <th class="px-8 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Bisnis</th>
                    <th class="px-8 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Waktu</th>
                    <th class="px-8 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">IP Address</th>
                    <th class="px-8 py-4 text-right text-[10px] font-black text-gray-400 uppercase tracking-widest">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-50">
                @forelse($stats['recent_views'] as $view)
                <tr class="hover:bg-gray-50/50 transition-colors group">
                    <td class="px-8 py-5 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-8 w-8 bg-burgundy-100 rounded-lg flex items-center justify-center text-burgundy-600 font-black text-xs mr-3">
                                {{ substr($view->business->name ?? '?', 0, 1) }}
                            </div>
                            <div class="text-sm font-bold text-burgundy-900">{{ $view->business->name ?? 'N/A' }}</div>
                        </div>
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap">
                        <div class="text-xs font-bold text-gray-500">{{ $view->created_at->translatedFormat('d M Y, H:i') }}</div>
                        <div class="text-[10px] font-medium text-gray-400">{{ $view->created_at->diffForHumans() }}</div>
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap">
                        <span class="px-2 py-1 bg-gray-100 rounded text-[10px] font-mono text-gray-500">{{ $view->ip_address }}</span>
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap text-right">
                        <button class="text-gray-400 hover:text-burgundy-600 transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                            </svg>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <svg class="h-12 w-12 text-gray-200 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Belum ada data kunjungan</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
