<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventoris Peminjaman</title>
    <link href="/css/config.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="bg-cyan-500 h-screen w-64">
      <div class="flex flex-row items-center top-11 absolute left-6">
         <img src="/assets/logo.png" alt="logo" class="w-[68px] h-[50px] pr-3">
            <div class="text-left">
               <div class="text-lg text-white font-semibold">Inventaris</div>
               <div class="text-xs text-white">SMK Wikrama bogor</div>
             </div>
      </div>
        <nav class="flex flex-col absolute top-56 left-16 select-none">
            <a href="/admin" class="text-white hover:text-violet-900 mb-4">Dashboard</a>
            <a id="drop" class="text-white hover:text-violet-900 cursor-pointer mb-4" onclick="Open('dropnavHistory')">History</a>
                <div id="dropnavHistory" style="display: none">
                    <div class="flex flex-col mb-4 ml-2">
                        <a href="/peminjaman" class="text-white hover:text-violet-900 mb-2">Peminjaman</a>
                        <a href="/permintaan" class="text-white hover:text-violet-900">Permintaaan</a>
                    </div>
                </div>
            <a class="text-white hover:text-violet-900 mb-4 cursor-pointer" onclick="Open('dropnavBarang')">Daftar Barang</a>
             <div id="dropnavBarang" style="display: none">
                    <div class="flex flex-col mb-4 ml-2">
                        <a href="/inventaris" class="text-white hover:text-violet-900 mb-2">Inventaris</a>
                        <a href="/nonInventaris" class="text-white hover:text-violet-900 mb-2">Non Inventaris </a>
                        <a href="/inventarisRuangan" class="text-white hover:text-violet-900">Inventaris Ruangan</a>
                    </div>
                </div>
            <a href="/daftarUser" class="text-white hover:text-violet-900 mb-4">Daftar User</a>
        </nav>
    </div>
@yield('content')
</body>
<script type="text/javascript" src="/js/index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>

