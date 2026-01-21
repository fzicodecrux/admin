@extends('layouts.app')
@section('title','Laporan Detail Proyek')

@section('content')

<style>
    .header-project {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 25px;
        border-radius: 12px;
        margin-bottom: 25px;
    }
    .project-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 10px;
    }
    .project-meta {
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
    .worker-badge {
        display: inline-block;
        background: #667eea;
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        margin-right: 8px;
        margin-bottom: 8px;
    }
    .worker-badge.tukang {
        background: #f093fb;
    }
    .worker-badge.kenek {
        background: #4facfe;
    }
    .transaction-table {
        margin-top: 15px;
    }
</style>

<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('reports.index') }}" class="btn btn-secondary">← Kembali ke Laporan</a>
        <a href="{{ route('reports.project-pdf', $project->id) }}" class="btn btn-danger" target="_blank">
            📥 Cetak PDF
        </a>
    </div>

    <!-- Project Header -->
    <div class="header-project">
        <div class="project-title">{{ $project->nama_proyek }}</div>
        <div class="project-meta">
            📅 {{ \Carbon\Carbon::parse($project->tanggal_proyek)->format('d F Y') }} | 
            💰 Nilai Kontrak: Rp {{ number_format($project->nilai_kontrak) }}
        </div>

        <div class="summary-grid">
            <div class="summary-item">
                <div class="summary-value">Rp {{ number_format($upahTukang) }}</div>
                <div class="summary-label">Upah Tukang</div>
            </div>
            <div class="summary-item">
                <div class="summary-value">Rp {{ number_format($upahKenek) }}</div>
                <div class="summary-label">Upah Kenek</div>
            </div>
            <div class="summary-item">
                <div class="summary-value">Rp {{ number_format($material) }}</div>
                <div class="summary-label">Material</div>
            </div>
            <div class="summary-item">
                <div class="summary-value">Rp {{ number_format($total) }}</div>
                <div class="summary-label">Total Biaya</div>
            </div>
        </div>
    </div>

    <!-- Workers Section -->
    <div class="card shadow-sm mb-4">
        <div class="card-header fw-bold" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            👷 Daftar Pekerja ({{ $project->workers->count() }})
        </div>
        <div class="card-body">
            @if($project->workers->isEmpty())
                <div class="alert alert-info">Belum ada pekerja di proyek ini</div>
            @else
                @foreach($project->workers as $worker)
                    <div class="worker-badge {{ strtolower($worker->kategori) }}">
                        {{ $worker->nama_pekerja }} - {{ $worker->kategori }}
                        @if($worker->upah_harian)
                            (Rp {{ number_format($worker->upah_harian) }}/hari)
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Transactions Section -->
    <div class="card shadow-sm">
        <div class="card-header fw-bold" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            💳 Riwayat Transaksi ({{ $transactions->count() }})
        </div>
        <div class="card-body">
            @if($transactions->isEmpty())
                <div class="alert alert-info">Belum ada transaksi untuk proyek ini</div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Nama Pekerja</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions->sortByDesc('tanggal') as $t)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge" 
                                        @if($t->kategori == 'Upah Tukang') style="background: #f093fb;"
                                        @elseif($t->kategori == 'Upah Kenek') style="background: #4facfe;"
                                        @elseif($t->kategori == 'Material') style="background: #ffa500;"
                                        @endif>
                                        {{ $t->kategori }}
                                    </span>
                                </td>
                                <td>{{ $t->nama_pekerja ?? '-' }}</td>
                                <td><strong>Rp {{ number_format($t->jumlah) }}</strong></td>
                                <td>{{ $t->keterangan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
