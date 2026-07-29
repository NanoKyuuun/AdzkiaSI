<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_question_logs', function (Blueprint $table) {
            $table->id();
            $table->text('pertanyaan_user');
            $table->text('jawaban_ai')->nullable();
            $table->enum('status', ['new', 'reviewed', 'promoted'])->default('new');
            $table->foreignId('faq_id')->nullable()->constrained('faqs')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_question_logs');
    }
};
