<!DOCTYPE html>
<html>
<head>
	<title>Laporan Inventaris Ruangan SMK Wikrama Bogor</title>
    <style>
		.info {
			display: grid;
			gap: 1px;
            margin-left: 1px;
		}
        table {
            text-align: center;
			border-color: black;
        }
        th {
			padding: 1px 1.5rem;
			font-size: 12px;
			background-color: gray;
        }
        td {
            padding: 1rem 0.5rem;
        }

		li {
			list-style: none;
		}
    </style>
</head>
<body>
	<div>
		<img src="logo.png" style="width:7rem;height:7rem;position: absolute;top: 1rem;">
		<div style="margin-left: 7rem;">
			<h2 style="margin-bottom: 0;">SMK Wikrama Bogor</h2>
			<p style="width: 460px;">
				Jl. Raya Wangun, RT.01/RW.06, Sindangsari, Kec. Bogor Timur
				Telp/Fax.(0251)8242411 E-mail: <span style="color: rgb(81, 166, 240);">prohumasi@smkwikrama.net</span>
				Website: www.smkwikrama.net
			</p>
			
		</div>
	</div>
	<div style="height: 1.5rem;background-color: gray;text-align:center">Daftar Inventaris Ruangan</div>
	<div class="body-wrapper">
    <div class="info">
            <p>No Ruang : {{ $nama->ruangan }}</p>
            <p>Nama Ruangan : {{ $nama->nama_ruangan }}</p>
            <p>Nama Penanggung Jawab Rayon : {{ $nama->pj_rayon }}</p>
            <p>Nama Penanggung Jawab Ruangan : {{ $nama->pj_ruangan }}</p>
    </div>
	<table border-color="black" border="1">
		<thead>
			<tr>
				<th rowspan="2" style="width: 44px;padding: 1px 6px;">No</th>
				<th rowspan="2" style="width: 80px;padding: 1px 24px;">kode Barang</th>
				<th rowspan="2" style="width: 200px;padding: 1px 6px;">Nama Barang</th>
				<th rowspan="2" style="width: 10px;padding: 1px 6px;">Satuan</th>
				<th colspan="2">Kondisi</th>
				<th rowspan="2" scope="width: 500px;padding: 0 500px;">Total</th>
			</tr>
			<tr>
				<th>Baik</th>
				<th>Rusak</th>
			</tr>
		</thead>
		<tbody>
			@foreach($inventaris as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{ $p->kode_barang }}</td>
				<td>{{ $p->nama_barang }}</td>
				<td>{{ $p->satuan }}</td>
				<td>{{ $p->baik }}</td>
				@if ( $p->rusak == null)
				<td>0</td>
				@else
				<td>{{ $p->rusak }}</td>
				@endif
				<td>{{ $p->baik + $p->rusak }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	</div>
</body>
</html>
