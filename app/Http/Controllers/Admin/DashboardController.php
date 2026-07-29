<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AiQuestionLog;
use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use App\Services\AiLearningService;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct(private readonly AiLearningService $aiLearningService)
    {
    }

    public function index()
    {
        $stats = [
            'total_fakultas' => Fakultas::count(),
            'total_prodi' => ProgramStudi::count(),
            'total_dosen' => Dosen::count(),
            'total_pertanyaan_ai' => AiQuestionLog::count(),
        ];

        $learningStats = [
            'suggested' => AiQuestionLog::where('status', AiQuestionLog::STATUS_SUGGESTED)->count(),
            'pending_review' => AiQuestionLog::pendingReview()->count(),
            'high_confidence' => AiQuestionLog::pendingReview()
                ->where('confidence_score', '>=', AiLearningService::HIGH_CONFIDENCE_THRESHOLD)
                ->count(),
            'promoted' => AiQuestionLog::where('status', AiQuestionLog::STATUS_PROMOTED)->count(),
        ];

        $priorityLogs = $this->aiLearningService->getReviewableLogs(5);

        $topTopics = AiQuestionLog::query()
            ->select('kategori_topik', DB::raw('SUM(jumlah) as total'))
            ->groupBy('kategori_topik')
            ->orderByDesc('total')
            ->limit(4)
            ->get();

        return view('admin.dashboard', compact('stats', 'learningStats', 'priorityLogs', 'topTopics'));
    }
}
