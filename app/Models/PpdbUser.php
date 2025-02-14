<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PpdbUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $guard_name ='web';

    protected $table = 'ppdb_user';

    protected $fillable = [
        'user_id',
        'nomor_peserta',
        'nama_lengkap',
        'nisn',
        'nik',
        'no_kk',
        'foto',
        'tanggal_kk_dikeluarkan',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat',
        'gol_darah',
        'tinggi_badan',
        'berat_badan',
        'kecamatan',
        'kabupaten_kota',
        'provinsi',
        'kode_pos',
        'tempat_tinggal',
        'jalur_pendaftaran',
        'kriteria_domisili',
        'no_hp',
        'asal_sekolah',
        'npsn_asal_sekolah',
        'kabkota_asal_sekolah',
        'nama_ayah',
        'nama_ibu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'jabatan_ayah',
        'jabatan_ibu',
        'alamat_ortu',
        'no_hp_ayah',
        'no_hp_ibu',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function nilai_rapor()
    {
        return $this->belongsTo(NilaiRapor::class);
    }
}
