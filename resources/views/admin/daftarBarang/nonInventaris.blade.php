@extends('layout.admin.index')
@section('content')
<div id="modal" class="bg-black/50 z-10 w-full h-full absolute" style="display: none">
    <div class="w-1/3 h-9/12 pb-10 pt-1 bg-white absolute left-1/3 mt-2 rounded-xl ">
        <form method="POST" action="/inventaris" class="grid pl-10 gap-1.5" autocomplete="off">
            @csrf
            <h3 class="text-lg my-4 font-semibold">Tambah Barang</h3>
            <label for="kode_barang" class="text-gray-400">Kode Barang</label>
                <input type="text" name="kode_barang" class="border border-gray-300 w-96 h-7 rounded-lg p-2">
            <label for="nama_barang" class="text-gray-400">Nama Barang</label>
                <input type="text" name="nama_barang" class="border border-gray-300 w-96 h-7 rounded-lg p-2">
            <label for="kategori_barang" class="text-gray-400">Kategori Barang</label>
                <select name="kategori_barang" class="border border-gray-300 w-96 h-10 rounded-lg p-2 cursor-pointer">
                    <option value="Alat Tulis">Alat Tulis</option>
                </select>
            <label for="satuan" class="text-gray-400">Satuan</label>
                <select name="satuan" class="border border-gray-300 w-96 h-10 rounded-lg p-2 cursor-pointer">
                    <option value="Buah">Buah</option>
                    <option value="Unit">Unit</option>
                </select>   
            <label for="jml_barang" class="text-gray-400">Kondisi Barang</label>
                <input type="number" name="baik" placeholder="Jumlah Barang Baik" class="border border-gray-300 w-96 h-7 rounded-lg p-2">
                <input type="number" name="rusak" placeholder="Jumlah Barang Rusak" class="border border-gray-300 w-96 h-7 rounded-lg p-2">
            <div class="flex gap-56 mt-4">
                <a class="text-red-500 cursor-pointer" onclick="Open('modal')">Kembali</a>
                <button type="submit" class="w-24 h-8 text-center bg-blue-500 text-white rounded-2xl">Tambah</button>
            </div>
        </form>
    </div>
</div>
  <div class="ml-10 mt-9">
    <span class="text-2xl font-semibold mb-7">Daftar Barang - Non Inventaris</span>
    <div class="flex gap-6 mt-12 ">
        <form action="/inventaris/cari" method="GET">
            @csrf
            <input type="text" name="search" class="border border-gray-400 rounded-3xl pl-6 pr-24 py-2" placeholder="Cari Barang">
        </form>
        <div class="flex flex-col relative">
            <a class="bg-white border border-gray-400 px-8 py-2 rounded-3xl cursor-pointer" onclick="Open('filter');">Filters</a>
            <div id="filter" style="display: none;" class="bg-white border border-gray-400 rounded-xl w-60 h-80 absolute top-14 right-12">
                <form action="" class="flex flex-col pt-4 pl-6 gap-2">
                    <label for="" class="text-gray-400">Kategori Barang</label>
                    <input type="checkbox" name="" id="">
                </form>
            </div>
        </div>
    </div>
    <div class="absolute top-0 right-8 items-end z-0">
        <div class="flex flex-row cursor-pointer justify-end mt-6 mr-10" onclick="Open('logoutButton')">
            <img src="/assets/logo.png" alt="logo" class="w-16 h-12 pr-3">
                <div class="text-left mt-1">
                    <div class="text-base text-gray-600 font-semibold">
                        {{ Auth::user()->username }}
                    </div>
                    <div class="text-xs text-gray-400">
                        {{ Auth::user()->role }}
                    </div>
                </div>
                <a onclick="Alert()" id="logoutButton" style="display: none;" class="bg-white text-red-400 text-left rounded-lg w-32 h-8 pl-4 pt-1 cursor-pointer hover:bg-red-500 hover:text-white">
                    Keluar
                </a>
        </div>
        <a onclick="Alert()" id="logoutButton" style="display: none;" class="bg-white text-red-400 text-left rounded-lg w-32 h-8 pl-4 pt-1 cursor-pointer hover:bg-red-500 hover:text-white">
            Keluar
        </a>
      <div class="mt-14">
            <a class="bg-blue-500 text-white border border-gray-200 px-6 py-3 rounded-3xl cursor-pointer" onclick="Open('modal')">Tambah Barang +</a>
      </div>
    </div>
    <div class="w-full">
        <table class="mt-7 text-center rounded-xl">
            <thead class="bg-blue-300">
                <th class="w-12 rounded-tl-lg">No</th>
                <th class="px-4 py-2 w-44">Kode Barang</th>
                <th class="w-80 text-left">Nama Barang</th>
                <th class="px-8 w-24">Satuan</th>
                <th class="px-8">Baik</th>
                <th class="px-8">Rusak</th>
                <th class="px-4">Total</th>
                <th class="px-4 rounded-tr-lg"></th>
            </thead>
            @foreach( $barang as $p)
            <tbody class="bg-gray-200">
                <td class="py-2.5 w-12">{{ $p->id }}</td>
                <td class="py-2.5">{{ $p->kode_barang }}</td>
                <td class="py-2.5 overflow-hidden whitespace-nowrap text-ellipsis inline-block text-left w-80">{{ $p->nama_barang }}</td>
                <td>{{ $p->satuan }}</td>
                <td>{{ $p->baik }}</td>
                @if( $p->rusak == null)
                <td>0</td>
                @else
                <td>{{ $p->rusak }}</td>
                @endif
                <td>{{ $p->baik + $p->rusak }}</td>
                <td><a href="">...</a></td>
            </tbody>
            @endforeach
        </table>
        {{ $barang->links() }}
    </div>
  </div>
    
@endsection