<?php

namespace App\Filament\Widgets;

use App\Filament\Admin\Resources\Gestion\Announcements\AnnouncementResource;
use App\Models\Gestion\Announcement;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class LatestAnnouncements extends TableWidget
{
    protected static ?string $heading = 'Dernières annonces';

  public function table(Table $table): Table
{
    return $table
        ->query(function (): Builder {

            $query = Announcement::query();

            $user = Auth::user();

            if ($user->role === 'proprietaire') {

                $query->whereIn('building_id', function ($sub) use ($user) {

                    $sub->select('copropriete_id')
                        ->from('apartments')
                        ->where('user_id', $user->id);

                });
            }
             if ($user->role === 'resident') {
                $query->whereIn('building_id', function ($sub) use ($user) {
                    $sub->select('copropriete_id')
                        ->from('residents')
                        ->where('user_id', $user->id);
                });
    }

            return $query->latest()->limit(5);
        })
        ->columns([
            TextColumn::make('titre')
                ->limit(30)
                ->searchable(),

            TextColumn::make('publie_le')
                ->label('Publié le')
                ->dateTime()
                ->sortable(),

            TextColumn::make('expire_le')
                ->dateTime()
                ->sortable(),
            
            TextColumn::make('action')
                ->label('')
                ->state('Modifier')
                ->color('primary')
                ->alignCenter()
                ->extraAttributes([
                    'class' => 'cursor-pointer text-primary-600',
                ])
                ->visible(fn () => Auth::user()->role === 'admin')
        ])
        ->paginated(false)
        ->recordUrl(fn (Announcement $record): ?string =>
            Auth::user()->role === 'admin'
                ? AnnouncementResource::getUrl('edit', ['record' => $record])
                : null
        );
}

    protected int|string|array $columnSpan = [
        'default' => 1,
        'sm' => 1,
        'md' => 2,
        'xl' => 3,
    ];
    public static function canView(): bool
    {
        return Auth::user()?->role !== 'contractor';
    }
}
