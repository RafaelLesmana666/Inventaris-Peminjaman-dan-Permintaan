@extends('layout.admin.index')
@section('content')
<div id="modal" class="bg-black/50 z-10 w-full h-full absolute" style="display: none">
    <div class="w-1/3 h-9/12 pb-10 pt-4 bg-white absolute left-1/3 mt-8 rounded-xl">
        <form method="POST" action="/nonInventaris" class="grid pl-10 gap-2">
            @csrf
            <h3 class="text-lg my-4 font-semibold">Tambah Barang</h3>
            <label for="nama_barang" class="text-gray-400">Nama Barang</label>
                <input type="text" name="nama_barang" class="border border-gray-300 w-96 h-7 rounded-lg">
            <label for="merk_barang" class="text-gray-400">Merk Barang</label>
                <input type="text" name="merk_barang" class="border border-gray-300 w-96 h-7 rounded-lg">
            <label for="jml_barang" class="text-gray-400">Jumlah Barang</label>
                <input type="text" name="jml_barang" class="border border-gray-300 w-96 h-7 rounded-lg">
            <label for="kategori_barang" class="text-gray-400">Kategori Barang</label>
                <select name="kategori_barang" class="border border-gray-300 w-96 h-7 rounded-lg">
                    <option value="alat_tulis">Alat Tulis</option>
                </select>
            <label for="spesifikasi" class="text-gray-400">Spesifikasi Barang</label>
                <textarea name="kondisi_barang" class="border border-gray-300 w-96 h-12 rounded-lg mb-10 resize-none"></textarea>
            <div class="flex gap-56">
                <a class="text-red-500 cursor-pointer" onclick="Open('modal')">Kembali</a>
                <button type="submit" class="w-24 h-8 text-center bg-blue-500 text-white rounded-2xl">Tambah</button>
            </div>
        </form>
    </div>
</div>
  <div class="ml-10 mt-9">
    <span class="text-2xl font-semibold mb-7">Daftar Barang - Non Inventaris</span>
    <div class="flex gap-6 mt-12 ">
        <form action="/nonInventaris/cari" method="GET">
            <input type="text" name="search" class="border border-gray-400 rounded-3xl pl-6 pr-24 py-2" placeholder="Cari di History">
        </form>
        <div class="flex flex-col relative">
            <a class="bg-white border border-gray-400 px-8 py-2 rounded-3xl cursor-pointer" onclick="Open('filter');">Filters</a>
            <div id="filter" style="display: none;" class="bg-white border border-gray-400 rounded-xl w-60 h-80 absolute top-14 right-12">
                <form action="" class="flex flex-col pt-4 pl-6 gap-2">
                    <label for="" class="text-gray-400">Tanggal Dipinjam</label>
                        <input type="date" class="rounded-2xl border border-gray-300 w-48 h-8 p-2">
                    <label for="" class="text-gray-400">Jenis Barang</label>
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
            <a class="bg-blue-500 text-white border border-gray-200 px-6 py-3 rounded-3xl cursor-pointer" onclick="Open('modal')">Tambah Stok +</a>
      </div>
    </div>
    <table class="mt-7 text-center rounded-xl">
        <thead class="bg-blue-300">
           <th class="px-4 py-2 rounded-tl-lg">kode</th>
           <th class="px-8">Nama Barang</th>
           <th class="px-8">Merk Barang</th>
           <th class="px-8">Kategori Barang</th>
           <th class="px-4">Stok</th>
           <th class="pl-8 pr-60">Spesifikasi</th>
           <th class="px-4 rounded-tr-lg"></th>
        </thead>
        @foreach( $barang as $p)
        <tbody class="bg-gray-200">
           <td class="py-2.5 rounded-bl-lg">{{ $p->id }}</td>
           <td>{{ $p->nama_barang }}</td>
           <td>{{ $p->merk_barang }}</td>
           <td>{{ $p->kategori_barang }}</td>
           <td>{{ $p->jml_barang }}</td>
           <td class="text-left pl-8">{{ $p->kondisi_barang }}</td>
           <td><a href="">...</a></td>
        </tbody>
        @endforeach
   </table>
   {{ $barang->links() }}
  </div>
    
@endsection