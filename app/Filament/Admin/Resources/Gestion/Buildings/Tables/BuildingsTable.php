<?php

namespace App\Filament\Admin\Resources\Gestion\Buildings\Tables;

use App\Models\Gestion\Building;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class BuildingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nom')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('adresse'),
                TextColumn::make('ville')
                    ->badge()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('code_postal'),
                TextColumn::make('nombre_logements')
                    ->label('Nombre de logements')
                    ->sortable()
                    ->numeric(),
                TextColumn::make('nombre_etages')
                    ->label('Nombre d\'étages')
                    ->sortable()
                    ->numeric(),
                TextColumn::make('annee_construction')
                    ->numeric()
                    ->label('Année de construction')
                    ->sortable(),
                TextColumn::make('nom_syndic')
                    ->label('Nom du syndic')
                    ->searchable(),
                TextColumn::make('email_contact')
                    ->label('Email de contact'),
                TextColumn::make('telephone_contact')
                    ->label('Téléphone de contact'),
                IconColumn::make('ascenseur')
                    ->boolean(),
                IconColumn::make('parking')
                    ->boolean(),
                TextColumn::make('notes')
                    ->limit(30),
                TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Mis à jour le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('ascenseur')
                    ->label('Ascenseur'),
                TernaryFilter::make('parking')
                    ->label('Parking'),
                SelectFilter::make('ville')
                    ->label('Ville')
                    ->options(
                        Building::query()
                            ->pluck('ville', 'ville')
                            ->unique()
                            ->toArray()
                    ),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
