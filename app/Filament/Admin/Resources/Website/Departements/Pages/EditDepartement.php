<?php

namespace App\Filament\Admin\Resources\Website\Departements\Pages;

use App\Filament\Admin\Resources\Website\Departements\DepartementResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDepartement extends EditRecord
{
    protected static string $resource = DepartementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
