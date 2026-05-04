<?php

namespace App\Filament\Admin\Resources\Gestion\Residents\Pages;

use App\Filament\Admin\Resources\Gestion\Residents\ResidentResource;
use App\Support\AdminDatabaseNotification;
use Filament\Resources\Pages\CreateRecord;

class CreateResident extends CreateRecord
{
    protected static string $resource = ResidentResource::class;

    protected function afterCreate(): void
    {
        AdminDatabaseNotification::send(
            'Nouveau résident',
            "Un nouveau résident a été ajouté : {$this->record->prenom} {$this->record->nom}"
        );
    }
}
