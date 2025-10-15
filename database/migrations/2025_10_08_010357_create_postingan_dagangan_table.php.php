<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('postingan_dagangan', function (Blueprint $table) {
            $table->id();
            
            // Relasi
            $table->foreignId('pengepul_id')
                  ->constrained('users') // Pengepul dari tabel users
                  ->cascadeOnDelete();
                  
            $table->foreignId('stok_pengepul_id')
                  ->constrained('stok_pengepul') // Stok sumber inventaris
                  ->cascadeOnDelete();
            
            // Konten Postingan
            $table->string('judul_postingan', 255);
            $table->text('deskripsi')->nullable();
            $table->string('foto_postingan', 255)->nullable();
            
            // Detail Penjualan
            $table->decimal('harga_jual_satuan', 12, 2)->comment('Harga per satuan yang dipilih');
            $table->decimal('kuantitas_dijual', 10, 2);
            $table->decimal('minimum_order', 10, 2)->default(0);
            $table->string('satuan', 50)->comment('Satuan penjualan: Kg, Kuintal, Ton'); // Kolom seleksi
            $table->string('lokasi_stok', 255)->nullable();

            // Status
            $table->string('status')->default('draft'); // draft, aktif, habis, selesai
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('postingan_dagangan');
    }
};
