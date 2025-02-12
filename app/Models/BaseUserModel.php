<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class BaseUserModel extends Authenticatable implements MustVerifyEmail
{
    //
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $guarded = [];
    protected $hidden = ['password'];
}
