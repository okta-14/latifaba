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
        Schema::create('pengaturan', function (Blueprint $table) {

            $table->id();

            // ===== DATA PERUSAHAAN =====
            $table->string('company', 255);
            $table->text('address'); // VARCHAR 255 terlalu pendek untuk alamat
            $table->string('phone', 255);
            $table->string('fax', 255)->nullable();
            $table->string('email', 255);
            $table->string('website', 255)->nullable();

            // ===== KONTEN & WIDGET =====
            $table->text('map')->nullable(); // Google Maps iframe
            $table->text('script')->nullable(); // JavaScript tracking
            $table->text('intro')->nullable(); // Intro text
            $table->string('cek', 5)->nullable(); // Kode verifikasi?
            $table->text('url_popup')->nullable(); // URL popup
            $table->string('header', 255)->nullable(); // Header text

            // ===== GAMBAR (PATH) =====
            $table->text('favicon')->nullable(); // Path favicon
            $table->text('background')->nullable(); // Path background
            $table->text('background_intro')->nullable(); // Path background intro
            $table->text('logo')->nullable(); // Path logo
            $table->string('popup', 255)->nullable(); // Popup image?

            // ===== COPYRIGHT =====
            $table->string('copyright', 255)->nullable();

            // ===== SEO =====
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('seo')->nullable(); // SEO script/structured data

            // ===== LINK =====
            $table->text('catalog')->nullable(); // Link catalog
            $table->text('member')->nullable(); // Link member

            $table->timestamps();

            // ===== TAMBAHKAN INDEX =====
            $table->index('company');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan');
    }
};