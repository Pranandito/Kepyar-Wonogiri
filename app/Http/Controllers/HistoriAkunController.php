<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoriAkun;

class HistoriAkunController extends Controller
{
    public function destroyAll()
    {
        HistoriAkun::truncate();
        return redirect()->back()->with('status', 'Histori akun berhasil dihapus.');
    }

    public function index()
    {
        $historiAkuns = HistoriAkun::all();
        return view('historiakun.index', compact('historiAkuns'));
    }
}

