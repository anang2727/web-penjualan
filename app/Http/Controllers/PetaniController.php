<?php

namespace App\Http\Controllers;

use App\Models\Penawaran;
use Illuminate\Http\Request;


class PetaniController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil nilai filter dari URL (defaultnya 'buka')
        $filter = $request->get('filter', 'buka');

        // 2. Petakan nilai filter URL ke STATUS di DATABASE
        if ($filter === 'penuh') {
            // Jika filter URL adalah 'penuh', kita cari status 'selesai' di DB.
            $statusToFilter = 'selesai';
        } else {
            // Default (jika filter 'buka' atau tidak ada filter), kita cari status 'aktif' di DB.
            $statusToFilter = 'aktif';
        }

        // 3. Ambil data penawaran berdasarkan status yang dipetakan
        $penawarans = Penawaran::where('status', $statusToFilter)
            ->latest()
            ->get();

        // Kirimkan data penawaran dan filter yang aktif ke view
        return view('petani.penawaran.index', compact('penawarans', 'filter'));
    }

    public function show(Penawaran $penawaran)
    {
        return view('petani.penawaran.show', compact('penawaran'));
    }
}
