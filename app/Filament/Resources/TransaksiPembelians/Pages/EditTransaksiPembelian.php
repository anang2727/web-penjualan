<?php

namespace App\Filament\Resources\TransaksiPembelians\Pages;

use App\Filament\Resources\TransaksiPembelians\TransaksiPembelianResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditTransaksiPembelian extends EditRecord
{
    protected static string $resource = TransaksiPembelianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
