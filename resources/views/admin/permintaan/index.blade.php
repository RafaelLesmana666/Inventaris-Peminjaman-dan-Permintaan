@extends('layout.admin.index')
@section('content')
<div id="modal" class="bg-black/50 z-10 w-full h-full absolute" style="display: none">
    <div class="w-1/3 h-9/12 pb-10 pt-4 bg-white absolute left-1/3 mt-8 rounded-xl">
        <form method="POST" action="/permintaan" class="grid pl-10 gap-2" autocomplete="off">
            @csrf
            <h3 class="text-lg my-4 font-semibold">Permintaan Barang</h3>
            <label for="nama_peminta" class="text-gray-400">Nama</label>
                <input type="text" name="nama_peminta" class="border border-gray-300 w-96 h-7 rounded-lg p-2">
            <label for="nama_barang" class="text-gray-400">Barang apa yang diminta? (Jumlah - Barang)</label>
                <div class="flex">
                    <input type="text" name="nama_barang" class="border border-gray-300 w-72 h-7 rounded-lg p-2">
                    <div class="flex justify-center ml-3">
                        <span class="w-4 rounded-3xl border border-gray-400 text-center cursor-pointer" onClick='decreaseCount(event, this)'>-</span>
                        <input type="text" name="jml_barang_diminta" placeholder="0" class="w-12 text-center mx-2">
                        <span class="w-4 rounded-3xl border border-gray-400 text-center cursor-pointer" onClick='increaseCount(event, this)'>+</span>
                    </div>
                </div>
            <label for="alasan" class="text-gray-400">Alasan Meminta</label>
                <textarea name="alasan" class="border border-gray-300 w-96 h-24 rounded-lg mb-6 resize-none p-2"></textarea>
            <div class="flex gap-56">
                <a class="text-red-500 cursor-pointer" onclick="Open('modal')">Kembali</a>
                <button type="submit" class="w-24 h-8 text-center bg-blue-500 text-white rounded-2xl">Tambah</button>
            </div>
        </form>
    </div>
</div>
  <div class="ml-10 mt-9">
    <span class="text-2xl font-semibold mb-7">Permintaan Barang </span>
    @if( session('error'))
      
    {{ session('error') }}
   @endif

    <div class="flex gap-6 mt-12 ">
        <form action="/permintaan/cari" method="GET">
            <input type="text" name="search" class="border border-gray-400 rounded-l-3xl pl-6 pr-24 py-2 z-10" placeholder="Cari Nama">
            <button class="rounded-r-3xl border border-gray-400 py-2 px-2"><i class="text-gray-400 fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
    <div class="absolute top-6 right-8 items-end z-0">
        <div class="flex flex-col">
            <div class="flex flex-row cursor-pointer" onclick="Open('logoutButton')">
                 <img src="/assets/logo.png" alt="logo" class="w-16 h-12 pr-3">
                     <div class="text-left mt-1">
                         <div class="text-base text-gray-600 font-semibold">
                             {{ Auth::user()->username }}
                         </div>
                         <div class="text-xs text-gray-400">
                             {{ Auth::user()->role }}
                         </div>
                     </div> 
            </div>
                     <form action="/logout" method="post">
                         @csrf
                         <button id="logoutButton" style="display: none;" class="absolute bg-white border border-red-400 text-red-400 text-left rounded-lg w-32 h-8 pl-4 pt-1 z-10 cursor-pointer hover:bg-red-500 hover:text-white">Log out</button>
                     </form>
         </div>
      <div class="flex gap-6 mt-10 ">
        <div class="flex flex-col relative">
            <a class="bg-white border border-gray-400 px-5 pt-3 pb-2 rounded-3xl cursor-pointer h-12" onclick="Open('pdf')">Print Report</a>
            <div id="pdf" style="display: none" class="bg-white border border-gray-400 rounded-2xl h-44 mt-2 w-60 absolute top-12 right-6 px-3 py-4">
                <form action="/permintaan/print" method="post">
                 @csrf
                 <h4 class="text-left text-gray-400 mb-4">Bulan</h4>
                    <select name="bulan" id="pdf" class="border border-gray-300 mb-6 rounded-2xl pr-1 pl-2 py-2 w-52 cursor-pointer">
                        <option value="1">January</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">July</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                 <button class="bg-blue-400 text-white w-24 h-7 rounded-xl absolute right-4 bottom-4">Print</button>
            </form>
            </div>
         </div>
            <a class="bg-blue-500 text-white border border-gray-200 px-6 pt-3 rounded-3xl cursor-pointer" onclick="Open('modal')">Permintaan +</a>
      </div>
    </div>
    <table class="mt-7 text-center rounded-xl">
         <thead class="bg-blue-300">
            <th class="px-4 py-2 rounded-tl-lg">Nama Peminta</th>
            <th class="px-6">Barang Diminta</th>
            <th class="px-4">Jumlah Barang</th>
            <th class="px-6">Tanggal Diminta</th>
            <th class="pl-6 pr-44 rounded-tr-lg">Alasan Permintaan</th>
         </thead>
         @foreach( $permintaan as $p)
         <tbody class="bg-gray-200">
            <td class="px-4 py-2 w-40 overflow-hidden whitespace-nowrap text-ellipsis inline-block">{{ $p->nama_peminta }}</td>
            <td>{{ $p->nama_barang }}</td>
            <td>{{ $p->jml_barang_diminta }}</td>
            <td>{{ $p->tgl_permintaan->format('j-F-Y') }}</td>
            <td class="w-72 overflow-hidden whitespace-nowrap text-ellipsis text-left inline-block">{{ $p->alasan }}</td>
         </tbody>
         @endforeach
    </table>
  </div>
    
@endsection