<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worker;
use App\Models\Project;

class WorkerController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'nama_pekerja' => 'required|string',
            'kategori' => 'required|in:Tukang,Kenek',
            'upah_harian' => 'nullable|numeric',
            'kontak' => 'nullable|string',
        ]);

        Worker::create($validated);
        
        return redirect('/');
    }

    public function edit($id)
    {
        $worker = Worker::findOrFail($id);
        $projects = Project::all();
        return view('workers.edit', compact('worker', 'projects'));
    }

    public function update(Request $request, $id)
    {
        $worker = Worker::findOrFail($id);

        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'nama_pekerja' => 'required|string',
            'kategori' => 'required|in:Tukang,Kenek',
            'upah_harian' => 'nullable|numeric',
            'kontak' => 'nullable|string',
        ]);

        $worker->update($validated);

        return redirect('/')->with('success', 'Pekerja berhasil diupdate');
    }

    public function destroy($id)
    {
        $worker = Worker::findOrFail($id);
        $worker->delete();

        return redirect('/')->with('success', 'Pekerja berhasil dihapus');
    }
}
