<?php

namespace App\Filament\Resources\Pengajuans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PengajuansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('penawaran.id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('petani.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('nama_hasil')
                    ->searchable(),
                TextColumn::make('stok_ditawarkan')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tanggal_panen')
                    ->date()
                    ->sortable(),
                TextColumn::make('foto')
                    ->searchable(),
                TextColumn::make('status'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
