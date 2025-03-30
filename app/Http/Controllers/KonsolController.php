<?php

namespace App\Http\Controllers;

use App\Models\Konsol;
use App\Models\Firmware;
use App\Models\Supplier;
use App\Models\JenisKonsol;
use Illuminate\Http\Request;

class KonsolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $konsols = Konsol::all();
        return view('konsol.index', compact('konsols'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $jenis_konsols = JenisKonsol::all();
        $firmwares = Firmware::all();
        return view('konsol.create', compact('suppliers', 'jenis_konsols', 'firmwares'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'jenis_konsol_id' => 'required|exists:jenis_konsols,id',
            'firmware_id' => 'required|exists:firmware,id',
            'seri' => 'required|string',
            'harga' => 'required|numeric',
            'tanggal_kedatangan' => 'required|date',
            'status' => 'required|string',
        ]);

        Konsol::create($request->all());

        return redirect()->route('konsol.index')->with('success', 'Konsol berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $konsol = Konsol::findOrFail($id);
        $suppliers = Supplier::all();
        $jenis_konsols = JenisKonsol::all();
        $firmwares = Firmware::all();
        return view('konsol.edit', compact('konsol', 'suppliers', 'jenis_konsols', 'firmwares'));
    }

    public function update(Request $request, $id)
    {
        $konsol = Konsol::findOrFail($id);

        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'jenis_konsol_id' => 'required|exists:jenis_konsols,id',
            'firmware_id' => 'required|exists:firmware,id',
            'seri' => 'required|string',
            'harga' => 'required|numeric',
            'tanggal_kedatangan' => 'required|date',
            'status' => 'required|string',
        ]);

        $konsol->update($request->except(['_token', '_method']));

        return redirect()->route('konsol.index')->with('success', 'Konsol berhasil diperbarui!');
    }

    public function destroy(Konsol $konsol)
    {
        $konsol->delete();

        return redirect()->route('konsol.index')->with('success', 'Konsol berhasil dihapus.');
    }
}
