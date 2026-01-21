@extends('layouts.app')
@section('title','Dashboard Proyek')

@section('content')

<style>
/* ===== MODERN DASHBOARD ===== */
body {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    padding-top: 20px;
    padding-bottom: 40px;
}

.dashboard-container {
    background: #f8f9ff;
    border-radius: 20px;
    padding: 40px;
    margin-bottom: 30px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.15);
}

.dashboard-header {
    margin-bottom: 40px;
    padding-bottom: 20px;
    border-bottom: 3px solid #667eea;
}

.dashboard-header h2 {
    color: #333;
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 8px;
}

.dashboard-header p {
    color: #666;
    font-size: 14px;
}

/* ===== SUMMARY CARDS ===== */
.summary-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}

.card-summary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.card-summary::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200px;
    height: 200px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
}

.card-summary:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
}

.card-summary.upah-tukang {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    box-shadow: 0 10px 30px rgba(245, 87, 108, 0.3);
}

.card-summary.upah-tukang:hover {
    box-shadow: 0 15px 40px rgba(245, 87, 108, 0.4);
}

.card-summary.upah-kenek {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    box-shadow: 0 10px 30px rgba(79, 172, 254, 0.3);
}

.card-summary.upah-kenek:hover {
    box-shadow: 0 15px 40px rgba(79, 172, 254, 0.4);
}

.card-summary.material {
    background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    box-shadow: 0 10px 30px rgba(250, 112, 154, 0.3);
}

.card-summary.material:hover {
    box-shadow: 0 15px 40px rgba(250, 112, 154, 0.4);
}

.card-summary.saldo {
    background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);
    box-shadow: 0 10px 30px rgba(48, 207, 208, 0.3);
}

.card-summary.saldo:hover {
    box-shadow: 0 15px 40px rgba(48, 207, 208, 0.4);
}

.card-summary .card-body {
    position: relative;
    z-index: 1;
}

.card-summary small {
    font-size: 13px;
    opacity: 0.9;
    display: block;
    margin-bottom: 12px;
    font-weight: 500;
}

.card-summary h4 {
    font-size: 28px;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* ===== SECTION HEADER ===== */
.section-card {
    background: white;
    border-radius: 16px;
    margin-bottom: 30px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    overflow: hidden;
}

.section-card .card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 20px 25px;
    border: none;
    font-weight: 600;
    font-size: 16px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.section-card .card-body {
    padding: 25px;
}

/* ===== BUTTON ACCESS ===== */
.btn-access {
    display: inline-block;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 14px 32px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    margin-bottom: 30px;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
}

.btn-access:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    color: white;
}

/* ===== FORM STYLING ===== */
.form-section {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin-bottom: 15px;
}

