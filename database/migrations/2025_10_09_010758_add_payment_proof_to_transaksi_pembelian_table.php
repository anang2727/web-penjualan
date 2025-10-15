<?php

// File: database/migrations/XXXX_XX_XX_XXXXXX_add_payment_proof_to_transaksi_pembelian_table.php

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
        Schema::table('transaksi_pembelians', function (Blueprint $table) {
            // Kolom untuk menyimpan path file bukti pembayaran
            $table->string('bukti_pembayaran_path')->nullable()->after('status');
            
            // Kolom untuk menyimpan catatan dari pedagang
            $table->text('catatan_pembayaran')->nullable()->after('bukti_pembayaran_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_pembelians', function (Blueprint $table) {
            $table->dropColumn('catatan_pembayaran');
            $table->dropColumn('bukti_pembayaran_path');
        });
    }
};