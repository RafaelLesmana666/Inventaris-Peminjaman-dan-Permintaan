<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventaris Peminjaman</title>
    <link href="/css/config.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/33a3be2149.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white select-none overflow-hidden">
    <div class="bg-gray-100 h-screen w-64">
      <div class="flex flex-row items-center top-11 absolute left-6">
         <img src="/assets/logo.png" alt="logo" class="w-[65px] h-[48px] pr-3">
            <div class="text-left">
               <div class="text-md text-blue-400 font-semibold">Inventaris</div>
               <div class="text-xs text-gray-400">SMK Wikrama bogor</div>
             </div>
      </div>
      @if ( Auth::user()->role == 'admin')
        <nav class="flex flex-col absolute top-44 left-14 select-none">
            <a href="/admin" class="text-gray-400 hover:text-blue-400 mb-4"><i class="fa-solid fa-cubes mr-2"></i>Dashboard</a>
            <a href="/peminjaman" class="text-gray-400 hover:text-blue-400 mb-4"><i class="fa-regular fa-pen-to-square mr-2"></i>Peminjaman</a>
            <a href="/permintaan" class="text-gray-400 hover:text-sky-400 mb-4"><i class="fa-regular fa-envelope mr-2"></i>Permintaaan</a>
             <a href="/inventarisRuangan" class="text-gray-400 hover:text-sky-400 mb-4"><i class="fa-solid fa-list mr-2"></i>Inventaris Ruangan</a>
            <a class="text-gray-400 hover:text-blue-400 mb-4 cursor-pointer" onclick="Open('dropnavBarang')"><i class="fa-solid fa-book mr-2"></i>Daftar Barang</a>
             <div id="dropnavBarang" style="display: none">
                    <div class="flex flex-col mb-4 ml-6">
                        <a href="/inventaris" class="text-gray-400 hover:text-blue-400 mb-2">Inventaris</a>
                        <a href="/nonInventaris" class="text-gray-400 hover:text-blue-400 mb-2">Non Inventaris </a> 
                    </div>
                </div>
            <a href="/servis" class="text-gray-400 hover:text-blue-400 mb-4"><i class="fa-solid fa-gear mr-2"></i>Barang Rusak</a>
            <a href="/daftarUser" class="text-gray-400 hover:text-blue-400 mb-4"><i class="fa-regular fa-user mr-2"></i>Daftar User</a>
        </nav>
        @else
        <nav class="flex flex-col absolute top-44 left-14 select-none">
            <a href="/teknisi" class="text-gray-400 hover:text-blue-400 mb-4"><i class="fa-solid fa-cubes mr-2"></i>Dashboard</a>
            <a href="/servis" class="text-gray-400 hover:text-blue-400 mb-4"><i class="fa-solid fa-gear mr-2"></i>Barang Rusak</a>
        </nav>
        @endif
    </div>
@yield('content')
</body>
<script type="text/javascript" src="/js/index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</html>

