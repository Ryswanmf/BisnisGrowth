<x-app-layout>
    <x-slot name="seo">
        <x-seo-head 
            title="BisnisGrowth — Direktori Bisnis & Link-in-Bio untuk UMKM Indonesia"
            description="Daftarkan bisnis Anda di BisnisGrowth. Dapatkan satu link untuk semua profil bisnismu. Tingkatkan visibilitas dan jangkauan pelanggan sekarang."
        />
    </x-slot>

    <!-- Hero Section -->
    <section class="bg-logo-gradient py-24 px-4 relative overflow-hidden">
        <!-- Optional Decorative Shapes (Mimicking Logo Curves) -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-burgundy-400/10 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto text-center relative z-10">
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 leading-tight drop-shadow-sm">
                Satu Link untuk <br class="hidden md:block"> Semua Bisnismu
            </h1>
            <p class="text-lg md:text-xl text-burgundy-100 mb-10 max-w-2xl mx-auto font-medium">
                Bantu pelanggan menemukan semua profil dan kontak bisnismu dalam satu halaman profesional yang indah dan elegan.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="/register" class="btn-primary text-lg">
                    Daftar Gratis
                </a>
                <a href="/direktori" class="btn-secondary text-lg">
                    Lihat Contoh
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Bar -->
    <section class="bg-white border-b border-gray-100 py-8 px-4 -mt-10 relative z-10 max-w-5xl mx-auto rounded-2xl shadow-xl shadow-burgundy-900/10">
        <div class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-gray-100">
            <div class="text-center py-4 md:py-0">
                <div class="text-3xl font-bold text-burgundy-600">{{ number_format($stats['total_businesses']) }}+</div>
                <div class="text-sm text-gray-500 font-medium">Bisnis Terdaftar</div>
            </div>
            <div class="text-center py-4 md:py-0">
                <div class="text-3xl font-bold text-burgundy-600">{{ $stats['total_categories'] }}</div>
                <div class="text-sm text-gray-500 font-medium">Kategori Bisnis</div>
            </div>
            <div class="text-center py-4 md:py-0">
                <div class="text-3xl font-bold text-burgundy-600">{{ number_format($stats['total_views']) }}+</div>
                <div class="text-sm text-gray-500 font-medium">Total Kunjungan</div>
            </div>
        </div>
    </section>

    <!-- Cara Kerja -->
    <section class="py-24 px-4 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-burgundy-900 mb-4">Mulai dalam 3 Langkah Mudah</h2>
                <div class="w-20 h-1.5 bg-gold-400 mx-auto rounded-full"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="text-center">
                    <div class="w-16 h-16 bg-burgundy-600 text-gold-400 rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-6 shadow-lg">1</div>
                    <h3 class="text-xl font-bold text-burgundy-800 mb-3">Daftar Akun</h3>
                    <p class="text-gray-600">Buat akun gratis dalam hitungan detik untuk mulai mengelola profil bisnis Anda.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-burgundy-600 text-gold-400 rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-6 shadow-lg">2</div>
                    <h3 class="text-xl font-bold text-burgundy-800 mb-3">Isi Profil</h3>
                    <p class="text-gray-600">Lengkapi detail bisnis, upload logo, dan tambahkan link sosial media atau kontak WhatsApp.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-burgundy-600 text-gold-400 rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-6 shadow-lg">3</div>
                    <h3 class="text-xl font-bold text-burgundy-800 mb-3">Bagikan Link</h3>
                    <p class="text-gray-600">Gunakan satu link BisnisGrowth di bio Instagram, TikTok, atau status WhatsApp Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Businesses -->
    <section class="py-24 px-4 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6 text-center md:text-left">
                <div>
                    <h2 class="text-3xl font-bold text-burgundy-900 mb-4">Bisnis Terbaru & Terverifikasi</h2>
                    <p class="text-gray-600">Temukan UMKM berkualitas yang telah terdaftar di direktori kami.</p>
                </div>
                <a href="/direktori" class="text-burgundy-600 font-bold hover:text-burgundy-800 transition-colors inline-flex items-center">
                    Lihat Semua
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredBusinesses as $business)
                    <x-business-card :business="$business" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Popular Categories -->
    <section class="py-24 px-4 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-burgundy-900 mb-4">Jelajahi Kategori Populer</h2>
                <p class="text-gray-600">Cari bisnis berdasarkan bidang usaha yang Anda butuhkan.</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($popularCategories as $category)
                    <a href="/kategori/{{ $category->slug }}" class="bg-white p-6 rounded-2xl border border-gray-100 text-center hover:border-gold-400 hover:shadow-lg transition-all group">
                        <div class="text-4xl mb-4 group-hover:scale-110 transition-transform">{{ $category->icon }}</div>
                        <h4 class="font-bold text-burgundy-900">{{ $category->name }}</h4>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-24 px-4 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-burgundy-900 mb-4">Apa Kata Mereka?</h2>
                <div class="w-20 h-1.5 bg-gold-400 mx-auto rounded-full"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-burgundy-50 p-8 rounded-3xl relative">
                    <div class="text-gold-400 mb-4 flex">
                        @for($i=0; $i<5; $i++) <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg> @endfor
                    </div>
                    <p class="text-burgundy-800 italic mb-6">"BisnisGrowth sangat membantu toko kerajinan saya. Sekarang pelanggan tidak bingung lagi mencari katalog dan nomor WA."</p>
                    <div class="font-bold text-burgundy-900">Siti Rahma</div>
                    <div class="text-sm text-burgundy-600">Owner Rahma Craft</div>
                </div>
                <div class="bg-burgundy-50 p-8 rounded-3xl relative">
                    <div class="text-gold-400 mb-4 flex">
                        @for($i=0; $i<5; $i++) <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg> @endfor
                    </div>
                    <p class="text-burgundy-800 italic mb-6">"Halaman profilnya sangat mobile-friendly. Sangat profesional untuk ditaruh di bio Instagram bisnis kuliner saya."</p>
                    <div class="font-bold text-burgundy-900">Budi Santoso</div>
                    <div class="text-sm text-burgundy-600">Founder Ayam Bakar Mantap</div>
                </div>
                <div class="bg-burgundy-50 p-8 rounded-3xl relative">
                    <div class="text-gold-400 mb-4 flex">
                        @for($i=0; $i<5; $i++) <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg> @endfor
                    </div>
                    <p class="text-burgundy-800 italic mb-6">"Fitur analitiknya sangat membantu untuk melihat link mana yang paling banyak diklik oleh calon pelanggan."</p>
                    <div class="font-bold text-burgundy-900">Dewi Lestari</div>
                    <div class="text-sm text-burgundy-600">Digital Marketing Specialist</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom CTA -->
    <section class="bg-burgundy-600 py-20 px-4 text-center">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-[#FFF8E7] mb-6">Siap Mengembangkan Bisnis Anda?</h2>
            <p class="text-burgundy-100 mb-10 text-lg">Gabung dengan ratusan UMKM lainnya dan buat profil profesional Anda sekarang juga. Gratis selamanya.</p>
            <a href="/register" class="btn-primary text-lg px-12 py-4 shadow-2xl shadow-gold-400/20">
                Mulai Sekarang
            </a>
        </div>
    </section>
</x-app-layout>
