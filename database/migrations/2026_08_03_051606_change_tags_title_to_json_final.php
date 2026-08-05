<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        // 1. hapus unique index lama di kolom title
        Schema::table('tags', function (Blueprint $table) {
            $table->dropUnique('tags_title_unique');
        });

        // 2. tambah kolom slug kalau belum ada
        if (!Schema::hasColumn('tags', 'slug')) {
            Schema::table('tags', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('title');
            });
        }

        // 3. isi slug + ubah data title jadi format JSON
        DB::table('tags')->get()->each(function ($item) {

            $decoded = json_decode($item->title, true);
            $isAlreadyJson = json_last_error() === JSON_ERROR_NONE && is_array($decoded);

            DB::table('tags')
                ->where('id', $item->id)
                ->update([
                    'slug'  => $item->slug ?: Str::slug($isAlreadyJson ? $decoded['id'] : $item->title),
                    'title' => $isAlreadyJson ? $item->title : json_encode([
                        'id' => $item->title,
                        'en' => '',
                        'jp' => '',
                    ]),
                ]);
        });

        // 4. ubah tipe kolom title jadi json, slug jadi unique
        Schema::table('tags', function (Blueprint $table) {
            $table->json('title')->change();
            $table->unique('slug');
        });
    }

    public function down(): void
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
            $table->string('title')->change();
            $table->unique('title');
        });
    }
};