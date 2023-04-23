<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepalaSekolah extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo_profil',
    ];
}
