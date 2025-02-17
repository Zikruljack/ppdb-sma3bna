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
        // Tambahkan kolom ke tabel berkas_ppdb
        Schema::table('berkas_ppdb', function (Blueprint $table) {
            $table->string('sk_ketua_osis')->nullable();
            $table->string('periode')->nullable();
        });

        // Hapus kolom dari tabel sertifikat
        Schema::table('sertifikat', function (Blueprint $table) {
            $table->dropColumn(['sk_ketua_osis', 'periode']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tambahkan kembali kolom ke tabel sertifikat
        Schema::table('sertifikat', function (Blueprint $table) {
            $table->string('sk_ketua_osis')->nullable();
            $table->string('periode')->nullable();
        });

        // Hapus kolom dari tabel berkas_ppdb
        Schema::table('berkas_ppdb', function (Blueprint $table) {
            $table->dropColumn(['sk_ketua_osis', 'periode']);
        });
    }
};
