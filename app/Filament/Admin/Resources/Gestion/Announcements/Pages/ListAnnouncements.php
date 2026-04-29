<?php

namespace App\Filament\Admin\Resources\Gestion\Announcements\Pages;

use App\Filament\Admin\Resources\Gestion\Announcements\AnnouncementResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListAnnouncements extends ListRecords
{
    protected static string $resource = AnnouncementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->visible(fn () => Auth::user()?->role === 'admin'),
        ];
    }
}
