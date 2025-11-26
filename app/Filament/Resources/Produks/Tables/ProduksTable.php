<?php

namespace App\Filament\Resources\Produks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProduksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_barang')
                    ->searchable(),
                TextColumn::make('nama_produk')
                    ->searchable(),
                TextColumn::make('kategori_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('satuan_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('harga_modal')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('harga_jual')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('stok')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('status')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
