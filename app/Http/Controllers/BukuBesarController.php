<?php

namespace App\Http\Controllers;

use App\Models\BukuBesar;
use Illuminate\Http\Request;

class BukuBesarController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $buku_besars = BukuBesar::all();
        return view('buku_besar.index', compact('buku_besars'));
    }
}
