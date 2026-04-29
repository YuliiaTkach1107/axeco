<?php

namespace App\Filament\Admin\Resources\Gestion\Announcements\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class AnnouncementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('titre')
                    ->searchable(),
                TextColumn::make('building.nom')
                    ->label('Copropriété')
                    ->searchable(),
                TextColumn::make('publie_le')
                    ->label('Publié le')
                    ->date()
                    ->sortable(),
                TextColumn::make('expire_le')
                    ->label('Expire le')
                    ->date()
                    ->sortable(),
                TextColumn::make('cree_par')
                    ->label('Créé par')
                    ->searchable(),
                IconColumn::make('est_actif')
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
                Filter::make('publie_le')
                    ->form([
                        DatePicker::make('from'),
                        DatePicker::make('until'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn ($q) => $q->whereDate('publie_le', '>=', $data['from']))
                            ->when($data['until'], fn ($q) => $q->whereDate('publie_le', '<=', $data['until']));
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (! $data['from'] && ! $data['until']) {
                            return null;
                        }

                        return 'Date filtrée';
                    }),
            ])
            ->recordActions([
                EditAction::make()->visible(fn () => Auth::user()?->role === 'admin'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->visible(fn () => Auth::user()?->role === 'admin'),
                ]),
            ]);
    }
}
