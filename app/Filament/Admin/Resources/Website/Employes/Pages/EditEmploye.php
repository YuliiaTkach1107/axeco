<?php

namespace App\Filament\Admin\Resources\Website\Employes\Pages;

use App\Filament\Admin\Resources\Website\Employes\EmployeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEmploye extends EditRecord
{
    protected static string $resource = EmployeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
