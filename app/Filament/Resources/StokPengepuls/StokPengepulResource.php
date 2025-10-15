<?php

namespace App\Filament\Resources\StokPengepuls;

use App\Filament\Resources\StokPengepuls\Pages\CreateStokPengepul;
use App\Filament\Resources\StokPengepuls\Pages\EditStokPengepul;
use App\Filament\Resources\StokPengepuls\Pages\ListStokPengepuls;
use App\Filament\Resources\StokPengepuls\Pages\ViewStokPengepul;
use App\Filament\Resources\StokPengepuls\Schemas\StokPengepulForm;
use App\Filament\Resources\StokPengepuls\Schemas\StokPengepulInfolist;
use App\Filament\Resources\StokPengepuls\Tables\StokPengepulsTable;
use App\Models\StokPengepul;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StokPengepulResource extends Resource
{
    protected static ?string $model = StokPengepul::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'stokPengepul';

    public static function form(Schema $schema): Schema
    {
        return StokPengepulForm::configure($schema);
    }
    

        // ⬇️ Menggantikan $modelLabel
    public static function getLabel(): string
    {
        return 'Stok Komoditas';
    }

    // ⬇️ Menggantikan $pluralModelLabel
    public static function getPluralLabel(): string
    {
        return 'Stok';
    }
    

    public static function infolist(Schema $schema): Schema
    {
        return StokPengepulInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StokPengepulsTable::configure($table);
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
            'index' => ListStokPengepuls::route('/'),
            'create' => CreateStokPengepul::route('/create'),
            'view' => ViewStokPengepul::route('/{record}'),
            'edit' => EditStokPengepul::route('/{record}/edit'),
        ];
    }
}
