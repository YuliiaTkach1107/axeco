<?php

namespace App\Filament\Admin\Resources\Website\Positions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PositionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Nom')
                    ->required(),
            ]);
    }
}
