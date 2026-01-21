<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Karyawan - {{ $worker->nama_pekerja }}</title>
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
        .worker-info {
            background: #f0f0f0;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
        }
        .worker-info p {
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
        table tfoot tr {
            background: #f0f0f0;
            font-weight: bold;
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
        <h1>LAPORAN DETAIL KARYAWAN</h1>
        <p>{{ $worker->nama_pekerja }}</p>
        <p>Tanggal Cetak: {{ date('d F Y H:i:s') }}</p>
    </div>

    <div class="worker-info">
        <p><strong>Nama Karyawan:</strong> {{ $worker->nama_pekerja }}</p>
        <p><strong>Kategori:</strong> {{ $worker->kategori }}</p>
        <p><strong>Upah Harian:</strong> {{ $worker->upah_harian ? 'Rp ' . number_format($worker->upah_harian) : 'Tidak tersedia' }}</p>
        <p><strong>Kontak:</strong> {{ $worker->kontak ?? 'Tidak tersedia' }}</p>
        <p><strong>Proyek:</strong> {{ $worker->project->nama_proyek }}</p>
        <p><strong>Bergabung:</strong> {{ \Carbon\Carbon::parse($worker->created_at)->format('d F Y') }}</p>
    </div>

    <div class="summary">
        <div class="summary-box">
            <h3>Total Upah</h3>
            <div class="value">Rp {{ number_format($totalEarnings) }}</div>
        </div>
        <div class="summary-box">
            <h3>Upah Tukang</h3>
            <div class="value">Rp {{ number_format($upahTukang) }}</div>
        </div>
        <div class="summary-box">
            <h3>Upah Kenek</h3>
            <div class="value">Rp {{ number_format($upahKenek) }}</div>
        </div>
        <div class="summary-box">
            <h3>Total Transaksi</h3>
            <div class="value">{{ $transactions->count() }}</div>
        </div>
    </div>

    <div class="section-title">RIWAYAT TRANSAKSI</div>
    @if($transactions->isEmpty())
        <p style="font-size: 12px;">Belum ada transaksi untuk karyawan ini</p>
    @else
        <table>
            <tr>
                <th>Tanggal</th>
                <th>Proyek</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
            @foreach($transactions->sortByDesc('tanggal') as $t)
            <tr>
                <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d/m/Y') }}</td>
                <td>{{ $t->project->nama_proyek }}</td>
                <td>
                    <span class="badge @if($t->kategori == 'Upah Tukang') badge-tukang @elseif($t->kategori == 'Upah Kenek') badge-kenek @else badge-material @endif">
                        {{ $t->kategori }}
                    </span>
                </td>
                <td><strong>Rp {{ number_format($t->jumlah) }}</strong></td>
                <td>{{ $t->keterangan }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3"><strong>TOTAL</strong></td>
                <td colspan="2"><strong>Rp {{ number_format($totalEarnings) }}</strong></td>
            </tr>
        </table>
    @endif

    <div class="footer">
        Generated by Project Management System - {{ date('Y-m-d') }}
    </div>

</body>
</html>
