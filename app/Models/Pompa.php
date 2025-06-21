<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pompa extends Model
{
    protected $table = 'data_pompa';
    protected $fillable = [
        'debit',
        'volume',
        'tegangan_dc',
        'daya_dc',
        'energi_harian',
        'durasi_harian',
        'volume_total',
        'energi_total',
        'durasi_total',
        'latitude',
        'longitude'
    ];
}
