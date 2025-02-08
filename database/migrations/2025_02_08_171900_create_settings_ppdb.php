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
        Schema::create('settings_ppdb', function (Blueprint $table) {
            $table->id();
            $table->string('year')->unique();
            $table->date('mulai_pendaftaran');
            $table->date('akhir_pendaftaran');
            $table->date('mulai_verifikasi');
            $table->date('akhir_verifikasi');
            $table->date('tanggal_pengumuman');
            $table->integer('kuota');
            $table->integer('maksimal_umur')->nullable();
            $table->enum('status', ['buka', 'tutup', 'mendatang'])->default('mendatang');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings_ppdb');
    }
};
