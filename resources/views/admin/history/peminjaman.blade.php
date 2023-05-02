@extends('layout.admin.index')
@section('content')


<div id="modal" class="bg-black/50 z-10 w-full h-full absolute" style="display: none">
    <div class="w-1/3 h-9/12 pb-10 pt-4 bg-white absolute left-1/3 mt-8 rounded-xl">
        <form method="POST" action="/peminjaman" class="grid pl-10 gap-2">
            @csrf
            <h3 class="text-lg my-4 font-semibold">Peminjaman Barang</h3>
            <label for="ruangan" class="text-gray-400">Ruang peminjam</label>
                <input type="number" name="ruangan" class="border border-gray-300 w-96 h-7 rounded-lg p-4">
            <label for="nama_guru" class="text-gray-400">Nama Peminjam</label>
                <input type="text" name="nama_guru" class="border border-gray-300 w-96 h-7 rounded-lg p-4">
            <label for="nama_barang" class="text-gray-400">Barang apa yang dipinjam? (Jumlah - Barang)</label>
                <div class="flex">
                    <input type="text" name="nama_barang" class="border border-gray-300 w-72 h-7 rounded-lg p-4">
                    <div class="flex justify-center ml-3">
                        <span class="w-4 rounded-3xl border border-gray-400 text-center cursor-pointer" onClick='decreaseCount(event, this)'>-</span>
                        <input type="number" name="jml_barang_dipinjam" placeholder="0" class="w-12 text-center ml-4">
                        <span class="w-4 rounded-3xl border border-gray-400 text-center cursor-pointer" onClick='increaseCount(event, this)'>+</span>
                      </div>
                </div>
            <label for="keterangan" class="text-gray-400">Alasan Meminjam</label>
                <textarea name="keterangan" class="border border-gray-300 w-96 h-12 rounded-lg mb-10 resize-none px-2 py-1"></textarea>
            <div class="flex gap-56">
                <a class="text-red-500 cursor-pointer items-center" onclick="Open('modal')">&larr;Kembali</a>
                <button type="submit" class="w-24 h-8 p-1 text-center bg-blue-500 text-white rounded-2xl">Tambah</button>
            </div>
        </form>
    </div>
</div>

  <div class="ml-10 mt-9">
    <span class="text-2xl font-semibold mb-7">History Pinjaman</span>
    <div class="flex gap-6 mt-12 ">
        <form action="/peminjaman/cari" method="GET">
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
      <div class="flex gap-6 mt-10">
         <div class="flex flex-col relative">
            <a class="bg-white border border-gray-400 px-5 pt-3 pb-2 rounded-3xl cursor-pointer h-12" onclick="Open('pdf')">Print Report</a>
            <div id="pdf" style="display: none" class="bg-white border border-gray-400 rounded-2xl h-44 mt-2 w-60 absolute top-12 right-6 px-3 py-4">
                <form action="/print" method="post">
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
    <table class="mt-7 text-center">
         <thead class="bg-blue-300">
            <th class="px-3 py-2 rounded-tl-lg">Ruang</th>
            <th class="px-5">Nama Peminjam</th>
            <th class="px-8">Barang Dipinjam</th>
            <th class="px-6">Tanggal Pinjam</th>
            <th class="px-6">Tanggal Kembali</th>
            <th class="px-14">Status</th>
            <th class="px-8 rounded-tr-lg"></th>
         </thead>
         @foreach( $peminjaman as $p)
         <tbody class="bg-gray-200">
            <td class="py-3 rounded-bl-lg">{{ $p->ruangan }}</td>
            <td>{{ $p->nama_guru }}</td>
            <td>{{ $p->nama_barang }}</td>
            <td>{{ $p->tgl_peminjaman->toDateString() }}</td>
            <td>{{ $p->tgl_kembali }}</td>
            @if($p->status_peminjaman == 'kembali')
            <td class="px-8 py-3 w-48"><div class="py-1 bg-green-200 text-green-400 rounded-2xl">Kembali</div></td>
            <td class="px-8">
                <a onclick="Open('detail')" class="cursor-pointer">...</a>
                <div id="detail" class="bg-white absolute w-40 h-10 right-12 rounded-xl" style="display: none">
                    <div class="flex flex-col text-left">
                        <a href="" class="pt-2 pl-12">&#10068;Detail</a>
                    </div>
                </div>
            </td>
            @else
            <td class="px-8 py-3"><div class="px-4 py-1 bg-blue-200 text-blue-400 rounded-2xl">Dipinjamkan</div></td>
            <td class="px-8 pb-3">
                <a onclick="Open('statuspinjam')" class="cursor-pointer pb-2">...</a>
                <div id="statuspinjam" class="bg-white absolute w-40 h-16 right-12 rounded-xl" style="display: none">
                    <div class="flex flex-col">
                        <form method="post" action="/dikembalikan/{{ $p->id }}">
                        @csrf
                        <button class="text-green-300 pt-1 px-7 hover:bg-green-300 hover:text-white rounded-t-xl">Dikembalikan</button>
                        </form>
                        <hr>
                        <a href="detail/id" class="px-2 pt-1 text-sm hover:bg-gray-300 h-9 rounded-b-xl"><span class="text-xs pr-1">&#10068;</span>Detail</a>
                    </div>
                </div>
            </td>
            @endif
         </tbody>
         @endforeach
    </table>
    {{ $peminjaman->links() }}
  </div>
    
@endsection