<?php

namespace App\Filament\Resources\TransaksiPembelians;

use App\Filament\Resources\TransaksiPembelians\Pages\CreateTransaksiPembelian;
use App\Filament\Resources\TransaksiPembelians\Pages\EditTransaksiPembelian;
use App\Filament\Resources\TransaksiPembelians\Pages\ListTransaksiPembelians;
use App\Filament\Resources\TransaksiPembelians\Pages\ViewTransaksiPembelian;
use App\Filament\Resources\TransaksiPembelians\Schemas\TransaksiPembelianForm;
use App\Filament\Resources\TransaksiPembelians\Schemas\TransaksiPembelianInfolist;
use App\Filament\Resources\TransaksiPembelians\Tables\TransaksiPembeliansTable;
use App\Models\TransaksiPembelian;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TransaksiPembelianResource extends Resource
{
    protected static ?string $model = TransaksiPembelian::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'TransaksiPembelian';
    public static function getLabel(): string
    {
        return 'Pesanan';
    }

    // ⬇️ Menggantikan $pluralModelLabel
    public static function getPluralLabel(): string
    {
        return 'Transaksi Pembelian';
    }
    
    public static function form(Schema $schema): Schema
    {
        return TransaksiPembelianForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TransaksiPembelianInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TransaksiPembeliansTable::configure($table);
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
            'index' => ListTransaksiPembelians::route('/'),
            'create' => CreateTransaksiPembelian::route('/create'),
            'view' => ViewTransaksiPembelian::route('/{record}'),
            'edit' => EditTransaksiPembelian::route('/{record}/edit'),
        ];
    }
}
