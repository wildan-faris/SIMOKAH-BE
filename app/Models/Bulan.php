<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bulan extends Model
{
    protected $fillable = [
        'bulan',
        'tahun',
    ];

    public function total_nilai_bulan()
    {
        return $this->hasMany(TotalNilaiBulan::class);
    }
    public function total_nilai_kelas_bulan()
    {
        return $this->hasMany(TotalNilaiKelasBulan::class);
    }
}
