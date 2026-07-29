<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AiQuestionLog;
use App\Models\Faq;
use App\Services\AiLearningService;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function __construct(private readonly AiLearningService $aiLearningService)
    {
    }

    /**
     * Tampilkan daftar FAQ + AI Learning Log
     */
    public function index()
    {
        $faqs = Faq::latest()->get();
        $logs = $this->aiLearningService->getReviewableLogs();

        $learningStats = [
            'total_logs' => AiQuestionLog::count(),
            'total_new' => AiQuestionLog::where('status', AiQuestionLog::STATUS_NEW)->count(),
            'total_suggested' => AiQuestionLog::where('status', AiQuestionLog::STATUS_SUGGESTED)->count(),
            'total_reviewed' => AiQuestionLog::where('status', AiQuestionLog::STATUS_REVIEWED)->count(),
            'total_promoted' => AiQuestionLog::where('status', AiQuestionLog::STATUS_PROMOTED)->count(),
            'high_confidence' => AiQuestionLog::pendingReview()
                ->where('confidence_score', '>=', AiLearningService::HIGH_CONFIDENCE_THRESHOLD)
                ->count(),
        ];

        return view('admin.faq.index', compact('faqs', 'logs', 'learningStats'));
    }

    /**
     * Simpan FAQ baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'jawaban' => 'required|string',
            'kategori' => 'required|string|max:100',
        ]);

        Faq::create([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
            'kategori' => $request->kategori,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.faq.index')
            ->with('success', 'FAQ berhasil ditambahkan! AI sudah bisa menggunakan jawaban ini.');
    }

    /**
     * Update FAQ yang ada
     */
    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'jawaban' => 'required|string',
            'kategori' => 'required|string|max:100',
        ]);

        $faq->update([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
            'kategori' => $request->kategori,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.faq.index')
            ->with('success', 'FAQ berhasil diperbarui!');
    }

    /**
     * Hapus FAQ
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faq.index')
            ->with('success', 'FAQ berhasil dihapus.');
    }

    /**
     * Toggle aktif/nonaktif FAQ
     */
    public function toggleActive(Faq $faq)
    {
        $faq->update(['is_active' => ! $faq->is_active]);
        $status = $faq->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('admin.faq.index')
            ->with('success', "FAQ berhasil {$status}.");
    }

    /**
     * Promote log pertanyaan menjadi FAQ baru / update FAQ aktif.
     */
    public function promoteLog(Request $request, AiQuestionLog $log)
    {
        $request->validate([
            'jawaban' => 'required|string',
            'kategori' => 'required|string|max:100',
        ]);

        $this->aiLearningService->promoteLogToFaq($log, $request->jawaban, $request->kategori);

        return redirect()->route('admin.faq.index', ['tab' => 'log'])
            ->with('success', 'Draft pertanyaan berhasil diterbitkan sebagai FAQ aktif.');
    }

    /**
     * One-click publish untuk log suggested yang sudah punya draft jawaban AI.
     */
    public function approveSuggestion(AiQuestionLog $log)
    {
        if (! filled($log->jawaban_ai)) {
            return redirect()
                ->route('admin.faq.index', ['tab' => 'log'])
                ->withErrors(['jawaban' => 'Draft jawaban AI belum tersedia untuk log ini.']);
        }

        $this->aiLearningService->promoteLogToFaq(
            $log,
            $log->jawaban_ai,
            $log->kategori_topik ?: 'Umum'
        );

        return redirect()->route('admin.faq.index', ['tab' => 'log'])
            ->with('success', 'Draft AI berhasil diterbitkan sebagai FAQ aktif.');
    }

    /**
     * Tandai log sebagai reviewed agar keluar dari antrian.
     */
    public function dismissLog(AiQuestionLog $log)
    {
        $log->update([
            'status' => AiQuestionLog::STATUS_REVIEWED,
            'suggested_at' => $log->suggested_at ?? now(),
        ]);

        return redirect()->route('admin.faq.index', ['tab' => 'log'])
            ->with('success', 'Log pertanyaan telah ditandai sebagai ditinjau.');
    }
}
