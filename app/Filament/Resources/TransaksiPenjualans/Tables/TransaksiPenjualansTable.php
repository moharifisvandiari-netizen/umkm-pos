<?php

namespace App\Filament\Resources\TransaksiPenjualans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransaksiPenjualansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('tanggal_transaksi')
                    ->date()
                    ->sortable()
                    ->label('Tanggal'),

                TextColumn::make('metodePembayaran.nama_metode') // Sesuai model MetodePembayaran
                    ->label('Metode Pembayaran')
                    ->sortable(),

                TextColumn::make('total_harga')
                    ->money('IDR') // Format sebagai mata uang Rupiah
                    ->sortable()
                    ->label('Total Harga'),

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
                // Tambahkan filter jika diperlukan, misalnya berdasarkan tanggal
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