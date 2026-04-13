@extends('layouts.admin')

@section('title', 'Analisis Traffic')
@section('header', 'Traffic & Konversi')

@section('content')
<div class="space-y-10">
    
    <!-- ROW 1: CONVERSION CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-blue-600 p-8 rounded-[2.5rem] shadow-xl shadow-blue-600/20 text-white relative overflow-hidden group">
            <p class="text-[10px] font-black uppercase tracking-[0.2em] mb-3 opacity-80">Total Klik Artikel</p>
            <h3 class="text-4xl font-black tracking-tighter">{{ number_format($stats['total_article_clicks']) }}</h3>
            <div class="absolute -right-4 -top-4 opacity-10 group-hover:scale-110 transition-transform">
                <svg class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2zM14 4v4h4m-4 7h.01M9 15h.01M9 11h.01M12 11h.01M12 15h.01M15 11h.01M15 15h.01"/></svg>
            </div>
        </div>
        <div class="bg-emerald-500 p-8 rounded-[2.5rem] shadow-xl shadow-emerald-500/20 text-white relative overflow-hidden group">
            <p class="text-[10px] font-black uppercase tracking-[0.2em] mb-3 opacity-80">Total Klik WhatsApp</p>
            <h3 class="text-4xl font-black tracking-tighter">{{ number_format($stats['total_wa_clicks']) }}</h3>
            <div class="absolute -right-4 -top-4 opacity-10 group-hover:scale-110 transition-transform">
                <svg class="h-24 w-24" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.328-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.13.57-.072 1.758-.713 2.006-1.403.248-.69.248-1.288.173-1.403-.074-.115-.272-.19-.57-.339zM12 22c-1.83 0-3.622-.47-5.202-1.363L2 22l1.393-5.113C2.493 15.298 2 13.67 2 12 2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
            </div>
        </div>
        <div class="bg-slate-800 p-8 rounded-[2.5rem] shadow-xl shadow-slate-800/20 text-white relative overflow-hidden group">
            <p class="text-[10px] font-black uppercase tracking-[0.2em] mb-3 opacity-80">Total Klik Telepon</p>
            <h3 class="text-4xl font-black tracking-tighter">{{ number_format($stats['total_phone_clicks']) }}</h3>
            <div class="absolute -right-4 -top-4 opacity-10 group-hover:scale-110 transition-transform">
                <svg class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            </div>
        </div>
    </div>

    <!-- ROW 3: TREND CHART & DONUT -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Area Chart -->
        <div class="lg:col-span-2 bg-white p-8 md:p-10 rounded-[3rem] shadow-sm border border-gray-100">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
                <div>
                    <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-1">Tren Aktivitas</h4>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Visualisasi interaksi pengunjung</p>
                </div>
                
                <div class="flex bg-slate-100 p-1.5 rounded-2xl">
                    <button onclick="updateTrend('daily')" id="btn-daily" class="px-5 py-2 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all bg-white text-slate-900 shadow-sm">Harian</button>
                    <button onclick="updateTrend('weekly')" id="btn-weekly" class="px-5 py-2 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all text-gray-400 hover:text-slate-600">Mingguan</button>
                    <button onclick="updateTrend('monthly')" id="btn-monthly" class="px-5 py-2 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all text-gray-400 hover:text-slate-600">Tahunan</button>
                </div>
            </div>
            
            <div class="h-[400px] w-full">
                <canvas id="trafficChart"></canvas>
            </div>
        </div>

        <!-- Composition Donut -->
        <div class="bg-white p-8 md:p-10 rounded-[3rem] shadow-sm border border-gray-100">
            <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-12 text-center">Komposisi Interaksi</h4>
            <div class="h-[280px] w-full flex items-center justify-center relative">
                <canvas id="interactionChart"></canvas>
                <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                    <span class="text-3xl font-black text-slate-900">{{ number_format($stats['total_article_clicks'] + $stats['total_wa_clicks'] + $stats['total_phone_clicks']) }}</span>
                    <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Total Klik</span>
                </div>
            </div>
            <div class="mt-10 space-y-4">
                <div class="flex justify-between items-center text-[10px] font-black uppercase">
                    <div class="flex items-center gap-3">
                        <span class="h-2.5 w-2.5 rounded-full bg-blue-500 shadow-lg shadow-blue-500/50"></span>
                        <span class="text-gray-400">Klik Artikel</span>
                    </div>
                    <span class="text-slate-900">{{ number_format($stats['total_article_clicks']) }}</span>
                </div>
                <div class="flex justify-between items-center text-[10px] font-black uppercase">
                    <div class="flex items-center gap-3">
                        <span class="h-2.5 w-2.5 rounded-full bg-emerald-500 shadow-lg shadow-emerald-500/50"></span>
                        <span class="text-gray-400">Klik WhatsApp</span>
                    </div>
                    <span class="text-slate-900">{{ number_format($stats['total_wa_clicks']) }}</span>
                </div>
                <div class="flex justify-between items-center text-[10px] font-black uppercase">
                    <div class="flex items-center gap-3">
                        <span class="h-2.5 w-2.5 rounded-full bg-slate-400 shadow-lg shadow-slate-400/50"></span>
                        <span class="text-gray-400">Klik Telepon</span>
                    </div>
                    <span class="text-slate-900">{{ number_format($stats['total_phone_clicks']) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ROW 4: DEVICE & PAGES -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white p-8 md:p-10 rounded-[3rem] shadow-sm border border-gray-100">
            <h4 class="text-xs font-black text-slate-900 uppercase tracking-widest mb-10">Distribusi Perangkat</h4>
            <div class="h-[250px]">
                <canvas id="deviceChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-8 md:p-10 rounded-[3rem] shadow-sm border border-gray-100">
            <h4 class="text-xs font-black text-slate-900 uppercase tracking-widest mb-8">Halaman Populer</h4>
            <div class="space-y-4">
                @foreach($topPages as $page)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-transparent group hover:border-amber-100 hover:bg-amber-50 transition-all">
                        <div class="flex flex-col min-w-0">
                            <span class="text-xs font-black text-slate-900 truncate group-hover:text-amber-600 transition-colors">{{ $page->url ?: '/' }}</span>
                            <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mt-1">Halaman Aktif</span>
                        </div>
                        <span class="text-xs font-black text-slate-900 bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-100">{{ number_format($page->total) }} Hits</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data dari Laravel
    const trendData = {
        daily: {
            labels: {!! json_encode($dailyTrend->pluck('label')) !!},
            views: {!! json_encode($dailyTrend->pluck('views')) !!},
            articles: {!! json_encode($dailyTrend->pluck('articles')) !!},
            whatsapp: {!! json_encode($dailyTrend->pluck('whatsapp')) !!},
            phone: {!! json_encode($dailyTrend->pluck('phone')) !!}
        },
        weekly: {
            labels: {!! json_encode($weeklyTrend->pluck('label')) !!},
            views: {!! json_encode($weeklyTrend->pluck('views')) !!},
            articles: {!! json_encode($weeklyTrend->pluck('articles')) !!},
            whatsapp: {!! json_encode($weeklyTrend->pluck('whatsapp')) !!},
            phone: {!! json_encode($weeklyTrend->pluck('phone')) !!}
        },
        monthly: {
            labels: {!! json_encode($monthlyTrend->pluck('label')) !!},
            views: {!! json_encode($monthlyTrend->pluck('views')) !!},
            articles: {!! json_encode($monthlyTrend->pluck('articles')) !!},
            whatsapp: {!! json_encode($monthlyTrend->pluck('whatsapp')) !!},
            phone: {!! json_encode($monthlyTrend->pluck('phone')) !!}
        }
    };

    let mainChart;

    function initMainChart(range = 'daily') {
        const canvas = document.getElementById('trafficChart');
        const ctx = canvas.getContext('2d');
        const data = trendData[range];

        if (mainChart) mainChart.destroy();

        // Create Gradients
        const gradAmber = ctx.createLinearGradient(0, 0, 0, 400);
        gradAmber.addColorStop(0, 'rgba(245, 158, 11, 0.1)');
        gradAmber.addColorStop(1, 'rgba(245, 158, 11, 0)');

        const gradBlue = ctx.createLinearGradient(0, 0, 0, 400);
        gradBlue.addColorStop(0, 'rgba(59, 130, 246, 0.1)');
        gradBlue.addColorStop(1, 'rgba(59, 130, 246, 0)');

        mainChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [
                    {
                        label: 'Hits Website',
                        data: data.views,
                        borderColor: '#f59e0b',
                        backgroundColor: gradAmber,
                        borderWidth: 4,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 0,
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#f59e0b',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 3
                    },
                    {
                        label: 'Klik Artikel',
                        data: data.articles,
                        borderColor: '#3b82f6',
                        backgroundColor: gradBlue,
                        borderWidth: 4,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 0,
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#3b82f6',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 3
                    },
                    {
                        label: 'Klik WA',
                        data: data.whatsapp,
                        borderColor: '#10b981',
                        borderWidth: 3,
                        borderDash: [5, 5],
                        tension: 0.4,
                        fill: false,
                        pointRadius: 0
                    },
                    {
                        label: 'Klik Telp',
                        data: data.phone,
                        borderColor: '#94a3b8',
                        borderWidth: 3,
                        borderDash: [5, 5],
                        tension: 0.4,
                        fill: false,
                        pointRadius: 0
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { intersect: false, mode: 'index' },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        align: 'end',
                        labels: { font: { size: 10, weight: '900' }, usePointStyle: true, boxWidth: 6, padding: 20 }
                    },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        titleFont: { size: 12, weight: 'bold' },
                        bodyFont: { size: 12 },
                        padding: 12,
                        cornerRadius: 12,
                        displayColors: true
                    }
                },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.03)' }, ticks: { font: { weight: '900', size: 10 }, padding: 10 } },
                    x: { grid: { display: false }, ticks: { font: { weight: '900', size: 10 }, padding: 10 } }
                }
            }
        });
    }

    function updateTrend(range) {
        ['daily', 'weekly', 'monthly'].forEach(r => {
            const btn = document.getElementById('btn-' + r);
            if (r === range) {
                btn.classList.add('bg-white', 'text-slate-900', 'shadow-sm');
                btn.classList.remove('text-gray-400');
            } else {
                btn.classList.remove('bg-white', 'text-slate-900', 'shadow-sm');
                btn.classList.add('text-gray-400');
            }
        });
        initMainChart(range);
    }

    document.addEventListener('DOMContentLoaded', () => {
        initMainChart('daily');

        // Donut Chart
        new Chart(document.getElementById('interactionChart'), {
            type: 'doughnut',
            data: {
                labels: ['Artikel', 'WA', 'Telp'],
                datasets: [{
                    data: [{{ $stats['total_article_clicks'] }}, {{ $stats['total_wa_clicks'] }}, {{ $stats['total_phone_clicks'] }}],
                    backgroundColor: ['#3b82f6', '#10b981', '#94a3b8'],
                    borderWidth: 10,
                    borderColor: '#ffffff',
                    hoverOffset: 20
                }]
            },
            options: {
                cutout: '85%',
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } }
            }
        });

        // Device Chart
        new Chart(document.getElementById('deviceChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($devices->pluck('device')) !!},
                datasets: [{
                    data: {!! json_encode($devices->pluck('total')) !!},
                    backgroundColor: '#0f172a',
                    borderRadius: 12,
                    barThickness: 20
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { weight: '900', size: 10 } } },
                    y: { grid: { display: false }, ticks: { font: { weight: '900', size: 10 } } }
                }
            }
        });
    });
</script>
@endsection
