@props([
    'title' => null,
    'description' => 'Daftarkan bisnis Anda di BisnisGrowth — Satu Link untuk Semua Bisnismu. Direktori bisnis & link-in-bio untuk UMKM Indonesia.',
    'canonical' => url()->current(),
    'ogImage' => asset('images/Logo_Bisnis_Growth.png'),
    'robots' => 'index, follow',
    'jsonLd' => null
])

@php
    $fullTitle = $title ? $title . ' — BisnisGrowth' : 'BisnisGrowth — Direktori Bisnis & Link-in-Bio untuk UMKM Indonesia';
@endphp

<title>{{ $fullTitle }}</title>
<meta name="description" content="{{ $description }}">
<meta name="robots" content="{{ $robots }}">
<link rel="canonical" href="{{ $canonical }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $fullTitle }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $ogImage }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ url()->current() }}">
<meta property="twitter:title" content="{{ $fullTitle }}">
<meta property="twitter:description" content="{{ $description }}">
<meta property="twitter:image" content="{{ $ogImage }}">

@if($jsonLd)
<script type="application/ld+json">
    {!! is_array($jsonLd) ? json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) : $jsonLd !!}
</script>
@endif
