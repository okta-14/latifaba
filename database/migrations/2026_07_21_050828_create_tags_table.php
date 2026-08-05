<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('title',255)->unique();
            $table->string('hit',255)->default(0);
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('tags');
       
    }
};
