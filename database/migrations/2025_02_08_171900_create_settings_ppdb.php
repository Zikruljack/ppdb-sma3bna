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
            $table->date('mulai_pendaftaran')->nullable();
            $table->date('akhir_pendaftaran')->nullable();
            $table->date('mulai_verifikasi')->nullable();
            $table->date('akhir_verifikasi')->nullable();
            $table->string('jalur_pendaftaran')->nullable();
            $table->date('tanggal_pengumuman')->nullable();
            $table->integer('kuota')->nullable();
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
