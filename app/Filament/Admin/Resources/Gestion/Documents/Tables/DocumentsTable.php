<?php

namespace App\Filament\Admin\Resources\Gestion\Documents\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class DocumentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('titre')
                    ->searchable(),
                TextColumn::make('fichier_lien')
                     ->label('Fichier')
                    ->formatStateUsing(fn () => '📄 Ouvrir')
                    ->url(fn ($record) => asset('storage/' . $record->fichier_lien))
                    ->openUrlInNewTab()
                    ->badge()
                    ->color('primary')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->extraAttributes([
                        'class' => 'cursor-pointer transition hover:scale-105',
                    ])
                    ->searchable(),
                TextColumn::make('type')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'contrat' => 'info',
                        'facture' => 'warning',
                        'reglement' => 'success',
                        'pv_ag' => 'gray',
                        default => 'gray',
                    })
                    ->searchable(),
                TextColumn::make('building.nom')
                    ->label('Copropriété')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Propriétaire du document')
                    ->searchable(),
                IconColumn::make('est_public')
                     ->label('Visible aux résidents')
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
                SelectFilter::make('type')
                    ->options([
                        'contrat' => 'Contrat',
                        'facture' => 'Facture',
                        'reglement' => 'Règlement',
                        'pv_ag' => 'PV AG',
                    ]),

                SelectFilter::make('est_public')
                    ->options([
                        1 => 'Public',
                        0 => 'Privé',
                    ]),
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
