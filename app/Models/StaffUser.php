<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffUser extends Model
{
    //
    protected $table = 'user_staff';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_lengkap', 'nomor_telepon', 'alamat', 'tanggal_lahir', 'jabatan', 'nip', 'tanggal_bergabung'];


    //refer to user_id
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
