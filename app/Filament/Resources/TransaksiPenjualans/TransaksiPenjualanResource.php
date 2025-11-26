<?php

namespace App\Filament\Resources\TransaksiPenjualans;

use App\Filament\Resources\TransaksiPenjualans\Pages\CreateTransaksiPenjualan;
use App\Filament\Resources\TransaksiPenjualans\Pages\EditTransaksiPenjualan;
use App\Filament\Resources\TransaksiPenjualans\Pages\ListTransaksiPenjualans;
use App\Filament\Resources\TransaksiPenjualans\Schemas\TransaksiPenjualanForm;
use App\Filament\Resources\TransaksiPenjualans\Tables\TransaksiPenjualansTable;
use App\Models\TransaksiPenjualan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TransaksiPenjualanResource extends Resource
{
    protected static ?string $model = TransaksiPenjualan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return TransaksiPenjualanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TransaksiPenjualansTable::configure($table);
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
            'index' => ListTransaksiPenjualans::route('/'),
            'create' => CreateTransaksiPenjualan::route('/create'),
            'edit' => EditTransaksiPenjualan::route('/{record}/edit'),
        ];
    }
}
