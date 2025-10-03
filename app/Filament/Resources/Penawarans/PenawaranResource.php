<?php

namespace App\Filament\Resources\Penawarans;

use App\Filament\Resources\Penawarans\Pages\CreatePenawaran;
use App\Filament\Resources\Penawarans\Pages\EditPenawaran;
use App\Filament\Resources\Penawarans\Pages\ListPenawarans;
use App\Filament\Resources\Penawarans\Pages\ViewPenawaran;
use App\Filament\Resources\Penawarans\Schemas\PenawaranForm;
use App\Filament\Resources\Penawarans\Schemas\PenawaranInfolist;
use App\Filament\Resources\Penawarans\Tables\PenawaransTable;
use App\Models\Penawaran;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PenawaranResource extends Resource
{
    protected static ?string $navigationLabel = 'Penawaran';
    protected static ?string $model = Penawaran::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // ⬇️ ini untuk label tunggal
    public static function getLabel(): string
    {
        return 'Penawaran';
    }

    // ⬇️ ini untuk label jamak (judul tabel & list)
    public static function getPluralLabel(): string
    {
        return 'Daftar Penawaran';
    }


    public static function form(Schema $schema): Schema
    {
        return PenawaranForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PenawaranInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PenawaransTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPenawarans::route('/'),
            'create' => CreatePenawaran::route('/create'),
            'view' => ViewPenawaran::route('/{record}'),
            'edit' => EditPenawaran::route('/{record}/edit'),
        ];
    }
}
