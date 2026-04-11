<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::with('programStudi')->get();
        $prodis = ProgramStudi::all();
        return view('admin.dosen.index', compact('dosens', 'prodis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nidn' => 'required|unique:dosens,nidn',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'prodi_id' => 'required|exists:program_studis,id',
            'jabatan' => 'required|string',
            'password' => 'required|min:8',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'dosen',
            ]);

            Dosen::create([
                'nidn' => $request->nidn,
                'user_id' => $user->id,
                'nama' => $request->nama,
                'email' => $request->email,
                'prodi_id' => $request->prodi_id,
                'jabatan' => $request->jabatan,
            ]);
        });

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen dan akun akses berhasil dibuat.');
    }

    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nidn' => 'required|unique:dosens,nidn,' . $dosen->id,
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $dosen->user_id,
            'prodi_id' => 'required|exists:program_studis,id',
            'jabatan' => 'required|string',
        ]);

        DB::transaction(function () use ($request, $dosen) {
            $dosen->user->update([
                'name' => $request->nama,
                'email' => $request->email,
            ]);

            $dosen->update([
                'nidn' => $request->nidn,
                'nama' => $request->nama,
                'email' => $request->email,
                'prodi_id' => $request->prodi_id,
                'jabatan' => $request->jabatan,
            ]);
        });

        return redirect()->route('admin.dosen.index')->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen)
    {
        DB::transaction(function () use ($dosen) {
            $user = $dosen->user;
            $dosen->delete();
            $user->delete();
        });

        return redirect()->route('admin.dosen.index')->with('success', 'Data dosen dan akun akses berhasil dihapus.');
    }
}
