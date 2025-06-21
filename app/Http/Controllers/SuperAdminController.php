<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        return view('superadmin.dashboard');
    }

    public function umkmIndex()
    {
        return view('superadmin.umkm.index');
    }

    public function galeriIndex()
    {
        return view('superadmin.galeri.index');
    }

    public function timerIndex()
    {
        return view('superadmin.timer.index');
    }

    public function profileEdit()
    {
        return view('superadmin.profile.edit');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}