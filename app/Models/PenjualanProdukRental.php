<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanProdukRental extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class);
    }

    public function cabang(){
        return $this->belongsTo(Cabang::class);
    }

    public function meja(){
        return $this->belongsTo(Meja::class);
    }

    public function produk_rental(){
        return $this->belongsTo(ProdukRental::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
