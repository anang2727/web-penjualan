<?php

namespace App\Filament\Resources\StokPengepuls\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StokPengepulForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('pengepul_id')
                    ->relationship('pengepul', 'name')
                    ->required(),
                TextInput::make('nama_komoditas')
                    ->required(),
                TextInput::make('jumlah_stok_saat_ini')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('satuan')
                    ->required(),
                DateTimePicker::make('tanggal_masuk')
                    ->required(),
            ]);
    }
}
