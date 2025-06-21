<?php

// app/Models/Pju.php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Pju_all extends Model
{
    protected $table = 'pju_all'; 
    protected $fillable = [
        'daya',
        'daya_harian',
        'arus',
        'profit_harian',
        'daya_total',
        'profit_total',
        'bebas_emisi',
    ];
    
        public function setDayaHarianAttribute($value)
    {
        $this->attributes['daya_harian'] = number_format($value, 3, '.', '');
    }
    
    public static function boot()
    {
        parent::boot();

        static::creating(function ($pju) {
            $today = Carbon::today();
            $totalDayaHarian = static::whereDate('created_at', $today)->sum('daya');
            $pju->daya_harian = $totalDayaHarian + $pju->daya;
        });
    }
}
