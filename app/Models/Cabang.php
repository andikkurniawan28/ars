<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function akun_persediaan(){
        return $this->belongsTo(Akun::class);
    }

    public function akun_pendapatan_konsumsi(){
        return $this->belongsTo(Akun::class);
    }

    public function akun_hutang_konsumsi(){
        return $this->belongsTo(Akun::class);
    }

    public function akun_piutang_konsumsi(){
        return $this->belongsTo(Akun::class);
    }

    public function akun_hpp_konsumsi(){
        return $this->belongsTo(Akun::class);
    }

    public function akun_pendapatan_rental(){
        return $this->belongsTo(Akun::class);
    }

    public function akun_hutang_rental(){
        return $this->belongsTo(Akun::class);
    }

    public function akun_piutang_rental(){
        return $this->belongsTo(Akun::class);
    }
}
