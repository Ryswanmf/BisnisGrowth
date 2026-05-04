<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => null,
    'description' => 'Daftarkan bisnis Anda di BisnisGrowth — Satu Link untuk Semua Bisnismu. Direktori bisnis & link-in-bio untuk UMKM Indonesia.',
    'canonical' => url()->current(),
    'ogImage' => asset('images/Logo_Bisnis_Growth.png'),
    'robots' => 'index, follow',
    'jsonLd' => null
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'title' => null,
    'description' => 'Daftarkan bisnis Anda di BisnisGrowth — Satu Link untuk Semua Bisnismu. Direktori bisnis & link-in-bio untuk UMKM Indonesia.',
    'canonical' => url()->current(),
    'ogImage' => asset('images/Logo_Bisnis_Growth.png'),
    'robots' => 'index, follow',
    'jsonLd' => null
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $fullTitle = $title ? $title . ' — BisnisGrowth' : 'BisnisGrowth — Direktori Bisnis & Link-in-Bio untuk UMKM Indonesia';
?>

<title><?php echo e($fullTitle); ?></title>
<meta name="description" content="<?php echo e($description); ?>">
<meta name="robots" content="<?php echo e($robots); ?>">
<link rel="canonical" href="<?php echo e($canonical); ?>">

<?php if(!empty($siteSettings['ga_id'])): ?>
    <!-- Google Analytics (GA4) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e($siteSettings['ga_id']); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo e($siteSettings['ga_id']); ?>');
    </script>
<?php endif; ?>

<!-- Organization Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "BisnisGrowth",
  "url": "<?php echo e(url('/')); ?>",
  "logo": "<?php echo e(asset('images/Logo_Bisnis_Growth.png')); ?>",
  "sameAs": [
    "https://facebook.com/bisnisgrowth",
    "https://instagram.com/bisnisgrowth"
  ]
}
</script>

<?php if($jsonLd): ?>
<script type="application/ld+json">
<?php echo json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); ?>

</script>
<?php endif; ?>

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo e(url()->current()); ?>">
<meta property="og:title" content="<?php echo e($fullTitle); ?>">
<meta property="og:description" content="<?php echo e($description); ?>">
<meta property="og:image" content="<?php echo e($ogImage); ?>">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?php echo e(url()->current()); ?>">
<meta property="twitter:title" content="<?php echo e($fullTitle); ?>">
<meta property="twitter:description" content="<?php echo e($description); ?>">
<meta property="twitter:image" content="<?php echo e($ogImage); ?>">
<?php /**PATH D:\laragon\www\BisnisGrowth\resources\views/components/seo-head.blade.php ENDPATH**/ ?>