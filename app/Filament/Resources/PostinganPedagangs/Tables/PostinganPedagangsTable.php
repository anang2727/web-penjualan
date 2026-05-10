<?php

namespace App\Filament\Resources\PostinganPedagangs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn; // Tambahkan ini
use Filament\Tables\Columns\TextColumn;  // Tambahkan ini
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class PostinganPedagangsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                // --- DEFINISI KOLOM TELAH DIISI ---
                TextColumn::make('judul_postingan')
                    ->label('Judul Iklan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('stokPengepul.nama_komoditas')
                    ->label('Komoditas Sumber')
                    ->sortable(),

                TextColumn::make('kuantitas_dijual')
                    ->label('Jml. Dijual')
                    ->numeric()
                    ->suffix(fn($record) => ' ' . $record->satuan),

                TextColumn::make('harga_jual_satuan')
                    ->label('Harga Jual')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('lokasi_stok')
                    ->label('Lokasi')
                    ->searchable(),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'primary' => 'draft',
                        'success' => 'aktif',
                        'danger' => 'habis',
                        'secondary' => 'selesai',
                    ]),

                TextColumn::make('created_at')
                    ->label('Tanggal Post')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                // --- END DEFINISI KOLOM ---
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
