<?php

namespace App\Filament\Resources\TransaksiPenjualans\Schemas;

use App\Models\MetodePembayaran;
use App\Models\Produk; // Model Produk sudah sesuai
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TransaksiPenjualanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('tanggal_transaksi')
                    ->required()
                    ->default(now())
                    ->label('Tanggal Transaksi'),

                Select::make('metode_pembayaran_id')
                    ->relationship('metodePembayaran', 'nama_metode') // Sesuai model MetodePembayaran
                    ->required()
                    ->label('Metode Pembayaran'),

                Repeater::make('detailPenjualans') // Sesuai relasi di model TransaksiPenjualan
                    ->relationship('detailPenjualans')
                    ->schema([
                        Select::make('produk_id')
                            ->relationship('produk', 'nama_produk') // Diperbaiki: Gunakan 'nama_produk' sesuai model Produk
                            ->required()
                            ->label('Produk'),

                        TextInput::make('jumlah')
                            ->required()
                            ->numeric()
                            ->default(1)
                            ->label('Jumlah'),

                        TextInput::make('harga_jual') // Sesuai model DetailPenjualan
                            ->required()
                            ->numeric()
                            ->label('Harga Jual'),

                        TextInput::make('subtotal')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(false) // Tidak disimpan, hanya untuk tampilan
                            ->label('Subtotal')
                            ->afterStateUpdated(function ($get, $set) {
                                $jumlah = $get('jumlah') ?? 0;
                                $harga = $get('harga_jual') ?? 0;
                                $set('subtotal', $jumlah * $harga);
                            }),
                    ])
                    ->columns(4)
                    ->label('Item Penjualan')
                    ->afterStateUpdated(function ($get, $set) {
                        // Hitung total harga dari semua item
                        $details = $get('detailPenjualans') ?? [];
                        $total = 0;
                        foreach ($details as $detail) {
                            $total += ($detail['jumlah'] ?? 0) * ($detail['harga_jual'] ?? 0);
                        }
                        $set('total_harga', $total);
                    }),

                TextInput::make('total_harga')
                    ->hidden() // Tetap tersembunyi
                    ->numeric() // Sekarang didukung
                    ->default(0),
            ]);
    }
}