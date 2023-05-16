<div class="flex gap-6 mt-12 ">
    <form action="/permintaan/cari" method="GET">
        <input type="text" name="search" class="border border-gray-400 rounded-3xl pl-6 pr-24 py-2" placeholder="Cari di History">
    </form>
    <div class="flex flex-col relative">
        <a class="bg-white border border-gray-400 px-8 py-2 rounded-3xl cursor-pointer" onclick="Open('filter');">Filters</a>
        <div id="filter" style="display: none;" class="bg-white border border-gray-400 rounded-xl w-60 h-80 absolute top-14 right-12">
            <form action="" class="flex flex-col pt-4 pl-6 gap-2">
                <label for="" class="text-gray-400">Tanggal Diminta</label>
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
  <div class="flex gap-6 mt-10 ">
    <div class="flex flex-col relative">
        <a class="bg-white border border-gray-400 px-5 pt-3 pb-2 rounded-3xl cursor-pointer h-12" onclick="Open('pdf')">Print Report</a>
        <div id="pdf" style="display: none" class="bg-white border border-gray-400 rounded-2xl h-44 mt-2 w-60 absolute top-12 right-6 px-3 py-4">
            <form action="printPDF" method="post">
             @csrf
             <h4 class="text-left text-gray-400 mb-4">Bulan</h4>
                <select name="bulan" id="pdf" class="border border-gray-300 mb-6 rounded-2xl pr-1 pl-2 py-2 w-52 cursor-pointer">
                    <option value="1">January</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">July</option>
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
  </div>
</div>
<table class="mt-7 text-center rounded-xl">
     <thead class="bg-blue-300">
        <th class="px-4 py-2 rounded-tl-lg">Nama Lengkap</th>
        <th class="px-6">Nama Barang</th>
        <th class="px-4">Jumlah Barang</th>
        <th class="px-6">Kendala</th>
        <th class="px-6 rounded-tr-lg"></th>
     </thead>
     @foreach( $rusak as $p)
     <tbody class="bg-gray-200">
        <td class="px-4 py-2 w-40 overflow-hidden whitespace-nowrap text-ellipsis inline-block">{{ $p->nama_ }}</td>
        <td>{{ $p->nama_barang }}</td>
        <td>{{ $p->jml_barang_diminta }}</td>
        <td>{{ $p->tgl_permintaan->format('j-F-Y') }}</td>
        <td class="w-72 overflow-hidden whitespace-nowrap text-ellipsis text-left inline-block">{{ $p->alasan }}</td>
     </tbody>
     @endforeach
</table>
</div>

@endsection