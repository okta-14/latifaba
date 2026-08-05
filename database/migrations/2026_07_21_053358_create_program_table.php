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
        Schema::create('program', function (Blueprint $table) {
            $table->id();
            $table->string('date', 20);
            $table->string('title', 500);
            $table->text('img')->nullable();
            $table->text('content');
            $table->enum('status', ['Show', 'Hide'])->default('Show');
            $table->integer('hit')->default(0);
            $table->text('url')->nullable();
            $table->text('lokasi')->nullable();
            $table->string('slug', 255);

            $table->unsignedBigInteger('id_category');
            $table->unsignedBigInteger('id_service');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program');
    }
};
