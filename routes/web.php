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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\JenisKonsolController;
use App\Http\Controllers\ProdukRentalController;
use App\Http\Controllers\ProdukKonsumsiController;
use App\Http\Controllers\PembelianProdukKonsumsiController;

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
Route::resource('pembelian_produk_konsumsi', PembelianProdukKonsumsiController::class);
