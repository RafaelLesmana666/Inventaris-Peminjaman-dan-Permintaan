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
			<h2>Laporan Permintaan Inventaris SMK Wikrama Bogor</h2>
			<h5>Jl. Raya Wangun, RT.01/RW.06, Sindangsari, Kec. Bogor Tim., Kota Bogor, Jawa Barat 16146</h5>
		</div>
	</div>
	<hr style="margin-bottom: 2.5rem;">
	<table>
		<thead>
			<tr>
				<th>Nama Peminta</th>
				<th style="width: 12rem">Nama Barang</th>
				<th>Jumlah Barang</th>
				<th>Tanggal Diminta</th>
				<th>Alasan</th>
			</tr>
		</thead>
		<tbody>
			@foreach($filter as $p)
			<tr>
				<td>{{ $p->nama_peminta }}</td>
				<td>{{ $p->nama_barang }}</td>
                <td>{{ $p->jml_barang_diminta }}</td>
				<td>{{ $p->tgl_permintaan->format('j-F-Y')}}</td>
				<td>{{ $p->alasan}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>