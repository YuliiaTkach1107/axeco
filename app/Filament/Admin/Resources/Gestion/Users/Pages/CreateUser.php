<?php

namespace App\Filament\Admin\Resources\Gestion\Users\Pages;

use App\Filament\Admin\Resources\Gestion\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;


class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
   
}
