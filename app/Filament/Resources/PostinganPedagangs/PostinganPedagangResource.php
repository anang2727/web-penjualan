<?php

namespace App\Filament\Resources\PostinganPedagangs;

use App\Filament\Resources\PostinganPedagangs\Pages\CreatePostinganPedagang;
use App\Filament\Resources\PostinganPedagangs\Pages\EditPostinganPedagang;
use App\Filament\Resources\PostinganPedagangs\Pages\ListPostinganPedagangs;
use App\Filament\Resources\PostinganPedagangs\Pages\ViewPostinganPedagang;
use App\Filament\Resources\PostinganPedagangs\Schemas\PostinganPedagangForm;
use App\Filament\Resources\PostinganPedagangs\Schemas\PostinganPedagangInfolist;
use App\Filament\Resources\PostinganPedagangs\Tables\PostinganPedagangsTable;
use App\Models\PostinganDagangan;
use App\Models\PostinganPedagang;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostinganPedagangResource extends Resource
{
    protected static ?string $model = PostinganDagangan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PostinganPedagangForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PostinganPedagangInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PostinganPedagangsTable::configure($table);
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
            'index' => ListPostinganPedagangs::route('/'),
            'create' => CreatePostinganPedagang::route('/create'),
            'view' => ViewPostinganPedagang::route('/{record}'),
            'edit' => EditPostinganPedagang::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
