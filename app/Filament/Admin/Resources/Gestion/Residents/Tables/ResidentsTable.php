<?php

namespace App\Filament\Admin\Resources\Gestion\Residents\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ResidentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nom')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('prenom')
                    ->label('Prénom')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('telephone')
                    ->label('Téléphone'),
                TextColumn::make('email')
                    ->label('Adresse e-mail'),
                TextColumn::make('building.nom')
                    ->label('Copropriété'),
                TextColumn::make('apartment.numero')
                    ->label('Appartement')
                    ->sortable(),
                TextColumn::make('role')
                    ->label('Rôle')
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'proprietaire' => 'Propriétaire',
                        'locataire' => 'Locataire',
                        default => $state,
                    }),
                TextColumn::make('date_entre')
                    ->date()
                    ->label('Date d\'entrée')
                    ->sortable(),
                TextColumn::make('date_sortie')
                    ->date()
                    ->label('Date sortie')
                    ->sortable(),
                TextColumn::make('notes')
                    ->label('Notes'),
                IconColumn::make('est_actif')
                    ->label('Actif')
                    ->boolean(),
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
                TernaryFilter::make('est_actif')
                    ->label('Actif'),
                SelectFilter::make('role')
                    ->label('Rôle')
                    ->options([
                        'proprietaire' => 'Propriétaire',
                        'locataire' => 'Locataire',
                    ]),
                SelectFilter::make('building_id')
                    ->relationship('building', 'nom')
                    ->label('Copropriété'),
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
