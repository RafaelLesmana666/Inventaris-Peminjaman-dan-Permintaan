@extends('layout.admin.index')
@section('content')

<div class="ml-10 mt-12 ">
    <div class="flex gap-10">
        <h3 class="text-3xl mr-96">Dashboard</h3>
        {{-- <form action="">
            <input type="text" class="border rounded-xl border-gray-300 w-80 pl-4 pt-1 pb-1 mt-1">
        </form> --}}
        <select name="" class="border rounded-xl border-gray-300 w-34 h-8 pl-3 pr-4 mt-1.5 cursor-pointer appearance-none">
            <option value="">Minggu</option>
            <option value="">Bulan</option>
            <option value="">Tahun</option>
        </select>
        <div class="border border-gray-300 rounded-xl w-28 h-9 pl-4 pr-4 mt-1.5 pt-1 cursor-pointer bg-white">
            Notifikasi
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
            <a onclick="Alert()" id="logoutButton" style="display: none;" class="bg-white text-red-400 text-left rounded-lg w-32 h-8 pl-4 pt-1 absolute right-20 top-24 cursor-pointer hover:bg-red-500 hover:text-white">
                Keluar
            </a>
    </div>
    <div class="mt-12 flex gap-10">
        <a href="" class="bg-white w-24 pt-8 pb-24 px-28 relative rounded-xl">
            <div class="items-center absolute left-3 top-3 flex">
                <div class="bg-blue-300 w-10 h-10 rounded-xl"></div>
                <div class="ml-3">
                    <p class="w-24 text-xs text-gray-400">Hari ini</p>
                    <p class="text-sm">Dipinjamkan</p>
                </div>
            </div>
            <div class="mt-8 flex absolute top-6 right-14">
                <p class="text-3xl mt-3">{{ $total }}</p>
                <p class="text-base mt-5 ml-1">Barang</p>
            </div>
        </a>
        <a href="" class="bg-white w-24 pt-8 pb-24 px-28 relative rounded-xl">
            <div class="items-center absolute left-3 top-3 flex">
                <div class="bg-blue-300 w-10 h-10 rounded-xl"></div>
                <div class="ml-3">
                    <p class="w-24 text-xs text-gray-400">Hari ini</p>
                    <p class="text-sm">Dalam Peminjaman</p>
                </div>
            </div>
            <div class="mt-8 flex absolute top-6 right-14">
                <p class="text-3xl mt-3">{{ $dipinjam }}</p>
                <p class="text-base mt-5 ml-1">Barang</p>
            </div>
        </a>
        <a href="" class="bg-white w-24 pt-8 pb-24 px-28 relative rounded-xl">
            <div class="items-center absolute left-3 top-3 flex">
                <div class="bg-blue-300 w-10 h-10 rounded-xl"></div>
                <div class="ml-3">
                    <p class="w-24 text-xs text-gray-400">Hari ini</p>
                    <p class="text-sm">Dikembalikan</p>
                </div>
            </div>
            <div class="mt-8 flex absolute top-6 right-14">
                <p class="text-3xl mt-3">{{ $kembali }}</p>
                <p class="text-base mt-5 ml-1">Barang</p>
            </div>
        </a>
        <a href="" class="bg-white w-24 pt-8 pb-24 px-28 relative rounded-xl">
            <div class="items-center absolute left-3 top-3 flex">
                <div class="bg-blue-300 w-10 h-10 rounded-xl"></div>
                <div class="ml-3">
                    <p class="w-24 text-xs text-gray-400">Saat ini</p>
                    <p class="text-sm text-red-500">Barang Rusak</p>
                </div>
            </div>
            <div class="mt-8 flex absolute top-6 right-14">
                <p class="text-3xl mt-3">00</p>
                <p class="text-base mt-5 ml-1">Barang</p>
            </div>
        </a>
    </div>
     <div class="flex gap-9 mt-8">
        <div class="h-72 w-9/12 rounded-xl pr-4 bg-white">
            <h3 class="ml-8 mt-4 text-sm text-gray-500">Saat Ini</h3>
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
                    <td class="px-8">{{ $p->nama_guru }}</td>
                    <td class="px-8">{{ $p->nama_barang}}</td>
                    @if($p->status_peminjaman == 'kembali')
                    <td class="px-8"><div class=" text-center mb-1 py-1 bg-green-200 text-green-400 rounded-2xl">Kembali</div></td>
                    @else
                    <td class="px-8"><div class="px-4 mb-1 py-1 bg-blue-200 text-blue-400 rounded-2xl">Dipinjamkan</div></td>
                    @endif
                </tbody>
                @endforeach
            </table>
            {{ $peminjaman->links() }}
        </div>
        <div class="bg-white h-72 w-80 rounded-xl"></div>
     </div>
</div>
    
@endsection