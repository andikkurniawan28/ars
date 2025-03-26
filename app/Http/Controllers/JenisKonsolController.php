<?php

namespace App\Http\Controllers;

use App\Models\JenisKonsol;
use Illuminate\Http\Request;

class JenisKonsolController extends Controller
{
    /**
     * Tampilkan daftar jeniskonsol.
     */
    public function index()
    {
        $jeniskonsols = JenisKonsol::all();
        return view('jeniskonsols.index', compact('jeniskonsols'));
    }

    /**
     * Tampilkan form untuk menambahkan jeniskonsol baru.
     */
    public function create()
    {
        return view('jeniskonsols.create');
    }

    /**
     * Simpan jeniskonsol baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|unique:jeniskonsols,nama',
        ]);

        JenisKonsol::create($request->all());

        return redirect()->route('jeniskonsols.index')->with('success', 'JenisKonsol berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail jeniskonsol tertentu.
     */
    public function show(JenisKonsol $jeniskonsol)
    {
        return view('jeniskonsols.show', compact('jeniskonsol'));
    }

    /**
     * Tampilkan form untuk edit jeniskonsol tertentu.
     */
    public function edit(JenisKonsol $jeniskonsol)
    {
        return view('jeniskonsols.edit', compact('jeniskonsol'));
    }

    /**
     * Update data jeniskonsol tertentu di database.
     */
    public function update(Request $request, JenisKonsol $jeniskonsol)
    {
        $request->validate([
            'nama' => 'required|string|unique:jeniskonsols,nama,' . $jeniskonsol->id,
        ]);

        $jeniskonsol->update($request->all());

        return redirect()->route('jeniskonsols.index')->with('success', 'JenisKonsol berhasil diperbarui.');
    }

    /**
     * Hapus jeniskonsol tertentu dari database.
     */
    public function destroy(JenisKonsol $jeniskonsol)
    {
        $jeniskonsol->delete();

        return redirect()->route('jeniskonsols.index')->with('success', 'JenisKonsol berhasil dihapus.');
    }
}
