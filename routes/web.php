<?php

use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PetaniController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Hero');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// routes/web.php
Route::middleware(['auth', 'role:petani'])->group(function () {
    Route::resource('hasil', \App\Http\Controllers\HasilPertanianController::class);
});

Route::middleware(['auth', 'role:petani'])->group(function () {
    Route::get('/penawaran', [PetaniController::class, 'index'])->name('petani.penawaran.index');
    Route::get('/penawaran/{penawaran}', [PetaniController::class, 'show'])->name('petani.penawaran.show');
    Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');
    Route::get('/pengajuan-saya', [PengajuanController::class, 'index'])->name('pengajuan.index');
});

require __DIR__.'/auth.php';
