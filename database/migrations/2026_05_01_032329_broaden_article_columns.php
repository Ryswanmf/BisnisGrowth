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
            // Drop unique index before changing to text
            $table->dropUnique(['slug']);
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->text('title')->nullable()->change();
            $table->text('slug')->nullable()->change();
            $table->text('meta_title')->nullable()->change();
            $table->text('meta_description')->nullable()->change();
            $table->text('image_alt')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('title', 255)->nullable()->change();
            $table->string('slug', 255)->unique()->change();
            $table->string('meta_title', 255)->nullable()->change();
            $table->string('meta_description', 255)->nullable()->change();
            $table->string('image_alt', 255)->nullable()->change();
        });
    }
};
