<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Cabang;
use Illuminate\Http\Request;
use App\Models\ProdukKonsumsi;

class StokCabangController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($produk_konsumsi_id, $cabang_id)
    {
        $data = Stok::where('produk_konsumsi_id', $produk_konsumsi_id)
            ->where('cabang_id', $cabang_id)
            ->orderBy('id', 'asc')
            ->get();
        $produk = ProdukKonsumsi::whereId($produk_konsumsi_id)->get()->last();
        $cabang = Cabang::whereId($cabang_id)->get()->last();
        return view('stok_cabang.index', compact('data', 'produk', 'cabang'));
    }
}
