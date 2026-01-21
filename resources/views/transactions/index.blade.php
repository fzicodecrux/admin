@extends('layouts.app')
@section('title','Transaksi Proyek')

@section('content')

<!-- ===== FORM TAMBAH TRANSAKSI ===== -->
<div class="card shadow-sm mb-4">
    <div class="card-header fw-bold">Tambah Transaksi</div>
    <div class="card-body">

        <form method="POST" action="{{ route('transactions.store') }}">
            @csrf

            <input type="hidden" name="project_id" value="{{ $project->id }}">

            <div class="row g-2">
                <div class="col-md-3">
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <select name="jenis" class="form-select" required>
                        
                        <option value="pemasukan">Pemasukan</option>
                        <option value="pengeluaran">Pengeluaran</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select name="kategori" class="form-select" required>
                        <option value="">Kategori</option>
                        <option value="Material">Material</option>
                        <option value="Upah Tukang">Upah Tukang</option>
                        <option value="Upah Kenek">Upah Kenek</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <input type="number" name="jumlah" class="form-control" placeholder="Jumlah (Rp)" required>
                </div>

                <div class="col-md-12">
                    <input type="text" name="keterangan" class="form-control" placeholder="Keterangan">
                </div>

                <div class="col-md-12">
                    <button class="btn btn-success w-100">Tambah Transaksi</button>
                </div>
            </div>
        </form>

    </div>
</div>

<!-- ===== TABEL TRANSAKSI ===== -->
<div class="card shadow-sm">
    <div class="card-header fw-bold">Data Transaksi</div>
    <div class="card-body table-responsive">

        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Jenis</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $t)
                <tr>
                    <td>{{ $t->tanggal }}</td>
                    <td>{{ ucfirst($t->jenis) }}</td>
                    <td>{{ $t->kategori }}</td>
                    <td>Rp {{ number_format($t->jumlah) }}</td>
                    <td>{{ $t->keterangan }}</td>
                    <td>
                        <a href="{{ route('transactions.edit',$t->id) }}"
                           class="btn btn-warning btn-sm">Edit</a>

                        <form method="POST"
                              action="{{ route('transactions.destroy',$t->id) }}"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus transaksi?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
