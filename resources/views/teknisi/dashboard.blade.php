@extends('layout.admin.index')
@section('content')
    {{-- notif  --}}
            <div id="notif" class="bg-black/50 z-10 w-full h-full absolute left-0 top-0 cursor-pointer" style="display: none;" onclick="Open('notif')" >
                <div class="bg-white border border-gray-400 rounded-xl w-80 h-80 py-2 px-4 absolute top-24 right-96 overflow-y-scroll" >
                  <h3 class="font-semibold mb-2">Notifikasi</h3>
                   @foreach ( $request as $r)
                    <ul>
                        <li class="my-1">
                            <div class="flex flex-col relative h-40">
                                <span> Kategori : {{ $r->kategori_peminjaman }}</span>
                                <span> Ruangan : {{ $r->ruangan }} </span>
                                <span> Nama : {{ $r->nama_guru }}</span>
                                <span> Tanggal Rusak : {{ $r->tgl_masuk->format('j-F-Y') }}</span>
                                <span> Status : {{ $r->status_perbaikan }}</span>
                                <a class="px-4 py-1 rounded-3xl text-xs text-white bg-blue-300 absolute bottom-0 right-4" href="/teknisi/detail/{{ $r->id }}">Detail</a>
                            </div>
                        </li>
                    </ul>
                    @endforeach
                </div>
            </div>

    {{-- detail  --}}
    @if ( $detail == null)
    @else
    <div id="detail" class="bg-black/50 z-10 w-full h-full absolute">
        <div class="w-1/3 h-9/12 pb-4 pt-4 bg-white absolute top-12 left-1/3 rounded-xl">
            <ul>
                <li class="my-1">
                 <div class="flex flex-col ml-4 relative h-96">
                     <span class="absolute top-0 right-4 text-gray-400 text-xs">{{ $detail->tgl_masuk->format('j-F-Y') }}</span>
                     <h3 class="font-semibold text-xl">Detail</h3>
                     <span> Kategori : {{ $detail->kategori_peminjaman }} </span>
                     <span> Ruangan : {{ $detail->ruangan }} </span>
                     <span> Nama : {{ $detail->nama_guru }}</span>
                     <span> Nama Barang : {{ $detail->nama_barang }}</span>
                     <span> Jumlah : {{ $detail->jumlah }}</span>
                     <span> Kendala : {{ $detail->kendala }}</span>
                     <span> Foto :</span>
                     <div class="grid grid-cols-3 gap-2">
                         @if ( $detail->foto == null)
                         <div class="w-32 py-4 rounded-xl border border-gray-300 text-gray-400 text-center">+</div>
                         <div class="w-32 py-4 rounded-xl border border-gray-300 text-gray-400 text-center">+</div>
                         <div class="w-32 py-4 rounded-xl border border-gray-300 text-gray-400 text-center">+</div>
                         @else
                         <img src="{{ url('/foto/' . $detail->foto) }}" class="w-32 h-24 rounded-xl">
                         @endif
                     </div>
                     <div class="text-center absolute right-4 bottom-4">
                        <form action="/teknisi/detail/{{ $detail->id }}" method="POST">
                            @csrf
                            <button class="bg-blue-400 px-4 py-1 text-white rounded-3xl hover:bg-blue-800">Submit</button> 
                        </form>
                        <a href="/teknisi" class="text-red-400 hover:text-red-700">Kembali</a>
                     </div>
                  </div>
                </li>
            </ul>
        </div>
    </div>
    @endif

