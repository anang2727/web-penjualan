<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Penawaran; // Pastikan import Model Penawaran
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuans = Pengajuan::with('penawaran')
            ->where('petani_id', Auth::id())
            ->latest()
            ->get();

        return view('petani.pengajuan.index', compact('pengajuans'));
    }

    public function store(Request $request)
    {
        // 1. Ambil data penawaran dulu untuk validasi stok
        $penawaran = Penawaran::findOrFail($request->penawaran_id);

        // 2. Gabungkan semua validasi di sini
        $request->validate([
            'penawaran_id' => 'required|exists:penawarans,id',
            'nama_hasil' => 'required|string|max:255',
            'stok_ditawarkan' => [
                'required',
                'integer',
                'min:1',
                'max:' . $penawaran->jumlah_kebutuhan, // Sekarang variabel $penawaran sudah ada
            ],
            'tanggal_panen' => 'required|date',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            // Pesan error custom agar petani tidak bingung
            'stok_ditawarkan.max' => 'Jumlah ditawarkan melebihi sisa kebutuhan (' . $penawaran->jumlah_kebutuhan . ' kg).',
        ]);

        // 3. Cek Role (Sudah benar)
        if (!Auth::check() || Auth::user()->role !== 'petani') {
            return redirect()->back()->with('error', 'Anda tidak berhak mengajukan.');
        }

        // 4. Proses Foto
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengajuans', 'public');
        }

        // 5. Simpan Data
        Pengajuan::create([
            'penawaran_id' => $request->penawaran_id,
            'petani_id'    => Auth::id(),
            'nama_hasil'   => $request->nama_hasil,
            'stok_ditawarkan' => $request->stok_ditawarkan,
            'tanggal_panen'   => $request->tanggal_panen,
            'deskripsi'    => $request->deskripsi,
            'foto'         => $fotoPath,
            'status'       => 'menunggu', // Pastikan default statusnya menunggu
        ]);

        return redirect()->route('petani.penawaran.index')->with('success', 'Pengajuan berhasil dikirim.');
    }
}
