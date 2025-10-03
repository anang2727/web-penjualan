<?php

namespace App\Filament\Resources\Pengajuans\Schemas;

use Filament\Infolists\Components\ImageEntry;
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
                ImageEntry::make('foto')
                    ->disk('public')
                    ->height(200)
                    ->url(fn($record) => $record->foto ? asset('storage/' . $record->foto) : null)
                    ->columnSpanFull(),
                TextEntry::make('petani.name')
                    ->numeric(),
                TextEntry::make('nama_hasil'),
                TextEntry::make('stok_ditawarkan')
                    ->numeric(),
                TextEntry::make('tanggal_panen')
                    ->date(),
                TextEntry::make('status'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
