<?php

namespace App\Http\Controllers;

use App\Models\JenisKonsol;
use Illuminate\Http\Request;

class JenisKonsolController extends Controller
{
    /**
     * Tampilkan daftar jenis_konsol.
     */
    public function index()
    {
        $jenis_konsols = JenisKonsol::all();
        return view('jenis_konsol.index', compact('jenis_konsols'));
    }

    /**
     * Tampilkan form untuk menambahkan jenis_konsol baru.
     */
    public function create()
    {
        return view('jenis_konsol.create');
    }

    /**
     * Simpan jenis_konsol baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|unique:jenis_konsols,nama',
        ]);

        JenisKonsol::create($request->all());

        return redirect()->route('jenis_konsol.index')->with('success', 'JenisKonsol berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail jenis_konsol tertentu.
     */
    public function show(JenisKonsol $jenis_konsol)
    {
        return view('jenis_konsol.show', compact('jenis_konsol'));
    }

    /**
     * Tampilkan form untuk edit jenis_konsol tertentu.
     */
    public function edit(JenisKonsol $jenis_konsol)
    {
        return view('jenis_konsol.edit', compact('jenis_konsol'));
    }

    /**
     * Update data jenis_konsol tertentu di database.
     */
    public function update(Request $request, JenisKonsol $jenis_konsol)
    {
        $request->validate([
            'nama' => 'required|string|unique:jenis_konsols,nama,' . $jenis_konsol->id,
        ]);

        $jenis_konsol->update($request->all());

        return redirect()->route('jenis_konsol.index')->with('success', 'JenisKonsol berhasil diperbarui.');
    }

    /**
     * Hapus jenis_konsol tertentu dari database.
     */
    public function destroy(JenisKonsol $jenis_konsol)
    {
        $jenis_konsol->delete();

        return redirect()->route('jenis_konsol.index')->with('success', 'JenisKonsol berhasil dihapus.');
    }
}
