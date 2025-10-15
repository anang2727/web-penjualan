<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Pastikan ini ada di bagian atas

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Mendefinisikan daftar ENUM yang BARU (dengan menambahkan 'menunggu_pembayaran')
        $newEnums = ['menunggu_konfirmasi', 'menunggu_pembayaran', 'menunggu_verifikasi_pembayaran', 'diproses', 'dikirim', 'selesai', 'dibatalkan'];
        $enumString = '"' . implode('", "', $newEnums) . '"';

        // Mengubah kolom 'status' dengan perintah raw SQL
        // Ini cara paling andal untuk memodifikasi ENUM tanpa kehilangan data yang sudah ada.
        DB::statement("ALTER TABLE transaksi_pembelians CHANGE status status ENUM({$enumString}) NOT NULL DEFAULT 'menunggu_konfirmasi'");
    }

    /**
     * Reverse the migrations (opsional, untuk rollback).
     */
    public function down(): void
    {
        // Mengembalikan ke daftar ENUM lama (tanpa nilai baru)
        $oldEnums = ['menunggu_konfirmasi', 'diproses', 'dikirim', 'selesai', 'dibatalkan'];
        $enumString = '"' . implode('", "', $oldEnums) . '"';

        DB::statement("ALTER TABLE transaksi_pembelians CHANGE status status ENUM({$enumString}) NOT NULL DEFAULT 'menunggu_konfirmasi'");
    }
};