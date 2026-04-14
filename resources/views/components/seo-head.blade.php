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

@if(!empty($siteSettings['ga_id']))
    <!-- Google Analytics (GA4) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $siteSettings['ga_id'] }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $siteSettings['ga_id'] }}');
    </script>
@endif

<!-- Organization Schema -->
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "Organization",
  "name": "BisnisGrowth",
  "url": "{{ url('/') }}",
  "logo": "{{ asset('images/Logo_Bisnis_Growth.png') }}",
  "sameAs": [
    "https://facebook.com/bisnisgrowth",
    "https://instagram.com/bisnisgrowth"
  ]
}
</script>

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
