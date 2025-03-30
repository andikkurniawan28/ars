<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukRental extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function jenis_konsol(){
        return $this->belongsTo(JenisKonsol::class);
    }
}
