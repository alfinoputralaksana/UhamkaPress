<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;

class AccountSettingsController extends Controller
{
    // Menampilkan halaman pengaturan akun
    public function showSettingsForm()
    {
        $categories = Category::all();
        return view('user.pengaturan_akun',compact('categories'));
    }

    // Memproses perubahan password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Memeriksa apakah password saat ini benar
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        // Memperbarui password
        $user->password = $request->new_password;
        $user->save();

        return redirect()->route('account.settings')->with('status', 'Password berhasil diperbarui.');
    }
}
