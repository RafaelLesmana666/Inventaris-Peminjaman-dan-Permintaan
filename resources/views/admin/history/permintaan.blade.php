@extends('layout.admin.index')
@section('content')
<div id="modal" class="bg-black/50 z-10 w-full h-full absolute" style="display: none">
    <div class="w-1/3 h-9/12 pb-10 pt-4 bg-white absolute left-1/3 mt-8 rounded-xl">
        <form method="POST" action="" class="grid pl-10 gap-2">
            <h3 class="text-lg my-4 font-semibold">Permintaan Barang</h3>
            <label for="nama_guru" class="text-gray-400">Nama Peminta</label>
                <input type="text" name="nama_guru" class="border border-gray-300 w-96 h-7 rounded-lg">
            <label for="nama_barang" class="text-gray-400">Barang apa yang dipinjam? (Jumlah - Barang)</label>
                <div class="flex">
                    <input type="text" name="nama_barang" class="border border-gray-300 w-72 h-7 rounded-lg">
                    <div class="flex justify-center ml-3">
                        <span class="w-4 rounded-3xl border border-gray-400 text-center cursor-pointer" onClick='decreaseCount(event, this)'>-</span>
                        <input type="text" name="jml_barang_diminta" placeholder="0" class="w-12 text-center mx-2">
                        <span class="w-4 rounded-3xl border border-gray-400 text-center cursor-pointer" onClick='increaseCount(event, this)'>+</span>
                    </div>
                </div>
            <label for="keterangan" class="text-gray-400">Alasan Meminjam</label>
                <textarea name="keterangan" class="border border-gray-300 w-96 h-12 rounded-lg mb-10 resize-none"></textarea>
            <div class="flex gap-48">
                <a class="text-red-500 cursor-pointer" onclick="Open('modal')">Kembali</a>
                <button type="submit" class="w-24 h-8 text-center bg-blue-500 text-white rounded-2xl">Tambah</button>
            </div>
        </form>
    </div>
</div>
  <div class="ml-10 mt-9">
    <span class="text-2xl font-semibold mb-7">History Permintaan</span>
    <div class="flex gap-6 mt-12 ">
        <form action="/permintaan/cari" method="GET">
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
      <div class="flex gap-6 mt-10 ">
        <div class="flex flex-col relative">
            <a class="bg-white border border-gray-400 px-5 pt-3 pb-2 rounded-3xl cursor-pointer h-12" onclick="Open('pdf')">Print Report</a>
            <div id="pdf" style="display: none" class="bg-white border border-gray-400 rounded-2xl h-44 mt-2 w-60 absolute top-12 right-6 px-3 py-4">
                <h4 class="text-left text-gray-400 mb-4">Bulan</h4>
                <select name="" id="" class="border border-gray-300 mb-6 rounded-2xl pr-1 pl-2 py-2 w-52 cursor-pointer">
                    <option value="">January</option>
                    <option value="">Februari</option>
                    <option value="">Maret</option>
                    <option value="">April</option>
                    <option value="">Mei</option>
                    <option value="">Juni</option>
                    <option value="">July</option>
                    <option value="">Agustus</option>
                    <option value="">September</option>
                    <option value="">Oktober</option>
                    <option value="">November</option>
                    <option value="">Desember</option>
                </select>
                <button class="bg-blue-400 text-white w-24 h-7 rounded-xl absolute right-4 bottom-4">Print</button>
            </div>
         </div>
            <a class="bg-blue-500 text-white border border-gray-200 px-6 pt-3 rounded-3xl cursor-pointer" onclick="Open('modal')">Permintaan +</a>
      </div>
    </div>
    <table class="mt-7 text-center rounded-xl">
         <thead class="bg-blue-300">
            <th class="px-4 py-2 rounded-tl-lg">Nama Peminta</th>
            <th class="px-8">Barang Diminta</th>
            <th class="px-8">Tanggal Diminta</th>
            <th class="pl-8 pr-60 rounded-tr-lg">Alasan Permintaan</th>
            <th class="px"></th>
         </thead>
         @foreach( $permintaan as $p)
         <tbody class="bg-gray-200">
            <td class="py-2.5 rounded-bl-lg">{{ $p->nama_guru }}</td>
            <td>{{ $p->nama_barang }}</td>
            <td>{{ $p->tgl_pengadaan }}</td>
            <td></td>
            <td><a href="">...</a></td>
         </tbody>
         @endforeach
    </table>
  </div>
    
@endsection