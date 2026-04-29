<?php

namespace App\Filament\Admin\Resources\Gestion\Contractors\Pages;

use App\Filament\Admin\Resources\Gestion\Contractors\ContractorResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditContractor extends EditRecord
{
    protected static string $resource = ContractorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
