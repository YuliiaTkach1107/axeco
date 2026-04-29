<?php

namespace App\Filament\Admin\Resources\Gestion\Invitations\Pages;

use App\Filament\Admin\Resources\Gestion\Invitations\InvitationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditInvitation extends EditRecord
{
    protected static string $resource = InvitationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
