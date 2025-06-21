<?php

// app/Models/Pju2.php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Pju7 extends Model
{
    protected $table = 'pju_7'; 
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

        static::creating(function ($pju7) {
            $today = Carbon::today();
            // $totalDayaHarian = static::whereDate('created_at', $today)->sum('daya');
            // $pju7->daya_harian = $totalDayaHarian + $pju7->daya;
        });
    }
}
