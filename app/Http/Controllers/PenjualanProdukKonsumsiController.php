<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Stok;
use App\Models\Cabang;
use App\Models\BukuBesar;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Models\ProdukKonsumsi;
use App\Models\PenjualanProdukKonsumsi;

class PenjualanProdukKonsumsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjualan_produk_konsumsis = PenjualanProdukKonsumsi::all();
        return view('penjualan_produk_konsumsi.index', compact('penjualan_produk_konsumsis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelanggans = Pelanggan::all();
        $cabangs = Cabang::all();
        $produk_konsumsis = ProdukKonsumsi::all();
        $akuns = Akun::all();
        return view('penjualan_produk_konsumsi.create', compact('pelanggans', 'cabangs', 'produk_konsumsis', 'akuns'));

    }

    public function store(Request $request)
    {
        $request->request->add(['user_id' => 1]);
        $request->validate([
            'tanggal' => 'required|date',
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'cabang_id' => 'required|exists:cabangs,id',
            'produk_konsumsi_id' => 'required|exists:produk_konsumsis,id',
            'akun_kas_id' => 'required|exists:akuns,id',
            'qty' => 'required|numeric|min:0.01',
            'tagihan' => 'required|numeric|min:0',
            'dibayar' => 'required|numeric|min:0',
            'sisa' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id',
            'poin' => 'required',
        ]);

        $penjualan_produk_konsumsi = PenjualanProdukKonsumsi::create($request->all());

        self::catatStok($penjualan_produk_konsumsi);

        self::catatBukuBesar($penjualan_produk_konsumsi, $request);

        return redirect()->route('penjualan_produk_konsumsi.index')->with('success', 'Penjualan Produk Konsumsi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(PenjualanProdukKonsumsi $penjualan_produk_konsumsi)
    {
        $penjualan_produk_konsumsi->delete();

        return redirect()->route('penjualan_produk_konsumsi.index')->with('success', 'Penjualan Produk Konsumsi berhasil dihapus.');
    }

    public static function catatStok($penjualan_produk_konsumsi){
        $keterangan = "Penjualan ke {$penjualan_produk_konsumsi->pelanggan->nama}";
        Stok::create([
            'cabang_id' => $penjualan_produk_konsumsi->cabang_id,
            'produk_konsumsi_id' => $penjualan_produk_konsumsi->produk_konsumsi_id,
            'penjualan_produk_konsumsi_id' => $penjualan_produk_konsumsi->id,
            'keluar' => $penjualan_produk_konsumsi->qty,
            'masuk' => 0,
            'keterangan' => $keterangan,
        ]);
    }

    public static function catatBukuBesar($penjualan_produk_konsumsi, $request){
        $keterangan = "Penjualan ke {$penjualan_produk_konsumsi->pelanggan->nama}";

        // Akun Kas
        BukuBesar::create([
            'penjualan_produk_konsumsi_id' => $penjualan_produk_konsumsi->id,
            'akun_id' => $request->akun_kas_id,
            'kredit' => 0,
            'debit' => $penjualan_produk_konsumsi->dibayar,
            'user_id' => $penjualan_produk_konsumsi->user_id,
            'keterangan' => $keterangan,
        ]);

        // Akun Pendapatan
        BukuBesar::create([
            'penjualan_produk_konsumsi_id' => $penjualan_produk_konsumsi->id,
            'akun_id' => $penjualan_produk_konsumsi->cabang->akun_pendapatan_konsumsi_id,
            'debit' => 0,
            'kredit' => $penjualan_produk_konsumsi->tagihan,
            'user_id' => $penjualan_produk_konsumsi->user_id,
            'keterangan' => $keterangan,
        ]);

        // HPP
        $hpp = $penjualan_produk_konsumsi->produk_konsumsi->harga_beli * $penjualan_produk_konsumsi->qty;

        // Akun Persediaan
        BukuBesar::create([
            'penjualan_produk_konsumsi_id' => $penjualan_produk_konsumsi->id,
            'akun_id' => $penjualan_produk_konsumsi->cabang->akun_persediaan_id,
            'debit' => 0,
            'kredit' => $hpp,
            'user_id' => $penjualan_produk_konsumsi->user_id,
            'keterangan' => $keterangan,
        ]);

        // Akun HPP
        BukuBesar::create([
            'penjualan_produk_konsumsi_id' => $penjualan_produk_konsumsi->id,
            'akun_id' => $penjualan_produk_konsumsi->cabang->akun_hpp_konsumsi_id,
            'kredit' => 0,
            'debit' => $hpp,
            'user_id' => $penjualan_produk_konsumsi->user_id,
            'keterangan' => $keterangan,
        ]);

        // Akun Hutang
        if($penjualan_produk_konsumsi->sisa > 0){
            BukuBesar::create([
                'penjualan_produk_konsumsi_id' => $penjualan_produk_konsumsi->id,
                'akun_id' => $penjualan_produk_konsumsi->cabang->akun_hutang_konsumsi_id,
                'debit' => 0,
                'kredit' => $penjualan_produk_konsumsi->sisa,
                'user_id' => $penjualan_produk_konsumsi->user_id,
                'keterangan' => $keterangan,
            ]);
        }

        // Akun Piutang
        if($penjualan_produk_konsumsi->sisa < 0){
            BukuBesar::create([
                'penjualan_produk_konsumsi_id' => $penjualan_produk_konsumsi->id,
                'akun_id' => $penjualan_produk_konsumsi->cabang->akun_piutang_konsumsi_id,
                'kredit' => 0,
                'debit' => $penjualan_produk_konsumsi->sisa,
                'user_id' => $penjualan_produk_konsumsi->user_id,
                'keterangan' => $keterangan,
            ]);
        }
    }
}
