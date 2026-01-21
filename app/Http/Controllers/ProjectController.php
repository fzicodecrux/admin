<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
  public function dashboard()
{
    // ===== SUMMARY CARD =====
    $totalTukang = Transaction::where('kategori','Upah Tukang')->sum('jumlah');
    $totalKenek  = Transaction::where('kategori','Upah Kenek')->sum('jumlah');
    $totalMaterial = Transaction::where('kategori','Material')->sum('jumlah');

    $saldo = $totalTukang + $totalKenek + $totalMaterial;

    // ===== DATA PROYEK =====
    $projects = Project::all();

    return view('dashboard', compact(
        'totalTukang',
        'totalKenek',
        'totalMaterial',
        'saldo',
        'projects',

    ));
}

    // ===== SIMPAN PROYEK =====
    public function store(Request $request)
    {
        Project::create($request->all());
        return redirect()->back();
    }

    // ===== HAPUS PROYEK =====
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect('/')->with('success','Proyek berhasil dihapus');
    }
}
