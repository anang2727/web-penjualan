<?php

namespace App\Filament\Resources\TransaksiPembelians\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TransaksiPembelianInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('pedagang.name')
                    ->numeric(),
                TextEntry::make('postinganDagangan.id')
                    ->numeric(),
                TextEntry::make('pengepul.name')
                    ->numeric(),
                TextEntry::make('kode_transaksi'),
                TextEntry::make('kuantitas_pesanan')
                    ->numeric(),
                TextEntry::make('satuan'),
                TextEntry::make('harga_satuan')
                    ->numeric(),
                TextEntry::make('total_harga')
                    ->numeric(),
                TextEntry::make('status'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
