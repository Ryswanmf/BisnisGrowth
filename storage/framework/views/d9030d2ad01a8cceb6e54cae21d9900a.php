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
     <?php $__env->slot('title', null, []); ?> Hubungi Kami — BisnisGrowth <?php $__env->endSlot(); ?>

    <section class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="mb-20">
                <span class="text-amber-600 text-[10px] font-black uppercase tracking-[0.3em] mb-4 block">Kontak Resmi</span>
                <h1 class="text-3xl md:text-5xl font-black text-slate-900 tracking-tight mb-6">Ada Pertanyaan? <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-500 to-amber-700">Hubungi Kami</span></h1>
                <p class="text-gray-500 text-base font-medium leading-relaxed max-w-2xl">Kami siap membantu Anda mengoptimalkan pertumbuhan bisnis Anda melalui solusi direktori dan edukasi terbaik.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                
                <!-- LEFT SIDE: CONTACT INFO -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100 group hover:shadow-xl transition-all duration-500">
                        <div class="flex items-center gap-6">
                            <div class="h-12 w-12 bg-amber-50 rounded-md flex items-center justify-center text-amber-600 shrink-0 group-hover:bg-amber-500 group-hover:text-white transition-all">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Email</h3>
                                <p class="text-sm font-bold text-slate-900"><?php echo e($footerSetting->email ?? 'hello@bisnisgrowth.id'); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100 group hover:shadow-xl transition-all duration-500">
                        <div class="flex items-center gap-6">
                            <div class="h-12 w-12 bg-amber-50 rounded-md flex items-center justify-center text-amber-600 shrink-0 group-hover:bg-amber-500 group-hover:text-white transition-all">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">WhatsApp</h3>
                                <p class="text-sm font-bold text-slate-900"><?php echo e($footerSetting->phone ?? '+62 812-3456-7890'); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100 group hover:shadow-xl transition-all duration-500">
                        <div class="flex items-center gap-6">
                            <div class="h-12 w-12 bg-amber-50 rounded-md flex items-center justify-center text-amber-600 shrink-0 group-hover:bg-amber-500 group-hover:text-white transition-all">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            </div>
                            <div>
                                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Kantor</h3>
                                <p class="text-sm font-bold text-slate-900 leading-relaxed"><?php echo e($footerSetting->address ?? 'Jakarta, Indonesia.'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT SIDE: MESSAGE FORM -->
                <div class="lg:col-span-8">
                    <div class="bg-white p-8 md:p-12 rounded-lg shadow-2xl shadow-slate-200/50 border border-gray-100 relative overflow-hidden">
                        <?php if(session('success')): ?>
                            <div class="mb-10 bg-emerald-50 border border-emerald-100 text-emerald-600 px-6 py-4 rounded-md text-sm font-black animate-pulse text-center">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>

                        <form action="<?php echo e(route('contact.store')); ?>" method="POST" class="space-y-6">
                            <?php echo csrf_field(); ?>
                            <div style="display:none;">
                                <input type="text" name="my_full_name" value="">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Nama Lengkap</label>
                                    <input type="text" name="name" placeholder="Nama Anda" class="w-full bg-gray-50 border-2 border-transparent rounded-md px-6 py-4 text-sm focus:bg-white focus:border-amber-400 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all font-bold" required>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Alamat Email</label>
                                    <input type="email" name="email" placeholder="email@contoh.com" class="w-full bg-gray-50 border-2 border-transparent rounded-md px-6 py-4 text-sm focus:bg-white focus:border-amber-400 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all font-bold" required>
                                </div>
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Pesan Anda</label>
                                <textarea name="message" rows="5" placeholder="Apa yang bisa kami bantu?" class="w-full bg-gray-50 border-2 border-transparent rounded-md px-6 py-4 text-sm focus:bg-white focus:border-amber-400 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all font-bold resize-none" required></textarea>
                            </div>
                            <button type="submit" class="w-full bg-slate-900 text-white py-5 rounded-md text-[10px] font-black uppercase tracking-[0.3em] hover:bg-amber-500 hover:text-slate-900 transition-all shadow-xl shadow-amber-500/20 flex items-center justify-center gap-3 group">
                                <span>Kirim Pesan Sekarang</span>
                                <svg class="h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
<?php /**PATH D:\laragon\www\BisnisGrowth\resources\views/pages/contact.blade.php ENDPATH**/ ?>