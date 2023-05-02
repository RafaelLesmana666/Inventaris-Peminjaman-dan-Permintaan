<!DOCTYPE html>
<html>
<head>
	<title>Laporan Pengaduan Masyarakat Desa Cigombong</title>
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
		<img src="kab.png" style="width:4rem;height:4rem;position: absolute;top: 1rem;">
		<div style="text-align: center;">
			<h2>Laporan Pengaduan Masyarakat Desa Cigombong</h2>
			<p>Jl. Raya H.R. Edi Sukma km. 22 No. 12 Cigombong Bogor 16110</p>
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