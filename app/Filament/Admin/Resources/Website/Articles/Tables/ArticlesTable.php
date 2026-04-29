<?php

namespace App\Filament\Admin\Resources\Website\Articles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Titre')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('date_publication')
                    ->label('Date de publication')
                    ->date()
                    ->sortable(),
                ImageColumn::make('image_url')
                    ->label('Image')
                    ->disk('public')
                    ->square()
                    ->size(80),
                TextColumn::make('description')
                    ->tooltip(fn ($record) => $record->description)
                    ->limit(50),
                TextColumn::make('content')
                    ->label('Contenu')
                    ->limit(50),
                TextColumn::make('topic.title')
                    ->label('Catégorie')
                    ->badge()
                    ->searchable(),
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
                SelectFilter::make('topic_id')
                    ->relationship('topic', 'title')
                    ->label('Catégorie'),
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
