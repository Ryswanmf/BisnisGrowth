

<?php $__env->startSection('title', 'Manajemen User'); ?>
<?php $__env->startSection('header', 'Manajemen Pengguna'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-xl font-black text-slate-900 tracking-tight">Daftar Pengguna</h2>
            <p class="text-gray-500 text-sm font-medium">Kelola hak akses administrator dan staf Anda.</p>
        </div>
        <a href="<?php echo e(route('admin.users.create')); ?>" class="bg-slate-900 text-white px-6 py-3 rounded-lg text-sm font-black flex items-center gap-2 hover:bg-slate-800 transition-all shadow-lg shadow-slate-900/20">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
            Tambah User Baru
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-100">
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Nama Lengkap</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Email</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Role</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Terdaftar</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4 text-sm font-bold text-slate-900"><?php echo e($user->name); ?></td>
                    <td class="px-6 py-4 text-sm text-slate-500 font-medium"><?php echo e($user->email); ?></td>
                    <td class="px-6 py-4">
                        <?php if($user->role === 'admin'): ?>
                            <span class="text-amber-600 text-[10px] font-black uppercase tracking-widest bg-amber-50 px-3 py-1 rounded-md border border-amber-100">Admin</span>
                        <?php else: ?>
                            <span class="text-slate-500 text-[10px] font-black uppercase tracking-widest bg-slate-50 px-3 py-1 rounded-md border border-slate-100">User</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase"><?php echo e($user->created_at->format('d M Y')); ?></td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="<?php echo e(route('admin.users.edit', $user)); ?>" class="p-2 bg-white border border-gray-100 rounded-md text-gray-400 hover:text-amber-500 transition-all">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <?php if($user->id !== Auth::id()): ?>
                            <form id="delete-form-<?php echo e($user->id); ?>" action="<?php echo e(route('admin.users.destroy', $user)); ?>" method="POST">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="button" onclick="confirmDelete('delete-form-<?php echo e($user->id); ?>')" class="p-2 bg-white border border-gray-100 rounded-md text-gray-400 hover:text-red-500 transition-all">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <div><?php echo e($users->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\BisnisGrowth\resources\views/admin/users/index.blade.php ENDPATH**/ ?>