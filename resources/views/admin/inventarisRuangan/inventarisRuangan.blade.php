@extends('layout.admin.index')
@section('content')
<div id="modal" class="bg-black/50 z-10 w-full h-full absolute" style="display: none">
    <div class="w-1/3 h-9/12 pb-10 pt-2 bg-white absolute left-1/3 mt-8 rounded-xl">
        <form method="POST" action="/inventarisRuangan" class="grid pl-10 gap-1.5" autocomplete="off">
            @csrf
            <h3 class="text-lg my-2 font-semibold">Tambah Ruangan & Barang</h3>
            <label for="ruangan" class="text-gray-400">Ruangan</label>
                <input type="text" name="ruangan" class="border border-gray-300 w-96 h-7 rounded-lg p-2">
            <label for="nama_ruangan" class="text-gray-400">Nama Ruangan</label>
                <input type="text" name="nama_ruangan" class="border border-gray-300 w-96 h-7 rounded-lg p-2">
            <label for="pj_rayon" class="text-gray-400">Penanggung Jawab Rayon</label>
                <input type="text" name="pj_rayon" class="border border-gray-300 w-96 h-7 rounded-lg p-2">
            <label for="pj_ruangan" class="text-gray-400">Penanggung Jawab Ruangan</label>
                <input type="text" name="pj_ruangan" class="border border-gray-300 w-96 h-7 rounded-lg p-2">  
            <label for="nama_barang" class="text-gray-400">Nama Barang</label>
                <input type="text" name="nama_barang" class="border border-gray-300 w-96 h-7 rounded-lg p-2"> 
                <label for="jml_barang" class="text-gray-400">Kondisi Barang</label>
                <input type="number" name="baik" placeholder="Jumlah Barang Baik" class="border border-gray-300 w-96 h-7 rounded-lg p-2">
                {{-- <input type="number" name="rusak" placeholder="Jumlah Barang Rusak" class="border border-gray-300 w-96 h-7 rounded-lg p-2"> --}}
            <div class="flex gap-56 mt-7">
                <a class="text-red-500 cursor-pointer" onclick="Open('modal')">Kembali</a>
                <button type="submit" class="w-24 h-8 text-center bg-blue-500 text-white rounded-2xl">Tambah</button>
            </div>
        </form>
    </div>
</div>
  <div class="ml-10 mt-9">
    <span class="text-2xl font-semibold mb-7">Inventaris Ruangan</span>
    <div class="flex gap-6 mt-12 ">
        <form action="/inventarisR/cari" method="GET">
            @csrf
            <input type="text" name="search" class="border border-gray-400 rounded-l-3xl pl-6 pr-24 py-2 z-10" placeholder="Cari Ruangan">
            <button class="rounded-r-3xl border border-gray-400 py-2 px-2"><i class="text-gray-400 fa-solid fa-magnifying-glass"></i></button>
        </form>
        @if( session('error'))
        {{ session('error')}}
        @endif
    </div>
    <div class="absolute top-5 right-8 items-end z-0">
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
      <div class="mt-14">
            <a class="bg-blue-500 text-white border border-gray-200 px-6 py-3 rounded-3xl cursor-pointer" onclick="Open('modal')">Tambah Barang +</a>
      </div>
    </div>
    <div class="w-fit overflow-y-scroll h-80">
        <table class="mt-7 text-center">
         <thead class="bg-blue-300">
            <th class="px-4 py-2 w-12 rounded-tl-lg">Ruangan</th>
            <th class="w-40 px-4 py-2">Nama Ruangan</th>
            <th class="w-60 px-2 py-2">Penanggung Jawab Rayon</th>
            <th class="w-72 px-2 py-2">Penanggung Jawab Ruangan</th>
            <th class="px-4 rounded-tr-lg"></th>
         </thead>
         @foreach( $inventarisRuangan as $p)
         <tbody class="bg-gray-200">
            <td class="py-2 px-4 w-12">{{ $p->ruangan }}</td>
            <td class="w-40 px-4 overflow-hidden whitespace-nowrap text-ellipsis">{{ $p->nama_ruangan }}</td>
            <td class="w-60 px-4 overflow-hidden whitespace-nowrap text-ellipsis">{{ $p->pj_rayon }}</td>
            <td class="w-96 px-8 overflow-hidden whitespace-nowrap text-ellipsis">{{ $p->pj_ruangan }}</td> 
            <td><a href="inventarisRuangan/detail/Ruangan={{ $p->ruangan }}">...</a></td>
         </tbody>
         @endforeach
    </table>
    </div>
    
  </div>
    
@endsection