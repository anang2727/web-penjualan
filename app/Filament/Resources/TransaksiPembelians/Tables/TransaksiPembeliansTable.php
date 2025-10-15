<?php

namespace App\Filament\Resources\TransaksiPembelians\Tables;

use App\Models\TransaksiPembelian; 
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction; // EditAction (di-comment di bawah karena jarang dibutuhkan Pengepul)
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\Action;      // Untuk membuat tombol Aksi
use Filament\Notifications\Notification; // Untuk memberikan notifikasi
use Filament\Tables\Filters\SelectFilter; // Untuk filter status
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage; // WAJIB DIIMPORT untuk melihat bukti pembayaran

class TransaksiPembeliansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_transaksi')
                    ->searchable()
                    ->label('Kode Transaksi'),
                TextColumn::make('pedagang.name')
                    ->label('Pembeli (Pedagang)')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('postinganDagangan.judul_postingan')
                    ->label('Produk')
                    ->default('Produk Dihapus')
                    ->searchable(),
                TextColumn::make('kuantitas_pesanan')
                    ->label('Kuantitas')
                    ->numeric(decimalPlaces: 2)
                    ->suffix(fn ($record) => ' ' . $record->satuan)
                    ->sortable(),
                TextColumn::make('total_harga')
                    ->label('Total Harga')
                    ->money('IDR') // Asumsi mata uang Rupiah
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->sortable()
                    ->color(fn (string $state): string => match ($state) {
                        // Perubahan Status Badge untuk alur baru
                        'menunggu_pembayaran' => 'warning',
                        'menunggu_verifikasi_pembayaran' => 'purple',
                        'diproses' => 'info',
                        'dikirim' => 'primary',
                        'selesai' => 'success',
                        'dibatalkan' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->label('Tanggal Pesan')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'menunggu_pembayaran' => '1. Menunggu Pembayaran',
                        'menunggu_verifikasi_pembayaran' => '2. Menunggu Verifikasi Pembayaran',
                        'diproses' => '3. Diproses (Siap Kirim)',
                        'dikirim' => '4. Dikirim',
                        'selesai' => '5. Selesai',
                        'dibatalkan' => '6. Dibatalkan',
                    ])
                    ->label('Filter Status'),
            ])
            ->recordActions([
                ViewAction::make(),
                
                // --- AKSI 1: VERIFIKASI PEMBAYARAN (Mengubah menjadi DIPROSES) ---
                Action::make('verifikasi_bayar')
                    ->label('Verifikasi Bayar & Proses')
                    ->color('success')
                    ->icon('heroicon-o-check-circle')
                    ->requiresConfirmation()
                    ->modalHeading('Verifikasi Pembayaran dan Proses Pesanan?')
                    ->modalDescription('Setelah verifikasi, status akan diubah menjadi "Diproses" (Siap Kirim).')
                    // Tampil hanya jika statusnya 'menunggu_verifikasi_pembayaran'
                    ->visible(fn (TransaksiPembelian $record): bool => $record->status === 'menunggu_verifikasi_pembayaran')
                    // Menambahkan tautan untuk melihat bukti bayar di tab baru
                    ->url(fn (TransaksiPembelian $record): ?string => $record->bukti_pembayaran_path ? Storage::url($record->bukti_pembayaran_path) : null)
                    ->openUrlInNewTab()
                    ->action(function (TransaksiPembelian $record) {
                        // 1. Ubah Status
                        $record->update(['status' => 'diproses']);
                        
                        // 2. Notifikasi
                        Notification::make() 
                            ->title('Pembayaran DIVERIFIKASI')
                            ->body('Pesanan ' . $record->kode_transaksi . ' telah diverifikasi dan diproses (siap kirim).')
                            ->success()
                            ->send();
                    }),
                
                // --- AKSI 2: KIRIM BARANG (Dari DIPROSES ke DIKIRIM) ---
                Action::make('kirim_barang')
                    ->label('Kirim Barang')
                    ->color('info')
                    ->icon('heroicon-o-truck')
                    ->requiresConfirmation()
                    ->modalDescription('Ubah status menjadi "Dikirim"? Status ini akan memberi tahu Pedagang bahwa barang sedang dikirim.')
                    // Tampil hanya jika statusnya 'diproses'
                    ->visible(fn (TransaksiPembelian $record): bool => $record->status === 'diproses')
                    ->action(function (TransaksiPembelian $record) {
                        $record->update(['status' => 'dikirim']);
                        Notification::make()
                            ->title('Pesanan DIKIRIM')
                            ->body('Status pesanan ' . $record->kode_transaksi . ' diubah menjadi Dikirim.')
                            ->info()
                            ->send();
                    }),

                // --- AKSI 3: PEMBATALAN PESANAN (Tetap sama, tambahkan status 'menunggu_pembayaran') ---
                Action::make('batalkan')
                    ->label('Batalkan Pesanan')
                    ->color('danger')
                    ->icon('heroicon-o-x-mark')
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Pembatalan Pesanan')
                    ->modalDescription('PERINGATAN: Tindakan ini akan mengembalikan kuantitas pesanan ke stok Anda. Apakah Anda yakin?')
                    // Tampilkan selama status belum selesai, dibatalkan, atau dikirim
                    ->visible(fn (TransaksiPembelian $record): bool => !in_array($record->status, ['dibatalkan', 'selesai', 'dikirim']))
                    ->action(function (TransaksiPembelian $record) {
                        $record->load('postinganDagangan');

                        // 1. Kembalikan Stok (Hanya jika produk masih ada di DB)
                        if ($record->postinganDagangan) {
                            $record->postinganDagangan->increment('kuantitas_dijual', $record->kuantitas_pesanan);
                        }
                        
                        // 2. Ubah Status
                        $record->update(['status' => 'dibatalkan']);
                        
                        // 3. Notifikasi
                        Notification::make() 
                            ->title('Pesanan Dibatalkan')
                            ->body('Pesanan ' . $record->kode_transaksi . ' telah dibatalkan. Stok telah dikembalikan.')
                            ->warning()
                            ->send();
                    }),
                
                // EditAction::make(), // Biasanya Pengepul hanya perlu View, bukan Edit
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}