<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AccountLog;

class LogAccountLogin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            AccountLog::create([
                'user_id' => Auth::id(),
                'role' => Auth::user()->role,
                'login_time' => now(),
            ]);
        }

        return $next($request);
    }
}

