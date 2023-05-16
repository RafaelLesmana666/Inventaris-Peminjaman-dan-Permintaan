<!DOCTYPE html>
<html>
<head>
	<title>Laporan Peminjaman Inventaris SMK Wikrama Bogor</title>
    <style>
        table {
            text-align: center;
        }
        th {
            padding: 1rem;
            border-bottom: 1px solid grey;
			border-top: 1px solid grey;
        }
        td {
            padding: 1rem 0.5rem;
        }
    </style>
</head>
<body>
	<div style="display:flex;flex-direction: row;">
		<img src="logo.png" style="width:5rem;height:5rem;position: absolute;top: 1rem;">
		<div style="text-align;margin-left: 6rem;">
			<h2>Laporan Peminjaman Inventaris SMK Wikrama Bogor</h2>
			<h5>Jl. Raya Wangun, RT.01/RW.06, Sindangsari, Kec. Bogor Tim., Kota Bogor, Jawa Barat 16146</h5>
		</div>
	</div>
	<hr style="margin-bottom: 2.5rem;">
    <div class="my-4">
        <ul>
            <li>No Ruang : {{ $nama->ruangan }}</li>
            <li>Nama Ruangan : {{ $nama->nama_ruangan }}</li>
            <li>Nama Penanggung Jawab Rayon : {{ $nama->pj_rayon }}</li>
            <li>Nama Penanggung Jawab Ruangan : {{ $nama->pj_ruangan }}</li>
        </ul>
    </div>
	<table>
		<thead>
			<tr>
				<th>Ruangan</th>
				<th>Nama Barang</th>
				<th>Nama Barang</th>
				<th>Tanggal Peminjaman</th>
				<th>Tanggal Kembali</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			@foreach($filter as $p)
			<tr>
				<td>{{ $p->ruangan }}</td>
				<td>{{ $p->nama_peminjam }}</td>
				<td>{{ $p->nama_barang }}</td>
				<td>{{ $p->tgl_peminjaman->format('j-F-Y') }}</td>
				@if( $p->tgl_kembali != "")
				 <td>{{ $p->tgl_kembali->format('j-F-Y') }}</td> 
				@else 
				 <td>{{ $p->tgl_kembali }}</td>
				@endif
				<td>{{ $p->status_peminjaman }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>
