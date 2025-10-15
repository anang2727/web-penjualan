<?php

namespace App\Filament\Resources\TransaksiPembelians\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TransaksiPembelianForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('pedagang_id')
                    ->relationship('pedagang', 'name')
                    ->required(),
                Select::make('postingan_dagangan_id')
                    ->relationship('postinganDagangan', 'id')
                    ->required(),
                Select::make('pengepul_id')
                    ->relationship('pengepul', 'name')
                    ->required(),
                TextInput::make('kode_transaksi')
                    ->required(),
                TextInput::make('kuantitas_pesanan')
                    ->required()
                    ->numeric(),
                TextInput::make('satuan')
                    ->required(),
                TextInput::make('harga_satuan')
                    ->required()
                    ->numeric(),
                TextInput::make('total_harga')
                    ->required()
                    ->numeric(),
                Select::make('status')
                    ->options([
            'menunggu_konfirmasi' => 'Menunggu konfirmasi',
            'diproses' => 'Diproses',
            'dikirim' => 'Dikirim',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
        ])
                    ->default('menunggu_konfirmasi')
                    ->required(),
                Textarea::make('catatan')
                    ->columnSpanFull(),
            ]);
    }
}
