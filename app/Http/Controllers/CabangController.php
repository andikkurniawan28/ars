<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;

class CabangController extends Controller
{
    /**
     * Tampilkan daftar cabang.
     */
    public function index()
    {
        $cabangs = Cabang::all();
        return view('cabangs.index', compact('cabangs'));
    }

    /**
     * Tampilkan form untuk menambahkan cabang baru.
     */
    public function create()
    {
        return view('cabangs.create');
    }

    /**
     * Simpan cabang baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|unique:cabangs,nama',
            'alamat' => 'required|string',
            'whatsapp' => 'required|string|unique:cabangs,whatsapp',
        ]);

        Cabang::create($request->all());

        return redirect()->route('cabangs.index')->with('success', 'Cabang berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail cabang tertentu.
     */
    public function show(Cabang $cabang)
    {
        return view('cabangs.show', compact('cabang'));
    }

    /**
     * Tampilkan form untuk edit cabang tertentu.
     */
    public function edit(Cabang $cabang)
    {
        return view('cabangs.edit', compact('cabang'));
    }

    /**
     * Update data cabang tertentu di database.
     */
    public function update(Request $request, Cabang $cabang)
    {
        $request->validate([
            'nama' => 'required|string|unique:cabangs,nama,' . $cabang->id,
            'alamat' => 'required|string',
            'whatsapp' => 'required|string|unique:cabangs,whatsapp,' . $cabang->id,
        ]);

        $cabang->update($request->all());

        return redirect()->route('cabangs.index')->with('success', 'Cabang berhasil diperbarui.');
    }

    /**
     * Hapus cabang tertentu dari database.
     */
    public function destroy(Cabang $cabang)
    {
        $cabang->delete();

        return redirect()->route('cabangs.index')->with('success', 'Cabang berhasil dihapus.');
    }
}
