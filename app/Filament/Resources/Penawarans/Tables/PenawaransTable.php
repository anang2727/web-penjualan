<?php

namespace App\Filament\Resources\Penawarans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PenawaransTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                // TextColumn::make('pengepul_id')
                //     ->numeric()
                //     ->sortable(),
                TextColumn::make('judul')
                    ->searchable(),
                ImageColumn::make('foto')
                    ->square()
                    ->size(60)
                    ->disk('public'),
                TextColumn::make('progres')
                    ->label('Status Pemenuhan')
                    ->getStateUsing(function ($record) {
                        // Rumus: (Target - Sisa) / Target
                        $terkumpul = $record->jumlah_target - $record->jumlah_kebutuhan;
                        return number_format($terkumpul, 0, ',', '.') . ' / ' . number_format($record->jumlah_target, 0, ',', '.') . ' Kg';
                    })
                    ->badge()
                    ->color('success')
                    ->description(fn($record) => "Sisa: " . number_format($record->jumlah_kebutuhan, 0, ',', '.') . " Kg lagi"),
                TextColumn::make('harga_perkiraan')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tanggal_batas')
                    ->date()
                    ->sortable(),
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
