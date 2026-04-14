<?php

namespace App\Filament\Admin\Resources\Gestion\Tickets\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Titre')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Select::make('statut')
                    ->required()
                    ->options([
                        'ouvert' => 'Ouvert',
                        'en_cours' => 'En cours',
                        'résolu' => 'Résolu',
                        'fermé' => 'Fermé',
                    ])
                    ->default('ouvert'),
                Select::make('priorite')
                    ->label('Priorité')
                    ->options([
                        'faible' => 'Faible',
                        'moyenne' => 'Moyenne',
                        'élevée' => 'Élevée',
                        'urgente' => 'Urgente',
                    ])
                    ->required()
                    ->default('moyenne'),
                Select::make('resident_id')
                    ->required()
                    ->label('Résident')
                    ->relationship('resident', 'nom')
                    ->preload()
                    ->searchable(),
                Select::make('building_id')
                    ->label('Copropriété')
                    ->relationship('building', 'nom')
                    ->required()
                    ->preload()
                    ->searchable(),
                Select::make('apartment_id')
                    ->label('Appartement')
                    ->relationship('apartment', 'numero')
                    ->preload()
                    ->searchable(),
                Select::make('contractor_id')
                    ->label('Entrepreneur')
                    ->relationship('contractor', 'nom')
                    ->preload()
                    ->searchable(),
                Textarea::make('note_admin')
                    ->columnSpanFull(),
                DateTimePicker::make('assigne_le')->label('Assigné le'),
                DateTimePicker::make('resolu_le')->label('Résolu le'),
            ]);
    }
}
