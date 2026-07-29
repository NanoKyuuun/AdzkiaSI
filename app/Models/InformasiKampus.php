<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiKampus extends Model
{
    protected $table = 'informasi_kampus';

    protected $fillable = ['key', 'value', 'deskripsi'];
}
