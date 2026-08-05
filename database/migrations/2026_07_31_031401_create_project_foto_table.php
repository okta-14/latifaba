<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_foto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_project');
            $table->text('img');
            $table->timestamps();

            $table->foreign('id_project')
                ->references('id')
                ->on('program')   
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_foto');
    }
};