<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog', function (Blueprint $table) {

            $table->id();

            $table->date('date');

            $table->string('title',500);

            $table->string('slug',500)->unique();

            $table->text('img')->nullable();

            $table->string('caption',500)->nullable();

            $table->longText('content');

            $table->enum('status',['Show','Hide'])->default('Show');

            $table->integer('hit')->default(0);

            // disimpan seperti:
            // IT;AI;Teknologi
            $table->text('tags')->nullable();

            // disimpan seperti:
            // Digital Marketing;Bisnis;SEO
            $table->text('keyword')->nullable();

            $table->unsignedBigInteger('id_category');

            $table->foreign('id_category')
                    ->references('id')
                    ->on('kategori')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};