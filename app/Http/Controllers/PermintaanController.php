<?php

namespace App\Http\Controllers;
use \PDF;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Barang;
use App\Models\Permintaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermintaanController extends Controller
{
    public function index(){
        $permintaan = Permintaan::orderBy('id','asc')->simplePaginate(5);
        return view('admin.permintaan.index', compact('permintaan'));
    }

    public function search(Request $request){
        $data = $request->validate([
            'search' => 'required'
        ]);

        $cari = $data['search'];
        $permintaan = Permintaan::where('nama_peminta', $cari)->simplePaginate(5);;
        return view('admin.permintaan.index',compact('permintaan'));    
    }

    public function print(Request $request){
        $data = $request->validate([
            'bulan' => 'required',
        ]);
        
        $bulan = $data['bulan'];
        $filter = Permintaan::whereMonth('tgl_permintaan',$bulan)->get();
        $cetak = PDF::loadview('admin.permintaan.PDFpermintaan', compact('filter'));
        return $cetak->stream();
    }

    public function store(Request $request){
        $data = $request->validate([
            'nama_peminta' => 'required',
            'nama_barang' => 'required',
            'tgl_permintaan',
            'jml_barang_diminta' => 'required',
            'alasan' => 'nullable',
            'kode_barang'
        ]);
            $barang = $data['nama_barang'];
            
            $cekBarang = Barang::where('nama_barang',$barang)->first();
            if ($cekBarang == 'null'){
                return back()->with('error','Barang tidak ada !');
            }else {
                $date = Carbon::now(); 
                $data['tgl_permintaan'] = $date;
                $jumlah = $cekBarang->baik;
                $kurang = $data['jml_barang_diminta'];
                $selisih = $jumlah - $kurang;
                if ( $selisih <= 0 ){
                    return back()->with('error','Stok Tersisa' . $jumlah);
                }else {
                        $update = ['baik' => $selisih ];
                        $cekBarang->update($update);

                        $kode_barang = $cekBarang->kode_barang;
                        $data['kode_barang'] = $kode_barang;
                        Permintaan::create($data);
                        return back();
                }
            }
        }

    }
