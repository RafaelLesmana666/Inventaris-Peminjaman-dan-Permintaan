<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servis extends Model
{
    use HasFactory;
    protected $table = 'servis';
    protected $fillable = [
        'ruangan',
        'nama_guru',
        'kode_barang',
        'nama_barang',
        'jumlah',
        'kategori_peminjaman',
        'tgl_masuk',
        'tgl_kembali',
        'status_perbaikan',
        'kendala',
        'foto'
    ];

    protected $dates = ['tgl_masuk','tgl_kembali'];
}
