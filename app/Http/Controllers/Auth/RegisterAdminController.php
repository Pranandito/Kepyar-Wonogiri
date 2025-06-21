<?php

// app/Http/Controllers/Auth/RegisterAdminController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterAdminController extends Controller
{
    public function create()
    {
        return view('auth.register-admin');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'equired|string|max:255',
            'email' => 'equired|string|email|max:255|unique:admins',
            'password' => 'equired|string|min:8|confirmed',
            'password_confirmation' => 'equired|string|min:8',
        ]);

        $admin = new Admin();
        $admin->nama = $request->input('nama');
        $admin->email = $request->input('email');
        $admin->password = Hash::make($request->input('password'));
        $admin->save();

        return redirect()->route('login-admin')->with('success', 'Akun admin berhasil dibuat!');
    }
}