<?php

namespace App\Http\Controllers;

use \PDF;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PeminjamanController extends Controller
{
    public function index(){
        $title = 'Hari ini';
        $total = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofDay(), Carbon::now()->endofDay()])->count();
        $dipinjam = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofDay(), Carbon::now()->endofDay()])->where('status_peminjaman','Masih Dipinjam')->count();
        $kembali = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofDay(), Carbon::now()->endofDay()])->where('status_peminjaman','Dikembalikan')->count();
        $rusak = Peminjaman::where('status_peminjaman','Barang Rusak')->count();

        $peminjaman = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofDay(), Carbon::now()->endofDay()])->simplePaginate(4);
        return view('admin.dashboard', compact('total','dipinjam','kembali','peminjaman','title','rusak'));
    }
    public function filterMinggu(){
        
            $title = "Minggu ini";
            $total = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofWeek(), Carbon::now()->endofWeek()])->count();
            $dipinjam = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofWeek(), Carbon::now()->endofWeek()])->where('status_peminjaman','Masih Dipinjam')->count();
            $kembali = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofWeek(), Carbon::now()->endofWeek()])->where('status_peminjaman','Dikembalikan')->count();
            $rusak = Peminjaman::where('status_peminjaman','Barang Rusak')->count();

            $peminjaman = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofWeek(), Carbon::now()->endofWeek()])->simplePaginate(4);
            return view('admin.dashboard', compact('total','dipinjam','kembali','peminjaman','title','rusak'));
    }

    public function filterBulan(){
    
            $title = "Bulan ini";
            $total = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofMonth(), Carbon::now()->endofMonth()])->count();
            $dipinjam = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofMonth(), Carbon::now()->endofMonth()])->where('status_peminjaman','Masih Dipinjam')->count();
            $kembali = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofMonth(), Carbon::now()->endofMonth()])->where('status_peminjaman','Dikembalikan')->count();
            $rusak = Peminjaman::where('status_peminjaman','Barang Rusak')->count();

            $peminjaman = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofMonth(), Carbon::now()->endofMonth()])->simplePaginate(4);
            return view('admin.dashboard', compact('total','dipinjam','kembali','peminjaman','title','rusak'));
    }
    
    public function filterTahun(){

            $title = "Tahun ini";
            $total = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofYear(), Carbon::now()->endofYear()])->count();
            $dipinjam = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofYear(), Carbon::now()->endofYear()])->where('status_peminjaman','Masih Dipinjam')->count();
            $kembali = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofYear(), Carbon::now()->endofYear()])->where('status_peminjaman','Dikembalikan')->count();
            $rusak = Peminjaman::where('status_peminjaman','Barang Rusak')->count();

            $peminjaman = Peminjaman::whereBetween('tgl_peminjaman', [Carbon::now()->startofYear(), Carbon::now()->endofYear()])->simplePaginate(4);
            return view('admin.dashboard', compact('total','dipinjam','kembali','peminjaman','title','rusak'));
    }

    public function historyPeminjaman(){
        $peminjaman = Peminjaman::orderBy('tgl_peminjaman','asc')->simplePaginate(5);
        $detail = "";
        return view('admin.history.peminjaman',compact('peminjaman','detail'));
    }

    public function search(Request $request){
        $search = $request->validate([
            'search' => 'required'
        ]);

        $cari = Peminjaman::where('nama_guru',$search)->simplePaginate(5);
        return view('admin.history.peminjaman',['peminjaman' => $cari]);
    }
    
    public function print(Request $request){
        $data = $request->validate([
            'bulan' => 'required',
        ]);
        
        $bulan = $data['bulan'];
        $filter = Peminjaman::whereMonth('tgl_peminjaman',$bulan)->get();
        // dd($filter);
        $cetak = PDF::loadview('admin.history.PDFpeminjaman', compact('filter'));
        return $cetak->stream();
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

             $guru = $data['nama_guru'];
             $ambilnip = User::where('username',$guru)->first();

             if ($ambilnip == null){
                return with('error','nama guru belum terdaftar!');
             }else{
                $data['nip'] = $ambilnip->id;
                $cekbarang = $data['nama_barang'];
                $stok = Barang::where('nama_barang',$cekbarang)->first();
                if($stok == null){
                    return with('error','barang tidak tersedia');
                }else{
                    $data['tgl_peminjaman'] = Carbon::now()->toDateString();
                    $data['id_barang'] = $stok->id;
                    $data['status_peminjaman'] = 'Masih Dipinjam';
                    $data['kategori_barang'] = $stok->kategori_barang;
                    $jml = $data['jml_barang_dipinjam'];
                    $kurang = $stok->jml_barang;
                    $selisih = $kurang - $jml;
                    if($selisih <= 0){
                        return with('error','stock tersisa ' . $kurang);
                    }else{
                      $update = [ 'jml_barang' => $selisih]; 
                      $stok->update($update);
                      Peminjaman::create($data);
                      return back();
                    }
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
            $stok = $barang->jml_barang;
            $stokKembali = $stok + $jumlah;
            $updateBarang = ['jml_barang' => $stokKembali];
            $peminjaman->update($update);
            $barang->update($updateBarang);

            return back();

           }else{
            $now = Carbon::now();
            $update = [
                'status_peminjaman' => 'Barang Rusak',
                'tgl_kembali' => $now
            ];
            $peminjaman = Peminjaman::where('id',$id_peminjaman)->first();
            $peminjaman->update($update);
            return back();
           }
    }

    public function detail ($id){
        $peminjaman = Peminjaman::orderBy('tgl_peminjaman','asc')->simplePaginate(5);
        $detail = Peminjaman::where('id',$id)->first();
        return view('admin.history.peminjaman',compact('peminjaman','detail'));
    }
}
