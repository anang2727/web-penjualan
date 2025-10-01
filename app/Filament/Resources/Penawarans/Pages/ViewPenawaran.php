<?php

namespace App\Filament\Resources\Penawarans\Pages;

use App\Filament\Resources\Penawarans\PenawaranResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPenawaran extends ViewRecord
{
    protected static string $resource = PenawaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
