<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            // Kolom Baru 1: Status apakah stok sudah dibuat
            $table->boolean('is_stok_generated')->default(false)->after('status');
            
            // Kolom Baru 2: Relasi ke item stok yang dihasilkan
            // Pastikan kolom ini bisa nullable, karena status awal 'menunggu' belum memiliki stok_pengepul_id
            $table->foreignId('stok_pengepul_id')->nullable()->constrained('stok_pengepul')->after('is_stok_generated');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            // Hapus foreign key terlebih dahulu
            $table->dropConstrainedForeignId('stok_pengepul_id');
            
            // Hapus kolom
            $table->dropColumn('is_stok_generated');
        });
    }
};