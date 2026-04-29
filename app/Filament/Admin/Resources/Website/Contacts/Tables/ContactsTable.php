<?php

namespace App\Filament\Admin\Resources\Website\Contacts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Nom')
                    ->sortable()
                    ->searchable(),
                ColorColumn::make('color')
                    ->label('Couleur'),
                TextColumn::make('icon')
                    ->label('Icône')
                    ->limit(10),
                TextColumn::make('content')
                    ->label('Contenu')
                    ->limit(40),
                TextColumn::make('type')
                    ->label('Type')
                    ->badge(),
                TextColumn::make('link')
                    ->label('Lien'),
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
