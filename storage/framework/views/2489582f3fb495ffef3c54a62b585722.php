<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="h-full bg-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($title ?? 'BisnisGrowth — Wawasan Bisnis & Strategi UMKM'); ?></title>

    <link rel="icon" type="image/png" href="<?php echo e(asset('images/Logo_Bisnis_Growth.png')); ?>">
    
    <!-- PWA Settings -->
    <meta name="theme-color" content="#f59e0b">
    <link rel="apple-touch-icon" href="<?php echo e(asset('images/Logo_Bisnis_Growth.png')); ?>">
    <link rel="manifest" href="<?php echo e(asset('manifest.json')); ?>">
    
    <?php echo e($seo ?? ''); ?>

    <?php echo e($styles ?? ''); ?>


    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        /* Modern Minimalist Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #e2e8f0; /* slate-200 */
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #f59e0b; /* amber-500 */
        }
        
        /* For Firefox */
        * {
            scrollbar-width: thin;
            scrollbar-color: #e2e8f0 transparent;
        }

        /* Hide scrollbar for Chrome, Safari and Opera (utility for specific containers) */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        /* Hide scrollbar for IE, Edge and Firefox */
        .no-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-900 min-h-full flex flex-col">
    <!-- Light Minimalist Page Loader -->
    <div id="page-loader" class="fixed inset-0 z-[9999] bg-white flex flex-col items-center justify-center transition-all duration-700 ease-in-out">
        <div class="relative">
            <!-- Pulsing Circle Decoration -->
            <div class="absolute inset-0 bg-amber-500/10 rounded-full animate-[ping_2.5s_infinite] scale-150"></div>
            
            <!-- Logo with Breathing & Fade Effect -->
            <div class="relative w-20 h-20 md:w-24 md:h-24 animate-[pulse_2s_infinite]">
                <img src="<?php echo e(asset('images/Logo_Bisnis_Growth.png')); ?>" alt="Loading..." class="w-full h-full object-contain opacity-90">
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('load', function() {
            const loader = document.getElementById('page-loader');
            setTimeout(() => {
                if(loader) {
                    loader.style.opacity = '0';
                    loader.style.pointerEvents = 'none'; // Pastikan tidak menghalangi klik saat memudar
                    setTimeout(() => {
                        loader.style.display = 'none';
                    }, 700);
                }
            }, 400);
        });
    </script>

    <?php if (isset($component)) { $__componentOriginalfd1f218809a441e923395fcbf03e4272 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfd1f218809a441e923395fcbf03e4272 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $attributes = $__attributesOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__attributesOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $component = $__componentOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__componentOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>

    <!-- Main Content -->
    <main class="flex-grow">
        <?php echo e($slot); ?>

    </main>

    <?php if (isset($component)) { $__componentOriginal8a8716efb3c62a45938aca52e78e0322 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8a8716efb3c62a45938aca52e78e0322 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $attributes = $__attributesOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $component = $__componentOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__componentOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>

    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/service-worker.js');
            });
        }
    </script>
    <?php echo e($scripts ?? ''); ?>

</body>
</html>
<?php /**PATH D:\laragon\www\BisnisGrowth\resources\views/components/app-layout.blade.php ENDPATH**/ ?>