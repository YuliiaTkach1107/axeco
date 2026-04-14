<?php

namespace App\Filament\Widgets;

use App\Filament\Admin\Resources\Gestion\Announcements\AnnouncementResource;
use App\Models\Gestion\Announcement;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestAnnouncements extends TableWidget
{
    protected static ?string $heading = 'Dernières annonces';

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Announcement::query()->latest()->limit(5))
            ->columns([
                TextColumn::make('titre')
                    ->limit(30)
                    ->searchable(),
                TextColumn::make('publie_le')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('expire_le')
                    ->dateTime()
                    ->sortable(),
            ])
            ->paginated(false)
            ->actions([
                EditAction::make()->label('Modifier'),
            ])
            ->recordUrl(fn (Announcement $record): string => AnnouncementResource::getUrl('edit', [
                'record' => $record,
            ]));
    }

    protected int|string|array $columnSpan = [
        'default' => 1,
        'sm' => 1,
        'md' => 2,
        'xl' => 3,
    ];
}
