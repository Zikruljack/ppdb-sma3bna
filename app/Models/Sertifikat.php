<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Sertifikat extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "sertifikat";
    protected $fillable = [
        'berkas_id',
        'file_path',
        'nama_sertifikat',
        'penandatangan_sertifikat',
        'jenis_sertifikat',
        'tanggal_dikeluarkan',
        'juara',
        'tingkat_kejuaraan',
    ];

    public function berkas()
    {
        return $this->belongsTo(BerkasPpdb::class, 'berkas_id');
    }
}

