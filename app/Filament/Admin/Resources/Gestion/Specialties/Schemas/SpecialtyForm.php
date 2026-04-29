<?php

namespace App\Filament\Admin\Resources\Gestion\Specialties\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SpecialtyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nom')
                    ->required(),
            ]);
    }
}
