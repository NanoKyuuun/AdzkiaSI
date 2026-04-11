<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $fillable = ['nidn', 'user_id', 'nama', 'email', 'prodi_id', 'jabatan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'prodi_id');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
