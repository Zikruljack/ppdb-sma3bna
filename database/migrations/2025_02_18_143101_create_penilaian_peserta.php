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
        Schema::create('penilaian_peserta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('bobot_nilai_rapor')->nullable();
            $table->string('bobot_nilai_sertifikat')->nullable();
            $table->string('bobot_nilai_wawancara')->nullable();
            $table->string('bobot_nilai_baca_quran')->nullable();
            $table->string('verifikator');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_peserta');
    }
};
