<?php

namespace App\Filament\Admin\Resources\Gestion\Apartments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ApartmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('numero')
                    ->label('Numéro')
                    ->searchable(),
                TextColumn::make('building.nom')
                    ->label('Copropriété')
                    ->searchable(),
                TextColumn::make('etage')
                    ->label('Étage'),
                TextColumn::make('surface')
                    ->label('Surface (m²)')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('nombre_pieces')
                    ->label('Nombre de pièces')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('type'),
                TextColumn::make('statut')
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'libre' => 'Libre',
                        'occupe' => 'Occupé',
                        'maintenance' => 'Maintenance',
                        default => $state,
                    })
                    ->searchable(),
                IconColumn::make('balcon')
                    ->boolean(),
                IconColumn::make('parking')
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
                //
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
