<?php

namespace App\Filament\Admin\Resources\Gestion\Contractors\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ContractorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nom')
                    ->required(),
                TextInput::make('prenom')
                    ->label('Prénom')
                    ->required(),
                TextInput::make('email')
                    ->label('Adresse e-mail')
                    ->placeholder('example@gmail.com')
                    ->email()
                    ->required(),
                TextInput::make('telephone')
                    ->label('Téléphone')
                    ->placeholder('+32 471 23 45 67')
                    ->tel()
                    ->rules([
                        'regex:/^(\\+32|0)[0-9 ]{8,14}$/',
                    ])
                    ->required(),
                TextInput::make('adresse')
                    ->required(),
                TextInput::make('ville')
                    ->required(),
                TextInput::make('code_postal')
                    ->required(),
                Select::make('specialty_id')
                    ->relationship('specialty', 'nom')
                    ->label('Spécialité'),
                Select::make('note')
                    ->options([
                        1 => '⭐',
                        2 => '⭐⭐',
                        3 => '⭐⭐⭐',
                        4 => '⭐⭐⭐⭐',
                        5 => '⭐⭐⭐⭐⭐',
                    ])
                    ->native(false),
                TextInput::make('nom_entreprise')
                    ->label('Nom de l’entreprise'),
                Toggle::make('est_actif')
                    ->columnSpanFull()
                    ->required(),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }
}
