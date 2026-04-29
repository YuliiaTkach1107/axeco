<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Gestion\Resident;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class ResidentsStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $user = Auth::user();

        $query = Resident::query();

        if ($user->role === 'proprietaire') {

            $query->whereHas('apartment', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });

        }

        return [
            Stat::make('Résidents', $query->count())
                ->description('Total des résidents')
                ->color('primary'),
        ];
    }

    protected int|string|array $columnSpan = 1;
    
    public static function canView(): bool
    {
         return !in_array(Auth::user()->role,[ 'contractor','resident']);
    }
}
