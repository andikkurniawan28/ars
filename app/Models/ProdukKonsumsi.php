<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukKonsumsi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function saldo($id){
        $saldo = Stok::where('produk_konsumsi_id', $id)->get()->last()->saldo ?? 0;
        return $saldo;
    }
}
