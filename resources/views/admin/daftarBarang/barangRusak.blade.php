@extends('layout.admin.index')
@section('content')

{{-- detail  --}}
@if ( $detail == null)

@else
<div id="detail" class="bg-black/50 z-10 w-full h-full absolute">
    <div class="w-1/3 h-9/12 pb-4 pt-4 bg-white absolute top-32 left-1/3 rounded-xl">
        <ul>
           <li class="my-1">
            <div class="flex flex-col h-40 ml-4 relative">
                <span class="absolute top-0 right-4 text-gray-400 text-xs">{{ $detail->tgl_masuk->format('j-F-Y') }}</span>
                <h3 class="font-semibold text-xl">Detail</h3>
                <span> Kategori : {{ $detail->kategori_peminjaman }} </span>
                <span> Ruangan : {{ $detail->ruangan }} </span>
                <span> Nama : {{ $detail->nama_guru }}</span>
                <span> Nama Barang : {{ $detail->nama_barang }}</span>
                <span> Tanggal Kembali : 
                    @if ( $detail->tgl_kembali == null)
                    @else
                        {{ $detail->tgl_kembali->format('j-F-Y') }}
                    @endif
                </span>
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
            </div>
           </li> 
        </ul>
        <div class="relative h-36"><a class="text-red-500 cursor-pointer absolute right-6 bottom-0" href="/servis?page={{ request()->page??1 }}">Kembali</a></div>
    </div>
</div>
@endif

