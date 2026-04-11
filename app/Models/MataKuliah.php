<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliahs';
    protected $fillable = ['kode_mk', 'nama_mk', 'sks', 'semester', 'prodi_id'];

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'prodi_id');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
