<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

class UserController extends Controller
{
    public function index()
    {
        // Menggunakan latest() agar user baru muncul di atas
        $users = User::latest()->get();
        return view('admin.user.index', compact('users'));
    }

    public function store(Request $request)
    {
        // 1. Tambahkan Validasi (Sangat Penting!)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8',
        ], [
            // Custom pesan error (opsional)
            'email.unique' => 'Email ini sudah terdaftar!',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        // 2. Simpan Data
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3. Kembalikan dengan pesan sukses
        return back()->with('success', 'User admin berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Mencegah admin menghapus dirinya sendiri
        // Menggunakan Auth::id() lebih ringkas daripada auth()->user()->id
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun Anda sendiri yang sedang digunakan!');
        }

        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }
}
