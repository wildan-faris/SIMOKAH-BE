<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = [
        'name',
        'nis',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'orang_tua_id',
        'kelas_id',
        'tahun_ajaran'
    ];

    public function orang_tua()
    {
        return $this->belongsTo(OrangTua::class);
    }
}
