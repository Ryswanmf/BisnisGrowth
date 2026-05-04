

<?php $__env->startSection('title', 'Dashboard Admin'); ?>
<?php $__env->startSection('header', 'Ringkasan Sistem'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-10">
    
    <!-- Welcome Header -->
    <div class="bg-slate-900 p-8 md:p-12 rounded-lg shadow-2xl relative overflow-hidden text-white group">
        <div class="absolute -right-20 -top-20 h-64 w-64 bg-amber-500/10 rounded-full blur-3xl transition-all duration-700 group-hover:bg-amber-500/20"></div>
        <div class="relative z-10 max-w-2xl">
            <h2 class="text-3xl md:text-4xl font-black mb-4 tracking-tight">Selamat Datang, <?php echo e(Auth::user()->name); ?>!</h2>
            <p class="text-slate-400 text-base md:text-lg font-medium leading-relaxed mb-8">Pantau pertumbuhan ekosistem edukasi bisnis Anda secara real-time dari satu tempat pusat kendali.</p>
            <div class="flex flex-wrap gap-4">
                <a href="<?php echo e(route('admin.articles.create')); ?>" class="px-8 py-4 bg-amber-500 text-slate-900 rounded-lg text-[10px] font-black uppercase tracking-[0.2em] hover:bg-amber-400 transition-all shadow-lg shadow-amber-500/20">Tulis Artikel Baru</a>
                <a href="<?php echo e(route('admin.traffic.index')); ?>" class="px-8 py-4 bg-white/5 border border-white/10 text-white rounded-lg text-[10px] font-black uppercase tracking-[0.2em] hover:bg-white/10 transition-all">Lihat Traffic</a>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
        <div class="bg-white p-8 rounded-lg border border-gray-100 shadow-sm hover:shadow-xl transition-all">
            <p class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Konten Edukasi</p>
            <div class="flex items-center justify-between">
                <h3 class="text-4xl font-black text-slate-900 tracking-tighter"><?php echo e(number_format($stats['total_articles'])); ?></h3>
                <span class="text-[10px] font-black text-blue-500 bg-blue-50 px-2 py-1 rounded-md">Artikel</span>
            </div>
        </div>
        <div class="bg-white p-8 rounded-lg border border-gray-100 shadow-sm hover:shadow-xl transition-all">
            <p class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Total Interaksi</p>
            <div class="flex items-center justify-between">
                <h3 class="text-4xl font-black text-slate-900 tracking-tighter"><?php echo e(number_format($stats['total_interactions'])); ?></h3>
                <span class="text-[10px] font-black text-emerald-500 bg-emerald-50 px-2 py-1 rounded-md">User Klik</span>
            </div>
        </div>
        <div class="bg-white p-8 rounded-lg border border-gray-100 shadow-sm hover:shadow-xl transition-all">
            <p class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Hits Hari Ini</p>
            <div class="flex items-center justify-between">
                <h3 class="text-4xl font-black text-amber-500 tracking-tighter"><?php echo e(number_format($stats['today_hits'])); ?></h3>
                <span class="text-[10px] font-black text-amber-600 bg-amber-50 px-2 py-1 rounded-md">Traffic</span>
            </div>
        </div>
        
        <!-- Top Domain Card Integrated -->
        <div class="bg-slate-900 p-8 rounded-lg border border-slate-800 shadow-sm hover:shadow-xl transition-all text-white lg:col-span-1 xl:col-span-2">
            <div class="flex justify-between items-center mb-5">
                <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em]">Top Domain</p>
                <a href="<?php echo e(route('admin.domains.index')); ?>" class="text-[8px] font-black text-amber-500 uppercase tracking-widest hover:underline">Semua</a>
            </div>
            <div class="space-y-4">
                <?php $__currentLoopData = $stats['top_domains']->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $domain): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center justify-between gap-4 group">
                        <div class="min-w-0 flex-1">
                            <h5 class="text-xs font-bold truncate group-hover:text-amber-500 transition-colors"><?php echo e($domain->name); ?></h5>
                            <p class="text-[8px] text-slate-500 truncate"><?php echo e(str_replace(['http://', 'https://', 'www.'], '', $domain->url)); ?></p>
                        </div>
                        <div class="text-right">
                            <span class="text-sm font-black text-amber-500"><?php echo e(number_format($domain->hits_count ?? 0)); ?></span>
                            <p class="text-[7px] font-black text-slate-500 uppercase">Hits</p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if($stats['top_domains']->isEmpty()): ?>
                    <p class="text-[10px] text-slate-500 italic">Data belum tersedia</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Analytics Chart -->
    <div class="bg-white p-8 md:p-10 rounded-lg border border-gray-100 shadow-sm">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
            <div>
                <h4 class="text-xs font-black text-slate-900 uppercase tracking-widest flex items-center gap-3">
                    <span class="h-1.5 w-1.5 bg-amber-500 rounded-full"></span> Tren Traffic Pengunjung
                </h4>
                <p class="text-[10px] text-gray-400 font-medium mt-1 uppercase tracking-widest">Aktivitas 7 Hari Terakhir</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="h-2 w-2 bg-amber-500 rounded-full"></span>
                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Total Pageviews</span>
            </div>
        </div>
        <div class="h-[300px] w-full">
            <canvas id="trafficChart"></canvas>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        <!-- Recent Articles Table -->
        <div class="bg-white p-8 md:p-10 rounded-lg border border-gray-100 shadow-sm">
            <div class="flex justify-between items-center mb-10">
                <h4 class="text-xs font-black text-slate-900 uppercase tracking-widest flex items-center gap-3">
                    <span class="h-1.5 w-1.5 bg-blue-500 rounded-full"></span> Artikel Terbaru
                </h4>
                <a href="<?php echo e(route('admin.articles.index')); ?>" class="text-[9px] font-black text-amber-600 uppercase tracking-widest hover:underline">Semua</a>
            </div>
            <div class="space-y-6">
                <?php $__currentLoopData = $stats['recent_articles']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $art): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center gap-5 group">
                        <div class="h-14 w-14 bg-slate-50 rounded-lg overflow-hidden shrink-0 border border-gray-100">
                            <?php if($art->image): ?>
                                <img src="<?php echo e(asset($art->image)); ?>" class="w-full h-full object-cover">
                            <?php endif; ?>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h5 class="text-sm font-bold text-slate-900 truncate group-hover:text-amber-600 transition-colors"><?php echo e($art->title); ?></h5>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mt-1"><?php echo e($art->category_name); ?> • <?php echo e($art->created_at->diffForHumans()); ?></p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Top Performing Card -->
        <div class="bg-white p-8 md:p-10 rounded-lg border border-gray-100 shadow-sm">
            <div class="flex justify-between items-center mb-10">
                <h4 class="text-xs font-black text-slate-900 uppercase tracking-widest flex items-center gap-3">
                    <span class="h-1.5 w-1.5 bg-amber-500 rounded-full"></span> Artikel Terpopuler
                </h4>
                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Berdasarkan Klik</span>
            </div>
            <div class="space-y-6">
                <?php $__currentLoopData = $stats['top_performing_articles']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $top): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg hover:bg-amber-50 transition-all border border-transparent hover:border-amber-100 group">
                        <div class="min-w-0 flex-1 mr-4">
                            <h5 class="text-sm font-bold text-slate-900 truncate group-hover:text-amber-600 transition-colors"><?php echo e($top->title); ?></h5>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mt-1"><?php echo e($top->category_name); ?></p>
                        </div>
                        <div class="text-right shrink-0">
                            <p class="text-sm font-black text-slate-900"><?php echo e(number_format($top->click_count)); ?></p>
                            <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest">Clicks</p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('trafficChart').getContext('2d');
        const trafficChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($stats['chart_labels']); ?>,
                datasets: [{
                    label: 'Pageviews',
                    data: <?php echo json_encode($stats['chart_values']); ?>,
                    borderColor: '#f59e0b',
                    backgroundColor: 'rgba(245, 158, 11, 0.1)',
                    borderWidth: 4,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#f59e0b',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        titleFont: { size: 10, weight: 'bold' },
                        bodyFont: { size: 12, weight: 'bold' },
                        padding: 12,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + ' Kunjungan';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            color: 'rgba(0,0,0,0.03)',
                            drawBorder: false
                        },
                        ticks: {
                            font: { size: 10, weight: 'bold' },
                            color: '#94a3b8'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: { size: 10, weight: 'bold' },
                            color: '#94a3b8'
                        }
                    }
                }
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\BisnisGrowth\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>