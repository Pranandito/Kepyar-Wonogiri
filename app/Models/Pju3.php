<?php

// app/Models/Pju2.php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Pju3 extends Model
{
    protected $table = 'pju_3'; 
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
