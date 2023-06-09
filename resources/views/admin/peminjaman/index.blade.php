@extends('layout.admin.index')
@section('content')

{{-- modal permintaan  --}}
<div id="modal" class="bg-black/50 z-10 w-full h-full absolute" style="display: none">
    <div class="w-1/3 h-9/12 pb-10 pt-4 bg-white absolute left-1/3 mt-8 rounded-xl">
        <form method="POST" action="/peminjaman" class="grid pl-10 gap-2" autocomplete="off">
            @csrf
            <h3 class="text-lg my-4 font-semibold">Peminjaman Barang</h3>
            <label for="ruangan" class="text-gray-400">Ruang Peminjam</label>
                <input type="text" name="ruangan" class="border border-gray-300 w-96 h-7 rounded-lg p-2">
            <label for="nama_peminjam" class="text-gray-400">Nama Peminjam</label>
                <input type="text" name="nama_peminjam" class="border border-gray-300 w-96 h-7 rounded-lg p-2">
            <label for="nama_barang" class="text-gray-400">Barang apa yang dipinjam? (Jumlah - Barang)</label>
                <div class="flex">
                    <input type="text" name="nama_barang" class="border border-gray-300 w-72 h-7 rounded-lg px-2 py-3">
                    <div class="flex justify-center ml-3">
                        <span class="w-4 rounded-3xl border border-gray-400 text-center cursor-pointer" onClick='decreaseCount(event, this)'>-</span>
                        <input type="number" name="jml_barang_dipinjam" placeholder="0" class="w-12 text-center ml-4">
                        <span class="w-4 rounded-3xl border border-gray-400 text-center cursor-pointer" onClick='increaseCount(event, this)'>+</span>
                      </div>
                </div>
            <div class="flex gap-56 mt-12">
                <a class="text-red-500 cursor-pointer items-center" onclick="Open('modal')">Kembali</a>
                <button type="submit" class="w-24 h-8 p-1 text-center bg-blue-500 text-white rounded-2xl">Tambah</button>
            </div>
        </form>
    </div>
</div>
{{-- modal detail  --}}
@if ( $detail == null )
@else
<div id="detail" class="bg-black/50 z-10 w-full h-full absolute">
  <div class="w-1/3 h-9/12 pb-4 pt-4 bg-white absolute top-1/4 left-1/3 rounded-xl">
    <table class="ml-5">
      <h3 class="font-semibold ml-5 my-3 text-xl">Detail Peminjaman</h3>
        <tr>
          <td class="pr-7 y-2 text-gray-400">Ruang Peminjaman</td>
          <td class="pr-4">:</td>
          <td>{{ $detail->ruangan }}</td>
        </tr>
        <tr>
          <td class="text-gray-400">Durasi Peminjaman</td>
          <td>:</td>
          @if ( $detail->tgl_kembali != null)
           <td>{{ $detail->tgl_peminjaman->format('j-F-Y') }} - {{ $detail->tgl_kembali->format('j-F-Y')}}</td>
          @else
           <td>{{ $detail->tgl_peminjaman->format('j-F-Y') }} - </td>
          @endif
        </tr>
        <tr>
          <td class="text-gray-400">Barang dipinjam</td>
          <td>:</td>
          <td>{{ $detail->nama_barang }}</td>
        </tr>
    </table>
    <div class="relative w-full h-12"> <a class="text-red-500 cursor-pointer absolute right-6 bottom-0" href="/peminjaman?page={{ request()->page??1 }}">Kembali</a></div>
  </div>
  </div>
</div>
@endif

{{-- modal report perbaikan  --}}
@if($idR != null)
<div id="report" class="bg-black/50 z-10 w-full h-full absolute">
  <div class="w-1/3 h-9/12 pb-4 pt-4 bg-white absolute top-24 left-1/3 rounded-xl">
    <form action="/peminjaman/report/{{ $idR->id }}" class="grid pl-8 gap-2" method="POST" autocomplete="off" enctype="multipart/form-data">
      @csrf
      <h3 class="text-lg mt-4 mb-1 font-semibold">Report Barang Rusak</h3>
      <label for="kendala" class="text-gray-400">Kendala</label>
                <textarea name="kendala" class="border border-gray-300 w-96 h-24 rounded-lg mb-1 resize-none px-2 py-1"></textarea>
      <label for="foto" class="text-gray-400">Foto</label>
          <input type="file" name="foto" class="border border-gray-300 w-96 h-12 rounded-lg p-2">
          <div class="flex gap-56 mt-10 mb-2">
            <a class="text-red-500 cursor-pointer absolute right-6 bottom-5" href="/peminjaman?page={{ request()->page??1 }}">Kembali</a>
            <button type="submit" class="w-24 h-8 p-1 text-center bg-blue-500 text-white rounded-2xl">Report</button>
        </div>
    </form>
  </div>
