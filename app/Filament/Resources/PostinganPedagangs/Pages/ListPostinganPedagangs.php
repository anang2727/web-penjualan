<?php

namespace App\Filament\Resources\PostinganPedagangs\Pages;

use App\Filament\Resources\PostinganPedagangs\PostinganPedagangResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPostinganPedagangs extends ListRecords
{
    protected static string $resource = PostinganPedagangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
