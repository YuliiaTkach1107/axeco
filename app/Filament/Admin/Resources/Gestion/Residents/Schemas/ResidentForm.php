<?php

namespace App\Filament\Admin\Resources\Gestion\Residents\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ResidentForm
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
                TextInput::make('telephone')
                    ->label('Téléphone')
                    ->placeholder('+32 471 23 45 67')
                    ->tel()
                    ->rules([
                        'regex:/^(\\+32|0)[0-9 ]{8,14}$/',
                    ])
                    ->required(),
                TextInput::make('email')
                    ->label('Adresse e-mail')
                    ->placeholder('example@gmail.com')
                    ->email()
                    ->required(),
                Select::make('copropriete_id')
                    ->label('Copropriété')
                    ->relationship('building', 'nom')
                    ->required(),
                Select::make('appartement_id')
                    ->label('Appartement')
                    ->relationship('apartment', 'numero')
                    ->required(),
                Select::make('role')
                    ->label('Rôle')
                    ->options([
                        'proprietaire' => 'Propriétaire',
                        'locataire' => 'Locataire',
                    ])
                    ->required(),
                DatePicker::make('date_entre')
                    ->label('Date d\'entrée'),
                DatePicker::make('date_sortie')
                    ->label('Date sortie'),
                Toggle::make('est_actif')
                    ->label('Actif')
                    ->columnSpanFull(),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }
}
