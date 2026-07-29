<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    protected $fillable = ['fakultas_id', 'nama_prodi', 'jenjang', 'kode_prodi'];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    public function dosens()
    {
        return $this->hasMany(Dosen::class, 'prodi_id');
    }

    // ponytail: mahasiswas removed (mahasiswa portal cleanup)

    public function mataKuliahs()
    {
        return $this->hasMany(MataKuliah::class, 'prodi_id');
    }
}
