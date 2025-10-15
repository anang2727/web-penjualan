<?php

namespace App\Filament\Resources\StokPengepuls\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section; // Import Section
use Filament\Schemas\Components\Grid;    // Import Grid

class StokPengepulInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                
                // --- BAGIAN UTAMA STOK ---
                Section::make('Detail Komoditas dan Stok')
                    ->columns(3) // Menggunakan 3 kolom untuk tata letak yang rapi
                    ->schema([
                        
                        TextEntry::make('nama_komoditas')
                            ->label('Nama Komoditas')
                            ->weight('bold') // Menonjolkan nama komoditas
                            ->size('large')
                            ->columnSpan(2), // Ambil 2 kolom

                        TextEntry::make('tanggal_masuk')
                            ->label('Tanggal Masuk')
                            ->date('d M Y') // Format tanggal yang lebih ramah
                            ->icon('heroicon-o-calendar-days')
                            ->color('primary')
                            ->columnSpan(1), // 1 kolom

                        TextEntry::make('jumlah_stok_saat_ini')
                            ->label('Jumlah Stok Tersedia')
                            ->numeric(thousandsSeparator: '.') // Formatting angka
                            ->suffix(fn ($record) => ' ' . $record->satuan) // Tampilkan satuan
                            ->size('xl') // Membuat angka besar
                            ->color('success')
                            ->columnSpan(1),

                        TextEntry::make('satuan')
                            ->label('Satuan Unit')
                            ->columnSpan(1),
                            
                        // --- Data Pengepul (Hanya Tampil jika perlu) ---
                        TextEntry::make('pengepul.name')
                            ->label('Dimiliki Oleh')
                            ->icon('heroicon-o-user')
                            ->columnSpan(1),
                    ]),

                // --- BAGIAN DETAIL WAKTU ---
                Section::make('Informasi Sistem')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Dibuat Pada')
                            ->dateTime('d M Y, H:i:s'),

                        TextEntry::make('updated_at')
                            ->label('Terakhir Diperbarui')
                            ->dateTime('d M Y, H:i:s')
                            ->color('warning'),
                            
                        // Kosongkan 1 kolom
                        Grid::make()->columnSpan(1), 
                    ]),
            ]);
    }
}