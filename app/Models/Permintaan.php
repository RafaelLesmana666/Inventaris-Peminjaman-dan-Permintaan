<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;
    protected $table = 'permintaans';
    protected $fillable = 
    [
        'nip',
        'nama_guru',
        'nama_barang',
        'tgl_pengadaan',
        'jml_barang_diminta',
        'id_barang'
    ];
}
