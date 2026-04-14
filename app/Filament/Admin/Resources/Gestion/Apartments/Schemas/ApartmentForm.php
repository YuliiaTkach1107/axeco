<?php

namespace App\Filament\Admin\Resources\Gestion\Apartments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class ApartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('numero')
                    ->label('Numéro')
                    ->required(),
                Select::make('copropriete_id')
                    ->label('Copropriété')
                    ->relationship('building', 'nom')
                    ->required(),
                TextInput::make('etage')
                    ->label('Étage')
                    ->numeric(),
                TextInput::make('surface')
                    ->label('Surface (m²)')
                    ->numeric(),
                TextInput::make('nombre_pieces')
                    ->label('Nombre de pièces')
                    ->numeric(),
                TextInput::make('type')
                    ->required(),
                Select::make('statut')
                    ->options([
                        'libre' => 'Libre',
                        'occupe' => 'Occupé',
                        'maintenance' => 'Maintenance',
                    ])
                    ->default('libre')
                    ->required(),
                Grid::make(2)
                    ->schema([
                        Toggle::make('balcon'),
                        Toggle::make('parking'),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
