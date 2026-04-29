<?php

namespace App\Filament\Admin\Resources\Website\Services\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Titre')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('description')
                    ->tooltip(fn ($record) => $record->description)
                    ->limit(50),
                TextColumn::make('icon')
                    ->label('Icône')
                    ->limit(10),
                TextColumn::make('content')
                    ->label('Contenu')
                    ->html()
                    ->wrap()
                    ->extraAttributes([
                        'style' => 'width: 800px; white-space: normal;',
                    ]),
                ImageColumn::make('image_url')
                    ->label('Image')
                    ->disk('public')
                    ->square()
                    ->size(80),
                ColorColumn::make('accentColor')
                    ->label('Couleur d’accent')
                    ->copyable(),
                ColorColumn::make('bgColor')
                    ->label('Couleur de fond')
                    ->copyable(),
                TextColumn::make('anchor')
                    ->label('Ancre'),
                TextColumn::make('link')
                    ->label('Lien (URL)'),
                TextColumn::make('details')
                    ->label('Details')
                    ->getStateUsing(function ($record) {
                        $items = $record->details
                            ->pluck('content')
                            ->map(fn ($item) => "<li>{$item}</li>")
                            ->join('');

                        return "<ul style='list-style-type: disc; padding-left: 16px; margin: 0;'>{$items}</ul>";
                    })
                    ->html()
                    ->wrap()
                    ->extraAttributes([
                                        'style' => 'width: 400px; white-space: normal;',
                                    ]),
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
