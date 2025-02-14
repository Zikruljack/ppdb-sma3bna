<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class BerkasPpdb extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "berkas_ppdb";
    protected $fillable = [
        'user_id',
        'kk_file',
        'tanggal_kk_dikeluarkan',
        'ktp_kia_file',
        'surat_keterangan_aktif',
        'akta_kelahiran_file',
    ];

    public function sertifikat()
    {
        return $this->hasMany(Sertifikat::class, 'berkas_id');
    }
}

