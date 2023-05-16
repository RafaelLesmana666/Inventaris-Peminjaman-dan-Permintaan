<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServisController extends Controller
{
    public $table = 'servis';
    public $fillable = [
        'ruangan',
        'nama_guru',
        'kode_barang',
        'nama_barang',
        'kategori_pinjaman',
        'status_perbaikan',
        'kendala',
        'foto'
    ];
}
