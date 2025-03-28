<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Tampilkan daftar supplier.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('supplier.index', compact('suppliers'));
    }

    /**
     * Tampilkan form untuk menambahkan supplier baru.
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Simpan supplier baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|unique:suppliers,nama',
            'alamat' => 'required|string',
            'whatsapp' => 'required|string|unique:suppliers,whatsapp',
        ]);

        Supplier::create($request->all());

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail supplier tertentu.
     */
    public function show(Supplier $supplier)
    {
        return view('supplier.show', compact('supplier'));
    }

    /**
     * Tampilkan form untuk edit supplier tertentu.
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update data supplier tertentu di database.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'nama' => 'required|string|unique:suppliers,nama,' . $supplier->id,
            'alamat' => 'required|string',
            'whatsapp' => 'required|string|unique:suppliers,whatsapp,' . $supplier->id,
        ]);

        $supplier->update($request->all());

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil diperbarui.');
    }

    /**
     * Hapus supplier tertentu dari database.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil dihapus.');
    }
}
