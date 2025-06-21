<?php

// app/Models/Pju2.php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Pju6 extends Model
{
    protected $table = 'pju_6'; 
    protected $fillable = [
        'daya',
        'daya_harian',
        'tegangan',
        'profit_harian',
        'daya_total',
        'profit_total',
        'bebas_emisi',
    ];
    
    public static function boot()
    {
        parent::boot();

        static::creating(function ($pju6) {
            $today = Carbon::today();
            // $totalDayaHarian = static::whereDate('created_at', $today)->sum('daya');
            // $pju6->daya_harian = $totalDayaHarian + $pju6->daya;
        });
    }
}
