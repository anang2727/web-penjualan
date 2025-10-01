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
        Schema::create('penawarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengepul_id')->constrained('users')->cascadeOnDelete();
            $table->string('judul');
            $table->string('foto')->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('jumlah_kebutuhan');
            $table->decimal('harga_perkiraan', 12, 2)->nullable();
            $table->date('tanggal_batas')->nullable();
            $table->enum('status', ['aktif', 'selesai', 'dibatalkan'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penawarans');
    }
};
