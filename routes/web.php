<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PeranController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\KonsolController;
use App\Http\Controllers\FirmwareController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BukuBesarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\JurnalUmumController;
use App\Http\Controllers\StokCabangController;
use App\Http\Controllers\JenisKonsolController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\ProdukRentalController;
use App\Http\Controllers\ProdukKonsumsiController;
use App\Http\Controllers\PenjualanProdukRentalController;
use App\Http\Controllers\PembelianProdukKonsumsiController;
use App\Http\Controllers\PenjualanProdukKonsumsiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', DashboardController::class)->name('dashboard');
Route::resource('cabang', CabangController::class);
Route::resource('peran', PeranController::class);
Route::resource('user', UserController::class);
Route::resource('supplier', SupplierController::class);
Route::resource('pelanggan', PelangganController::class);
Route::resource('jenis_konsol', JenisKonsolController::class);
Route::resource('firmware', FirmwareController::class);
Route::resource('konsol', KonsolController::class);
Route::resource('meja', MejaController::class);
Route::resource('akun', AkunController::class);
Route::resource('produk_rental', ProdukRentalController::class);
Route::resource('produk_konsumsi', ProdukKonsumsiController::class);
Route::get('stok_cabang/{produk_konsumsi_id}/{cabang_id}', StokCabangController::class)->name('stok_cabang');
Route::resource('pembelian_produk_konsumsi', PembelianProdukKonsumsiController::class);
Route::resource('penjualan_produk_konsumsi', PenjualanProdukKonsumsiController::class);
Route::resource('penjualan_produk_rental', PenjualanProdukRentalController::class);
Route::resource('jurnal_umum', JurnalUmumController::class);
Route::get('log_aktivitas', LogAktivitasController::class)->name('log_aktivitas');
Route::get('buku_besar', BukuBesarController::class)->name('buku_besar');
