<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class NilaiRapor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nilai_rapor';

    protected $fillable = ['user_id', 'mapel_id', 'semester', 'nilai', 'scan_rapor'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }
}
