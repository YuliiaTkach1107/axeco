<?php

namespace App\Filament\Resources\Services\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Table;

class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('description')
                    ->limit(50),
                TextColumn::make('icon')
                    ->limit(10),
                TextColumn::make('content')
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
                    ->label('Accent Color')
                    ->copyable(),
                ColorColumn::make('bgColor')
                    ->label('Background Color')
                    ->copyable(),
                TextColumn::make('anchor'),
                TextColumn::make('link'),
                TextColumn::make('details')
                    ->label('Details')
                    ->getStateUsing(function ($record) {
                        return $record->details()->pluck('content');
                    })
                    ->wrap()
                    ->extraAttributes([
                        'style' => 'width: 800px; white-space: normal;',
                    ])
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
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
