<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barangs';
    protected $fillable =
    [
        'nama_barang',
        'tgl_pengadaan',
        'sumber_dana',
        'jml_barang',
        'merk_barang',
        'jenis_barang',
        'kategori_barang',
        'kondisi_barang'
    ];
}
