<?php

namespace App\Http\Controllers;

use App\Models\HasilPertanian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasilPertanianController extends Controller
{
    protected function getAuthIdOrAbort()
    {
        // Pastikan guard punya method id(), dan user ter-auth
        $guard = Auth::guard();

        if (! method_exists($guard, 'id')) {
            abort(500, 'Auth guard tidak mendukung method id(). Guard class: ' . get_class($guard));
        }

        $userId = Auth::id(); // aman: pakai facade
        if (! $userId) {
            abort(403, 'User tidak terautentikasi (session/guard bermasalah).');
        }

        return $userId;
    }

    public function index()
    {
        $userId = $this->getAuthIdOrAbort();

        $hasil = HasilPertanian::where('petani_id', $userId)->get();
        return view('hasil.index', compact('hasil'));
    }

    public function create()
    {
        $this->getAuthIdOrAbort();
        return view('hasil.create');
    }

    public function store(Request $request)
    {
        $this->getAuthIdOrAbort();

        $data = $request->validate([
            'nama_hasil' => 'required|string|max:255',
            'stok' => 'required|integer',
            'tanggal_panen' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('hasil-pertanian', 'public');
        }

        $data['petani_id'] = Auth::id();

        HasilPertanian::create($data);

        return redirect()->route('hasil.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(HasilPertanian $hasil)
    {
        $userId = $this->getAuthIdOrAbort();

        if ($hasil->petani_id !== $userId) {
            abort(403, 'Tidak boleh edit data orang lain');
        }

        return view('hasil.edit', compact('hasil'));
    }

    public function update(Request $request, HasilPertanian $hasil)
    {
        $userId = $this->getAuthIdOrAbort();

        if ($hasil->petani_id !== $userId) {
            abort(403, 'Tidak boleh update data orang lain');
        }

        $data = $request->validate([
            'nama_hasil' => 'required|string|max:255',
            'stok' => 'required|integer',
            'tanggal_panen' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('hasil-pertanian', 'public');
        }

        $hasil->update($data);

        return redirect()->route('hasil.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(HasilPertanian $hasil)
    {
        $userId = $this->getAuthIdOrAbort();

        if ($hasil->petani_id !== $userId) {
            abort(403, 'Tidak boleh hapus data orang lain');
        }

        $hasil->delete();
        return redirect()->route('hasil.index')->with('success', 'Data berhasil dihapus');
    }
}
