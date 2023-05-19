<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Servis;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServisController extends Controller
{

    public function dashboard(){

        $title = 'Saat ini';
        $request = Servis::where('status_perbaikan','Request')->get();
        $sedangDiperbaiki = Servis::where('status_perbaikan','Sedang Diperbaiki')->count();
        $selesai = Servis::where('status_perbaikan','Selesai Perbaikan')->count();
        $dikembalikan = Servis::where('status_perbaikan','Dikembalikan')->count();
        $detail = '';

       for ($i=0; $i < $request->count(); $i++) { 
         $i;
       }

        $servis = Servis::orderBy('tgl_masuk', 'asc')->simplePaginate(4);
        return view('teknisi.dashboard', compact('servis','request','sedangDiperbaiki','selesai','title','dikembalikan','i','detail'));
    }

    public function servis(){

        $detail = '';
        $servis = Servis::orderBy('ruangan','asc')->simplePaginate(5);
        return view('admin.daftarBarang.barangRusak',compact('servis','detail'));
        
    }
    
    public function search(Request $request){
        $data = $request->validate([
            'search' => 'required'
        ]);

        $input = $data['search'];
        
        $servis = Servis::where('nama_barang',$input)->simplePaginate(5); 
        return view('admin.daftarBarang.barangRusak',compact('servis'));

    }

    public function notif($id){

        $title = 'Saat ini';
        $request = Servis::where('status_perbaikan','Request')->get();
        $sedangDiperbaiki = Servis::where('status_perbaikan','Sedang Diperbaiki')->count();
        $selesai = Servis::where('status_perbaikan','Selesai Perbaikan')->count();
        $dikembalikan = Servis::where('status_perbaikan','Dikembalikan')->count();
        $detail = Servis::where('id',$id)->first();

       for ($i=0; $i < $request->count(); $i++) { 
         $i;
       }

        $servis = Servis::orderBy('tgl_masuk', 'asc')->simplePaginate(4);
        return view('teknisi.dashboard', compact('servis','request','sedangDiperbaiki','selesai','title','dikembalikan','i','detail'));
        
    }
    public function acc($id){

        $servis= Servis::where('id',$id)->first();
        $update = ['status_perbaikan' => 'Sedang Diperbaiki'];
        $servis->update($update);
        return redirect('/teknisi');

    }

    public function detail($id){

        $detail = Servis::where('id',$id)->first();
        $servis = Servis::orderBy('ruangan','asc')->simplePaginate(5);
        return view('admin.daftarBarang.barangRusak',compact('servis','detail'));
        

    }

    public function update($id, Request $request){
        $data = $request->validate([
            'kondisi' => 'required'
        ]);

        $get = Servis::where('id', $id)->first();

        if ( $data['kondisi'] == 'Sedang Diperbaiki'){
            
            $update = [ 'status_perbaikan' => 'Sedang Diperbaiki'];
            $get->update($update);
            return back();
        }else{
            $update = [ 'status_perbaikan' => 'Selesai Perbaikan'];
            $get->update($update);
            return back();
        }
    }
}
