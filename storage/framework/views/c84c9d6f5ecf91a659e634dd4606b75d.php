

<?php $__env->startSection('title', 'Internal Linking'); ?>
<?php $__env->startSection('header', 'Otomatisasi Tautan Internal'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-xl font-black text-slate-900 tracking-tight">Daftar Kata Kunci & Tautan</h2>
            <p class="text-gray-500 text-sm font-medium">Ubah kata kunci dalam artikel menjadi tautan secara otomatis.</p>
        </div>
        <a href="<?php echo e(route('admin.internal-links.create')); ?>" class="bg-amber-500 text-slate-900 px-6 py-3 rounded-lg text-sm font-black flex items-center gap-2 hover:bg-amber-400 transition-all shadow-lg shadow-amber-500/20">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Tautan Internal
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-100">
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Kata Kunci</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">URL Tujuan</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Limit</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Status</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php $__empty_1 = true; $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-gray-50/50 transition-colors group">
                    <td class="px-6 py-4">
                        <span class="text-sm font-bold text-slate-900"><?php echo e($link->keyword); ?></span>
                    </td>
                    <td class="px-6 py-4">
                        <a href="<?php echo e($link->url); ?>" target="_blank" class="text-xs text-amber-600 font-bold hover:underline"><?php echo e($link->url); ?></a>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-xs font-black text-slate-400"><?php echo e($link->limit); ?>x</span>
                    </td>
                    <td class="px-6 py-4">
                        <?php if($link->is_active): ?>
                            <span class="text-green-600 text-[10px] font-black uppercase tracking-widest bg-green-50 px-3 py-1 rounded-md">Aktif</span>
                        <?php else: ?>
                            <span class="text-gray-400 text-[10px] font-black uppercase tracking-widest bg-gray-50 px-3 py-1 rounded-md">Non-aktif</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="<?php echo e(route('admin.internal-links.edit', $link)); ?>" class="p-2 bg-white border border-gray-100 rounded-md text-gray-400 hover:text-amber-500 transition-all">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form id="delete-form-<?php echo e($link->id); ?>" action="<?php echo e(route('admin.internal-links.destroy', $link)); ?>" method="POST">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="button" onclick="confirmDelete('delete-form-<?php echo e($link->id); ?>')" class="p-2 bg-white border border-gray-100 rounded-md text-gray-400 hover:text-red-500 transition-all">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="px-6 py-20 text-center text-gray-400 font-bold italic">Belum ada tautan internal.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\BisnisGrowth\resources\views/admin/internal-links/index.blade.php ENDPATH**/ ?>