<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TransactionController;

Route::get('/', [ProjectController::class,'dashboard']);
Route::post('/project/store', [ProjectController::class,'store']);
Route::get('/', [ProjectController::class,'dashboard'])->name('dashboard');

Route::post('/project/store', [ProjectController::class,'store']);
Route::post('/project/{id}/delete', [ProjectController::class,'destroy'])->name('projects.destroy');
Route::post('/transaction/store', [TransactionController::class,'store'])->name('transactions.store');
Route::get('/transaction/{id}/edit', [TransactionController::class,'edit'])->name('transactions.edit');
Route::post('/transaction/{id}/destroy', [TransactionController::class,'destroy'])->name('transactions.destroy');
Route::post('/transaction/{id}/update', [TransactionController::class,'update'])->name('transactions.update');
Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

Route::get('/laporan', [\App\Http\Controllers\ReportController::class,'index'])->name('reports.index');
Route::get('/laporan/proyek/{id}', [\App\Http\Controllers\ReportController::class,'projectDetail'])->name('reports.project');
Route::get('/laporan/pdf', [\App\Http\Controllers\ReportController::class,'printPdf'])->name('reports.pdf');
Route::get('/laporan/proyek/{id}/pdf', [\App\Http\Controllers\ReportController::class,'projectPrintPdf'])->name('reports.project-pdf');
Route::get('/laporan/karyawan/{id}', [\App\Http\Controllers\ReportController::class,'workerDetail'])->name('reports.worker');
Route::get('/laporan/karyawan/{id}/pdf', [\App\Http\Controllers\ReportController::class,'workerPrintPdf'])->name('reports.worker-pdf');

// API Routes
Route::get('/api/worker/{id}', [TransactionController::class,'getWorker']);
Route::get('/api/project/{projectId}/workers', [TransactionController::class,'getProjectWorkers']);

Route::post('/worker/store', [\App\Http\Controllers\WorkerController::class,'store'])->name('workers.store');
Route::get('/worker/{id}/edit', [\App\Http\Controllers\WorkerController::class,'edit'])->name('workers.edit');
Route::post('/worker/{id}/update', [\App\Http\Controllers\WorkerController::class,'update'])->name('workers.update');
Route::post('/worker/{id}/delete', [\App\Http\Controllers\WorkerController::class,'destroy'])->name('workers.destroy');
