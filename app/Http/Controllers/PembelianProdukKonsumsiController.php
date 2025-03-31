<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Stok;
use App\Models\Cabang;
use App\Models\Supplier;
use App\Models\BukuBesar;
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
        $request->request->add(['user_id' => 1]);
        $request->validate([
            'tanggal' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
            'cabang_id' => 'nullable|exists:cabangs,id',
            'produk_konsumsi_id' => 'required|exists:produk_konsumsis,id',
            'akun_kas_id' => 'required|exists:akuns,id',
            // 'akun_persediaan_id' => 'required|exists:akuns,id',
            'qty' => 'required|numeric|min:0.01',
            'tagihan' => 'required|numeric|min:0',
            'dibayar' => 'required|numeric|min:0',
            'sisa' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id',
        ]);

        $pembelian_produk_konsumsi = PembelianProdukKonsumsi::create($request->all());

        self::catatStok($pembelian_produk_konsumsi);

        self::catatBukuBesar($pembelian_produk_konsumsi, $request);

        return redirect()->route('pembelian_produk_konsumsi.index')->with('success', 'Kulakan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(PembelianProdukKonsumsi $pembelian_produk_konsumsi)
    {
        $pembelian_produk_konsumsi->delete();

        return redirect()->route('pembelian_produk_konsumsi.index')->with('success', 'Kulakan berhasil dihapus.');
    }

    public static function catatStok($pembelian_produk_konsumsi){
        $keterangan = "Kulakan ke {$pembelian_produk_konsumsi->supplier->nama}";
        Stok::create([
            'cabang_id' => $pembelian_produk_konsumsi->cabang_id,
            'produk_konsumsi_id' => $pembelian_produk_konsumsi->produk_konsumsi_id,
            'pembelian_produk_konsumsi_id' => $pembelian_produk_konsumsi->id,
            'masuk' => $pembelian_produk_konsumsi->qty,
            'keluar' => 0,
            'keterangan' => $keterangan,
        ]);
    }

    public static function catatBukuBesar($pembelian_produk_konsumsi, $request){
        $keterangan = "Kulakan ke {$pembelian_produk_konsumsi->supplier->nama}";

        // Akun Kas
        BukuBesar::create([
            'pembelian_produk_konsumsi_id' => $pembelian_produk_konsumsi->id,
            'akun_id' => $request->akun_kas_id,
            'debit' => 0,
            'kredit' => $pembelian_produk_konsumsi->dibayar,
            'user_id' => $pembelian_produk_konsumsi->user_id,
            'keterangan' => $keterangan,
        ]);

        // Akun Persediaan
        BukuBesar::create([
            'pembelian_produk_konsumsi_id' => $pembelian_produk_konsumsi->id,
            'akun_id' => $pembelian_produk_konsumsi->cabang->akun_persediaan_id,
            'kredit' => 0,
            'debit' => $pembelian_produk_konsumsi->tagihan,
            'user_id' => $pembelian_produk_konsumsi->user_id,
            'keterangan' => $keterangan,
        ]);

        // Akun Hutang
        if($pembelian_produk_konsumsi->sisa > 0){
            BukuBesar::create([
                'pembelian_produk_konsumsi_id' => $pembelian_produk_konsumsi->id,
                'akun_id' => $pembelian_produk_konsumsi->cabang->akun_hutang_konsumsi_id,
                'debit' => 0,
                'kredit' => $pembelian_produk_konsumsi->sisa,
                'user_id' => $pembelian_produk_konsumsi->user_id,
                'keterangan' => $keterangan,
            ]);
        }

        // Akun Piutang
        if($pembelian_produk_konsumsi->sisa < 0){
            BukuBesar::create([
                'pembelian_produk_konsumsi_id' => $pembelian_produk_konsumsi->id,
                'akun_id' => $pembelian_produk_konsumsi->cabang->akun_piutang_konsumsi_id,
                'kredit' => 0,
                'debit' => $pembelian_produk_konsumsi->sisa,
                'user_id' => $pembelian_produk_konsumsi->user_id,
                'keterangan' => $keterangan,
            ]);
        }
    }
}
