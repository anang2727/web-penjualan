<?php

namespace App\Filament\Resources\Penawarans\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PenawaranInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // TextEntry::make('pengepul_id')
                //     ->numeric(),
               
                ImageEntry::make('foto')
                    ->disk('public')
                    ->height(200)
                    ->columnSpanFull(),
                TextEntry::make('jumlah_kebutuhan')
                    ->numeric(),
                TextEntry::make('harga_perkiraan')
                    ->numeric(),
                TextEntry::make('tanggal_batas')
                    ->date(),
                TextEntry::make('status'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
