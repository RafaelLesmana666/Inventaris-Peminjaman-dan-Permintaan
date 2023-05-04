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
		<img src="logo.png" style="width:8rem;height:8rem;position: absolute;">
		<div style="text-align: center;">
			<h2>Laporan Peminjaman Inventaris SMK Wikrama Bogor</h2>
			<h5>Jl. Raya Wangun, RT.01/RW.06, Sindangsari, Kec. Bogor Tim., Kota Bogor, Jawa Barat 16146</h5>
		</div>
	</div>
	<hr style="margin-bottom: 2.5rem;">
	<table>
		<thead>
			<tr>
				<th>Ruangan</th>
				<th>Nama Peminjam</th>
				<th>Nama Barang</th>
				<th>Tanggal Peminjaman</th>
				<th>Tanggal Kembali</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			@foreach($bulan as $p)
			<tr>
				<td>{{ $p->ruangan }}</td>
				<td>{{ $p->nama_guru }}</td>
				<td>{{ $p->nama_barang }}</td>
				<td>{{ $p->tgl_peminjaman->toDateString() }}</td>
				<td>{{ $p->tgl_kembali }}</td>
				<td>{{ $p->status_peminjaman }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>