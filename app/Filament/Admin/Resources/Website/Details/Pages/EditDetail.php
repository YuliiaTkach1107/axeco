<?php

namespace App\Filament\Resources\Details\Pages;

use App\Filament\Resources\Details\DetailResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDetail extends EditRecord
{
    protected static string $resource = DetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
