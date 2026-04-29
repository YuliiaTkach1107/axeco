<?php

namespace App\Filament\Admin\Resources\Gestion\Apartments\Pages;

use App\Filament\Admin\Resources\Gestion\Apartments\ApartmentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditApartment extends EditRecord
{
    protected static string $resource = ApartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
