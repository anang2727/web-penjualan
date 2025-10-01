<?php

namespace App\Filament\Resources\Pengajuans\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PengajuanInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('penawaran.id')
                    ->numeric(),
                TextEntry::make('petani.name')
                    ->numeric(),
                TextEntry::make('nama_hasil'),
                TextEntry::make('stok_ditawarkan')
                    ->numeric(),
                TextEntry::make('tanggal_panen')
                    ->date(),
                TextEntry::make('foto'),
                TextEntry::make('status'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
