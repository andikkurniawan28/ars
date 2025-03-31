<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Konsol;
use App\Models\Cabang;
use App\Models\JenisAkun;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akuns = Akun::all();
        return view('akun.index', compact('akuns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cabangs = Cabang::all();
        return view('akun.create', compact('cabangs'));

    }

    public function store(Request $request)
    {
        $request->validate([
            // 'cabang_id' => 'nullable|exists:cabangs,id',
            'nama' => 'required|string',
            'saldo_normal' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        Akun::create($request->all());

        return redirect()->route('akun.index')->with('success', 'Akun berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $akun = Akun::findOrFail($id);
        $cabangs = Cabang::all();
        return view('akun.edit', compact('akun', 'cabangs'));
    }

    public function update(Request $request, $id)
    {
        $akun = Akun::findOrFail($id);

        $request->validate([
            // 'cabang_id' => 'nullable|exists:cabangs,id',
            'nama' => 'required|string',
            'saldo_normal' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        $akun->update($request->except(['_token', '_method']));

        return redirect()->route('akun.index')->with('success', 'Akun berhasil diperbarui!');
    }

    public function destroy(Akun $akun)
    {
        $akun->delete();

        return redirect()->route('akun.index')->with('success', 'Akun berhasil dihapus.');
    }
}
