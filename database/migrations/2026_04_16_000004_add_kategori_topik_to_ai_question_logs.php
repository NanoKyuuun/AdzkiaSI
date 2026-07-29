<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ai_question_logs', function (Blueprint $table) {
            // Kategori topik untuk grouping (satu baris per topik)
            $table->string('kategori_topik', 100)->default('Umum')->after('topik_ringkas');
        });
    }

    public function down(): void
    {
        Schema::table('ai_question_logs', function (Blueprint $table) {
            $table->dropColumn('kategori_topik');
        });
    }
};
