<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Cabang;
use Illuminate\Http\Request;

class CabangController extends Controller
{
    /**
     * Tampilkan daftar cabang.
     */
    public function index()
    {
        $cabangs = Cabang::all();
        return view('cabang.index', compact('cabangs'));
    }

    /**
     * Tampilkan form untuk menambahkan cabang baru.
     */
    public function create()
    {
        return view('cabang.create');
    }

    /**
     * Simpan cabang baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|unique:cabangs,nama',
            'alamat' => 'required|string',
            'whatsapp' => 'required|string|unique:cabangs,whatsapp',
        ]);

        $cabang = Cabang::create($request->all());

        $template_akun = [
            ['nama' => "Kas Rental Cabang {$cabang->nama}", 'saldo_normal' => 'Debit'],
            ['nama' => "Kas Konsumsi Cabang {$cabang->nama}", 'saldo_normal' => 'Debit'],
            ['nama' => "Piutang Rental Cabang {$cabang->nama}", 'saldo_normal' => 'Debit'],
            ['nama' => "Piutang Konsumsi Cabang {$cabang->nama}", 'saldo_normal' => 'Debit'],
            ['nama' => "Persediaan Barang Dagangan Cabang {$cabang->nama}", 'saldo_normal' => 'Debit'],
            ['nama' => "Peralatan Cabang {$cabang->nama}", 'saldo_normal' => 'Debit'],
            ['nama' => "Hutang Rental Cabang {$cabang->nama}", 'saldo_normal' => 'Kredit'],
            ['nama' => "Hutang Konsumsi Cabang {$cabang->nama}", 'saldo_normal' => 'Kredit'],
            ['nama' => "Modal Cabang {$cabang->nama}", 'saldo_normal' => 'Kredit'],
            ['nama' => "Laba Ditahan Cabang {$cabang->nama}", 'saldo_normal' => 'Kredit'],
            ['nama' => "Pendapatan Rental Cabang {$cabang->nama}", 'saldo_normal' => 'Kredit'],
            ['nama' => "Pendapatan Konsumsi Cabang {$cabang->nama}", 'saldo_normal' => 'Kredit'],
            ['nama' => "HPP Konsumsi Cabang {$cabang->nama}", 'saldo_normal' => 'Debit'],
            ['nama' => "Beban Sewa Cabang {$cabang->nama}", 'saldo_normal' => 'Debit'],
            ['nama' => "Beban Listrik & Internet Cabang {$cabang->nama}", 'saldo_normal' => 'Debit'],
            ['nama' => "Beban Gaji Karyawan Cabang {$cabang->nama}", 'saldo_normal' => 'Debit'],
        ];

        foreach ($template_akun as $akun) {
            Akun::create([
                'nama' => $akun['nama'], // Perbaikan akses array asosiatif
                'saldo_normal' => $akun['saldo_normal'],
            ]);
        }

        return redirect()->route('cabang.index')->with('success', 'Cabang berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail cabang tertentu.
     */
    public function show(Cabang $cabang)
    {
        return view('cabang.show', compact('cabang'));
    }

    /**
     * Tampilkan form untuk edit cabang tertentu.
     */
    public function edit(Cabang $cabang)
    {
        $akuns = Akun::all();
        return view('cabang.edit', compact('cabang', 'akuns'));
    }

    /**
     * Update data cabang tertentu di database.
     */
    public function update(Request $request, Cabang $cabang)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:cabangs,nama,' . $cabang->id,
            'alamat' => 'required|string',
            'whatsapp' => 'required|string|max:20|unique:cabangs,whatsapp,' . $cabang->id,
            'akun_persediaan_id' => 'nullable|exists:akuns,id',
            'akun_pendapatan_konsumsi_id' => 'nullable|exists:akuns,id',
            'akun_hutang_konsumsi_id' => 'nullable|exists:akuns,id',
            'akun_piutang_konsumsi_id' => 'nullable|exists:akuns,id',
            'akun_hpp_konsumsi_id' => 'nullable|exists:akuns,id',
            'akun_pendapatan_rental_id' => 'nullable|exists:akuns,id',
            'akun_hutang_rental_id' => 'nullable|exists:akuns,id',
            'akun_piutang_rental_id' => 'nullable|exists:akuns,id',
        ]);

        $cabang->update($request->all());

        return redirect()->route('cabang.index')->with('success', 'Cabang berhasil diperbarui.');
    }

    /**
     * Hapus cabang tertentu dari database.
     */
    public function destroy(Cabang $cabang)
    {
        $cabang->delete();

        return redirect()->route('cabang.index')->with('success', 'Cabang berhasil dihapus.');
    }
}