</div>
@else
@endif

{{-- main kontent --}}
  <div class="ml-10 mt-9">
    <span class="text-2xl font-semibold mb-7">Peminjaman Barang</span>
    <div class="flex gap-6 mt-12 ">
        <form action="/peminjaman/cari" method="GET">
            <input type="text" name="search" class="border border-gray-400 rounded-l-3xl pl-6 pr-24 py-2 z-10" placeholder="Cari Nama Peminjam">
            <button class="rounded-r-3xl border border-gray-400 py-2 px-2"><i class="text-gray-400 fa-solid fa-magnifying-glass"></i></button>
        </form>
        @if( session('error'))
          {{ session('error')}}
        @endif
        <div class="flex flex-col relative">
            <a class="bg-white border border-gray-400 px-8 py-2 rounded-3xl cursor-pointer" onclick="Open('filter');">Filter</a>
            <div id="filter" style="display: none;" class="bg-white border border-gray-400 rounded-xl w-60 h-[350px] absolute top-14 right-12">
                <form action="/peminjaman/filter" method="GET" class="pt-4 pl-4">
                    <label for="" class="text-gray-400">Tanggal Dipinjam</label>
                        <input type="date" name="tgl_peminjaman" class="rounded-2xl border border-gray-300 w-48 h-8 p-2 my-2">
                    <label for="" class="text-gray-400">Tanggal Dikembalikan</label>
                        <input type="date" name="tgl_kembali" class="rounded-2xl border border-gray-300 w-48 h-8 p-2 my-2">
                    <label for="" class="text-gray-400">Status</label>
                    <div class="border border-gray-300 rounded-xl pl-2 py-2 w-52"> 
                        <label>Masih Dipinjam<input type="checkbox" name="status_peminjaman" class="ml-10 mt-1" value="Masih Dipinjam"></label>
                        <label>Barang Rusak<input type="checkbox" name="status_peminjaman" class="ml-[50px] mt-1" value="Barang Rusak"></label>
                        <label>Dikembalikan<input type="checkbox" name="status_peminjaman" class="ml-[52px] mt-1" value="Dikembalikan"></label>
                    </div>   
                    <button class="px-2 py-1 bg-blue-500 text-white text-sm rounded-xl mt-4">Submit</button>
                </form>
            </div>
        </div>
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
      
   
      <div class="flex gap-6 mt-10">
         <div class="flex flex-col relative">
            <a class="bg-white border border-gray-400 px-5 pt-3 pb-2 rounded-3xl cursor-pointer h-12" onclick="Open('pdf')">Print Report</a>
            <div id="pdf" style="display: none" class="bg-white border border-gray-400 rounded-2xl h-44 mt-2 w-60 absolute top-12 right-6 px-3 py-4">
                <form action="/peminjaman/print" method="post">
                    @csrf
                    <h4 class="text-left text-gray-400 mb-4">Bulan</h4>
                        <select name="bulan" id="" class="border border-gray-300 mb-6 rounded-2xl pr-1 pl-2 py-2 w-52 cursor-pointer">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
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
            <a class="bg-blue-500 text-white border border-gray-200 px-6 pt-3 pb-2 rounded-3xl cursor-pointer h-12" onclick="Open('modal')">Peminjaman +</a>
      </div>
    </div>
    <table class="mt-7 mb-3 text-center">
         <thead class="bg-blue-300">
            <th class="px-3 py-2 rounded-tl-lg">Ruang</th>
            <th class="pl-4">Nama Peminjam</th>
            <th class="px-8">Barang Dipinjam</th>
            <th class="px-6">Tanggal Pinjam</th>
            <th class="px-6">Tanggal Kembali</th>
            <th class="px-14">Status</th>
            <th class="px-8 rounded-tr-lg"></th>
         </thead>
         @foreach( $peminjaman as $p)
         <tbody class="bg-gray-200">
            <td class="py-3">{{ $p->ruangan }}</td>
            <td class="pt-4 w-32 overflow-hidden whitespace-nowrap text-ellipsis inline-block">{{ $p->nama_peminjam }}</td>
            <td>{{ $p->nama_barang }}</td>
            <td>{{ $p->tgl_peminjaman->format('j-F-Y') }}</td>
            @if($p->tgl_kembali == "")
              <td>{{ $p->tgl_kembali }}</td> 
            @else
               <td>{{ $p->tgl_kembali->format('j-F-Y') }}</td>
            @endif
            @if( $p->status_peminjaman == 'Dikembalikan' )
            <td class="px-8 py-3 w-48"><div class="py-1 bg-green-200 text-green-400 rounded-2xl text-sm">Dikembalikan</div></td>
            <td class="px-8 relative">
                <div class="group inline-block ">
                    <button class="outline-none focus:outline-none rounded-xl flex items-center min-w-32">
                      <span class="pr-1 flex-1">...</span>
                    </button>
                    <ul
                      class="bg-white border rounded-xl transform scale-0 group-hover:scale-100 absolute
                    transition duration-150 ease-in-out origin-top min-w-32 right-10 z-10"
                    >
                      <div class="rounded-xl px-12 py-1 cursor-pointer hover:bg-gray-300"><a href="/peminjaman/detail/{{ $p->id }}?page={{ request()->page??1 }}">Detail</a></div>
                    </ul>
                  </div>
            </td>
            @elseif ( $p->status_peminjaman == 'Masih Dipinjam')
            <td class="px-8 py-3"><div class="text-xs px-4 py-1 bg-blue-200 text-blue-400 rounded-2xl">Masih Dipinjam</div></td>
            <td class="px-8 pb-3 ">
                <div class="group inline-block mt-[7px]">
                    <button class="outline-none focus:outline-none rounded-xl flex items-center min-w-32">
                      <span class="pr-1 flex-1">...</span>
                    </button>
                    <div
                      class="bg-white border rounded-xl transform scale-0 group-hover:scale-100 absolute
                    transition duration-150 ease-in-out origin-top min-w-32 right-12 z-10"
                    >
                      <div class="rounded-sm px-3 py-1 cursor-pointer border-b-0 hover:bg-gray-300 rounded-t-xl"><a href="/peminjaman/detail/{{ $p->id }}?page={{ request()->page??1 }}">Detail</a></div>
                      <form method="post" action="/peminjaman/dikembalikan/{{ $p->id }}" class="flex flex-col">
                        @csrf
                        <input type="submit" name="kondisi"  value="Dikembalikan" class="cursor-pointer border text-green-300 pt-1 px-7 hover:bg-green-300 hover:text-white">
                      </form>
                      <a href="peminjaman/report/{{ $p->id }}" class=" w-80 cursor-pointer border-y-0 text-red-300 hover:bg-red-300 hover:text-white hover:pt-1 hover:px-7 rounded-b-xl">Barang Rusak</a>
                    </div>
                  </div>
            </td>
            @elseif( $p->status_peminjaman == 'Barang Rusak')
            <td class="px-8 py-3 w-48"><div class="py-1 bg-red-200 text-red-400 rounded-2xl text-xs">Barang Rusak</div></td>
            <td class="px-8 relative">
                <div class="group inline-block ">
                    <button class="outline-none focus:outline-none rounded-xl flex items-center min-w-32">
                      <span class="pr-1 flex-1">...</span>
                    </button>
                    <ul
                      class="bg-white border rounded-xl transform scale-0 group-hover:scale-100 absolute
                    transition duration-150 ease-in-out origin-top min-w-32 right-10 z-10"
                    >
                      <div class="rounded-xl px-12 py-1 cursor-pointer hover:bg-gray-300"><a href="/peminjaman/detail/{{ $p->id }}">Detail</a></div>
                    </ul>
                  </div>
            </td>
            @else
            <td class="px-8 py-3 w-48"><div class="py-1 bg-red-200 text-red-400 rounded-2xl text-xs">D</div></td>
            <td class="px-8">
                <div class="group inline-block ">
                    <button class="outline-none focus:outline-none rounded-xl flex items-center min-w-32">
                      <span class="pr-1 flex-1">...</span>
                    </button>
                    <ul
                      class="bg-white border rounded-xl transform scale-0 group-hover:scale-100 absolute
                    transition duration-150 ease-in-out origin-top min-w-32 right-10 z-10"
                    >
                      <div class="rounded-xl px-12 py-1 cursor-pointer hover:bg-gray-300"><a href="/peminjaman/detail/{{ $p->id }}">Detail</a></div>
                    </ul>
                  </div>
            </td>
            @endif 
         </tbody>
         @endforeach
    </table>
    {{ $peminjaman->links() }}
  </div>
@endsection