.form-section input,
.form-section select {
    border-radius: 8px;
    border: 2px solid #e0e0e0;
    padding: 10px 14px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.form-section input:focus,
.form-section select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

/* ===== TABLE STYLING ===== */
.table-responsive table {
    margin-bottom: 0;
}

.table thead {
    background: #f8f9ff;
}

.table thead th {
    color: #667eea;
    font-weight: 600;
    border-color: #e0e0e0;
    padding: 15px;
}

.table tbody td {
    padding: 15px;
    border-color: #e0e0e0;
    vertical-align: middle;
}

.table tbody tr {
    transition: all 0.2s ease;
}

.table tbody tr:hover {
    background-color: #f8f9ff;
    box-shadow: inset 0 0 10px rgba(0,0,0,0.05);
}

/* ===== PROJECT CARD ===== */
.project-card {
    background: linear-gradient(135deg,#1f6f5c,#2d8f75);
    color: white;
    border-radius: 16px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.project-card::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 150px;
    height: 150px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
}

.project-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.project-title {
    font-size: 18px;
    font-weight: 700;
    color: #ffffff;
    position: relative;
    z-index: 1;
    margin-bottom: 8px;
}

.project-location {
    font-size: 13px;
    opacity: 0.9;
    position: relative;
    z-index: 1;
}

.project-value {
    font-size: 16px;
    font-weight: 700;
    margin: 15px 0;
    color: #ffffff;
    position: relative;
    z-index: 1;
}

.project-card .btn {
    border-radius: 8px;
    font-size: 12px;
    padding: 10px;
    margin-bottom: 8px;
    position: relative;
    z-index: 1;
}

/* ===== WORKER CARDS ===== */
.worker-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 12px;
    padding: 16px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    min-height: 140px;
}

.worker-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.worker-card.tukang {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.worker-card.kenek {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.worker-info h5 {
    margin-bottom: 5px;
    font-weight: 700;
    font-size: 15px;
}

.worker-info small {
    display: block;
    opacity: 0.95;
    font-size: 12px;
    line-height: 1.5;
}

.worker-badge {
    display: inline-block;
    background: rgba(255,255,255,0.3);
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
}

</style>

<!-- ===== DASHBOARD CONTAINER ===== -->
<div class="container-fluid">
    <div class="dashboard-container">
        <!-- Header -->
        <div class="dashboard-header">
            <h2>📊 Dashboard Manajemen Proyek</h2>
            <p>Kelola semua proyek, karyawan, dan transaksi Anda dengan mudah</p>
        </div>

        <!-- ===== SUMMARY CARDS ===== -->
        <div class="summary-cards">
            <div class="card card-summary upah-tukang">
                <div class="card-body">
                    <small>💰 Total Upah Tukang</small>
                    <h4>Rp {{ number_format($totalTukang) }}</h4>
                </div>
            </div>

            <div class="card card-summary upah-kenek">
                <div class="card-body">
                    <small>💰 Total Upah Kenek</small>
                    <h4>Rp {{ number_format($totalKenek) }}</h4>
                </div>
            </div>

            <div class="card card-summary material">
                <div class="card-body">
                    <small>🏗️ Total Material</small>
                    <h4>Rp {{ number_format($totalMaterial) }}</h4>
                </div>
            </div>

            <div class="card card-summary saldo">
                <div class="card-body">
                    <small>💎 Total Saldo</small>
                    <h4>Rp {{ number_format($saldo) }}</h4>
                </div>
            </div>
        </div>

        <!-- Laporan Button -->
        <a href="{{ route('reports.index') }}" class="btn-access">
            📊 Lihat Laporan Manajemen
        </a>

        <!-- ===== DATA TRANSAKSI ===== -->
        <div class="section-card">
            <div class="card-header">
                📊 Data Transaksi
            </div>
            <div class="card-body table-responsive">
                @php
                    $allTransactions = \App\Models\Transaction::with('project')->orderBy('tanggal', 'desc')->get();
                @endphp

                @if($allTransactions->isEmpty())
                    <div class="alert alert-info mb-0">Belum ada data transaksi</div>
                @else
                    <table class="table table-bordered table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Proyek</th>
                                <th>Kategori</th>
                                <th>Nama Pekerja</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                                <th width="120">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allTransactions as $t)
                            <tr>
                                <td>{{ $t->tanggal }}</td>
                                <td><strong>{{ $t->project->nama_proyek }}</strong></td>
                                <td><span class="badge" style="@if($t->kategori == 'Upah Tukang') background: #f093fb; @elseif($t->kategori == 'Upah Kenek') background: #4facfe; @else background: #ffa500; @endif color: white;">{{ $t->kategori }}</span></td>
                                <td>{{ $t->nama_pekerja ?? '-' }}</td>
                                <td>Rp {{ number_format($t->jumlah) }}</td>
                                <td>{{ $t->keterangan }}</td>
                                <td>
                                    <a href="{{ route('transactions.edit',$t->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form method="POST" action="{{ route('transactions.destroy',$t->id) }}" class="d-inline">
                                        @csrf
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus transaksi?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <!-- ===== PROJECT SECTION ===== -->
    <div class="section-card">
        <div class="card-header">📋 Data Proyek</div>
        <div class="card-body">
            <div class="row g-4">
            @foreach($projects as $p)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                <div class="project-card">
                    <div class="project-title">{{ $p->nama_proyek }}</div>
                    <div class="project-location">{{ \Carbon\Carbon::parse($p->tanggal_proyek)->format('d/m/Y') }}</div>
                    <div class="project-value">Rp {{ number_format($p->nilai_kontrak) }}</div>
                    <a href="/project/{{ $p->id }}" class="btn btn-primary btn-sm w-100">Edit Proyek</a>
                    <form method="POST" action="{{ route('projects.destroy',$p->id) }}" class="d-grid gap-2 mt-2">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Yakin hapus proyek ini? Semua data transaksi terkait juga akan dihapus.')">Hapus Proyek</button>
                    </form>
                </div>
            </div>
            @endforeach
            </div>
        </div>
    </div>

    <!-- ===== SECTION DATA PEKERJA ===== -->
    <div class="card shadow-sm mt-4">
        <div class="card-header fw-bold" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            👷 Data Pekerja
        </div>
        <div class="card-body table-responsive">
            @php
                $allWorkers = \App\Models\Worker::with('project')->get();
            @endphp

            @if($allWorkers->isEmpty())
                <div class="alert alert-info">Belum ada data pekerja</div>
            @else
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Pekerja</th>
                            <th>Kategori</th>
                            <th>Upah Harian</th>
                            <th>Kontak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allWorkers as $worker)
                        <tr>
                            <td><strong>{{ $worker->nama_pekerja }}</strong></td>
                            <td>
                                @if($worker->kategori === 'Tukang')
                                    <span class="badge" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">{{ $worker->kategori }}</span>
                                @else
                                    <span class="badge" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">{{ $worker->kategori }}</span>
                                @endif
                            </td>
                            <td>
                                @if($worker->upah_harian)
                                    💰 Rp {{ number_format($worker->upah_harian) }}/hari
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($worker->kontak)
                                    📱 {{ $worker->kontak }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('workers.edit', $worker->id) }}"
                                   class="btn btn-warning btn-sm">Edit</a>

                                <form method="POST" action="{{ route('workers.destroy', $worker->id) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Hapus pekerja?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- ===== TAMBAH TRANSAKSI UPAH PEKERJA ===== -->
    <div class="section-card">
    <div class="card-header fw-bold" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
        💰 Upah Pekerja
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('transactions.store') }}" class="row g-3" id="upahForm">
            @csrf
            
            <div class="col-md-3">
                <label class="form-label fw-bold">Proyek</label>
                <select name="project_id" id="project_id_upah" class="form-select" required>
                    <option value="">Pilih Proyek</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->nama_proyek }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-bold">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-bold">Nama Pekerja</label>
                <select name="nama_pekerja" id="worker_select_upah" class="form-select" required>
                    <option value="">Pilih Pekerja</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-bold">Hari Kerja</label>
                <input type="number" min="1" max="31" class="form-control" id="hari_kerja_upah" placeholder="Jumlah hari" required>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-bold">Upah Harian</label>
                <input type="text" class="form-control" id="upah_harian_display" placeholder="Rp 0" readonly style="background-color: #f0f0f0;">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-bold">Total Upah</label>
                <input type="text" class="form-control" id="total_upah_display" placeholder="Rp 0" readonly style="background-color: #f0f0f0;">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-bold">Kategori</label>
                <select name="jenis" id="kategori_upah" class="form-select" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Upah Tukang">Upah Tukang</option>
                    <option value="Upah Kenek">Upah Kenek</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-bold">&nbsp;</label>
                <input type="hidden" name="jumlah" id="jumlah_upah">
                <button type="submit" class="btn btn-success w-100">✓ Simpan Upah</button>
            </div>

            <div class="col-md-12">
                <label class="form-label fw-bold">Keterangan</label>
                <input type="text" name="keterangan" class="form-control" placeholder="Keterangan (opsional)">
            </div>
        </form>
    </div>
