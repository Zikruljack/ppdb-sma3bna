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
            $table->string('nama_sertifikat')->nullable();
            $table->string('penandatangan_sertifikat')->nullable();
            $table->enum('jenis_sertifikat', ['akademik', 'non akademik']);
            $table->date('tanggal_dikeluarkan')->nullable();
            $table->string('institusi_penerbit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sertifikat', function (Blueprint $table) {
            //
            $table->dropColumn('nama_sertifikat');
            $table->dropColumn('penandatangan_sertifikat');
            $table->dropColumn('jenis_sertifikat');
            $table->dropColumn('tanggal_dikeluarkan');
            $table->dropColumn('institusi_penerbit');
        });
    }
};
