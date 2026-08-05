<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Backup isi lama sebelum diubah ke JSON,
        // supaya data lama otomatis jadi versi "id"
        $blogs = DB::table('blog')->get(['id', 'title', 'caption', 'content']);

        Schema::table('blog', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('caption')->change();
            $table->json('content')->change();
        });

        foreach ($blogs as $blog) {
            DB::table('blog')->where('id', $blog->id)->update([
                'title'   => json_encode(['id' => $blog->title]),
                'caption' => json_encode(['id' => $blog->caption]),
                'content' => json_encode(['id' => $blog->content]),
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('blog', function (Blueprint $table) {
            $table->string('title')->change();
            $table->text('caption')->change();
            $table->longText('content')->change();
        });
    }
};