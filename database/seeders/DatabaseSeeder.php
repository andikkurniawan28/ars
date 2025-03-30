<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Akun;
use App\Models\Meja;
use App\Models\User;
use App\Models\Peran;
use App\Models\Cabang;
use App\Models\Konsol;
use App\Models\Firmware;
use App\Models\Supplier;
use App\Models\Pelanggan;
use App\Models\JenisKonsol;
use App\Models\ProdukRental;
use App\Models\ProdukKonsumsi;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Cabang::insert([
            ['nama' => 'Kebon Agung', 'alamat' => 'Jl Tarupala RT.24 RW. 04 No. 26/7 Kebon Agung, Pakisaji Malang', 'whatsapp' => '085733465399'],
        ]);

        Peran::insert([
            ['nama' => 'Owner'],
            ['nama' => 'Admin'],
            ['nama' => 'Pelanggan'],
        ]);

        User::insert([
            ['nama' => 'Andik Kurniawan', 'alamat' => 'Jl Tarupala RT.24 RW. 04 No. 26/7 Kebon Agung, Pakisaji Malang', 'whatsapp' => '085733465399', 'username' => 'andik', 'password' => bcrypt('qc_789456'), 'peran_id' => 1, 'cabang_id' => null, 'status' => 1],
        ]);

        Supplier::insert([
            [
                'nama' => 'Supplier A',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta',
                'whatsapp' => '081234567890',
                'hutang' => 0,
                'piutang' => 0,
            ],
            [
                'nama' => 'Supplier B',
                'alamat' => 'Jl. Sudirman No. 25, Bandung',
                'whatsapp' => '081298765432',
                'hutang' => 0,
                'piutang' => 0,
            ],
            [
                'nama' => 'Supplier C',
                'alamat' => 'Jl. Ahmad Yani No. 15, Surabaya',
                'whatsapp' => '081356789012',
                'hutang' => 0,
                'piutang' => 0,
            ],
        ]);

        Pelanggan::insert([
            [
                'nama' => 'Andi Saputra',
                'alamat' => 'Jl. Raya No. 12, Jakarta',
                'whatsapp' => '081234567891',
                'hutang' => 0,
                'piutang' => 0,
                'poin' => 0,
                'transaksi' => 0,
            ],
            [
                'nama' => 'Budi Santoso',
                'alamat' => 'Jl. Merdeka No. 45, Bandung',
                'whatsapp' => '081298765432',
                'hutang' => 0,
                'piutang' => 0,
                'poin' => 0,
                'transaksi' => 0,
            ],
            [
                'nama' => 'Citra Lestari',
                'alamat' => 'Jl. Sudirman No. 9, Surabaya',
                'whatsapp' => '081356789012',
                'hutang' => 0,
                'piutang' => 0,
                'poin' => 0,
                'transaksi' => 0,
            ],
        ]);

        JenisKonsol::insert([
            ['nama' => 'PS2'],
            ['nama' => 'PS3'],
            ['nama' => 'PS4'],
            ['nama' => 'PS5'],
            ['nama' => 'XBox 360'],
            ['nama' => 'XBox One'],
            ['nama' => 'Nintendo Wii'],
        ]);

        Firmware::insert([
            ['nama' => 'Original'],
            ['nama' => 'Clone'],
            ['nama' => 'CFW'],
            ['nama' => 'HEN'],
        ]);

        // Konsol::insert([
        //     ['jenis_konsol_id' => 2, 'firmware_id' => 4, 'supplier_id' => 1, 'tanggal_kedatangan' => '2025-03-14', 'harga' => 2300000],
        //     ['jenis_konsol_id' => 2, 'firmware_id' => 3, 'supplier_id' => 2, 'tanggal_kedatangan' => '2025-03-20', 'harga' => 1300000],
        //     ['jenis_konsol_id' => 3, 'firmware_id' => 2, 'supplier_id' => 3, 'tanggal_kedatangan' => '2025-03-20', 'harga' => 2900000],
        // ]);

        // Meja::insert([
        //     ['cabang_id' => 1, 'konsol_id' => 1, 'status' => 'tersedia'],
        //     ['cabang_id' => 1, 'konsol_id' => 2, 'status' => 'tersedia'],
        //     ['cabang_id' => 1, 'konsol_id' => 3, 'status' => 'tersedia'],
        // ]);

        Akun::insert([
            ['nama' => 'Kas Rental', 'saldo_normal' => 'Debit', 'keterangan' => null, 'cabang_id' => 1],
            ['nama' => 'Kas Konsumsi', 'saldo_normal' => 'Debit', 'keterangan' => null, 'cabang_id' => 1],
            ['nama' => 'Rekening Bank BCA', 'saldo_normal' => 'Debit', 'keterangan' => '1231153361', 'cabang_id' =>null],
            ['nama' => 'Piutang Rental', 'saldo_normal' => 'Debit', 'keterangan' => null, 'cabang_id' => 1],
            ['nama' => 'Piutang Konsumsi', 'saldo_normal' => 'Debit', 'keterangan' => null, 'cabang_id' => 1],
            ['nama' => 'Persediaan Barang Dagangan', 'saldo_normal' => 'Debit', 'keterangan' => null, 'cabang_id' => 1],
            ['nama' => 'Peralatan', 'saldo_normal' => 'Debit', 'keterangan' => null, 'cabang_id' => 1],
            ['nama' => 'Akumulasi Penyusutan Peralatan', 'saldo_normal' => 'Kredit', 'keterangan' => null, 'cabang_id' => 1],
            ['nama' => 'Hutang Rental', 'saldo_normal' => 'Kredit', 'keterangan' => null, 'cabang_id' => 1],
            ['nama' => 'Hutang Konsumsi', 'saldo_normal' => 'Kredit', 'keterangan' => null, 'cabang_id' => 1],
            ['nama' => 'Modal', 'saldo_normal' => 'Kredit', 'keterangan' => null, 'cabang_id' => 1],
            ['nama' => 'Laba Ditahan', 'saldo_normal' => 'Kredit', 'keterangan' => null, 'cabang_id' => 1],
            ['nama' => 'Pendapatan Rental', 'saldo_normal' => 'Kredit', 'keterangan' => null, 'cabang_id' => 1],
            ['nama' => 'Pendapatan Konsumsi', 'saldo_normal' => 'Kredit', 'keterangan' => null, 'cabang_id' => 1],
            ['nama' => 'HPP Konsumsi', 'saldo_normal' => 'Debit', 'keterangan' => null, 'cabang_id' => 1],
            ['nama' => 'Beban Sewa', 'saldo_normal' => 'Debit', 'keterangan' => null, 'cabang_id' => 1],
            ['nama' => 'Beban Listrik & Internet', 'saldo_normal' => 'Debit', 'keterangan' => null, 'cabang_id' => 1],
            ['nama' => 'Beban Gaji Karyawan', 'saldo_normal' => 'Debit', 'keterangan' => null, 'cabang_id' => 1],
        ]);

        ProdukRental::insert([
            ['nama' => 'PS3 Reguler', 'durasi' => 60, 'harga' => 5000, 'jenis_konsol_id' => 2],
            ['nama' => 'PS4 Reguler', 'durasi' => 60, 'harga' => 7000, 'jenis_konsol_id' => 3],
        ]);

        ProdukKonsumsi::insert([
            ['nama' => 'Mie Gelas', 'harga_beli' => 1000, 'harga_jual' => 3000,],
            ['nama' => 'Kopi Hitam', 'harga_beli' => 2500, 'harga_jual' => 5000,],
            ['nama' => 'Indomie Goreng', 'harga_beli' => 4000, 'harga_jual' => 8000,],
        ]);

    }
}
