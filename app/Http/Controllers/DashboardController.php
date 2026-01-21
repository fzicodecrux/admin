<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTukang   = Transaction::where('kategori','Upah Tukang')->sum('jumlah');
    $totalKenek    = Transaction::where('kategori','Upah Kenek')->sum('jumlah');
    $totalMaterial = Transaction::where('kategori','Material')->sum('jumlah');

    $saldo = Transaction::where('jenis','pemasukan')->sum('jumlah')
           - Transaction::where('jenis','pengeluaran')->sum('jumlah');

    // DATA GRAFIK BULANAN
    $grafik = Transaction::select(
            DB::raw("MONTH(tanggal) as bulan"),
            DB::raw("SUM(CASE WHEN jenis='pemasukan' THEN jumlah ELSE 0 END) as pemasukan"),
            DB::raw("SUM(CASE WHEN jenis='pengeluaran' THEN jumlah ELSE 0 END) as pengeluaran")
        )
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();
        return view('dashboard', compact(
        'totalTukang','totalKenek','totalMaterial','saldo','grafik'));
              
    }
}
