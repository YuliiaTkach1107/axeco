<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Gestion\Contractor;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class IntervenantsStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Entrepreneurs', Contractor::count())
                ->description('Total des entrepreneurs')
                ->color('primary'),
        ];
    }

    public static function canView(): bool
    {
         return !in_array(Auth::user()->role,['proprietaire', 'contractor','resident']);
    }

    protected int|string|array $columnSpan = 1;
}
