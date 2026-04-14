<?php

namespace App\Filament\Admin\Resources\Website\Contacts\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ContactForm
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
                TextInput::make('icon')
                    ->label('Icône')
                    ->columnSpanFull()
                    ->required(),
                Textarea::make('content')
                    ->label('Contenu')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('type'),
                TextInput::make('link')
                    ->label('Lien'),
            ]);
    }
}
