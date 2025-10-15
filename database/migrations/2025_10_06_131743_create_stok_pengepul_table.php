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
        Schema::create('stok_pengepul', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke User (Pengepul) pemilik stok
            $table->foreignId('pengepul_id')->constrained('users'); // Asumsi user role 'pengepul'
            
            $table->string('nama_komoditas');
            
            // Kolom Stok Saat Ini (bisa menggunakan decimal atau int, tergantung presisi)
            // Menggunakan INT sesuai permintaan, tapi perlu diingat jika unitnya perlu desimal (misal: 1.5 kg)
            $table->integer('jumlah_stok_saat_ini')->default(0); 
            
            $table->string('satuan', 50);
            $table->dateTime('tanggal_masuk'); // Tanggal stok diterima
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_pengepul');
    }

    
};