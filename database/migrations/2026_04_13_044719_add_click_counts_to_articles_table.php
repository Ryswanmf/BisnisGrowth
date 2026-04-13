<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->unsignedBigInteger('whatsapp_clicks')->default(0)->after('view_count');
            $table->unsignedBigInteger('phone_clicks')->default(0)->after('whatsapp_clicks');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['whatsapp_clicks', 'phone_clicks']);
        });
    }
};
