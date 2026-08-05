<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan semua user
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    // Form tambah user
    public function create()
    {
        return view('admin.user.create');
    }

    // Simpan user
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'nama' => 'required',
            'password' => 'required|min:6',
            'level' => 'required|in:admin,petugas,user',
        ]);

        User::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'level' => $request->level,
        ]);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    // Form edit
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:users,username,' . $id,
            'nama' => 'required',
            'level' => 'required|in:admin,petugas,user',
        ]);

        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->level = $request->level;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.index')
            ->with('success', 'User berhasil diupdate');
    }

    // Hapus user
    public function destroy($id)
    {
        User::destroy($id);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil dihapus');
    }
}