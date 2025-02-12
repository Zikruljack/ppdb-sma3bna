<?php

namespace App\Models;

use App\Models\BaseUserModel;

class PpdbUser extends BaseUserModel
{
    // use HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $guard_name = 'web';

    protected $table = 'ppdb_user';

    protected $fillable = [
        'nama_lengkap',
        'nisn',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat',
        'rt',
        'rw',
        'dusun',
        'kelurahan',
        'kecamatan',
        'kabupaten_kota',
        'provinsi',
        'kode_pos',
        'tempat_tinggal',
        'jalur_pendaftaran',
        'kriteria_domisili',
        'no_hp',
        'asal_sekolah',
        'nomor_peserta_ujian',
    ];


    public function getFullnameAttribute()
    {
        return ucfirst($this->name);
    }

    //refer to user_id
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