</div>

    <!-- ===== TAMBAH TRANSAKSI MATERIAL ===== -->
    <div class="section-card">
    <div class="card-header fw-bold" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
        🏗️ Material
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('transactions.store') }}" class="row g-3" id="materialForm">
            @csrf
            
            <div class="col-md-3">
                <label class="form-label fw-bold">Proyek</label>
                <select name="project_id" class="form-select" required>
                    <option value="">Pilih Proyek</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->nama_proyek }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-bold">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Nama Material</label>
                <input type="text" name="nama_pekerja" class="form-control" placeholder="Nama material/barang" required>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-bold">Jumlah Material</label>
                <input type="number" min="1" step="0.01" class="form-control" id="jumlah_material" placeholder="Qty" required>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-bold">Harga Satuan (Rp)</label>
                <input type="number" min="0" class="form-control" id="harga_satuan" placeholder="Rp 0" required>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-bold">Jumlah Harga (Rp)</label>
                <input type="text" class="form-control" id="jumlah_harga_display" placeholder="Rp 0" readonly style="background-color: #f0f0f0;">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-bold">&nbsp;</label>
                <input type="hidden" name="jumlah" id="jumlah_harga">
                <button type="submit" class="btn btn-success w-100">✓ Simpan Material</button>
            </div>

            <div class="col-md-12">
                <label class="form-label fw-bold">Keterangan</label>
                <input type="text" name="keterangan" class="form-control" placeholder="Keterangan (opsional)">
            </div>

            <input type="hidden" name="jenis" value="Material">
        </form>
    </div>
</div>

