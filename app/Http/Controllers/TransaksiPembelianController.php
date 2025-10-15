<?php

namespace App\Http\Controllers;

use App\Models\PostinganDagangan;
use App\Models\TransaksiPembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransaksiPembelianController extends Controller
{
    /**
     * Menampilkan daftar semua pesanan (histori pembelian) Pedagang.
     */
    public function index()
    {
        $transaksiPembelian = TransaksiPembelian::where('pedagang_id', Auth::id())
            ->with('postinganDagangan')
            ->latest()
            ->paginate(15);

        return view('dashboard.pedagang.pesanan.index', compact('transaksiPembelian'));
    }
    
    /**
     * Menyimpan pesanan pembelian baru.
     */
    public function store(Request $request, PostinganDagangan $postingan)
    {
        // 1. Validasi Input
        $request->validate([
            'kuantitas_pesanan' => [
                'required',
                'numeric',
                'min:' . $postingan->minimum_order, // Minimal Order
                'max:' . $postingan->kuantitas_dijual, // Stok tersedia
            ],
            'catatan' => 'nullable|string|max:255',
        ], [
            'kuantitas_pesanan.max' => 'Kuantitas pesanan tidak boleh melebihi stok yang tersedia (' . number_format($postingan->kuantitas_dijual, 2) . ' ' . $postingan->satuan . ').',
            'kuantitas_pesanan.min' => 'Minimum order untuk produk ini adalah ' . number_format($postingan->minimum_order, 2) . ' ' . $postingan->satuan . '.',
        ]);

        // Cek lagi untuk menghindari race condition
        if ($request->kuantitas_pesanan > $postingan->kuantitas_dijual) {
            return back()->withErrors(['kuantitas_pesanan' => 'Stok tidak mencukupi saat ini.'])->withInput();
        }

        // 2. Hitung Total Harga
        $totalHarga = $request->kuantitas_pesanan * $postingan->harga_jual_satuan;

        // 3. Buat Transaksi
        // 🔥 PERUBAHAN #1: Simpan instance transaksi yang dibuat ke variabel
        $transaksi = TransaksiPembelian::create([
            'pedagang_id' => Auth::id(),
            'postingan_dagangan_id' => $postingan->id,
            'pengepul_id' => $postingan->pengepul_id,
            'kode_transaksi' => 'TRX-' . Str::upper(Str::random(6)), // Kode unik
            'kuantitas_pesanan' => $request->kuantitas_pesanan,
            'satuan' => $postingan->satuan,
            'harga_satuan' => $postingan->harga_jual_satuan,
            'total_harga' => $totalHarga,
            'catatan' => $request->catatan,
            // 🔥 PERUBAHAN #2: Ubah status awal dari 'menunggu_konfirmasi' menjadi 'menunggu_pembayaran'
            'status' => 'menunggu_pembayaran', 
        ]);

        // 4. Update Stok Postingan (kurangi kuantitas yang dijual)
        $postingan->decrement('kuantitas_dijual', $request->kuantitas_pesanan);

        // 5. Redirect ke detail pesanan
        // 🔥 PERUBAHAN #3: Arahkan langsung ke halaman detail (show) untuk menampilkan form pembayaran.
        return redirect()->route('dashboard.pedagang.pesanan.show', $transaksi) 
            ->with('success', 'Pesanan berhasil dibuat! Silakan segera unggah bukti pembayaran Anda.');
    }

    public function show(TransaksiPembelian $transaksiPembelian)
    {
        // 1. Otorisasi (Keamanan)
        // Memastikan pedagang yang login hanya melihat transaksinya sendiri
        if ($transaksiPembelian->pedagang_id !== Auth::id()) {
            abort(403, 'Akses Ditolak. Anda tidak memiliki hak untuk melihat pesanan ini.');
        }

        // 2. Muat Relasi (agar data Pengepul/Produk tersedia di view)
        $transaksiPembelian->load('postinganDagangan', 'pengepul');

        // 3. Kirim ke View
        return view('dashboard.pedagang.pesanan.show', compact('transaksiPembelian'));
    }

    public function uploadBuktiBayar(Request $request, TransaksiPembelian $transaksiPembelian)
    {
        if ($transaksiPembelian->pedagang_id !== Auth::id()) {
            abort(403);
        }

        // Cek hanya bisa upload jika statusnya menunggu_pembayaran
        if ($transaksiPembelian->status !== 'menunggu_pembayaran') {
            return back()->withErrors(['error' => 'Pembayaran tidak dapat diunggah. Status pesanan sudah di luar "Menunggu Pembayaran".']);
        }


        $request->validate([
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'catatan_pembayaran' => 'nullable|string|max:500',
        ]);

        // Simpan File
        // Pastikan Anda sudah menjalankan php artisan storage:link
        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        // Update Transaksi
        $transaksiPembelian->update([
            'bukti_pembayaran_path' => $path,
            'catatan_pembayaran' => $request->catatan_pembayaran,
            // --- STATUS BARU: Menunggu Verifikasi Pengepul ---
            'status' => 'menunggu_verifikasi_pembayaran',
        ]);

        return redirect()->route('dashboard.pedagang.pesanan.show', $transaksiPembelian)
            ->with('success', 'Bukti pembayaran berhasil diunggah! Pesanan Anda sekarang dalam status "Menunggu Verifikasi Pembayaran".');
    }
}