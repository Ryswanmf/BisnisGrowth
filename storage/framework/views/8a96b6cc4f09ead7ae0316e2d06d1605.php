

<?php $__env->startSection('title', 'Tambah Tautan Internal'); ?>
<?php $__env->startSection('header', 'Tambah Tautan Internal'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto">
    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
        <form action="<?php echo e(route('admin.internal-links.store')); ?>" method="POST" class="space-y-6">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block text-xs font-black text-slate-900 uppercase tracking-widest mb-2">Kata Kunci</label>
                <input type="text" name="keyword" value="<?php echo e(old('keyword')); ?>" placeholder="Contoh: Bisnis Kopi" 
                       class="w-full bg-gray-50 border-gray-100 rounded-xl px-5 py-4 focus:ring-amber-500 font-bold" required>
                <?php $__errorArgs = ['keyword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-[10px] mt-1 font-bold"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-xs font-black text-slate-900 uppercase tracking-widest mb-2">URL Tujuan</label>
                <input type="url" name="url" value="<?php echo e(old('url')); ?>" placeholder="https://bisnisgrowth.id/..." 
                       class="w-full bg-gray-50 border-gray-100 rounded-xl px-5 py-4 focus:ring-amber-500 font-bold text-amber-600" required>
                <?php $__errorArgs = ['url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-[10px] mt-1 font-bold"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-xs font-black text-slate-900 uppercase tracking-widest mb-2">Limit Per Artikel</label>
                <input type="number" name="limit" value="<?php echo e(old('limit', 1)); ?>" min="1" max="10"
                       class="w-full bg-gray-50 border-gray-100 rounded-xl px-5 py-4 focus:ring-amber-500 font-bold">
                <p class="mt-2 text-[10px] text-gray-400 font-medium italic">* Maksimal berapa kali kata ini dijadikan link dalam satu artikel.</p>
            </div>

            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                <span class="text-xs font-bold text-slate-900 uppercase tracking-widest">Status Aktif</span>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-amber-500 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                </label>
            </div>

            <div class="pt-4 flex gap-4">
                <button type="submit" class="flex-1 bg-amber-500 text-slate-900 py-4 rounded-xl font-black text-sm uppercase tracking-widest hover:bg-amber-400 transition-all shadow-lg shadow-amber-500/20">
                    Simpan Tautan
                </button>
                <a href="<?php echo e(route('admin.internal-links.index')); ?>" class="px-8 py-4 bg-gray-100 text-gray-400 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-gray-200 transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\BisnisGrowth\resources\views/admin/internal-links/create.blade.php ENDPATH**/ ?>