<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Worker;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $projects = Project::with('workers', 'transactions')->get();
        
        $totalUpahTukang = Transaction::where('kategori', 'Upah Tukang')->sum('jumlah');
        $totalUpahKenek = Transaction::where('kategori', 'Upah Kenek')->sum('jumlah');
        $totalMaterial = Transaction::where('kategori', 'Material')->sum('jumlah');
        $grandTotal = $totalUpahTukang + $totalUpahKenek + $totalMaterial;

        return view('reports.index', compact(
            'projects',
            'totalUpahTukang',
            'totalUpahKenek',
            'totalMaterial',
            'grandTotal'
        ));
    }

    public function projectDetail($id)
    {
        $project = Project::with('workers', 'transactions')->findOrFail($id);
        
        $transactions = $project->transactions()->get();
        $upahTukang = $transactions->where('kategori', 'Upah Tukang')->sum('jumlah');
        $upahKenek = $transactions->where('kategori', 'Upah Kenek')->sum('jumlah');
        $material = $transactions->where('kategori', 'Material')->sum('jumlah');
        $total = $upahTukang + $upahKenek + $material;

        return view('reports.project-detail', compact(
            'project',
            'transactions',
            'upahTukang',
            'upahKenek',
            'material',
            'total'
        ));
    }

    public function printPdf()
    {
        $projects = Project::with('workers', 'transactions')->get();
        
        $totalUpahTukang = Transaction::where('kategori', 'Upah Tukang')->sum('jumlah');
        $totalUpahKenek = Transaction::where('kategori', 'Upah Kenek')->sum('jumlah');
        $totalMaterial = Transaction::where('kategori', 'Material')->sum('jumlah');
        $grandTotal = $totalUpahTukang + $totalUpahKenek + $totalMaterial;

        return view('reports.print-pdf', compact(
            'projects',
            'totalUpahTukang',
            'totalUpahKenek',
            'totalMaterial',
            'grandTotal'
        ));
    }

    public function projectPrintPdf($id)
    {
        $project = Project::with('workers', 'transactions')->findOrFail($id);
        
        $transactions = $project->transactions()->get();
        $upahTukang = $transactions->where('kategori', 'Upah Tukang')->sum('jumlah');
        $upahKenek = $transactions->where('kategori', 'Upah Kenek')->sum('jumlah');
        $material = $transactions->where('kategori', 'Material')->sum('jumlah');
        $total = $upahTukang + $upahKenek + $material;

        return view('reports.project-print-pdf', compact(
            'project',
            'transactions',
            'upahTukang',
            'upahKenek',
            'material',
            'total'
        ));
    }

    public function workerDetail($id)
    {
        $worker = Worker::with('project')->findOrFail($id);
        $transactions = Transaction::where('nama_pekerja', $worker->nama_pekerja)->get();
        
        $totalEarnings = $transactions->sum('jumlah');
        $upahTukang = $transactions->where('kategori', 'Upah Tukang')->sum('jumlah');
        $upahKenek = $transactions->where('kategori', 'Upah Kenek')->sum('jumlah');
        $material = $transactions->where('kategori', 'Material')->sum('jumlah');

        return view('reports.worker-detail', compact(
            'worker',
            'transactions',
            'totalEarnings',
            'upahTukang',
            'upahKenek',
            'material'
        ));
    }

    public function workerPrintPdf($id)
    {
        $worker = Worker::with('project')->findOrFail($id);
        $transactions = Transaction::where('nama_pekerja', $worker->nama_pekerja)->get();
        
        $totalEarnings = $transactions->sum('jumlah');
        $upahTukang = $transactions->where('kategori', 'Upah Tukang')->sum('jumlah');
        $upahKenek = $transactions->where('kategori', 'Upah Kenek')->sum('jumlah');
        $material = $transactions->where('kategori', 'Material')->sum('jumlah');

        return view('reports.worker-print-pdf', compact(
            'worker',
            'transactions',
            'totalEarnings',
            'upahTukang',
            'upahKenek',
            'material'
        ));
    }
}
