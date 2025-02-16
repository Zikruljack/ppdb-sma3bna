<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbSettings extends Model
{
    //
    protected $table = 'ppdb_settings';
    protected $fillable = [
        'year',
        'mulai_pendaftaran',
        'akhir_pendaftaran',
        'mulai_verifikasi',
        'akhir_verifikasi',
        'jalur_pendaftaran',
        'tanggal_pengumuman',
        'kuota',
        'maksimal_umur',
        'status'
    ];

}
