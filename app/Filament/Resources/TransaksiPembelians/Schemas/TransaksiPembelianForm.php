<?php

namespace App\Filament\Resources\TransaksiPembelians\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TransaksiPembelianForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('supplier_id')
                    ->required()
                    ->numeric(),
                TextInput::make('total_harga')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
