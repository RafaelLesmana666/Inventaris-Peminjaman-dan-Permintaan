<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BarangController extends Controller
{
    public function inventaris(){

        $kode = '';
        $barang = Barang::where('jenis_barang','inventaris')->simplePaginate(5);
        return view('admin.daftarBarang.inventaris',compact('barang','kode'));

    }

    public function filter(Request $request){

        $data = $request->validate([
            'filter' => 'required'
        ]);
        $kode = '';
        $filter = $data['filter'];
        $barang = Barang::where('kategori_barang',$filter)->first();

        $jenis = $barang->jenis_barang;
        if ( $jenis == 'inventaris'){

           return view('admin.daftarBarang.inventaris',compact('barang','kode')); 

        }else {

           return view('admin.daftarBarang.nonInventaris',compact('kode','barang'));

        }

    }

    public function modal($kode_barang){

       $barang = Barang::where('kode_barang',$kode_barang)->first();
       $jenis = $barang->jenis_barang;

       if ( $jenis == 'inventaris'){

        $kode = Barang::where('kode_barang',$kode_barang)->first();
        $barang = Barang::where('jenis_barang','inventaris')->simplePaginate(5);

        return view('admin.daftarBarang.inventaris',compact('barang','kode'));

       }else{

        $kode = Barang::where('kode_barang',$kode_barang)->first();
        $barang = Barang::where('jenis_barang','non_inventaris')->simplePaginate(5);

        return view('admin.daftarBarang.nonInventaris',compact('kode','barang'));

       }

    }

    public function update($kode_barang,Request $request){

        $data = $request->validate([
            'jumlah' => 'required'
        ]);

        $barang = Barang::where('kode_barang',$kode_barang)->first();
        $input = $data['jumlah'];
        $baik = $barang->baik;
        $jumlah = $baik + $input;
        $update = ['baik' => $jumlah];

        $barang->update($update);
        $jenis = $barang->jenis_barang;

        if ( $jenis == 'inventaris'){
            return redirect('/inventaris');
        }else {
            return redirect('/nonInventaris');
        }

        
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

        Barang::create($data);
        return back();
    }

    public function cariInventaris(Request $request){

        $search = $request->validate([
            'search' => 'required',

        ]);

        $barang = Barang::where([['nama_barang',$search],['jenis_barang','inventaris']])->simplePaginate(5);
        return view('admin.daftarBarang.inventaris',compact('barang'));

    }

    public function noninventaris(){

        $kode = '';
        $barang = Barang::where('jenis_barang','non_inventaris')->simplePaginate(5);

        return view('admin.daftarBarang.nonInventaris',compact('kode','barang'));

    }

    public function tambahNonInventaris(Request $request){

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

        $data['jenis_barang'] = 'non_inventaris';

        Barang::create($data);
        return back();

    }

    public function cariNonInventaris(Request $request){

        $search = $request->validate([

            'search' => 'required',

        ]);

        $barang = Barang::where([['nama_barang',$search],['jenis_barang','non_inventaris']])->simplePaginate(5);

        return view('admin.daftarBarang.nonInventaris',compact('barang'));

    }

}
