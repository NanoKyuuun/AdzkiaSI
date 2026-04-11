<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    public function index()
    {
        $programStudi = ProgramStudi::with('fakultas')->get();
        $fakultas = Fakultas::all();
        return view('admin.program-studi.index', compact('programStudi', 'fakultas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fakultas_id' => 'required|exists:fakultas,id',
            'nama_prodi' => 'required|string|max:255',
            'jenjang' => 'required|in:D3,D4,S1,S2,S3',
            'kode_prodi' => 'required|string|max:50|unique:program_studis',
        ]);

        ProgramStudi::create($request->all());

        return redirect()->route('admin.program-studi.index')->with('success', 'Program Studi berhasil ditambahkan.');
    }

    public function update(Request $request, ProgramStudi $programStudi)
    {
        $request->validate([
            'fakultas_id' => 'required|exists:fakultas,id',
            'nama_prodi' => 'required|string|max:255',
            'jenjang' => 'required|in:D3,D4,S1,S2,S3',
            'kode_prodi' => 'required|string|max:50|unique:program_studis,kode_prodi,' . $programStudi->id,
        ]);

        $programStudi->update($request->all());

        return redirect()->route('admin.program-studi.index')->with('success', 'Program Studi berhasil diperbarui.');
    }

    public function destroy(ProgramStudi $programStudi)
    {
        $programStudi->delete();
        return redirect()->route('admin.program-studi.index')->with('success', 'Program Studi berhasil dihapus.');
    }
}
