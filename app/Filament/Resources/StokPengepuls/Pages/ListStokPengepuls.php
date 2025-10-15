<?php

namespace App\Filament\Resources\StokPengepuls\Pages;

use App\Filament\Resources\StokPengepuls\StokPengepulResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStokPengepuls extends ListRecords
{
    protected static string $resource = StokPengepulResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
