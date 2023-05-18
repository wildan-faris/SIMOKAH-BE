<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalNilaiBulan extends Model
{
    protected $fillable = [
        'siswa_id',
        'sub_aktivitas_id',
        'aktivitas_id',
        'nilai',
        'bulan_id',

    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function aktivitas()
    {
        return $this->belongsTo(Aktivitas::class);
    }
    public function sub_aktivitas()
    {
        return $this->belongsTo(SubAktivitas::class);
    }

    public function bulan()
    {
        return $this->belongsTo(Bulan::class);
    }
}
