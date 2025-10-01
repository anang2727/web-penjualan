<?php

namespace App\Filament\Resources\Penawarans\Pages;

use App\Filament\Resources\Penawarans\PenawaranResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPenawarans extends ListRecords
{
    protected static string $resource = PenawaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
