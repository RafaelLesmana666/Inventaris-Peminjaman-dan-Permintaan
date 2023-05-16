<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Servis;
use \PDF;
use App\Models\Inventaris;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventarisRuanganController extends Controller
{
    public function index(){
        $inventarisRuangan = Inventaris::distinct()->get(['ruangan','nama_ruangan','pj_rayon','pj_ruangan']);
        return view('admin.inventarisRuangan.inventarisRuangan',compact('inventarisRuangan'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'ruangan' => 'required',
            'nama_ruangan' => 'required',
            'pj_rayon' => 'required',
            'pj_ruangan' => 'required',
            'kode_barang',
            'nama_barang' => 'required',
            'satuan',
            'baik' => 'required',
            'rusak' => 'nullable',
        ]);

        $ruang = Inventaris::where('ruangan',$data['ruangan'])->first();

        if ( $ruang != null){

            return back()->with('error','ruangan sudah ada !');

        }
        else {

            $barang = $data['nama_barang'];
            $cekBarang = Barang::where('nama_barang',$barang)->first();
            $kode = $cekBarang->kode_barang;
            $data['kode_barang'] = $kode;
            $data['satuan'] = $cekBarang->satuan;

            $baik = $cekBarang->baik;
            $kurang = $baik - $data['baik'];

            $update = [
                'baik' => $kurang
            ];

            $cekBarang->update($update);
            Inventaris::create($data);
            
            return back();

        }
    }

    public function detail($ruangan){

        $nama = Inventaris::where('ruangan', $ruangan)->first();
        $detail = Inventaris::where('ruangan',$ruangan)->get();
        $kode = '';

        return view('admin.inventarisRuangan.detailRuangan',compact('detail','nama','kode'));
    }

    public function print($ruangan){
     
        $inventaris = Inventaris::where('ruangan',$ruangan)->get();
        $nama = Inventaris::where('ruangan', $ruangan)->first();

        $cetak = PDF::loadview('admin.inventarisRuangan.pdf', compact('inventaris','nama'));
        return $cetak->stream();

    }

    public function updateModal($ruang,$kode_barang){

        $nama = Inventaris::where('ruangan', $ruang)->first();
        $detail = Inventaris::where('ruangan',$ruang)->get();
        $kode = Inventaris::where('kode_barang',$kode_barang)->first();
        
        return view('admin.inventarisRuangan.detailRuangan',compact('detail','nama','kode'));
    }

    public function update($ruang, $kode_barang, Request $request){
        $data = $request->validate([

            'jumlah' => 'required',
            'kondisi' => 'required',
            'kendala' => 'nullable',
            'foto' => 'nullable'
            
        ]);

        $inventaris = Inventaris::where([['ruangan',$ruang],['kode_barang',$kode_barang]])->first();
        $barang = Barang::where('kode_barang',$kode_barang)->first();
        $kondisi = $data['kondisi'];

            if ( $kondisi == 'baik'){

                $kurang = $barang->baik;
                $selisih = $kurang - $data['jumlah'];

                if ( $selisih <= 0){

                    return back()->with('error','Sisa stok tersisa' .  $kurang);

                }else{
                    $jumlah = $inventaris->baik;
                    $tambah = $jumlah + $data['jumlah'];
                    
                    $updataBarang = ['baik' => $selisih];
                    $update = ['baik' => $tambah];

                    $barang->update($updataBarang);
                    $inventaris->update($update);

                    return redirect('/inventarisRuangan/detail/Ruangan='.$ruang.'?page='.request()->page??1);
                }
             }else {
               
                $stok = $inventaris->baik;
                $kurang = $stok - $data['jumlah'];

                if ( $kurang <= 0){

                    return back()->with('error','error');

                }else{

                    $update = [

                            'baik' => $kurang,
                            'rusak' => $data['jumlah']
                    ];

                    $rusak = ['rusak' => $data['jumlah']];
                    $servis = [

                        'ruangan' => $ruang,
                        'nama_guru' => $inventaris->pj_ruangan,
                        'kode_barang' => $kode_barang,
                        'nama_barang' => $inventaris->nama_barang,
                        'kategori_pinjaman' => 'ruangan',
                        'status_perbaikan' => 'Request',
                        'kendala' => $data['kendala'],
                        'foto' => $data['foto']

                    ];

                    Servis::create($servis);
                    $barang->update($rusak);
                    $inventaris->update($update);

                    return redirect('/inventarisRuangan/detail/Ruangan='.$ruang.'?page='.request()->page??1);
                }
                
             }
        
        
    }

   public function tambah($ruangan, Request $request){
        $data = $request->validate([
            'nama_barang' => 'required',
            'baik' => 'required'
        ]);

        $cekBarang = Barang::where('nama_barang',$data['nama_barang'])->first();

        if( $cekBarang == null){
            return back()->with('error','barang tidak ada!');
        }else {
            $BarangInventaris = Inventaris::where('nama_barang',$data['nama_barang'])->first();
            if ( $BarangInventaris != null){
                return back()->with('error','barang sudah ada !');
            }else {
                $jumlah = $data['baik'];
                $stok = $cekBarang->baik;
                $selisih = $stok - $jumlah;
                if ( $selisih <= 0) {
                    return back()->with('error','Stok Tersisa' . $stok);
                }else{
                    $BarangRuangan = Inventaris::where('ruangan',$ruangan)->first();
                    $update = ['baik' => $selisih];
                    $tambah = [
                        'ruangan' => $ruangan,
                        'nama_ruangan' => $BarangRuangan->nama_ruangan,
                        'pj_rayon' => $BarangRuangan->pj_rayon,
                        'pj_ruangan' => $BarangRuangan->pj_ruangan,
                        'kode_barang'  => $cekBarang->kode_barang,
                        'satuan' => $cekBarang->satuan,
                        'nama_barang' => $data['nama_barang'],
                        'baik' => $data['baik']

                    ];

                    $cekBarang->update($update);
                    Inventaris::create($tambah);

                    return back();
                }
            }
        }
   }
}
