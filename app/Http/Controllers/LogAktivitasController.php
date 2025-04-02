<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $log_aktivitass = LogAktivitas::all();
        return view('log_aktivitas.index', compact('log_aktivitass'));
    }
}
