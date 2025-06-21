<?php
// app/Http/Controllers/Superadmin/LoginController.php

// app/Http/Controllers/Superadmin/LoginController.php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('superadmin.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return redirect()->back()->withErrors(['email' => 'Invalid email or password']);
        }

        return redirect()->route('superadmin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('superadmin.login');
    }
}