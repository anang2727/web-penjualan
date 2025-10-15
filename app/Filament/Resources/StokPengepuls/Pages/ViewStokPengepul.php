<?php

namespace App\Filament\Resources\StokPengepuls\Pages;

use App\Filament\Resources\StokPengepuls\StokPengepulResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewStokPengepul extends ViewRecord
{
    protected static string $resource = StokPengepulResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
