<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PeminjamanController extends Controller
{
    public function index(){
        $total = Peminjaman::select('status_peminjaman')->count();
        $kembali = Peminjaman::where('status_peminjaman','kembali')->count();
        $dipinjam = Peminjaman::where('status_peminjaman','dipinjam')->count();
        $peminjaman = Peminjaman::orderBy('id','asc')->simplePaginate(5);
        return view('admin.dashboard',[
            'peminjaman' => $peminjaman,
            'total' => $total,
            'kembali' => $kembali,
            'dipinjam' => $dipinjam
        ]);
    }

    public function historyPeminjaman(){
        $peminjaman = Peminjaman::orderBy('id','asc')->simplePaginate(5);
        return view('admin.history.peminjaman',['peminjaman' => $peminjaman]);
    }

    public function search(Request $request){
        $search = $request->validate([
            'search' => 'required'
        ]);

        $cari = Peminjaman::where('nama_guru',$search)->simplePaginate(5);
        return view('admin.history.peminjaman',['peminjaman' => $cari]);
    }

    // public function store(Request $request){
    //     $data = $request->validate([
    //        'ruangan' => 'required',
    //        'nama_guru' => 'required',
    //        'nama_barang' => 'required',
    //        'jml_barang_dipinjam' => 'required',
    //        'keterangan' => 'required' 
    //     ]);

    //     $cekBarang = Barang::all();
    //     $guru = $data['nama_guru'];
    //     $cekGuru = User::where('')
            
    //     }
    // }
}
