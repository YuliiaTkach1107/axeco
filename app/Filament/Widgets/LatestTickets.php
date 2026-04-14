<?php

namespace App\Filament\Widgets;

use App\Filament\Admin\Resources\Gestion\Tickets\TicketResource;
use App\Models\Gestion\Ticket;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class LatestTickets extends TableWidget
{
    protected static ?string $heading = 'Dernières demandes';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Ticket::query()->latest()
            )
            ->columns([
                TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->limit(30),

                TextColumn::make('statut')
                    ->label('Statut')
                    ->color(fn ($state) => match ($state) {
                        'ouvert' => 'info',
                        'en_cours' => 'warning',
                        'résolu' => 'success',
                        'élevée' => 'gray',
                    })
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'ouvert' => 'Ouvert',
                        'en_cours' => 'En cours',
                        'résolu' => 'Résolu',
                        'fermé' => 'Fermé',
                        default => $state,
                    })
                    ->searchable()
                    ->badge(),

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
                    ->searchable()
                    ->badge(),
            ])
            ->paginated(false)
            ->actions([
                EditAction::make()->label('Modifier'),
            ])
            ->recordUrl(fn (Ticket $record): string => TicketResource::getUrl('edit', [
                'record' => $record,
            ]))
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
            ]);
    }

    protected int|string|array $columnSpan = [
        'default' => 1,
        'sm' => 1,
        'md' => 2,
        'xl' => 5,
    ];
}
