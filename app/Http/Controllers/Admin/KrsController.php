<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    public function index()
    {
        $krs = Krs::with(['mahasiswa', 'kelas.mataKuliah', 'kelas.dosen'])->get();
        $mahasiswas = Mahasiswa::all();
        $kelas = Kelas::with(['mataKuliah', 'dosen'])->get();
        
        return view('admin.krs.index', compact('krs', 'mahasiswas', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'kelas_id' => 'required|exists:kelas,id',
            'semester' => 'required|integer|min:1',
            'tahun_ajaran' => 'required|string',
            'status' => 'required|in:pending,disetujui,ditolak',
        ]);

        Krs::create($request->all());

        return redirect()->route('admin.krs.index')->with('success', 'Data KRS berhasil ditambahkan.');
    }

    public function update(Request $request, Krs $kr)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'semester' => 'required|integer|min:1',
            'tahun_ajaran' => 'required|string',
            'status' => 'required|in:pending,disetujui,ditolak',
        ]);

        $kr->update($request->all());

        return redirect()->route('admin.krs.index')->with('success', 'Data KRS berhasil diperbarui.');
    }

    public function destroy(Krs $kr)
    {
        $kr->delete();
        return redirect()->route('admin.krs.index')->with('success', 'Data KRS berhasil dihapus.');
    }
}
