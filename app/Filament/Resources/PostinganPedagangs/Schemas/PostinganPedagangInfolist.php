<?php


namespace App\Filament\Resources\PostinganPedagangs\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

class PostinganPedagangInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Iklan')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('judul_postingan')
                                    ->label('Judul Postingan')
                                    ->columnSpan(2),
                                TextEntry::make('stokPengepul.nama_komoditas')
                                    ->label('Komoditas Sumber'),
                            ]),
                        
                        TextEntry::make('deskripsi')
                            ->label('Deskripsi Produk')
                            ->markdown(),
                            
                        ImageEntry::make('foto_postingan')
                            ->label('Foto Produk')
                            ->disk('public')
                            ->height(250),
                    ]),

                Section::make('Detail Penjualan')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('kuantitas_dijual')
                            ->label('Kuantitas Dijual')
                            ->suffix(fn ($state, $record) => ' ' . $record->satuan),
                            
                        TextEntry::make('harga_jual_satuan')
                            ->label('Harga per Satuan')
                            ->money('IDR'),
                            
                        TextEntry::make('minimum_order')
                            ->label('Minimum Order')
                            ->suffix(fn ($state, $record) => ' ' . $record->satuan),

                        TextEntry::make('lokasi_stok')
                            ->label('Lokasi Stok'),
                            
                        TextEntry::make('status')
                            ->label('Status Postingan')
                            ->badge(),
                            
                        TextEntry::make('created_at')
                            ->label('Diposting Sejak')
                            ->date(),
                    ]),
            ]);
    }
}