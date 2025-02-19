<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaianPeserta extends Model
{
    //
    protected $table = 'penilaian_peserta';

    protected $fillable = [
        'user_id',
        'bobot_nilai_rapor',
        'bobot_nilai_sertifikat',
        'bobot_nilai_wawancara',
        'bobot_nilai_baca_quran',
        'verifikator',
    ];
}
