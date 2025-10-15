<?php

namespace App\Http\Controllers;

use App\Models\PostinganDagangan;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Menampilkan halaman beranda (Hero) dengan daftar postingan dagangan yang aktif.
     */
    public function index()
    {
        // 1. Ambil data Postingan Dagangan yang statusnya 'aktif'
        $postingan_dagangans = PostinganDagangan::where('status', 'aktif')
                                                ->with('stokPengepul') // Eager load relasi stokPengepul
                                                ->limit(6) // Batasi maksimal 6 postingan
                                                ->latest() // Urutkan berdasarkan yang terbaru
                                                ->get();
                                                
        // 2. Kirim data ke view 'hero.blade.php'
        return view('hero', compact('postingan_dagangans'));
    }
}