<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Barang;
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

    public function store(Request $request){
        $data = $request->validate([
            'nip',
            'nama_guru' => 'required',
            'nama_barang' => 'required',
            'tgl_peminjaman',
            'tgl_kembali' => 'nullable',
            'jml_barang_dipinjam' => 'required',
            'id_barang',
            'status_peminjaman',
            'keterangan' => 'required',
            'kategori_barang',
            'ruangan' => 'required' 
        ]);
             $barang = Barang::all();
             $cekbarang = $data['nama_barang'];
           
             $guru = $data['nama_guru'];
             $ambilnip = User::where('username',$guru)->first();
             $data['nip'] = $ambilnip->id;

             $data['tgl_peminjaman'] = Carbon::now()->toDateString();

             $stok = Barang::where('nama_barang',$cekbarang)->first();
             $data['id_barang'] = $stok->id;
             $data['status_peminjaman'] = 'dipinjam';
             $data['kategori_barang'] = $stok->kategori_barang;

             $jml = $data['jml_barang_dipinjam'];
             $kurang = $stok->jml_barang;
             $selisih = $kurang - $jml;
             $update = [ 'jml_barang' => $selisih]; 

             $stok->update($update);

             Peminjaman::create($data);

             return back();
    }

    public function kembali($id){
        $now = Carbon::now();
        $update = [
            'status_peminjaman' => 'kembali',
            'tgl_kembali' => $now
        ];
        $peminjaman = Peminjaman::where('id',$id)->first();
        $peminjaman->update($update);
        return back();
    }
}
