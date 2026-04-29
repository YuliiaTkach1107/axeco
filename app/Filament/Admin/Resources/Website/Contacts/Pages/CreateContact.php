<?php

namespace App\Filament\Admin\Resources\Website\Contacts\Pages;

use App\Filament\Admin\Resources\Website\Contacts\ContactResource;
use Filament\Resources\Pages\CreateRecord;

class CreateContact extends CreateRecord
{
    protected static string $resource = ContactResource::class;
}
