

<?php

// routes/web.php

use App\Http\Controllers\DashboardRedirectController;
use App\Http\Controllers\DetailPetaniController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PetaniController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DetailPedagangController; // <-- TAMBAHKAN
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\TransaksiPembelianController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    // Rute utama dashboard (Dialihkan oleh DashboardRedirectController)
    Route::get('/dashboard', [DashboardRedirectController::class, 'index'])->name('dashboard');

    // --- GRUP RUTE KHUSUS PETANI (Role: 'petani') ---
    Route::middleware(['role:petani'])->group(function () {
        Route::resource('hasil', \App\Http\Controllers\HasilPertanianController::class);

        // Penawaran (Marketplace Pengepul untuk Petani)
        Route::get('/penawaran', [PetaniController::class, 'index'])->name('petani.penawaran.index');
        Route::get('/penawaran/{penawaran}', [PetaniController::class, 'show'])->name('petani.penawaran.show');

        // Pengajuan
        Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');
        Route::get('/pengajuan-saya', [PengajuanController::class, 'index'])->name('pengajuan.index');

        // CRUD Data Petani (DetailPetaniController)
        Route::resource('petani/datapetani', DetailPetaniController::class)
            ->names('petani.datapetani')
            ->parameters(['datapetani' => 'detail_petani']);
    });


    // routes/web.php

    // ... (Pastikan semua Controller terimport: DetailPedagangController, TransaksiPembelianController) ...

    // routes/web.php (Di dalam grup rute khusus pedagang)

    // --- GRUP RUTE KHUSUS PEDAGANG (Role: 'pedagang') ---
    Route::middleware(['role:pedagang'])->prefix('dashboard/pedagang')->name('dashboard.pedagang.')->group(function () {

        // PERBAIKAN: Mengganti Route::resource yang bermasalah dengan rute eksplisit.
        Route::get('pesanan', [TransaksiPembelianController::class, 'index'])->name('pesanan.index');
        // Rute untuk melihat detail satu pesanan
        Route::get('pesanan/{transaksiPembelian}', [TransaksiPembelianController::class, 'show'])->name('pesanan.show');
        // 1. INDEX/LIST/PROFIL (Terkait dengan link dashboard.pedagang.index yang error)
        // Walaupun rute ini tidak digunakan untuk list, kita definisikan agar link di navigasi bekerja.
        Route::get('/', [DetailPedagangController::class, 'index'])->name('index'); // Nama: dashboard.pedagang.index
        Route::post('pesanan/{transaksiPembelian}/bukti-bayar', [TransaksiPembelianController::class, 'uploadBuktiBayar'])->name('pesanan.upload-bukti');
        // 2. CREATE/STORE PROFIL BARU
        Route::get('create', [DetailPedagangController::class, 'create'])->name('create'); // Nama: dashboard.pedagang.create
        Route::post('/', [DetailPedagangController::class, 'store'])->name('store');      // Nama: dashboard.pedagang.store

        // 3. SHOW/EDIT/UPDATE PROFIL YANG SUDAH ADA
        // Menggunakan parameter {detail_pedagang}
        Route::get('{detail_pedagang}', [DetailPedagangController::class, 'show'])->name('show');     // Nama: dashboard.pedagang.show
        Route::get('{detail_pedagang}/edit', [DetailPedagangController::class, 'edit'])->name('edit'); // Nama: dashboard.pedagang.edit
        Route::put('{detail_pedagang}', [DetailPedagangController::class, 'update'])->name('update'); // Nama: dashboard.pedagang.update

        // Rute Marketplace Pengepul (e-Commerce) - Sesuai dengan route asli Anda
        Route::get('marketplace', function () {
            return view('dashboard.pedagang.marketplace');
        })->name('e-commerce');

        // Rute Pesanan Pedagang (Histori Pembelian dan Status)

        // Rute untuk proses transaksi (yang dibutuhkan di pedagang.blade.php)
        Route::post('pesanan/store/{postingan}', [TransaksiPembelianController::class, 'store'])->name('pesanan.store');
    });
    // --- AKHIR GRUP PEDAGANG ---


    // Rute Profil Pengguna Umum (Berlaku untuk semua role)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
