<?php

namespace App\Filament\Resources\Produks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProdukForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_barang')
                    ->required(),
                TextInput::make('nama_produk')
                    ->required(),
                TextInput::make('kategori_id')
                    ->required()
                    ->numeric(),
                TextInput::make('satuan_id')
                    ->required()
                    ->numeric(),
                TextInput::make('harga_modal')
                    ->required()
                    ->numeric(),
                TextInput::make('harga_jual')
                    ->required()
                    ->numeric(),
                TextInput::make('stok')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('status')
                    ->required(),
            ]);
    }
}
