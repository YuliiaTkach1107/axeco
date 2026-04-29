<?php

namespace App\Filament\Admin\Resources\Website\Details\Pages;

use App\Filament\Admin\Resources\Website\Details\DetailResource;
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
