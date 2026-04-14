<?php

namespace App\Filament\Admin\Resources\Gestion\Buildings\Pages;

use App\Filament\Admin\Resources\Gestion\Buildings\BuildingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBuilding extends EditRecord
{
    protected static string $resource = BuildingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
