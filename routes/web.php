<?php

use App\Http\Controllers\CabangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FirmwareController;
use App\Http\Controllers\JenisKonsolController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PeranController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
