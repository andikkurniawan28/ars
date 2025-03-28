<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cabang;
use App\Models\Peran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['cabang', 'peran'])->get();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $cabangs = Cabang::all();
        $perans = Peran::all();
        return view('user.create', compact('cabangs', 'perans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'alamat' => 'required',
            'whatsapp' => 'required|unique:users',
            'status' => 'boolean',
            'cabang_id' => 'nullable|exists:cabangs,id',
            'peran_id' => 'required|exists:perans,id',
        ]);

        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'alamat' => $request->alamat,
            'whatsapp' => $request->whatsapp,
            'status' => $request->status ?? 0,
            'cabang_id' => $request->cabang_id,
            'peran_id' => $request->peran_id,
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $cabangs = Cabang::all();
        $perans = Peran::all();
        return view('user.edit', compact('user', 'cabangs', 'perans'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'password' => 'nullable|min:6',
            'alamat' => 'required',
            'whatsapp' => 'required|unique:users,whatsapp,' . $id,
            'status' => 'nullable',
            'cabang_id' => 'nullable|exists:cabangs,id',
            'peran_id' => 'required|exists:perans,id',
        ]);

        $user->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'alamat' => $request->alamat,
            'whatsapp' => $request->whatsapp,
            'cabang_id' => $request->cabang_id,
            'peran_id' => $request->peran_id,
            'status' => $request->has('status') ? 1 : 0, // Konversi "on" menjadi 1 atau 0
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => bcrypt($request->password)]);
        }

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
    }
}
