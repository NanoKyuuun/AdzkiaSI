<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index()
    {
        $mataKuliah = MataKuliah::with('programStudi')->get();
        $prodi = ProgramStudi::all();
        return view('admin.mata-kuliah.index', compact('mataKuliah', 'prodi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required|string|max:20|unique:mata_kuliahs',
            'nama_mk' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8',
            'prodi_id' => 'required|exists:program_studis,id',
        ]);

        MataKuliah::create($request->all());

        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata Kuliah berhasil ditambahkan.');
    }

    public function update(Request $request, MataKuliah $mataKuliah)
    {
        $request->validate([
            'kode_mk' => 'required|string|max:20|unique:mata_kuliahs,kode_mk,' . $mataKuliah->id,
            'nama_mk' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8',
            'prodi_id' => 'required|exists:program_studis,id',
        ]);

        $mataKuliah->update($request->all());

        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata Kuliah berhasil diperbarui.');
    }

    public function destroy(MataKuliah $mataKuliah)
    {
        $mataKuliah->delete();
        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata Kuliah berhasil dihapus.');
    }
}
