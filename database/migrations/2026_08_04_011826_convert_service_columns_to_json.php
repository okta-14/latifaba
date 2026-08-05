<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service', function (Blueprint $table) {
            $table->text('title_tmp')->nullable();
            $table->text('short_tmp')->nullable();
            $table->text('content_tmp')->nullable();
        });

        DB::table('service')->update([
            'title_tmp'   => DB::raw('title'),
            'short_tmp'   => DB::raw('short'),
            'content_tmp' => DB::raw('content'),
        ]);

        Schema::table('service', function (Blueprint $table) {
            $table->dropColumn(['title', 'short', 'content']);
        });

        Schema::table('service', function (Blueprint $table) {
            $table->json('title')->nullable();
            $table->json('short')->nullable();
            $table->json('content')->nullable();
        });

        foreach (DB::table('service')->get() as $row) {
            DB::table('service')->where('id', $row->id)->update([
                'title'   => json_encode(['id' => $row->title_tmp]),
                'short'   => json_encode(['id' => $row->short_tmp]),
                'content' => json_encode(['id' => $row->content_tmp]),
            ]);
        }

        Schema::table('service', function (Blueprint $table) {
            $table->dropColumn(['title_tmp', 'short_tmp', 'content_tmp']);
        });
    }

    public function down(): void
    {
        Schema::table('service', function (Blueprint $table) {
            $table->string('title')->nullable()->change();
            $table->text('short')->nullable()->change();
            $table->text('content')->nullable()->change();
        });
    }
};