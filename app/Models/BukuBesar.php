<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuBesar extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function akun(){
        return $this->belongsTo(Akun::class);
    }
}
