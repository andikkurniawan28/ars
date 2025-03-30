<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Cabang;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\ProdukKonsumsi;
use App\Models\PembelianProdukKonsumsi;

class PembelianProdukKonsumsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembelian_produk_konsumsis = PembelianProdukKonsumsi::all();
        return view('pembelian_produk_konsumsi.index', compact('pembelian_produk_konsumsis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $cabangs = Cabang::all();
        $produk_konsumsis = ProdukKonsumsi::all();
        $akuns = Akun::all();
        return view('pembelian_produk_konsumsi.create', compact('suppliers', 'cabangs', 'produk_konsumsis', 'akuns'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
            'cabang_id' => 'nullable|exists:cabangs,id',
            'produk_konsumsi_id' => 'required|exists:produk_konsumsis,id',
            'akun_kas_id' => 'required|exists:akuns,id',
            'akun_persediaan_id' => 'required|exists:akuns,id',
            'qty' => 'required|numeric|min:0.01',
            'tagihan' => 'required|numeric|min:0',
            'dibayar' => 'required|numeric|min:0',
            'sisa' => 'required|numeric|min:0',
        ]);

        PembelianProdukKonsumsi::create($request->all());

        return redirect()->route('pembelian_produk_konsumsi.index')->with('success', 'PembelianProdukKonsumsi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pembelian_produk_konsumsi = PembelianProdukKonsumsi::findOrFail($id);
        $suppliers = Supplier::all();
        $cabangs = Cabang::all();
        $produk_konsumsis = ProdukKonsumsi::all();
        $akuns = Akun::all();
        return view('pembelian_produk_konsumsi.edit', compact('pembelian_produk_konsumsi', 'suppliers', 'cabangs', 'produk_konsumsis', 'akuns'));
    }

    public function update(Request $request, $id)
    {
        $pembelian_produk_konsumsi = PembelianProdukKonsumsi::findOrFail($id);

        $request->validate([
            'tanggal' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
            'cabang_id' => 'nullable|exists:cabangs,id',
            'produk_konsumsi_id' => 'required|exists:produk_konsumsis,id',
            'akun_kas_id' => 'required|exists:akuns,id',
            'akun_persediaan_id' => 'required|exists:akuns,id',
            'qty' => 'required|numeric|min:0.01',
            'tagihan' => 'required|numeric|min:0',
            'dibayar' => 'required|numeric|min:0',
            'sisa' => 'required|numeric|min:0',
        ]);

        $pembelian_produk_konsumsi->update($request->except(['_token', '_method']));

        return redirect()->route('pembelian_produk_konsumsi.index')->with('success', 'PembelianProdukKonsumsi berhasil diperbarui!');
    }

    public function destroy(PembelianProdukKonsumsi $pembelian_produk_konsumsi)
    {
        $pembelian_produk_konsumsi->delete();

        return redirect()->route('pembelian_produk_konsumsi.index')->with('success', 'PembelianProdukKonsumsi berhasil dihapus.');
    }
}
