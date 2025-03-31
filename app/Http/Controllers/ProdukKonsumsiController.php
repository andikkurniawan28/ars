<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;
use App\Models\ProdukKonsumsi;

class ProdukKonsumsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk_konsumsis = ProdukKonsumsi::all();
        $cabangs = Cabang::all();
        return view('produk_konsumsi.index', compact('produk_konsumsis', 'cabangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produk_konsumsi.create');

    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|unique:produk_konsumsis,nama',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'poin' => 'required|numeric',
        ]);

        ProdukKonsumsi::create($request->all());

        return redirect()->route('produk_konsumsi.index')->with('success', 'ProdukKonsumsi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $produk_konsumsi = ProdukKonsumsi::findOrFail($id);
        return view('produk_konsumsi.edit', compact('produk_konsumsi'));
    }

    public function update(Request $request, $id)
    {
        $produk_konsumsi = ProdukKonsumsi::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|unique:produk_konsumsis,nama,' . $produk_konsumsi->id,
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'poin' => 'required|numeric',
        ]);

        $produk_konsumsi->update($request->except(['_token', '_method']));

        return redirect()->route('produk_konsumsi.index')->with('success', 'ProdukKonsumsi berhasil diperbarui!');
    }

    public function destroy(ProdukKonsumsi $produk_konsumsi)
    {
        $produk_konsumsi->delete();

        return redirect()->route('produk_konsumsi.index')->with('success', 'ProdukKonsumsi berhasil dihapus.');
    }
}
