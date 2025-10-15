<?php

// database/migrations/XXXX_XX_XX_XXXXXX_add_deleted_at_to_postingan_dagangans_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('postingan_dagangans', function (Blueprint $table) {
            $table->softDeletes(); // <-- Ini menambahkan kolom 'deleted_at'
        });
    }

    public function down(): void
    {
        Schema::table('postingan_dagangans', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};