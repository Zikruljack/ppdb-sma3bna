<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbSettings extends Model
{
    protected $table = 'settings_ppdb';
    protected $fillable = [
        'year',
        'jalur_pendaftaran',
        'mulai_pendaftaran',
        'akhir_pendaftaran',
        'tanggal_pengumuman',
        'kuota',
        'status',
        'waktu_pembukaan_ppdb',
        'waktu_tutup_ppdb',
    ];

    public static function getCurrentSettings($year = null)
    {
        return self::where('year', $year ?? date('Y'))->get();
    }
}