{{-- main content  --}}
<div class="ml-10 mt-9">
    <span class="text-2xl font-semibold mb-7">Daftar Barang Rusak </span>
    <div class="flex gap-6 mt-12 ">
        <form action="/servis/cari" method="GET">
            <input type="text" name="search" class="border border-gray-400 rounded-3xl pl-6 pr-24 py-2" placeholder="Cari Nama barang">
        </form>
    </div>
    <div class="absolute top-12 right-8 items-end z-0">
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
                         <button id="logoutButton" style="display: none;" class="absolute top-12 bg-white border border-red-400 text-red-400 text-left rounded-lg w-32 h-8 pl-4 pt-1 z-10 cursor-pointer hover:bg-red-500 hover:text-white">Log out</button>
                     </form>
         </div>
    </div>
    <table class="mt-7 text-center rounded-xl">
         <thead class="bg-blue-300">
            <th class="px-4 rounded-tl-lg">Ruangan</th>
            <th class="px-4 py-2">Nama Lengkap</th>
            <th class="px-6">Nama Barang</th>
            <th class="px-6">Tanggal Masuk</th>
            @if( Auth::user()->role == 'admin')
                 <th class="px-6">Tanggal Keluar</th>
            @else
                <th class="px-6">Kategori</th>
            @endif
            <th class="px-6">Status</th>
            <th class="px-4 rounded-tr-lg"></th>
         </thead>
         @foreach( $servis as $p)
         <tbody class="bg-gray-200">
            <td>{{ $p->ruangan }}</td>
            <td class="px-4 py-2 w-40 overflow-hidden whitespace-nowrap text-ellipsis inline-block mt-2">{{ $p->nama_guru }}</td>
            <td>{{ $p->nama_barang }}</td>
            <td>{{ $p->tgl_masuk->format('j-F-Y'); }}</td>
            @if ( Auth::user()->role == 'admin')
                @if ( $p->tgl_kembali == null)
                    <td></td>
                @else
                <td>{{ $p->tgl_kembali->format('j-F-Y') }}</td>
                @endif
            @else
                <td>{{ $p->kategori_peminjaman}}</td>
            @endif
            @if ( Auth::user()->role == 'admin')
                @if ( $p->status_perbaikan == 'Request')
                    <td class="px-8 py-3 w-48"><div class="py-1 bg-amber-700 text-yellow-400 rounded-2xl text-xs">Request</div></td>
                @elseif ( $p->status_perbaikan == 'Sedang Diperbaiki')
                    <td class="px-8 py-3 w-48"><div class="py-1 bg-blue-200 text-blue-400 rounded-2xl text-xs">Sedang Diperbaiki</div></td>
                @elseif ( $p->status_perbaikan == 'Selesai Perbaikan')
                    <td class="px-8 py-3 w-48"><div class="py-1 bg-yellow-200 text-yellow-400 rounded-2xl text-xs">Selesai Diperbaiki</div></td>
                @else
                    <td class="px-8 py-3 w-48"><div class="py-1 bg-green-200 text-green-400 rounded-2xl text-xs">Dikembalikan</div></td>
                @endif
                    <td class="px-8">
                            <div class="group inline-block ">
                                <button class="outline-none focus:outline-none rounded-xl flex items-center min-w-32">
                                <span class="pr-1 flex-1">...</span>
                                </button>
                                <ul
                                class="bg-white border rounded-xl transform scale-0 group-hover:scale-100 absolute
                                transition duration-150 ease-in-out origin-top min-w-32 right-10 z-10"
                                >
                                <div class="rounded-xl px-12 py-1 cursor-pointer hover:bg-gray-300"><a href="/servis/detail/{{ $p->id }}?page={{ request()->page??1 }}">Detail</a></div>
                                </ul>
                            </div>
                    </td>
            @else
                @if ( $p->status_perbaikan == 'Request')
                    <td class="px-8 py-3 w-48"><div class="py-1 bg-amber-700 text-yellow-400 rounded-2xl text-xs">Request</div></td>
                    <td class="px-8">
                        <div class="group inline-block ">
                            <button class="outline-none focus:outline-none rounded-xl flex items-center min-w-32">
                            <span class="pr-1 flex-1">...</span>
                            </button>
                            <ul
                            class="bg-white border rounded-xl transform scale-0 group-hover:scale-100 absolute
                            transition duration-150 ease-in-out origin-top min-w-32 right-10 z-10"
                            >
                            <div class="rounded-t-xl px-12 py-1 cursor-pointer hover:bg-gray-300"><a href="/servis/detail/{{ $p->id }}?page={{ request()->page??1 }}">Detail</a></div>
                            <form action="/servis/{{ $p->id }}" method="POST">
                                @csrf
                                <input type="submit" name="kondisi" value="Sedang Diperbaiki" class="cursor-pointer border text-blue-300 pt-1 px-7 hover:bg-blue-300 rounded-b-xl hover:text-white">                                                                                                                                                                                                                                                   
                            </form>
                            </ul>
                        </div>
                    </td>
                @elseif ( $p->status_perbaikan == 'Sedang Diperbaiki')
                    <td class="px-8 py-3 w-48"><div class="py-1 bg-blue-200 text-blue-400 rounded-2xl text-xs">Sedang Diperbaiki</div></td>
                    <td class="px-8">
                        <div class="group inline-block ">
                            <button class="outline-none focus:outline-none rounded-xl flex items-center min-w-32">
                            <span class="pr-1 flex-1">...</span>
                            </button>
                            <ul
                            class="bg-white border rounded-xl transform scale-0 group-hover:scale-100 absolute
                            transition duration-150 ease-in-out origin-top min-w-32 right-10 z-10"
                            >
                            <div class="rounded-t-xl px-12 py-1 cursor-pointer hover:bg-gray-300"><a href="/servis/detail/{{ $p->id }}?page={{ request()->page??1 }}">Detail</a></div>
                            <form action="/servis/{{ $p->id }}" method="POST">
                                @csrf
                                <input type="submit" name="kondisi" value="Selesai Perbaikan" class="cursor-pointer border text-yellow-300 pt-1 px-7 hover:bg-yellow-300 rounded-b-xl hover:text-white">                                                                                                                                                                                                                                                   
                            </form>
                            </ul>
                        </div>
                    </td>
                @elseif ( $p->status_perbaikan == 'Selesai Perbaikan')
                    <td class="px-8 py-3 w-48"><div class="py-1 bg-yellow-200 text-yellow-400 rounded-2xl text-xs">Selesai Perbaikan</div></td>
                    <td class="px-8">
                        <div class="group inline-block ">
                            <button class="outline-none focus:outline-none rounded-xl flex items-center min-w-32">
                            <span class="pr-1 flex-1">...</span>
                            </button>
                            <ul
                            class="bg-white border rounded-xl transform scale-0 group-hover:scale-100 absolute
                            transition duration-150 ease-in-out origin-top min-w-32 right-10 z-10"
                            >
                            <div class="rounded-xl px-12 py-1 cursor-pointer hover:bg-gray-300"><a href="/servis/detail/{{ $p->id }}?page={{ request()->page??1 }}">Detail</a></div>
                            </ul>
                        </div>
                </td>
                @else
                    <td class="px-8 py-3 w-48"><div class="py-1 bg-green-200 text-green-400 rounded-2xl text-sm">Dikembalikan</div></td>
                    <td class="px-8">
                        <div class="group inline-block ">
                            <button class="outline-none focus:outline-none rounded-xl flex items-center min-w-32">
                            <span class="pr-1 flex-1">...</span>
                            </button>
                            <ul
                            class="bg-white border rounded-xl transform scale-0 group-hover:scale-100 absolute
                            transition duration-150 ease-in-out origin-top min-w-32 right-10 z-10"
                            >
                            <div class="rounded-xl px-12 py-1 cursor-pointer hover:bg-gray-300"><a href="/servis/detail/{{ $p->id }}?page={{ request()->page??1 }}">Detail</a></div>
                            </ul>
                        </div>
                </td>
                @endif
            @endif
         </tbody>
    @endforeach
    </table>
  </div>
@endsection