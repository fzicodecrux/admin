<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = ['project_id', 'nama_pekerja', 'kategori', 'upah_harian', 'kontak'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
