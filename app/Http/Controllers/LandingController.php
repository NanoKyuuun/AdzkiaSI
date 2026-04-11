<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LandingController extends Controller
{
    /**
     * Halaman Fakultas — tampilkan semua fakultas dari database
     */
    public function fakultas()
    {
        $fakultas = Fakultas::with('programStudis')->get();

        return view('fakultas', compact('fakultas'));
    }

    /**
     * Halaman Program Studi — tampilkan semua prodi dikelompokkan per fakultas
     */
    public function programStudi()
    {
        $fakultas   = Fakultas::with(['programStudis.dosens'])->get();
        $prodis     = ProgramStudi::with('fakultas')->get();
        $totalDosen = Dosen::count();

        return view('program-studi', compact('fakultas', 'prodis', 'totalDosen'));
    }

    /**
     * Halaman Kontak — tampilkan form kontak
     */
    public function kontak()
    {
        return view('kontak');
    }

    /**
     * Proses kiriman form kontak
     */
    public function kirimKontak(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:100',
            'email'  => 'required|email|max:150',
            'subjek' => 'required|string|max:200',
            'pesan'  => 'required|string|max:2000',
        ], [
            'nama.required'   => 'Nama wajib diisi.',
            'email.required'  => 'Email wajib diisi.',
            'email.email'     => 'Format email tidak valid.',
            'subjek.required' => 'Subjek wajib diisi.',
            'pesan.required'  => 'Pesan wajib diisi.',
        ]);

        // Log pesan (bisa diganti dengan Mail::to(...)->send(...) jika ada config mail)
        Log::info('Pesan Kontak Masuk', [
            'nama'   => $request->nama,
            'email'  => $request->email,
            'subjek' => $request->subjek,
            'pesan'  => $request->pesan,
        ]);

        return redirect()->route('kontak')->with('success', 'Pesan Anda berhasil dikirim! Kami akan menghubungi Anda segera.');
    }
}
