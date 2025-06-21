<?php
// app/Http/Controllers/Superadmin/DashboardController.php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('superadmin.dashboard');
    }
}