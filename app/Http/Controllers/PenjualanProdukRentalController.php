<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Meja;
use App\Models\Stok;
use App\Models\Cabang;
use App\Models\BukuBesar;
use App\Models\Pelanggan;
use App\Models\ProdukRental;
use Illuminate\Http\Request;
use App\Models\PenjualanProdukRental;

class PenjualanProdukRentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjualan_produk_rentals = PenjualanProdukRental::all();
        return view('penjualan_produk_rental.index', compact('penjualan_produk_rentals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelanggans = Pelanggan::all();
        $cabangs = Cabang::all();
        $produk_rentals = ProdukRental::all();
        $akuns = Akun::all();
        $mejas = Meja::all();
        return view('penjualan_produk_rental.create', compact('pelanggans', 'cabangs', 'produk_rentals', 'akuns', 'mejas'));

    }

    public function store(Request $request)
    {
        $durasi = ProdukRental::whereId($request->produk_rental_id)->get()->last()->durasi * $request->qty;
        $selesai = date('Y-m-d H:i:s', strtotime($request->mulai . " +{$durasi} minutes"));
        $cabang_id = Meja::whereId($request->meja_id)->get()->last()->cabang_id;
        $request->request->add([
            'user_id' => 1,
            'selesai' => $selesai,
            'cabang_id' => $cabang_id,
        ]);
        $request->validate([
            'tanggal' => 'required|date',
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'cabang_id' => 'required|exists:cabangs,id',
            'meja_id' => 'required|exists:mejas,id',
            'produk_rental_id' => 'required|exists:produk_rentals,id',
            'akun_kas_id' => 'required|exists:akuns,id',
            'mulai' => 'required',
            'selesai' => 'required',
            'qty' => 'required|numeric|min:0.01',
            'tagihan' => 'required|numeric|min:0',
            'dibayar' => 'required|numeric|min:0',
            'sisa' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id',
            'poin' => 'required',
        ]);

        $penjualan_produk_rental = PenjualanProdukRental::create($request->all());

        self::catatBukuBesar($penjualan_produk_rental, $request);

        return redirect()->route('penjualan_produk_rental.index')->with('success', 'Penjualan Produk Rental berhasil ditambahkan!');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(PenjualanProdukRental $penjualan_produk_rental)
    {
        $penjualan_produk_rental->delete();

        return redirect()->route('penjualan_produk_rental.index')->with('success', 'Penjualan Produk Rental berhasil dihapus.');
    }

    public static function catatBukuBesar($penjualan_produk_rental, $request){
        $keterangan = "Rental ke {$penjualan_produk_rental->pelanggan->nama}";

        // Akun Kas
        BukuBesar::create([
            'penjualan_produk_rental_id' => $penjualan_produk_rental->id,
            'akun_id' => $request->akun_kas_id,
            'kredit' => 0,
            'debit' => $penjualan_produk_rental->dibayar,
            'user_id' => $penjualan_produk_rental->user_id,
            'keterangan' => $keterangan,
        ]);

        // Akun Pendapatan
        BukuBesar::create([
            'penjualan_produk_rental_id' => $penjualan_produk_rental->id,
            'akun_id' => $penjualan_produk_rental->cabang->akun_pendapatan_rental_id,
            'debit' => 0,
            'kredit' => $penjualan_produk_rental->tagihan,
            'user_id' => $penjualan_produk_rental->user_id,
            'keterangan' => $keterangan,
        ]);

        // Akun Hutang
        if($penjualan_produk_rental->sisa > 0){
            BukuBesar::create([
                'penjualan_produk_rental_id' => $penjualan_produk_rental->id,
                'akun_id' => $penjualan_produk_rental->cabang->akun_hutang_rental_id,
                'debit' => 0,
                'kredit' => $penjualan_produk_rental->sisa,
                'user_id' => $penjualan_produk_rental->user_id,
                'keterangan' => $keterangan,
            ]);
        }

        // Akun Piutang
        if($penjualan_produk_rental->sisa < 0){
            BukuBesar::create([
                'penjualan_produk_rental_id' => $penjualan_produk_rental->id,
                'akun_id' => $penjualan_produk_rental->cabang->akun_piutang_rental_id,
                'kredit' => 0,
                'debit' => $penjualan_produk_rental->sisa,
                'user_id' => $penjualan_produk_rental->user_id,
                'keterangan' => $keterangan,
            ]);
        }
    }
}
