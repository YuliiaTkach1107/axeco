<?php

namespace App\Filament\Admin\Resources\Website\Topics\Pages;

use App\Filament\Admin\Resources\Website\Topics\TopicResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTopic extends CreateRecord
{
    protected static string $resource = TopicResource::class;
}
