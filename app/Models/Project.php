<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['nama_proyek','tanggal_proyek','nilai_kontrak'];
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function workers()
    {
        return $this->hasMany(Worker::class);
    }
}

