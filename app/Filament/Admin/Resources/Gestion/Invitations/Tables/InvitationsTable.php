<?php

namespace App\Filament\Admin\Resources\Gestion\Invitations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InvitationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->copyable()
                    ->badge()
                    ->color('gray'),
                TextColumn::make('role')
                   ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'admin' => 'danger',
                        'proprietaire' => 'warning',
                        'resident' => 'success',
                        'contractor' => 'gray',
                        default => 'gray',
                    }),
                TextColumn::make('used_at')
                    ->label('Statut')
                    ->formatStateUsing(fn ($state) => $state ? 'Utilisé' : 'Actif')
                    ->color(fn ($state) => $state ? 'danger' : 'success'),
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
