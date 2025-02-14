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
        Schema::create('ppdb_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_lengkap');
            $table->string('nisn');
            $table->string('nik');
            $table->string('no_kk');
            $table->string('foto');
            $table->date('tanggal_kk_dikeluarkan');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('agama');
            $table->string('alamat');
            $table->enum('gol_darah', ['O', 'A', 'B', 'AB']);
            $table->integer('tinggi_badan');
            $table->integer('berat_badan');
            $table->string('kecamatan');
            $table->string('kabupaten_kota');
            $table->string('provinsi');
            $table->string('kode_pos');
            $table->string('tempat_tinggal');
            $table->string('jalur_pendaftaran');
            $table->string('kriteria_domisili')->nullable();
            $table->string('no_hp');
            $table->string('asal_sekolah');
            $table->string('npsn_asal_sekolah');
            $table->string('kabkota_asal_sekolah');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('pekerjaan_ayah');
            $table->string('pekerjaan_ibu');
            $table->string('jabatan_ayah');
            $table->string('jabatan_ibu');
            $table->string('alamat_ortu');
            $table->string('no_hp_ayah');
            $table->string('no_hp_ibu');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_user');
    }
};
