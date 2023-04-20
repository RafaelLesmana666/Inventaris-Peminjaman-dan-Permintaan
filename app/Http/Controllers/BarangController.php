<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BarangController extends Controller
{
    public function inventaris(){
        $barang = Barang::where('jenis_barang','inventaris')->simplePaginate(5);
        return view('admin.daftarBarang.inventaris',['barang' => $barang]);
    }

    public function tambahInventaris(Request $request){
        $data = $request->validate([
            'nama_barang' => 'required',
            'tgl_pengadaan',
            'sumber_dana',
            'merk_barang' => 'required',
            'jml_barang' => 'required', 
            'jenis_barang',
            'kategori_barang' => 'required',
            'kondisi_barang' => 'required'
        ]);

        $data['tgl_pengadaan'] = Carbon::now();
        $data['sumber_dana'] = 'sekolah';
        $data['jenis_barang'] = 'inventaris';

        Barang::create($data);
        return back();
    }

    public function cariInventaris(Request $request){
        $search = $request->validate([
            'search' => 'required',
        ]);

        $select = Barang::where([['nama_barang',$search],['jenis_barang','inventaris']])->simplePaginate(5);
        return view('admin.daftarBarang.inventaris',['barang' => $select]);
    }

    public function noninventaris(){
        $barang = Barang::where('jenis_barang','non_inventaris')->simplePaginate(5);
        return view('admin.daftarBarang.nonInventaris',['barang' => $barang]);
    }

    public function tambahNonInventaris(Request $request){
        $data = $request->validate([
            'nama_barang' => 'required',
            'tgl_pengadaan',
            'sumber_dana',
            'merk_barang' => 'required',
            'jml_barang' => 'required', 
            'jenis_barang',
            'kategori_barang' => 'required',
            'kondisi_barang' => 'required'
        ]);

        $data['tgl_pengadaan'] = Carbon::now();
        $data['sumber_dana'] = 'sekolah';
        $data['jenis_barang'] = 'non_inventaris';

        Barang::create($data);
        return back();
    }

    public function cariNonInventaris(Request $request){
        $search = $request->validate([
            'search' => 'required',
        ]);

        $select = Barang::where([['nama_barang',$search],['jenis_barang','non_inventaris']])->simplePaginate(5);
        return view('admin.daftarBarang.nonInventaris',['barang' => $select]);
    }

    public function inventarisRuangan(){
        $barang = Barang::where('jenis_barang','inventaris_ruangan')->simplePaginate(5);
        return view('admin.daftarBarang.inventarisRuangan',['barang' => $barang]);
    }

    public function tambahInventarisR(Request $request){
        $data = $request->validate([
            'nama_barang' => 'required',
            'tgl_pengadaan',
            'sumber_dana',
            'merk_barang' => 'required',
            'jml_barang' => 'required', 
            'jenis_barang',
            'kategori_barang' => 'required',
            'kondisi_barang' => 'required'
        ]);

        $data['tgl_pengadaan'] = Carbon::now();
        $data['sumber_dana'] = 'sekolah';
        $data['jenis_barang'] = 'inventaris_ruangan';

        Barang::create($data);
        return back();
    }

    public function cariInventarisR(Request $request){
        $search = $request->validate([
            'search' => 'required',
        ]);

        $select = Barang::where([['nama_barang',$search],['jenis_barang','inventaris_ruangan']])->simplePaginate(5);
        return view('admin.daftarBarang.inventarisRuangan',['barang' => $select]);
    }

}
