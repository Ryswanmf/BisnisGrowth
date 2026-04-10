<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing articles first for a clean seed
        Article::truncate();

        $articles = [
            [
                'title' => 'Strategi Digital Marketing UMKM Agar Cepat Naik Kelas',
                'slug' => 'strategi-digital-marketing-umkm',
                'excerpt' => 'Pelajari cara mengoptimalkan media sosial dan website untuk meningkatkan omzet bisnis kecil Anda di era digital.',
                'content' => 'Pemasaran digital bukan lagi pilihan, melainkan keharusan bagi UMKM yang ingin bertahan di era modern ini...',
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&q=80&w=800',
                'category_name' => 'Marketing',
                'is_featured' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Cara Mengelola Keuangan Bisnis Kuliner dengan Aplikasi Digital',
                'slug' => 'mengelola-keuangan-bisnis-kuliner',
                'excerpt' => 'Tips menjaga arus kas tetap sehat bagi pemilik warung makan dan cafe agar tidak boncos.',
                'content' => 'Banyak pemilik bisnis kuliner gagal bukan karena produknya tidak enak, tapi karena manajemen keuangan yang buruk...',
                'image' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&q=80&w=800',
                'category_name' => 'Keuangan',
                'is_featured' => false,
                'published_at' => now()->subHours(2),
            ],
            [
                'title' => 'Tren Fashion 2026: Peluang Besar bagi Desainer Lokal',
                'slug' => 'tren-fashion-2026-lokal',
                'excerpt' => 'Warna bumi dan bahan berkelanjutan menjadi primadona di pasar fashion Indonesia tahun depan.',
                'content' => 'Industri fashion terus bergerak cepat menuju konsep sustainability dan ethical fashion...',
                'image' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&q=80&w=800',
                'category_name' => 'Fashion',
                'is_featured' => false,
                'published_at' => now()->subHours(5),
            ],
            [
                'title' => 'Membangun Personal Branding sebagai Solopreneur',
                'slug' => 'membangun-personal-branding-solopreneur',
                'excerpt' => 'Kenapa profil LinkedIn dan cara Anda bercerita sangat krusial untuk menarik klien baru.',
                'content' => 'Sebagai solopreneur, Anda adalah wajah dari bisnis Anda sendiri. Personal branding adalah investasi terbaik...',
                'image' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&q=80&w=800',
                'category_name' => 'Bisnis',
                'is_featured' => false,
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => '5 Tools AI Gratis yang Wajib Dicoba Pemilik Bisnis Kecil',
                'slug' => '5-tools-ai-gratis-bisnis',
                'excerpt' => 'Tingkatkan produktivitas tim Anda dengan alat kecerdasan buatan tanpa harus bayar mahal.',
                'content' => 'Kecerdasan buatan bukan hanya untuk perusahaan besar. Berikut adalah alat AI gratis yang bisa membantu operasional harian Anda...',
                'image' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?auto=format&fit=crop&q=80&w=800',
                'category_name' => 'Teknologi',
                'is_featured' => false,
                'published_at' => now()->subDays(1)->subHours(3),
            ],
            [
                'title' => 'Pentingnya Izin Edar BPOM untuk Produk UMKM Makanan',
                'slug' => 'pentingnya-izin-bpom-umkm',
                'excerpt' => 'Jangan tunggu digerebek! Simak panduan lengkap mengurus BPOM untuk skala rumah tangga.',
                'content' => 'Keamanan pangan adalah faktor utama dalam membangun kepercayaan konsumen jangka panjang...',
                'image' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&q=80&w=800',
                'category_name' => 'Regulasi',
                'is_featured' => false,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Tips Memilih Lokasi Strategis untuk Toko Retail Anda',
                'slug' => 'tips-memilih-lokasi-strategis',
                'excerpt' => 'Lokasi menentukan 50% keberhasilan bisnis retail. Gunakan data ini sebelum menyewa ruko.',
                'content' => 'Pemilihan lokasi harus didasarkan pada riset demografi dan lalu lintas pejalan kaki, bukan sekadar harga murah...',
                'image' => 'https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?auto=format&fit=crop&q=80&w=800',
                'category_name' => 'Properti',
                'is_featured' => false,
                'published_at' => now()->subDays(2)->subHours(8),
            ],
            [
                'title' => 'Cara Mencari Supplier Tangan Pertama dari Luar Negeri',
                'slug' => 'supplier-tangan-pertama-luar-negeri',
                'excerpt' => 'Langkah demi langkah impor barang dalam jumlah kecil untuk dijual kembali dengan profit tinggi.',
                'content' => 'Banyak dropshipper sukses memulai perjalanan mereka dengan mencari supplier langsung melalui platform global...',
                'image' => 'https://images.unsplash.com/photo-1566576721346-d4a3b4eaad5b?auto=format&fit=crop&q=80&w=800',
                'category_name' => 'Operasional',
                'is_featured' => false,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Manfaat Mendaftarkan Hak Kekayaan Intelektual (HKI) Merek',
                'slug' => 'manfaat-hki-merek-bisnis',
                'excerpt' => 'Lindungi nama bisnis Anda dari peniru sebelum terlambat. HKI adalah aset berharga.',
                'content' => 'Nama brand adalah identitas. Tanpa perlindungan HKI, orang lain bisa mencuri identitas yang Anda bangun selama bertahun-tahun...',
                'image' => 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&q=80&w=800',
                'category_name' => 'Hukum',
                'is_featured' => false,
                'published_at' => now()->subDays(3)->subHours(4),
            ],
            [
                'title' => 'Strategi Cross-Selling untuk Meningkatkan Nilai Transaksi',
                'slug' => 'strategi-cross-selling-umkm',
                'excerpt' => 'Tawaran pelengkap saat checkout bisa meningkatkan profit hingga 30% tanpa biaya iklan tambahan.',
                'content' => 'Apakah Anda ingin kentang goreng dengan burger Anda? Kalimat sederhana ini adalah contoh cross-selling paling sukses di dunia...',
                'image' => 'https://images.unsplash.com/photo-1556742044-3c52d6e88c62?auto=format&fit=crop&q=80&w=800',
                'category_name' => 'Sales',
                'is_featured' => false,
                'published_at' => now()->subDays(4),
            ],
            [
                'title' => 'Cara Menghadapi Komplain Pelanggan dengan Teknik HEARD',
                'slug' => 'teknik-heard-komplain-pelanggan',
                'excerpt' => 'Ubah pelanggan yang marah menjadi pelanggan setia yang paling loyal kepada bisnis Anda.',
                'content' => 'Teknik HEARD (Hear, Empathize, Apologize, Resolve, Diagnose) dikembangkan oleh Disney untuk menangani masalah layanan...',
                'image' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&q=80&w=800',
                'category_name' => 'Layanan',
                'is_featured' => false,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Peluang Bisnis Ramah Lingkungan di Indonesia 2026',
                'slug' => 'peluang-bisnis-hijau-indonesia',
                'excerpt' => 'Konsumen kini lebih peduli pada lingkungan. Simak ide bisnis tanpa limbah yang menguntungkan.',
                'content' => 'Ekonomi hijau bukan lagi tren sesaat, melainkan pergeseran mendasar dalam perilaku konsumsi masyarakat dunia...',
                'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&q=80&w=800',
                'category_name' => 'Ekonomi',
                'is_featured' => false,
                'published_at' => now()->subDays(6),
            ],
            [
                'title' => 'Seni Negosiasi Bisnis untuk Mendapatkan Harga Terbaik',
                'slug' => 'seni-negosiasi-bisnis-sukses',
                'excerpt' => 'Jangan langsung setuju dengan harga pertama. Gunakan trik psikologi ini saat berhadapan dengan vendor.',
                'content' => 'Negosiasi bukan tentang menang atau kalah, melainkan tentang membangun kemitraan yang saling menguntungkan di titik harga yang tepat...',
                'image' => 'https://images.unsplash.com/photo-1573497620053-ea5310f94a17?auto=format&fit=crop&q=80&w=800',
                'category_name' => 'Bisnis',
                'is_featured' => false,
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Mengapa UMKM Harus Memiliki Laporan Laba Rugi Bulanan',
                'slug' => 'pentingnya-laporan-laba-rugi-umkm',
                'excerpt' => 'Bisnis Anda untung atau cuma terlihat ramai? Laporan keuangan akan menjawab kebenarannya.',
                'content' => 'Tanpa laporan keuangan, Anda mengemudikan bisnis Anda di tengah kabut tebal tanpa navigasi yang jelas...',
                'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=800',
                'category_name' => 'Keuangan',
                'is_featured' => false,
                'published_at' => now()->subDays(8),
            ],
            [
                'title' => 'Ide Konten TikTok Viral untuk Jualan Produk Fisik',
                'slug' => 'ide-konten-tiktok-jualan-viral',
                'excerpt' => 'Gunakan hook yang kuat dalam 3 detik pertama agar video Anda masuk FYP dan kebanjiran order.',
                'content' => 'Algoritma TikTok sangat bergantung pada retensi penonton. Berikut adalah 10 template konten yang terbukti mendongkrak penjualan...',
                'image' => 'https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?auto=format&fit=crop&q=80&w=800',
                'category_name' => 'Marketing',
                'is_featured' => false,
                'published_at' => now()->subDays(9),
            ],
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
