<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_term_aliases', function (Blueprint $table) {
            $table->id();
            $table->string('observed_term', 120);
            $table->string('canonical_term', 120);
            $table->string('category', 100)->default('Umum');
            $table->unsignedInteger('usage_count')->default(1);
            $table->unsignedTinyInteger('confidence_score')->default(0);
            $table->string('status', 20)->default('candidate');
            $table->string('source_example', 255)->nullable();
            $table->timestamp('last_seen_at')->nullable();
            $table->timestamps();

            $table->unique(['observed_term', 'canonical_term', 'category'], 'ai_term_aliases_unique');
            $table->index(['status', 'confidence_score'], 'ai_term_aliases_status_confidence_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_term_aliases');
    }
};
