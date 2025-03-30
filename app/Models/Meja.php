<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function cabang(){
        return $this->belongsTo(Cabang::class);
    }

    public function konsol(){
        return $this->belongsTo(Konsol::class);
    }
}
