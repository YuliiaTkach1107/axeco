<?php

namespace App\Filament\Admin\Resources\Gestion\Residents\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use App\Models\Gestion\Apartment;

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
                    ->live()
                    ->required(),

                Select::make('appartement_id')
                    ->label('Appartement')
                    ->options(function (Get $get) {

                        $buildingId = $get('copropriete_id');

                        if (! $buildingId) {
                            return [];
                        }

                        return Apartment::query()
                            ->where('copropriete_id', $buildingId)
                            ->pluck('numero', 'id')
                            ->toArray();
                    })
                    ->searchable()
                    ->required(),
                Select::make('role')
                    ->label('Rôle')
                    ->options([
                        'proprietaire' => 'Propriétaire',
                        'locataire' => 'Locataire',
                    ])
                    ->required(),
                Select::make('user_id')
                    ->label('Compte utilisateur')
                    ->relationship('user', 'email')
                    ->searchable()
                    ->preload()
                    ->placeholder('Aucun compte associé')
                    ->helperText('Associer un compte pour permettre la connexion')
                    ->nullable(),
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
