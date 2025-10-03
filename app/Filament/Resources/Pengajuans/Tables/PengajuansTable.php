<?php

namespace App\Filament\Resources\Pengajuans\Tables;

use Filament\Actions\Action as ActionsAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;
use Filament\Forms;

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
                    ->label('Nama Petani')
                    ->sortable(),
                TextColumn::make('nama_hasil')
                    ->label('Hasil Pertanian')
                    ->searchable(),
                TextColumn::make('stok_ditawarkan')
                    ->numeric()
                    ->label('Stok Ditawarkan (Kg)')
                    ->sortable(),
                TextColumn::make('tanggal_panen')
                    ->date()
                    ->label('Tanggal Panen')
                    ->sortable(),
                ImageColumn::make('foto')
                    ->disk('public')
                    ->size(60),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'menunggu' => 'Menunggu',
                        'diterima' => 'Diterima',
                        'ditolak'  => 'Ditolak',
                        'dibayar'  => 'Dibayar',
                        default => $state,
                    })
                    ->colors([
                        'secondary' => 'menunggu',
                        'success' => 'diterima',
                        'danger'   => 'ditolak',
                        'info'     => 'dibayar',
                    ]),

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

                // TOLAK
                ActionsAction::make('tolak')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn($record) => $record->status === 'menunggu')
                    ->action(fn($record) => $record->update(['status' => 'ditolak'])),

                // TERIMA
                ActionsAction::make('terima')
                    ->label('Terima')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn($record) => $record->status === 'menunggu')
                    ->modalHeading('Konfirmasi Terima Pengajuan')
                    ->modalDescription('Jika diterima, Anda dapat melanjutkan ke tahap pembayaran.')
                    ->modalButton('Ya, Terima')
                    ->action(fn($record) => $record->update(['status' => 'diterima'])),

                // PEMBAYARAN
                // Tombol Pembayaran
                ActionsAction::make('pembayaran')
                    ->label('Bayar')
                    ->icon('heroicon-o-credit-card')
                    ->color('success')
                    ->visible(fn($record) => $record->status === 'diterima')
                    ->modalHeading('Form Pembayaran')
                    ->modalDescription('Harga otomatis dihitung dari harga perkiraan penawaran × stok yang diajukan.')
                    ->modalButton('Bayar') // 🔑 tombol submit jadi Bayar
                    ->form([
                        Forms\Components\Placeholder::make('harga_perkiraan')
                            ->label('Harga Perkiraan (per Kg)')
                            ->content(fn($record) => 'Rp ' . number_format($record->penawaran->harga_perkiraan, 0, ',', '.')),

                        Forms\Components\Placeholder::make('stok')
                            ->label('Jumlah Stok Ditawarkan')
                            ->content(fn($record) => $record->stok_ditawarkan . ' Kg'),

                        Forms\Components\Placeholder::make('total')
                            ->label('Total Pembayaran')
                            ->content(
                                fn($record) =>
                                'Rp ' . number_format($record->penawaran->harga_perkiraan * $record->stok_ditawarkan, 0, ',', '.')
                            ),

                        Forms\Components\Select::make('metode_pembayaran')
                            ->label('Metode Pembayaran')
                            ->options([
                                'transfer' => 'Transfer Bank',
                                'cod' => 'Cash on Delivery',
                            ])
                            ->required()
                            ->reactive(),

                        Forms\Components\FileUpload::make('bukti_transfer')
                            ->label('Upload Bukti Transfer')
                            ->disk('public')
                            ->directory('bukti-transfer')
                            ->visible(fn($get) => $get('metode_pembayaran') === 'transfer'),

                        Forms\Components\Textarea::make('catatan')
                            ->label('Catatan')
                            ->placeholder('Tambahkan catatan pembayaran...'),
                    ])
                    ->action(function ($record, array $data) {
                        $total = $record->penawaran->harga_perkiraan * $record->stok_ditawarkan;

                        $record->update([
                            'status' => 'dibayar',
                            'catatan' => $data['catatan'] ?? null,
                            'jumlah' => $total,
                            'metode_pembayaran' => $data['metode_pembayaran'] ?? null,
                            'bukti_transfer' => $data['bukti_transfer'] ?? null,
                        ]);
                    }),

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
