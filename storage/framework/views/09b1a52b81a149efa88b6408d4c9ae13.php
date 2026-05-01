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
     <?php $__env->slot('title', null, []); ?> Artikel & Edukasi Bisnis — BisnisGrowth <?php $__env->endSlot(); ?>

    <section class="py-10 bg-gray-50">
        <div class="max-w-[1600px] mx-auto px-6">
            <!-- Header -->
            <div class="text-center max-w-3xl mx-auto mb-10">
                <span class="text-amber-600 text-[10px] font-black uppercase tracking-[0.3em] mb-2 block text-center">Wawasan Bisnis</span>
                <h1 class="text-3xl md:text-5xl font-black text-slate-900 tracking-tight mb-4 leading-tight">
                    Edukasi & <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-500 to-amber-700">Strategi Pertumbuhan</span>
                </h1>
            </div>

            <div class="flex flex-col lg:flex-row gap-10">
                <!-- SIDEBAR FILTER -->
                <aside class="w-full lg:w-80 shrink-0">
                    <div class="sticky top-24 space-y-8">
                        
                        <!-- Search Box -->
                        <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100">
                            <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-6">Cari Artikel</h4>
                            <form action="<?php echo e(route('article.index')); ?>" method="GET" class="relative">
                                <?php if(request('category')): ?> <input type="hidden" name="category" value="<?php echo e(request('category')); ?>"> <?php endif; ?>
                                <?php if(request('sort')): ?> <input type="hidden" name="sort" value="<?php echo e(request('sort')); ?>"> <?php endif; ?>
                                
                                <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Ketik kata kunci..." 
                                       class="w-full bg-gray-50 border-none rounded px-5 py-4 text-sm focus:ring-2 focus:ring-amber-500 font-medium">
                                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-amber-600">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                </button>
                            </form>
                        </div>

                        <!-- Category Dropdown -->
                        <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100">
                            <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-6">Kategori Bisnis</h4>
                            <div class="relative group">
                                <select onchange="window.location.href = this.value" 
                                        class="w-full bg-gray-50 border-none rounded px-5 py-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-amber-500 appearance-none cursor-pointer">
                                    <option value="<?php echo e(request()->fullUrlWithQuery(['category' => null, 'page' => null])); ?>">Semua Kategori</option>
                                    <?php $__currentLoopData = $categoriesWithCount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(request()->fullUrlWithQuery(['category' => $cat['category_name'], 'page' => null])); ?>" 
                                                <?php echo e(request('category') == $cat['category_name'] ? 'selected' : ''); ?>>
                                            <?php echo e($cat['category_name']); ?> (<?php echo e($cat['total']); ?>)
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-amber-600">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Sort Dropdown -->
                        <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100">
                            <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-6">Urutkan Berdasarkan</h4>
                            <div class="relative group">
                                <select onchange="window.location.href = this.value" 
                                        class="w-full bg-slate-900 text-white border-none rounded px-5 py-4 text-xs font-black uppercase tracking-widest focus:ring-2 focus:ring-amber-500 appearance-none cursor-pointer">
                                    <option value="<?php echo e(request()->fullUrlWithQuery(['sort' => 'latest', 'page' => null])); ?>" <?php echo e(request('sort') == 'latest' ? 'selected' : ''); ?>>Terbaru</option>
                                    <option value="<?php echo e(request()->fullUrlWithQuery(['sort' => 'popular', 'page' => null])); ?>" <?php echo e(request('sort') == 'popular' ? 'selected' : ''); ?>>Terpopuler</option>
                                    <option value="<?php echo e(request()->fullUrlWithQuery(['sort' => 'oldest', 'page' => null])); ?>" <?php echo e(request('sort') == 'oldest' ? 'selected' : ''); ?>>Terlama</option>
                                </select>
                                <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-amber-500">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>
                        </div>

                        <?php if(request('q') || request('category')): ?>
                            <a href="<?php echo e(route('article.index')); ?>" class="flex items-center justify-center gap-2 w-full py-4 text-[10px] font-black uppercase tracking-widest text-red-500 bg-red-50 rounded hover:bg-red-100 transition-all">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                Bersihkan Filter
                            </a>
                        <?php endif; ?>

                    </div>
                </aside>

                <!-- MAIN CONTENT (ARTICLE GRID) -->
                <div class="flex-1">
                    <?php if(request('q') || request('category')): ?>
                        <div class="mb-8 flex items-center gap-2">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Hasil Filter:</span>
                            <?php if(request('category')): ?>
                                <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded text-[10px] font-black uppercase tracking-widest"><?php echo e(request('category')); ?></span>
                            <?php endif; ?>
                            <?php if(request('q')): ?>
                                <span class="bg-slate-100 text-slate-700 px-3 py-1 rounded text-[10px] font-black uppercase tracking-widest">"<?php echo e(request('q')); ?>"</span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 md:gap-6">
                        <?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <article class="group bg-white rounded md:rounded-lg overflow-hidden border border-gray-100 hover:shadow-2xl hover:shadow-slate-200 transition-all duration-500 flex flex-col h-full">
                                <div class="relative aspect-[4/3] md:aspect-video overflow-hidden">
                                    <?php if($article->image): ?>
                                        <img src="<?php echo e(asset($article->image)); ?>" alt="<?php echo e($article->image_alt ?: $article->title); ?>" 
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                             loading="lazy">
                                    <?php else: ?>
                                        <div class="w-full h-full bg-slate-50 flex items-center justify-center text-slate-200 font-black text-2xl md:text-3xl">BG</div>
                                    <?php endif; ?>
                                    
                                    <?php if($article->category_name): ?>
                                    <div class="absolute top-2 left-2 md:top-4 md:left-4">
                                        <span class="bg-white/90 backdrop-blur-md text-slate-900 text-[7px] md:text-[9px] font-black uppercase tracking-widest px-2 py-1 md:px-3 md:py-1.5 rounded md:rounded shadow-sm border border-white/20">
                                            <?php echo e($article->category_name); ?>

                                        </span>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <div class="p-3 md:p-6 flex flex-col flex-1">
                                    <div class="flex items-center gap-2 mb-2 md:mb-3">
                                        <span class="text-[7px] md:text-[9px] font-black text-amber-600 uppercase tracking-widest"><?php echo e(($article->published_at ?: $article->created_at)->translatedFormat('d M Y')); ?></span>
                                    </div>
                                    
                                    <h2 class="text-[10px] md:text-base font-black text-slate-900 leading-tight mb-2 md:mb-3 group-hover:text-amber-600 transition-colors line-clamp-2">
                                        <a href="javascript:void(0)" onclick="trackArticleClick(<?php echo e($article->id); ?>, '<?php echo e(route('article.show', $article->slug)); ?>')"><?php echo e($article->title); ?></a>
                                    </h2>
                                    
                                    <p class="text-gray-500 text-[9px] md:text-xs font-medium line-clamp-2 mb-4 md:mb-6 leading-relaxed hidden sm:block">
                                        <?php echo e($article->excerpt ?: Str::limit(strip_tags($article->content), 100)); ?>

                                    </p>

                                    <div class="mt-auto pt-2 md:pt-4 border-t border-gray-50 flex justify-between items-center">
                                        <span class="text-[7px] md:text-[9px] font-black text-gray-400 uppercase tracking-widest"><?php echo e(number_format($article->click_count)); ?> Clicks</span>
                                        <a href="javascript:void(0)" onclick="trackArticleClick(<?php echo e($article->id); ?>, '<?php echo e(route('article.show', $article->slug)); ?>')" class="text-amber-600 hover:text-amber-700 transition-colors">
                                            <svg class="h-3.5 w-3.5 md:h-5 md:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="col-span-full py-24 text-center bg-white rounded-lg border border-dashed border-gray-200">
                                <div class="h-20 w-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-300">
                                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2zM14 4v4h4m-4 7h.01M9 15h.01M9 11h.01M12 11h.01M12 15h.01M15 11h.01M15 15h.01"/></svg>
                                </div>
                                <h3 class="text-xl font-black text-slate-900 mb-2">Tidak Ada Artikel</h3>
                                <p class="text-gray-500 text-sm font-medium">Coba gunakan kata kunci atau kategori yang lain.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Premium Pagination -->
                    <div class="mt-20 flex justify-center">
                        <div class="pagination-amber-theme bg-slate-900 p-2 rounded shadow-2xl shadow-slate-900/40 border border-slate-800">
                            <?php echo e($articles->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Force Amber Theme on Laravel Pagination */
        .pagination-amber-theme nav div div span.relative.z-0, 
        .pagination-amber-theme nav div div a.relative.z-0 {
            display: flex;
            gap: 4px;
            border: none;
        }
        .pagination-amber-theme nav span[aria-current="page"] span {
            background-color: #f59e0b !important;
            color: #0f172a !important;
            border-radius: 12px;
            border: none !important;
            font-weight: 900;
            padding: 8px 16px;
        }
        .pagination-amber-theme nav a, 
        .pagination-amber-theme nav span.relative.inline-flex {
            background-color: transparent !important;
            color: #94a3b8 !important;
            border: none !important;
            border-radius: 12px;
            padding: 8px 16px;
            font-weight: 700;
            transition: all 0.3s;
        }
        .pagination-amber-theme nav a:hover {
            background-color: rgba(255,255,255,0.05) !important;
            color: #ffffff !important;
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
<?php /**PATH D:\laragon\www\BisnisGrowth\resources\views/pages/articles/index.blade.php ENDPATH**/ ?>