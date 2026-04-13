<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Kebijakan Privasi',
                'content' => '<h2>1. Informasi yang Kami Kumpulkan</h2><p>Kami mengumpulkan informasi untuk memberikan layanan yang lebih baik kepada semua pengguna kami. Informasi yang kami kumpulkan meliputi informasi yang Anda berikan kepada kami secara langsung, serta informasi yang kami dapatkan dari penggunaan Anda terhadap layanan kami (seperti alamat IP, jenis perangkat, dan halaman yang dikunjungi).</p><h2>2. Penggunaan Informasi</h2><p>Kami menggunakan informasi yang dikumpulkan untuk menyediakan, memelihara, melindungi, dan meningkatkan layanan kami, serta untuk melindungi BisnisGrowth dan pengguna kami.</p><h2>3. Keamanan Data</h2><p>Kami bekerja keras untuk melindungi BisnisGrowth dan pengguna kami dari akses tanpa izin atau perubahan, pengungkapan, atau penghancuran informasi yang kami pegang secara tidak sah.</p><h2>4. Perubahan Kebijakan</h2><p>Kebijakan Privasi kami dapat berubah dari waktu ke waktu. Kami akan memposting perubahan kebijakan privasi apa pun di halaman ini.</p>',
                'meta_description' => 'Kebijakan privasi resmi BisnisGrowth mengenai bagaimana kami mengelola dan melindungi data pengguna kami.',
            ],
            [
                'title' => 'Ketentuan Layanan',
                'content' => '<h2>1. Penerimaan Ketentuan</h2><p>Dengan mengakses dan menggunakan BisnisGrowth, Anda menerima dan setuju untuk terikat oleh syarat dan ketentuan layanan ini.</p><h2>2. Penggunaan Layanan</h2><p>Anda setuju untuk menggunakan layanan kami hanya untuk tujuan yang sah dan dengan cara yang tidak melanggar hak orang lain atau membatasi penggunaan dan kenikmatan orang lain terhadap layanan ini.</p><h2>3. Kekayaan Intelektual</h2><p>Seluruh konten, logo, dan desain yang ada di BisnisGrowth adalah milik intelektual kami dan dilindungi oleh hukum hak cipta yang berlaku di Indonesia.</p><h2>4. Batasan Tanggung Jawab</h2><p>BisnisGrowth tidak bertanggung jawab atas kerugian atau kerusakan yang timbul dari penggunaan Anda terhadap layanan kami atau informasi yang disediakan di situs ini.</p>',
                'meta_description' => 'Syarat dan ketentuan penggunaan layanan BisnisGrowth untuk para pengguna dan mitra UMKM.',
            ],
        ];

        foreach ($pages as $data) {
            Page::updateOrCreate(
                ['slug' => Str::slug($data['title'])],
                [
                    'title' => $data['title'],
                    'content' => $data['content'],
                    'meta_title' => $data['title'] . ' — BisnisGrowth',
                    'meta_description' => $data['meta_description'],
                    'is_published' => true,
                ]
            );
        }
    }
}
