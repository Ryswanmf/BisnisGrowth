<x-app-layout>
    <x-slot name="title">
        {{ $category->name }} — Direktori Bisnis & UMKM | BisnisGrowth
    </x-slot>

    <x-slot name="seo">
        <meta name="description" content="{{ $category->description ?? 'Temukan berbagai bisnis dan UMKM terbaik di kategori ' . $category->name . ' hanya di BisnisGrowth.' }}">
        <meta property="og:title" content="{{ $category->name }} — BisnisGrowth">
        <meta property="og:description" content="{{ $category->description ?? 'Temukan berbagai bisnis dan UMKM terbaik di kategori ' . $category->name . ' hanya di BisnisGrowth.' }}">
        <meta property="og:type" content="website">
    </x-slot>

    <div class="bg-amber-50 py-12 border-b border-amber-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div class="max-w-3xl">
                    <nav class="flex mb-4 text-sm text-amber-700 font-medium" aria-label="Breadcrumb">
                        <ol class="flex items-center space-x-2">
                            <li><a href="{{ route('home') }}" class="hover:text-amber-900 transition-colors">Home</a></li>
                            <li class="flex items-center space-x-2">
                                <svg class="h-4 w-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-amber-900">Kategori</span>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-burgundy-900 mb-2">
                        Kategori: {{ $category->name }}
                    </h1>
                    <p class="text-lg text-amber-800/80 leading-relaxed">
                        {{ $category->description ?? 'Menampilkan daftar bisnis dan UMKM yang terdaftar dalam kategori ' . $category->name . '.' }}
                    </p>
                </div>
                <div class="hidden md:block">
                    @if($category->icon)
                        <div class="w-24 h-24 bg-white rounded-2xl shadow-sm border border-amber-100 flex items-center justify-center text-4xl">
                            {{ $category->icon }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($businesses->isEmpty())
            <div class="text-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-10V4m0 10V4m-4 6h4" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-1">Belum Ada Bisnis</h3>
                <p class="text-gray-500">Belum ada bisnis yang terdaftar dalam kategori ini.</p>
                <div class="mt-6">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-burgundy-600 hover:bg-burgundy-700 transition-colors shadow-sm">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
                @foreach($businesses as $business)
                    <x-business-card :business="$business" />
                @endforeach
            </div>

            <div class="mt-12">
                {{ $businesses->links() }}
            </div>
        @endif
    </div>

    <!-- CTA Section -->
    <div class="bg-burgundy-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Ingin Bisnis Anda Tampil di Sini?</h2>
            <p class="text-burgundy-100 text-lg mb-8 max-w-2xl mx-auto">
                Daftarkan bisnis atau UMKM Anda secara gratis dan jangkau lebih banyak pelanggan potensial melalui direktori BisnisGrowth.
            </p>
            <a href="{{ route('contact') }}" class="inline-flex items-center px-8 py-4 border border-transparent text-lg font-bold rounded-xl text-burgundy-900 bg-amber-400 hover:bg-amber-300 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                Daftarkan Bisnis Sekarang
            </a>
        </div>
    </div>
</x-app-layout>
