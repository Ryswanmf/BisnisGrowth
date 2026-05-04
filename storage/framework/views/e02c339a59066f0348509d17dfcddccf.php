<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin — BisnisGrowth</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>
        body {
            background: radial-gradient(circle at center, #1e293b 0%, #0f172a 100%);
        }
    </style>
</head>
<body class="h-full font-sans antialiased flex items-center justify-center p-4">
    
    <div class="w-full max-w-[420px]">
        <!-- Login Card -->
        <div class="bg-white rounded-lg p-8 md:p-12 shadow-2xl relative overflow-hidden">
            <!-- Subtle Decorative Gradient -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-amber-500/5 rounded-full -mr-16 -mt-16"></div>
            
            <div class="mb-10 relative">
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Login Admin</h2>
                <p class="text-slate-500 text-sm mt-2 font-medium">Selamat datang kembali, silakan masuk ke akun Anda.</p>
                <div class="w-12 h-1.5 bg-amber-500 mt-4 rounded-full"></div>
            </div>

            <form action="<?php echo e(route('login')); ?>" method="POST" class="space-y-6">
                <?php echo csrf_field(); ?>
                
                <!-- Email Field -->
                <div class="space-y-2">
                    <label for="email" class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Alamat Email</label>
                    <div class="relative group">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-amber-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"/>
                            </svg>
                        </div>
                        <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus
                            class="w-full bg-slate-50 border border-slate-100 rounded-lg py-4 pl-12 pr-4 text-sm font-bold text-slate-700 focus:outline-none focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 transition-all"
                            placeholder="admin@email.com">
                    </div>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-[10px] font-black uppercase mt-1 ml-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Password Field -->
                <div class="space-y-2">
                    <div class="flex justify-between items-center ml-1">
                        <label for="password" class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Password</label>
                    </div>
                    <div class="relative group">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-amber-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input id="password" type="password" name="password" required
                            class="w-full bg-slate-50 border border-slate-100 rounded-lg py-4 pl-12 pr-4 text-sm font-bold text-slate-700 focus:outline-none focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 transition-all"
                            placeholder="••••••••">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-slate-900 text-white font-black py-5 px-6 rounded-lg text-[10px] uppercase tracking-[0.3em] hover:bg-slate-800 transition-all shadow-xl shadow-slate-900/20 active:scale-[0.98] transform flex items-center justify-center gap-3">
                    <span>Masuk ke Panel Admin</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </button>
            </form>
        </div>

        <!-- Back Link -->
        <div class="mt-8 text-center">
            <a href="/" class="group inline-flex items-center gap-3 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] hover:text-white transition-all">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Beranda
            </a>
        </div>
    </div>

</body>
</html>
<?php /**PATH D:\laragon\www\BisnisGrowth\resources\views/admin/login.blade.php ENDPATH**/ ?>