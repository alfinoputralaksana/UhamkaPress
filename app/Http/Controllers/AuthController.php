<?php
// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log; // Tambahkan Log

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $categories = Category::all();
        return view('login', compact('categories'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

        // Cek di tabel admins
        $admin = Admin::where('username', $request->username)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::guard('admin')->login($admin);
            return redirect()->intended('/admin/dashboard');
        }

        // Cek di tabel users
        $user = User::where('username', $request->username)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->intended('/home');
        }

        return redirect()->back()->withErrors(['username' => 'Username atau password salah.']);
    }

    public function showRegisterForm()
    {
        $categories = Category::all();
        return view('register', compact('categories'));
    }

   // AuthController.php
public function register(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Jika validasi gagal
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Pembuatan user baru, mutator akan otomatis meng-hash password
    $user = User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'password' => $request->password, // Tidak perlu menggunakan Hash::make()
    ]);

    // Login user setelah registrasi
    Auth::login($user);

    return redirect('/home');
}


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
