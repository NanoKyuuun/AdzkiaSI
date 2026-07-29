<?php

namespace App\Http\Controllers;

use App\Models\AiQuestionLog;
use App\Models\Fakultas;
use App\Models\Dosen;
use App\Models\Faq;
use App\Models\ProgramStudi;
use App\Models\MataKuliah;
use App\Models\Kelas;
use App\Models\InformasiKampus;
use App\Models\KalenderAkademik;
use App\Services\AiLearningService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AiController extends Controller
{
    public function __construct(private readonly AiLearningService $aiLearningService)
    {
    }

    public function index()
    {
        return view('ai-feature', [
            'suggestions' => $this->aiLearningService->getSuggestedQuestions(),
        ]);
    }

    public function ask(Request $request)
    {
        $payload = $request->validate([
            'prompt' => ['required', 'string', 'max:2000'],
            'history' => ['nullable', 'array'],
            'history.*.role' => ['required_with:history', 'string'],
            'history.*.content' => ['required_with:history', 'string'],
        ]);

        $prompt = $payload['prompt'];
        $history = $payload['history'] ?? [];

        // 1. DATA FAKULTAS
        $konteksFakultas = Fakultas::all()
            ->map(fn ($f) => ['nama' => $f->name_fakultas])
            ->toArray();

        // 2. DATA PROGRAM STUDI
        $konteksProdi = ProgramStudi::with('fakultas')
            ->get()
            ->map(fn ($p) => [
                'nama' => $p->nama_prodi,
                'fakultas' => optional($p->fakultas)->name_fakultas,
            ])
            ->toArray();

        // 3. DATA DOSEN
        $konteksDosen = Dosen::with('programStudi')
            ->get()
            ->map(fn ($d) => [
                'nama' => $d->nama,
                'nidn' => $d->nidn,
                'prodi' => optional($d->programStudi)->nama_prodi,
                'jabatan' => $d->jabatan,
                'email' => $d->email,
            ])
            ->toArray();

        // 4. DATA FAQ (Termasuk SPP & Biaya)
        $konteksFaq = Faq::active()
            ->get()
            ->map(fn ($f) => [
                'pertanyaan' => $f->pertanyaan,
                'jawaban' => $f->jawaban,
                'kategori' => $f->kategori,
            ])
            ->toArray();

        // 5. DATA MATA KULIAH
        $konteksMk = MataKuliah::with('programStudi')
            ->get()
            ->map(fn ($m) => [
                'kode' => $m->kode_mk,
                'nama' => $m->nama_mk,
                'sks' => $m->sks,
                'semester' => $m->semester,
                'prodi' => optional($m->programStudi)->nama_prodi,
            ])
            ->toArray();

        // 6. DATA KELAS
        $konteksKelas = Kelas::with(['mataKuliah', 'dosen'])
            ->get()
            ->map(fn ($k) => [
                'nama_kelas' => $k->nama_kelas,
                'mata_kuliah' => optional($k->mataKuliah)->nama_mk,
                'dosen' => optional($k->dosen)->nama,
                'tahun_ajaran' => $k->tahun_ajaran,
            ])
            ->toArray();

        // 7. DATA INFORMASI KAMPUS
        $konteksInfo = InformasiKampus::all()
            ->map(fn ($i) => ['key' => $i->key, 'value' => $i->value])
            ->toArray();

        // 8. DATA KALENDER AKADEMIK
        $konteksKalender = KalenderAkademik::all()
            ->map(fn ($k) => [
                'acara' => $k->acara,
                'mulai' => $k->tanggal_mulai->format('d M Y'),
                'selesai' => $k->tanggal_selesai?->format('d M Y'),
                'kategori' => $k->kategori,
            ])
            ->toArray();

        $konteksLog = $this->aiLearningService->findRelevantLogs($prompt);
        $konteksAlias = $this->aiLearningService->getAliasContext();
        $aiEndpoint = rtrim(config('services.fuzan_ai.url', 'http://localhost:3000'), '/').'/api/ai';

        try {
            $response = Http::timeout(60)->post($aiEndpoint, [
                'prompt' => $prompt,
                'history' => $history,
                'konteks_fakultas' => $konteksFakultas,
                'konteks_prodi' => $konteksProdi,
                'konteks_dosen' => $konteksDosen,
                'konteks_faq' => $konteksFaq,
                'konteks_mk' => $konteksMk,
                'konteks_kelas' => $konteksKelas,
                'konteks_info' => $konteksInfo,
                'konteks_kalender' => $konteksKalender,
                'konteks_log' => $konteksLog,
                'konteks_alias' => $konteksAlias,
            ]);

            if ($response->successful()) {
                $jawabanAi = $response->json()['result'] ?? null;

                $this->simpanLog($prompt, $jawabanAi);

                return response()->json(['success' => true, 'result' => $jawabanAi]);
            }

            return response()->json(['success' => false, 'message' => 'Gagal terhubung ke AI.'], 500);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Server AI offline.'], 500);
        }
    }

    private function simpanLog(string $pertanyaan, ?string $jawabanAi): AiQuestionLog
    {
        return $this->aiLearningService->logInteraction($pertanyaan, $jawabanAi);
    }
}
