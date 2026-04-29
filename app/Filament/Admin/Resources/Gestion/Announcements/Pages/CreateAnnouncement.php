<?php

namespace App\Filament\Admin\Resources\Gestion\Announcements\Pages;

use App\Filament\Admin\Resources\Gestion\Announcements\AnnouncementResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAnnouncement extends CreateRecord
{
    protected static string $resource = AnnouncementResource::class;
}
