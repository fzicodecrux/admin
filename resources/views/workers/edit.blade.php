@extends('layouts.app')
@section('title','Edit Pekerja')

@section('content')

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header fw-bold" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            ✏️ Edit Pekerja
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('workers.update', $worker->id) }}" class="row g-3">
                @csrf

                <div class="col-md-4">
                    <label class="form-label">Pilih Proyek</label>
                    <select name="project_id" class="form-select" required>
                        <option value="">Pilih Proyek</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ $worker->project_id == $project->id ? 'selected' : '' }}>{{ $project->nama_proyek }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Nama Pekerja</label>
                    <input type="text" name="nama_pekerja" class="form-control" value="{{ $worker->nama_pekerja }}" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Tukang" {{ $worker->kategori == 'Tukang' ? 'selected' : '' }}>Tukang</option>
                        <option value="Kenek" {{ $worker->kategori == 'Kenek' ? 'selected' : '' }}>Kenek</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Upah Harian (Rp)</label>
                    <input type="number" name="upah_harian" class="form-control" value="{{ $worker->upah_harian ?? '' }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">No. Kontak</label>
                    <input type="text" name="kontak" class="form-control" value="{{ $worker->kontak ?? '' }}">
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-success">💾 Update Pekerja</button>
                    <a href="/" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
