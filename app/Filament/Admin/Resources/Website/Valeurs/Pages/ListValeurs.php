<?php

namespace App\Filament\Resources\Valeurs\Pages;

use App\Filament\Resources\Valeurs\ValeurResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListValeurs extends ListRecords
{
    protected static string $resource = ValeurResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
