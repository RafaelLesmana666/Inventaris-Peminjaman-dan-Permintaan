<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;
    protected $table = 'inventaris_ruangan';
    protected $fillable = [
        'ruangan',
        'nama_ruangan',
        'pj_rayon',
        'pj_ruangan',
        'kode_barang',
        'nama_barang',
        'satuan',
        'baik',
        'rusak',
    ];
}
