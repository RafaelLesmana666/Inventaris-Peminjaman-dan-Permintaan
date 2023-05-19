<?php

namespace App\Http\Controllers;

use \PDF;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Barang;
use App\Models\Servis;
use App\Models\Inventaris;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Http\Controllers\Controller;

class PeminjamanController extends Controller
{
    public function index(){

        $title = 'Hari ini';
        $total = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofDay(), Carbon::now()->endofDay()])->count();
        $dipinjam = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofDay(), Carbon::now()->endofDay()])->where('status_peminjaman','Masih Dipinjam')->count();
        $kembali = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofDay(), Carbon::now()->endofDay()])->where('status_peminjaman','Dikembalikan')->count();
        $rusak = Peminjaman::where('status_peminjaman','Barang Rusak')->get();
        $servis = Servis::all();
        $selesai = Servis::where('status_perbaikan','Dikembalikan')->count();
        $detail = '';
        $notif = Servis::where('status_perbaikan','Selesai Perbaikan')->get();

        for ($i=0; $i < $notif->count() ; $i++) { 
            $i;
        }

        $peminjaman = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofDay(), Carbon::now()->endofDay()])->simplePaginate(4);
        return view('admin.dashboard', compact('total','dipinjam','kembali','peminjaman','title','rusak','notif','i','servis','detail','selesai'));

    }
    public function filterMinggu(){
        
            $title = "Minggu ini";
            $total = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofWeek(), Carbon::now()->endofWeek()])->count();
            $dipinjam = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofWeek(), Carbon::now()->endofWeek()])->where('status_peminjaman','Masih Dipinjam')->count();
            $kembali = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofWeek(), Carbon::now()->endofWeek()])->where('status_peminjaman','Dikembalikan')->count();
            $rusak = Peminjaman::where('status_peminjaman','Barang Rusak')->get();
            $servis = Servis::all();
            $selesai = Servis::where('status_perbaikan','Dikembalikan')->count();
            $detail = '';
            $notif = Servis::where('status_perbaikan','Selesai Perbaikan')->get();
    
            for ($i=0; $i < $notif->count() ; $i++) { 
                $i;
            }

            $peminjaman = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofWeek(), Carbon::now()->endofWeek()])->simplePaginate(4);
             return view('admin.dashboard', compact('total','dipinjam','kembali','peminjaman','title','rusak','notif','i','servis','detail','selesai'));
    }

    public function filterBulan(){
    
            $title = "Bulan ini";
            $total = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofMonth(), Carbon::now()->endofMonth()])->count();
            $dipinjam = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofMonth(), Carbon::now()->endofMonth()])->where('status_peminjaman','Masih Dipinjam')->count();
            $kembali = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofMonth(), Carbon::now()->endofMonth()])->where('status_peminjaman','Dikembalikan')->count();
            $rusak = Peminjaman::where('status_peminjaman','Barang Rusak')->get();
            $servis = Servis::all();
            $selesai = Servis::where('status_perbaikan','Dikembalikan')->count();
            $detail = '';
            $notif = Servis::where('status_perbaikan','Selesai Perbaikan')->get();
    
            for ($i=0; $i < $notif->count() ; $i++) { 
                $i;
            }

            $peminjaman = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofMonth(), Carbon::now()->endofMonth()])->simplePaginate(4);
             return view('admin.dashboard', compact('total','dipinjam','kembali','peminjaman','title','rusak','notif','i','servis','detail','selesai'));
    }
    
    public function filterTahun(){

            $title = "Tahun ini";
            $total = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofYear(), Carbon::now()->endofYear()])->count();
            $dipinjam = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofYear(), Carbon::now()->endofYear()])->where('status_peminjaman','Masih Dipinjam')->count();
            $kembali = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofYear(), Carbon::now()->endofYear()])->where('status_peminjaman','Dikembalikan')->count();
            $rusak = Peminjaman::where('status_peminjaman','Barang Rusak')->get();
            $servis = Servis::all();
            $selesai = Servis::where('status_perbaikan','Dikembalikan')->count();
            $detail = '';
            $notif = Servis::where('status_perbaikan','Selesai Perbaikan')->get();
    
            for ($i=0; $i < $notif->count() ; $i++) { 
                $i;
            }

            $peminjaman = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofYear(), Carbon::now()->endofYear()])->simplePaginate(4);
            return view('admin.dashboard', compact('total','dipinjam','kembali','peminjaman','title','rusak','notif','i','servis','detail','selesai'));
    }

    public function notif($id){

        $title = 'Hari ini';
        $total = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofDay(), Carbon::now()->endofDay()])->count();
        $dipinjam = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofDay(), Carbon::now()->endofDay()])->where('status_peminjaman','Masih Dipinjam')->count();
        $kembali = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofDay(), Carbon::now()->endofDay()])->where('status_peminjaman','Dikembalikan')->count();
        $rusak = Peminjaman::where('status_peminjaman','Barang Rusak')->get();
        $servis = Servis::all();
        $selesai = Servis::where('status_perbaikan','Dikembalikan')->count();
        $detail = Servis::where('id',$id)->first();
        $notif = Servis::where('status_perbaikan','Selesai Perbaikan')->get();

        for ($i=0; $i < $notif->count() ; $i++) { 
            $i;
        }
    
        $peminjaman = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofDay(), Carbon::now()->endofDay()])->simplePaginate(4);
        return view('admin.dashboard', compact('total','dipinjam','kembali','peminjaman','title','rusak','notif','i','servis','detail','selesai'));

    }

    public function acc($id){

        $kategori = Servis::where('id',$id)->first();
        if ( $kategori->kategori_peminjaman == 'Ruangan' ){

            $inventaris = Inventaris::where([['ruangan',$kategori->ruangan],['nama_barang',$kategori->nama_barang]])->first();
            $jumlah = $kategori->jumlah;
            $baik = $inventaris->baik;
            $rusak = $inventaris->rusak;
            $selisih = $jumlah - $rusak;
            $tambah = $jumlah + $baik;
            $update = [
                'baik' => $tambah,
                'rusak' => $selisih
            ];

            $inventaris->update($update);
            
            $tgl = Carbon::now();
            $selesai = [
                'tgl_kembali' => $tgl,
                'status_perbaikan' => 'Dikembalikan'
            ];
            $kategori->update($selesai);

            return redirect('/admin');
            
        }else{

            $peminjaman = Peminjaman::where([['ruangan',$kategori->ruangan],['nama_peminjam',$kategori->nama_guru],['nama_barang',$kategori->nama_barang]])->first();
            $update = ['status_peminjaman' => 'Dikembalikan'];

            $peminjaman->update($update);

            $tgl = Carbon::now();
            $selesai = [
                'tgl_kembali' => $tgl,
                'status_perbaikan' => 'Dikembalikan'
            ];
            $kategori->update($selesai);
            
            return redirect('/admin');
        }
    }

    public function historyPeminjaman(){

        $peminjaman = Peminjaman::orderBy('tgl_peminjaman','asc')->simplePaginate(5);
        $detail = "";
        return view('admin.peminjaman.index',compact('peminjaman','detail'),['idR' => $detail]);
    }

    public function search(Request $request){
    
        $search = $request->validate([
            'search' => 'required'
        ]);

        $peminjaman = Peminjaman::where('nama_peminjam',$search)->simplePaginate(5);
        return view('admin.peminjaman.index',compact('peminjaman'));

    }

    public function filter(Request $request){

        $filter = $request->validate([
            'tgl_peminjaman' => 'required',
            'tgl_kembali' => 'nullable',
            'status_peminjaman' => 'required',
        ]);

        $tgl_peminjaman = $filter['tgl_peminjaman'];
        $tgl_kembali = $filter['tgl_kembali'];
        $status_peminjaman = $filter['status_peminjaman'];
        $detail = "";

        if ($tgl_kembali == null){
            $peminjaman = Peminjaman::where([['tgl_peminjaman',$tgl_peminjaman],['status_peminjaman',$status_peminjaman]])->simplePaginate(5);
            return view('admin.peminjaman.index',compact('peminjaman','detail'),['idReport' => $detail]);
        }else {
            $peminjaman = Peminjaman::where([['tgl_peminjaman',$tgl_peminjaman],['tgl_kembali',$tgl_kembali],['status_peminjaman',$status_peminjaman]])->simplePaginate(5);
            return view('admin.peminjaman.index',compact('peminjaman','detail'),['idReport' => $detail]);
        } 

    }
    
    public function print(Request $request){

        $data = $request->validate([
            'bulan' => 'required',
        ]);
        
        $bulan = $data['bulan'];
        $filter = Peminjaman::whereMonth('tgl_peminjaman',$bulan)->get();
        $cetak = PDF::loadview('admin.peminjaman.PDFpeminjaman', compact('filter'));
        return $cetak->stream();

    }

    public function store(Request $request){

        $data = $request->validate([
            'nama_peminjam' => 'required',
            'nama_barang' => 'required',
            'tgl_peminjaman',
            'tgl_kembali' => 'nullable',
            'jml_barang_dipinjam' => 'required',
            'kode_barang',
            'status_peminjaman',
            'kategori_barang',
            'ruangan' => 'required' 

        ]);

                $cekbarang = $data['nama_barang'];
                $stok = Barang::where('nama_barang',$cekbarang)->first();
                if($stok == null){
                    return back()->with('error','barang tidak tersedia');
                }else{
                    $data['tgl_peminjaman'] = Carbon::now()->toDateString();
                    $data['kode_barang'] = $stok->kode_barang;
                    $data['status_peminjaman'] = 'Masih Dipinjam';
                    $data['kategori_barang'] = $stok->kategori_barang;
                    $jml = $data['jml_barang_dipinjam'];
                    $kurang = $stok->baik;
                    $selisih = $kurang - $jml;
                    if($selisih < 0){
                        return back()->with('error','stock tersisa ' . $kurang);
                    }else{
                      $update = [ 'baik' => $selisih]; 
                      $stok->update($update);
                      Peminjaman::create($data);
                      return back();
                    }
                }

    }

    public function kembali($id_peminjaman, Request $request){

        $data = $request->validate([
            'kondisi' => 'required'
        ]);

        $kondisi = $data['kondisi'];

        if($kondisi == 'Dikembalikan'){
            $now = Carbon::now();
            $update = [
                'status_peminjaman' => 'Dikembalikan',
                'tgl_kembali' => $now
            ];
            $peminjaman = Peminjaman::where('id',$id_peminjaman)->first();

            $barangDipinjam = $peminjaman->nama_barang;
            $jumlah = $peminjaman->jml_barang_dipinjam;

            $barang = Barang::where('nama_barang',$barangDipinjam)->first();
            $stok = $barang->baik;
            $stokKembali = $stok + $jumlah;
            $updateBarang = ['jml_barang_dipinjam' => $stokKembali];
            $peminjaman->update($update);
            $barang->update($updateBarang);

            return back();

           }else{

           }

    }

    public function reportView($idReport){
        $peminjaman = Peminjaman::orderBy('tgl_peminjaman','asc')->simplePaginate(5);
        $idR = Peminjaman::where('id',$idReport)->first();
        $detail = '';
        return view('admin.peminjaman.index',compact('peminjaman','detail','idR')); 

    }

    public function report($id, Request $request){
        $data = $request->validate([
            'kendala' => 'required',
            'foto' => 'nullable'
        ]);

        if($file = $request->hasFile('foto')){
            $file = $request->file('foto');
            $imagename = $file->getClientOriginalName();
            $destination = public_path() . '/foto';
            $file->move($destination, $imagename);

            $data['foto'] = $imagename;

        }else {
            $data['foto'] = '';
        }
        
        $now = Carbon::now();
        $update = [
            'status_peminjaman' => 'Barang Rusak',
            'tgl_kembali' => $now
        ];

        $peminjaman = Peminjaman::where('id',$id)->first();
        $peminjaman->update($update);

        $servis = [
            'ruangan' => $peminjaman->ruangan,
            'nama_guru' => $peminjaman->nama_peminjam,
            'kode_barang' => $peminjaman->kode_barang,
            'nama_barang' => $peminjaman->nama_barang,
            'jumlah' => $peminjaman->jml_barang_dipinjam,
            'kategori_peminjaman' => 'Individu',
            'tgl_masuk' => Carbon::now(),
            'status_perbaikan' => 'Request',
            'kendala' => $data['kendala'],
            'foto' => $data['foto']
        ];

        Servis::create($servis);
        return redirect('/peminjaman');
       }

    public function detail ($id){
        $peminjaman = Peminjaman::orderBy('tgl_peminjaman','asc')->simplePaginate(5);
        $detail = Peminjaman::where('id',$id)->first();
        $idR = '';
        return view('admin.peminjaman.index',compact('peminjaman','detail','idR')); 

    }
}
