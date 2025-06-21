<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginHistory;

class LoginHistoryController extends Controller
{
    public function index()
    {
        $users = User::all(); // Retrieve all users
        $loginHistories = LoginHistory::all(); // Retrieve all login histories
        return view('logakun.index', compact('users', 'loginHistories')); // Pass the $users and $loginHistories variables to the view
    }

    public function destroyAll()
    {
        LoginHistory::truncate();
        return redirect()->route('logakun.index')->with('success', 'All login history has been deleted.');
    }
}
