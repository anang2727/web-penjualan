<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
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
        $request->validate([
            'penawaran_id' => 'required|exists:penawarans,id',
            'nama_hasil' => 'required|string|max:255',
            'stok_ditawarkan' => 'required|integer|min:1',
            'tanggal_panen' => 'required|date',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Pastikan user login & role petani
        if (!Auth::check() || Auth::user()->role !== 'petani') {
            return redirect()->back()->with('error', 'Anda tidak berhak mengajukan.');
        }

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengajuans', 'public');
        }

        Pengajuan::create([
            'penawaran_id' => $request->penawaran_id,
            'petani_id'    => Auth::id(), // ambil dari users.id
            'nama_hasil'   => $request->nama_hasil,
            'stok_ditawarkan' => $request->stok_ditawarkan,
            'tanggal_panen'   => $request->tanggal_panen,
            'deskripsi'    => $request->deskripsi,
            'foto'         => $fotoPath,
        ]);

        return redirect()->route('petani.penawaran.index')->with('success', 'Pengajuan berhasil dikirim.');
    }
}
