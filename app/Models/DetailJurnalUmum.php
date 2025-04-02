<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailJurnalUmum extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function jurnal_umum(){
        return $this->belongsTo(JurnalUmum::class);
    }

    public function akun(){
        return $this->belongsTo(Akun::class);
    }
}
