<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = ['mata_kuliah_id', 'dosen_id', 'nama_kelas', 'tahun_ajaran'];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    // ponytail: Krs removed (mahasiswa portal cleanup)
}
