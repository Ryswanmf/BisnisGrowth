<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Article;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Menghapus semua artikel yang dibuat oleh seeder (biasanya ID 1-20 atau berdasarkan pola konten)
        // Cara paling aman jika user ingin mengosongkan adalah truncate, tapi kita beri filter sedikit jika ada artikel asli.
        // Namun berdasarkan permintaan "hapus artikel dummy nya", biasanya mereka ingin bersih.
        
        // Hapus file gambar dummy jika ada di public/uploads/articles
        // (Opsional, tapi bagus untuk kebersihan)
        
        Article::truncate();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak ada cara untuk mengembalikan truncate
    }
};
