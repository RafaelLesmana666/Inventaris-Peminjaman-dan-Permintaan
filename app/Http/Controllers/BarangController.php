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
        return view('admin.daftarBarang.inventaris',compact('barang'));
    }

    public function tambahInventaris(Request $request){
        $data = $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'jenis_barang',
            'kategori_barang' => 'required',
            'satuan' => 'required',
            'baik' => 'required',
            'rusak' => 'nullable',
            'status_perbaikan' => 'nullable',
            'kendala' => 'nullable',
            'foto' => 'nullable'
        ]);

        $data['jenis_barang'] = 'inventaris';
        $data['jml_barang'] = $data['baik'] + $data['rusak'];


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
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'jml_barang' => 'required', 
            'jenis_barang',
            'kategori_barang' => 'required',
            'satuan' => 'required',
            'kondisi_barang',
            'status_perbaikan' => 'nullable',
            'kendala' => 'nullable',
            'foto' => 'nullable'
        ]);

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

}
