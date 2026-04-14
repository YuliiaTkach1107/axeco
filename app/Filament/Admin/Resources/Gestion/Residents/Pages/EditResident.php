<?php

namespace App\Filament\Admin\Resources\Gestion\Residents\Pages;

use App\Filament\Admin\Resources\Gestion\Residents\ResidentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditResident extends EditRecord
{
    protected static string $resource = ResidentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
