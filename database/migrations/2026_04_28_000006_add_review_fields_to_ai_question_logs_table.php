<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ai_question_logs', function (Blueprint $table) {
            $table->unsignedTinyInteger('confidence_score')->default(0)->after('status');
            $table->timestamp('suggested_at')->nullable()->after('last_seen_at');

            $table->index(['status', 'confidence_score']);
            $table->index('suggested_at');
        });

        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE ai_question_logs MODIFY status VARCHAR(20) NOT NULL DEFAULT 'new'");
        }

        $logs = DB::table('ai_question_logs')
            ->select('id', 'jumlah', 'kategori_topik', 'jawaban_ai', 'status', 'updated_at')
            ->get();

        foreach ($logs as $log) {
            $frequency = max(1, (int) ($log->jumlah ?? 1));
            $answerBoost = filled($log->jawaban_ai) ? 22 : 0;
            $categoryBoost = ($log->kategori_topik ?? 'Umum') !== 'Umum' ? 14 : 6;
            $statusBoost = match ($log->status) {
                'promoted' => 20,
                'reviewed' => 10,
                default => 0,
            };

            $confidence = max(0, min(100, 8 + min($frequency * 12, 42) + $answerBoost + $categoryBoost + $statusBoost));

            DB::table('ai_question_logs')
                ->where('id', $log->id)
                ->update([
                    'confidence_score' => $confidence,
                    'last_seen_at' => $log->updated_at,
                ]);
        }
    }

    public function down(): void
    {
        DB::table('ai_question_logs')
            ->where('status', 'suggested')
            ->update(['status' => 'reviewed']);

        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE ai_question_logs MODIFY status ENUM('new', 'reviewed', 'promoted') NOT NULL DEFAULT 'new'");
        }

        Schema::table('ai_question_logs', function (Blueprint $table) {
            $table->dropIndex(['status', 'confidence_score']);
            $table->dropIndex(['suggested_at']);

            $table->dropColumn([
                'confidence_score',
                'suggested_at',
            ]);
        });
    }
};
