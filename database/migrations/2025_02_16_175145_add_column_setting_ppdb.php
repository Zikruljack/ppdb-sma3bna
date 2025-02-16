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
        Schema::table('settings_ppdb', function (Blueprint $table) {
            // waktu pembukaan ppdb
            $table->time('waktu_pembukaan_ppdb')->nullable();
            // waktu tutup ppdb
            $table->time('waktu_tutup_ppdb')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings_ppdb', function (Blueprint $table) {
            //
            $table->dropColumn('waktu_pembukaan_ppdb');
            $table->dropColumn('waktu_tutup_ppdb');
        });
    }
};
