<?php

namespace App\Filament\Admin\Resources\Website\Topics\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TopicForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Nom')
                    ->required(),
                TextInput::make('color')
                    ->label('Couleur')
                    ->required()
                    ->default('#0d4677'),
            ]);
    }
}
