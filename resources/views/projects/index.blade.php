<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>@yield('title')</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<h2>Daftar Proyek</h2>
<form method="POST" action="/project/store">
@csrf
<input name="nama_proyek" placeholder="Nama Proyek">
<input name="lokasi" placeholder="Lokasi">
<input name="nilai_kontrak" placeholder="Nilai Kontrak">
<button>Simpan</button>
</form>


<ul>
@foreach($projects as $p)
<li>
<a href="/project/{{ $p->id }}">{{ $p->nama_proyek }}</a>
</li>
@endforeach
</ul>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
