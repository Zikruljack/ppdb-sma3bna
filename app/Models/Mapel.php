<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mapel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mapel';

    protected $fillable = ['nama'];

    public function nilaiRapors()
    {
        return $this->hasMany(NilaiRapor::class, 'mapel');
    }
}
