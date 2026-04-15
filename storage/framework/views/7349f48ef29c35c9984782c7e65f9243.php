<?php if (isset($component)) { $__componentOriginal4619374cef299e94fd7263111d0abc69 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4619374cef299e94fd7263111d0abc69 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('seo', null, []); ?> 
        <?php if (isset($component)) { $__componentOriginal4232ba5ed77147a6b6573253fafb715d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4232ba5ed77147a6b6573253fafb715d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo-head','data' => ['title' => 'Wawasan Bisnis & Strategi UMKM Indonesia','description' => 'BisnisGrowth — Solusi direktori UMKM dan portal edukasi bisnis terpercaya di Indonesia. Temukan strategi pemasaran, manajemen keuangan, dan tips sukses bisnis lokal.','ogImage' => asset('images/Logo_Bisnis_Growth.png')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo-head'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Wawasan Bisnis & Strategi UMKM Indonesia','description' => 'BisnisGrowth — Solusi direktori UMKM dan portal edukasi bisnis terpercaya di Indonesia. Temukan strategi pemasaran, manajemen keuangan, dan tips sukses bisnis lokal.','ogImage' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(asset('images/Logo_Bisnis_Growth.png'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4232ba5ed77147a6b6573253fafb715d)): ?>
<?php $attributes = $__attributesOriginal4232ba5ed77147a6b6573253fafb715d; ?>
<?php unset($__attributesOriginal4232ba5ed77147a6b6573253fafb715d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4232ba5ed77147a6b6573253fafb715d)): ?>
<?php $component = $__componentOriginal4232ba5ed77147a6b6573253fafb715d; ?>
<?php unset($__componentOriginal4232ba5ed77147a6b6573253fafb715d); ?>
<?php endif; ?>
     <?php $__env->endSlot(); ?>

    <!-- Hero Section: Featured + Sidebar Grid -->
    <section class="bg-white py-10 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- Main Featured (Left) -->
                <?php if($featuredArticle): ?>
                <div class="lg:col-span-8">
                    <a href="javascript:void(0)" onclick="trackArticleClick(<?php echo e($featuredArticle['id']); ?>, '<?php echo e(route('article.show', $featuredArticle['slug'])); ?>')" class="group relative block overflow-hidden rounded-3xl bg-slate-100 h-[300px] md:h-[500px] shadow-xl">
                        <?php if($featuredArticle['image']): ?>
                            <img src="<?php echo e(asset('storage/' . $featuredArticle['image'])); ?>" alt="<?php echo e($featuredArticle['title']); ?>" 
                                 class="absolute inset-0 h-full w-full object-cover opacity-80 transition-transform duration-700 group-hover:scale-105"
                                 loading="eager" fetchpriority="high" decoding="async">
                        <?php endif; ?>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>
                        
                        <div class="absolute bottom-0 p-5 md:p-10 lg:p-12 max-w-2xl">
                            <span class="inline-block px-3 py-1 mb-3 md:mb-4 text-[9px] md:text-[10px] font-black uppercase tracking-[0.2em] text-burgundy-900 bg-amber-400 rounded-md">
                                UTAMA • <?php echo e($featuredArticle['category_name']); ?>

                            </span>
                            <h1 class="text-xl sm:text-2xl md:text-4xl font-black text-white mb-3 md:mb-4 leading-tight group-hover:text-amber-100 transition-colors">
                                <?php echo e($featuredArticle['title']); ?>

                            </h1>
                            <p class="text-gray-300 text-sm md:text-base line-clamp-2 font-medium opacity-90 hidden sm:block">
                                <?php echo e($featuredArticle['excerpt']); ?>

                            </p>
                        </div>
                    </a>
                </div>
                <?php endif; ?>

                <!-- Sidebar Grid (Right) -->
                <div class="lg:col-span-4 flex flex-col gap-6">
                    <div class="flex items-center gap-4 mb-2">
                        <h3 class="text-xs font-black uppercase tracking-[0.3em] text-burgundy-600">Terpopuler</h3>
                        <div class="h-px flex-grow bg-gray-100"></div>
                    </div>
                    
                    <?php $__currentLoopData = $sidebarArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sideArticle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="javascript:void(0)" onclick="trackArticleClick(<?php echo e($sideArticle['id']); ?>, '<?php echo e(route('article.show', $sideArticle['slug'])); ?>')" class="group flex gap-4 items-center">
                        <div class="shrink-0 w-24 h-24 rounded-2xl overflow-hidden shadow-sm bg-gray-50">
                            <?php if($sideArticle['image']): ?>
                                <img src="<?php echo e(asset('storage/' . $sideArticle['image'])); ?>" alt="<?php echo e($sideArticle['title']); ?>" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                     loading="lazy" decoding="async">
                            <?php endif; ?>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-[9px] font-black uppercase text-amber-600 tracking-widest"><?php echo e($sideArticle['category_name']); ?></span>
                            <h4 class="text-sm font-bold text-slate-900 leading-snug group-hover:text-amber-600 transition-colors line-clamp-2">
                                <?php echo e($sideArticle['title']); ?>

                            </h4>
                            <span class="text-[9px] text-gray-400 font-bold"><?php echo e(\Carbon\Carbon::parse($sideArticle['published_at'] ?? $sideArticle['created_at'])->format('d M Y')); ?></span>
                        </div>
                    </a>
                    <?php if(!$loop->last): ?> <div class="h-px w-full bg-gray-50"></div> <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="mt-auto">
                        <a href="<?php echo e(route('article.index')); ?>" class="flex items-center justify-center w-full py-4 bg-gray-50 rounded-2xl text-[10px] font-black uppercase tracking-widest text-slate-900 hover:bg-gray-100 transition-colors">
                            Lihat Semua Wawasan
                            <svg class="h-3 w-3 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Articles Section -->
    <section class="py-16 px-4 bg-gray-50/50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-12">
                <div class="flex flex-col">
                    <span class="text-amber-600 text-[10px] font-black uppercase tracking-[0.3em] mb-2">Teranyar</span>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tight uppercase">Artikel Terbaru</h2>
                </div>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 md:gap-6">
                <?php $__currentLoopData = $articlesData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="group bg-white rounded-xl overflow-hidden border border-gray-100 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex flex-col h-full">
                    <a href="javascript:void(0)" onclick="trackArticleClick(<?php echo e($article['id']); ?>, '<?php echo e(route('article.show', $article['slug'])); ?>')" class="relative aspect-[16/10] overflow-hidden block bg-gray-50">
                        <?php if($article['image']): ?>
                            <img src="<?php echo e(asset('storage/' . $article['image'])); ?>" alt="<?php echo e($article['title']); ?>" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" 
                                 loading="lazy" decoding="async">
                        <?php endif; ?>
                        <div class="absolute top-2 left-2">
                            <span class="px-2 py-0.5 bg-white/90 backdrop-blur-sm text-[7px] md:text-[9px] font-black uppercase tracking-wider text-slate-900 rounded shadow-sm">
                                <?php echo e($article['category_name']); ?>

                            </span>
                        </div>
                    </a>
                    
                    <div class="p-3 md:p-5 flex-grow flex flex-col">
                        <div class="flex items-center text-gray-400 text-[7px] md:text-[9px] font-bold uppercase tracking-widest mb-2 md:mb-3">
                            <span><?php echo e(\Carbon\Carbon::parse($article['published_at'] ?? $article['created_at'])->format('d M y')); ?></span>
                            <span class="mx-1 text-amber-400">•</span>
                            <span><?php echo e(number_format($article['click_count'])); ?> Klik</span>
                        </div>
                        
                        <h3 class="text-xs md:text-lg font-bold text-slate-900 mb-1 md:mb-2 leading-snug group-hover:text-amber-600 transition-colors line-clamp-2">
                            <a href="javascript:void(0)" onclick="trackArticleClick(<?php echo e($article['id']); ?>, '<?php echo e(route('article.show', $article['slug'])); ?>')"><?php echo e($article['title']); ?></a>
                        </h3>
                        
                        <p class="text-gray-500 text-[10px] md:text-xs leading-relaxed line-clamp-2 mb-3 hidden md:block">
                            <?php echo e($article['excerpt']); ?>

                        </p>

                        <div class="mt-auto pt-3 border-t border-gray-50">
                            <a href="javascript:void(0)" onclick="trackArticleClick(<?php echo e($article['id']); ?>, '<?php echo e(route('article.show', $article['slug'])); ?>')" class="inline-flex items-center text-[8px] md:text-[10px] font-black text-amber-600 uppercase tracking-widest hover:text-amber-800 transition-colors group">
                                Baca
                                <svg class="h-2.5 w-2.5 ml-1 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Premium Pagination -->
            <div class="mt-24 flex justify-center">
                <div class="pagination-amber-theme bg-slate-900 p-2 rounded-2xl shadow-2xl shadow-slate-900/40 border border-slate-800">
                    <?php echo $links; ?>

                </div>
            </div>
        </div>
    </section>

    <style>
        .pagination-amber-theme nav div div span.relative.z-0, 
        .pagination-amber-theme nav div div a.relative.z-0 {
            display: flex; gap: 4px; border: none;
        }
        .pagination-amber-theme nav span[aria-current="page"] span {
            background-color: #f59e0b !important; color: #0f172a !important; border-radius: 12px; border: none !important; font-weight: 900; padding: 8px 16px;
        }
        .pagination-amber-theme nav a, 
        .pagination-amber-theme nav span.relative.inline-flex {
            background-color: transparent !important; color: #94a3b8 !important; border: none !important; border-radius: 12px; padding: 8px 16px; font-weight: 700; transition: all 0.3s;
        }
        .pagination-amber-theme nav a:hover {
            background-color: rgba(255,255,255,0.05) !important; color: #ffffff !important;
        }
        .pagination-amber-theme nav div:first-child { display: none !important; }
        .pagination-amber-theme nav div:last-child { display: flex !important; justify-content: center; }
    </style>

    <script>
        function trackArticleClick(id, url) {
            fetch('/artikel/' + id + '/track-click', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({ type: 'article' })
            }).finally(() => {
                window.location.href = url;
            });
        }
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $attributes = $__attributesOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__attributesOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $component = $__componentOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__componentOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php /**PATH D:\laragon\www\BisnisGrowth\resources\views/pages/home.blade.php ENDPATH**/ ?>