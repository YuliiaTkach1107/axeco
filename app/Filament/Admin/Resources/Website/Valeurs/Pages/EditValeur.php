<?php

namespace App\Filament\Resources\Valeurs\Pages;

use App\Filament\Resources\Valeurs\ValeurResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditValeur extends EditRecord
{
    protected static string $resource = ValeurResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
