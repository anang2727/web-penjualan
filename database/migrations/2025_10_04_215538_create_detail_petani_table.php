<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_petani', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->unique(); // Foreign key ke users.id
            
            // Data Kontak & Logistik Dasar
            $table->string('no_telepon'); 
            $table->string('email_opsional')->nullable(); // Opsional
            $table->text('alamat_lengkap'); // Input tunggal: Jalan, Desa, Kec, Kab, Prov, Kodepos
            $table->string('komoditas_utama')->nullable(); // Produk yang paling sering dijual (Opsional)

            // Data Pembayaran (Opsional untuk COD)
            $table->string('bank_nama')->nullable(); // Nama Bank
            $table->string('rekening_nomor')->nullable(); // Nomor Rekening
            $table->string('rekening_nama')->nullable(); // Nama Pemilik Rekening

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_petani');
    }
};