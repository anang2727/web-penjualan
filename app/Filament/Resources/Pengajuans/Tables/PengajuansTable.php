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
use App\Models\StokPengepul;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Tambahkan ini untuk transaksi aman
use Filament\Notifications\Notification;

class PengajuansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
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
                    ->label('Stok (Kg)')
                    ->sortable(),
                TextColumn::make('progres')
                    ->label('Progres Kebutuhan')
                    ->getStateUsing(function ($record) {
                        $penawaran = $record->penawaran;
                        if (!$penawaran) return '-';

                        // Menghitung yang sudah terkumpul: Target dikurangi sisa (kebutuhan)
                        $terkumpul = $penawaran->jumlah_target - $penawaran->jumlah_kebutuhan;

                        return number_format($terkumpul, 0, ',', '.') . ' / ' . number_format($penawaran->jumlah_target, 0, ',', '.') . ' Kg';
                    })
                    ->badge()
                    ->color('success'),
                // Perbaikan kolom Stok Dibuat agar lebih jelas
                TextColumn::make('is_stok_generated')
                    ->label('Stok Dibuat')
                    ->formatStateUsing(fn($state) => $state ? 'Sudah' : 'Belum')
                    ->badge()
                    ->color(fn($state) => $state ? 'success' : 'danger')
                    ->icon(fn($state) => $state ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle'),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn($state) => match (trim($state)) { // Tambahkan trim
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

                ImageColumn::make('foto')
                    ->disk('public')
                    ->size(60),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),

                // TOMBOL TERIMA
                // ... bagian Action TOMBOL TERIMA di dalam PengajuansTable.php ...

                ActionsAction::make('terima')
                    ->label('Terima & Buat Stok')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn($record) => trim($record->status) === 'menunggu' && !$record->is_stok_generated)
                    ->action(function ($record) {
                        $pengepulId = Auth::id();

                        if (!$pengepulId) {
                            Notification::make()->title('Gagal')->body('ID Pengepul tidak ditemukan.')->danger()->send();
                            return;
                        }

                        // Jalankan transaksi database
                        DB::transaction(function () use ($record, $pengepulId) {
                            // 1. Buat data di tabel stok_pengepul
                            $stok = StokPengepul::create([
                                'pengepul_id' => $pengepulId,
                                'nama_komoditas' => $record->nama_hasil,
                                'jumlah_stok_saat_ini' => $record->stok_ditawarkan,
                                'satuan' => 'Kg',
                                'tanggal_masuk' => now(),
                            ]);

                            // 2. Update status Pengajuan petani
                            $record->update([
                                'status' => 'diterima',
                                'is_stok_generated' => true,
                                'stok_pengepul_id' => $stok->id,
                            ]);

                            // 3. LOGIKA BARU: Kurangi jumlah_kebutuhan di tabel penawarans
                            // Mengambil relasi penawaran dari record pengajuan
                            // Di dalam action 'terima' -> DB::transaction
                            if ($record->penawaran) {
                                // Kurangi sisa kebutuhan
                                $record->penawaran->decrement('jumlah_kebutuhan', $record->stok_ditawarkan);

                                // Refresh data penawaran untuk mendapatkan nilai terbaru setelah decrement
                                $record->penawaran->refresh();

                                // Jika kebutuhan sudah 0 atau bahkan minus (karena input petani besar), tutup penawarannya
                                if ($record->penawaran->jumlah_kebutuhan <= 0) {
                                    $record->penawaran->update([
                                        'jumlah_kebutuhan' => 0, // Paksa ke 0 agar tidak muncul angka negatif
                                        'status' => 'selesai'
                                    ]);
                                }
                            }
                        });

                        Notification::make()
                            ->title('Berhasil Diterima')
                            ->body('Stok ditambahkan dan sisa kebutuhan penawaran telah diperbarui.')
                            ->success()
                            ->send();
                    }),

                // TOMBOL PEMBAYARAN (VERSI LENGKAP)
                ActionsAction::make('pembayaran')
                    ->label('Bayar')
                    ->icon('heroicon-o-credit-card')
                    ->color('success')
                    // Kita gunakan trim() supaya tidak error kalau ada spasi di database
                    ->visible(fn($record) => trim($record->status) === 'diterima' && $record->is_stok_generated)
                    ->modalHeading('Form Pembayaran')
                    ->modalDescription('Harga otomatis dihitung dari harga perkiraan penawaran × stok yang diajukan.')
                    ->modalButton('Bayar Sekarang')
                    ->form([
                        // Menampilkan Info Harga (Data yang kamu punya sebelumnya)
                        Forms\Components\Placeholder::make('harga_perkiraan')
                            ->label('Harga Perkiraan (per Kg)')
                            ->content(fn($record) => 'Rp ' . number_format($record->penawaran->harga_perkiraan ?? 0, 0, ',', '.')),

                        Forms\Components\Placeholder::make('stok')
                            ->label('Jumlah Stok Ditawarkan')
                            ->content(fn($record) => $record->stok_ditawarkan . ' Kg'),

                        Forms\Components\Placeholder::make('total')
                            ->label('Total Pembayaran')
                            ->content(function ($record) {
                                // Ambil harga dari penawaran, jika tidak ada (null) gunakan 0
                                $harga = $record->penawaran->harga_perkiraan ?? 0;
                                $total = $harga * $record->stok_ditawarkan;

                                return 'Rp ' . number_format($total, 0, ',', '.');
                            }),

                        // Input Data
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
                            // Hanya muncul jika pilih transfer
                            ->visible(fn($get) => $get('metode_pembayaran') === 'transfer')
                            ->required(fn($get) => $get('metode_pembayaran') === 'transfer'),

                        Forms\Components\Textarea::make('catatan')
                            ->label('Catatan')
                            ->placeholder('Tambahkan catatan pembayaran...'),
                    ])
                    ->action(function ($record, array $data) {
                        $harga = $record->penawaran->harga_perkiraan ?? 0;
                        $total = $harga * $record->stok_ditawarkan;

                        $record->update([
                            'status' => 'dibayar',
                            'catatan' => $data['catatan'] ?? null,
                            'jumlah' => $total, // Menyimpan total uang yang dibayarkan
                            'metode_pembayaran' => $data['metode_pembayaran'] ?? null,
                            'bukti_transfer' => $data['bukti_transfer'] ?? null,
                        ]);     

                        Notification::make()
                            ->title('Pembayaran Berhasil')
                            ->body('Status pengajuan telah diperbarui menjadi Dibayar.')
                            ->success()
                            ->send();
                    }),
                ActionsAction::make('tolak')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn($record) => trim($record->status) === 'menunggu')
                    ->action(fn($record) => $record->update(['status' => 'ditolak'])),
            ]);
    }
}
