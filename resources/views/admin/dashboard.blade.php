@extends('layout.admin.index')
@section('content')
    {{-- notif  --}}
            <div id="notif" class="bg-black/50 z-10 w-full h-full absolute left-0 top-0" style="display: none;" onclick="Open('notif')" >
                <div class="bg-white border border-gray-400 rounded-xl w-auto h-80 py-2 px-4 absolute top-24 right-60 gap-11" >
                    <h3 class="font-semibold mb-2">Notifikas</h3>
                    @foreach( $rusak as $r)
                    <div class="flex flex-col">
                        <p class="text-sm text-gray-400">{{ $r->tgl_kembali->format('j-F-Y') }}</p>
                        <p class="w-60"><span class="text-gray-400"> Ada laporan dari </span> Ruang {{ $r->ruangan }} - {{ $r->nama_guru }} </p>
                    </div>
                    <a href="/admin/detail" class="bg-blue-600 rounded-3xl py-1 px-3 text-white text-sm">Detail</a>
                    @endforeach
                </div>
           </div>

<div class="ml-10 mt-12 ">
    <div class="flex gap-8">
        <h3 class="text-3xl mr-96">Dashboard</h3>
        <a class="border border-gray-300 rounded-2xl w-32 h-9 pl-4 pr-4 mt-1.5 pt-1 cursor-pointer bg-white flex" onclick="Open('notif')">
           <i class='far fa-bell mt-1 mr-1'></i> Notifikasi 
           
        </a>

        <div class="group inline-block mt-[7px]">
            <button class="outline-none focus:outline-none border border-gray-300 px-3 py-1 bg-white rounded-xl flex items-center min-w-32">
              <span class="pr-1 flex-1">{{ $title }}</span>
              <span>
                <svg
                  class="fill-current h-4 w-4 transform group-hover:-rotate-180
                  transition duration-150 ease-in-out"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                >
                  <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                </svg>
              </span>
            </button>
            <ul
              class="bg-white border rounded-xl transform scale-0 group-hover:scale-100 absolute z-10
            transition duration-150 ease-in-out origin-top min-w-32"
            >
              @if ( $title == 'Hari ini')
                <li class="rounded-sm px-3 py-1 cursor-pointer hover:bg-gray-100 hidden"><a href="/admin">Hari ini</a></li>
                <li class="rounded-sm px-3 py-1 cursor-pointer hover:bg-gray-100"><a href="/filterMinggu">Minggu ini</a></li>
                <li class="rounded-sm px-3 py-1 cursor-pointer hover:bg-gray-100"><a href="/filterBulan">Bulan ini</a></li>
                <li class="rounded-sm px-3 py-1 cursor-pointer hover:bg-gray-100"><a href="/filterTahun">Tahun ini</a></li>
              @elseif ( $title == 'Minggu ini')
                <li class="rounded-sm px-3 py-1 cursor-pointer hover:bg-gray-100"><a href="/admin">Hari ini</a></li>
                <li class="rounded-sm px-3 py-1 cursor-pointer hover:bg-gray-100 hidden"><a href="/filterMinggu">Minggu ini</a></li>
                <li class="rounded-sm px-3 py-1 cursor-pointer hover:bg-gray-100"><a href="/filterBulan">Bulan ini</a></li>
                <li class="rounded-sm px-3 py-1 cursor-pointer hover:bg-gray-100"><a href="/filterTahun">Tahun ini</a></li>
               @elseif ( $title == 'Bulan ini')
               <li class="rounded-sm px-3 py-1 cursor-pointer hover:bg-gray-100"><a href="/admin">Hari ini</a></li>
               <li class="rounded-sm px-3 py-1 cursor-pointer hover:bg-gray-100"><a href="/filterMinggu">Minggu ini</a></li>
               <li class="rounded-sm px-3 py-1 cursor-pointer hover:bg-gray-100 hidden"><a href="/filterBulan">Bulan ini</a></li>
               <li class="rounded-sm px-3 py-1 cursor-pointer hover:bg-gray-100"><a href="/filterTahun">Tahun ini</a></li>
               @else
               <li class="rounded-sm px-3 py-1 cursor-pointer hover:bg-gray-100"><a href="/admin">Hari ini</a></li>
               <li class="rounded-sm px-3 py-1 cursor-pointer hover:bg-gray-100"><a href="/filterMinggu">Minggu ini</a></li>
               <li class="rounded-sm px-3 py-1 cursor-pointer hover:bg-gray-100"><a href="/filterBulan">Bulan ini</a></li>
               <li class="rounded-sm px-3 py-1 cursor-pointer hover:bg-gray-100 hidden"><a href="/filterTahun">Tahun ini</a></li>
               @endif
            </ul>
          </div>
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
            <div id="logoutButton" style="display: none;" class="bg-white text-red-400 text-left rounded-lg w-32 h-8 pl-4 pt-1 absolute right-20 top-24 cursor-pointer hover:bg-red-500 hover:text-white">
                
        </div>
    </div>
    <div class="mt-12 flex gap-10">
        <a href="" class="bg-gray-100 w-24 pt-8 pb-24 px-28 relative rounded-xl">
            <div class="items-center absolute left-3 top-3 flex">
                <div class="bg-blue-500 w-10 h-10 rounded-xl text-center"><i class='fa fa-share text-white mt-3'></i></div>
                <div class="ml-3">
                    <p class="w-24 text-xs text-gray-400">{{ $title }}</p>
                    <p class="text-sm">Dipinjamkan</p>
                </div>
            </div>
            <div class="mt-8 flex absolute top-6 right-14">
                <p class="text-3xl mt-3">{{ $total }}</p>
                <p class="text-base mt-5 ml-1">Barang</p>
            </div>
        </a>
        <a href="" class="bg-gray-100 w-24 pt-8 pb-24 px-28 relative rounded-xl">
            <div class="items-center absolute left-3 top-3 flex">
                <div class="bg-blue-500 w-10 h-10 rounded-xl text-center"><i class='far fa-hourglass text-white mt-3'></i></div>
                <div class="ml-3">
                    <p class="w-24 text-xs text-gray-400">{{ $title }}</p>
                    <p class="text-sm">Dalam Peminjaman</p>
                </div>
            </div>
            <div class="mt-8 flex absolute top-6 right-14">
                <p class="text-3xl mt-3">{{ $dipinjam }}</p>
                <p class="text-base mt-5 ml-1">Barang</p>
            </div>
        </a>
        <a href="" class="bg-gray-100 w-24 pt-8 pb-24 px-28 relative rounded-xl">
            <div class="items-center absolute left-3 top-3 flex">
                <div class="bg-blue-500 w-10 h-10 rounded-xl text-center rotate-180"><i class='fas fa-reply text-white -rotate-180 mt-3'></i></div>
                <div class="ml-3">
                    <p class="w-24 text-xs text-gray-400">{{ $title }}</p>
                    <p class="text-sm">Dikembalikan</p>
                </div>
            </div>
            <div class="mt-8 flex absolute top-6 right-14">
                <p class="text-3xl mt-3">{{ $kembali }}</p>
                <p class="text-base mt-5 ml-1">Barang</p>
            </div>
        </a>
        <a href="" class="bg-gray-100 w-24 pt-8 pb-24 px-28 relative rounded-xl">
            <div class="items-center absolute left-3 top-3 flex">
                <div class="bg-blue-500 w-10 h-10 rounded-xl text-center"><i class='fas fa-wrench text-white mt-3'></i></div>
                <div class="ml-3">
                    <p class="w-24 text-xs text-gray-400">Saat ini</p>
                    <p class="text-sm text-red-500">Barang Rusak</p>
                </div>
            </div>
            <div class="mt-8 flex absolute top-6 right-14">
                <p class="text-3xl mt-3">{{ $rusak->count() }}</p>
                <p class="text-base mt-5 ml-1">Barang</p>
            </div>
        </a>
    </div>
     <div class="flex gap-9 mt-8">
        <div class="h-72 w-9/12 rounded-xl pr-4 bg-gray-100">
            <h3 class="ml-8 mt-4 text-sm text-gray-500">{{ $title }}</h3>
            <h4 class="ml-8 ">Status Terbaru</h4>
            <table class="ml-6 mt-2">
                <thead class="text-left">
                    <th class="px-2 py-1 text-center">No</th>
                    <th class="px-8">Nama Peminjam</th>
                    <th class="px-8">Daftar Barang</th>
                    <th class="px-8">Status</th>
                </thead>
                @foreach( $peminjaman as $p)
                <tbody>
                    <td class="px-2 py-1 text-center">{{ $p->id }}</td>
                    <td class="px-8 py-1">{{ $p->nama_guru }}</td>
                    <td class="px-8 py-1">{{ $p->nama_barang}}</td>
                    @if ( $p->status_peminjaman == 'Dikembalikan')
                    <td class="px-8 pt-1"><div class="text-center my-1 py-1 px-4 bg-green-200 text-green-400 rounded-2xl text-xs">Dikembalikan</div></td>
                    @elseif ( $p->status_peminjaman == 'Masih Dipinjam')
                    <td class="px-8 pt-1"><div class="text-center my-1 px-4 mb-1 py-1 bg-blue-200 text-blue-400 rounded-2xl text-xs">Masih Dipinjam</div></td>
                    @else
                    <td class="px-8 pt-1"><div class="text-center my-1 py-1 bg-red-200 text-red-400 rounded-2xl text-xs">Barang Rusak</div></td>
                    @endif
                </tbody>
                @endforeach
            </table>
            {{ $peminjaman->links() }}
        </div>
        <div class="bg-blue-200 h-72 w-80 rounded-xl">
            <div class="ml-5 mt-3">
                <h3>Saat ini</h3>
                <h2>Kategori Pinjaman</h2>
            </div>
            <a class="bg-red-300 w-12 h-12 p-12" onload="chart()"></a>
        </div>
     </div>
</div>
    
@endsection