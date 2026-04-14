<?php

namespace App\Filament\Admin\Resources\Gestion\Specialties\Pages;

use App\Filament\Admin\Resources\Gestion\Specialties\SpecialtyResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSpecialty extends EditRecord
{
    protected static string $resource = SpecialtyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
