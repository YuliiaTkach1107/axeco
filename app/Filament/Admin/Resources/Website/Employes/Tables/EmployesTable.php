<?php

namespace App\Filament\Admin\Resources\Website\Employes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EmployesTable
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
                TextColumn::make('position.title')
                    ->label('Poste'),
                TextColumn::make('email')
                    ->label('Adresse e-mail'),
                TextColumn::make('telephone')
                    ->label('Téléphone'),
                TextColumn::make('departement.title')
                    ->label('Département'),
                ImageColumn::make('avatar')
                    ->label('Photo')
                    ->disk('public')
                    ->square()
                    ->size(80),
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
                SelectFilter::make('departement_id')
                    ->relationship('departement', 'title')
                    ->label('Département'),
                SelectFilter::make('position_id')
                    ->relationship('position', 'title')
                    ->label('Poste'),
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
