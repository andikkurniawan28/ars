<?php

namespace App\Http\Controllers;

use App\Models\ProdukRental;
use App\Models\JenisKonsol;
use Illuminate\Http\Request;

class ProdukRentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk_rentals = ProdukRental::all();
        return view('produk_rental.index', compact('produk_rentals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis_konsols = JenisKonsol::all();
        return view('produk_rental.create', compact('jenis_konsols'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_konsol_id' => 'required|exists:jenis_konsols,id',
            'nama' => 'required|string|unique:produk_rentals,nama',
            'durasi' => 'required|numeric',
            'harga' => 'required|numeric',
            'poin' => 'required|numeric',
        ]);

        ProdukRental::create($request->all());

        return redirect()->route('produk_rental.index')->with('success', 'ProdukRental berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $produk_rental = ProdukRental::findOrFail($id);
        $jenis_konsols = JenisKonsol::all();
        return view('produk_rental.edit', compact('produk_rental', 'jenis_konsols'));
    }

    public function update(Request $request, $id)
    {
        $produk_rental = ProdukRental::findOrFail($id);

        $request->validate([
            'jenis_konsol_id' => 'required|exists:jenis_konsols,id',
            'nama' => 'required|string|unique:produk_rentals,nama,' . $produk_rental->id,
            'durasi' => 'required|numeric',
            'harga' => 'required|numeric',
            'poin' => 'required|numeric',
        ]);

        $produk_rental->update($request->except(['_token', '_method']));

        return redirect()->route('produk_rental.index')->with('success', 'ProdukRental berhasil diperbarui!');
    }

    public function destroy(ProdukRental $produk_rental)
    {
        $produk_rental->delete();

        return redirect()->route('produk_rental.index')->with('success', 'ProdukRental berhasil dihapus.');
    }
}
