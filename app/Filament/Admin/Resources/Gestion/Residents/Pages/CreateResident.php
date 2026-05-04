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
            'Nouveau resident',
            "Un nouveau resident a ete ajoute : {$this->record->prenom} {$this->record->nom}"
        );
    }
}
