<?php

namespace App\Filament\Resources\TransaksiPembelians\Pages;

use App\Filament\Resources\TransaksiPembelians\TransaksiPembelianResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTransaksiPembelian extends ViewRecord
{
    protected static string $resource = TransaksiPembelianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
