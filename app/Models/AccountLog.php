<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role',
        'login_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

