<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ServisController;
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
Route::get('/admin/filterMinggu',[PeminjamanController::class, 'filterMinggu']);
Route::get('/admin/filterBulan',[PeminjamanController::class, 'filterBulan']);
Route::get('/admin/filterTahun',[PeminjamanController::class, 'filterTahun']);
Route::get('/admin/detail/{id}',[PeminjamanController::class, 'notif']);
Route::post('/admin/detail/{id}',[PeminjamanController::class, 'acc']);

Route::get('/teknisi',[ServisController::class, 'dashboard']);
Route::get('/teknisi/detail/{id}',[ServisController::class, 'notif']);
Route::post('/teknisi/detail/{id}',[ServisController::class, 'acc']);
Route::get('/servis',[ServisController::class,'servis']);
Route::get('/servis/cari',[ServisController::class,'search']);
Route::post('/servis/{id}',[ServisController::class, 'update']);
Route::get('/servis/detail/{id}',[ServisController::class, 'detail']);


Route::get('/peminjaman',[PeminjamanController::class, 'historyPeminjaman']);
Route::get('/peminjaman/cari',[PeminjamanController::class, 'search']);
Route::get('/peminjaman/filter',[PeminjamanController::class,'filter']);
Route::post('/peminjaman/print',[PeminjamanController::class, 'print']);
Route::post('/peminjaman',[PeminjamanController::class, 'store']);
Route::post('/peminjaman/dikembalikan/{id_peminjaman}',[PeminjamanController::class, 'kembali']);
Route::get('/peminjaman/detail/{id}',[PeminjamanController::class, 'detail']);
Route::get('/peminjaman/report/{idReport}',[PeminjamanController::class, 'reportView']);
Route::post('/peminjaman/report/{id}',[PeminjamanController::class, 'report']);

Route::get('/permintaan',[PermintaanController::class, 'index']);
Route::post('/permintaan',[PermintaanController::class, 'store']);
Route::get('/permintaan/cari',[PermintaanController::class, 'search']);
Route::post('/permintaan/print',[PermintaanController::class, 'print']);

Route::get('/inventaris',[BarangController::class, 'inventaris']);
Route::post('/inventaris',[BarangController::class, 'tambahInventaris']);
Route::get('/inventaris/cari',[BarangController::class, 'cariInventaris']);
Route::get('/inventaris/filter',[BarangController::class, 'filter']);
Route::get('/inventaris/update/kode={kode_barang}',[BarangController::class, 'modal']);
Route::post('/inventaris/update/kode={kode_barang}',[BarangController::class, 'update']);

Route::get('/nonInventaris',[BarangController::class, 'noninventaris']);
Route::post('/nonInventaris',[BarangController::class, 'tambahNonInventaris']);
Route::get('/nonInventaris/cari',[BarangController::class, 'cariNonInventaris']);
Route::get('/nonInventaris/filter',[BarangController::class, 'filter']);
Route::get('/nonInventaris/update/kode={kode_barang}',[BarangController::class, 'modal']);
Route::post('/nonInventaris/update/kode={kode_barang}',[BarangController::class, 'update']);

Route::get('/inventarisRuangan',[InventarisRuanganController::class, 'index']);
Route::post('/inventarisRuangan',[InventarisRuanganController::class, 'store']);
Route::get('/inventarisR/cari',[InventarisRuanganController::class, 'search']);
Route::get('/inventarisRuangan/update/Ruangan={ruang}/{kode_barang}',[InventarisRuanganController::class, 'updateModal']);
Route::post('/inventarisRuangan/update/Ruangan={ruang}/{kode_barang}',[InventarisRuanganController::class, 'update']);
Route::get('/inventarisRuangan/detail/Ruangan={ruangan}',[InventarisRuanganController::class, 'detail']);
Route::post('/inventarisRuangan/detail/Ruangan={ruangan}',[InventarisRuanganController::class, 'tambah']);
Route::get('/print/{ruangan}',[InventarisRuanganController::class, 'print']);

Route::get('/daftarUser',[UserController::class, 'index']);
Route::post('/tambahUser',[UserController::class, 'store']);



