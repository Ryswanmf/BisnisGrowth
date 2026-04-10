<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('images/Logo_Bisnis_Growth.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/Logo_Bisnis_Growth.png') }}">

    @php
        $jsonLd = [
            "@context" => "https://schema.org",
            "@type" => "LocalBusiness",
            "name" => $business->name,
            "description" => $business->description,
            "telephone" => $business->phone,
            "email" => $business->email,
            "url" => url()->current(),
            "address" => [
                "@type" => "PostalAddress",
                "addressLocality" => $business->city,
                "addressRegion" => $business->province,
                "addressCountry" => "ID"
            ]
        ];
        
        $socials = [];
        if($business->instagram) $socials[] = "https://instagram.com/" . $business->instagram;
        if($business->facebook) $socials[] = "https://facebook.com/" . $business->facebook;
        if($business->tiktok) $socials[] = "https://tiktok.com/@" . $business->tiktok;
        if($business->youtube) $socials[] = "https://youtube.com/" . $business->youtube;
        
        if(!empty($socials)) $jsonLd['sameAs'] = $socials;
    @endphp

    <x-seo-head 
        :title="$business->meta_title ?? $business->name . ' — ' . $business->tagline"
        :description="$business->meta_description ?? Str::limit($business->description, 155)"
        :ogImage="$business->logo ? asset('storage/' . $business->logo) : null"
        :jsonLd="$jsonLd"
    />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { background-color: {{ $business->theme_color }}; }
    </style>
</head>
<body class="font-sans antialiased text-gray-900 min-h-full">
    <div class="max-w-md mx-auto min-h-screen bg-white shadow-2xl flex flex-col relative">
        <!-- Cover Image -->
        <div class="h-40 bg-gray-200 overflow-hidden relative">
            @if($business->cover_image)
                <img src="{{ asset('storage/' . $business->cover_image) }}" alt="" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-burgundy-900/10 flex items-center justify-center">
                    <svg class="w-12 h-12 text-burgundy-900/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            @endif
        </div>

        <!-- Content -->
        <div class="px-6 pb-12 -mt-16 flex-grow relative z-10 text-center">
            <!-- Logo -->
            <div class="inline-block relative">
                <img src="{{ $business->logo ? asset('storage/' . $business->logo) : 'https://ui-avatars.com/api/?name=' . urlencode($business->name) . '&background=7B1F2E&color=FFF8E7' }}" 
                     alt="{{ $business->name }}" 
                     class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg mx-auto bg-white">
                @if($business->is_verified)
                    <div class="absolute bottom-1 right-1 bg-gold-400 text-burgundy-800 rounded-full p-1.5 shadow-md border-2 border-white" title="Terverifikasi">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Business Info -->
            <div class="mt-4">
                <h1 class="text-2xl font-bold" style="color: {{ $business->theme_color == '#7B1F2E' ? '#111827' : $business->theme_color }}">{{ $business->name }}</h1>
                <p class="text-gray-500 mt-1 font-medium">{{ $business->tagline }}</p>
                <div class="flex items-center justify-center gap-2 mt-3">
                    <span class="badge-verified bg-gray-100 text-gray-600 border border-gray-200">{{ $business->city }}</span>
                    <span class="badge-verified">{{ $business->category->name }}</span>
                </div>
                <p class="text-gray-600 mt-6 text-sm leading-relaxed">
                    {{ $business->description }}
                </p>
            </div>

            <!-- Links -->
            <div class="mt-10">
                @foreach($business->links as $link)
                    <x-link-button :link="$link" />
                @endforeach
            </div>

            <!-- Social Media -->
            <div class="mt-8 flex justify-center gap-6">
                @if($business->instagram)
                    <a href="https://instagram.com/{{ $business->instagram }}" target="_blank" class="text-gray-400 hover:text-burgundy-600 transition-colors">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-7 w-7 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                @endif
                @if($business->facebook)
                    <a href="https://facebook.com/{{ $business->facebook }}" target="_blank" class="text-gray-400 hover:text-burgundy-600 transition-colors">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-7 w-7 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                @endif
                @if($business->tiktok)
                    <a href="https://tiktok.com/@{{ $business->tiktok }}" target="_blank" class="text-gray-400 hover:text-burgundy-600 transition-colors">
                        <span class="sr-only">TikTok</span>
                        <svg class="h-7 w-7 fill-current" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.9-.32-1.98-.23-2.81.33-.85.51-1.44 1.43-1.58 2.41-.14 1.01.23 2.08.94 2.79.68.68 1.64 1.02 2.59.95.96-.08 1.83-.58 2.37-1.39.46-.64.67-1.43.66-2.22-.01-4.53-.02-9.06-.02-13.59z"/></svg>
                    </a>
                @endif
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-auto py-8 text-center text-gray-400 text-xs">
            <a href="/" class="hover:text-burgundy-600 transition-colors flex items-center justify-center gap-1">
                Powered by 
                <span class="font-bold text-burgundy-600">Bisnis<span class="text-gold-400">Growth</span></span>
            </a>
        </div>
    </div>
</body>
</html>
