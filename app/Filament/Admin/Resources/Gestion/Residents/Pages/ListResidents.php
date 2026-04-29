<?php

namespace App\Filament\Admin\Resources\Gestion\Residents\Pages;

use App\Filament\Admin\Resources\Gestion\Residents\ResidentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListResidents extends ListRecords
{
    protected static string $resource = ResidentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->visible(fn () => Auth::user()?->role === 'admin'),
        ];
    }
}
