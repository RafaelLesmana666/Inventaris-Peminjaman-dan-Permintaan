<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjamans';
    protected $fillable = 
    [
        'nama_peminjam',
        'nama_barang',
        'tgl_peminjaman',
        'tgl_kembali',
        'jml_barang_dipinjam',
        'kode_barang',
        'status_peminjaman',
        'kategori_barang',
        'ruangan'
    ];

    protected $dates = ['tgl_peminjaman','tgl_kembali'];
}
