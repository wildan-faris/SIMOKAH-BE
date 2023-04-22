<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalNilaiKelas extends Model
{
    protected $fillable = [
        'sub_aktivitas_id',
        'nilai',
        'kelas_id',



    ];
}
