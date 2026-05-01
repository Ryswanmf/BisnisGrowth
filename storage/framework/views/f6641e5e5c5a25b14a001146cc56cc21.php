

<?php $__env->startSection('title', 'Pengaturan Footer'); ?>
<?php $__env->startSection('header', 'Pengaturan Footer'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl">
    <?php if(session('success')): ?>
        <div class="mb-6 bg-green-100 border border-green-200 text-green-700 px-6 py-4 rounded-lg text-sm font-bold animate-pulse">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.footer.update')); ?>" method="POST" enctype="multipart/form-data" class="space-y-8">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- Bagian Identitas -->
        <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100 space-y-6">
            <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-3">
                <span class="h-2 w-2 bg-amber-500 rounded-full"></span> Identitas & Branding
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Logo Footer</label>
                    <div class="flex items-center gap-4">
                        <?php if($setting->logo): ?>
                            <img src="<?php echo e(asset($setting->logo)); ?>" class="h-16 w-16 object-contain bg-slate-50 rounded-lg p-2 border">
                        <?php endif; ?>
                        <input type="file" name="logo" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Copyright Text</label>
                    <input type="text" name="copyright_text" value="<?php echo e($setting->copyright_text); ?>" placeholder="© 2026 BisnisGrowth. All rights reserved." class="w-full bg-gray-50 border-none rounded-lg px-5 py-3 text-sm focus:ring-2 focus:ring-amber-500">
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Tentang Kami (Singkat)</label>
                <textarea name="about_text" rows="4" class="w-full bg-gray-50 border-none rounded-lg px-5 py-3 text-sm focus:ring-2 focus:ring-amber-500"><?php echo e($setting->about_text); ?></textarea>
            </div>
        </div>

        <!-- Bagian Kontak -->
        <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100 space-y-6">
            <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-3">
                <span class="h-2 w-2 bg-amber-500 rounded-full"></span> Informasi Kontak
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Email</label>
                    <input type="email" name="email" value="<?php echo e($setting->email); ?>" class="w-full bg-gray-50 border-none rounded-lg px-5 py-3 text-sm focus:ring-2 focus:ring-amber-500">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Telepon</label>
                    <input type="text" name="phone" value="<?php echo e($setting->phone); ?>" class="w-full bg-gray-50 border-none rounded-lg px-5 py-3 text-sm focus:ring-2 focus:ring-amber-500">
                </div>
            </div>
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Alamat Kantor</label>
                <input type="text" name="address" value="<?php echo e($setting->address); ?>" class="w-full bg-gray-50 border-none rounded-lg px-5 py-3 text-sm focus:ring-2 focus:ring-amber-500">
            </div>
        </div>

        <!-- Bagian Social Media -->
        <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100 space-y-6">
            <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-3">
                <span class="h-2 w-2 bg-amber-500 rounded-full"></span> Media Sosial (URL)
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Facebook</label>
                    <input type="url" name="facebook_url" value="<?php echo e($setting->facebook_url); ?>" class="w-full bg-gray-50 border-none rounded-lg px-5 py-3 text-sm focus:ring-2 focus:ring-amber-500">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Instagram</label>
                    <input type="url" name="instagram_url" value="<?php echo e($setting->instagram_url); ?>" class="w-full bg-gray-50 border-none rounded-lg px-5 py-3 text-sm focus:ring-2 focus:ring-amber-500">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Twitter / X</label>
                    <input type="url" name="twitter_url" value="<?php echo e($setting->twitter_url); ?>" class="w-full bg-gray-50 border-none rounded-lg px-5 py-3 text-sm focus:ring-2 focus:ring-amber-500">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">LinkedIn</label>
                    <input type="url" name="linkedin_url" value="<?php echo e($setting->linkedin_url); ?>" class="w-full bg-gray-50 border-none rounded-lg px-5 py-3 text-sm focus:ring-2 focus:ring-amber-500">
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" class="bg-amber-500 text-slate-900 px-10 py-4 rounded-lg text-sm font-black uppercase tracking-widest hover:bg-amber-400 transition-all shadow-lg shadow-amber-500/20">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\BisnisGrowth\resources\views/admin/footer/edit.blade.php ENDPATH**/ ?>