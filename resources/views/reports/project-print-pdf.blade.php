<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Detail - {{ $project->nama_proyek }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: white;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        .header h1 {
            margin: 0;
            color: #333;
        }
        .header p {
            margin: 5px 0;
            color: #666;
            font-size: 12px;
        }
        .project-info {
            background: #f0f0f0;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
        }
        .project-info p {
            margin: 5px 0;
            font-size: 12px;
        }
        .summary {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
        }
        .summary-box {
            flex: 1;
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
            background: #f9f9f9;
        }
        .summary-box h3 {
            margin: 0 0 8px 0;
            font-size: 11px;
            color: #666;
        }
        .summary-box .value {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
        .section-title {
            background: #333;
            color: white;
            padding: 10px;
            margin-top: 25px;
            margin-bottom: 10px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th {
            background: #f0f0f0;
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 11px;
            font-weight: bold;
        }
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 11px;
        }
        table tr:nth-child(even) {
            background: #f9f9f9;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            color: white;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-tukang {
            background: #f093fb;
        }
        .badge-kenek {
            background: #4facfe;
        }
        .badge-material {
            background: #ffa500;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10px;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN DETAIL PROYEK</h1>
        <p>{{ $project->nama_proyek }}</p>
        <p>Tanggal Cetak: {{ date('d F Y H:i:s') }}</p>
    </div>

    <div class="project-info">
        <p><strong>Nama Proyek:</strong> {{ $project->nama_proyek }}</p>
        <p><strong>Tanggal Proyek:</strong> {{ \Carbon\Carbon::parse($project->tanggal_proyek)->format('d F Y') }}</p>
        <p><strong>Nilai Kontrak:</strong> Rp {{ number_format($project->nilai_kontrak) }}</p>
    </div>

    <div class="summary">
        <div class="summary-box">
            <h3>Upah Tukang</h3>
            <div class="value">Rp {{ number_format($upahTukang) }}</div>
        </div>
        <div class="summary-box">
            <h3>Upah Kenek</h3>
            <div class="value">Rp {{ number_format($upahKenek) }}</div>
        </div>
        <div class="summary-box">
            <h3>Material</h3>
            <div class="value">Rp {{ number_format($material) }}</div>
        </div>
        <div class="summary-box">
            <h3>Total Biaya</h3>
            <div class="value">Rp {{ number_format($total) }}</div>
        </div>
    </div>

    <div class="section-title">DAFTAR PEKERJA</div>
    @if($project->workers->isEmpty())
        <p style="font-size: 12px;">Belum ada pekerja di proyek ini</p>
    @else
        <table>
            <tr>
                <th>No</th>
                <th>Nama Pekerja</th>
                <th>Kategori</th>
                <th>Upah Harian</th>
                <th>Kontak</th>
            </tr>
            @foreach($project->workers as $key => $worker)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $worker->nama_pekerja }}</td>
                <td>
                    <span class="badge @if($worker->kategori == 'Tukang') badge-tukang @else badge-kenek @endif">
                        {{ $worker->kategori }}
                    </span>
                </td>
                <td>{{ $worker->upah_harian ? 'Rp ' . number_format($worker->upah_harian) : '-' }}</td>
                <td>{{ $worker->kontak ?? '-' }}</td>
            </tr>
            @endforeach
        </table>
    @endif

    <div class="section-title">RIWAYAT TRANSAKSI</div>
    @if($transactions->isEmpty())
        <p style="font-size: 12px;">Belum ada transaksi untuk proyek ini</p>
    @else
        <table>
            <tr>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Nama Pekerja</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
            @foreach($transactions->sortByDesc('tanggal') as $t)
            <tr>
                <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d/m/Y') }}</td>
                <td>
                    <span class="badge @if($t->kategori == 'Upah Tukang') badge-tukang @elseif($t->kategori == 'Upah Kenek') badge-kenek @else badge-material @endif">
                        {{ $t->kategori }}
                    </span>
                </td>
                <td>{{ $t->nama_pekerja ?? '-' }}</td>
                <td><strong>Rp {{ number_format($t->jumlah) }}</strong></td>
                <td>{{ $t->keterangan }}</td>
            </tr>
            @endforeach
        </table>
    @endif

    <div class="footer">
        Generated by Project Management System - {{ date('Y-m-d') }}
    </div>

</body>
</html>
