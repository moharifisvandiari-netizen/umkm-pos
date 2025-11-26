<?php

namespace App\Filament\Resources\TransaksiPenjualans\Pages;

use App\Filament\Resources\TransaksiPenjualans\TransaksiPenjualanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTransaksiPenjualans extends ListRecords
{
    protected static string $resource = TransaksiPenjualanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
