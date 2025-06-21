<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Logakun;
use App\Models\Users;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LogAkunController extends Controller
{
    public function index()
    {
        $users = Users::all();
        if ($users->isEmpty()) {
            Log::info('No users found');
        } else {
            Log::info('Users found', ['users' => $users]);
        }
        return view('logakun.index', compact('users'));

        
    }
    
    public function create()
    {
        // Your logic to create a new log akun goes here
        return view('logakun.create'); // or redirect to a create form view
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,superadmin', // Validasi untuk role
        ]);

        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => bcrypt($request->password),
        //     'role' => $request->role,
        // ]);

        // Simpan data ke dalam tabel users
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('logakun.index')->with('success', 'Akun berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('logakun.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->role = $request->input('role');
        $user->save();

        return redirect()->route('logakun.index')->with('success', 'Akun berhasil diperbarui');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            Log::info('User deleted successfully', ['user' => $user]);
            return redirect()->route('logakun.index')->with('success', 'Akun berhasil dihapus');
        } else {
            Log::warning('User not found', ['user_id' => $id]);
            return redirect()->route('logakun.index')->with('error', 'Akun tidak ditemukan');
        }
    }
    
}
