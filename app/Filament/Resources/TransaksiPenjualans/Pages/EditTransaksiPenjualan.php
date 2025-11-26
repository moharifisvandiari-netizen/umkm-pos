<?php

namespace App\Filament\Resources\TransaksiPenjualans\Pages;

use App\Filament\Resources\TransaksiPenjualans\TransaksiPenjualanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTransaksiPenjualan extends EditRecord
{
    protected static string $resource = TransaksiPenjualanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
