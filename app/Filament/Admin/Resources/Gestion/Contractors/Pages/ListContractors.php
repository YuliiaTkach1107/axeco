<?php

namespace App\Filament\Admin\Resources\Gestion\Contractors\Pages;

use App\Filament\Admin\Resources\Gestion\Contractors\ContractorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContractors extends ListRecords
{
    protected static string $resource = ContractorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
