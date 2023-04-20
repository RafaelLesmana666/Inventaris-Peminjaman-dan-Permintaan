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
        'nip',
        'nama_guru',
        'nama_barang',
        'tgl_peminjaman',
        'jml_barang_dipinjam',
        'id_barang',
        'status_peminjaman',
        'keterangan',
        'kategori_barang',
        'ruangan'
    ];

    protected $dates = ['tgl_peminjaman'];
}
