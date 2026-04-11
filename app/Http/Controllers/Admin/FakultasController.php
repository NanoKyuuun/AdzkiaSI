<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    public function index()
    {
        $fakultas = Fakultas::all();
        return view('admin.fakultas.index', compact('fakultas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_fakultas' => 'required|string|max:255',
            'kode_fakultas' => 'required|string|max:50|unique:fakultas',
        ]);

        Fakultas::create($request->all());

        return redirect()->route('admin.fakultas.index')->with('success', 'Fakultas berhasil ditambahkan.');
    }

    public function update(Request $request, Fakultas $fakultas)
    {
        $request->validate([
            'name_fakultas' => 'required|string|max:255',
            'kode_fakultas' => 'required|string|max:50|unique:fakultas,kode_fakultas,' . $fakultas->id,
        ]);

        $fakultas->update($request->all());

        return redirect()->route('admin.fakultas.index')->with('success', 'Fakultas berhasil diperbarui.');
    }

    public function destroy(Fakultas $fakultas)
    {
        $fakultas->delete();
        return redirect()->route('admin.fakultas.index')->with('success', 'Fakultas berhasil dihapus.');
    }
}
