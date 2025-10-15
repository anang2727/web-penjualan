<?php

namespace App\Filament\Resources\TransaksiPembelians\Pages;

use App\Filament\Resources\TransaksiPembelians\TransaksiPembelianResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTransaksiPembelians extends ListRecords
{
    protected static string $resource = TransaksiPembelianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
