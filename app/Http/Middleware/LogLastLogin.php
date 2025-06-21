<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\LoginHistory;

class LogLastLogin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            LoginHistory::create([
                'user_id' => Auth::id(),
                'logged_in_at' => now(),
            ]);
        }

        return $next($request);
    }
}
