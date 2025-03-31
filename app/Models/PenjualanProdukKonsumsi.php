<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanProdukKonsumsi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class);
    }

    public function cabang(){
        return $this->belongsTo(Cabang::class);
    }

    public function produk_konsumsi(){
        return $this->belongsTo(ProdukKonsumsi::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
