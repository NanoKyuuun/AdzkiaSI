<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Untuk amannya, kita gunakan change() tapi karena enum agak tricky di MySQL 
        // kita gunakan raw query jika perlu, namun Laravel 11 mendukungnya lebih baik.
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'dosen', 'mahasiswa'])->default('mahasiswa')->change();
        });

        // Update data lama: jika ada role 'user', ubah menjadi 'mahasiswa'
        DB::table('users')->where('role', 'user')->update(['role' => 'mahasiswa']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'user'])->default('user')->change();
        });
    }
};
