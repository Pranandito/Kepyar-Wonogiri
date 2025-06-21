<?php

// app/Models/Pju2.php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Pju5 extends Model
{
    protected $table = 'pju_5'; 
    protected $fillable = [
        'daya',
        'daya_harian',
        'tegangan',
        'profit_harian',
        'daya_total',
        'profit_total',
        'bebas_emisi',
    ];
}
