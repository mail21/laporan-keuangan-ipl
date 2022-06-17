<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    public $incrementing = false;
    protected $primaryKey = 'kode';
    protected $fillable = [
        'kode',
        'email',
        'nama',
        'nomor_hp',
        'password',
        'role'
    ];
}
