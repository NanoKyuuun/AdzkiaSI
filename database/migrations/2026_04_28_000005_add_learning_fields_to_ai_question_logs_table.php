<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ai_question_logs', function (Blueprint $table) {
            $table->string('normalized_question')->nullable()->after('pertanyaan_user');
            $table->string('question_hash', 64)->nullable()->after('normalized_question');
            $table->timestamp('last_seen_at')->nullable()->after('status');

            $table->index('normalized_question');
            $table->index('question_hash');
            $table->index('last_seen_at');
        });
    }

    public function down(): void
    {
        Schema::table('ai_question_logs', function (Blueprint $table) {
            $table->dropIndex(['normalized_question']);
            $table->dropIndex(['question_hash']);
            $table->dropIndex(['last_seen_at']);

            $table->dropColumn([
                'normalized_question',
                'question_hash',
                'last_seen_at',
            ]);
        });
    }
};
