<?php

namespace App\Services;

use App\Models\AiQuestionLog;
use App\Models\Faq;
use App\Models\AiTermAlias;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class AiLearningService
{
    public const MIN_AUTOMATION_FREQUENCY = 3;
    public const MIN_AUTOMATION_CONFIDENCE = 65;
    public const HIGH_CONFIDENCE_THRESHOLD = 80;
    public const MIN_RETRIEVAL_CONFIDENCE = 55;

    private const STATIC_SUGGESTIONS = [
        'Siapa saja dosen di kampus ini?',
        'Apa saja program studi yang tersedia?',
        'Bagaimana cara mendaftar di kampus ini?',
        'Bagaimana cara menghubungi admin kampus?',
    ];

    private const STOP_WORDS = [
        'ada',
        'adalah',
        'adakah',
        'apa',
        'apakah',
        'bagaimana',
        'bahwa',
        'baru',
        'berapa',
        'bisa',
        'buat',
        'dan',
        'dengan',
        'di',
        'dimana',
        'gimana',
        'ini',
        'itu',
        'kah',
        'kampus',
        'ke',
        'kok',
        'lagi',
        'mau',
        'mohon',
        'pada',
        'para',
        'saja',
        'saya',
        'sebuah',
        'seperti',
        'sih',
        'tentang',
        'terkait',
        'tolong',
        'untuk',
        'yang',
    ];

    private const SYNONYM_MAP = [
        'biaya kuliah' => 'spp',
        'biaya semester' => 'spp',
        'uang kuliah' => 'spp',
        'uang semester' => 'spp',
        'ukt' => 'spp',
        'jurusan' => 'program studi',
        'prodi' => 'program studi',
        'pengajar' => 'dosen',
        'pak dosen' => 'dosen',
        'bu dosen' => 'dosen',
    ];

    private const CATEGORY_CANONICAL_TERMS = [
        'Biaya' => 'spp',
        'Program Studi' => 'program studi',
        'Dosen' => 'dosen',
        'Pendaftaran' => 'pendaftaran',
        // 'Mahasiswa' => 'mahasiswa',
        'Akademik' => 'krs',
        'Kontak' => 'kontak',
        'Fasilitas' => 'fasilitas',
    ];

    private const NON_ALIAS_TERMS = [
        'admin',
        'akademik',
        'aplikasi',
        'bayar',
        'beasiswa',
        'biaya',
        'cara',
        'daftar',
        'dosen',
        'email',
        'fakultas',
        'fasilitas',
        'hubungi',
        'informasi',
        'jadwal',
        'jawaban',
        'kampus',
        'kelas',
        'kontak',
        'kuliah',
        'krs',
        'mahasiswa',
        'online',
        'pembayaran',
        'pendaftaran',
        'prodi',
        'program',
        'semester',
        'spp',
        'studi',
        'tagihan',
        'uang',
    ];

    private ?array $dynamicAliasMap = null;

    public function __construct(private readonly TopicClassifier $topicClassifier)
    {
    }

    public function logInteraction(string $question, ?string $answer): AiQuestionLog
    {
        $rawPreparedQuestion = $this->prepareQuestion($question, false);
        $preparedQuestion = $this->applySynonyms($rawPreparedQuestion);
        $normalizedQuestion = $this->normalizePreparedQuestion($preparedQuestion);
        $questionHash = hash('sha256', $normalizedQuestion);
        $category = $this->topicClassifier->classify($question, $preparedQuestion);
        $topicSummary = $this->topicClassifier->summarize($question, $category, $preparedQuestion);
        $confidenceScore = $this->calculateConfidenceScore(
            1,
            $category,
            $answer !== null && trim($answer) !== '',
            $normalizedQuestion
        );

        $this->learnAliasesFromQuestion($question, $rawPreparedQuestion, $category);
        $existingLog = $this->findExistingLog($normalizedQuestion, $category);

        if ($existingLog !== null) {
            $existingLog->fill([
                'normalized_question' => $normalizedQuestion,
                'question_hash' => $questionHash,
                'jumlah' => max(1, (int) $existingLog->jumlah) + 1,
                'topik_ringkas' => $topicSummary,
                'kategori_topik' => $category,
                'last_seen_at' => now(),
            ]);

            if ($answer !== null && $existingLog->status !== 'promoted') {
                $existingLog->jawaban_ai = $answer;
            }

            $this->applyAutomationState($existingLog, $normalizedQuestion);
            $existingLog->save();

            return $existingLog->refresh();
        }

        $log = AiQuestionLog::create([
            'pertanyaan_user' => $question,
            'normalized_question' => $normalizedQuestion,
            'question_hash' => $questionHash,
            'jawaban_ai' => $answer,
            'jumlah' => 1,
            'topik_ringkas' => $topicSummary,
            'kategori_topik' => $category,
            'status' => AiQuestionLog::STATUS_NEW,
            'confidence_score' => $confidenceScore,
            'last_seen_at' => now(),
        ]);

        $this->applyAutomationState($log, $normalizedQuestion);
        $log->save();

        return $log->refresh();
    }

    public function promoteLogToFaq(AiQuestionLog $log, string $answer, ?string $category = null): Faq
    {
        $category ??= $log->kategori_topik ?: 'Umum';

        $faq = $log->faq ?? Faq::firstOrNew([
            'pertanyaan' => $log->pertanyaan_user,
        ]);

        $faq->fill([
            'pertanyaan' => $log->pertanyaan_user,
            'jawaban' => $answer,
            'kategori' => $category,
            'is_active' => true,
        ]);
        $faq->save();

        $log->fill([
            'jawaban_ai' => $answer,
            'kategori_topik' => $category,
            'status' => AiQuestionLog::STATUS_PROMOTED,
            'faq_id' => $faq->id,
            'confidence_score' => max((int) $log->confidence_score, self::HIGH_CONFIDENCE_THRESHOLD),
            'suggested_at' => $log->suggested_at ?? now(),
            'last_seen_at' => now(),
        ]);
        $log->save();

        return $faq;
    }

    public function getReviewableLogs(int $limit = 50): Collection
    {
        return AiQuestionLog::query()
            ->pendingReview()
            ->orderByRaw("CASE WHEN status = ? THEN 0 ELSE 1 END", [AiQuestionLog::STATUS_SUGGESTED])
            ->orderByDesc('confidence_score')
            ->orderByDesc('jumlah')
            ->orderByDesc('last_seen_at')
            ->limit($limit)
            ->get();
    }

    public function getAliasContext(int $limit = 20): array
    {
        $aliases = collect();

        foreach (self::SYNONYM_MAP as $observed => $canonical) {
            $aliases->push([
                'observed_term' => $observed,
                'canonical_term' => $canonical,
                'category' => $this->guessAliasCategory($canonical),
                'status' => 'built_in',
                'confidence_score' => 100,
            ]);
        }

        $dynamicAliases = AiTermAlias::query()
            ->whereIn('status', [AiTermAlias::STATUS_APPROVED, AiTermAlias::STATUS_CANDIDATE])
            ->orderByRaw("CASE WHEN status = ? THEN 0 ELSE 1 END", [AiTermAlias::STATUS_APPROVED])
            ->orderByDesc('confidence_score')
            ->orderByDesc('usage_count')
            ->limit($limit)
            ->get();

        foreach ($dynamicAliases as $alias) {
            $aliases->push([
                'observed_term' => $alias->observed_term,
                'canonical_term' => $alias->canonical_term,
                'category' => $alias->category,
                'status' => $alias->status,
                'confidence_score' => (int) $alias->confidence_score,
            ]);
        }

        return $aliases
            ->unique(fn (array $alias) => $alias['observed_term'].'|'.$alias['canonical_term'])
            ->take($limit)
            ->values()
            ->all();
    }

    public function findRelevantLogs(string $question, int $limit = 3): array
    {
        $preparedQuestion = $this->prepareQuestion($question);
        $normalizedQuestion = $this->normalizePreparedQuestion($preparedQuestion);
        $category = $this->topicClassifier->classify($question, $preparedQuestion);

        $candidates = AiQuestionLog::query()
            ->whereNotNull('jawaban_ai')
            ->where(function ($query) {
                $query->whereIn('status', [
                    AiQuestionLog::STATUS_SUGGESTED,
                    AiQuestionLog::STATUS_REVIEWED,
                    AiQuestionLog::STATUS_PROMOTED,
                ])
                    ->orWhere(function ($subQuery) {
                        $subQuery->where('status', AiQuestionLog::STATUS_NEW)
                            ->where('jumlah', '>=', self::MIN_AUTOMATION_FREQUENCY)
                            ->where('confidence_score', '>=', self::MIN_RETRIEVAL_CONFIDENCE);
                    });
            })
            ->when($category !== 'Umum', function ($query) use ($category) {
                $query->where(function ($subQuery) use ($category) {
                    $subQuery->where('kategori_topik', $category)
                        ->orWhereNull('kategori_topik');
                });
            })
            ->orderByDesc('jumlah')
            ->orderByDesc('last_seen_at')
            ->limit(30)
            ->get();

        return $candidates
            ->map(function (AiQuestionLog $log) use ($normalizedQuestion) {
                $candidateQuestion = $log->normalized_question
                    ?: $this->normalizeQuestion($log->pertanyaan_user);

                $score = $this->scoreSimilarity($normalizedQuestion, $candidateQuestion);
                $rank = ($score * 100)
                    + ($this->statusWeight($log->status) * 10)
                    + min((int) $log->jumlah, 9)
                    + min((int) $log->confidence_score, 100) / 5;

                return [
                    'log' => $log,
                    'score' => $score,
                    'rank' => $rank,
                ];
            })
            ->filter(fn (array $entry) => $entry['score'] >= 0.55)
            ->sortByDesc('rank')
            ->unique(fn (array $entry) => $entry['log']->question_hash ?: 'log-'.$entry['log']->id)
            ->take($limit)
            ->map(fn (array $entry) => [
                'pertanyaan' => $entry['log']->pertanyaan_user,
                'jawaban' => $entry['log']->jawaban_ai,
                    'kategori' => $entry['log']->kategori_topik ?: 'Umum',
                    'jumlah' => (int) $entry['log']->jumlah,
                    'status' => $entry['log']->status,
                    'confidence_score' => (int) $entry['log']->confidence_score,
                    'topik_ringkas' => $entry['log']->topik_ringkas,
                ])
            ->values()
            ->all();
    }

    public function getSuggestedQuestions(int $limit = 4): array
    {
        $suggestions = collect();

        $popularLogs = AiQuestionLog::query()
            ->whereNotNull('pertanyaan_user')
            ->whereIn('status', [
                AiQuestionLog::STATUS_SUGGESTED,
                AiQuestionLog::STATUS_REVIEWED,
                AiQuestionLog::STATUS_PROMOTED,
            ])
            ->orderByDesc('confidence_score')
            ->orderByDesc('jumlah')
            ->orderByDesc('last_seen_at')
            ->limit($limit * 3)
            ->get(['pertanyaan_user']);

        foreach ($popularLogs as $log) {
            $suggestions = $this->appendSuggestion($suggestions, $log->pertanyaan_user, $limit);
        }

        $activeFaqs = Faq::active()
            ->latest()
            ->limit($limit * 3)
            ->get(['pertanyaan']);

        foreach ($activeFaqs as $faq) {
            $suggestions = $this->appendSuggestion($suggestions, $faq->pertanyaan, $limit);
        }

        foreach (self::STATIC_SUGGESTIONS as $fallbackSuggestion) {
            $suggestions = $this->appendSuggestion($suggestions, $fallbackSuggestion, $limit);
        }

        return $suggestions->take($limit)->values()->all();
    }

    public function normalizeQuestion(string $question): string
    {
        return $this->normalizePreparedQuestion($this->prepareQuestion($question));
    }

    private function appendSuggestion(Collection $suggestions, string $suggestion, int $limit): Collection
    {
        $suggestion = trim($suggestion);

        if ($suggestion === '' || $suggestions->count() >= $limit) {
            return $suggestions;
        }

        $normalizedSuggestion = $this->normalizeQuestion($suggestion);

        if ($normalizedSuggestion === '') {
            return $suggestions;
        }

        if ($suggestions->contains(fn (string $existing) => $this->normalizeQuestion($existing) === $normalizedSuggestion)) {
            return $suggestions;
        }

        return $suggestions->push($suggestion);
    }

    private function findExistingLog(string $normalizedQuestion, string $category): ?AiQuestionLog
    {
        $exactMatch = AiQuestionLog::query()
            ->where('normalized_question', $normalizedQuestion)
            ->orWhere('question_hash', hash('sha256', $normalizedQuestion))
            ->first();

        if ($exactMatch !== null) {
            return $exactMatch;
        }

        $candidates = AiQuestionLog::query()
            ->when($category !== 'Umum', fn ($query) => $query->where('kategori_topik', $category))
            ->orderByDesc('jumlah')
            ->orderByDesc('last_seen_at')
            ->limit(40)
            ->get();

        $bestMatch = $candidates
            ->map(function (AiQuestionLog $candidate) use ($normalizedQuestion) {
                $candidateQuestion = $candidate->normalized_question
                    ?: $this->normalizeQuestion($candidate->pertanyaan_user);

                return [
                    'log' => $candidate,
                    'score' => $this->scoreSimilarity($normalizedQuestion, $candidateQuestion),
                ];
            })
            ->sortByDesc('score')
            ->first();

        if (($bestMatch['score'] ?? 0) >= 0.72) {
            return $bestMatch['log'];
        }

        return null;
    }

    private function prepareQuestion(string $question, bool $applySynonyms = true): string
    {
        $preparedQuestion = Str::lower(trim($question));
        $preparedQuestion = preg_replace('/[^\pL\pN\s]/u', ' ', $preparedQuestion) ?? $preparedQuestion;

        $preparedQuestion = preg_replace('/\s+/u', ' ', trim($preparedQuestion)) ?? trim($preparedQuestion);

        if (! $applySynonyms) {
            return $preparedQuestion;
        }

        return $this->applySynonyms($preparedQuestion);
    }

    private function applySynonyms(string $preparedQuestion): string
    {
        $aliasMap = array_merge(self::SYNONYM_MAP, $this->getDynamicAliasMap());
        uksort($aliasMap, fn (string $left, string $right) => strlen($right) <=> strlen($left));

        foreach ($aliasMap as $from => $to) {
            $preparedQuestion = preg_replace(
                '/\b'.preg_quote($from, '/').'\b/u',
                $to,
                $preparedQuestion
            ) ?? $preparedQuestion;
        }

        return preg_replace('/\s+/u', ' ', trim($preparedQuestion)) ?? trim($preparedQuestion);
    }

    private function normalizePreparedQuestion(string $preparedQuestion): string
    {
        $tokens = array_values(array_filter(
            explode(' ', $preparedQuestion),
            fn (string $token) => $token !== '' && ! in_array($token, self::STOP_WORDS, true)
        ));

        $tokens = array_values(array_unique($tokens));
        sort($tokens);

        return implode(' ', $tokens);
    }

    private function applyAutomationState(AiQuestionLog $log, string $normalizedQuestion): void
    {
        $hasAnswer = $log->jawaban_ai !== null && trim($log->jawaban_ai) !== '';

        $log->confidence_score = $this->calculateConfidenceScore(
            max(1, (int) $log->jumlah),
            $log->kategori_topik ?: 'Umum',
            $hasAnswer,
            $normalizedQuestion
        );

        if (in_array($log->status, [
            AiQuestionLog::STATUS_REVIEWED,
            AiQuestionLog::STATUS_PROMOTED,
        ], true)) {
            return;
        }

        $shouldBeSuggested = $hasAnswer
            && (int) $log->jumlah >= self::MIN_AUTOMATION_FREQUENCY
            && (int) $log->confidence_score >= self::MIN_AUTOMATION_CONFIDENCE;

        if ($shouldBeSuggested) {
            if ($log->status !== AiQuestionLog::STATUS_SUGGESTED) {
                $log->suggested_at = now();
            }

            $log->status = AiQuestionLog::STATUS_SUGGESTED;

            return;
        }

        $log->status = AiQuestionLog::STATUS_NEW;
        $log->suggested_at = null;
    }

    private function calculateConfidenceScore(
        int $frequency,
        string $category,
        bool $hasAnswer,
        string $normalizedQuestion
    ): int {
        $tokens = array_values(array_filter(explode(' ', trim($normalizedQuestion))));
        $specificityBoost = min(count($tokens) * 4, 16);
        $frequencyBoost = min($frequency * 12, 42);
        $categoryBoost = $category !== 'Umum' ? 14 : 6;
        $answerBoost = $hasAnswer ? 22 : 0;
        $score = 8 + $specificityBoost + $frequencyBoost + $categoryBoost + $answerBoost;

        return max(0, min(100, $score));
    }

    private function learnAliasesFromQuestion(string $question, string $preparedQuestion, string $category): void
    {
        $canonicalTerm = self::CATEGORY_CANONICAL_TERMS[$category] ?? null;

        if ($canonicalTerm === null) {
            return;
        }

        $candidates = $this->extractAliasCandidates($preparedQuestion, $canonicalTerm);

        foreach ($candidates as $candidate) {
            $alias = AiTermAlias::firstOrNew([
                'observed_term' => $candidate,
                'canonical_term' => $canonicalTerm,
                'category' => $category,
            ]);

            $alias->usage_count = max(0, (int) $alias->usage_count) + 1;
            $alias->source_example = $question;
            $alias->last_seen_at = now();
            $alias->confidence_score = $this->calculateAliasConfidenceScore($candidate, $category, (int) $alias->usage_count);
            $alias->status = $alias->confidence_score >= 70 && $alias->usage_count >= 2
                ? AiTermAlias::STATUS_APPROVED
                : AiTermAlias::STATUS_CANDIDATE;
            $alias->save();
        }

        if ($candidates !== []) {
            $this->dynamicAliasMap = null;
        }
    }

    private function extractAliasCandidates(string $preparedQuestion, string $canonicalTerm): array
    {
        $tokens = array_values(array_filter(
            explode(' ', $preparedQuestion),
            fn (string $token) => $token !== ''
        ));

        $candidates = [];

        foreach ($tokens as $token) {
            if ($token === $canonicalTerm) {
                continue;
            }

            if (in_array($token, self::STOP_WORDS, true) || in_array($token, self::NON_ALIAS_TERMS, true)) {
                continue;
            }

            if (! preg_match('/^\pL{2,6}$/u', $token)) {
                continue;
            }

            $candidates[] = $token;
        }

        return array_values(array_unique($candidates));
    }

    private function calculateAliasConfidenceScore(string $candidate, string $category, int $usageCount): int
    {
        $isAcronymLike = mb_strlen($candidate) <= 5 ? 22 : 10;
        $usageBoost = min($usageCount * 18, 54);
        $categoryBoost = $category !== 'Umum' ? 12 : 6;
        $score = 8 + $isAcronymLike + $usageBoost + $categoryBoost;

        return max(0, min(100, $score));
    }

    private function getDynamicAliasMap(): array
    {
        if ($this->dynamicAliasMap !== null) {
            return $this->dynamicAliasMap;
        }

        return $this->dynamicAliasMap = AiTermAlias::active()
            ->pluck('canonical_term', 'observed_term')
            ->all();
    }

    private function guessAliasCategory(string $canonicalTerm): string
    {
        $category = array_search($canonicalTerm, self::CATEGORY_CANONICAL_TERMS, true);

        return is_string($category) ? $category : 'Umum';
    }

    private function scoreSimilarity(string $left, string $right): float
    {
        if ($left === '' || $right === '') {
            return 0.0;
        }

        if ($left === $right) {
            return 1.0;
        }

        similar_text($left, $right, $percent);

        $leftTokens = explode(' ', $left);
        $rightTokens = explode(' ', $right);
        $intersection = array_intersect($leftTokens, $rightTokens);
        $union = array_unique(array_merge($leftTokens, $rightTokens));
        $jaccard = count($union) > 0 ? count($intersection) / count($union) : 0.0;

        return (($percent / 100) * 0.55) + ($jaccard * 0.45);
    }

    private function statusWeight(string $status): int
    {
        return match ($status) {
            AiQuestionLog::STATUS_PROMOTED => 4,
            AiQuestionLog::STATUS_SUGGESTED => 3,
            AiQuestionLog::STATUS_REVIEWED => 2,
            default => 1,
        };
    }
}
