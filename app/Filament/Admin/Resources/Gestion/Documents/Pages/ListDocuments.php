<?php

namespace App\Filament\Admin\Resources\Gestion\Documents\Pages;

use App\Filament\Admin\Resources\Gestion\Documents\DocumentResource;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListDocuments extends ListRecords
{
    protected static string $resource = DocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->visible(fn () => Auth::user()?->role === 'admin'),
            
        ];
    }
}
