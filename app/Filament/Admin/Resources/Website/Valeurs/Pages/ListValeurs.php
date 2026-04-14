<?php

namespace App\Filament\Admin\Resources\Website\Valeurs\Pages;

use App\Filament\Admin\Resources\Website\Valeurs\ValeurResource;
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
