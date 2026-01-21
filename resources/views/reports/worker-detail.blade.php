@extends('layouts.app')
@section('title','Laporan Detail Karyawan')

@section('content')

<style>
    .header-worker {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 25px;
        border-radius: 12px;
        margin-bottom: 25px;
    }
    .worker-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 10px;
    }
    .worker-meta {
        font-size: 14px;
        opacity: 0.9;
    }
    .summary-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        margin-top: 15px;
    }
    .summary-item {
        background: rgba(255,255,255,0.1);
        padding: 15px;
        border-radius: 8px;
        text-align: center;
    }
    .summary-value {
        font-size: 20px;
        font-weight: 700;
    }
    .summary-label {
        font-size: 12px;
        margin-top: 8px;
        opacity: 0.9;
    }
    .section-title {
        font-size: 18px;
        font-weight: 600;
        margin-top: 30px;
        margin-bottom: 15px;
        color: #333;
        border-bottom: 2px solid #667eea;
        padding-bottom: 10px;
    }
    .info-box {
        background: #f9f9f9;
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 15px;
    }
    .info-box p {
        margin: 8px 0;
    }
    .info-label {
        font-weight: 600;
        color: #667eea;
    }
</style>

<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('reports.index') }}" class="btn btn-secondary">← Kembali ke Laporan</a>
        <a href="{{ route('reports.worker-pdf', $worker->id) }}" class="btn btn-danger" target="_blank">
            📥 Cetak PDF
        </a>
    </div>

    <!-- Worker Header -->
    <div class="header-worker">
        <div class="worker-title">{{ $worker->nama_pekerja }}</div>
        <div class="worker-meta">
            👷 {{ $worker->kategori }} | 
            📋 {{ $worker->project->nama_proyek }}
        </div>

        <div class="summary-grid">
            <div class="summary-item">
                <div class="summary-value">Rp {{ number_format($totalEarnings) }}</div>
                <div class="summary-label">Total Upah</div>
            </div>
            <div class="summary-item">
                <div class="summary-value">Rp {{ number_format($upahTukang) }}</div>
                <div class="summary-label">Upah Tukang</div>
            </div>
            <div class="summary-item">
                <div class="summary-value">Rp {{ number_format($upahKenek) }}</div>
                <div class="summary-label">Upah Kenek</div>
            </div>
            <div class="summary-item">
                <div class="summary-value">{{ $transactions->count() }}</div>
                <div class="summary-label">Total Transaksi</div>
            </div>
        </div>
    </div>

    <!-- Worker Info -->
    <div class="card shadow-sm mb-4">
        <div class="card-header fw-bold" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            ℹ️ Informasi Karyawan
        </div>
        <div class="card-body">
            <div class="info-box">
                <p><span class="info-label">Nama:</span> {{ $worker->nama_pekerja }}</p>
                <p><span class="info-label">Kategori:</span> {{ $worker->kategori }}</p>
                <p><span class="info-label">Upah Harian:</span> {{ $worker->upah_harian ? 'Rp ' . number_format($worker->upah_harian) : 'Tidak tersedia' }}</p>
                <p><span class="info-label">Kontak:</span> {{ $worker->kontak ?? 'Tidak tersedia' }}</p>
                <p><span class="info-label">Proyek:</span> {{ $worker->project->nama_proyek }}</p>
                <p><span class="info-label">Bergabung:</span> {{ \Carbon\Carbon::parse($worker->created_at)->format('d F Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Transactions Section -->
    <div class="card shadow-sm">
        <div class="card-header fw-bold" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            💳 Riwayat Transaksi ({{ $transactions->count() }})
        </div>
        <div class="card-body">
            @if($transactions->isEmpty())
                <div class="alert alert-info">Belum ada transaksi untuk karyawan ini</div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Proyek</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions->sortByDesc('tanggal') as $t)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d/m/Y') }}</td>
                                <td><strong>{{ $t->project->nama_proyek }}</strong></td>
                                <td>
                                    <span class="badge" 
                                        @if($t->kategori == 'Upah Tukang') style="background: #f093fb;"
                                        @elseif($t->kategori == 'Upah Kenek') style="background: #4facfe;"
                                        @elseif($t->kategori == 'Material') style="background: #ffa500;"
                                        @endif>
                                        {{ $t->kategori }}
                                    </span>
                                </td>
                                <td><strong>Rp {{ number_format($t->jumlah) }}</strong></td>
                                <td>{{ $t->keterangan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="3">TOTAL</th>
                                <th>Rp {{ number_format($totalEarnings) }}</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
