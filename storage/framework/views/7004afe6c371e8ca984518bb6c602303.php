

<?php $__env->startSection('title', 'Edit Pool Keyword'); ?>
<?php $__env->startSection('header', 'Edit Keyword Pool'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="<?php echo e(route('admin.short-keywords.index')); ?>" class="text-xs font-black text-amber-600 uppercase tracking-widest flex items-center gap-2 hover:text-amber-700 transition-colors">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Daftar
        </a>
    </div>

    <form action="<?php echo e(route('admin.short-keywords.update', $shortKeyword->id)); ?>" method="POST" class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div>
            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Judul (Title)</label>
            <input type="text" name="title" value="<?php echo e(old('title', $shortKeyword->title)); ?>" class="w-full bg-gray-50 border-gray-100 rounded-xl px-4 py-3 focus:ring-amber-500 focus:border-amber-500 <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-500 font-bold"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Daftar Keyword (Deskripsi)</label>
            <textarea name="description" rows="10" class="w-full bg-gray-50 border-gray-100 rounded-xl px-4 py-3 focus:ring-amber-500 focus:border-amber-500 <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required><?php echo e(old('description', $shortKeyword->description)); ?></textarea>
            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-500 font-bold"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
            <span class="text-xs font-bold text-slate-900 uppercase tracking-widest">Aktifkan Pool Ini</span>
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" name="is_active" value="1" class="sr-only peer" <?php echo e($shortKeyword->is_active ? 'checked' : ''); ?>>
                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
            </label>
        </div>

        <button type="submit" class="w-full bg-amber-500 text-slate-900 py-4 rounded-xl font-black text-sm uppercase tracking-widest hover:bg-amber-400 transition-all shadow-lg shadow-amber-500/20">
            Perbarui Pool Keyword
        </button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\BisnisGrowth\resources\views/admin/short-keywords/edit.blade.php ENDPATH**/ ?>