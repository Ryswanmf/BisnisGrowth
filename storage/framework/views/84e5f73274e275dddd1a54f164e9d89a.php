

<?php $__env->startSection('title', 'Pesan Kontak'); ?>
<?php $__env->startSection('header', 'Kotak Masuk'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-100">
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Pengirim</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Pesan Singkat</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Tanggal</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="<?php echo e($msg->is_read ? 'opacity-60' : 'bg-amber-50/30'); ?> hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <p class="text-sm font-bold text-slate-900"><?php echo e($msg->name); ?></p>
                        <p class="text-[10px] text-gray-400"><?php echo e($msg->email); ?></p>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-xs text-slate-600 line-clamp-1"><?php echo e($msg->message); ?></p>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-[10px] font-bold text-gray-400 uppercase"><?php echo e($msg->created_at->format('d M Y H:i')); ?></p>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <form action="<?php echo e(route('admin.messages.destroy', $msg)); ?>" method="POST" onsubmit="return confirm('Hapus pesan?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-400 hover:text-red-600 p-2">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="4" class="px-6 py-20 text-center text-gray-400 italic">Belum ada pesan masuk.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="mt-6"><?php echo e($messages->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\BisnisGrowth\resources\views/admin/messages/index.blade.php ENDPATH**/ ?>