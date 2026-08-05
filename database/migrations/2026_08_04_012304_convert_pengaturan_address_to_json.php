<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaturan', function (Blueprint $table) {
            $table->text('address_tmp')->nullable();
        });

        DB::table('pengaturan')->update(['address_tmp' => DB::raw('address')]);

        Schema::table('pengaturan', function (Blueprint $table) {
            $table->dropColumn('address');
        });

        Schema::table('pengaturan', function (Blueprint $table) {
            $table->json('address')->nullable();
        });

        foreach (DB::table('pengaturan')->get() as $row) {
            DB::table('pengaturan')->where('id', $row->id)->update([
                'address' => json_encode(['id' => $row->address_tmp]),
            ]);
        }

        Schema::table('pengaturan', function (Blueprint $table) {
            $table->dropColumn('address_tmp');
        });
    }

    public function down(): void
    {
        Schema::table('pengaturan', function (Blueprint $table) {
            $table->text('address')->nullable()->change();
        });
    }
};