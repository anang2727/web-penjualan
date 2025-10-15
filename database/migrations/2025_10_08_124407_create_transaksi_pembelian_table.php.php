<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_pembelians', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke Pedagang (Pembeli)
            // Asumsi Pedagang adalah user
            $table->foreignId('pedagang_id')->constrained('users')->onDelete('cascade'); 
            
            // Relasi ke Postingan Dagangan (Barang yang dibeli)
            $table->foreignId('postingan_dagangan_id')->constrained('postingan_dagangans')->onDelete('cascade'); 
            
            // Relasi ke Pengepul (Penjual) - Dapat dari postingan
            $table->foreignId('pengepul_id')->constrained('users')->onDelete('cascade');
            
            $table->string('kode_transaksi')->unique();
            $table->decimal('kuantitas_pesanan', 10, 2); // Jumlah yang dipesan
            $table->string('satuan', 15);
            $table->decimal('harga_satuan', 15, 0); // Harga per satuan saat transaksi terjadi
            $table->decimal('total_harga', 15, 0);

            $table->enum('status', ['menunggu_konfirmasi', 'diproses', 'dikirim', 'selesai', 'dibatalkan'])
                  ->default('menunggu_konfirmasi');
            
            $table->text('catatan')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_pembelians');
    }
};