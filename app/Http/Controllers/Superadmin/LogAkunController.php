<?php
// app/Http/Controllers/Superadmin/LogAkunController.php

// app/Http/Controllers/Superadmin/LogAkunController.php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LogAkun; // Assuming you have a LogAkun model

class LogAkunController extends Controller
{
    public function index()
    {
        $logAkuns = LogAkun::all(); // Retrieve all log akun records
        return view('superadmin.log.akun', compact('logAkuns'));
    }

    public function create()
    {
        return view('logakun.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $logAkun = new LogAkun();
        $logAkun->username = $request->input('username');
        $logAkun->email = $request->input('email');
        $logAkun->password = bcrypt($request->input('password'));
        $logAkun->save();

        return redirect()->route('superadmin.log.akun.index')->with('success', 'Log akun created successfully');
    }

    public function edit($id)
    {
        $logAkun = LogAkun::find($id);
        return view('logakun.edit', compact('logAkun'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required|email',
        ]);

        $logAkun = LogAkun::find($id);
        $logAkun->username = $request->input('username');
        $logAkun->email = $request->input('email');
        $logAkun->save();

        return redirect()->route('superadmin.log.akun.index')->with('success', 'Log akun updated successfully');
    }

    public function destroy($id)
    {
        LogAkun::find($id)->delete();
        return redirect()->route('superadmin.log.akun.index')->with('success', 'Log akun deleted successfully');
    }
}