<?php

namespace App\Filament\Resources\PostinganPedagangs\Pages;

use App\Filament\Resources\PostinganPedagangs\PostinganPedagangResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPostinganPedagang extends ViewRecord
{
    protected static string $resource = PostinganPedagangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
