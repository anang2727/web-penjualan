<?php

namespace App\Filament\Resources\PostinganPedagangs\Pages;

use App\Filament\Resources\PostinganPedagangs\PostinganPedagangResource;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PostinganPedagangs\PostinganDaganganResource;
use Illuminate\Support\Facades\Auth;
class CreatePostinganPedagang extends CreateRecord
{
    protected static string $resource = PostinganPedagangResource::class;
     // --- TAMBAHKAN METODE INI ---
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Secara eksplisit mengisi pengepul_id dengan ID user yang sedang login
        $data['pengepul_id'] = Auth::id();
        return $data;
    }
}
