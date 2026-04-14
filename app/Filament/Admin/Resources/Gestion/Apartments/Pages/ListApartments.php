<?php

namespace App\Filament\Admin\Resources\Gestion\Apartments\Pages;

use App\Filament\Admin\Resources\Gestion\Apartments\ApartmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListApartments extends ListRecords
{
    protected static string $resource = ApartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
