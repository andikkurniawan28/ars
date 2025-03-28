<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Tampilkan daftar pelanggan.
     */
    public function index()
    {
        $pelanggans = Pelanggan::all();
        return view('pelanggan.index', compact('pelanggans'));
    }

    /**
     * Tampilkan form untuk menambahkan pelanggan baru.
     */
    public function create()
    {
        return view('pelanggan.create');
    }

    /**
     * Simpan pelanggan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|unique:pelanggans,nama',
            'alamat' => 'required|string',
            'whatsapp' => 'required|string|unique:pelanggans,whatsapp',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail pelanggan tertentu.
     */
    public function show(Pelanggan $pelanggan)
    {
        return view('pelanggan.show', compact('pelanggan'));
    }

    /**
     * Tampilkan form untuk edit pelanggan tertentu.
     */
    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update data pelanggan tertentu di database.
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'nama' => 'required|string|unique:pelanggans,nama,' . $pelanggan->id,
            'alamat' => 'required|string',
            'whatsapp' => 'required|string|unique:pelanggans,whatsapp,' . $pelanggan->id,
        ]);

        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diperbarui.');
    }

    /**
     * Hapus pelanggan tertentu dari database.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus.');
    }
}
