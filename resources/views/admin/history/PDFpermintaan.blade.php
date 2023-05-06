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
				<th>Nama Guru</th>
				<th>Nama Barang</th>
				<th>Jumlah Barang</th>
				<th>Tanggal Diminta</th>
				<th>Alasan</th>
			</tr>
		</thead>
		<tbody>
			@foreach($filter as $p)
			<tr>
				<td>{{ $p->nama_guru }}</td>
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