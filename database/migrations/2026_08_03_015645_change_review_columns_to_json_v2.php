<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah data lama menjadi format JSON
        DB::table('review')->get()->each(function ($item) {

            DB::table('review')
                ->where('id', $item->id)
                ->update([
                    'pekerjaan' => json_encode([
                        'id' => $item->pekerjaan,
                        'en' => '',
                        'jp' => '',
                    ]),
                    'review' => json_encode([
                        'id' => $item->review,
                        'en' => '',
                        'jp' => '',
                    ]),
                ]);
        });

        Schema::table('review', function (Blueprint $table) {
            $table->json('pekerjaan')->change();
            $table->json('review')->change();
        });
    }

    public function down(): void
    {
        Schema::table('review', function (Blueprint $table) {
            $table->string('pekerjaan')->change();
            $table->text('review')->change();
        });
    }
};