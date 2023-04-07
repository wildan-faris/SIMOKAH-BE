<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubAktivitas extends Model
{
    protected $fillable = [
        'aktivitas_id',
        'name'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
