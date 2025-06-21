<?php

// app/Models/Pju.php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Pju extends Model
{
    protected $table = 'pju'; 
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
