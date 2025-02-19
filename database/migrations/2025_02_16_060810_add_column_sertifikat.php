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
        Schema::table('sertifikat', function (Blueprint $table) {
            //tingkat kejuaraan
            $table->enum('tingkat_kejuaraan', ['kabupaten', 'kota', 'provinsi', 'nasional', 'internasional', 'lain'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sertifikat', function (Blueprint $table) {
            //
            $table->dropColumn('tingkat_kejuaraan');
        });
    }
};
