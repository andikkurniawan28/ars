<?php

namespace App\Http\Controllers;

use App\Models\Peran;
use Illuminate\Http\Request;

class PeranController extends Controller
{
    /**
     * Tampilkan daftar peran.
     */
    public function index()
    {
        $perans = Peran::all();
        return view('perans.index', compact('perans'));
    }

    /**
     * Tampilkan form untuk menambahkan peran baru.
     */
    public function create()
    {
        return view('perans.create');
    }

    /**
     * Simpan peran baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|unique:perans,nama',
        ]);

        Peran::create($request->all());

        return redirect()->route('perans.index')->with('success', 'Peran berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail peran tertentu.
     */
    public function show(Peran $peran)
    {
        return view('perans.show', compact('peran'));
    }

    /**
     * Tampilkan form untuk edit peran tertentu.
     */
    public function edit(Peran $peran)
    {
        return view('perans.edit', compact('peran'));
    }

    /**
     * Update data peran tertentu di database.
     */
    public function update(Request $request, Peran $peran)
    {
        $request->validate([
            'nama' => 'required|string|unique:perans,nama,' . $peran->id,
        ]);

        $peran->update($request->all());

        return redirect()->route('perans.index')->with('success', 'Peran berhasil diperbarui.');
    }

    /**
     * Hapus peran tertentu dari database.
     */
    public function destroy(Peran $peran)
    {
        $peran->delete();

        return redirect()->route('perans.index')->with('success', 'Peran berhasil dihapus.');
    }
}
