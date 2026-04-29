<?php

namespace App\Filament\Admin\Resources\Website\Positions\Pages;

use App\Filament\Admin\Resources\Website\Positions\PositionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPosition extends EditRecord
{
    protected static string $resource = PositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
