<?php

namespace App\Filament\Resources\Penawarans\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Fieldset;
use Filament\Schemas\Components\Fieldset as ComponentsFieldset;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

class PenawaranInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Penawaran')
                    ->schema([
                        Grid::make(2)
                            ->gap(4)
                            ->schema([
                                ImageEntry::make('foto')
                                    ->disk('public')
                                    ->height(280)
                                    ->extraAttributes([
                                        'class' => 'rounded-xl object-cover w-full h-72',
                                    ])
                                    ->columnSpan(1),

                                ComponentsFieldset::make('Informasi Utama')
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                TextEntry::make('jumlah_kebutuhan')
                                                    ->label('Jumlah Kebutuhan')
                                                    ->numeric(),

                                                TextEntry::make('harga_perkiraan')
                                                    ->label('Harga Perkiraan')
                                                    ->numeric(),

                                                TextEntry::make('tanggal_batas')
                                                    ->label('Tanggal Batas')
                                                    ->date(),

                                                TextEntry::make('status')
                                                    ->label('Status')
                                                    ->badge()
                                                    ->color(fn (string $state): string => match ($state) {
                                                        'pending' => 'warning',
                                                        'approved' => 'success',
                                                        'rejected' => 'danger',
                                                        'aktif' => 'success',
                                                        default => 'gray',
                                                    }),

                                                TextEntry::make('created_at')
                                                    ->label('Dibuat Pada')
                                                    ->dateTime(),

                                                TextEntry::make('updated_at')
                                                    ->label('Diupdate Pada')
                                                    ->dateTime(),
                                            ]),
                                    ])
                                    ->columnSpan(1),
                            ]),
                        // Tambahkan deskripsi di bawah grid utama
                        ComponentsFieldset::make('Deskripsi Penawaran')
                            ->schema([
                                TextEntry::make('deskripsi')
                                    ->label('Deskripsi')
                                    ->columnSpanFull()
                                    ->extraAttributes([
                                        'class' => 'text-gray-700 leading-relaxed',
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->extraAttributes([
                        'class' => 'max-w-5xl mx-auto border rounded-2xl shadow-md p-6 bg-white hover:shadow-lg transition duration-300',
                    ]),
            ]);
    }
}
