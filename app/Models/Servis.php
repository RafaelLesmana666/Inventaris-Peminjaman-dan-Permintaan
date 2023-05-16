<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servis extends Model
{
    use HasFactory;
    protected $table = 'servis';
    protected $fillable = [
        'nama_guru',
        'kode_barang',
        'nama_barang',
        'kategori_peminjaman',
        'status_perbaikan',
        'kendala',
        'foto'
    ];
}
