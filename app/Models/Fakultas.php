<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    protected $fillable = ['name_fakultas', 'kode_fakultas'];

    public function programStudis()
    {
        return $this->hasMany(ProgramStudi::class);
    }
}
