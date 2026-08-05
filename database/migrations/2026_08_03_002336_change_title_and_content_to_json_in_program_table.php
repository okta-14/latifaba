<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Backup isi lama sebelum diubah ke JSON
        $programs = DB::table('program')->get([
            'id',
            'title',
            'content'
        ]);

        Schema::table('program', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('content')->change();
        });

        foreach ($programs as $program) {

            DB::table('program')
                ->where('id', $program->id)
                ->update([
                    'title' => json_encode([
                        'id' => $program->title
                    ]),

                    'content' => json_encode([
                        'id' => $program->content
                    ]),
                ]);
        }
    }

    public function down(): void
    {
        // Backup data JSON
        $programs = DB::table('program')->get([
            'id',
            'title',
            'content'
        ]);

        Schema::table('program', function (Blueprint $table) {
            $table->string('title')->change();
            $table->longText('content')->change();
        });

        foreach ($programs as $program) {

            $title = json_decode($program->title, true);
            $content = json_decode($program->content, true);

            DB::table('program')
                ->where('id', $program->id)
                ->update([
                    'title' => $title['id'] ?? '',
                    'content' => $content['id'] ?? '',
                ]);
        }
    }
};