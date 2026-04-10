<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Kuliner', 'icon' => '🍔', 'description' => 'Makanan dan minuman lezat.'],
            ['name' => 'Fashion & Batik', 'icon' => '👗', 'description' => 'Pakaian dan kain tradisional.'],
            ['name' => 'Kecantikan & Perawatan', 'icon' => '💄', 'description' => 'Produk kecantikan dan perawatan diri.'],
            ['name' => 'Pendidikan & Kursus', 'icon' => '📚', 'description' => 'Lembaga pendidikan dan pelatihan.'],
            ['name' => 'Teknologi & Digital', 'icon' => '💻', 'description' => 'Solusi teknologi dan layanan digital.'],
            ['name' => 'Pertanian & Agribisnis', 'icon' => '🌱', 'description' => 'Hasil tani dan produk agribisnis.'],
            ['name' => 'Kerajinan & Souvenir', 'icon' => '🎨', 'description' => 'Produk kerajinan tangan unik.'],
            ['name' => 'Properti & Interior', 'icon' => '🏠', 'description' => 'Layanan properti dan desain interior.'],
            ['name' => 'Kesehatan & Wellness', 'icon' => '🏥', 'description' => 'Layanan kesehatan dan kebugaran.'],
            ['name' => 'Otomotif & Bengkel', 'icon' => '🚗', 'description' => 'Layanan otomotif dan perawatan kendaraan.'],
        ];

        foreach ($categories as $index => $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'icon' => $category['icon'],
                'description' => $category['description'],
                'is_active' => true,
                'order' => $index,
            ]);
        }
    }
}
