<?php

namespace App\Filament\Resources\TransaksiPenjualans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TransaksiPenjualanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('metode_pembayaran_id')
                    ->required()
                    ->numeric(),
                TextInput::make('total_harga')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
