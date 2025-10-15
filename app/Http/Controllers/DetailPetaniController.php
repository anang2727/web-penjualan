<?php

namespace App\Http\Controllers;

use App\Models\DetailPetani;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DetailPetaniController extends Controller
{
    // Fungsi index dihilangkan karena Petani hanya mengelola satu profil.
    // Kita langsung alihkan ke create atau edit.
    // app/Http/Controllers/DetailPetaniController.php

    public function index()
    {
        $profil = Auth::user()->detailPetani;

        if ($profil) {
            // REDIRECT ke VIEW show.blade.php
            return redirect()->route('petani.datapetani.show', $profil);
        }

        // REDIRECT ke VIEW create.blade.php
        return redirect()->route('petani.datapetani.create');
    }

    // Fungsi create() TIDAK BOLEH MEMILIKI LOGIKA REDIRECT GANDA
    public function create()
    {
        // Lindungi dari akses langsung (optional, tapi baik)
        if (Auth::user()->detailPetani) {
            return redirect()->route('petani.datapetani.index');
        }

        return view('petani.datapetani.create');
    }

    /**
     * Menyimpan profil yang baru dibuat.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Cek jika profil sudah ada untuk menghindari duplikasi
        if ($user->detailPetani) {
            return redirect()->route('petani.datapetani.edit', $user->detailPetani)->with('error', 'Profil Anda sudah terdaftar. Silakan edit.');
        }

        $validated = $request->validate([
            'no_telepon' => 'required|string|max:15',
            'email_opsional' => 'nullable|email|max:255',
            'alamat_lengkap' => 'required|string',
            // --- Aturan Validasi Baru ---
            'komoditas_utama' => 'nullable|string|max:255',
            'bank_nama' => 'nullable|string|max:255',
            'rekening_nomor' => 'nullable|string|max:255',
            'rekening_nama' => 'nullable|string|max:255',
        ]);

        // Tambahkan user_id secara otomatis
        $validated['user_id'] = $user->id;

        DetailPetani::create($validated);

        return redirect()->route('dashboard')->with('success', 'Profil Petani berhasil disimpan!');
    }

    /**
     * Menampilkan form untuk mengedit profil.
     */
    public function edit(DetailPetani $detailPetani)
    {
        // Validasi kepemilikan: memastikan Petani hanya mengedit profilnya sendiri
        if ($detailPetani->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak. Anda tidak berhak mengedit profil ini.');
        }

        return view('petani.datapetani.edit', compact('detailPetani'));
    }


    public function show(DetailPetani $detailPetani)
    {
        // Validasi kepemilikan
        if ($detailPetani->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak.');
        }

        return view('petani.datapetani.show', compact('detailPetani'));
    }
    /**
     * Memperbarui profil yang sudah ada.
     */
    public function update(Request $request, DetailPetani $detailPetani)
    {
        // Validasi kepemilikan
        if ($detailPetani->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak.');
        }

        $validated = $request->validate([
            'no_telepon' => 'required|string|max:15',
            'email_opsional' => 'nullable|email|max:255',
            'alamat_lengkap' => 'required|string',
            // --- Aturan Validasi Baru ---
            'komoditas_utama' => 'nullable|string|max:255',
            'bank_nama' => 'nullable|string|max:255',
            'rekening_nomor' => 'nullable|string|max:255',
            'rekening_nama' => 'nullable|string|max:255',

        ]);

        $detailPetani->update($validated);

        return redirect()->route('dashboard')->with('success', 'Profil Petani berhasil diperbarui!');
    }

    /**
     * Menghapus profil. (Opsional, tapi disertakan)
     */
    public function destroy(DetailPetani $detailPetani)
    {
        if ($detailPetani->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak.');
        }

        $detailPetani->delete();

        return redirect()->route('dashboard')->with('success', 'Profil Petani berhasil dihapus.');
    }
}
