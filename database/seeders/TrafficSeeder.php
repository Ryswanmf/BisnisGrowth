<?php

namespace Database\Seeders;

use App\Models\PageView;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TrafficSeeder extends Seeder
{
    public function run(): void
    {
        // Isi data untuk 30 hari terakhir agar trend mingguan/bulanan terisi
        for ($i = 0; $i < 200; $i++) {
            $date = Carbon::now()->subDays(rand(0, 30))->subHours(rand(0, 23));
            PageView::create([
                'type' => ['view', 'article', 'whatsapp', 'phone'][rand(0, 3)],
                'device' => ['Desktop', 'Mobile'][rand(0, 1)],
                'url' => '/',
                'ip_address' => '127.0.0.1',
                'created_at' => $date,
            ]);
        }

        // Tambahan data padat khusus 7 hari terakhir agar laporan harian terlihat ramai
        for ($day = 0; $day <= 6; $day++) {
            $date = Carbon::today()->subDays($day);
            for ($j = 0; $j < 15; $j++) {
                PageView::create([
                    'type' => ['view', 'article', 'whatsapp', 'phone'][rand(0, 3)],
                    'device' => ['Desktop', 'Mobile'][rand(0, 1)],
                    'url' => '/',
                    'ip_address' => '127.0.0.1',
                    'created_at' => $date->copy()->addHours(rand(1, 23)),
                ]);
            }
        }
    }
}
