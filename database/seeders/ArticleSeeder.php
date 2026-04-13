<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        // Bersihkan folder lama agar rapi
        Storage::disk('public')->deleteDirectory('articles');
        Storage::disk('public')->makeDirectory('articles');

        $dataArticles = [
            ['title' => 'Strategi Digital Marketing UMKM 2026: Dominasi Video Pendek', 'category' => 'Digital Marketing', 'keyword' => 'marketing'],
            ['title' => 'Cara Mengelola Arus Kas Bisnis Agar Tetap Sehat dan Likuid', 'category' => 'Keuangan', 'keyword' => 'finance'],
            ['title' => 'Pentingnya Izin Usaha (NIB) sebagai Legalitas UMKM Modern', 'category' => 'Legalitas', 'keyword' => 'legal'],
            ['title' => 'Tips Memilih Lokasi Bisnis Kuliner: Strategi Hook dan Traffic', 'category' => 'Operasional', 'keyword' => 'restaurant'],
            ['title' => 'Membangun Branding yang Kuat dengan Biaya Minim dan Efektif', 'category' => 'Branding', 'keyword' => 'branding'],
        ];

        // Tambah data hingga 20
        for ($i = 6; $i <= 20; $i++) {
            $categories = ['Digital Marketing', 'Keuangan', 'Operasional', 'Legalitas', 'Branding'];
            $cat = $categories[array_rand($categories)];
            $dataArticles[] = [
                'title' => "Panduan Akselerasi Bisnis $cat: Rahasia Sukses Bagian ke-$i",
                'category' => $cat,
                'keyword' => 'business'
            ];
        }

        foreach ($dataArticles as $index => $data) {
            $slug = Str::slug($data['title']);
            $paths = [];

            // Generate 4 gambar unik untuk setiap artikel
            for ($imgIndex = 1; $imgIndex <= 4; $imgIndex++) {
                $imgName = "article-{$index}-{$imgIndex}.jpg";
                
                // Menggunakan placeholder yang stabil dan unik per gambar
                // Catatan: Di lingkungan lokal, ini hanya menyimpan path. 
                // Jika ingin download sungguhan, gunakan file_get_contents.
                $paths[$imgIndex] = "articles/" . $imgName;
                
                // Simulasi file ada (agar asset() tidak error)
                Storage::disk('public')->put($paths[$imgIndex], 'dummy content');
            }

            Article::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $data['title'],
                    'category_name' => $data['category'],
                    'excerpt' => "Pelajari panduan mendalam mengenai {$data['title']} untuk membantu UMKM Indonesia berkembang pesat di era digital.",
                    'content' => "Ini adalah konten artikel profesional tentang <strong>{$data['title']}</strong>. <br><br>Dalam dunia bisnis yang kompetitif, memahami {$data['category']} adalah kunci utama. Panduan ini akan membahas strategi langkah-demi-langkah, analisis pasar terbaru, dan tips praktis yang bisa langsung diterapkan oleh pelaku usaha. <br><br>Gunakan data dan wawasan ini untuk mengambil keputusan yang lebih tepat bagi pertumbuhan jangka panjang bisnis Anda.",
                    'image' => $paths[1],
                    'image_2' => $paths[2],
                    'image_3' => $paths[3],
                    'image_4' => $paths[4],
                    'image_alt' => $data['title'],
                    'is_published' => true,
                    'is_featured' => ($index < 4),
                    'published_at' => Carbon::now()->subDays($index),
                    'view_count' => rand(1000, 20000),
                    'click_count' => rand(500, 5000),
                    'whatsapp_clicks' => rand(10, 500),
                    'phone_clicks' => rand(5, 200),
                    'meta_title' => $data['title'] . ' | BisnisGrowth',
                    'meta_description' => "Baca panduan {$data['title']} selengkapnya hanya di BisnisGrowth.id",
                ]
            );
        }
    }
}
