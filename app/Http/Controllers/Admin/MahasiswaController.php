<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::with(['programStudi', 'user'])->get();
        $prodis = ProgramStudi::all();
        return view('admin.mahasiswa.index', compact('mahasiswas', 'prodis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'prodi_id' => 'required|exists:program_studis,id',
            'angkatan' => 'required|integer',
            'status' => 'required|in:aktif,non-aktif',
            'password' => 'required|min:8',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'mahasiswa',
            ]);

            Mahasiswa::create([
                'user_id' => $user->id,
                'nim' => $request->nim,
                'nama' => $request->nama,
                'prodi_id' => $request->prodi_id,
                'angkatan' => $request->angkatan,
                'status' => $request->status,
            ]);
        });

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa dan akun akses berhasil dibuat.');
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim,' . $mahasiswa->id,
            'nama' => 'required|string|max:255',
            'prodi_id' => 'required|exists:program_studis,id',
            'angkatan' => 'required|integer',
            'status' => 'required|in:aktif,non-aktif,lulus,drop-out',
        ]);

        DB::transaction(function () use ($request, $mahasiswa) {
            $mahasiswa->user->update([
                'name' => $request->nama,
            ]);

            $mahasiswa->update([
                'nim' => $request->nim,
                'nama' => $request->nama,
                'prodi_id' => $request->prodi_id,
                'angkatan' => $request->angkatan,
                'status' => $request->status,
            ]);
        });

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        DB::transaction(function () use ($mahasiswa) {
            $user = $mahasiswa->user;
            $mahasiswa->delete();
            $user->delete();
        });

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa dan akun akses berhasil dihapus.');
    }
}
