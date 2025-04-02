<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\BukuBesar;
use App\Models\JurnalUmum;
use Illuminate\Http\Request;
use App\Models\DetailJurnalUmum;

class JurnalUmumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurnal_umums = JurnalUmum::all();
        return view('jurnal_umum.index', compact('jurnal_umums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jurnal_umum.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->request->add(['user_id' => 1]);
        JurnalUmum::create($request->all());
        return redirect()->route('jurnal_umum.index')->with('success', 'Jurnal Umum berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(JurnalUmum $jurnalUmum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $akuns = Akun::all();
        return view('jurnal_umum.edit', compact('akuns', 'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user_id = JurnalUmum::whereId($request->jurnal_umum_id)->get()->last()->user_id;
        DetailJurnalUmum::create([
            'jurnal_umum_id' => $request->jurnal_umum_id,
            'keterangan' => $request->keterangan,
            'akun_id' => $request->akun_id,
            'debit' => $request->debit,
            'kredit' => $request->kredit,
        ]);
        BukuBesar::create([
            'jurnal_umum_id' => $request->jurnal_umum_id,
            'akun_id' => $request->akun_id,
            'keterangan' => $request->keterangan,
            'debit' => $request->debit,
            'kredit' => $request->kredit,
            'user_id' => $user_id,
        ]);
        return redirect()->back()->with('success', "Jurnal Umum berhasil diisi, isi detail lain!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JurnalUmum $jurnalUmum)
    {
        $jurnalUmum->delete();
        return redirect()->route('jurnal_umum.index')->with('success', 'Jurnal Umum berhasil dihapus.');
    }
}