<div class="ml-10 mt-12 ">
    <div class="flex gap-8 ">
        <h3 class="text-3xl mr-96">Dashboard</h3>
        <a class="border border-gray-300 rounded-3xl w-32 h-9 pl-4 pr-4 mt-1.5 pt-1 cursor-pointer bg-white flex relative" onclick="Open('notif')">
            @if ( $i == null)

            @else
            <div class="bg-red-400 p-[6px] rounded-full absolute top-0 right-0 text-xs"></div>
            @endif
           <i class='far fa-bell mt-1 mr-1'></i> Notifikasi 
        </a>
        {{-- <div class="group inline-block mt-[7px]">
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
          </div> --}}
          <div class="relative">
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
                <button id="logoutButton" style="display: none;" class="bg-white border border-red-400 text-red-400 text-left rounded-lg w-32 h-8 pl-4 pt-1 absolute top-12 cursor-pointer hover:bg-red-500 hover:text-white">Log out</button>
            </form>
          </div>    
    </div>
    <div class="mt-12 flex gap-10">
        <a href="" class="bg-gray-100 w-24 pt-8 pb-24 px-28 relative rounded-xl">
            <div class="items-center absolute left-3 top-3 flex">
                <div class="bg-blue-500 w-10 h-10 rounded-xl text-center"><i class='fa fa-share text-white mt-3'></i></div>
                <div class="ml-3">
                    <p class="w-24 text-xs text-gray-400">{{ $title }}</p>
                    <p class="text-sm">Request Perbaikan</p>
                </div>
            </div>
            <div class="mt-8 flex absolute top-6 right-14">
                <p class="text-3xl mt-3">{{ $request->count() }}</p>
                <p class="text-base mt-5 ml-1">Barang</p>
            </div>
        </a>
        <a href="" class="bg-gray-100 w-24 pt-8 pb-24 px-28 relative rounded-xl">
            <div class="items-center absolute left-3 top-3 flex">
                <div class="bg-blue-500 w-10 h-10 rounded-xl text-center"><i class='far fa-hourglass text-white mt-3'></i></div>
                <div class="ml-3">
                    <p class="w-24 text-xs text-gray-400">{{ $title }}</p>
                    <p class="text-sm">Sedang Diperbaiki</p>
                </div>
            </div>
            <div class="mt-8 flex absolute top-6 right-14">
                <p class="text-3xl mt-3">{{ $sedangDiperbaiki }}</p>
                <p class="text-base mt-5 ml-1">Barang</p>
            </div>
        </a>
        <a href="" class="bg-gray-100 w-24 pt-8 pb-24 px-28 relative rounded-xl">
            <div class="items-center absolute left-3 top-3 flex">
                <div class="bg-blue-500 w-10 h-10 rounded-xl text-center rotate-180"><i class='fas fa-reply text-white -rotate-180 mt-3'></i></div>
                <div class="ml-3">
                    <p class="w-24 text-xs text-gray-400">{{ $title }}</p>
                    <p class="text-sm">Selesai Perbaikan</p>
                </div>
            </div>
            <div class="mt-8 flex absolute top-6 right-14">
                <p class="text-3xl mt-3">{{ $selesai }}</p>
                <p class="text-base mt-5 ml-1">Barang</p>
            </div>
        </a>
        <a href="" class="bg-gray-100 w-24 pt-8 pb-24 px-28 relative rounded-xl">
            <div class="items-center absolute left-3 top-3 flex">
                <div class="bg-blue-500 w-10 h-10 rounded-xl text-center"><i class='fas fa-wrench text-white mt-3'></i></div>
                <div class="ml-3">
                    <p class="w-24 text-xs text-gray-400">Saat ini</p>
                    <p class="text-sm text-green-500">Dikembalikan</p>
                </div>
            </div>
            <div class="mt-8 flex absolute top-6 right-14">
                <p class="text-3xl mt-3">{{ $dikembalikan }}</p>
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
                    <th class="px-8">Nama Lengkap</th>
                    <th class="px-8">Nama Barang</th>
                    <th class="px-8">Status</th>
                </thead>
                @foreach( $servis as $p)
                <tbody>
                    <td class="px-2 py-1 text-center">{{ $p->id }}</td>
                    <td class="px-8 py-1">{{ $p->nama_guru }}</td>
                    <td class="px-8 py-1">{{ $p->nama_barang}}</td>
                    @if ( $p->status_perbaikan == 'Request')
                        <td class="px-8 py-1 w-48"><div class="py-1 bg-amber-700 text-yellow-400 rounded-2xl text-xs text-center">Request</div></td>
                    @elseif ( $p->status_perbaikan == 'Sedang Diperbaiki')
                        <td class="px-8 py-1 w-48"><div class="py-1 bg-blue-200 text-blue-400 rounded-2xl text-xs text-center">Sedang Diperbaiki</div></td>
                    @elseif ( $p->status_perbaikan == 'Selesai Perbaikan')
                        <td class="px-8 py-1 w-48"><div class="py-1 bg-yellow-200 text-yellow-400 rounded-2xl text-xs text-center">Selesai Diperbaiki</div></td>
                    @else
                        <td class="px-8 py-1 w-48"><div class="py-1 bg-green-200 text-green-400 rounded-2xl text-xs text-center">Dikembalikan</div></td>
                    @endif
                </tbody>
                @endforeach
            </table>
            {{ $servis->links() }}
        </div>
        <div class="bg-blue-200 h-72 w-80 rounded-xl">
            <div class="ml-5 mt-3">
                <h3>Saat ini</h3>
                <h2>Kategori Pinjaman</h2>
            </div>
            {{-- <div class="w-12 h-2 p-2"> --}}
                {{-- <x-dashboard class="w-12 h-2"> --}}
                    <div:chart-tile chartFactory="{{App\Charts\recap::class}}" position="a1:a3" /> <div></div>
                {{-- </x-dashboard> --}}
            {{-- </div> --}}
            
        </div>
     </div>
</div>
    
@endsection