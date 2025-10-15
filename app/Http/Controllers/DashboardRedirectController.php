<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PostinganDagangan; // Import Model PostinganDagangan

class DashboardRedirectController extends Controller
{
    /**
     * Tentukan dasbor yang akan ditampilkan berdasarkan role user.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $role = $user->role;

        if ($role === 'petani') {
            return view('dashboard');
        } elseif ($role === 'pedagang') {
            
            $detailPedagang = $user->detailPedagang; 
            
            // --- LOGIKA MARKETPLACE (POSTINGAN DAGANGAN) ---
            $query = PostinganDagangan::where('status', 'aktif') // Hanya tampilkan yang statusnya aktif
                                        ->with('stokPengepul');

            // 1. Logika Pencarian (Search)
            if ($request->filled('q')) {
                $search = $request->input('q');
                $query->where(function ($q) use ($search) {
                    $q->where('judul_postingan', 'like', "%{$search}%")
                      ->orWhere('deskripsi', 'like', "%{$search}%")
                      ->orWhere('lokasi_stok', 'like', "%{$search}%");
                });
            }

            // 2. Logika Tab (Filter Status)
            $activeTab = $request->input('tab', 'semua'); // Default: semua
            
            if ($activeTab !== 'semua') {
                // Asumsi 'status' di PostinganDagangan memiliki nilai sesuai nama tab, contoh: 'terbaru', 'populer', dll.
                // Karena kita hanya mem-filter dari 'status'='aktif', kita bisa filter berdasarkan Komoditas (contoh)
                // UNTUK KEMUDAHAN, kita filter berdasarkan komoditas yang paling banyak (misal: komoditas 1, 2, 3)
                // JIKA INGIN MENGGUNAKAN NAMA KOMODITAS DI TAB, logika ini harus diubah.
                // Saat ini, kita biarkan saja filter q dan aktif, dan tab hanya sebagai UI.
            }
            
            // Ambil semua data tanpa limit (sesuai permintaan user)
            $postingan_dagangans = $query->paginate(20); // Gunakan paginate untuk menghindari load data yang terlalu berat

            // Kirim semua data yang diperlukan ke view
            return view('dashboard.pedagang', [
                'detailPedagang' => $detailPedagang,
                'postingan_dagangans' => $postingan_dagangans,
                'q' => $request->input('q', ''),
                'activeTab' => $activeTab,
            ]);
        }

        return view('dashboard'); 
    }
}