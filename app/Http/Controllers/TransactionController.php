<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Project;

class TransactionController extends Controller
{
    public function index($project_id)
    {
        $project = Project::findOrFail($project_id);

        $transactions = Transaction::where('project_id',$project_id)
            ->orderBy('tanggal','desc')
            ->get();

        return view('transactions.index', compact(
            'project','transactions'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'tanggal'    => 'required|date',
            'jenis'      => 'required|in:Upah Tukang,Upah Kenek,Material',
            'jumlah'     => 'required|numeric',
        ]);

        // Move jenis value to kategori field
        $data = $request->all();
        $data['kategori'] = $data['jenis'];
        unset($data['jenis']);
        
        // Set default keterangan if empty
        if (empty($data['keterangan'])) {
            $data['keterangan'] = '-';
        }

        Transaction::create($data);

        return redirect('/')->with('success','Transaksi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $request->validate([
            'tanggal'  => 'required|date',
            'jenis'    => 'required|in:Upah Tukang,Upah Kenek,Material',
            'jumlah'   => 'required|numeric',
        ]);

        // Move jenis value to kategori field
        $data = $request->all();
        $data['kategori'] = $data['jenis'];
        unset($data['jenis']);

        $transaction->update($data);

        return redirect('/')->with('success','Transaksi berhasil diupdate');
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->delete();

        return redirect('/')->with('success','Transaksi berhasil dihapus');
    }

    public function getWorker($workerId)
    {
        $worker = \App\Models\Worker::findOrFail($workerId);
        return response()->json([
            'id' => $worker->id,
            'nama' => $worker->nama_pekerja,
            'kategori' => $worker->kategori,
            'upah_harian' => $worker->upah_harian,
        ]);
    }

    public function getProjectWorkers($projectId)
    {
        $workers = \App\Models\Worker::where('project_id', $projectId)
            ->where('kategori', '!=', null)
            ->get(['id', 'nama_pekerja', 'kategori', 'upah_harian']);
        
        return response()->json($workers);
    }
}
