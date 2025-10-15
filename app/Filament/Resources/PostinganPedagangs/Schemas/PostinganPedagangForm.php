<?php

namespace App\Filament\Resources\PostinganPedagangs\Schemas;

use Filament\Schemas\Schema;
// --- IMPORTS YANG DIPERLUKAN UNTUK FORM ---
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
// --- IMPORTS UNTUK LOGIKA RELASI/VALIDASI ---
use App\Models\PostinganDagangan; 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth; 
// --- END IMPORTS ---

class PostinganPedagangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                
                // --- Bagian Utama ---
                Section::make('Detail Postingan')
                    ->columns(2)
                    ->schema([
                        // Relasi ke Stok Pengepul (Stok Sumber)
                        Select::make('stok_pengepul_id')
                            ->label('Pilih Stok Sumber')
                            ->relationship(
                                'stokPengepul', 
                                'nama_komoditas', 
                                // Hanya tampilkan stok milik Pengepul yang sedang login
                                fn (Builder $query) => $query->where('pengepul_id', Auth::id())
                            )
                            ->getOptionLabelFromRecordUsing(fn ($record) => 
                                "{$record->nama_komoditas} ({$record->jumlah_stok_saat_ini} {$record->satuan} Tersedia)"
                            )
                            ->required()
                            ->columnSpanFull()
                            ->helperText('Stok ini harus sudah tersedia di inventaris Anda.'),
                            
                        TextInput::make('judul_postingan')
                            ->label('Judul Iklan')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('deskripsi')
                            ->label('Deskripsi Produk')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                // --- Detail Penjualan ---
                Section::make('Harga dan Kuantitas')
                    ->columns(3)
                    ->schema([
                        TextInput::make('harga_jual_satuan')
                            ->label('Harga Jual per Satuan')
                            ->prefix('Rp')
                            ->required()
                            ->numeric()
                            ->inputMode('decimal'),

                        // SELEKSI SATUAN
                        Select::make('satuan')
                            ->label('Satuan Penjualan')
                            ->options(PostinganDagangan::getSatuanOptions()) // Mengambil dari Model
                            ->required()
                            ->default(PostinganDagangan::SATUAN_KG)
                            ->reactive(), // Agar suffix kuantitas berubah

                        TextInput::make('kuantitas_dijual')
                            ->label('Kuantitas Dijual')
                            ->required()
                            ->numeric()
                            ->inputMode('decimal')
                            ->suffix(fn ($get) => ' ' . $get('satuan')),
                        
                        TextInput::make('minimum_order')
                            ->label('Minimum Order')
                            ->required()
                            ->numeric()
                            ->default(1) 
                            ->inputMode('decimal')
                            ->suffix(fn ($get) => ' ' . $get('satuan')),

                        TextInput::make('lokasi_stok')
                            ->label('Lokasi Stok (Kota/Gudang)')
                            ->required()
                            ->maxLength(255)
                            ->default('Masukkan Kota Anda'),
                        
                        Select::make('status')
                            ->label('Status Postingan')
                            ->options([
                                'draft' => 'Draft',
                                'aktif' => 'Aktif (Tayang)',
                                'habis' => 'Habis (Stok Kosong)',
                            ])
                            ->required()
                            ->default('aktif'),
                    ]),

                // --- Foto ---
                Section::make('Foto Iklan')
                    ->schema([
                        FileUpload::make('foto_postingan')
                            ->label('Unggah Foto Iklan')
                            ->disk('public')
                            ->directory('postingan-dagangan')
                            ->image()
                            ->required(),
                    ]),
            ]);
    }
}