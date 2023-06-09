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
        'kode_barang',
        'nama_barang',
        'jml_barang',
        'jenis_barang',
        'kategori_barang',
        'satuan',
        'baik',
        'rusak',
        'status_perbaikan',
        'kendala',
        'foto'
    ];
}
