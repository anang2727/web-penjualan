<?php

namespace App\Http\Controllers;

use App\Models\DetailPedagang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class DetailPedagangController extends Controller
{
    public function index()
    {
        $profil = Auth::user()->detailPedagang;

        if ($profil) {
            // REDIRECT ke VIEW show.blade.php
            return redirect()->route('dashboard.pedagang.show', $profil);
        }

        // REDIRECT ke VIEW create.blade.php
        return redirect()->route('dashboard.pedagang.create');
    }

    // Fungsi create() TIDAK BOLEH MEMILIKI LOGIKA REDIRECT GANDA
    public function create()
    {
        // Lindungi dari akses langsung (optional, tapi baik)
        if (Auth::user()->detailPedagang) {
            return redirect()->route('dashboard.pedagang.index');
        }

        return view('dashboard.pedagang.create');
    }

    /**
     * Menyimpan profil yang baru dibuat.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Cek jika profil sudah ada untuk menghindari duplikasi
        if ($user->detailPedagang) {
            return redirect()->route('dashboard.pedagang.edit', $user->detailPedagang)->with('error', 'Profil Anda sudah terdaftar. Silakan edit.');
        }

        $validated = $request->validate([
            'no_telepon' => 'required|string|max:15',
            'emaill' => 'nullable|email|max:255',
            'alamat_lengkap' => 'required|string',
            // --- Aturan Validasi Baru ---
            'bank_nama' => 'nullable|string|max:255',
            'rekening_nomor' => 'nullable|string|max:255',
            'rekening_nama' => 'nullable|string|max:255',
        ]);

        // Tambahkan user_id secara otomatis
        $validated['user_id'] = $user->id;

        DetailPedagang::create($validated);

        return redirect()->route('dashboard')->with('success', 'Profil pedagang berhasil disimpan!');
    }

    /**
     * Menampilkan form untuk mengedit profil.
     */
    public function edit(DetailPedagang $detailPedagang)
    {
        // Validasi kepemilikan: memastikan pedagang hanya mengedit profilnya sendiri
        if ($detailPedagang->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak. Anda tidak berhak mengedit profil ini.');
        }

        return view('dashboard.pedagang.edit', compact('detailPedagang'));
    }


    public function show(DetailPedagang $detailPedagang)
    {
        // Validasi kepemilikan
        if ($detailPedagang->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak.');
        }

        return view('dashboard.pedagang.show', compact('detailPedagang'));
    }
    /**
     * Memperbarui profil yang sudah ada.
     */
    public function update(Request $request, DetailPedagang $detailPedagang)
    {
        // Validasi kepemilikan
        if ($detailPedagang->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak.');
        }

        $validated = $request->validate([
            'no_telepon' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'alamat_lengkap' => 'required|string',
            // --- Aturan Validasi Baru ---
            'bank_nama' => 'nullable|string|max:255',
            'rekening_nomor' => 'nullable|string|max:255',
            'rekening_nama' => 'nullable|string|max:255',

        ]);

        $detailPedagang->update($validated);

        return redirect()->route('dashboard')->with('success', 'Profil pedagang berhasil diperbarui!');
    }

    /**
     * Menghapus profil. (Opsional, tapi disertakan)
     */
    public function destroy(DetailPedagang $detailPedagang)
    {
        if ($detailPedagang->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak.');
        }

        $detailPedagang->delete();

        return redirect()->route('dashboard')->with('success', 'Profil pedagang berhasil dihapus.');
    }
}
