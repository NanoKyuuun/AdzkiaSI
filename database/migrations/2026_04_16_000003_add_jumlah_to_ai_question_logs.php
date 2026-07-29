<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ai_question_logs', function (Blueprint $table) {
            // Jumlah pertanyaan serupa yang muncul
            $table->unsignedInteger('jumlah')->default(1)->after('jawaban_ai');
            // Pertanyaan yang paling representatif (bisa diupdate jika jumlah terbaru lebih baik)
            $table->string('topik_ringkas', 255)->nullable()->after('jumlah');
        });
    }

    public function down(): void
    {
        Schema::table('ai_question_logs', function (Blueprint $table) {
            $table->dropColumn(['jumlah', 'topik_ringkas']);
        });
    }
};
