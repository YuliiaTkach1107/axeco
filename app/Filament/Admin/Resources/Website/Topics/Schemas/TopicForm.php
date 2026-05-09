<?php

namespace App\Filament\Admin\Resources\Website\Topics\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\ColorPicker;

class TopicForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Nom')
                    ->required(),
                ColorPicker::make('color')
                    ->label('Couleur')
                    ->required(),
            ]);
    }
}
