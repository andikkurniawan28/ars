<?php

namespace App\Http\Controllers;

use App\Models\Firmware;
use Illuminate\Http\Request;

class FirmwareController extends Controller
{
    /**
     * Tampilkan daftar firmware.
     */
    public function index()
    {
        $firmwares = Firmware::all();
        return view('firmware.index', compact('firmwares'));
    }

    /**
     * Tampilkan form untuk menambahkan firmware baru.
     */
    public function create()
    {
        return view('firmware.create');
    }

    /**
     * Simpan firmware baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|unique:firmwares,nama',
        ]);

        Firmware::create($request->all());

        return redirect()->route('firmware.index')->with('success', 'Firmware berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail firmware tertentu.
     */
    public function show(Firmware $firmware)
    {
        return view('firmware.show', compact('firmware'));
    }

    /**
     * Tampilkan form untuk edit firmware tertentu.
     */
    public function edit(Firmware $firmware)
    {
        return view('firmware.edit', compact('firmware'));
    }

    /**
     * Update data firmware tertentu di database.
     */
    public function update(Request $request, Firmware $firmware)
    {
        $request->validate([
            'nama' => 'required|string|unique:firmwares,nama,' . $firmware->id,
        ]);

        $firmware->update($request->all());

        return redirect()->route('firmware.index')->with('success', 'Firmware berhasil diperbarui.');
    }

    /**
     * Hapus firmware tertentu dari database.
     */
    public function destroy(Firmware $firmware)
    {
        $firmware->delete();

        return redirect()->route('firmware.index')->with('success', 'Firmware berhasil dihapus.');
    }
}
