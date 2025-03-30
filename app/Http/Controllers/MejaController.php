<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Konsol;
use App\Models\Cabang;
use App\Models\JenisMeja;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mejas = Meja::all();
        return view('meja.index', compact('mejas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cabangs = Cabang::all();
        $konsols = Konsol::all();
        return view('meja.create', compact('cabangs', 'konsols'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'cabang_id' => 'required|exists:cabangs,id',
            'konsol_id' => 'required|exists:konsols,id',
            'nama' => 'required|string',
            'status' => 'required|string',
        ]);

        Meja::create($request->all());

        return redirect()->route('meja.index')->with('success', 'Meja berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $meja = Meja::findOrFail($id);
        $cabangs = Cabang::all();
        $konsols = Konsol::all();
        return view('meja.edit', compact('meja', 'cabangs', 'konsols'));
    }

    public function update(Request $request, $id)
    {
        $meja = Meja::findOrFail($id);

        $request->validate([
            'cabang_id' => 'required|exists:cabangs,id',
            'konsol_id' => 'required|exists:konsols,id',
            'nama' => 'required|string',
            'status' => 'required|string',
        ]);

        $meja->update($request->except(['_token', '_method']));

        return redirect()->route('meja.index')->with('success', 'Meja berhasil diperbarui!');
    }

    public function destroy(Meja $meja)
    {
        $meja->delete();

        return redirect()->route('meja.index')->with('success', 'Meja berhasil dihapus.');
    }
}
