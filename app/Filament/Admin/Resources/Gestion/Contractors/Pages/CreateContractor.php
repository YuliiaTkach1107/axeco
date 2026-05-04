<?php

namespace App\Filament\Admin\Resources\Gestion\Contractors\Pages;

use App\Filament\Admin\Resources\Gestion\Contractors\ContractorResource;
use App\Support\AdminDatabaseNotification;
use Filament\Resources\Pages\CreateRecord;

class CreateContractor extends CreateRecord
{
    protected static string $resource = ContractorResource::class;

    protected function afterCreate(): void
    {
        AdminDatabaseNotification::send(
            'Nouveau prestataire',
            "Un nouveau prestataire a été ajouté : {$this->record->prenom} {$this->record->nom}"
        );
    }
}
