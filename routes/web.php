<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PermintaanController;

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
Route::post('logout',[LoginController::class, 'logout']);

Route::get('/admin',[PeminjamanController::class, 'index']);
Route::get('/peminjaman',[PeminjamanController::class, 'historyPeminjaman']);
Route::get('/peminjaman/cari',[PeminjamanController::class, 'search']);
Route::post('/print',[PeminjamanController::class, 'print']);
Route::post('/peminjaman',[PeminjamanController::class, 'store']);
Route::post('/dikembalikan/{id}',[PeminjamanController::class, 'kembali']);

Route::get('/permintaan',[PermintaanController::class, 'index']);

Route::get('/inventaris',[BarangController::class, 'inventaris']);
Route::post('/inventaris',[BarangController::class, 'tambahInventaris']);
Route::get('/inventaris/cari',[BarangController::class, 'cariInventaris']);

Route::get('/nonInventaris',[BarangController::class, 'noninventaris']);
Route::post('/nonInventaris',[BarangController::class,'tambahNonInventaris']);
Route::get('/nonInventaris/cari',[BarangController::class, 'cariNonInventaris']);

Route::get('/inventarisRuangan',[BarangController::class, 'inventarisRuangan']);
Route::post('/inventarisRuangan',[BarangController::class, 'tambahInventarisR']);
Route::get('/inventarisR/cari',[BarangController::class, 'cariInventarisR']);

Route::get('/daftarUser',[UserController::class, 'index']);
Route::post('/tambahUser',[UserController::class, 'store']);
