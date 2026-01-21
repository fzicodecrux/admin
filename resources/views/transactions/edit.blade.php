@extends('layouts.app')
@section('title','Edit Transaksi')

@section('content')

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header fw-bold" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            ✏️ Edit Transaksi
        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('transactions.update',$transaction->id) }}" class="row g-3">
                @csrf
                @method('PUT')

                <input type="hidden" name="project_id" value="{{ $transaction->project_id }}">

                <div class="col-md-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal"
                           value="{{ $transaction->tanggal }}"
                           class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Kategori</label>
                    <select name="jenis" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Upah Tukang"
                            {{ $transaction->kategori=='Upah Tukang'?'selected':'' }}>
                            Upah Tukang
                        </option>
                        <option value="Upah Kenek"
                            {{ $transaction->kategori=='Upah Kenek'?'selected':'' }}>
                            Upah Kenek
                        </option>
                        <option value="Material"
                            {{ $transaction->kategori=='Material'?'selected':'' }}>
                            Material
                        </option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Jumlah (Rp)</label>
                    <input type="number" name="jumlah"
                           value="{{ $transaction->jumlah }}"
                           class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Nama Pekerja</label>
                    <select name="nama_pekerja" class="form-select">
                        <option value="">Pilih Pekerja</option>
                        @foreach($transaction->project->workers as $worker)
                            <option value="{{ $worker->nama_pekerja }}"
                                {{ $transaction->nama_pekerja == $worker->nama_pekerja ? 'selected' : '' }}>
                                {{ $worker->nama_pekerja }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label">Keterangan</label>
                    <input type="text" name="keterangan"
                           value="{{ $transaction->keterangan }}"
                           class="form-control">
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-success">💾 Update Transaksi</button>
                    <a href="/" class="btn btn-secondary">Kembali</a>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection
