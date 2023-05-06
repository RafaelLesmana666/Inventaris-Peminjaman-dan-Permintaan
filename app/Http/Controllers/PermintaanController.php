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
        return view('admin.history.permintaan', compact('permintaan'));
    }

    public function print(Request $request){
        $data = $request->validate([
            'bulan' => 'required',
        ]);
        
        $bulan = $data['bulan'];
        $filter = Permintaan::whereMonth('tgl_permintaan',$bulan)->get();
        $cetak = PDF::loadview('admin.history.PDFpermintaan', compact('filter'));
        return $cetak->stream();
    }

    public function store(Request $request){
        $data = $request->validate([
            'nip',
            'nama_guru' => 'required',
            'nama_barang' => 'required',
            'tgl_permintaan',
            'jml_barang_diminta' => 'required',
            'alasan' => 'nullable',
            'id_barang'
        ]);

        $guru = $data['nama_guru'];
        $ambilNip = User::where('username', $guru)->first();
        if ( $ambilNip == null){
            return back()->with('error','Nama guru belum terdaftar !');
        }else{
            $nip = $ambilNip->nip;
            $data['nip'] = $nip;
            $barang = $data['nama_barang'];
            
            $cekBarang = Barang::where('nama_barang',$barang)->first();
            if ($cekBarang == 'null'){
                return back()->with('error','Barang tidak ada !');
            }else {
                $date = Carbon::now(); 
                $data['tgl_permintaan'] = $date;
                $jumlah = $cekBarang->jml_barang;
                $kurang = $data['jml_barang_diminta'];
                $selisih = $jumlah - $kurang;
                if ( $selisih <= 0 ){
                    return back()->with('error','Stok Tersisa' . $jumlah);
                }else {
                        $update = ['jml_barang' => $selisih ];
                        $cekBarang->update($update);

                        $id = $cekBarang->id;
                        $data['id_barang'] = $id;
                        Permintaan::create($data);
                        return back();
                }
            }
        }

    }
}
