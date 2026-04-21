<?php

namespace App\Filament\Admin\Resources\Gestion\Tickets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class TicketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->description),
                TextColumn::make('statut')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'ouvert' => 'info',
                        'en_cours' => 'warning',
                        'résolu' => 'success',
                        'fermé' => 'gray',
                    })
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'ouvert' => 'Ouvert',
                        'en_cours' => 'En cours',
                        'résolu' => 'Résolu',
                        'fermé' => 'Fermé',
                        default => $state,
                    })
                    ->sortable()
                    ->searchable(),
                TextColumn::make('priorite')
                    ->label('Priorité')
                    ->color(fn ($state) => match ($state) {
                        'faible' => 'gray',
                        'moyenne' => 'info',
                        'élevée' => 'warning',
                        'urgente' => 'danger',
                    })
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'faible' => 'Faible',
                        'moyenne' => 'Moyenne',
                        'élevée' => 'Élevée',
                        'urgente' => 'Urgente',
                        default => $state,
                    })
                    ->badge()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('resident.full_name')
                    ->label('Résident')
                    ->searchable(),
                TextColumn::make('building.nom')
                    ->label('Copropriété')
                    ->searchable(),
                TextColumn::make('apartment.numero')
                    ->label('Appartement'),
                TextColumn::make('contractor.full_name')
                    ->label('Entrepreneur'),
                TextColumn::make('assigne_le')
                    ->label('Assigné le')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('resolu_le')
                    ->label('Résolu le')
                    ->dateTime()
                    ->sortable(),
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
                SelectFilter::make('statut')
                    ->label('Filtrer par statut')
                    ->options([
                        'ouvert' => 'Ouvert',
                        'en_cours' => 'En cours',
                        'résolu' => 'Résolu',
                    ]),
                SelectFilter::make('priorite')
                    ->label('Filtrer par priorité')
                    ->options([
                        'faible' => 'Faible',
                        'moyenne' => 'Moyenne',
                        'élevée' => 'Élevée',
                        'urgente' => 'Urgente',
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
                    DeleteBulkAction::make()->visible(fn () => Auth::user()?->role === 'admin'),
                ]),
            ]);
    }
}
