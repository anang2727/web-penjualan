<?php

namespace App\Filament\Resources\Penawarans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PenawaranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // TextInput::make('pengepul_id')
                //     ->required()
                //     ->numeric(),
                TextInput::make('judul')
                    ->required(),
                FileUpload::make('foto')
                    ->image() // biar khusus gambar
                    ->directory('penawarans') // folder penyimpanan di storage/app/public/penawarans
                    ->disk('public') // ⬅️ WAJIB, biar masuk ke storage/app/public
                    ->visibility('public') // biar bisa diakses publik
                    ->maxSize(2048) // maksimal 2MB
                    ->nullable(),

                Textarea::make('deskripsi')
                    ->columnSpanFull(),
                TextInput::make('jumlah_kebutuhan')
                    ->required()
                    ->numeric(),
                TextInput::make('harga_perkiraan')
                    ->numeric(),
                DatePicker::make('tanggal_batas'),
                Select::make('status')
                    ->options(['aktif' => 'Aktif', 'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan'])
                    ->default('aktif')
                    ->required(),
            ]);
    }
}
