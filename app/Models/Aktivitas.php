<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    protected $fillable = [
        'name',
    ];

    public function sub_aktivitas()
    {
        return $this->hasMany(SubAktivitas::class);
    }
}
