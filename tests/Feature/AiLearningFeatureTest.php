<?php

namespace Tests\Feature;

use App\Models\AiQuestionLog;
use App\Models\AiTermAlias;
use App\Models\Faq;
use App\Services\AiLearningService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Tests\TestCase;

class AiLearningFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_merges_similar_questions_and_increments_frequency(): void
    {
        $service = app(AiLearningService::class);
        $suffix = Str::lower(Str::random(6));
        $firstQuestion = "Berapa biaya kuliah paket {$suffix}?";
        $secondQuestion = "Biaya kuliah paket {$suffix} berapa?";

        $firstLog = $service->logInteraction($firstQuestion, 'Jawaban pertama');
        $secondLog = $service->logInteraction($secondQuestion, 'Jawaban kedua');
        $normalizedQuestion = $service->normalizeQuestion($firstQuestion);

        $this->assertSame($firstLog->id, $secondLog->id);
        $this->assertDatabaseHas('ai_question_logs', [
            'id' => $firstLog->id,
            'jumlah' => 2,
            'kategori_topik' => 'Biaya',
            'normalized_question' => $normalizedQuestion,
        ]);
        $this->assertSame(
            1,
            AiQuestionLog::query()->where('question_hash', hash('sha256', $normalizedQuestion))->count()
        );
    }

    public function test_it_understands_ukt_as_spp_and_learns_the_alias(): void
    {
        $service = app(AiLearningService::class);
        $suffix = Str::lower(Str::random(6));
        $question = "Berapa ukt paket {$suffix}?";

        $normalizedQuestion = $service->normalizeQuestion($question);
        $log = $service->logInteraction($question, 'Biaya tersedia di FAQ resmi.');

        $this->assertStringContainsString('spp', $normalizedQuestion);
        $this->assertDatabaseHas('ai_term_aliases', [
            'observed_term' => 'ukt',
            'canonical_term' => 'spp',
            'category' => 'Biaya',
        ]);
        $this->assertSame('Biaya', $log->kategori_topik);
    }

    public function test_it_creates_new_logs_for_different_topics(): void
    {
        $service = app(AiLearningService::class);
        $suffix = Str::lower(Str::random(6));

        $dosenLog = $service->logInteraction("Siapa dosen Teknik Informatika {$suffix}?", 'Jawaban dosen');
        $pendaftaranLog = $service->logInteraction("Bagaimana cara daftar kuliah {$suffix}?", 'Jawaban pendaftaran');

        $this->assertNotSame($dosenLog->id, $pendaftaranLog->id);
        $this->assertDatabaseHas('ai_question_logs', [
            'id' => $dosenLog->id,
            'kategori_topik' => 'Dosen',
        ]);
        $this->assertDatabaseHas('ai_question_logs', [
            'id' => $pendaftaranLog->id,
            'kategori_topik' => 'Pendaftaran',
        ]);
    }

    public function test_it_returns_relevant_logs_as_additional_context(): void
    {
        $service = app(AiLearningService::class);
        $suffix = Str::lower(Str::random(6));
        $question = "Berapa biaya kuliah kampus {$suffix}?";

        $log = $service->logInteraction($question, 'Biaya dapat dilihat di bagian keuangan.');
        $log->update([
            'status' => 'reviewed',
            'jumlah' => 4,
        ]);

        $relevantLogs = $service->findRelevantLogs("Biaya kuliah kampus {$suffix} berapa?");

        $this->assertCount(1, $relevantLogs);
        $this->assertSame('Biaya', $relevantLogs[0]['kategori']);
        $this->assertSame('reviewed', $relevantLogs[0]['status']);
        $this->assertSame($question, $relevantLogs[0]['pertanyaan']);
    }

    public function test_it_marks_frequent_answered_logs_as_suggested(): void
    {
        $service = app(AiLearningService::class);
        $suffix = Str::lower(Str::random(6));
        $question = "Bagaimana cara daftar kuliah {$suffix}?";

        $service->logInteraction($question, 'Jawaban pertama');
        $service->logInteraction("Cara daftar kuliah {$suffix} bagaimana?", 'Jawaban kedua');
        $log = $service->logInteraction("Bagaimana cara daftar kuliah {$suffix} online?", 'Jawaban ketiga');

        $this->assertSame(\App\Models\AiQuestionLog::STATUS_SUGGESTED, $log->status);
        $this->assertGreaterThanOrEqual(AiLearningService::MIN_AUTOMATION_CONFIDENCE, $log->confidence_score);
        $this->assertNotNull($log->suggested_at);
    }

    public function test_it_can_promote_suggested_log_to_active_faq(): void
    {
        $service = app(AiLearningService::class);
        $suffix = Str::lower(Str::random(6));
        $question = "Siapa dosen pembimbing {$suffix}?";

        $service->logInteraction($question, 'Silakan hubungi admin prodi.');
        $service->logInteraction("Dosen pembimbing {$suffix} siapa?", 'Silakan hubungi admin prodi.');
        $log = $service->logInteraction("Siapa dosen pembimbing {$suffix} untuk semester ini?", 'Silakan hubungi admin prodi.');

        $faq = $service->promoteLogToFaq($log, 'Silakan hubungi admin prodi.', 'Dosen');

        $this->assertDatabaseHas('faqs', [
            'id' => $faq->id,
            'pertanyaan' => $question,
            'kategori' => 'Dosen',
            'is_active' => 1,
        ]);
        $this->assertDatabaseHas('ai_question_logs', [
            'id' => $log->id,
            'status' => \App\Models\AiQuestionLog::STATUS_PROMOTED,
            'faq_id' => $faq->id,
        ]);
    }

    public function test_it_builds_dynamic_suggestions_from_logs_and_faqs(): void
    {
        $service = app(AiLearningService::class);
        $suffix = Str::lower(Str::random(6));
        $logQuestion = "Bagaimana cara daftar kuliah {$suffix}?";
        $faqQuestion = "Bagaimana cara menghubungi admin kampus {$suffix}?";

        AiQuestionLog::create([
            'pertanyaan_user' => $logQuestion,
            'normalized_question' => $service->normalizeQuestion($logQuestion),
            'question_hash' => hash('sha256', $service->normalizeQuestion($logQuestion)),
            'jawaban_ai' => 'Silakan cek pendaftaran.',
            'jumlah' => 6,
            'topik_ringkas' => 'Pendaftaran: Cara Daftar Kuliah',
            'kategori_topik' => 'Pendaftaran',
            'status' => 'reviewed',
            'last_seen_at' => now(),
        ]);

        Faq::create([
            'pertanyaan' => $faqQuestion,
            'jawaban' => 'Hubungi email resmi kampus.',
            'kategori' => 'Kontak',
            'is_active' => true,
        ]);

        $suggestions = $service->getSuggestedQuestions();

        $this->assertContains($logQuestion, $suggestions);
        $this->assertContains($faqQuestion, $suggestions);
        $this->assertCount(4, $suggestions);
    }

    public function test_ai_request_includes_relevant_log_context_and_dynamic_suggestions(): void
    {
        $service = app(AiLearningService::class);
        $suffix = Str::lower(Str::random(6));
        $question = "Berapa biaya kuliah kampus {$suffix}?";

        $log = $service->logInteraction($question, 'Silakan cek bagian keuangan kampus.');
        $log->update([
            'status' => 'reviewed',
            'jumlah' => 5,
        ]);

        Http::fake([
            'http://localhost:3000/api/ai' => Http::response([
                'result' => 'Berikut informasi biaya kuliah yang tersedia.',
            ]),
        ]);

        $this->get('/ai')
            ->assertOk()
            ->assertSee($question);

        $this->postJson('/ai/ask', [
            'prompt' => "Biaya kuliah kampus {$suffix} berapa?",
            'history' => [],
        ])->assertOk();

        Http::assertSent(function ($request) use ($question) {
            return $request->url() === 'http://localhost:3000/api/ai'
                && count($request['konteks_log']) === 1
                && $request['konteks_log'][0]['pertanyaan'] === $question;
        });
    }
}
