<?php

namespace App\Filament\Admin\Resources\Gestion\Documents\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;

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
                    ->acceptedFileTypes([
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    ])
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
                    ->required()
                    ->live(),
                Select::make('building_id')
                    ->label('Copropriété')
                    ->relationship('building', 'nom')
                    ->searchable()
                    ->visible(fn (Get $get) => $get('type') === 'building')
                    ->dehydrated(fn (Get $get) => $get('type') === 'building')
                    ->preload()
                    ->required()
                    ->nullable(),
                Select::make('user_id')
                    ->label('Propriétaire du document')
                    ->relationship(
                        name: 'user',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn ($query) =>
                            $query->whereIn('role', ['proprietaire', 'resident'])
                    )
                    ->visible(fn (Get $get) => $get('type') === 'personal')
                    ->dehydrated(fn (Get $get) => $get('type') === 'personal')
                    ->preload()
                    ->searchable()
                    ->nullable()
            ]);
    }
}
