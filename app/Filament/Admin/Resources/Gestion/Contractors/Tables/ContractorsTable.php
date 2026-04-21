<?php

namespace App\Filament\Admin\Resources\Gestion\Contractors\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ContractorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nom')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('prenom')
                    ->label('Prénom')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Adresse e-mail'),
                TextColumn::make('telephone')
                    ->label('Téléphone'),
                TextColumn::make('adresse'),
                TextColumn::make('ville')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('code_postal'),
                TextColumn::make('specialite')
                    ->label('Spécialité')
                    ->searchable(),
                TextColumn::make('note')
                    ->formatStateUsing(fn ($state) => $state ? str_repeat('⭐', (int) $state) : '—')
                    ->sortable(),
                TextColumn::make('nom_entreprise')
                    ->label('Nom de l’entreprise')
                    ->searchable(),
                IconColumn::make('est_actif')
                    ->label('Actif')
                    ->boolean(),
                TextColumn::make('notes')->limit(30)->tooltip(fn ($record) => $record->notes),
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
                SelectFilter::make('specialite')
                    ->label('Spécialité')
                    ->options(
                        \App\Models\Gestion\Contractor::query()
                            ->pluck('specialite', 'specialite')
                            ->unique()
                            ->filter()
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
