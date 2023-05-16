@extends('layout.admin.index')
@section('content')

{{-- modal tambah  --}}
<div id="modal" class="bg-black/50 z-10 w-full h-full absolute" style="display: none">
    <div class="w-1/3 h-9/12 pb-10 pt-4 bg-white absolute left-1/3 mt-8 rounded-xl">
        <form method="POST" action="/inventarisRuangan/detail/Ruangan={{ $nama->ruangan }}" class="grid pl-10 gap-1.5" autocomplete="off">
            @csrf
            <h3 class="text-lg my-4 font-semibold">Tambah Barang</h3>
            <label for="nama_barang" class="text-gray-400">Nama Barang</label>
                <input type="text" name="nama_barang" class="border border-gray-300 w-96 h-7 rounded-lg p-2">
            <label for="baik" class="text-gray-400">Jumlah Barang</label>
                <input type="number" name="baik" class="border border-gray-300 w-96 h-7 rounded-lg p-2">
            <div class="flex gap-56 mt-5">
                <a class="text-red-500 cursor-pointer" onclick="Open('modal')">Kembali</a>
                <button type="submit" class="w-24 h-8 text-center bg-blue-500 text-white rounded-2xl">Tambah</button>
            </div>
        </form>
    </div>
</div>

{{-- modal update  --}}
@if( $kode != null)
<div id="update" class="bg-black/50 z-10 w-full h-full absolute">
    <div class="w-1/3 h-9/12 pb-10 pt-4 bg-white absolute left-1/3 mt-8 rounded-xl">
        <form method="POST" action="/inventarisRuangan/detail/Ruangan={{ $nama->ruangan }}/{{ $kode->kode_barang }}" class="grid pl-10 gap-1.5" autocomplete="off">
            @csrf
            <h3 class="text-lg my-4 font-semibold">Update Stok</h3>
            <label for="baik" class="text-gray-400">Jumlah Barang</label>
                <input type="number" name="jumlah" class="border border-gray-300 w-96 h-7 rounded-lg p-2">
            <label for="ket" class="text-gray-400">Kondisi Barang</label>
                <select name="kondisi" class="border border-gray-300 w-96 h-10 rounded-lg p-2">
                    <option value="baik">Baik</option>
                    <option value="rusak">Rusak</option>
                </select>
            <label for="kendala" class="text-gray-400">Kendala</label>
                <textarea name="kendala" class="border border-gray-300 w-96 h-24 rounded-lg mb-1 resize-none px-2 py-1"></textarea>
            <label for="foto" class="text-gray-400">Foto</label>
                <input type="file" name="foto" class="border border-gray-300 w-96 h-12 rounded-lg p-2">
            <div class="flex gap-56 mt-5">
                <a class="text-red-500 cursor-pointer" href="/inventarisRuangan/detail/Ruangan={{ $nama->ruangan }}?page={{ request()->page??1 }}">Kembali</a>
                <button type="submit" class="w-24 h-8 text-center bg-blue-500 text-white rounded-2xl">Tambah</button>
            </div>
        </form>
    </div>
</div>
@else
@endif
<div class="ml-10 mt-9">
    <h3 class="font-semibold text-xl">Detail Ruangan</h3>
    @if( session('error'))
        
    @endif
    <div class="absolute right-12">
        <div class="grid grid-cols-3">
            <button class="bg-blue-300 text-white border border-blue-300 p-2 rounded-l-3xl" onclick="Open('modal')">Tambah</button>
            <a href="/inventarisRuangan/detail/Ruangan={{ $nama->ruangan }}/printPDF" class="p-2 text-center border border-y-black">PDF</a>
            <a class="bg-red-600 text-white border border-gray-400 p-2 rounded-r-3xl" href="/inventarisRuangan?page={{ request()->page??1}}"><i class="fa-solid fa-door-open mr-2 "></i>Kembali</a>
        </div>  
    </div>
    <div class="my-4">
        <ul>
            <li>No Ruang : {{ $nama->ruangan }}</li>
            <li>Nama Ruangan : {{ $nama->nama_ruangan }}</li>
            <li>Nama Penanggung Jawab Rayon : {{ $nama->pj_rayon }}</li>
            <li>Nama Penanggung Jawab Ruangan : {{ $nama->pj_ruangan }}</li>
        </ul>
    </div>
        <div>
            <table class="text-center">
                <thead class="bg-sky-200">
                    <th class="w-12 p-1 rounded-tl-lg">No</th>
                    <th class="w-44">Kode Barang</th>
                    <th class="w-48 text-left">Nama Barang</th>
                    <th class="w-24">Satuan</th>
                    <th class="w-24">Baik</th>
                    <th class="w-24">Rusak</th>
                    <th class="w-44">Total</th>
                    <th class="rounded-tr-lg w-12"></th>
                </thead>
                @foreach( $detail as $p)
                <tbody class="bg-gray-200">
                    <td class="w-12 p-1">{{ $p->id }}</td>
                    <td class="w-44">{{ $p->kode_barang }}</td>
                    <td class="w-48 text-left">{{ $p->nama_barang }}</td>
                    <td class="w-24">{{ $p->satuan }}</td>
                    <td class="w-24">{{ $p->baik }}</td>
                    @if ( $p->rusak == null)
                    <td class="w-24">0</td>
                    @else
                    <td class="w-24">{{ $p->rusak }}</td>
                    @endif
                    <td class="w-44">{{ $p->baik + $p->rusak }}</td>
                    <td class="text-center w-12"> 
                        <div class="group inline-block mt-[7px]">
                        <button class="outline-none focus:outline-none border px-3 py-1 flex items-center min-w-32">
                          <span class="pr-1 flex-1">...</span>
                                </button>
                                <ul
                                class="bg-white border rounded-3xl transform scale-0 group-hover:scale-100 absolute z-10 right-32
                                transition duration-150 ease-in-out origin-top min-w-32"
                                >
                                <li class="p-2 rounded-3xl hover:bg-gray-300"><a href="/inventarisRuangan/detail/Ruangan={{ $p->ruangan }}/{{ $p->kode_barang }}">Update Stok</a></li>
                            </ul>
                        </div>
                    </td>
                </tbody>
                @endforeach
            </table>
        </div>
</div>
@endsection