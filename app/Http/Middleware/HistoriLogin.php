<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HistoriAkun;

class HistoriLogin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (in_array($user->role, ['admin', 'super_admin'])) {
                HistoriAkun::create([
                    'nama_akun' => $user->name,
                    'role' => $user->role,
                    'waktu_login' => now(),
                ]);
            }
        }
        return $next($request);
    }
}