<script>
    // Store all workers data
    const allWorkersData = {
        @foreach($projects as $project)
            {{ $project->id }}: [
                @foreach($project->workers as $worker)
                    { id: {{ $worker->id }}, nama: '{{ $worker->nama_pekerja }}', kategori: '{{ $worker->kategori }}', upah_harian: {{ $worker->upah_harian }} },
                @endforeach
            ],
        @endforeach
    };

    // Update workers dropdown when project is selected
    document.getElementById('project_id_upah').addEventListener('change', function() {
        const projectId = this.value;
        const workerSelect = document.getElementById('worker_select_upah');
        workerSelect.innerHTML = '<option value="">Pilih Pekerja</option>';
        
        if (projectId && allWorkersData[projectId]) {
            allWorkersData[projectId].forEach(worker => {
                const option = document.createElement('option');
                option.value = worker.nama;
                option.dataset.upah = worker.upah_harian;
                option.textContent = worker.nama + ' (' + worker.kategori + ')';
                workerSelect.appendChild(option);
            });
        }
        updateUpahCalculation();
    });

    // Update calculation when worker is selected
    document.getElementById('worker_select_upah').addEventListener('change', updateUpahCalculation);
    document.getElementById('hari_kerja_upah').addEventListener('input', updateUpahCalculation);

    function updateUpahCalculation() {
        const workerSelect = document.getElementById('worker_select_upah');
        const hariKerja = parseInt(document.getElementById('hari_kerja_upah').value) || 0;
        const selectedOption = workerSelect.options[workerSelect.selectedIndex];
        const upahHarian = parseInt(selectedOption.dataset.upah) || 0;
        
        const totalUpah = upahHarian * hariKerja;

        // Display formatted upah harian
        document.getElementById('upah_harian_display').value = 'Rp ' + upahHarian.toLocaleString('id-ID');
        
        // Display formatted total upah
        document.getElementById('total_upah_display').value = 'Rp ' + totalUpah.toLocaleString('id-ID');
        
        // Store actual value in hidden input
        document.getElementById('jumlah_upah').value = totalUpah;
    }

    // Material calculation
    document.getElementById('jumlah_material').addEventListener('input', updateMaterialCalculation);
    document.getElementById('harga_satuan').addEventListener('input', updateMaterialCalculation);

    function updateMaterialCalculation() {
        const jumlahMaterial = parseFloat(document.getElementById('jumlah_material').value) || 0;
        const hargaSatuan = parseInt(document.getElementById('harga_satuan').value) || 0;
        
        const jumlahHarga = jumlahMaterial * hargaSatuan;

        // Display formatted jumlah harga
        document.getElementById('jumlah_harga_display').value = 'Rp ' + Math.round(jumlahHarga).toLocaleString('id-ID');
        
        // Store actual value in hidden input
        document.getElementById('jumlah_harga').value = Math.round(jumlahHarga);
    }

    // Set today's date as default
    document.querySelectorAll('input[type="date"]').forEach(input => {
        if (!input.value) {
            input.value = new Date().toISOString().split('T')[0];
        }
    });
</script>

<!-- ===== TAMBAH PROYEK ===== -->
<div class="card shadow-sm mb-4">
    <div class="card-header fw-bold" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
        ➕ Tambah Proyek
    </div>
    <div class="card-body">
        <form method="POST" action="/project/store" class="row g-3">
            @csrf

            <div class="col-md-4">
                <input class="form-control" name="nama_proyek"
                       placeholder="Nama Proyek" required>
            </div>

            <div class="col-md-4">
                <input type="date" class="form-control" name="tanggal_proyek"
                       placeholder="Tanggal Proyek" required>
            </div>

            <div class="col-md-3">
                <input class="form-control" name="nilai_kontrak"
                       placeholder="Nilai Kontrak">
            </div>

            <div class="col-md-1 d-grid">
                <button class="btn btn-primary">
                    Tambah
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ===== TAMBAH PEKERJA ===== -->
<div class="card shadow-sm mb-4">
    <div class="card-header fw-bold" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
        ➕ Tambah Pekerja
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('workers.store') }}" class="row g-3">
            @csrf

            <div class="col-md-2">
                <select name="project_id" class="form-select" required>
                    <option value="">Pilih Proyek</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->nama_proyek }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <input type="text" name="nama_pekerja" class="form-control" placeholder="Nama Pekerja" required>
            </div>

            <div class="col-md-2">
                <select name="kategori" class="form-select" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Tukang">Tukang</option>
                    <option value="Kenek">Kenek</option>
                </select>
            </div>

            <div class="col-md-2">
                <input type="number" name="upah_harian" class="form-control" placeholder="Upah Harian (Rp)">
            </div>

            <div class="col-md-2">
                <input type="text" name="kontak" class="form-control" placeholder="No. Kontak">
            </div>

            <div class="col-md-1 d-grid">
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>
</div>



</div>
@endsection
