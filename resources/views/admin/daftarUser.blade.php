@extends('layout.admin.index')
@section('content')
<div id="modal" class="bg-black/50 z-10 w-full h-full absolute" style="display: none">
    <div class="w-1/3 h-9/12 pb-10 pt-4 bg-white absolute left-1/3 mt-8 rounded-xl">
        <form method="POST" action="/tambahUser" class="grid pl-10 gap-2" autocomplete="off">
            @csrf
            <h3 class="text-lg my-1 font-semibold">Tambah User</h3>
            <label for="username" class="text-gray-400">Username</label>
                <input type="text" name="username" class="border border-gray-300 w-96 h-10 rounded-lg px-2 py-1">
            <label for="nip" class="text-gray-400">NIP</label>
                <input type="number" name="nip" class="border border-gray-300 w-96 h-10 rounded-lg px-2 py-1">
            <label for="email" class="text-gray-400">Alamat Email</label>
                <input type="email" name="email" class="border border-gray-300 w-96 h-10 rounded-lg px-2 py-1">
            <label for="password" class="text-gray-400">Password</label>
                <input type="password" name="password" class="border border-gray-300 w-96 h-10 rounded-lg px-2 py-1">
            <label for="role" class="text-gray-400">Role</label>
                <select name="role" class="border border-gray-300 w-96 h-10 rounded-lg cursor-pointer px-2 py-1">
                    <option class="hidden">Pilih Salah Satu</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            <div class="flex gap-56 mt-8">
                <a class="text-red-500 cursor-pointer" onclick="Open('modal')">Kembali</a>
                <button type="submit" class="w-24 h-8 text-center bg-blue-500 text-white rounded-2xl">Tambah</button>
            </div>
        </form>
    </div>
</div>
  <div class="ml-10 mt-9">
    <span class="text-2xl font-semibold mb-7">Daftar User</span>
    <div class="flex gap-6 mt-12 ">
        <form action="/inventaris/cari" method="GET">
            @csrf
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
    <table class="mt-7 rounded-xl">
         <thead class="bg-blue-300">
            <th class="px-4  py-2 rounded-tl-lg text-left">Username</th>
            <th class="px-8">NIP</th>
            <th class="px-8 text-left w-80">Alamat Email</th>
            <th class="px-8">Tanggal Dibuat</th>
            <th class="px-4">Role</th>
            <th class="px-4 rounded-tr-lg"></th>
         </thead>
         @foreach( $user as $p)
         <tbody class="bg-gray-200">
            <td class="px-4 py-2 w-72 overflow-hidden whitespace-nowrap text-ellipsis text-left inline-block">{{ $p->username }}</td>
            <td class="px-8 text-center">{{ $p->nip }}</td>
            <td class="px-8 w-80 overflow-hidden whitespace-nowrap text-ellipsis text-left inline-block">{{ $p->email }}</td>
            <td class="px-8 text-center">{{ $p->created_at->toDateString() }}</td>
            <td class="px-4 text-center">{{ $p->role }}</td>
            <td class="px-4"><a href="">...</a></td>
         </tbody>
         @endforeach
    </table>
    {{ $user->links() }}
  </div>
    
@endsection