<?php

namespace App\Filament\Resources\StokPengepuls\Pages;

use App\Filament\Resources\StokPengepuls\StokPengepulResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditStokPengepul extends EditRecord
{
    protected static string $resource = StokPengepulResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
