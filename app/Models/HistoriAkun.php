<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriAkun extends Model
{
    use HasFactory;

    protected $table = 'histori_akun';
    protected $fillable = ['nama_akun', 'role', 'waktu_login'];
}

