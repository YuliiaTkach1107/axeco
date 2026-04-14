<?php

namespace App\Filament\Admin\Resources\Website\Departements\Pages;

use App\Filament\Admin\Resources\Website\Departements\DepartementResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDepartements extends ListRecords
{
    protected static string $resource = DepartementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
