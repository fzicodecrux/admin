@extends('layouts.app')
@section('title','Laporan Proyek')

@section('content')

<style>
    .report-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .report-stat {
        font-size: 24px;
        font-weight: 700;
        margin-top: 10px;
    }
    .report-label {
        font-size: 13px;
        opacity: 0.9;
        margin-bottom: 5px;
    }
    .project-report {
        background: white;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }
    .project-report:hover {
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }
    .project-name {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }
    .project-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
        margin-top: 10px;
    }
    .stat-box {
        background: #f5f5f5;
        padding: 10px;
        border-radius: 6px;
        text-align: center;
    }
    .stat-value {
        font-size: 16px;
        font-weight: 600;
        color: #667eea;
    }
    .stat-title {
        font-size: 11px;
        color: #666;
        margin-top: 5px;
    }
    .btn-group {
        margin-top: 10px;
    }
    .badge-tukang {
        background: #f093fb;
        color: white;
        padding: 6px 12px;
        border-radius: 4px;
    }
    .badge-kenek {
        background: #4facfe;
        color: white;
        padding: 6px 12px;
        border-radius: 4px;
    }
</style>

<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>📊 Laporan Manajemen Proyek</h3>
        <div>
            <a href="/" class="btn btn-secondary">← Kembali ke Dashboard</a>
            <a href="{{ route('reports.pdf') }}" class="btn btn-danger" target="_blank">
                📥 Cetak PDF
            </a>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="report-card">
                <div class="report-label">Total Upah Tukang</div>
                <div class="report-stat">Rp {{ number_format($totalUpahTukang) }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="report-card">
                <div class="report-label">Total Upah Kenek</div>
                <div class="report-stat">Rp {{ number_format($totalUpahKenek) }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="report-card">
                <div class="report-label">Total Material</div>
                <div class="report-stat">Rp {{ number_format($totalMaterial) }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="report-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="report-label">Total Keseluruhan</div>
                <div class="report-stat">Rp {{ number_format($grandTotal) }}</div>
            </div>
        </div>
    </div>

    <!-- Projects Report -->
    <div class="card shadow-sm">
        <div class="card-header fw-bold" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            📋 Detail Laporan Per Proyek
        </div>
        <div class="card-body">
            @if($projects->isEmpty())
                <div class="alert alert-info">Belum ada proyek</div>
            @else
                @foreach($projects as $project)
                    <div class="project-report">
                        <div class="project-name">
                            {{ $project->nama_proyek }}
                            <small class="text-muted">({{ $project->tanggal_proyek }})</small>
                        </div>
                        
                        <div class="project-stats">
                            <div class="stat-box">
                                <div class="stat-value">
                                    Rp {{ number_format($project->transactions->where('kategori', 'Upah Tukang')->sum('jumlah')) }}
                                </div>
                                <div class="stat-title">Upah Tukang</div>
                            </div>
                            <div class="stat-box">
                                <div class="stat-value">
                                    Rp {{ number_format($project->transactions->where('kategori', 'Upah Kenek')->sum('jumlah')) }}
                                </div>
                                <div class="stat-title">Upah Kenek</div>
                            </div>
                            <div class="stat-box">
                                <div class="stat-value">
                                    Rp {{ number_format($project->transactions->where('kategori', 'Material')->sum('jumlah')) }}
                                </div>
                                <div class="stat-title">Material</div>
                            </div>
                            <div class="stat-box" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                <div class="stat-value" style="color: white;">
                                    Rp {{ number_format($project->transactions->sum('jumlah')) }}
                                </div>
                                <div class="stat-title" style="color: rgba(255,255,255,0.8);">Total Biaya</div>
                            </div>
                        </div>

                        <div class="btn-group mt-3">
                            <a href="{{ route('reports.project', $project->id) }}" class="btn btn-primary btn-sm">
                                📄 Lihat Detail
                            </a>
                            <a href="{{ route('reports.project-pdf', $project->id) }}" class="btn btn-danger btn-sm" target="_blank">
                                📥 Cetak PDF
                            </a>
                            <span class="ms-2 text-muted small">
                                {{ $project->workers->count() }} Pekerja | {{ $project->transactions->count() }} Transaksi
                            </span>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Workers Report -->
    @php
        $allWorkers = \App\Models\Worker::with('project')->get();
    @endphp
    <div class="card shadow-sm mt-4">
        <div class="card-header fw-bold" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            👷 Daftar Karyawan
        </div>
        <div class="card-body">
            @if($allWorkers->isEmpty())
                <div class="alert alert-info">Belum ada karyawan</div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Karyawan</th>
                                <th>Kategori</th>
                                <th>Proyek</th>
                                <th>Upah Harian</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allWorkers as $worker)
                            <tr>
                                <td><strong>{{ $worker->nama_pekerja }}</strong></td>
                                <td>
                                    <span class="badge @if($worker->kategori == 'Tukang') badge-tukang @else badge-kenek @endif">
                                        {{ $worker->kategori }}
                                    </span>
                                </td>
                                <td>{{ $worker->project->nama_proyek }}</td>
                                <td>{{ $worker->upah_harian ? 'Rp ' . number_format($worker->upah_harian) : '-' }}</td>
                                <td>
                                    <a href="{{ route('reports.worker', $worker->id) }}" class="btn btn-sm btn-primary">Lihat Laporan</a>
                                    <a href="{{ route('reports.worker-pdf', $worker->id) }}" class="btn btn-sm btn-danger" target="_blank">PDF</a>
                                </td>
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
