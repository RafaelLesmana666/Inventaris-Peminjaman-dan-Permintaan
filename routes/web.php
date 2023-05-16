<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\InventarisRuanganController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/login',[LoginController::class, 'index']);
Route::post('/login',[LoginController::class, 'authanticate']);
Route::post('/logout',[LoginController::class, 'logout']);

Route::get('/admin',[PeminjamanController::class, 'index']);
Route::get('/filterMinggu',[PeminjamanController::class, 'filterMinggu']);
Route::get('/filterBulan',[PeminjamanController::class, 'filterBulan']);
Route::get('/filterTahun',[PeminjamanController::class, 'filterTahun']);

Route::get('/peminjaman',[PeminjamanController::class, 'historyPeminjaman']);
Route::get('/peminjaman/cari',[PeminjamanController::class, 'search']);
Route::get('/peminjaman/filter',[PeminjamanController::class,'filter']);
Route::post('/peminjaman/print',[PeminjamanController::class, 'print']);
Route::post('/peminjaman',[PeminjamanController::class, 'store']);
Route::post('/peminjaman/dikembalikan/{id_peminjaman}',[PeminjamanController::class, 'kembali']);
Route::get('/peminjaman/detail/{id}',[PeminjamanController::class, 'detail']);
Route::get('/peminjaman/report/{idReport}',[PeminjamanController::class, 'reportView']);
Route::post('/peminjaman/report/{idReport}',[PeminjamanController::class, 'report']);

Route::get('/permintaan',[PermintaanController::class, 'index']);
Route::post('/permintaan',[PermintaanController::class, 'store']);
Route::get('/permintaan/cari',[PermintaanController::class, 'search']);
Route::post('/permintaan/print',[PermintaanController::class, 'print']);

Route::get('/inventaris',[BarangController::class, 'inventaris']);
Route::post('/inventaris',[BarangController::class, 'tambahInventaris']);
Route::get('/inventaris/cari',[BarangController::class, 'cariInventaris']);

Route::get('/nonInventaris',[BarangController::class, 'noninventaris']);
Route::post('/nonInventaris',[BarangController::class, 'tambahNonInventaris']);
Route::get('/nonInventaris/cari',[BarangController::class, 'cariNonInventaris']);

Route::get('/inventarisRuangan',[InventarisRuanganController::class, 'index']);
Route::post('/inventarisRuangan',[InventarisRuanganController::class, 'store']);
Route::get('/inventarisRuangan/detail/Ruangan={ruang}/{kode_barang}',[InventarisRuanganController::class, 'updateModal']);
Route::post('/inventarisRuangan/detail/Ruangan={ruang}/{kode_barang}',[InventarisRuanganController::class, 'update']);
Route::get('/inventarisRuangan/detail/Ruangan={ruangan}',[InventarisRuanganController::class, 'detail']);
Route::post('/inventarisRuangan/detail/Ruangan={ruangan}',[InventarisRuanganController::class, 'tambah']);
Route::get('/inventarisRuangan/detail/Ruangan={ruangan}/psrintPDF',[InventarisRuanganController::class, 'print']);

Route::get('/daftarUser',[UserController::class, 'index']);
Route::post('/tambahUser',[UserController::class, 'store']);
