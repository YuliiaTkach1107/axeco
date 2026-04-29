<?php

namespace App\Filament\Admin\Resources\Gestion\Buildings\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BuildingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nom')
                    ->required(),
                TextInput::make('adresse')
                    ->required(),
                TextInput::make('ville')
                    ->required(),
                TextInput::make('code_postal')
                    ->required(),
                TextInput::make('nombre_logements')
                    ->required()
                    ->label('Nombre de logements')
                    ->numeric()
                    ->default(0),
                TextInput::make('nombre_etages')
                    ->label('Nombre d\'étages')
                    ->numeric(),
                TextInput::make('annee_construction')
                    ->label('Année de construction')
                    ->numeric(),
                TextInput::make('nom_syndic')
                    ->label('Nom du syndic'),
                TextInput::make('email_contact')
                    ->label('Email de contact')
                    ->placeholder('example@gmail.com')
                    ->email(),
                TextInput::make('telephone_contact')
                    ->label('Téléphone de contact')
                    ->placeholder('+32 471 23 45 67')
                    ->tel()
                    ->rules([
                        'regex:/^(\\+32|0)[0-9 ]{8,14}$/',
                    ]),
                Toggle::make('ascenseur'),
                Toggle::make('parking'),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }
}
