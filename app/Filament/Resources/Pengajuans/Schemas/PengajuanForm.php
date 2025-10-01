<?php

namespace App\Filament\Resources\Pengajuans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PengajuanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('penawaran_id')
                    ->relationship('penawaran', 'id')
                    ->required(),
                Select::make('petani_id')
                    ->relationship('petani', 'name')
                    ->required(),
                TextInput::make('nama_hasil')
                    ->required(),
                TextInput::make('stok_ditawarkan')
                    ->required()
                    ->numeric(),
                DatePicker::make('tanggal_panen'),
                Textarea::make('deskripsi')
                    ->columnSpanFull(),
                TextInput::make('foto'),
                Select::make('status')
                    ->options(['menunggu' => 'Menunggu', 'diterima' => 'Diterima', 'ditolak' => 'Ditolak'])
                    ->default('menunggu')
                    ->required(),
            ]);
    }
}
