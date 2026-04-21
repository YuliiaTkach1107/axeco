<?php

namespace App\Filament\Admin\Resources\Gestion\Documents\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class DocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titre')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                FileUpload::make('fichier_lien')
                    ->label('Fichier')
                    ->disk('public')
                    ->directory('documents')
                    ->required(),
                Select::make('category')
                    ->label('Type de fichier')
                    ->options([
                        'contrat' => 'Contrat',
                        'facture' => 'Facture',
                        'reglement' => 'Règlement',
                        'pv_ag' => 'PV AG',
                    ])
                    ->required(),
                Select::make('type')
                    ->label('Type d’accès')
                    ->options([
                        'personal' => 'Personnel',
                        'building' => 'Copropriété',
                        'public' => 'Public',
                    ])
                    ->required(),
                Select::make('building_id')
                    ->label('Copropriété')
                    ->relationship('building', 'nom')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('user_id')
                    ->label('Propriétaire du document')
                    ->relationship('user', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),
                Toggle::make('est_public')
                    ->label('Visible aux résidents')
                    ->required(),
            ]);
    }
}
