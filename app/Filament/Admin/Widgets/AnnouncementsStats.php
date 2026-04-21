<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Gestion\Announcement;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class AnnouncementsStats extends StatsOverviewWidget
{
      protected function getStats(): array
    {
        $user = Auth::user();

        $query = Announcement::query();

        if ($user->role === 'proprietaire') {

            $query->whereIn('building_id', function ($sub) use ($user) {

                $sub->select('copropriete_id')
                    ->from('apartments')
                    ->where('user_id', $user->id);

            });
        }

        return [
            Stat::make('Annonces', $query->count())
                ->description('Total des annonces')
                ->color('primary'),
        ];
    }

    protected int|string|array $columnSpan = 1;

    public static function canView(): bool
    {
        return Auth::user()?->role !== 'contractor';
    }
   
}
