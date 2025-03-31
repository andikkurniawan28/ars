<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianProdukKonsumsi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function supplier(){
        return $this->belongsTo(Supplier::class);
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
