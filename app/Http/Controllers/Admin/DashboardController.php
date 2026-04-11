<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\ProgramStudi;
use App\Models\Fakultas;
use App\Models\MataKuliah;
use App\Models\Krs;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_mahasiswa' => Mahasiswa::count(),
            'total_dosen'     => Dosen::count(),
            'total_prodi'     => ProgramStudi::count(),
            'total_fakultas'  => Fakultas::count(),
            'total_mk'        => MataKuliah::count(),
            'krs_pending'     => Krs::where('status', 'pending')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
