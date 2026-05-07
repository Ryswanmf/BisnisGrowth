<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

#[Signature('app:clear-dummy-data')]
#[Description('Hapus semua data dummy kecuali tabel users')]
class ClearDummyDataCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->confirm('Apakah Anda yakin ingin menghapus semua data kecuali users?')) {
            return;
        }

        $this->info('Membersihkan data dummy...');

        Schema::disableForeignKeyConstraints();

        $tables = [
            'articles',
            'article_short_keyword',
            'businesses',
            'categories',
            'comments',
            'contact_messages',
            'domains',
            'domain_traffic_logs',
            'footer_settings',
            'internal_links',
            'links',
            'pages',
            'page_views',
            'short_keywords',
            'site_settings',
        ];

        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                DB::table($table)->truncate();
                $this->line("Tabel {$table} telah dikosongkan.");
            }
        }

        Schema::enableForeignKeyConstraints();

        $this->info('Semua data dummy telah berhasil dihapus!');
    }
}
