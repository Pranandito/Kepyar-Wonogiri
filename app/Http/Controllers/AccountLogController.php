<?php

namespace App\Http\Controllers;

use App\Models\AccountLog;
use Illuminate\Http\Request;

class AccountLogController extends Controller
{
    public function index()
    {
        $accountLogs = AccountLog::with('user')->get();
        return view('logakun.index', compact('accountLogs'));
    }

    public function destroyAll()
    {
        AccountLog::truncate();
        return redirect()->route('logakun.index')->with('success', 'All account logs have been deleted');
    }
}
