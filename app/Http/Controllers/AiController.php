<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiController extends Controller
{
    public function index()
    {
        return view('ai-feature');
    }

    public function ask(Request $request)
    {
        $prompt  = $request->input('prompt');
        $history = $request->input('history', []); // riwayat percakapan dari client

        // 1. Ambil data Dosen
        $dosens = Dosen::with('programStudi')->get();
        $konteksDosen = $dosens->map(fn($d) => [
            'nama'    => $d->nama    ?? 'Tanpa Nama',
            'prodi'   => optional($d->programStudi)->nama_prodi ?? 'Belum Diatur',
            'jabatan' => $d->jabatan ?? '-',
            'nidn'    => $d->nidn    ?? '-',
            'email'   => $d->email   ?? '-',
        ])->toArray();

        // 2. Ambil data Program Studi
        $prodis = ProgramStudi::with('fakultas')->get();
        $konteksProdi = $prodis->map(fn($p) => [
            'nama_prodi' => $p->nama_prodi    ?? '-',
            'jenjang'    => $p->jenjang       ?? '-',
            'kode_prodi' => $p->kode_prodi    ?? '-',
            'fakultas'   => optional($p->fakultas)->name_fakultas ?? '-',
        ])->toArray();

        // 3. Ambil ringkasan Mahasiswa (jumlah per prodi)
        $konteksMahasiswa = Mahasiswa::with('programStudi')
            ->get()
            ->groupBy(fn($m) => optional($m->programStudi)->nama_prodi ?? 'Tidak Diketahui')
            ->map(fn($group, $prodi) => [
                'prodi'  => $prodi,
                'jumlah' => $group->count(),
                'aktif'  => $group->where('status', 'aktif')->count(),
            ])
            ->values()
            ->toArray();

        // 4. Log untuk debugging
        Log::info('AI Request dikirim ke Nuxt', [
            'prompt'          => $prompt,
            'jumlah_dosen'    => count($konteksDosen),
            'jumlah_prodi'    => count($konteksProdi),
            'jumlah_history'  => count($history),
        ]);

        try {
            // 5. Kirim ke Nuxt (fuzan) — port 3000
            $response = Http::timeout(60)->post('http://localhost:3000/api/ai', [
                'prompt'           => $prompt,
                'history'          => $history,
                'konteks_dosen'    => $konteksDosen,
                'konteks_prodi'    => $konteksProdi,
                'konteks_mahasiswa'=> $konteksMahasiswa,
            ]);

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'result'  => $response->json()['result'],
                ]);
            }

            Log::error('Nuxt AI error response', ['body' => (string) $response->body()]);
            return response()->json(['success' => false, 'message' => 'Server AI tidak memberikan response yang valid.'], 500);

        } catch (\Exception $e) {
            Log::error('Koneksi ke Nuxt gagal', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Tidak dapat terhubung ke AI. Pastikan Nuxt (fuzan) berjalan di port 3000.'], 500);
        }
    }
}
