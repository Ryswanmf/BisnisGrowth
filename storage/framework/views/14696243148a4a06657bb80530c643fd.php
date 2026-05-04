<?php $__env->startSection('title', 'Analisis Traffic'); ?>
<?php $__env->startSection('header', 'Traffic & Konversi'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-10">

    <!-- ROW 1: CONVERSION SUMMARY (ARTICLE, WA, PHONE, COMMENTS) -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-blue-600 p-8 rounded-lg shadow-xl shadow-blue-600/20 text-white relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 opacity-10 group-hover:scale-110 transition-transform">
                <svg class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2zM14 4v4h4m-4 7h.01M9 15h.01M9 11h.01M12 11h.01M12 15h.01M15 11h.01M15 15h.01"/></svg>
            </div>
            <p class="text-[10px] font-black uppercase tracking-[0.2em] mb-3 opacity-80">Total Klik Artikel</p>
            <h3 class="text-4xl font-black tracking-tighter"><?php echo e(number_format($stats['total_article_clicks'])); ?></h3>
        </div>

        <div class="bg-emerald-500 p-8 rounded-lg shadow-xl shadow-emerald-500/20 text-white relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 opacity-10 group-hover:scale-110 transition-transform">
                <svg class="h-24 w-24" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.328-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.13.57-.072 1.758-.713 2.006-1.403.248-.69.248-1.288.173-1.403-.074-.115-.272-.19-.57-.339zM12 22c-1.83 0-3.622-.47-5.202-1.363L2 22l1.393-5.113C2.493 15.298 2 13.67 2 12 2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" fill="currentColor"/></svg>
            </div>
            <p class="text-[10px] font-black uppercase tracking-[0.2em] mb-3 opacity-80">Total Klik WhatsApp</p>
            <h3 class="text-4xl font-black tracking-tighter"><?php echo e(number_format($stats['total_wa_clicks'])); ?></h3>
        </div>

        <div class="bg-amber-500 p-8 rounded-lg shadow-xl shadow-amber-500/20 text-white relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 opacity-10 group-hover:scale-110 transition-transform">
                <svg class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
            </div>
            <p class="text-[10px] font-black uppercase tracking-[0.2em] mb-3 opacity-80">Total Komentar</p>
            <h3 class="text-4xl font-black tracking-tighter"><?php echo e(number_format($stats['total_comments'])); ?></h3>
        </div>

        <div class="bg-slate-800 p-8 rounded-lg shadow-xl shadow-slate-800/20 text-white relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 opacity-10 group-hover:scale-110 transition-transform">
                <svg class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            </div>
            <p class="text-[10px] font-black uppercase tracking-[0.2em] mb-3 opacity-80">Total Klik Telepon</p>
            <h3 class="text-4xl font-black tracking-tighter"><?php echo e(number_format($stats['total_phone_clicks'])); ?></h3>
        </div>
    </div>

    <!-- ROW 2: CHARTS -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white p-8 md:p-10 rounded-lg shadow-sm border border-gray-100">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
                <div>
                    <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-1">Tren Aktivitas</h4>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Visualisasi interaksi pengunjung</p>
                </div>
                <div class="flex bg-slate-100 p-1.5 rounded-lg">
                    <button onclick="updateTrend('daily')" id="btn-daily" class="px-5 py-2 text-[10px] font-black uppercase tracking-widest rounded-lg transition-all bg-white text-slate-900 shadow-sm">Harian</button>
                    <button onclick="updateTrend('weekly')" id="btn-weekly" class="px-5 py-2 text-[10px] font-black uppercase tracking-widest rounded-lg transition-all text-gray-400 hover:text-slate-600">Mingguan</button>
                    <button onclick="updateTrend('monthly')" id="btn-monthly" class="px-5 py-2 text-[10px] font-black uppercase tracking-widest rounded-lg transition-all text-gray-400 hover:text-slate-600">Tahunan</button>
                </div>
            </div>
            <div class="h-[350px] w-full"><canvas id="trafficChart"></canvas></div>
        </div>

        <div class="bg-white p-8 md:p-10 rounded-lg shadow-sm border border-gray-100">
            <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-12 text-center">Komposisi Interaksi</h4>
            <div class="h-[250px] w-full flex items-center justify-center relative">
                <canvas id="interactionChart"></canvas>
                <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none mt-2">
                    <span class="text-2xl font-black text-slate-900"><?php echo e(number_format($stats['total_article_clicks'] + $stats['total_wa_clicks'] + $stats['total_phone_clicks'])); ?></span>
                    <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest">Total Klik</span>
                </div>
            </div>
            <div class="mt-10 space-y-4 px-2">
                <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-widest">
                    <div class="flex items-center gap-3"><span class="h-2 w-2 rounded-full bg-blue-500"></span><span class="text-gray-400">Klik Artikel</span></div>
                    <span class="text-slate-900"><?php echo e(number_format($stats['total_article_clicks'])); ?></span>
                </div>
                <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-widest">
                    <div class="flex items-center gap-3"><span class="h-2 w-2 rounded-full bg-emerald-500"></span><span class="text-gray-400">Klik WhatsApp</span></div>
                    <span class="text-slate-900"><?php echo e(number_format($stats['total_wa_clicks'])); ?></span>
                </div>
                <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-widest">
                    <div class="flex items-center gap-3"><span class="h-2 w-2 rounded-full bg-slate-400"></span><span class="text-gray-400">Klik Telepon</span></div>
                    <span class="text-slate-900"><?php echo e(number_format($stats['total_phone_clicks'])); ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- ROW 3: DEVICES & TOP PAGES -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white p-8 md:p-10 rounded-lg shadow-sm border border-gray-100">
            <h4 class="text-xs font-black text-slate-900 uppercase tracking-widest mb-10">Distribusi Perangkat</h4>
            <div class="h-[200px]"><canvas id="deviceChart"></canvas></div>
        </div>

        <div class="bg-white p-8 md:p-10 rounded-lg shadow-sm border border-gray-100">
            <h4 class="text-xs font-black text-slate-900 uppercase tracking-widest mb-8">Halaman Populer</h4>
            <div class="space-y-4">
                <?php $__currentLoopData = $topPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-transparent group hover:border-amber-100 hover:bg-amber-50 transition-all">
                        <span class="text-xs font-bold text-slate-600 truncate max-w-[200px] group-hover:text-slate-900"><?php echo e($page->url ?: '/'); ?></span>
                        <span class="text-xs font-black text-slate-900 bg-white px-4 py-1.5 rounded-lg shadow-sm border border-gray-100"><?php echo e(number_format($page->total)); ?> Hits</span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <!-- ROW 4: DOMAIN RANKING -->
    <div class="bg-white p-8 md:p-10 rounded-lg shadow-sm border border-gray-100">
        <div class="flex justify-between items-center mb-10">
            <div>
                <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-1">Peringkat Domain</h4>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Berdasarkan akumulasi klik pada seluruh artikel</p>
            </div>
            <a href="<?php echo e(route('admin.domains.index')); ?>" class="text-[10px] font-black text-amber-600 uppercase tracking-widest hover:underline">Kelola Domain</a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="px-4 py-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Peringkat</th>
                        <th class="px-4 py-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Domain</th>
                        <th class="px-4 py-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">URL Dasar</th>
                        <th class="px-4 py-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-right">Total Klik</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php $__currentLoopData = $topDomains; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $domain): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-4 py-4">
                                <span class="flex items-center justify-center h-6 w-6 rounded-full <?php echo e($index < 3 ? 'bg-amber-500 text-slate-900' : 'bg-slate-100 text-slate-400'); ?> text-[10px] font-black">
                                    <?php echo e($index + 1); ?>

                                </span>
                            </td>
                            <td class="px-4 py-4 text-sm font-bold text-slate-900 group-hover:text-amber-600 transition-colors">
                                <?php echo e($domain->name); ?>

                            </td>
                            <td class="px-4 py-4">
                                <code class="text-[10px] bg-slate-100 px-2 py-1 rounded text-slate-500 font-bold group-hover:bg-white transition-colors"><?php echo e($domain->url); ?></code>
                            </td>
                            <td class="px-4 py-4 text-right">
                                <span class="text-sm font-black text-slate-900"><?php echo e(number_format($domain->hits_count ?? 0)); ?></span>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if($topDomains->isEmpty()): ?>
                        <tr>
                            <td colspan="4" class="px-4 py-12 text-center text-gray-400 font-bold italic text-xs">Belum ada data domain.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Scripts Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const trendData = {
        daily: {
            labels: <?php echo json_encode($dailyTrend->pluck('label')); ?>,
            views: <?php echo json_encode($dailyTrend->pluck('views')); ?>,
            articles: <?php echo json_encode($dailyTrend->pluck('articles')); ?>,
            whatsapp: <?php echo json_encode($dailyTrend->pluck('whatsapp')); ?>,
            phone: <?php echo json_encode($dailyTrend->pluck('phone')); ?>,
            comments: <?php echo json_encode($dailyTrend->pluck('comments')); ?>

        },
        weekly: {
            labels: <?php echo json_encode($weeklyTrend->pluck('label')); ?>,
            views: <?php echo json_encode($weeklyTrend->pluck('views')); ?>,
            articles: <?php echo json_encode($weeklyTrend->pluck('articles')); ?>,
            whatsapp: <?php echo json_encode($weeklyTrend->pluck('whatsapp')); ?>,
            phone: <?php echo json_encode($weeklyTrend->pluck('phone')); ?>,
            comments: <?php echo json_encode($weeklyTrend->pluck('comments')); ?>

        },
        monthly: {
            labels: <?php echo json_encode($monthlyTrend->pluck('label')); ?>,
            views: <?php echo json_encode($monthlyTrend->pluck('views')); ?>,
            articles: <?php echo json_encode($monthlyTrend->pluck('articles')); ?>,
            whatsapp: <?php echo json_encode($monthlyTrend->pluck('whatsapp')); ?>,
            phone: <?php echo json_encode($monthlyTrend->pluck('phone')); ?>,
            comments: <?php echo json_encode($monthlyTrend->pluck('comments')); ?>

        }
    };

    let mainChart;
    function initMainChart(range = 'daily') {
        const ctx = document.getElementById('trafficChart').getContext('2d');
        const data = trendData[range];
        
        // Create Gradient
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(245, 158, 11, 0.2)');
        gradient.addColorStop(1, 'rgba(245, 158, 11, 0)');

        if (mainChart) mainChart.destroy();
        mainChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [
                    { 
                        label: 'Hits', 
                        data: data.views, 
                        borderColor: '#f59e0b', 
                        borderWidth: 4, 
                        tension: 0.45, 
                        fill: true, 
                        backgroundColor: gradient, 
                        pointRadius: 0, 
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#f59e0b',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 3,
                    },
                    { 
                        label: 'Artikel', 
                        data: data.articles, 
                        borderColor: '#3b82f6', 
                        borderWidth: 2, 
                        borderDash: [5, 5],
                        tension: 0.45, 
                        fill: false, 
                        pointRadius: 0,
                        pointHoverRadius: 4
                    },
                    { 
                        label: 'WhatsApp', 
                        data: data.whatsapp, 
                        borderColor: '#10b981', 
                        borderWidth: 2, 
                        tension: 0.45, 
                        fill: false, 
                        pointRadius: 0,
                        pointHoverRadius: 4
                    }
                ]
            },
            options: {
                responsive: true, 
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                plugins: { 
                    legend: { 
                        display: true, 
                        position: 'top', 
                        align: 'end', 
                        labels: { 
                            font: { size: 10, weight: '700', family: "'Inter', sans-serif" }, 
                            usePointStyle: true, 
                            boxWidth: 6,
                            padding: 20
                        } 
                    },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        titleFont: { size: 12, weight: '900', family: "'Inter', sans-serif" },
                        bodyFont: { size: 11, weight: '500', family: "'Inter', sans-serif" },
                        padding: 12,
                        cornerRadius: 12,
                        displayColors: true,
                        usePointStyle: true
                    }
                },
                scales: {
                    y: { 
                        beginAtZero: true, 
                        grid: { borderDash: [5, 5], color: 'rgba(0,0,0,0.05)', drawBorder: false }, 
                        ticks: { padding: 10, font: { weight: '600', size: 10, family: "'Inter', sans-serif" }, color: '#94a3b8' } 
                    },
                    x: { 
                        grid: { display: false }, 
                        ticks: { padding: 10, font: { weight: '600', size: 10, family: "'Inter', sans-serif" }, color: '#94a3b8' } 
                    }
                }
            }
        });
    }

    function updateTrend(range) {
        ['daily', 'weekly', 'monthly'].forEach(r => {
            const btn = document.getElementById('btn-' + r);
            if (r === range) { btn.classList.add('bg-white', 'text-slate-900', 'shadow-sm'); btn.classList.remove('text-gray-400'); }
            else { btn.classList.remove('bg-white', 'text-slate-900', 'shadow-sm'); btn.classList.add('text-gray-400'); }
        });
        initMainChart(range);
    }

    document.addEventListener('DOMContentLoaded', () => {
        initMainChart('daily');
        new Chart(document.getElementById('interactionChart'), {
            type: 'doughnut',
            data: {
                labels: ['Artikel', 'WA', 'Telp'],
                datasets: [{ data: [<?php echo e($stats['total_article_clicks']); ?>, <?php echo e($stats['total_wa_clicks']); ?>, <?php echo e($stats['total_phone_clicks']); ?>], backgroundColor: ['#3b82f6', '#10b981', '#94a3b8'], borderWidth: 8, borderColor: '#ffffff', hoverOffset: 15 }]
            },
            options: { cutout: '85%', responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
        });
        new Chart(document.getElementById('deviceChart'), {
            type: 'bar',
            data: { labels: <?php echo json_encode($devices->pluck('device')); ?>, datasets: [{ data: <?php echo json_encode($devices->pluck('total')); ?>, backgroundColor: '#0f172a', borderRadius: 12 }] },
            options: { indexAxis: 'y', responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { x: { grid: { display: false }, ticks: { font: { weight: '900', size: 10 } } }, y: { grid: { display: false }, ticks: { font: { weight: '900', size: 10 } } } } }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\BisnisGrowth\resources\views/admin/traffic/index.blade.php ENDPATH**/ ?>