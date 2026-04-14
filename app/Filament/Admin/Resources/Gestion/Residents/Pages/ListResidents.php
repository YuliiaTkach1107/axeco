<?php

namespace App\Filament\Admin\Resources\Gestion\Residents\Pages;

use App\Filament\Admin\Resources\Gestion\Residents\ResidentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListResidents extends ListRecords
{
    protected static string $resource = ResidentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
