<?php

// Timer.php (Model)
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
    protected $table = 'timer';
    protected $fillable = ['pju_id', 'on_time', 'off_time', 'condition'];
    
}
