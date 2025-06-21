<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pjuData = Pju_all::latest();
        return view('landingpage.pju', compact('pjuData'));
    }
}
