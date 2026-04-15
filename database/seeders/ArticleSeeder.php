<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        // Bersihkan data lama agar ID dimulai dari awal (untuk mempermudah shortcode)
        Article::truncate();

        $admin = User::where('role', 'admin')->first() ?: User::first();
        $categories = Category::where('is_active', true)->pluck('name')->toArray();
        if (empty($categories)) $categories = ['Digital Marketing', 'Keuangan', 'Operasional', 'Legalitas', 'Branding'];

        $topics = [
            ['title' => '{Strategi|Rahasia|Tips} Jitu Pemasaran {TikTok|Instagram} 2026', 'cat' => 'Digital Marketing'],
            ['title' => 'Cara {Mudah|Cepat} Daftar {NIB|Sertifikat Halal} untuk UMKM', 'cat' => 'Legalitas'],
            ['title' => '{Pentingnya|Manfaat} Audit Keuangan bagi {Bisnis Lokal|Startup}', 'cat' => 'Keuangan'],
            ['title' => 'Membangun {Sistem|SOP} Kerja yang {Efisien|Modern}', 'cat' => 'Operasional'],
            ['title' => '{Tren|Inovasi} Desain Produk yang Menjual di Tahun 2026', 'cat' => 'Branding'],
            ['title' => '{Panduan|Langkah} Optimasi Google Maps untuk Toko Anda', 'cat' => 'Digital Marketing'],
            ['title' => 'Mengelola {Stok|Inventori} Tanpa Ribet dengan Teknologi AI', 'cat' => 'Operasional'],
            ['title' => '{Analisis|Cara Baca} Laporan Arus Kas untuk Pemula', 'cat' => 'Keuangan'],
            ['title' => 'Kiat Sukses {Kolaborasi|Kemitraan} dengan Influencer Lokal', 'cat' => 'Branding'],
            ['title' => 'Legalitas {Usaha Dagang|CV|PT} Mana yang Lebih Cocok?', 'cat' => 'Legalitas'],
            ['title' => 'Meningkatkan {Loyalitas|Retensi} Pelanggan dengan CRM Sederhana', 'cat' => 'Digital Marketing'],
            ['title' => '{Tips|Cara} Negosiasi dengan Supplier agar Dapat Harga Terbaik', 'cat' => 'Operasional'],
            ['title' => 'Mengapa {Storytelling|Cerita} Penting untuk Brand Bisnis Anda?', 'cat' => 'Branding'],
            ['title' => 'Persiapan {Ekspor|Pasar Global} bagi Produk Lokal Indonesia', 'cat' => 'Operasional'],
            ['title' => 'Strategi {Harga|Pricing} agar Tetap Untung di Tengah Persaingan', 'cat' => 'Keuangan'],
            ['title' => 'Panduan {Copywriting|Menulis} Iklan yang Mematikan', 'cat' => 'Digital Marketing'],
            ['title' => 'Mengurus {Hak Kekayaan Intelektual|HAKI} Produk Anda', 'cat' => 'Legalitas'],
            ['title' => '{Kunci|Pondasi} Manajemen Tim yang Solid dan Loyal', 'cat' => 'Operasional'],
            ['title' => 'Membangun {Personal Branding|Citra Diri} sebagai Founder UMKM', 'cat' => 'Branding'],
            ['title' => 'Cara Memilih {Aplikasi Kasir|Point of Sale} yang Tepat', 'cat' => 'Keuangan'],
        ];

        foreach ($topics as $index => $t) {
            $id = $index + 1;
            $slug = Str::slug(str_replace(['{', '}', '|'], '-', $t['title'])) . '-' . $id;
            
            // Generate link kustom untuk simulasi
            $linkPerusahaan = '<a href="https://bisnisgrowth.id" class="text-amber-600 font-bold hover:underline">PT Bisnis Growth Indonesia</a>';
            $linkFounder = '<a href="#" class="text-amber-600 font-bold hover:underline">Riswan</a>';
            
            // Selipkan artikel terkait secara acak (mengacu ke ID lain)
            $relatedId = ($id == 1) ? 2 : $id - 1;
            $shortcode = '[related id="'.$relatedId.'"]';

            Article::create([
                'user_id' => $admin->id ?? null,
                'title' => $t['title'],
                'slug' => $slug,
                'category_name' => $t['cat'],
                'excerpt' => "{Simak|Baca|Berikut ini} ulasan lengkap mengenai {$t['title']} oleh tim ahli kami.",
                'content' => "
                    <h2>Pentingnya Strategi dalam Bisnis</h2>
                    <p>{Selamat pagi|Halo|Halo rekan-rekan} semua. Hari ini kita akan membahas sesuatu yang sangat {krusial|penting}, yaitu mengenai <strong>{$t['title']}</strong>.</p>
                    <p>Menurut pakar bisnis ternama, {$linkFounder}, setiap langkah yang diambil oleh {$linkPerusahaan} selalu didasarkan pada data riset pasar yang mendalam.</p>
                    
                    $shortcode

                    <h2>Langkah-Langkah Implementasi</h2>
                    <p>Strategi yang {efektif|tepat|jitu} adalah kunci pertumbuhan. Anda perlu melakukan riset, eksekusi, dan evaluasi secara berkala.</p>
                    <p>Banyak pengusaha sukses telah membuktikan bahwa dengan {$t['title']}, omzet mereka meningkat hingga {50%|70%|100%}.</p>
                    
                    <h2>Kesimpulan</h2>
                    <p>Semoga panduan mengenai {$t['title']} ini {bermanfaat|berguna} untuk bisnis Anda. Jangan lupa untuk terus berinovasi dan beradaptasi dengan teknologi terbaru.</p>
                ",
                'image' => 'articles/sample-' . (($id % 5) + 1) . '.webp',
                'image_2' => 'articles/sample-' . (($id % 5) + 2) . '.webp',
                'image_3' => 'articles/sample-' . (($id % 5) + 3) . '.webp',
                'image_4' => 'articles/sample-' . (($id % 5) + 4) . '.webp',
                'is_published' => true,
                'is_featured' => ($index < 4),
                'published_at' => Carbon::now()->subDays($index),
                'view_count' => rand(500, 10000),
                'click_count' => rand(100, 5000),
                'whatsapp_clicks' => rand(10, 500),
                'phone_clicks' => rand(5, 200),
                'meta_title' => $t['title'],
                'meta_description' => "Panduan strategis mengenai " . $t['title'] . " untuk kemajuan UMKM.",
            ]);
        }
    }
}
