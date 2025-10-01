<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penawaran_id')->constrained('penawarans')->onDelete('cascade');
            $table->foreignId('petani_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_hasil');
            $table->integer('stok_ditawarkan');
            $table->date('tanggal_panen');
            $table->text('deskripsi');
            $table->string('foto')->nullable();
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};