<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['project_id','jenis','kategori','keterangan','jumlah','tanggal','nama_pekerja'];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}